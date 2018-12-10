<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

use App\Mail\ReporteIncidenteEmail;

use App\Library\Messages;
use App\Library\Errors;
use App\Library\FormatValidation;
use App\Library\Returns\ActionReturn;
use App\Library\Returns\AjaxReturn;

use App\Incidentes;
use App\Vehiculos;
use App\IncidentesImportancia;
use App\Usuarios;
use App\UsuariosBitacoras;

class IncidentesController extends Controller
{
    public function index() {
        $lstIncidentes = Incidentes::where('eliminado', 0)->orderBy('pk_incidente', 'DESC')->get();
        return view('contents.vehiculos.incidentes.Index', ['lstIncidentes' => $lstIncidentes]);
    }

    public function registro() {
        $lstVehiculos = Vehiculos::where('eliminado', 0)->get();
        $lstImportancia = IncidentesImportancia::where('eliminado', 0)->get();
        $lstUsuarios = Usuarios::where('eliminado', 0)->get();

        return view('contents.vehiculos.incidentes.Registrar', ['lstVehiculos'      => $lstVehiculos, 
                                                                'lstImportancia'    => $lstImportancia,
                                                                'lstUsuarios'       => $lstUsuarios]);
    }

    public function store(Request $request) {
        $objReturn = new ActionReturn('panel/vehiculos/reportar_inc', 'panel/vehiculos/incidentes');

        if(FormatValidation::isValidString($request['txtDescripcion']) && FormatValidation::isPrimaryKey($request['cmbImportancia'])
            && FormatValidation::isPrimaryKey($request['cmbVehiculo']) && FormatValidation::isDate($request['txtFecha'])) {

            $objIncidente = new Incidentes();
            $objIncidente->pk_vehiculo              = FormatValidation::getPrimaryKey($request['cmbVehiculo']);
            $objIncidente->fecha_reporte            = FormatValidation::getDateAtom($request['txtFecha']);
            $objIncidente->descripcion              = FormatValidation::getValidString($request['txtDescripcion']);
            $objIncidente->pk_incidente_importancia = FormatValidation::getPrimaryKey($request['cmbImportancia']);
            $objIncidente->descripcion_detallada    = FormatValidation::getValidString($request['txtDetallada']);
            
            if(FormatValidation::isDecimal($request['txtMedicion'])) {
                $objIncidente->medicion             = FormatValidation::getDecimal($request['txtMedicion']);
            }

            if($request['txtFechaVencimiento'] != "") {
                $objIncidente->fecha_vencimiento    = FormatValidation::getDateAtom($request['txtFechaVencimiento']);
            }

            try {
                if($objIncidente->create()) {

                    foreach($request['cmbContactos'] as $pkUsuario) {
                        $objUsuario = Usuarios::where('pk_usuario', $pkUsuario)->first();
                        if($objUsuario != null) {
                            Mail::to($objUsuario->correo)->send(new ReporteIncidenteEmail($objIncidente, $objUsuario));
                        }
                    }

                    $objBitacora = new UsuariosBitacoras();
                    $objBitacora->descripcion   = "Reportó el incidente #".$objIncidente->pk_incidente."(".$objIncidente->descripcion.") del vehículo con ID: ".$objIncidente->pk_vehiculo;
                    $objBitacora->create();

                    $objReturn->setResult(true, Messages::INCIDENTES_CREATE_TITLE, Messages::INCIDENTES_CREATE_MESSAGE);
                } else {
                    $objReturn->setResult(false, Errors::INCIDENTES_CREATE_02_TITLE, Errors::INCIDENTES_CREATE_02_MESSAGE);
                }
            } catch(Exception $exception) {
                $objReturn->setResult(false, Errors::getErrors($exception->getCode())['title'], Errors::getErrors($exception->getCode())['message']);
            }
        } else {
            $objReturn->setResult(false, Errors::INCIDENTES_CREATE_01_TITLE, Errors::INCIDENTES_CREATE_01_MESSAGE);
        }

        return $objReturn->getRedirectPath();
    }

    public function editar($pkIncidente) {
        $return = redirect('panel/vehiculos/incidentes');
        $objIncidente = Incidentes::where('pk_incidente', $pkIncidente)->first();

        if($objIncidente != null) {

            $lstVehiculos = Vehiculos::where('eliminado', 0)->get();
            $lstImportancia = IncidentesImportancia::where('eliminado', 0)->get();
            $lstUsuarios = Usuarios::where('eliminado', 0)->get();
    
            $return = view('contents.vehiculos.incidentes.Editar', ['lstVehiculos'      => $lstVehiculos, 
                                                                    'lstImportancia'    => $lstImportancia,
                                                                    'objIncidente'      => $objIncidente,]);
        }

        return $return;
    }

    public function update(Request $request) {
        $objReturn = new ActionReturn('panel/vehiculos/editar_inc/'.$request['hddPkIncidente'], 'panel/vehiculos/incidentes');
        $objIncidente = Incidentes::where('pk_incidente', $request['hddPkIncidente'])->first();

        if($objIncidente != null) {

            if(FormatValidation::isValidString($request['txtDescripcion']) && FormatValidation::isPrimaryKey($request['cmbImportancia'])
                && FormatValidation::isPrimaryKey($request['cmbVehiculo']) && FormatValidation::isDate($request['txtFecha'])) {
    
                $objIncidente->pk_vehiculo              = FormatValidation::getPrimaryKey($request['cmbVehiculo']);
                $objIncidente->fecha_reporte            = FormatValidation::getDateAtom($request['txtFecha']);
                $objIncidente->descripcion              = FormatValidation::getValidString($request['txtDescripcion']);
                $objIncidente->pk_incidente_importancia = FormatValidation::getPrimaryKey($request['cmbImportancia']);
                $objIncidente->descripcion_detallada    = FormatValidation::getValidString($request['txtDetallada']);
                
                if(FormatValidation::isDecimal($request['txtMedicion'])) {
                    $objIncidente->medicion             = FormatValidation::getDecimal($request['txtMedicion']);
                }
    
                if($request['txtFechaVencimiento'] != "") {
                    $objIncidente->fecha_vencimiento    = FormatValidation::getDateAtom($request['txtFechaVencimiento']);
                }
    
                try {
                    if($objIncidente->update()) {
                        $objBitacora = new UsuariosBitacoras();
                        $objBitacora->descripcion   = "Modificó el incidente #".$objIncidente->pk_incidente;
                        $objBitacora->create();

                        $objReturn->setResult(true, Messages::INCIDENTES_EDIT_TITLE, Messages::INCIDENTES_EDIT_MESSAGE);
                    } else {
                        $objReturn->setResult(false, Errors::INCIDENTES_EDIT_03_TITLE, Errors::INCIDENTES_EDIT_03_MESSAGE);
                    }
                } catch(Exception $exception) {
                    $objReturn->setResult(false, Errors::getErrors($exception->getCode())['title'], Errors::getErrors($exception->getCode())['message']);
                }
            } else {
                $objReturn->setResult(false, Errors::INCIDENTES_EDIT_02_TITLE, Errors::INCIDENTES_EDIT_02_MESSAGE);
            }
        } else {
            $objReturn->setResult(false, Errors::INCIDENTES_EDIT_01_TITLE, Errors::INCIDENTES_EDIT_01_MESSAGE);
        }

        return $objReturn->getRedirectPath();
    }

    public function upload(Request $request) {

        $return = ['response' => false];
        
        if($request->file('image')) {
            $objIncidente = Incidentes::where('pk_incidente', $request['pkIncidente'])->first();

            if($objIncidente != null) {
                //CARGA LA IMAGEN DEL INCIDENTE
                $storage = Storage::disk('s3');
                $path = $storage->put('images', $request->file('image'), 'public');

                $objIncidente->url_imagen = $path;
                try {
                    if($objIncidente->update()) {
                        $objBitacora = new UsuariosBitacoras();
                        $objBitacora->descripcion   = "Cargó una imagen sobre el incidente #".$objIncidente->pk_incidente;
                        $objBitacora->create();

                        $return = ['response' => true, 'url_imagen' => $path];
                    }
                } catch(Exception $exception) {
                    $return = $exception;
                }
            }
        }

        return json_encode($return);
    }

    public function deletePhoto($pkIncidente) {
        $return = "false";
        $objIncidente = Incidentes::where('pk_incidente', $pkIncidente)->first();

        if($objIncidente != null) {
            Storage::disk('s3')->delete($objIncidente->url_imagen);
            $objIncidente->url_imagen = null;

            try {
                if($objIncidente->update()) {
                    $return = "true";
                }
            } catch(Exception $exception) {
                $return = $exception;
            }
        }

        return $return;
    }
}
