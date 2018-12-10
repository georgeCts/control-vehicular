<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library\Messages;
use App\Library\Errors;
use App\Library\FormatValidation;
use App\Library\Returns\ActionReturn;
use App\Library\Returns\AjaxReturn;

use App\UsuariosBitacoras;
use App\VehiculosTipos;

class VehiculosTiposController extends Controller
{
    public function index() {

        $lstVehiculosTipos = VehiculosTipos::get();

        return view('contents.vehiculos.tipos.Index', ['lstVehiculosTipos' => $lstVehiculosTipos]);
    }

    public function registro() {
        return view('contents.vehiculos.tipos.Registrar');
    }

    public function store(Request $request) {
        $objReturn = new ActionReturn('panel/vehiculos/agregar_tipo', 'panel/vehiculos/tipos');

        if( FormatValidation::isValidString($request['txtNombre'])) {

            $objVehiculoTipo = new VehiculosTipos();
            $objVehiculoTipo->vehiculo_tipo = FormatValidation::getValidString($request['txtNombre']);

            try {
                if($objVehiculoTipo->create()) {
                    $objBitacora = new UsuariosBitacoras();
                    $objBitacora->descripcion   = "Agregó un tipo de vehículo: ".$objVehiculoTipo->vehiculo_tipo;
                    $objBitacora->create();

                    $objReturn->setResult(true, Messages::VEHICULOS_TIPOS_CREATE_TITLE, Messages::VEHICULOS_TIPOS_CREATE_MESSAGE);
                } else {
                    $objReturn->setResult(false, Errors::VEHICULOS_TIPOS_CREATE_02_TITLE, Errors::VEHICULOS_TIPOS_CREATE_02_MESSAGE);
                }
            } catch(Exception $exception) {
                $objReturn->setResult(false, Errors::getErrors($exception->getCode())['title'], Errors::getErrors($exception->getCode())['message']);
            }

        } else {
            $objReturn->setResult(false, Errors::VEHICULOS_TIPOS_CREATE_01_TITLE, Errors::VEHICULOS_TIPOS_CREATE_01_MESSAGE);
        }

        return $objReturn->getRedirectPath();
    }

    public function editar($pkVehiculoTipo) {
        $objVehiculoTipo = VehiculosTipos::where('pk_vehiculo_tipo', $pkVehiculoTipo)->first();

        return view('contents.vehiculos.tipos.Editar', ['objVehiculoTipo' => $objVehiculoTipo]);
    }

    public function update(Request $request) {
        $objReturn = new ActionReturn('panel/vehiculos/editar_tipo/'.$request['hddPkVehiculoTipo'], 'panel/vehiculos/tipos');
        $objVehiculoTipo = VehiculosTipos::where('pk_vehiculo_tipo', $request['hddPkVehiculoTipo'])->first();

        if($objVehiculoTipo != null) {

            if( FormatValidation::isValidString($request['txtNombre'])) {
    
                $objVehiculoTipo->vehiculo_tipo = FormatValidation::getValidString($request['txtNombre']);
    
                try {
                    if($objVehiculoTipo->update()) {
                        $objBitacora = new UsuariosBitacoras();
                        $objBitacora->descripcion   = "Modificó el tipo de vehículo con ID: ".$objVehiculoTipo->pk_vehiculo_tipo;
                        $objBitacora->create();

                        $objReturn->setResult(true, Messages::VEHICULOS_TIPOS_EDIT_TITLE, Messages::VEHICULOS_TIPOS_EDIT_MESSAGE);
                    } else {
                        $objReturn->setResult(false, Errors::VEHICULOS_TIPOS_EDIT_03_TITLE, Errors::VEHICULOS_TIPOS_EDIT_03_MESSAGE);
                    }
                } catch(Exception $exception) {
                    $objReturn->setResult(false, Errors::getErrors($exception->getCode())['title'], Errors::getErrors($exception->getCode())['message']);
                }
    
            } else {
                $objReturn->setResult(false, Errors::VEHICULOS_TIPOS_EDIT_02_TITLE, Errors::VEHICULOS_TIPOS_EDIT_02_MESSAGE);
            }
        } else {
            $objReturn->setResult(false, Errors::VEHICULOS_TIPOS_EDIT_01_TITLE, Errors::VEHICULOS_TIPOS_EDIT_01_MESSAGE);
        }

        return $objReturn->getRedirectPath();
    }
}
