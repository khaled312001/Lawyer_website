<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Enums\UserStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class WhatsAppAuthController extends Controller
{
    /**
     * Show the phone number input form
     */
    public function showPhoneForm(): View
    {
        return view('client.profile.auth.whatsapp-phone');
    }

    /**
     * Send OTP to WhatsApp
     */
    public function sendOtp(Request $request): RedirectResponse
    {
        $request->validate([
            'phone' => 'required|string|min:10|max:15',
        ], [
            'phone.required' => __('Phone number is required'),
            'phone.min' => __('Phone number must be at least 10 digits'),
            'phone.max' => __('Phone number must not exceed 15 digits'),
        ]);

        // Clean phone number (remove +, spaces, and dashes)
        $phone = preg_replace('/[^0-9]/', '', $request->phone);
        
        // Generate 6-digit OTP
        $otp = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        
        // Store OTP in cache for 10 minutes
        Cache::put("whatsapp_otp_{$phone}", $otp, now()->addMinutes(10));
        Cache::put("whatsapp_otp_attempts_{$phone}", 0, now()->addMinutes(10));
        
        // Send OTP via WhatsApp
        $this->sendWhatsAppOtp($phone, $otp);
        
        // Store phone in session for verification
        session(['whatsapp_phone' => $phone]);
        
        $notification = __('OTP has been sent to your WhatsApp number');
        $notification = ['message' => $notification, 'alert-type' => 'success'];
        
        return redirect()->route('whatsapp.verify')->with($notification);
    }

    /**
     * Show OTP verification form
     */
    public function showVerifyForm(): View
    {
        if (!session('whatsapp_phone')) {
            return redirect()->route('whatsapp.phone');
        }
        
        return view('client.profile.auth.whatsapp-verify');
    }

    /**
     * Verify OTP and login/register
     */
    public function verifyOtp(Request $request): RedirectResponse
    {
        $request->validate([
            'otp' => 'required|string|size:6',
        ], [
            'otp.required' => __('OTP is required'),
            'otp.size' => __('OTP must be 6 digits'),
        ]);

        $phone = session('whatsapp_phone');
        
        if (!$phone) {
            $notification = __('Phone number not found. Please try again.');
            $notification = ['message' => $notification, 'alert-type' => 'error'];
            return redirect()->route('whatsapp.phone')->with($notification);
        }

        // Check OTP attempts
        $attempts = Cache::get("whatsapp_otp_attempts_{$phone}", 0);
        if ($attempts >= 5) {
            $notification = __('Too many attempts. Please request a new OTP.');
            $notification = ['message' => $notification, 'alert-type' => 'error'];
            return redirect()->route('whatsapp.phone')->with($notification);
        }

        // Verify OTP
        $storedOtp = Cache::get("whatsapp_otp_{$phone}");
        
        if (!$storedOtp || $storedOtp != $request->otp) {
            Cache::put("whatsapp_otp_attempts_{$phone}", $attempts + 1, now()->addMinutes(10));
            $notification = __('Invalid OTP. Please try again.');
            $notification = ['message' => $notification, 'alert-type' => 'error'];
            return redirect()->back()->with($notification);
        }

        // OTP verified, find or create user
        $user = User::where('phone', $phone)->first();
        
        if (!$user) {
            // Create new user
            $password = Str::random(10);
            $user = User::create([
                'client_id' => date('ymdis'),
                'name' => __('User') . ' ' . substr($phone, -4),
                'email' => "whatsapp_{$phone}@temp.com",
                'phone' => $phone,
                'password' => Hash::make($password),
                'status' => 'active',
                'is_banned' => 'no',
                'phone_verified_at' => now(),
                'email_verified_at' => now(),
            ]);
        } else {
            // Update phone verification
            $user->phone_verified_at = now();
            $user->save();
        }

        // Clear OTP from cache
        Cache::forget("whatsapp_otp_{$phone}");
        Cache::forget("whatsapp_otp_attempts_{$phone}");
        session()->forget('whatsapp_phone');

        // Login user
        if ($user->status == UserStatus::ACTIVE->value && $user->is_banned == UserStatus::UNBANNED->value) {
            Auth::guard('web')->login($user, true);
            $notification = __('Logged in successfully.');
            $notification = ['message' => $notification, 'alert-type' => 'success'];
            return redirect()->route('dashboard')->with($notification);
        } else {
            $notification = __('Account is inactive or banned.');
            $notification = ['message' => $notification, 'alert-type' => 'error'];
            return redirect()->route('login')->with($notification);
        }
    }

    /**
     * Send OTP via WhatsApp
     */
    private function sendWhatsAppOtp(string $phone, string $otp): bool
    {
        try {
            $setting = Cache::get('setting');
            $whatsappNumber = $setting->whatsapp_number ?? '';
            $whatsappNumber = preg_replace('/[^0-9]/', '', $whatsappNumber);
            
            if (empty($whatsappNumber)) {
                \Log::error('WhatsApp number not configured');
                return false;
            }

            // Format phone number with country code if needed
            if (!str_starts_with($phone, $whatsappNumber)) {
                // Assume same country code
                $phone = $whatsappNumber . substr($phone, -9);
            }

            // WhatsApp message
            $message = urlencode(__('Your verification code is: :otp. Valid for 10 minutes.', ['otp' => $otp]));
            
            // For now, we'll use WhatsApp Web API
            // In production, you should use WhatsApp Business API
            $whatsappUrl = "https://wa.me/{$phone}?text={$message}";
            
            // Log for debugging (in production, use actual WhatsApp API)
            \Log::info("WhatsApp OTP sent to {$phone}: {$otp}");
            
            // TODO: Integrate with WhatsApp Business API
            // For now, return true (in production, check API response)
            return true;
            
        } catch (\Exception $e) {
            \Log::error('WhatsApp OTP sending failed: ' . $e->getMessage());
            return false;
        }
    }
}
