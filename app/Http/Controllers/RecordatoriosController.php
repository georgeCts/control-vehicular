<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Mail\RecordatorioEmail;

use App\Library\Messages;
use App\Library\Errors;
use App\Library\FormatValidation;
use App\Library\Returns\ActionReturn;
use App\Library\Returns\AjaxReturn;

use App\Recordatorios;
use App\RecordatoriosUsuarios;
use App\Vehiculos;
use App\Usuarios;
use App\UsuariosBitacoras;

class RecordatoriosController extends Controller
{
    public function index() {
        $lstRecordatorios = Recordatorios::where('eliminado', 0)->orderBy('pk_recordatorio', 'DESC')->get();
        return View('contents.vehiculos.recordatorios.Index', ['lstRecordatorios' => $lstRecordatorios]);
    }

    public function registro() {
        $lstVehiculos = Vehiculos::where('eliminado', 0)->get();
        $lstUsuarios = Usuarios::where('eliminado', 0)->get();

        return view('contents.vehiculos.recordatorios.Registrar', ['lstVehiculos'      => $lstVehiculos, 
                                                                    'lstUsuarios'       => $lstUsuarios]);
    }

    public function store(Request $request) {
        $objReturn = new ActionReturn('panel/vehiculos/agregar_recordatorio', 'panel/vehiculos/recordatorios');

        if(FormatValidation::isValidString($request['txtNombre']) && FormatValidation::isValidString($request['txtDescripcion']) 
            && FormatValidation::isPrimaryKey($request['cmbVehiculo']) && FormatValidation::isDate($request['txtFechaVencimiento'])) {
            
            $objRecordatorio = new Recordatorios();
            $objRecordatorio->pk_vehiculo           = FormatValidation::getPrimaryKey($request['cmbVehiculo']);
            $objRecordatorio->nombre                = FormatValidation::getValidString($request['txtNombre']);
            $objRecordatorio->descripcion           = FormatValidation::getValidString($request['txtDescripcion']);
            $objRecordatorio->fecha_vencimiento     = FormatValidation::getDateAtom($request['txtFechaVencimiento']);
            $objRecordatorio->fecha_notificacion    = FormatValidation::getDateAtom($request['txtFechaNotificacion']);

            try {
                if($objRecordatorio->create()) {

                    foreach($request['cmbUsuarios'] as $pkUsuario) {
                        $objUsuario = Usuarios::where('pk_usuario', $pkUsuario)->first();
                        if($objUsuario != null) {
                            //ENVIO DE CORREO AL USUARIO
                            Mail::to($objUsuario->correo)->send(new RecordatorioEmail($objRecordatorio, $objUsuario, 'C'));
                            
                            $objRecUsuario = new RecordatoriosUsuarios();
                            $objRecUsuario->pk_recordatorio = $objRecordatorio->pk_recordatorio;
                            $objRecUsuario->pk_usuario      = $objUsuario->pk_usuario;
                            try {
                                $objRecUsuario->create();
                            } catch(Exception $exception) {
                                $objReturn->setResult(false, Errors::getErrors($exception->getCode())['title'], Errors::getErrors($exception->getCode())['message']);
                            }
                        }
                    }

                    $objBitacora = new UsuariosBitacoras();
                    $objBitacora->descripcion   = "Agregó un recordatorio #".$objRecordatorio->pk_recordatorio."(".$objRecordatorio->descripcion.") del vehículo con ID: ".$objRecordatorio->pk_vehiculo;
                    $objBitacora->create();

                    $objReturn->setResult(true, Messages::RECORDATORIOS_CREATE_TITLE, Messages::RECORDATORIOS_CREATE_MESSAGE);
                } else {
                    $objReturn->setResult(false, Errors::RECORDATORIOS_CREATE_02_TITLE, Errors::RECORDATORIOS_CREATE_02_MESSAGE);
                }
            } catch(Exception $exception) {
                $objReturn->setResult(false, Errors::getErrors($exception->getCode())['title'], Errors::getErrors($exception->getCode())['message']);
            }
        } else {
            $objReturn->setResult(false, Errors::RECORDATORIOS_CREATE_01_TITLE, Errors::RECORDATORIOS_CREATE_01_MESSAGE);
        }

        return $objReturn->getRedirectPath();
    }

    public function editar($pkRecordatorio) {
        $objRecordatorio = Recordatorios::where('pk_recordatorio', $pkRecordatorio)->first();
        $return = redirect('/panel/vehiculos/recordatorios');

        if($pkRecordatorio != null) {
            
            $lstVehiculos = Vehiculos::where('eliminado', 0)->get();
            $lstUsuarios = Usuarios::where('eliminado', 0)->get();
            $arrNotificados = $objRecordatorio->notificados->pluck('pk_usuario');
    
            $return = View('contents.vehiculos.recordatorios.Editar', [ 'lstVehiculos'        => $lstVehiculos, 
                                                                        'lstUsuarios'         => $lstUsuarios,
                                                                        'objRecordatorio'     => $objRecordatorio,
                                                                        'arrNotificados'      => $arrNotificados]);
        }

        return $return;
    }

    public function update(Request $request) {
        $objReturn = new ActionReturn('panel/vehiculos/editar_recordatorio/'.$request['hddPkRecordatorio'], 'panel/vehiculos/recordatorios');
        $objRecordatorio = Recordatorios::where('pk_recordatorio', $request['hddPkRecordatorio'])->first();

        if($objRecordatorio != null) {

            if(FormatValidation::isValidString($request['txtNombre']) && FormatValidation::isValidString($request['txtDescripcion']) 
                && FormatValidation::isPrimaryKey($request['cmbVehiculo']) && FormatValidation::isDate($request['txtFechaVencimiento'])) {
                
                $objRecordatorio->pk_vehiculo           = FormatValidation::getPrimaryKey($request['cmbVehiculo']);
                $objRecordatorio->nombre                = FormatValidation::getValidString($request['txtNombre']);
                $objRecordatorio->descripcion           = FormatValidation::getValidString($request['txtDescripcion']);
                $objRecordatorio->fecha_vencimiento     = FormatValidation::getDateAtom($request['txtFechaVencimiento']);
                $objRecordatorio->fecha_notificacion    = FormatValidation::getDateAtom($request['txtFechaNotificacion']);
    
                try {
                    if($objRecordatorio->update()) {

                        RecordatoriosUsuarios::where('pk_recordatorio', $objRecordatorio->pk_recordatorio)->delete();
    
                        foreach($request['cmbUsuarios'] as $pkUsuario) {
                            $objUsuario = Usuarios::where('pk_usuario', $pkUsuario)->first();
                            if($objUsuario != null) {
                                //ENVIO DE CORREO AL USUARIO
                                Mail::to($objUsuario->correo)->send(new RecordatorioEmail($objRecordatorio, $objUsuario, 'M'));
                                
                                $objRecUsuario = new RecordatoriosUsuarios();
                                $objRecUsuario->pk_recordatorio = $objRecordatorio->pk_recordatorio;
                                $objRecUsuario->pk_usuario      = $objUsuario->pk_usuario;
                                try {
                                    $objRecUsuario->create();
                                } catch(Exception $exception) {
                                    $objReturn->setResult(false, Errors::getErrors($exception->getCode())['title'], Errors::getErrors($exception->getCode())['message']);
                                }
                            }
                        }
    
                        $objBitacora = new UsuariosBitacoras();
                        $objBitacora->descripcion   = "Modificó un recordatorio #".$objRecordatorio->pk_recordatorio."(".$objRecordatorio->descripcion.") del vehículo con ID: ".$objRecordatorio->pk_vehiculo;
                        $objBitacora->create();
    
                        $objReturn->setResult(true, Messages::RECORDATORIOS_EDIT_TITLE, Messages::RECORDATORIOS_EDIT_MESSAGE);
                    } else {
                        $objReturn->setResult(false, Errors::RECORDATORIOS_EDIT_03_TITLE, Errors::RECORDATORIOS_EDIT_03_MESSAGE);
                    }
                } catch(Exception $exception) {
                    $objReturn->setResult(false, Errors::getErrors($exception->getCode())['title'], Errors::getErrors($exception->getCode())['message']);
                }
            } else {
                $objReturn->setResult(false, Errors::RECORDATORIOS_EDIT_02_TITLE, Errors::RECORDATORIOS_EDIT_02_MESSAGE);
            }
        } else {
            $objReturn->setResult(false, Errors::RECORDATORIOS_EDIT_01_TITLE, Errors::RECORDATORIOS_EDIT_01_MESSAGE);
        }

        return $objReturn->getRedirectPath();
    }
}
