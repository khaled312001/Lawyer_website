<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class NewMessageNotification extends Notification
{
    use Queueable;

    protected $message;
    protected $senderName;
    protected $senderType;

    public function __construct($message, $senderName, $senderType = 'user')
    {
        $this->message = $message;
        $this->senderName = $senderName;
        $this->senderType = $senderType; // 'user' or 'lawyer'
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        $senderLabel = $this->senderType === 'lawyer' ? __('Lawyer') : __('Client');
        
        return [
            'type' => 'new_message',
            'title' => __('New Message Received'),
            'message' => $senderLabel . ' ' . $this->senderName . ': ' . substr(strip_tags($this->message), 0, 100),
            'sender_name' => $this->senderName,
            'sender_type' => $this->senderType,
            'message_preview' => substr(strip_tags($this->message), 0, 100),
            'url' => route('admin.messages.index'),
        ];
    }
}

