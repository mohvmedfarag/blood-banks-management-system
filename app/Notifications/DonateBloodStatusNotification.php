<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DonateBloodStatusNotification extends Notification
{
    use Queueable;

    protected $bloodDonation;
    protected $status;

    /**
     * Create a new notification instance.
     * @param  mixed  $bloodDonation
     * @param  string  $status
     * @return void
     */
    public function __construct($bloodDonation, string $status)
    {
        $this->bloodDonation = $bloodDonation;
        $this->status = $status;
    }

    /**
     * Get the notification's delivery channels.
     * @param  mixed  $notifiable
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

     /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        if ($this->status == 'Accepted') {
            $message = 'Your blood Donation has been approved.';
        }else if($this->status == 'Rejected'){
            $message = 'Your blood donation has been rejected.';
        }else{
            $message = 'Your blood donation has been sent successfully.';
        }

        return [
            'blood_donation_id' => $this->bloodDonation->id,
            'message' => $message,
            'status' => $this->status,
            'date' => now()->toDateTimeString(), 
            
        ];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
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
