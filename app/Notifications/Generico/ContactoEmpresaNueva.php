<?php

namespace App\Notifications\Generico;

use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Auth\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ContactoEmpresaNueva extends Notification
{
    use Queueable;
    use SerializesModels;

    public $empresaNombre;
    public $empresaEmail;
    public $empresaPhone;
    public $usuario;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $usuario, $empresaNombre, $empresaEmail, $empresaPhone)
    {
        $this->usuario = $usuario;
        $this->empresaNombre = $empresaNombre;
        $this->empresaEmail = $empresaEmail;
        $this->empresaPhone = $empresaPhone;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database'];
        // return ['database'];
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
            ->markdown('emails.generico.nuevaEmpresa', [
                'usuario'=>$this->usuario,
                'empresaNombre'=>$this->empresaNombre,
                'empresaEmail'=>$this->empresaEmail,
                'empresaPhone'=>$this->empresaPhone,

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
            'name' => $this->empresaNombre,
            'email' => $this->empresaEmail,
            'phone' => $this->empresaPhone
        ];
    }
}
