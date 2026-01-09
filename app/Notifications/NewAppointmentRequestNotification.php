<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class NewAppointmentRequestNotification extends Notification
{
    use Queueable;

    protected $appointment;

    public function __construct($appointment)
    {
        $this->appointment = $appointment;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'type' => 'new_appointment_request',
            'title' => __('New Consultation Appointment Request'),
            'message' => __('A new consultation appointment has been requested by') . ' ' . ($this->appointment->client_name ?? $this->appointment->user->name ?? __('Unknown')),
            'client_name' => $this->appointment->client_name ?? $this->appointment->user->name ?? __('Unknown'),
            'client_email' => $this->appointment->client_email ?? $this->appointment->user->email ?? '',
            'appointment_date' => $this->appointment->appointment_date,
            'appointment_time' => $this->appointment->appointment_time,
            'appointment_id' => $this->appointment->id,
            'url' => route('admin.consultation-appointments.show', $this->appointment->id),
        ];
    }
}

