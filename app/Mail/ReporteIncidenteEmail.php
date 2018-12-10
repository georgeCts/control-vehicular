<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReporteIncidenteEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The incidente object instance.
     *
     * @var ObjIncidente
     */
    public $objIncidente;

    /**
     * The usuario object instance.
     *
     * @var ObjUsuario
     */
    public $objUsuario;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($objIncidente, $objUsuario)
    {
        $this->objIncidente = $objIncidente;
        $this->objUsuario = $objUsuario;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('notificaciones@miFlota.mx')
                    ->view('emails.ReporteIncidente')
                    ->with([
                        'objUsuario' => $this->objUsuario
                    ]);
    }
}
