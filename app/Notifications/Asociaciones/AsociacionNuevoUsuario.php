<?php

namespace App\Notifications\Asociaciones;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Foundation\Auth\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Bus\Queueable;

class AsociacionNuevoUsuario extends Notification
{
    use Queueable;
    public $asociacion;
    public $usuario;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($asociacion, $usuario)
    {
        $this->asociacion = $asociacion;
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
            ->subject('Nuevo Empresa')
            ->markdown('emails.asociaciones.nuevoUsuario', [
                'usuario'=>$this->usuario,
                'asociacion'=>$this->asociacion,

            ]);
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
            'asociacion_id' => $this->asociacion_id
        ];
    }
}
