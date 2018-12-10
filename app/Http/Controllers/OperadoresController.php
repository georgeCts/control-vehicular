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
use App\UsuariosBitacoras;

class OperadoresController extends Controller
{
    public function index() {
        $objOperadores = Operadores::where('eliminado', 0)->get();

        return view('contents.operadores.Consultar', ['objOperadores' => $objOperadores]);
    }

    public function registro() {
        return view('contents.operadores.Registrar');
    }

    public function store(Request $request) {

        $objReturn = new ActionReturn('panel/operadores/registrar', 'panel/operadores');

        if(FormatValidation::isValidString($request['txtNombre'])) {
            if(FormatValidation::isValidString($request['txtLicenciaFolio']) && FormatValidation::isDate($request['txtLicenciaVencimiento'])) {
                if($request->file('licenciaFichero')) {

                    //CARGA LA IMAGEN DE LA LICENCIA
                    $storage = Storage::disk('s3');
                    $path = $storage->put('images', $request->file('licenciaFichero'), 'public');                   

                    //CREACIÓN DE OBJETO OPERADOR
                    $objOperador = new Operadores();
                    $objOperador->nombre    = FormatValidation::getValidString($request['txtNombre']);
                    $objOperador->domicilio = FormatValidation::getValidString($request['txtDomicilio']);
                    $objOperador->telefono  = FormatValidation::getValidString($request['txtTelefono']);

                    $objOperador->licencia_folio    = FormatValidation::getValidString($request['txtLicenciaFolio']);
                    $objOperador->licencia_vigencia = FormatValidation::getDateAtom($request['txtLicenciaVencimiento']);                    
                    $objOperador->licencia_url      = FormatValidation::getValidString($path);

                    try {
                        if($objOperador->create()) {
                            $objBitacora = new UsuariosBitacoras();
                            $objBitacora->descripcion   = "Registró un nuevo operador con ID: ".$objOperador->pk_operador;
                            $objBitacora->create();

                            $objReturn->setResult(true, Messages::OPERADORES_CREATE_TITLE, Messages::OPERADORES_CREATE_MESSAGE);
                        } else {
                            $objReturn->setResult(false, Errors::OPERADORES_CREATE_04_TITLE, Errors::OPERADORES_CREATE_04_MESSAGE);
                        }
                    } catch(Exception $exception) {
                        $objReturn->setResult(false, Errors::getErrors($exception->getCode())['title'], Errors::getErrors($exception->getCode())['message']);
                    }
                } else {
                    $objReturn->setResult(false, Errors::OPERADORES_CREATE_03_TITLE, Errors::OPERADORES_CREATE_03_MESSAGE);
                }                
            } else {
                $objReturn->setResult(false, Errors::OPERADORES_CREATE_02_TITLE, Errors::OPERADORES_CREATE_02_MESSAGE);
            }
        } else {
            $objReturn->setResult(false, Errors::OPERADORES_CREATE_01_TITLE, Errors::OPERADORES_CREATE_01_MESSAGE);
        }

        return $objReturn->getRedirectPath();
    }

    public function edit($pkOperador) {
        $objOperador = Operadores::where('pk_operador', $pkOperador)->first();

        return view('contents.operadores.Editar', ['objOperador' => $objOperador]);
    }

    public function update(Request $request) {
        $objReturn = new ActionReturn('panel/operadores/editar/' . $request['hddPkOperador'], 'panel/operadores');

        $objOperador = Operadores::where('pk_operador', FormatValidation::getPrimaryKey($request['hddPkOperador']))->first();

        if($objOperador != null) {
            if(FormatValidation::isValidString($request['txtLicenciaFolio']) && FormatValidation::isDate($request['txtLicenciaVencimiento'])) {
                
                //MODIFICACIÓN DE OBJETO OPERADOR
                $objOperador->nombre    = FormatValidation::getValidString($request['txtNombre']);
                $objOperador->domicilio = FormatValidation::getValidString($request['txtDomicilio']);
                $objOperador->telefono  = FormatValidation::getValidString($request['txtTelefono']);

                $objOperador->licencia_folio    = FormatValidation::getValidString($request['txtLicenciaFolio']);
                $objOperador->licencia_vigencia = FormatValidation::getDateAtom($request['txtLicenciaVencimiento']);                                    
                
                //VALIDAR SI EXISTE UN FICHERO NUEVO A REMPLAZAR
                if($request->file('licenciaFichero')) {
                    //CARGA LA IMAGEN DE LA LICENCIA
                    $storage = Storage::disk('s3');
                    $path = $storage->put('images', $request->file('licenciaFichero'), 'public');
                    $objOperador->licencia_url      = FormatValidation::getValidString($path);                   
                } 

                try {
                    if($objOperador->update()) {
                        $objBitacora = new UsuariosBitacoras();
                        $objBitacora->descripcion   = "Modificó un operador con ID: ".$objOperador->pk_operador;
                        $objBitacora->create();

                        $objReturn->setResult(true, Messages::OPERADORES_EDIT_TITLE, Messages::OPERADORES_EDIT_MESSAGE);
                    } else {
                        $objReturn->setResult(false, Errors::OPERADORES_EDIT_03_TITLE, Errors::OPERADORES_EDIT_03_MESSAGE);
                    }
                } catch(Exception $exception) {
                    $objReturn->setResult(false, Errors::getErrors($exception->getCode())['title'], Errors::getErrors($exception->getCode())['message']);
                }             
            } else {
                $objReturn->setResult(false, Errors::OPERADORES_EDIT_02_TITLE, Errors::OPERADORES_EDIT_02_MESSAGE);
            }
        } else {
            $objReturn->setResult(false, Errors::OPERADORES_EDIT_01_TITLE, Errors::OPERADORES_EDIT_01_MESSAGE);
        }

        return $objReturn->getRedirectPath();
    }
}
