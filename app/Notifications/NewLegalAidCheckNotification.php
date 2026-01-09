<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class NewLegalAidCheckNotification extends Notification
{
    use Queueable;

    protected $legalAidCheck;

    public function __construct($legalAidCheck)
    {
        $this->legalAidCheck = $legalAidCheck;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'type' => 'new_legal_aid_check',
            'title' => __('New Legal Aid Check Request'),
            'message' => __('A new legal aid eligibility check has been submitted'),
            'name' => $this->legalAidCheck->name ?? __('Unknown'),
            'email' => $this->legalAidCheck->email ?? '',
            'legal_issue_type' => $this->legalAidCheck->legal_issue_type ?? '',
            'has_insurance' => $this->legalAidCheck->has_insurance ?? '',
            'income_range' => $this->legalAidCheck->income_range ?? '',
            'check_id' => $this->legalAidCheck->id,
            'url' => route('admin.contact-messages'),
        ];
    }
}

