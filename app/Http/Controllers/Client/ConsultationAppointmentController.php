<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AdminAppointment;
use App\Models\LawyerJoinRequest;
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
            
            $subject = 'Aman Law - طلب استشارة قانونية جديد من ' . ($appointment->client_name ?? 'عميل');
            
            $message = $this->buildConsultationEmail(
                $appointment->client_name,
                $clientEmail,
                $clientPhone,
                $lawyerName,
                $appointment->case_type,
                $appointment->appointment_date,
                $appointment->appointment_time,
                $appointment->client_city,
                $appointment->client_country,
                $appointment->case_details
            );

            $receiverEmail = 'info@amanlaw.ch';
            $setting = Cache::get('setting');
            if ($setting && ($setting->contact_message_receiver_mail ?? null)) {
                $receiverEmail = $setting->contact_message_receiver_mail;
            }
            
            $this->sendRawHtmlMail($receiverEmail, $subject, $message);
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
            'lawyer_name'      => 'required|string|max:255',
            'lawyer_email'     => 'required|email|max:255',
            'country_code'     => 'required|string',
            'lawyer_phone'     => 'required|string|max:255',
            'specialization'   => 'required|string|max:255',
            'experience_years' => 'required|integer|min:0|max:60',
            'lawyer_location'  => 'required|string|max:255',
            'lawyer_bio'       => 'required|string',
            'cv_file'          => 'required|file|mimes:pdf,doc,docx|max:5120',
        ], [
            'lawyer_name.required'      => __('الاسم مطلوب'),
            'lawyer_email.required'     => __('البريد الإلكتروني مطلوب'),
            'lawyer_email.email'        => __('يرجى إدخال بريد إلكتروني صحيح'),
            'lawyer_phone.required'     => __('رقم الهاتف مطلوب'),
            'specialization.required'   => __('التخصص القانوني مطلوب'),
            'experience_years.required' => __('سنوات الخبرة مطلوبة'),
            'lawyer_location.required'  => __('الموقع مطلوب'),
            'lawyer_bio.required'       => __('النبذة عنك مطلوبة'),
            'cv_file.required'          => __('السيرة الذاتية مطلوبة'),
            'cv_file.mimes'             => __('يجب أن يكون الملف بصيغة PDF أو Word'),
            'cv_file.max'               => __('حجم الملف يجب ألا يتجاوز 5 ميغابايت'),
        ]);

        // Store the CV file
        $cvPath = $request->file('cv_file')->store('lawyer-cvs', 'public');

        // Save request to database
        $joinRequest = LawyerJoinRequest::create([
            'lawyer_name'      => $request->lawyer_name,
            'lawyer_email'     => $request->lawyer_email,
            'country_code'     => $request->country_code,
            'lawyer_phone'     => $request->lawyer_phone,
            'specialization'   => $request->specialization,
            'experience_years' => $request->experience_years,
            'lawyer_location'  => $request->lawyer_location,
            'lawyer_bio'       => $request->lawyer_bio,
            'cv_path'          => $cvPath,
            'status'           => 'pending',
        ]);

        $cvOriginalName = $request->file('cv_file')->getClientOriginalName();
        $cvFullPath     = storage_path('app/public/' . $cvPath);

        // Build HTML email
        $phone   = $request->country_code . ' ' . $request->lawyer_phone;
        $subject = 'Aman Law - طلب انضمام محامي جديد: ' . $request->lawyer_name;

        $htmlBody = $this->buildLawyerJoinEmail(
            $request->lawyer_name,
            $request->lawyer_email,
            $phone,
            $request->specialization,
            $request->experience_years,
            $request->lawyer_location,
            $request->lawyer_bio
        );

        // Send email via direct SMTP with CV attachment
        try {
            $receiverEmail = 'info@amanlaw.ch';
            $setting = Cache::get('setting');
            if ($setting && ($setting->contact_message_receiver_mail ?? null)) {
                $receiverEmail = $setting->contact_message_receiver_mail;
            }
            $this->sendSmtpWithAttachment($receiverEmail, $subject, $htmlBody, $cvFullPath, $cvOriginalName);
        } catch (\Exception $e) {
            info('Lawyer join email error: ' . $e->getMessage());
        }

        return back()->with('success', __('تم إرسال طلب الانضمام بنجاح. سنتواصل معك قريباً.'));
    }

    /**
     * Send raw HTML email bypassing the global mail template
     */
    private function sendRawHtmlMail($to, $subject, $htmlBody)
    {
        Mail::html($htmlBody, function ($msg) use ($to, $subject) {
            $msg->to($to)
                ->subject($subject);

            $setting = Cache::get('setting');
            $fromEmail = $setting?->mail_sender ?? config('mail.from.address', 'info@amanlaw.ch');
            $fromName  = $setting?->app_name ?? 'Aman Law';
            $msg->from($fromEmail, $fromName);
        });
    }

    /**
     * Build professional HTML email for consultation request
     */
    private function buildConsultationEmail($name, $email, $phone, $lawyer, $caseType, $date, $time, $city, $country, $details)
    {
        $rows = [
            ['الاسم الكامل', e($name)],
        ];
        if ($email) $rows[] = ['البريد الإلكتروني', e($email)];
        $rows[] = ['رقم الهاتف', '<span dir="ltr">' . e($phone) . '</span>'];
        $rows[] = ['المحامي المطلوب', e($lawyer)];
        $rows[] = ['نوع القضية', e($caseType)];
        $rows[] = ['تاريخ الموعد', e($date)];
        $rows[] = ['وقت الموعد', e($time)];
        if ($city) $rows[] = ['المدينة', e($city)];
        if ($country) $rows[] = ['الدولة', e($country)];

        return $this->buildEmailLayout(
            'طلب استشارة قانونية جديد',
            'تم استلام طلب استشارة قانونية جديد عبر الموقع الإلكتروني. يرجى مراجعة التفاصيل أدناه والتواصل مع العميل.',
            '#D4A574',
            '#c9956a',
            $rows,
            'تفاصيل القضية',
            nl2br(e($details))
        );
    }

    /**
     * Build professional HTML email for lawyer join request
     */
    private function buildLawyerJoinEmail($name, $email, $phone, $specialization, $years, $location, $bio)
    {
        $rows = [
            ['الاسم الكامل', e($name)],
            ['البريد الإلكتروني', '<a href="mailto:' . e($email) . '">' . e($email) . '</a>'],
            ['رقم الهاتف', '<span dir="ltr">' . e($phone) . '</span>'],
            ['التخصص القانوني', e($specialization)],
            ['سنوات الخبرة', e($years) . ' سنة'],
            ['الموقع', e($location)],
        ];

        return $this->buildEmailLayout(
            'طلب انضمام محامي جديد',
            'تم استلام طلب انضمام محامي جديد لفريق أمان لو. السيرة الذاتية مرفقة بهذا الإيميل.',
            '#0b2c64',
            '#1a3d7a',
            $rows,
            'نبذة عن المحامي وخبراته',
            nl2br(e($bio))
        );
    }

    /**
     * Send email with attachment via direct SMTP socket (bypasses Laravel Mail facade issues)
     */
    private function sendSmtpWithAttachment($to, $subject, $htmlBody, $attachPath, $attachName)
    {
        $host    = config('mail.mailers.smtp.host', 'smtp.hostinger.com');
        $port    = config('mail.mailers.smtp.port', 465);
        $user    = config('mail.mailers.smtp.username', 'info@amanlaw.ch');
        $pass    = config('mail.mailers.smtp.password', '');
        $from    = config('mail.from.address', 'info@amanlaw.ch');
        $fromName = config('mail.from.name', 'Aman Law');
        $enc     = config('mail.mailers.smtp.encryption', 'ssl');

        $scheme  = $enc === 'ssl' ? 'ssl' : 'tcp';
        $context = stream_context_create(['ssl' => ['verify_peer' => false, 'verify_peer_name' => false]]);
        $smtp    = stream_socket_client("{$scheme}://{$host}:{$port}", $errno, $errstr, 15, STREAM_CLIENT_CONNECT, $context);

        if (!$smtp) throw new \Exception("SMTP connect failed: {$errno} {$errstr}");

        $read = fn() => fgets($smtp, 512);
        $send = fn($cmd) => fwrite($smtp, $cmd . "\r\n");

        $read(); // banner
        $send('EHLO amanlaw.ch');
        while ($l = $read()) { if ($l[3] == ' ') break; }

        // If TLS
        if ($enc === 'tls') {
            $send('STARTTLS');
            $read();
            stream_socket_enable_crypto($smtp, true, STREAM_CRYPTO_METHOD_TLS_CLIENT);
            $send('EHLO amanlaw.ch');
            while ($l = $read()) { if ($l[3] == ' ') break; }
        }

        $send('AUTH LOGIN');
        $read();
        $send(base64_encode($user));
        $read();
        $send(base64_encode($pass));
        $authResp = $read();

        if ((int)substr($authResp, 0, 3) !== 235) {
            fclose($smtp);
            throw new \Exception('SMTP AUTH failed: ' . trim($authResp));
        }

        $send("MAIL FROM:<{$from}>");  $read();
        $send("RCPT TO:<{$to}>");      $read();
        $send('DATA');                 $read();

        $boundary    = md5(uniqid());
        $subjectB64  = '=?UTF-8?B?' . base64_encode($subject) . '?=';
        $attachData  = file_exists($attachPath) ? chunk_split(base64_encode(file_get_contents($attachPath))) : '';
        $attachMime  = str_ends_with(strtolower($attachName), '.pdf') ? 'application/pdf'
                     : 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';

        $msg  = "From: =?UTF-8?B?" . base64_encode($fromName) . "?= <{$from}>\r\n";
        $msg .= "To: {$to}\r\n";
        $msg .= "Subject: {$subjectB64}\r\n";
        $msg .= "MIME-Version: 1.0\r\n";
        $msg .= "Content-Type: multipart/mixed; boundary=\"{$boundary}\"\r\n\r\n";

        // HTML part
        $msg .= "--{$boundary}\r\n";
        $msg .= "Content-Type: text/html; charset=UTF-8\r\n";
        $msg .= "Content-Transfer-Encoding: base64\r\n\r\n";
        $msg .= chunk_split(base64_encode($htmlBody)) . "\r\n";

        // Attachment part
        if ($attachData) {
            $msg .= "--{$boundary}\r\n";
            $msg .= "Content-Type: {$attachMime}; name=\"" . addslashes($attachName) . "\"\r\n";
            $msg .= "Content-Transfer-Encoding: base64\r\n";
            $msg .= "Content-Disposition: attachment; filename=\"" . addslashes($attachName) . "\"\r\n\r\n";
            $msg .= $attachData . "\r\n";
        }

        $msg .= "--{$boundary}--\r\n";
        $msg .= "\r\n.\r\n";

        fwrite($smtp, $msg);
        $sendResp = $read();
        $send('QUIT');
        fclose($smtp);

        if ((int)substr($sendResp, 0, 3) !== 250) {
            throw new \Exception('SMTP send failed: ' . trim($sendResp));
        }
    }

    /**
     * Build the shared professional email HTML layout
     */
    private function buildEmailLayout($title, $subtitle, $color1, $color2, $rows, $detailsTitle, $detailsContent)
    {
        $date = date('Y-m-d H:i');
        
        $html = '<!DOCTYPE html><html dir="rtl" lang="ar"><head><meta charset="UTF-8"></head><body style="margin:0;padding:0;background:#f0f2f5;font-family:Tahoma,Arial,sans-serif;">';
        $html .= '<table width="100%" cellpadding="0" cellspacing="0" style="background:#f0f2f5;padding:30px 0;">';
        $html .= '<tr><td align="center">';
        $html .= '<table width="620" cellpadding="0" cellspacing="0" style="max-width:620px;width:100%;">';
        
        // Header
        $html .= '<tr><td style="background:linear-gradient(135deg,' . $color1 . ',' . $color2 . ');padding:35px 30px;border-radius:16px 16px 0 0;text-align:center;">';
        $html .= '<h1 style="color:#fff;margin:0 0 8px;font-size:24px;font-weight:700;">' . $title . '</h1>';
        $html .= '<p style="color:rgba(255,255,255,0.85);margin:0;font-size:14px;">Aman Law | أمان لو</p>';
        $html .= '</td></tr>';
        
        // Subtitle bar
        $html .= '<tr><td style="background:#fff;padding:18px 30px;border-bottom:2px solid ' . $color1 . ';">';
        $html .= '<p style="margin:0;color:#555;font-size:14px;line-height:1.7;">' . $subtitle . '</p>';
        $html .= '</td></tr>';
        
        // Data table
        $html .= '<tr><td style="background:#fff;padding:5px 30px 25px;">';
        $html .= '<table width="100%" cellpadding="0" cellspacing="0" style="border:1px solid #e8e8e8;border-radius:10px;overflow:hidden;margin-top:15px;">';
        
        // Table header
        $html .= '<tr><td colspan="2" style="background:' . $color1 . ';padding:12px 18px;">';
        $html .= '<strong style="color:#fff;font-size:15px;">بيانات الطلب</strong>';
        $html .= '</td></tr>';
        
        foreach ($rows as $i => $row) {
            $bgColor = ($i % 2 === 0) ? '#fafbfc' : '#ffffff';
            $html .= '<tr style="background:' . $bgColor . ';">';
            $html .= '<td style="padding:13px 18px;font-weight:600;color:' . $color1 . ';font-size:14px;width:40%;border-bottom:1px solid #f0f0f0;white-space:nowrap;">' . $row[0] . '</td>';
            $html .= '<td style="padding:13px 18px;color:#333;font-size:14px;border-bottom:1px solid #f0f0f0;">' . $row[1] . '</td>';
            $html .= '</tr>';
        }
        
        $html .= '</table>';
        $html .= '</td></tr>';
        
        // Details section
        $html .= '<tr><td style="background:#fff;padding:0 30px 30px;">';
        $html .= '<div style="background:#f7f8fa;border:1px solid #e8e8e8;border-radius:10px;padding:20px;">';
        $html .= '<h3 style="color:' . $color1 . ';margin:0 0 12px;font-size:15px;border-bottom:2px solid ' . $color1 . ';padding-bottom:8px;display:inline-block;">' . $detailsTitle . '</h3>';
        $html .= '<p style="margin:0;color:#444;font-size:14px;line-height:2;">' . $detailsContent . '</p>';
        $html .= '</div>';
        $html .= '</td></tr>';
        
        // Footer
        $html .= '<tr><td style="background:#0a1f3f;padding:22px 30px;border-radius:0 0 16px 16px;text-align:center;">';
        $html .= '<p style="color:rgba(255,255,255,0.7);margin:0 0 5px;font-size:12px;">تم الإرسال بتاريخ ' . $date . '</p>';
        $html .= '<p style="color:rgba(255,255,255,0.5);margin:0;font-size:11px;">&copy; ' . date('Y') . ' Aman Law | أمان لو - منصة قانونية مُدارة من سويسرا</p>';
        $html .= '</td></tr>';
        
        $html .= '</table>';
        $html .= '</td></tr></table>';
        $html .= '</body></html>';
        
        return $html;
    }
}
