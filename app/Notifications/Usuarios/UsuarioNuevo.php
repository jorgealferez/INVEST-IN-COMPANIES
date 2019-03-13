<?php

namespace App\Notifications\Usuarios;

use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Foundation\Auth\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Bus\Queueable;

class UsuarioNuevo extends Notification
{

	use Queueable, SerializesModels;
	public $nuevo;
	public $usuario;
	/**
	 * Create a new notification instance.
	 *
	 * @return void
	 */
public function __construct(User $usuario,User $nuevo)
	{
		$this->nuevo = $nuevo;
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
			->subject('Nuevo usuario')
			->markdown('emails.usuarios.nuevo', ['nuevo' => $this->nuevo,'usuario'=>$this->usuario]);
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
			'usuario_id' => $this->nuevo->id
		];
	}
}