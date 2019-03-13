<?php

namespace App\Notifications\Ofertas;

use Illuminate\Queue\SerializesModels;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Foundation\Auth\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Bus\Queueable;

class OfertaAprobada extends Notification
{
    use Queueable, SerializesModels;
    public $usuario;
    public $oferta;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($oferta, User $usuario)
    {
        $this->oferta = $oferta;
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
        ->subject('Oferta aprobada')
        ->markdown('emails.ofertas.aprobada', ['usuario'=>$this->usuario]);
    }
}
