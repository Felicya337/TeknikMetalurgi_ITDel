<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue; // 1. Tambahkan ini
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class AdminResetPasswordNotification extends Notification implements ShouldQueue // 2. Implementasikan ShouldQueue
{
    use Queueable; // Queueable sudah ada, bagus

    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $resetUrl = url(route('admin.password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ]));

        return (new MailMessage)
            ->subject(Lang::get('Reset Password Admin Panel'))
            ->greeting(Lang::get('Halo, ' . $notifiable->name . '!'))
            ->line(Lang::get('Anda menerima email ini karena kami menerima permintaan reset password untuk akun admin Anda.'))
            ->action(Lang::get('Reset Password'), $resetUrl)
            ->line(Lang::get('Link reset password ini akan kedaluwarsa dalam :count menit.', ['count' => config('auth.passwords.admins.expire')]))
            ->line(Lang::get('Jika Anda tidak merasa meminta reset password, abaikan saja email ini.'));
    }

    public function toArray(object $notifiable): array
    {
        return [];
    }
}
