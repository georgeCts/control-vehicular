<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Library\Messages;
use App\Library\Errors;
use App\Library\FormatValidation;
use App\Library\Returns\ActionReturn;
use App\Library\Returns\AjaxReturn;

use App\Servicios;
use App\UsuariosBitacoras;

class ServiciosController extends Controller
{

    public function index() {
        $lstServicios = Servicios::where('eliminado', 0)->orderBy('nombre', 'ASC')->get();

        return View('contents.servicios.Catalogo', ['lstServicios' => $lstServicios]);
    }

    public function agregar() {
        return View('contents.servicios.Agregar');
    }

    public function store(Request $request) {
        $objReturn = new ActionReturn('panel/servicios/agregar', 'panel/servicios');
        if( FormatValidation::isValidString($request['txtNombre'])) {

            $objServicio = new Servicios();
            $objServicio->nombre        = FormatValidation::getValidString($request['txtNombre']);
            $objServicio->descripcion   = FormatValidation::getValidString($request['txtDescripcion']);

            try {
                if($objServicio->create()) {
                    $objBitacora = new UsuariosBitacoras();
                    $objBitacora->descripcion   = "Agregó al catálogo el servicio con ID: ".$objServicio->pk_servicio;
                    $objBitacora->create();

                    $objReturn->setResult(true, Messages::SERVICIOS_CREATE_TITLE, Messages::SERVICIOS_CREATE_MESSAGE);
                } else {
                    $objReturn->setResult(false, Errors::SERVICIOS_CREATE_02_TITLE, Errors::SERVICIOS_CREATE_02_MESSAGE);
                }
            } catch(Exception $exception) {
                $objReturn->setResult(false, Errors::getErrors($exception->getCode())['title'], Errors::getErrors($exception->getCode())['message']);
            }
        } else {
            $objReturn->setResult(false, Errors::SERVICIOS_CREATE_01_TITLE, Errors::SERVICIOS_CREATE_01_MESSAGE);
        }

        return $objReturn->getRedirectPath();
    }

    public function editar($pkServicio) {
        $return = redirect('panel/servicios');
        $objServicio = Servicios::where('pk_servicio', $pkServicio)->first();

        if($objServicio != null) {
            $return = View('contents.servicios.Editar', ['objServicio' => $objServicio]);
        }

        return $return;
    }

    public function update(Request $request) {
        $objReturn = new ActionReturn('panel/servicios/editar/'.$request['hddPkServicio'], 'panel/servicios');
        $objServicio = Servicios::where('pk_servicio', $request['hddPkServicio'])->first();

        if($objServicio != null) {
            if( FormatValidation::isValidString($request['txtNombre']) ) {

                $objServicio->nombre        = FormatValidation::getValidString($request['txtNombre']);
                $objServicio->descripcion   = FormatValidation::getValidString($request['txtDescripcion']);

                try {
                    if($objServicio->update()) {
                        $objBitacora = new UsuariosBitacoras();
                        $objBitacora->descripcion   = "Modificó del catálogo el servicio con ID: ".$objServicio->pk_servicio;
                        $objBitacora->create();

                        $objReturn->setResult(true, Messages::SERVICIOS_EDIT_TITLE, Messages::SERVICIOS_EDIT_MESSAGE);
                    } else {
                        $objReturn->setResult(false, Errors::SERVICIOS_EDIT_03_TITLE, Errors::SERVICIOS_EDIT_03_MESSAGE);
                    }
                } catch(Exception $exception) {
                    $objReturn->setResult(false, Errors::getErrors($exception->getCode())['title'], Errors::getErrors($exception->getCode())['message']);
                }
            } else {
                $objReturn->setResult(false, Errors::SERVICIOS_EDIT_02_TITLE, Errors::SERVICIOS_EDIT_02_MESSAGE);
            }
        } else {
            $objReturn->setResult(false, Errors::SERVICIOS_EDIT_01_TITLE, Errors::SERVICIOS_EDIT_01_MESSAGE);
        }

        return $objReturn->getRedirectPath();
    }
}
