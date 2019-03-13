<?php

namespace App\Notifications\Inversores;

use Illuminate\Queue\SerializesModels;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Foundation\Auth\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Bus\Queueable;

class InversorNuevo extends Notification
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
        // return ['database'];
        return ['mail','database'];
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
        ->subject('Nuevo Inversor')
            ->markdown('emails.inversores.nuevo', ['usuario'=>$this->usuario]);
    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return
        [
            'oferta_id' => $this->oferta
        ];
    }
}
