<?php

namespace App\Mail;

use App\Models\Chamado;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ChamadoAtualizado extends Mailable
{
    use Queueable, SerializesModels;

    private $chamado;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($chamado)    
    {
        $this->chamado = $chamado;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $chamado = $this->chamado;
        return $this->view('mail.chamado-atualizado',compact('chamado'))
        ->subject('Atualização do Chamado nº: ' . $chamado->id);
    }
}
