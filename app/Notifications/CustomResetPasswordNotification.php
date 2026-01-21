<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CustomResetPasswordNotification extends Notification
{
    use Queueable;

    /**
     * El token de reseteo de contraseña
     *
     * @var string
     */
    public $token;

    /**
     * Create a new notification instance.
     */
    public function __construct($token)
    {
        $this->token = $token;
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
        $url = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        $expireMinutes = config('auth.passwords.'.config('auth.defaults.passwords').'.expire');

        return (new MailMessage)
                    ->subject('🔐 Recuperación de Contraseña - FUNDASALUD Trujillo')
                    ->greeting('¡Hola ' . $notifiable->name . '!')
                    ->line('Recibiste este correo porque se solicitó restablecer la contraseña de tu cuenta en el Sistema de Gestión de Recursos Humanos de FUNDASALUD Trujillo.')
                    ->action('🔑 Restablecer Contraseña', $url)
                    ->line('⏱️ Este enlace de recuperación expirará en **' . $expireMinutes . ' minutos**.')
                    ->line('🔒 Si no solicitaste restablecer tu contraseña, puedes ignorar este correo. Tu cuenta permanecerá segura.')
                    ->line('Por tu seguridad, nunca compartas este enlace con nadie.')
                    ->salutation('Atentamente,')
                    ->salutation('Equipo de FUNDASALUD Trujillo');
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
