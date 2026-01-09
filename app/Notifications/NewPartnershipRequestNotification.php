<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class NewPartnershipRequestNotification extends Notification
{
    use Queueable;

    protected $partnershipRequest;

    public function __construct($partnershipRequest)
    {
        $this->partnershipRequest = $partnershipRequest;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        $partnershipTypes = [
            'law_firm' => __('Law Firm'),
            'legal_tech' => __('Legal Tech Company'),
            'business' => __('Business Partner'),
            'other' => __('Other'),
        ];

        return [
            'type' => 'new_partnership_request',
            'title' => __('New Partnership Request'),
            'message' => __('A new partnership request has been submitted by') . ' ' . $this->partnershipRequest->name,
            'request_name' => $this->partnershipRequest->name,
            'request_email' => $this->partnershipRequest->email,
            'company' => $this->partnershipRequest->company,
            'partnership_type' => $partnershipTypes[$this->partnershipRequest->partnership_type] ?? $this->partnershipRequest->partnership_type,
            'message_preview' => substr(strip_tags($this->partnershipRequest->message), 0, 100),
            'request_id' => $this->partnershipRequest->id,
            'url' => route('admin.partnership-requests.show', $this->partnershipRequest->id),
        ];
    }
}

