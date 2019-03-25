<?php

namespace App\Notifications\Usuarios;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Auth\Notifications\ResetPassword;

class UsuarioResetPasswordConfirmacion extends ResetPassword
{
    public $token;
    public $usuario;
    public function __construct($token, $usuario)
    {
        $this->token = $token;
        $this->usuario = $usuario;
    }
    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $this->token);
        }

        return (new MailMessage)
            ->markdown('emails.usuarios.resetConfirmacion', ['usuario' => $this->usuario])
            ->subject('Contraseña');
    }
}
