<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AdminAppointment;
use App\Notifications\NewAppointmentRequestNotification;
use App\Models\User;
use App\Traits\GlobalMailTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Modules\Lawyer\app\Models\Department;

class ConsultationAppointmentController extends Controller
{
    use GlobalMailTrait;
    
    public function store(Request $request)
    {
        $request->validate([
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required',
            'lawyer_id' => 'nullable|exists:lawyers,id',
            'department_id' => 'nullable|exists:departments,id',
            'case_type' => 'required|string|max:255',
            'case_details' => 'required|string',
            'service' => 'nullable|string|max:255',
            'property' => 'nullable|exists:real_estates,id',
            'country_code' => 'required|string',
            'client_name' => 'required|string|max:255',
            'client_email' => 'nullable|email|max:255',
            'client_phone' => 'required|string|max:255',
            'client_city' => 'nullable|string|max:255',
            'client_country' => 'nullable|string|max:255',
        ], [
            'appointment_date.required' => __('Appointment date is required'),
            'appointment_date.after_or_equal' => __('Appointment date must be today or later'),
            'appointment_time.required' => __('Appointment time is required'),
            'department_id.required' => __('Department is required'),
            'case_type.required' => __('Case type is required'),
            'case_details.required' => __('Case details are required'),
            'country_code.required' => __('Country code is required'),
            'client_name.required' => __('Client name is required'),
            'client_phone.required' => __('Client phone is required'),
        ]);

        $user = Auth::user();
        
        // If user is not logged in, user_id will be null
        $userId = $user ? $user->id : null;

        // Set default case_type based on service
        if ($request->service === 'real_estate') {
            $request->merge(['case_type' => $request->case_type ?: 'Real Estate Consultation']);
        }

        // Check if appointment already exists for this date and time
        $existingAppointment = AdminAppointment::where('appointment_date', $request->appointment_date)
            ->where('appointment_time', $request->appointment_time)
            ->where('status', '!=', 'cancelled')
            ->first();

        if ($existingAppointment) {
            return back()->withInput()->with('error', __('This time slot is already booked. Please choose another time.'));
        }

        $appointment = AdminAppointment::create([
            'user_id' => $userId,
            'admin_id' => null,
            'lawyer_id' => $request->lawyer_id,
            'department_id' => $request->department_id,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'case_type' => $request->case_type,
            'case_details' => $request->case_details,
            'country_code' => $request->country_code,
            'client_name' => $request->client_name,
            'client_phone' => $request->client_phone,
            'client_city' => $request->client_city,
            'client_country' => $request->client_country,
            'status' => 'pending',
        ]);

        // Send notification to all admins
        try {
            $admins = Admin::all();
            foreach ($admins as $admin) {
                $admin->notify(new NewAppointmentRequestNotification($appointment));
            }
        } catch (\Exception $e) {
            info('Admin notification error: ' . $e->getMessage());
        }

        // Send email to admin
        try {
            $lawyerName = $appointment->lawyer ? $appointment->lawyer->name : __('Not Selected');
            $clientPhone = $appointment->country_code . ' ' . $appointment->client_phone;
            $clientEmail = $request->client_email ?? '';
            
            $subject = '📋 طلب استشارة قانونية جديد - ' . ($appointment->client_name ?? 'عميل');
            
            $message = '<div style="direction:rtl;text-align:right;font-family:Arial,sans-serif;max-width:600px;margin:0 auto;">';
            $message .= '<div style="background:linear-gradient(135deg,#D4A574,#c9956a);padding:25px;border-radius:12px 12px 0 0;text-align:center;">';
            $message .= '<h1 style="color:#fff;margin:0;font-size:22px;">📋 طلب استشارة قانونية جديد</h1>';
            $message .= '</div>';
            $message .= '<div style="background:#fff;padding:30px;border:1px solid #eee;border-radius:0 0 12px 12px;">';
            $message .= '<table style="width:100%;border-collapse:collapse;">';
            $message .= '<tr><td style="padding:10px;font-weight:bold;color:#0b2c64;border-bottom:1px solid #f0f0f0;">👤 الاسم:</td><td style="padding:10px;border-bottom:1px solid #f0f0f0;">' . e($appointment->client_name) . '</td></tr>';
            if ($clientEmail) {
                $message .= '<tr><td style="padding:10px;font-weight:bold;color:#0b2c64;border-bottom:1px solid #f0f0f0;">📧 البريد:</td><td style="padding:10px;border-bottom:1px solid #f0f0f0;">' . e($clientEmail) . '</td></tr>';
            }
            $message .= '<tr><td style="padding:10px;font-weight:bold;color:#0b2c64;border-bottom:1px solid #f0f0f0;">📱 الهاتف:</td><td style="padding:10px;border-bottom:1px solid #f0f0f0;">' . e($clientPhone) . '</td></tr>';
            $message .= '<tr><td style="padding:10px;font-weight:bold;color:#0b2c64;border-bottom:1px solid #f0f0f0;">⚖️ المحامي:</td><td style="padding:10px;border-bottom:1px solid #f0f0f0;">' . e($lawyerName) . '</td></tr>';
            $message .= '<tr><td style="padding:10px;font-weight:bold;color:#0b2c64;border-bottom:1px solid #f0f0f0;">📂 نوع القضية:</td><td style="padding:10px;border-bottom:1px solid #f0f0f0;">' . e($appointment->case_type) . '</td></tr>';
            $message .= '<tr><td style="padding:10px;font-weight:bold;color:#0b2c64;border-bottom:1px solid #f0f0f0;">📅 التاريخ:</td><td style="padding:10px;border-bottom:1px solid #f0f0f0;">' . e($appointment->appointment_date) . '</td></tr>';
            $message .= '<tr><td style="padding:10px;font-weight:bold;color:#0b2c64;border-bottom:1px solid #f0f0f0;">🕐 الوقت:</td><td style="padding:10px;border-bottom:1px solid #f0f0f0;">' . e($appointment->appointment_time) . '</td></tr>';
            if ($appointment->client_city) {
                $message .= '<tr><td style="padding:10px;font-weight:bold;color:#0b2c64;border-bottom:1px solid #f0f0f0;">🏙️ المدينة:</td><td style="padding:10px;border-bottom:1px solid #f0f0f0;">' . e($appointment->client_city) . '</td></tr>';
            }
            if ($appointment->client_country) {
                $message .= '<tr><td style="padding:10px;font-weight:bold;color:#0b2c64;border-bottom:1px solid #f0f0f0;">🌍 الدولة:</td><td style="padding:10px;border-bottom:1px solid #f0f0f0;">' . e($appointment->client_country) . '</td></tr>';
            }
            $message .= '</table>';
            $message .= '<div style="background:#f8f9fa;padding:15px;border-radius:8px;margin-top:20px;">';
            $message .= '<h3 style="color:#0b2c64;margin:0 0 10px;">📝 تفاصيل القضية:</h3>';
            $message .= '<p style="margin:0;line-height:1.8;">' . nl2br(e($appointment->case_details)) . '</p>';
            $message .= '</div>';
            $message .= '</div></div>';

            $receiverEmail = config('mail.from.address', 'info@amanlaw.ch');
            $setting = Cache::get('setting');
            if ($setting && ($setting->contact_message_receiver_mail ?? null)) {
                $receiverEmail = $setting->contact_message_receiver_mail;
            }
            
            $this->sendMail($receiverEmail, $subject, $message);
        } catch (\Exception $e) {
            info('Appointment email error: ' . $e->getMessage());
        }

        // Redirect based on whether user is logged in
        if ($user) {
            return redirect()->route('client.dashboard')
                ->with('success', __('Consultation appointment request submitted successfully. We will contact you soon.'));
        } else {
            return back()->with('success', __('تم إرسال طلب الاستشارة بنجاح. سنتواصل معك قريباً لتأكيد الموعد.'));
        }
    }

    /**
     * Store a lawyer join request and send email to admin
     */
    public function storeLawyerRequest(Request $request)
    {
        $request->validate([
            'lawyer_name' => 'required|string|max:255',
            'lawyer_email' => 'required|email|max:255',
            'country_code' => 'required|string',
            'lawyer_phone' => 'required|string|max:255',
            'specialization' => 'required|string|max:255',
            'experience_years' => 'required|integer|min:0|max:60',
            'lawyer_location' => 'required|string|max:255',
            'lawyer_bio' => 'required|string',
        ], [
            'lawyer_name.required' => __('الاسم مطلوب'),
            'lawyer_email.required' => __('البريد الإلكتروني مطلوب'),
            'lawyer_email.email' => __('يرجى إدخال بريد إلكتروني صحيح'),
            'lawyer_phone.required' => __('رقم الهاتف مطلوب'),
            'specialization.required' => __('التخصص القانوني مطلوب'),
            'experience_years.required' => __('سنوات الخبرة مطلوبة'),
            'lawyer_location.required' => __('الموقع مطلوب'),
            'lawyer_bio.required' => __('النبذة عنك مطلوبة'),
        ]);

        // Build HTML email
        $phone = $request->country_code . ' ' . $request->lawyer_phone;
        
        $subject = '👨‍⚖️ طلب انضمام محامي جديد - ' . $request->lawyer_name;
        
        $message = '<div style="direction:rtl;text-align:right;font-family:Arial,sans-serif;max-width:600px;margin:0 auto;">';
        $message .= '<div style="background:linear-gradient(135deg,#0b2c64,#1a3d7a);padding:25px;border-radius:12px 12px 0 0;text-align:center;">';
        $message .= '<h1 style="color:#fff;margin:0;font-size:22px;">👨‍⚖️ طلب انضمام محامي جديد</h1>';
        $message .= '</div>';
        $message .= '<div style="background:#fff;padding:30px;border:1px solid #eee;border-radius:0 0 12px 12px;">';
        $message .= '<table style="width:100%;border-collapse:collapse;">';
        $message .= '<tr><td style="padding:10px;font-weight:bold;color:#0b2c64;border-bottom:1px solid #f0f0f0;">👤 الاسم:</td><td style="padding:10px;border-bottom:1px solid #f0f0f0;">' . e($request->lawyer_name) . '</td></tr>';
        $message .= '<tr><td style="padding:10px;font-weight:bold;color:#0b2c64;border-bottom:1px solid #f0f0f0;">📧 البريد:</td><td style="padding:10px;border-bottom:1px solid #f0f0f0;">' . e($request->lawyer_email) . '</td></tr>';
        $message .= '<tr><td style="padding:10px;font-weight:bold;color:#0b2c64;border-bottom:1px solid #f0f0f0;">📱 الهاتف:</td><td style="padding:10px;border-bottom:1px solid #f0f0f0;">' . e($phone) . '</td></tr>';
        $message .= '<tr><td style="padding:10px;font-weight:bold;color:#0b2c64;border-bottom:1px solid #f0f0f0;">⚖️ التخصص:</td><td style="padding:10px;border-bottom:1px solid #f0f0f0;">' . e($request->specialization) . '</td></tr>';
        $message .= '<tr><td style="padding:10px;font-weight:bold;color:#0b2c64;border-bottom:1px solid #f0f0f0;">💼 سنوات الخبرة:</td><td style="padding:10px;border-bottom:1px solid #f0f0f0;">' . e($request->experience_years) . ' ' . __('سنة') . '</td></tr>';
        $message .= '<tr><td style="padding:10px;font-weight:bold;color:#0b2c64;border-bottom:1px solid #f0f0f0;">📍 الموقع:</td><td style="padding:10px;border-bottom:1px solid #f0f0f0;">' . e($request->lawyer_location) . '</td></tr>';
        $message .= '</table>';
        $message .= '<div style="background:#f8f9fa;padding:15px;border-radius:8px;margin-top:20px;">';
        $message .= '<h3 style="color:#0b2c64;margin:0 0 10px;">📝 نبذة عن المحامي:</h3>';
        $message .= '<p style="margin:0;line-height:1.8;">' . nl2br(e($request->lawyer_bio)) . '</p>';
        $message .= '</div>';
        $message .= '</div></div>';

        // Send email to admin
        try {
            $receiverEmail = config('mail.from.address', 'info@amanlaw.ch');
            $setting = Cache::get('setting');
            if ($setting && ($setting->contact_message_receiver_mail ?? null)) {
                $receiverEmail = $setting->contact_message_receiver_mail;
            }
            
            $this->sendMail($receiverEmail, $subject, $message);
        } catch (\Exception $e) {
            info('Lawyer join email error: ' . $e->getMessage());
        }

        return back()->with('success', __('تم إرسال طلب الانضمام بنجاح. سنتواصل معك قريباً.'));
    }
}
