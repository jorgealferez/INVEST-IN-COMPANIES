<?php

namespace App\Mail;

use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Bus\Queueable;
use App\User;

class TestEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $nuevo;
    public $usuario;
    /**
     * Create a new message instance.
     *
     * @return void
     */
public function __construct(User $usuario,User $nuevo)
    {
        $this->nuevo = $nuevo;
        $this->usuario = $usuario;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(){
        // dd($this->usuario->name);
        // return $this->markdown('emails.usuarios.verificar');
            return $this->markdown('emails.usuarios.verificar', ['usuario'=>$this->usuario, 'url' => $this->verificationUrl($notifiable)]);
    }

}