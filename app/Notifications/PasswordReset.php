<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class PasswordReset extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        return (new MailMessage)
                    ->subject('Şifrə yeniləmə üçün bildiriş!')
                    ->greeting(' ')
                    ->line('Hörmətli istifadəçi,')
                    ->line('Şifrəni yeniləmək üçün aşağadakı linkə keçid edin!')
                    ->action('Şifrəni yenilə', $url)
                    ->line(Lang::get('Şifrə yeniləmə linki :count dəqiqə ərzində qüvvədədir.', ['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')]))
                  //  ->line(Lang::get('If you did not request a password reset, no further action is required.'))
                    ->salutation(' ');

    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
