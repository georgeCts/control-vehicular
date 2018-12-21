<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RecordatorioEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The incidente object instance.
     *
     * @var ObjRecordatorio
     */
    public $objRecordatorio;

    /**
     * The usuario object instance.
     *
     * @var ObjUsuario
     */
    public $objUsuario;

    /**
     * The type object instance.
     *
     * @var StrType
     */
    public $strType;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($objRecordatorio, $objUsuario, $strType)
    {
        $this->objRecordatorio  = $objRecordatorio;
        $this->objUsuario       = $objUsuario;
        $this->strType          = $strType;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('notificaciones@miFlota.mx')
                    ->view('emails.Recordatorio')
                    ->with([
                        'objUsuario' => $this->objUsuario,
                        'strType'    => $this->strType
                    ]);
    }
}
