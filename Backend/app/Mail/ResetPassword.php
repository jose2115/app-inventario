<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    public string $url;
    public string $name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($url, $name)
    {
        //
        $this->url = $url;
        $this->name = $name;

    }


    public function build()
     {
         return $this->markdown('emails.reset', [
             'url' => $this->url,
             'name' => $this->name, 
         ])->subject("Cambio de Contraseña" . " " . "Alqueria");
     }
}
