<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class NewContactMessageNotification extends Notification
{
    use Queueable;

    protected $contactMessage;

    public function __construct($contactMessage)
    {
        $this->contactMessage = $contactMessage;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'type' => 'new_contact_message',
            'title' => __('New Contact Form Submission'),
            'message' => __('You have received a new message from') . ' ' . $this->contactMessage->name,
            'contact_name' => $this->contactMessage->name,
            'contact_email' => $this->contactMessage->email,
            'subject' => $this->contactMessage->subject,
            'message_preview' => substr(strip_tags($this->contactMessage->message), 0, 100),
            'url' => route('admin.contact-messages'),
        ];
    }
}

