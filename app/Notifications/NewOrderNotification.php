<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Notification;

class NewOrderNotification extends Notification
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
            'type' => 'new_order',
            'title' => __('New Order Received'),
            'message' => __('A new order has been placed') . ': ' . $this->order->order_id,
            'order_id' => $this->order->id,
            'order_number' => $this->order->order_id,
            'user_name' => $this->order->user->name ?? __('Unknown'),
            'amount' => $this->order->total_payment,
            'currency' => $this->order->payable_currency ?? 'USD',
            'url' => route('admin.order', $this->order->order_id),
        ];
    }
}

