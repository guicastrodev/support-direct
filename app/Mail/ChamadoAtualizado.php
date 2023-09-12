<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ChamadoAtualizado extends Mailable
{
    use Queueable, SerializesModels;

    private $chamado;
    private $novo;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($chamado,$novo = false)    
    {
        $this->chamado = $chamado;
        $this->novo = $novo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $chamado = $this->chamado;

        if($this->novo) 
            { $assunto = "Novo Chamado Aberto! Nº: " . $chamado->id; }
        else
            { $assunto = 'Atualização do Chamado nº: ' . $chamado->id . '!';}

        
        return $this->view('mail.chamado-atualizado',compact('chamado'))
        ->subject($assunto);
    }
}
