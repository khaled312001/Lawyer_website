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
        $setting = Cache::get('setting');

        $rules = [
            'email'                => 'required|email',
            'password'             => 'required',
            'g-recaptcha-response' => $setting && $setting->recaptcha_status == 'active' ? ['required', new CustomRecaptcha()] : '',
        ];

        $customMessages = [
            'email.required'                => __('Email is required'),
            'password.required'             => __('Password is required'),
            'g-recaptcha-response.required' => __('Please complete the recaptcha to submit the form'),
        ];
        
        try {
            $this->validate($request, $rules, $customMessages);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->route('login', ['type' => 'lawyer'])
                ->withErrors($e->errors())
                ->withInput($request->only('email'));
        }

        $lawyer = Lawyer::where('email', $request->email)->first();

        if (!$lawyer) {
            $notification = __('Invalid Credentials');
            $notification = ['message' => $notification, 'alert-type' => 'error'];
            return redirect()->route('login', ['type' => 'lawyer'])->with($notification);
        }

        if ($lawyer->status != LawyerStatus::ACTIVE->value) {
            $notification = __('Inactive account');
            $notification = ['message' => $notification, 'alert-type' => 'error'];
            return redirect()->route('login', ['type' => 'lawyer'])->with($notification);
        }

        if ($lawyer->email_verified_at == null) {
            $notification = __('Please verify your email');
            $notification = ['message' => $notification, 'alert-type' => 'error'];
            return redirect()->route('login', ['type' => 'lawyer'])->with($notification);
        }

        // Get the raw password hash from database to avoid issues with 'hashed' cast
        $lawyerPassword = $lawyer->getRawOriginal('password');
        
        // Verify password manually with error handling
        $passwordValid = false;
        try {
            $passwordValid = Hash::check($request->password, $lawyerPassword);
        } catch (\RuntimeException $e) {
            // If there's an algorithm error, try using password_verify directly
            if (str_contains($e->getMessage(), 'Bcrypt algorithm')) {
                $passwordValid = password_verify($request->password, $lawyerPassword);
            } else {
                // Log the error for debugging
                \Log::error('Password verification error: ' . $e->getMessage(), [
                    'email' => $request->email,
                    'lawyer_id' => $lawyer->id
                ]);
                throw $e;
            }
        }
        
        if ($passwordValid) {
            // Login the lawyer directly
            Auth::guard('lawyer')->login($lawyer, $request->lawyer_remember ?? false);

            $notification = __('Logged in successfully.');
            $notification = ['message' => $notification, 'alert-type' => 'success'];

            $intendedUrl = session()->get('url.intended');
            if ($intendedUrl && Str::contains($intendedUrl, '/lawyer')) {
                return redirect()->intended(route('lawyer.dashboard'))->with($notification);
            }
            return redirect()->route('lawyer.dashboard')->with($notification);
        }

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
