<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Library\Messages;
use App\Library\Errors;
use App\Library\FormatValidation;
use App\Library\Returns\ActionReturn;
use App\Library\Returns\AjaxReturn;

use App\Operadores;
use App\Vehiculos;
use App\VehiculosInspecciones;
use App\VehiculosInspeccionesFicheros;
use App\UsuariosBitacoras;

use Auth;
use PDF;
use Image;

class InspeccionesController extends Controller
{
    public function index($pkVehiculo) {
        
        $return = redirect('/panel/vehiculos');
        $objVehiculo = Vehiculos::where('pk_vehiculo', $pkVehiculo)->first();

        if($objVehiculo != null) {
            $lstInspecciones = VehiculosInspecciones::where('eliminado', 0)->orderBy('pk_vehiculo_inspeccion', 'DESC')->get();
            $return = view('contents.vehiculos.inspecciones.Index', ['objVehiculo' => $objVehiculo, 'lstInspecciones' => $lstInspecciones]);
        }

        return $return;
    }

    public function registro($pkVehiculo) {
        $return = back();
        $objVehiculo = Vehiculos::where('pk_vehiculo', $pkVehiculo)->first();

        if($objVehiculo != null) {
            $lstOperadores = Operadores::where('eliminado', 0)->orderBy('nombre', 'DESC')->get();

            $return = view('contents.vehiculos.inspecciones.Registrar', [   'objVehiculo'   => $objVehiculo,
                                                                            'lstOperadores' => $lstOperadores]);
        }

        return $return;
    }

    public function store(Request $request) {
        $objReturn = new ActionReturn('panel/vehiculos/inspecciones/'.$request['pk_vehiculo'].'/registrar_insp' , 'panel/vehiculos/inspecciones/'.$request['pk_vehiculo']);
        $objVehiculo = Vehiculos::where('pk_vehiculo', $request['pk_vehiculo'])->first();

        if($objVehiculo != null) {

            if(FormatValidation::isDate($request['txtFecha']) && FormatValidation::isDecimal($request['txtKmSalida'])
                && FormatValidation::isPrimaryKey($request['cmbOperador']) && FormatValidation::isDate($request['txtFechaVigencia'])
                && FormatValidation::isPrimaryKey($request['cmbRecibe'])) {
                
                $objInspeccion = new VehiculosInspecciones();
                $objInspeccion->fecha_inspeccion    = FormatValidation::getDateAtom($request['txtFecha']);
                $objInspeccion->pk_operador         = FormatValidation::getPrimaryKey($request['cmbOperador']);
                $objInspeccion->kilometraje_salida  = FormatValidation::getDecimal($request['txtKmSalida']);
                //$objInspeccion->kilometraje_llegada = FormatValidation::getDecimal($request['txtKmLlegada']);
                $objInspeccion->vigencia_licencia   = FormatValidation::getDateAtom($request['txtFechaVigencia']);
                $objInspeccion->numero_unidad       = FormatValidation::getValidString($request['txtNumeroUnidad']);
                $objInspeccion->telefono_vehiculo   = FormatValidation::getValidString($request['txtTelefono']);

                $objInspeccion->pk_vehiculo         = FormatValidation::getPrimaryKey($request['pk_vehiculo']);
                $objInspeccion->entrega_pk_usuario  = FormatValidation::getPrimaryKey(Auth::user()->pk_usuario);
                $objInspeccion->recibe_pk_operador   = FormatValidation::getPrimaryKey($request['cmbRecibe']);

                //CAPTURA DE FIRMAS
                $imgRecibe = Image::make($request['imgRecibo']);
                $imgRecibe = $imgRecibe->stream();
                $nameFileRecibe = time() . 'R.png';

                $storageFirma = Storage::disk('s3');
                $storageFirma->put('ficheros/'.$nameFileRecibe, $imgRecibe->__toString(), 'public');
                $objInspeccion->url_firma_recibe = 'ficheros/'.$nameFileRecibe;



                $imgEntrega = Image::make($request['imgEntrega']);
                $imgEntrega = $imgEntrega->stream();
                $nameFileEntrega = time() . 'E.png';

                $storageFirma = Storage::disk('s3');
                $storageFirma->put('ficheros/'.$nameFileEntrega, $imgEntrega->__toString(), 'public');
                $objInspeccion->url_firma_entrega = 'ficheros/'.$nameFileEntrega;
                ///////////////////////////////////////////////

                $objInspeccion->triangulos_reflejantes  = FormatValidation::getBooleanString($request['rdTriangulo']);
                $objInspeccion->gato                    = FormatValidation::getBooleanString($request['rdGato']);
                $objInspeccion->herramientas            = FormatValidation::getBooleanString($request['rdHerramienta']);
                $objInspeccion->llanta_refaccion        = FormatValidation::getBooleanString($request['rdLlantaRefaccion']);

                $objInspeccion->presion_llantas         = FormatValidation::getBooleanString($request['rdPresionLlanta']);
                $objInspeccion->dibujo_llantas          = FormatValidation::getBooleanString($request['rdDibujoLlanta']);
                $objInspeccion->limpieza                = FormatValidation::getBooleanString($request['rdLimpieza']);
                $objInspeccion->aseguramiento_carga     = FormatValidation::getBooleanString($request['rdCarga']);
                $objInspeccion->dano_carroceria         = FormatValidation::getBooleanString($request['rdCarroceria']);
                $objInspeccion->condicion_escape        = FormatValidation::getBooleanString($request['rdEscape']);
                $objInspeccion->limpiaparabrisa         = FormatValidation::getBooleanString($request['rdLimpiaparabrisa']);
                $objInspeccion->parabrisa               = FormatValidation::getBooleanString($request['rdParabrisa']);
                $objInspeccion->aire_acondicionado      = FormatValidation::getBooleanString($request['rdAireAcondicionado']);

                $objInspeccion->nivel_combustible       = FormatValidation::getValidString($request['txtTanque']);
                $objInspeccion->nivel_anticongelante    = FormatValidation::getBooleanString($request['rdAnticongelante']);
                $objInspeccion->nivel_aceite            = FormatValidation::getBooleanString($request['rdAceite']);
                $objInspeccion->liquido_limpiador       = FormatValidation::getBooleanString($request['rdLiquidoLimpiador']);
                $objInspeccion->fuga_visible            = FormatValidation::getBooleanString($request['rdFuga']);
                $objInspeccion->cables_corriente        = FormatValidation::getBooleanString($request['rdCables']);

                $objInspeccion->luces_delanteras        = FormatValidation::getBooleanString($request['rdLucesDelanteras']);
                $objInspeccion->luces_traseras          = FormatValidation::getBooleanString($request['rdLucesTraceras']);
                $objInspeccion->luces_intermitentes     = FormatValidation::getBooleanString($request['rdLucesIntermitentes']);

                $objInspeccion->tarjeta_circulacion     = FormatValidation::getBooleanString($request['rdTarjetaCirculacion']);
                $objInspeccion->poliza_seguro           = FormatValidation::getBooleanString($request['rdPolizaSeguro']);
                $objInspeccion->registro_mantenimiento  = FormatValidation::getBooleanString($request['rdRegistroMantenimiento']);
                
                $objInspeccion->comentarios             = FormatValidation::getValidString($request['txtComentarios']);

                //CARGA DE LA IMAGEN
                $storage = Storage::disk('s3');
                $path = $storage->put('ficheros', $request->file('image'), 'public');
                $objInspeccion->imagen_dano = $path;

                try {
                    if($objInspeccion->create()) {
                        $objBitacora = new UsuariosBitacoras();
                        $objBitacora->descripcion   = "Realizó una inspección del vehículo (".$objVehiculo->vehiculo_nombre.") con ID: ".$objInspeccion->pk_vehiculo_inspeccion;
                        $objBitacora->create();

                        $objReturn->setResult(true, Messages::INSPECCIONES_CREATE_TITLE, Messages::INSPECCIONES_CREATE_MESSAGE);
                    } else {
                        $objReturn->setResult(false, Errors::INSPECCIONES_CREATE_03_TITLE, Errors::INSPECCIONES_CREATE_03_MESSAGE);
                    }
                } catch(Exception $exception) {
                    $objReturn->setResult(false, Errors::getErrors($exception->getCode())['title'], Errors::getErrors($exception->getCode())['message']);
                }
            } else {
                $objReturn->setResult(false, Errors::INSPECCIONES_CREATE_02_TITLE, Errors::INSPECCIONES_CREATE_02_MESSAGE);
            }
        } else {
            $objReturn->setResult(false, Errors::INSPECCIONES_CREATE_01_TITLE, Errors::INSPECCIONES_CREATE_01_MESSAGE);
        }

        return $objReturn->getRedirectPath();
    }

    public function showPhotos($pkInspeccion) {
        $return = back();
        $objInspeccion = VehiculosInspecciones::where('pk_vehiculo_inspeccion', $pkInspeccion)->first();

        if($objInspeccion != null) {
            $lstFicheros = VehiculosInspeccionesFicheros::where('pk_vehiculo_inspeccion', $pkInspeccion)->where('eliminado', 0)->get(); 
            $return = view('contents.vehiculos.inspecciones.SubirImagen', ['objInspeccion'  => $objInspeccion,
                                                                            'lstFicheros'   => $lstFicheros]);
        }

        return $return;
    }

    public function upload(Request $request) {

        $return = ['response' => false];
        
        if($request->file('image')) {
            $objInspeccion = VehiculosInspecciones::where('pk_vehiculo_inspeccion', $request['pkInspeccion'])->first();

            if($objInspeccion != null) {
                $objFichero = new VehiculosInspeccionesFicheros();
                $objFichero->pk_vehiculo_inspeccion = $request['pkInspeccion'];

                //CARGA LA IMAGEN DE LA INSPECCION
                $storage = Storage::disk('s3');
                $path = $storage->put('images', $request->file('image'), 'public');

                $objFichero->url_imagen = $path;
                try {
                    if($objFichero->create()) {
                        $objBitacora = new UsuariosBitacoras();
                        $objBitacora->descripcion   = "Cargó una imagen sobre la inspección #".$objInspeccion->pk_vehiculo_inspeccion;
                        $objBitacora->create();

                        $return = ['response'       => true, 
                                    'url_imagen'    => $path, 
                                    'pk_fichero'    => $objFichero->pk_vehiculo_inspeccion_fichero,
                                    'pk_inspeccion' => $objFichero->pk_vehiculo_inspeccion];
                    }
                } catch(Exception $exception) {
                    $return = $exception;
                }
            }
        }

        return json_encode($return);
    }

    public function deletePhoto($pkFichero) {
        $return = "false";
        $objFichero = VehiculosInspeccionesFicheros::where('pk_vehiculo_inspeccion_fichero', $pkFichero)->first();

        if($objFichero != null) {
            try {
                if($objFichero->delete()) {
                    $return = "true";
                }
            } catch(Exception $exception) {
                $return = $exception;
            }
        }

        return $return;
    }

    public function print($pkInspeccion) {
        $return = null;
        $objInspeccion = VehiculosInspecciones::where('pk_vehiculo_inspeccion', $pkInspeccion)->first();
        //dd($objInspeccion);

        if($objInspeccion != null) {
            $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('documentos.InspeccionVehicular', ['objInspeccion' => $objInspeccion]);
            $return = $pdf->stream();
        }

        return $return;
    }
}
