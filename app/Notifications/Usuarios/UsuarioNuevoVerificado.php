<?php

namespace App\Notifications\Usuarios;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Auth\Notifications\VerifyEmail;
use App\User;

class UsuarioNuevoVerificado extends VerifyEmail
{
    
    
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $usuario)
    {
        $this->usuario = $usuario;
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
        return (new MailMessage)
            ->subject('Cuenta verificada')
            ->markdown('emails.usuarios.nuevoVerificado', ['usuario'=>$this->usuario]);
    }
}
