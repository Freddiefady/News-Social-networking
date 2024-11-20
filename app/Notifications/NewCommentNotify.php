<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewCommentNotify extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $comment, $post;
    public function __construct($comment, $post)
    {
        $this->comment = $comment;
        $this->post = $post;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            // sent to the notification pusher, db and There is not enough data
        ];
    }
    public function toDatabase(object $notifiable): array
    {
        return [ // When I go to the notification page, I need to make an http request to fetch the full data.
            // sent to the notification pusher and db
            'user_id'=>$this->comment->user_id,
            'user_name'=>auth()->user()->name,
            'post_title'=>$this->post->title,
            'post_slug'=>$this->post->slug,
            'comment'=>$this->comment->comment,
            'url'=>route('frontend.post.show', $this->post->slug),
        ];
    }
    public function toBroadcast(object $notifiable): array
    {
        return [ // When I go to the notification page, I need to make an http request to fetch the full data.
            // sent to the notification pusher and db
            'user_id'=>$this->comment->user_id,
            'user_name'=>auth()->user()->name,
            'post_title'=>$this->post->title,
            'post_slug'=>$this->post->slug,
            'comment'=>$this->comment->comment,
            'url'=>route('frontend.post.show', $this->post->slug),
        ];
    }
    public function databaseType(): string
    {
    return 'NewCommentNotify';
    }
    public function broadcastType(): string
    {
    return 'NewCommentNotify';
    }
}
