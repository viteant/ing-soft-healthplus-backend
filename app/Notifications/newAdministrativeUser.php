<?php

namespace App\Notifications;

use App\Models\Administrative;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class newAdministrativeUser extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(protected string $email, protected string $password)
    {
        //
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
        return (new MailMessage)
            ->subject('Bienvenido(a) a Health+')
            ->line('Te damos la bienvenida a Health+ por favor, utiliza estas credenciales para ingresar a la plataforma:')
            ->line('')
            ->line('Usuario: ' . ($this->email))
            ->line('Password: ' . ($this->password))
            ->line('');
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
