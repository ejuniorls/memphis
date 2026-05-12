<?php

namespace App\Notifications\Auth;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Invite extends Notification
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $url = route('register') . '?' . http_build_query([
                'name'  => $this->name,
                'email' => $this->email,
            ]);

        return (new MailMessage)
            ->subject('Você foi convidado para ' . config('app.name'))
            ->greeting('Olá, ' . $this->name . '!')
            ->line('Você recebeu um convite para acessar ' . config('app.name') . '.')
            ->action('Aceitar convite', $url)
            ->line('Se você não esperava este convite, ignore este e-mail.');
    }
}
