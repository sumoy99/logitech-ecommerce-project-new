<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ReferralWithdrawNotification extends Notification
{
    use Queueable;

    public $user;
    public $amount;
    public $status; // approved or rejected
    public $redirectUrl;

    public function __construct($user, $amount, $status, $redirectUrl)
    {
        $this->user = $user;
        $this->amount = $amount;
        $this->status = $status;
        $this->redirectUrl = $redirectUrl;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        $title = $this->status === 'approved' 
            ? 'Withdrawal Request Approved'
            : 'Withdrawal Request Rejected';

        $message = $this->status === 'approved'
            ? 'Your withdrawal request of ৳' . number_format($this->amount, 2) . ' has been approved.'
            : 'Your withdrawal request of ৳' . number_format($this->amount, 2) . ' has been rejected.';

        return [
            'title' => $title,
            'message' => $message,
            'user_image' => $this->user->image ?? 'public/assets/frontend/img/user_default.png',
            'redirect_url' => $this->redirectUrl,
        ];
    }
}
