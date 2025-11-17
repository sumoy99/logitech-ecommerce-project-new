<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaymentNotification extends Notification
{
    use Queueable;

    public $user;
    public $item;
    public $redirectUrl;
    public $status; // approved / rejected

    public function __construct($user, $item, $redirectUrl, $status)
    {
        $this->user = $user;
        $this->item = $item;
        $this->redirectUrl = $redirectUrl;
        $this->status = $status;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        $from = get_settings('system_title');
        $title = $this->status === 'approved' ? 'Your Payment Has Been Approved!' : 'Your Payment Has Been Rejected!';
        $message = $this->status === 'approved'
            ? $from . ' has approved your payment for "' . $this->item->item_title . '".'
            : $from . ' has rejected your payment for "' . $this->item->item_title . '".';

        return [
            'title' => $title,
            'message' => $message,
            // 'user_name' => $this->user->name,
            'user_image' => $this->user->image ?? 'public/assets/frontend/img/user_default.png',
            'item_image' => $this->item->item_thumbnail ?? 'assets/default_item.png',
            'item_id' => $this->item->id,
            'redirect_url' => $this->redirectUrl,
        ];
    }
}

