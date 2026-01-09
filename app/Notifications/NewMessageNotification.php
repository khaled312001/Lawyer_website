<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use App\Models\Admin;
use App\Models\User;

class NewMessageNotification extends Notification
{
    use Queueable;

    protected $message;
    protected $senderName;
    protected $senderType;
    protected $conversationId;

    public function __construct($message, $senderName, $senderType = 'user', $conversationId = null)
    {
        $this->message = $message;
        $this->senderName = $senderName;
        $this->senderType = $senderType; // 'user', 'lawyer', or 'admin'
        $this->conversationId = $conversationId;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        // Determine sender label
        $senderLabel = __('Client');
        if ($this->senderType === 'lawyer') {
            $senderLabel = __('Lawyer');
        } elseif ($this->senderType === 'admin') {
            $senderLabel = __('Admin');
        }
        
        // Determine URL based on who is receiving the notification
        $url = route('admin.messages.index');
        if ($notifiable instanceof User) {
            // If user is receiving, link to client messages page
            if ($this->conversationId) {
                $url = route('client.messages.show', $this->conversationId);
            } else {
                $url = route('client.messages.index');
            }
        } elseif ($notifiable instanceof Admin) {
            // If admin is receiving, link to admin messages page
            if ($this->conversationId) {
                $url = route('admin.messages.show', $this->conversationId);
            } else {
                $url = route('admin.messages.index');
            }
        }
        
        return [
            'type' => 'new_message',
            'title' => __('New Message Received'),
            'message' => $senderLabel . ' ' . $this->senderName . ': ' . substr(strip_tags($this->message), 0, 100),
            'sender_name' => $this->senderName,
            'sender_type' => $this->senderType,
            'message_preview' => substr(strip_tags($this->message), 0, 100),
            'conversation_id' => $this->conversationId,
            'url' => $url,
        ];
    }
}

