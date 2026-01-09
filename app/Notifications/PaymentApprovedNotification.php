<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class PaymentApprovedNotification extends Notification
{
    use Queueable;

    protected $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'type' => 'payment_approved',
            'title' => __('Payment Approved'),
            'message' => __('Your payment for order') . ' ' . $this->order->order_id . ' ' . __('has been approved'),
            'order_id' => $this->order->id,
            'order_number' => $this->order->order_id,
            'amount' => $this->order->total_payment,
            'currency' => $this->order->payable_currency ?? 'USD',
            'url' => route('client.order'),
        ];
    }
}

