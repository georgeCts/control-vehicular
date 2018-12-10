<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library\Messages;
use App\Library\Errors;
use App\Library\FormatValidation;
use App\Library\Returns\ActionReturn;
use App\Library\Returns\AjaxReturn;

use App\UsuariosBitacoras;
use App\VehiculosGrupos;

class VehiculosGruposController extends Controller
{
    public function index() {
        $lstVehiculosGrupos = VehiculosGrupos::get();
        return view('contents.vehiculos.grupos.Index', ['lstVehiculosGrupos' => $lstVehiculosGrupos]);
    }

    public function registro() {
        return view('contents.vehiculos.grupos.Registrar');
    }

    public function store(Request $request) {
        $objReturn = new ActionReturn('panel/vehiculos/agregar_grupo', 'panel/vehiculos/grupos');

        if( FormatValidation::isValidString($request['txtNombre'])) {

            $objVehiculoGrupo = new VehiculosGrupos();
            $objVehiculoGrupo->vehiculo_grupo = FormatValidation::getValidString($request['txtNombre']);

            try {
                if($objVehiculoGrupo->create()) {
                    $objBitacora = new UsuariosBitacoras();
                    $objBitacora->descripcion   = "Agregó un grupo de vehículos";
                    $objBitacora->create();

                    $objReturn->setResult(true, Messages::VEHICULOS_GRUPOS_CREATE_TITLE, Messages::VEHICULOS_GRUPOS_CREATE_MESSAGE);
                } else {
                    $objReturn->setResult(false, Errors::VEHICULOS_GRUPOS_CREATE_02_TITLE, Errors::VEHICULOS_GRUPOS_CREATE_02_MESSAGE);
                }
            } catch(Exception $exception) {
                $objReturn->setResult(false, Errors::getErrors($exception->getCode())['title'], Errors::getErrors($exception->getCode())['message']);
            }

        } else {
            $objReturn->setResult(false, Errors::VEHICULOS_GRUPOS_CREATE_01_TITLE, Errors::VEHICULOS_GRUPOS_CREATE_01_MESSAGE);
        }

        return $objReturn->getRedirectPath();
    }

    public function editar($pkVehiculoGrupo) {
        $objVehiculoGrupo = VehiculosGrupos::where('pk_vehiculo_grupo', $pkVehiculoGrupo)->first();

        return view('contents.vehiculos.grupos.Editar', ['objVehiculoGrupo' => $objVehiculoGrupo]);
    }

    public function update(Request $request) {
        $objReturn = new ActionReturn('panel/vehiculos/editar_grupo/'.$request['hddPkVehiculoGrupo'], 'panel/vehiculos/grupos');
        $objVehiculoGrupo = VehiculosGrupos::where('pk_vehiculo_grupo', $request['hddPkVehiculoGrupo'])->first();

        if($objVehiculoGrupo != null) {

            if( FormatValidation::isValidString($request['txtNombre'])) {
    
                $objVehiculoGrupo->vehiculo_grupo = FormatValidation::getValidString($request['txtNombre']);
    
                try {
                    if($objVehiculoGrupo->update()) {
                        $objBitacora = new UsuariosBitacoras();
                        $objBitacora->descripcion   = "Modificó un grupo de vehículos (ID: ".$objVehiculoGrupo->pk_vehiculo_grupo.")";
                        $objBitacora->create();

                        $objReturn->setResult(true, Messages::VEHICULOS_GRUPOS_EDIT_TITLE, Messages::VEHICULOS_GRUPOS_EDIT_MESSAGE);
                    } else {
                        $objReturn->setResult(false, Errors::VEHICULOS_GRUPOS_EDIT_03_TITLE, Errors::VEHICULOS_GRUPOS_EDIT_03_MESSAGE);
                    }
                } catch(Exception $exception) {
                    $objReturn->setResult(false, Errors::getErrors($exception->getCode())['title'], Errors::getErrors($exception->getCode())['message']);
                }
    
            } else {
                $objReturn->setResult(false, Errors::VEHICULOS_GRUPOS_EDIT_02_TITLE, Errors::VEHICULOS_GRUPOS_EDIT_02_MESSAGE);
            }
        } else {
            $objReturn->setResult(false, Errors::VEHICULOS_GRUPOS_EDIT_01_TITLE, Errors::VEHICULOS_GRUPOS_EDIT_01_MESSAGE);
        }

        return $objReturn->getRedirectPath();
    }
}
