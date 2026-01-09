<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class NewAppointmentNotification extends Notification
{
    use Queueable;

    protected $appointment;
    protected $forLawyer;

    public function __construct($appointment, $forLawyer = false)
    {
        $this->appointment = $appointment;
        $this->forLawyer = $forLawyer;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        if ($this->forLawyer) {
            // Notification for lawyer
            return [
                'type' => 'new_appointment',
                'title' => __('New Appointment'),
                'message' => __('You have a new appointment with') . ' ' . ($this->appointment->user->name ?? __('Client')),
                'appointment_id' => $this->appointment->id,
                'client_name' => $this->appointment->user->name ?? __('Unknown'),
                'appointment_date' => $this->appointment->date,
                'appointment_time' => $this->appointment->schedule->start_time ?? '',
                'url' => route('lawyer.today.appointment'),
            ];
        } else {
            // Notification for client
            return [
                'type' => 'new_appointment',
                'title' => __('New Appointment Scheduled'),
                'message' => __('Your appointment with') . ' ' . ($this->appointment->lawyer->name ?? __('Lawyer')) . ' ' . __('has been scheduled'),
                'appointment_id' => $this->appointment->id,
                'lawyer_name' => $this->appointment->lawyer->name ?? __('Unknown'),
                'appointment_date' => $this->appointment->date,
                'appointment_time' => $this->appointment->schedule->start_time ?? '',
                'url' => route('client.appointment'),
            ];
        }
    }
}

