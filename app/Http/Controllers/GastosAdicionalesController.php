<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Library\Messages;
use App\Library\Errors;
use App\Library\FormatValidation;
use App\Library\Returns\ActionReturn;
use App\Library\Returns\AjaxReturn;

use App\GastosAdicionales;
use App\Vehiculos;
use App\Operadores;
use App\Proveedores;
use App\UsuariosBitacoras;

class GastosAdicionalesController extends Controller
{
    public function index() {
        $lstGastosAdicionales = GastosAdicionales::where('eliminado', 0)->get();        

        return view('contents.vehiculos.gastos.Index', ['lstGastosAdicionales'  => $lstGastosAdicionales]);
    }

    public function registro() {
        $lstVehiculos = Vehiculos::where('eliminado', 0)->get();
        $lstOperadores = Operadores::where('eliminado', 0)->get();
        $lstProveedores = Proveedores::where('eliminado', 0)->get();

        return view('contents.vehiculos.gastos.Registrar', ['lstVehiculos'          => $lstVehiculos,
                                                            'lstOperadores'         => $lstOperadores,
                                                            'lstProveedores'        => $lstProveedores]);
    }

    public function store(Request $request) {
        $objReturn = new ActionReturn('panel/vehiculos/registrar_gasto', 'panel/vehiculos/gastos');

        if(FormatValidation::isValidString($request['txtConcepto']) && FormatValidation::isDecimal($request['txtImporte'])
            && FormatValidation::isPrimaryKey($request['cmbVehiculo']) && FormatValidation::isDate($request['txtFecha'])) {
            
            $objGastoAdicional = new GastosAdicionales();
            $objGastoAdicional->fecha       = FormatValidation::getDateAtom($request['txtFecha']);
            $objGastoAdicional->concepto    = FormatValidation::getValidString($request['txtConcepto']);
            $objGastoAdicional->referencia  = FormatValidation::getValidString($request['txtReferencia']);
            $objGastoAdicional->pk_vehiculo = FormatValidation::getPrimaryKey($request['cmbVehiculo']);

            if(FormatValidation::isPrimaryKey($request['cmbOperador'])) {
                $objGastoAdicional->pk_operador = FormatValidation::getPrimaryKey($request['cmbOperador']);
            }

            if(FormatValidation::isPrimaryKey($request['cmbProveedor'])) {
                $objGastoAdicional->pk_proveedor = FormatValidation::getPrimaryKey($request['cmbProveedor']);
            }

            $objGastoAdicional->comentarios = FormatValidation::getValidString($request['txtComentarios']);
            $objGastoAdicional->importe     = FormatValidation::getDecimal($request['txtImporte']);

            try {
                if($objGastoAdicional->create()) {
                    $objBitacora = new UsuariosBitacoras();
                    $objBitacora->descripcion   = "Registró un gasto del vehículo con ID: ".$objGastoAdicional->pk_gasto_adicional;
                    $objBitacora->create();

                    $objReturn->setResult(true, Messages::GASTOS_ADICIONALES_CREATE_TITLE, Messages::GASTOS_ADICIONALES_CREATE_MESSAGE);
                } else {
                    $objReturn->setResult(false, Errors::GASTOS_ADICIONALES_CREATE_02_TITLE, Errors::GASTOS_ADICIONALES_CREATE_02_MESSAGE);
                }
            } catch(Exception $exception) {
                $objReturn->setResult(false, Errors::getErrors($exception->getCode())['title'], Errors::getErrors($exception->getCode())['message']);
            }
        } else {
            $objReturn->setResult(false, Errors::GASTOS_ADICIONALES_CREATE_01_TITLE, Errors::GASTOS_ADICIONALES_CREATE_01_MESSAGE);
        }

        return $objReturn->getRedirectPath();
    }
    
    public function editar($pkGasto) {
        $return = null;
        $objGastoAdicional = GastosAdicionales::where('pk_gasto_adicional', $pkGasto)->first();

        if($objGastoAdicional != null) {
            $lstVehiculos = Vehiculos::where('eliminado', 0)->get();
            $lstOperadores = Operadores::where('eliminado', 0)->get();
            $lstProveedores = Proveedores::where('eliminado', 0)->get();

            $return = view('contents.vehiculos.gastos.Editar', ['lstVehiculos'          => $lstVehiculos,
                                                                'lstOperadores'         => $lstOperadores,
                                                                'lstProveedores'        => $lstProveedores,
                                                                'objGastoAdicional'     => $objGastoAdicional]);
        } else {
            $return = redirect('panel/vehiculos/gastos');
        }

        return $return;
    }

    public function update(Request $request) {
        $objReturn = new ActionReturn('panel/vehiculos/registrar_gasto', 'panel/vehiculos/gastos');

        if(FormatValidation::isValidString($request['txtConcepto']) && FormatValidation::isDecimal($request['txtImporte'])
            && FormatValidation::isPrimaryKey($request['cmbVehiculo']) && FormatValidation::isDate($request['txtFecha'])) {
            
            $objGastoAdicional = GastosAdicionales::where('pk_gasto_adicional', $request['hddPkGastoAdicional'])->first();

            if($objGastoAdicional != null) {

                $objGastoAdicional->fecha       = FormatValidation::getDateAtom($request['txtFecha']);
                $objGastoAdicional->concepto    = FormatValidation::getValidString($request['txtConcepto']);
                $objGastoAdicional->referencia  = FormatValidation::getValidString($request['txtReferencia']);
                $objGastoAdicional->pk_vehiculo = FormatValidation::getPrimaryKey($request['cmbVehiculo']);
    
                if(FormatValidation::isPrimaryKey($request['cmbOperador'])) {
                    $objGastoAdicional->pk_operador = FormatValidation::getPrimaryKey($request['cmbOperador']);
                }
    
                if(FormatValidation::isPrimaryKey($request['cmbProveedor'])) {
                    $objGastoAdicional->pk_proveedor = FormatValidation::getPrimaryKey($request['cmbProveedor']);
                }
    
                $objGastoAdicional->comentarios = FormatValidation::getValidString($request['txtComentarios']);
                $objGastoAdicional->importe     = FormatValidation::getDecimal($request['txtImporte']);
    
                try {
                    if($objGastoAdicional->update()) {
                        $objBitacora = new UsuariosBitacoras();
                        $objBitacora->descripcion   = "Registró un gasto del vehículo con ID: ".$objGastoAdicional->pk_gasto_adicional;
                        $objBitacora->create();
    
                        $objReturn->setResult(true, Messages::GASTOS_ADICIONALES_EDIT_TITLE, Messages::GASTOS_ADICIONALES_EDIT_MESSAGE);
                    } else {
                        $objReturn->setResult(false, Errors::GASTOS_ADICIONALES_EDIT_03_TITLE, Errors::GASTOS_ADICIONALES_EDIT_03_MESSAGE);
                    }
                } catch(Exception $exception) {
                    $objReturn->setResult(false, Errors::getErrors($exception->getCode())['title'], Errors::getErrors($exception->getCode())['message']);
                }
            } else {
                $objReturn->setResult(false, Errors::GASTOS_ADICIONALES_EDIT_02_TITLE, Errors::GASTOS_ADICIONALES_EDIT_02_MESSAGE);
            }
        } else {
            $objReturn->setResult(false, Errors::GASTOS_ADICIONALES_EDIT_01_TITLE, Errors::GASTOS_ADICIONALES_EDIT_01_MESSAGE);
        }

        return $objReturn->getRedirectPath();
    }

    public function upload(Request $request) {

        $return = ['response' => false];
        
        if($request->file('documento')) {
            $objGastoAdicional = GastosAdicionales::where('pk_gasto_adicional', $request['pkGastoAdicional'])->first();

            if($objGastoAdicional != null) {
                //CARGA DEL DOCUMENTO DEL GASTO ADICIONAL
                $storage = Storage::disk('s3');
                $path = $storage->put('ficheros', $request->file('documento'), 'public');

                $objGastoAdicional->url_documento = $path;
                try {
                    if($objGastoAdicional->update()) {
                        $objBitacora = new UsuariosBitacoras();
                        $objBitacora->descripcion   = "Cargó un documento relacionado con el gasto #".$objGastoAdicional->pk_gasto_adicional;
                        $objBitacora->create();

                        $return = ['response' => true, 'url_documento' => $path];
                    }
                } catch(Exception $exception) {
                    $return = $exception;
                }
            }
        }

        return json_encode($return);
    }

    public function deleteDocument($pkGastoAdicional) {
        $return = "false";
        $objGastoAdicional = GastosAdicionales::where('pk_gasto_adicional', $pkGastoAdicional)->first();

        if($objGastoAdicional != null) {
            Storage::disk('s3')->delete($objGastoAdicional->url_documento);
            $objGastoAdicional->url_documento = null;

            try {
                if($objGastoAdicional->update()) {
                    $objBitacora = new UsuariosBitacoras();
                    $objBitacora->descripcion   = "Eliminó un documento relacionado con el gasto #".$objGastoAdicional->pk_gasto_adicional;
                    $objBitacora->create();

                    $return = "true";
                }
            } catch(Exception $exception) {
                $return = $exception;
            }
        }

        return $return;
    }
}
