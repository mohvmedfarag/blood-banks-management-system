<?php

namespace App\Notifications;

use Ichtrojan\Otp\Otp;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendOtpNotify extends Notification
{
    use Queueable;

    protected $otp;
    protected $message;
    protected $header;
    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        $this->otp = new Otp;
        $this->header = "Reset Password Verification Code";
        $this->message = "Please Use This Code To Reset Your Password";
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
        $otp = $this->otp->generate($notifiable->email, 'numeric', 4, 20);
        return (new MailMessage)
                    ->greeting($this->header)
                    ->line($this->message)
                    ->line('Code: ' .$otp->token);
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
