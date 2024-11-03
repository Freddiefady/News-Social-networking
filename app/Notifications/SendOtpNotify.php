<?php

namespace App\Notifications;

use Ichtrojan\Otp\Otp;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SendOtpNotify extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */

    public function __construct(public Otp $otp)
    {
        // Constructor property promotion instance from appServiceProvider
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $generateOTP = $this->otp->generate($notifiable->email,'numeric', 6, 3);
        return (new MailMessage)
                    ->greeting('Received code OTP verification')
                    ->line('Thank you for choosing NEWS. Use the following OTP to complete your Sign Up procedures. OTP is valid for 5 minutes')
                    ->line('Code: '.$generateOTP->token);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
