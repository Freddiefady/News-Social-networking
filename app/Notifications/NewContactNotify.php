<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewContactNotify extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $contact;
    public function __construct($contact)
    {
        $this->contact = $contact;
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
        return [ // When I go to the notification page, I need to make an http request to fetch the full data.
            // sent to the notification pusher and db
            'contact_title'=>$this->contact->title,
            'user_name'=>$this->contact->name,
            'date'=> date('Y-m-d h:m a'),
            'url'=>route('dashboard.contacts.show', $this->contact->id),
        ];
    }
    public function databaseType(): string
    {
    return 'NewContactNotify';
    }
    public function broadcastType(): string
    {
    return 'NewContactNotify';
    }
}
