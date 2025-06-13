<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class AdminResetPasswordNotification extends Notification
{
    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $url = route('admin.password.reset', [
            'token' => $this->token, 
            'email' => $notifiable->email
        ]);

        return (new MailMessage)
            ->subject('Reset Password Admin - ' . config('app.name'))
            ->greeting('Halo Admin!')
            ->line('Anda menerima email ini karena kami menerima permintaan reset password untuk akun admin Anda.')
            ->action('Reset Password', $url)
            ->line('Link reset password ini akan kadaluarsa dalam ' . config('auth.passwords.admins.expire') . ' menit.')
            ->line('Jika Anda tidak meminta reset password, abaikan email ini.')
            ->salutation('Terima kasih!');
    }
}