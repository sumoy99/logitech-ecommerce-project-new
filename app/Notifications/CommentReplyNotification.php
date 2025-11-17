<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CommentReplyNotification extends Notification
{
    use Queueable;

    public $user;
    public $item;
    public $comment;
    public $redirectUrl;

    public function __construct($user, $item, $comment, $redirectUrl)
    {
        $this->user = $user;
        $this->item = $item;
        $this->comment = $comment;
        $this->redirectUrl = $redirectUrl;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => 'New Reply on Your Comment',
            'message' => $this->user->name . ' replied to your comment.',
            'user_name' => $this->user->name,
            'user_image' => $this->user->image ?? 'public/assets/frontend/img/user_default.png',
            'item_image' => $this->item->item_thumbnail ?? 'assets/default_item.png',
            'comment_id' => $this->comment->id,
            'redirect_url' => $this->redirectUrl,
        ];
    }
}
