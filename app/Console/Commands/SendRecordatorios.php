<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

use App\Mail\RecordatorioEmail;

use App\Recordatorios;
use App\Usuarios;

class SendRecordatorios extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:SendRecordatorios';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envía los recordatorios a sus respectivos usuarios';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $lstRecordatorios = Recordatorios::where('fecha_notificacion', date('Y-m-d'))->where('eliminado', 0)->get();

        foreach($lstRecordatorios as $objRecordatorio) {
            foreach($objRecordatorio->notificados as $notificado) {
                try {
                    $objUsuario = Usuarios::where('pk_usuario', $notificado->pk_usuario)->where('eliminado', 0)->first();
                    
                    //ENVIO DE CORREO AL USUARIO
                    Mail::to($objUsuario->correo)->send(new RecordatorioEmail($objRecordatorio, $objUsuario, 'N'));
                } catch(Exception $exception) {
                    echo "Hubo un error al mandar el correo: ".$exception->getCode();
                }
            }
        }

        echo "Correos enviados \n";
    }
}
