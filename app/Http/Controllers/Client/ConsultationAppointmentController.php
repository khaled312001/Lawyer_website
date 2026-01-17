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
            'admin_id' => null, // Will be assigned by admin later
            'lawyer_id' => $request->lawyer_id, // Save selected lawyer
            'department_id' => $request->department_id,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'case_type' => $request->case_type,
            'case_details' => $request->case_details,
            'service' => $request->service,
            'property_id' => $request->property,
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
            $setting = Cache::get('setting');
            $lawyerName = $appointment->lawyer ? $appointment->lawyer->name : __('Not Selected');
            $clientPhone = $appointment->country_code . ' ' . $appointment->client_phone;
            
            $str_replace = [
                'client_name' => $appointment->client_name ?? $appointment->user->name ?? __('Unknown'),
                'client_email' => $appointment->client_email ?? $appointment->user->email ?? '',
                'client_phone' => $clientPhone,
                'client_city' => $appointment->client_city ?? '',
                'client_country' => $appointment->client_country ?? '',
                'lawyer_name' => $lawyerName,
                'case_type' => $appointment->case_type ?? '',
                'case_details' => $appointment->case_details ?? '',
                'appointment_date' => $appointment->appointment_date,
                'appointment_time' => $appointment->appointment_time,
                'service' => $appointment->service ?? '',
            ];
            
            // Try to use appointment_mail template, fallback to contact_mail if not exists
            try {
                [$subject, $message] = $this->fetchEmailTemplate('appointment_mail', $str_replace);
            } catch (\Exception $e) {
                // Fallback to contact_mail template
                [$subject, $message] = $this->fetchEmailTemplate('contact_mail', [
                    'name' => $appointment->client_name ?? $appointment->user->name ?? __('Unknown'),
                    'email' => $appointment->client_email ?? $appointment->user->email ?? '',
                    'phone' => $clientPhone,
                    'subject' => __('New Consultation Appointment Request'),
                    'message' => __('Client Name') . ': ' . ($appointment->client_name ?? $appointment->user->name ?? __('Unknown')) . "\n" .
                                __('Phone') . ': ' . $clientPhone . "\n" .
                                __('Lawyer') . ': ' . $lawyerName . "\n" .
                                __('Case Type') . ': ' . ($appointment->case_type ?? '') . "\n" .
                                __('Appointment Date') . ': ' . $appointment->appointment_date . "\n" .
                                __('Appointment Time') . ': ' . $appointment->appointment_time . "\n" .
                                __('Case Details') . ': ' . ($appointment->case_details ?? ''),
                ]);
            }
            
            $receiverEmail = $setting->contact_message_receiver_mail ?? $setting->mail_sender_email ?? '';
            if ($receiverEmail) {
                $this->sendMail($receiverEmail, $subject, $message);
            }
        } catch (\Exception $e) {
            info('Appointment email error: ' . $e->getMessage());
        }

        // Redirect based on whether user is logged in
        if ($user) {
            return redirect()->route('client.dashboard')
                ->with('success', __('Consultation appointment request submitted successfully. We will contact you soon.'));
        } else {
            return redirect()->route('website.book.consultation.appointment')
                ->with('success', __('Consultation appointment request submitted successfully. We will contact you soon.'));
        }
    }
}

