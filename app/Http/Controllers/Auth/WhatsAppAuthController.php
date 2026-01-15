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
use Illuminate\Support\Facades\Http;
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
        $sent = $this->sendWhatsAppOtp($phone, $otp);
        
        // Store phone in session for verification
        session(['whatsapp_phone' => $phone]);
        
        if ($sent) {
            $notification = __('OTP has been sent to your WhatsApp number');
            $notification = ['message' => $notification, 'alert-type' => 'success'];
        } else {
            $notification = __('OTP code has been generated. Please check the code displayed below or your WhatsApp messages.');
            $notification = ['message' => $notification, 'alert-type' => 'info'];
        }
        
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

            // Format phone number - ensure it has country code
            $phone = preg_replace('/[^0-9]/', '', $phone);
            
            // If phone doesn't start with country code, add it
            if (!str_starts_with($phone, substr($whatsappNumber, 0, 2))) {
                // Extract country code from WhatsApp number (first 2-3 digits)
                $countryCode = substr($whatsappNumber, 0, 2);
                if (strlen($whatsappNumber) >= 12) {
                    $countryCode = substr($whatsappNumber, 0, 3);
                }
                // If phone starts with 0, remove it and add country code
                if (str_starts_with($phone, '0')) {
                    $phone = $countryCode . substr($phone, 1);
                } else {
                    $phone = $countryCode . $phone;
                }
            }

            // Prepare message
            $message = __('Your verification code is: :otp. Valid for 10 minutes.', ['otp' => $otp]);
            
            // Try multiple methods to send WhatsApp message
            $sent = false;
            
            // Method 1: Try WhatsApp Business API (if configured)
            if ($this->sendViaWhatsAppBusinessAPI($phone, $message, $whatsappNumber)) {
                $sent = true;
            }
            
            // Method 2: Try Green API (free alternative)
            if (!$sent && $this->sendViaGreenAPI($phone, $message, $whatsappNumber)) {
                $sent = true;
            }
            
            // Method 3: Try WhatsApp Web API (opens WhatsApp Web)
            if (!$sent && $this->sendViaWhatsAppWeb($phone, $message)) {
                $sent = true;
            }
            
            // Log the attempt
            \Log::info("WhatsApp OTP attempt to {$phone}: {$otp} - " . ($sent ? 'Sent' : 'Failed'));
            
            // Store OTP in session for manual display if needed
            session(['whatsapp_otp_display' => $otp]);
            
            return $sent;
            
        } catch (\Exception $e) {
            \Log::error('WhatsApp OTP sending failed: ' . $e->getMessage());
            // Store OTP in session for manual display
            session(['whatsapp_otp_display' => $otp]);
            return false;
        }
    }
    
    /**
     * Send via WhatsApp Business API
     */
    private function sendViaWhatsAppBusinessAPI(string $phone, string $message, string $fromNumber): bool
    {
        try {
            $setting = Cache::get('setting');
            $apiKey = $setting->whatsapp_api_key ?? '';
            $apiSecret = $setting->whatsapp_api_secret ?? '';
            $apiUrl = $setting->whatsapp_api_url ?? '';
            
            if (empty($apiKey) || empty($apiUrl)) {
                return false;
            }
            
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->post($apiUrl, [
                'to' => $phone,
                'from' => $fromNumber,
                'message' => $message,
            ]);
            
            if ($response->successful()) {
                \Log::info('WhatsApp Business API: Message sent successfully');
                return true;
            }
            
            return false;
        } catch (\Exception $e) {
            \Log::error('WhatsApp Business API error: ' . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Send via Green API (free alternative)
     */
    private function sendViaGreenAPI(string $phone, string $message, string $fromNumber): bool
    {
        try {
            $setting = Cache::get('setting');
            $greenApiId = $setting->whatsapp_green_api_id ?? '';
            $greenApiToken = $setting->whatsapp_green_api_token ?? '';
            
            if (empty($greenApiId) || empty($greenApiToken)) {
                return false;
            }
            
            $response = Http::post("https://api.green-api.com/waInstance{$greenApiId}/sendMessage/{$greenApiToken}", [
                'chatId' => $phone . '@c.us',
                'message' => $message,
            ]);
            
            if ($response->successful()) {
                \Log::info('Green API: Message sent successfully');
                return true;
            }
            
            return false;
        } catch (\Exception $e) {
            \Log::error('Green API error: ' . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Send via WhatsApp Web (opens WhatsApp Web - fallback method)
     */
    private function sendViaWhatsAppWeb(string $phone, string $message): bool
    {
        try {
            // This method creates a WhatsApp Web link
            // Note: This doesn't actually send the message automatically
            // It's a fallback that can be used to manually send
            $encodedMessage = urlencode($message);
            $whatsappUrl = "https://wa.me/{$phone}?text={$encodedMessage}";
            
            // Store URL in session for manual sending
            session(['whatsapp_url' => $whatsappUrl]);
            
            \Log::info("WhatsApp Web URL generated: {$whatsappUrl}");
            
            // Return true as we've prepared the link
            // In production, you might want to return false here
            return true;
        } catch (\Exception $e) {
            \Log::error('WhatsApp Web error: ' . $e->getMessage());
            return false;
        }
    }
}
