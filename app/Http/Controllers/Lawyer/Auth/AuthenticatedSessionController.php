<?php

namespace App\Http\Controllers\Lawyer\Auth;

use App\Http\Controllers\Controller;
use App\Rules\CustomRecaptcha;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Modules\Lawyer\app\Enums\LawyerStatus;
use Modules\Lawyer\app\Models\Lawyer;

class AuthenticatedSessionController extends Controller {
    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request) {
        // Always log login attempts for debugging
        \Log::info('Lawyer login attempt started', [
            'email' => $request->email,
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent()
        ]);

        $setting = Cache::get('setting');

        // Build validation rules
        $rules = [
            'email'    => 'required|email',
            'password' => 'required',
        ];

        // Only add recaptcha if it's active
        if ($setting && $setting->recaptcha_status == 'active') {
            $rules['g-recaptcha-response'] = ['required', new CustomRecaptcha()];
        }

        $customMessages = [
            'email.required'                => __('Email is required'),
            'password.required'             => __('Password is required'),
            'g-recaptcha-response.required' => __('Please complete the recaptcha to submit the form'),
        ];
        
        try {
            $this->validate($request, $rules, $customMessages);
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::warning('Lawyer login validation failed', [
                'email' => $request->email,
                'errors' => $e->errors()
            ]);
            return redirect()->route('login', ['type' => 'lawyer'])
                ->withErrors($e->errors())
                ->withInput($request->only('email'));
        }

        $lawyer = Lawyer::where('email', $request->email)->first();

        if (!$lawyer) {
            \Log::warning('Lawyer login failed - lawyer not found', ['email' => $request->email]);
            $notification = __('Invalid Credentials');
            $notification = ['message' => $notification, 'alert-type' => 'error'];
            return redirect()->route('login', ['type' => 'lawyer'])->with($notification);
        }

        if ($lawyer->status != LawyerStatus::ACTIVE->value) {
            \Log::warning('Lawyer login failed - inactive account', [
                'email' => $request->email,
                'lawyer_id' => $lawyer->id,
                'status' => $lawyer->status
            ]);
            $notification = __('Inactive account');
            $notification = ['message' => $notification, 'alert-type' => 'error'];
            return redirect()->route('login', ['type' => 'lawyer'])->with($notification);
        }

        if ($lawyer->email_verified_at == null) {
            \Log::warning('Lawyer login failed - email not verified', [
                'email' => $request->email,
                'lawyer_id' => $lawyer->id
            ]);
            $notification = __('Please verify your email');
            $notification = ['message' => $notification, 'alert-type' => 'error'];
            return redirect()->route('login', ['type' => 'lawyer'])->with($notification);
        }

        // Get the raw password hash from database to avoid issues with 'hashed' cast
        $lawyerPassword = $lawyer->getRawOriginal('password');
        
        // Verify password - try multiple methods
        $passwordValid = false;
        
        // Method 1: Try Hash::check()
        try {
            $passwordValid = Hash::check($request->password, $lawyerPassword);
            \Log::info('Password check method 1 (Hash::check)', [
                'email' => $request->email,
                'result' => $passwordValid
            ]);
        } catch (\RuntimeException $e) {
            \Log::warning('Hash::check() failed, trying password_verify', [
                'email' => $request->email,
                'error' => $e->getMessage()
            ]);
        }
        
        // Method 2: If Hash::check() failed or returned false, try password_verify directly
        if (!$passwordValid) {
            $passwordValid = password_verify($request->password, $lawyerPassword);
            \Log::info('Password check method 2 (password_verify)', [
                'email' => $request->email,
                'result' => $passwordValid
            ]);
        }
        
        // Log detailed login attempt
        \Log::info('Lawyer login attempt result', [
            'email' => $request->email,
            'lawyer_id' => $lawyer->id,
            'password_valid' => $passwordValid,
            'status' => $lawyer->status,
            'email_verified' => $lawyer->email_verified_at != null,
            'password_hash_preview' => substr($lawyerPassword, 0, 20) . '...'
        ]);
        
        if ($passwordValid) {
            // Login the lawyer directly
            try {
                Auth::guard('lawyer')->login($lawyer, $request->lawyer_remember ?? false);
                
                \Log::info('Lawyer login successful', [
                    'email' => $request->email,
                    'lawyer_id' => $lawyer->id
                ]);

                $notification = __('Logged in successfully.');
                $notification = ['message' => $notification, 'alert-type' => 'success'];

                $intendedUrl = session()->get('url.intended');
                if ($intendedUrl && Str::contains($intendedUrl, '/lawyer')) {
                    return redirect()->intended(route('lawyer.dashboard'))->with($notification);
                }
                return redirect()->route('lawyer.dashboard')->with($notification);
            } catch (\Exception $e) {
                \Log::error('Lawyer login failed - Auth::login() exception', [
                    'email' => $request->email,
                    'lawyer_id' => $lawyer->id,
                    'error' => $e->getMessage()
                ]);
                
                $notification = __('Login failed. Please try again.');
                $notification = ['message' => $notification, 'alert-type' => 'error'];
                return redirect()->route('login', ['type' => 'lawyer'])->with($notification);
            }
        }

        \Log::warning('Lawyer login failed - invalid password', [
            'email' => $request->email,
            'lawyer_id' => $lawyer->id
        ]);

        $notification = __('Invalid Credentials');
        $notification = ['message' => $notification, 'alert-type' => 'error'];
        return redirect()->route('login', ['type' => 'lawyer'])->with($notification);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(): RedirectResponse {
        Auth::guard('lawyer')->logout();

        $notification = __('Logged out successfully.');
        $notification = ['message' => $notification, 'alert-type' => 'success'];

        return redirect()->route('login', ['type' => 'lawyer'])->with($notification);
    }
}
