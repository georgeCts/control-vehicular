<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library\Messages;
use App\Library\Errors;
use App\Library\FormatValidation;
use App\Library\Returns\ActionReturn;
use App\Library\Returns\AjaxReturn;

use App\Usuarios;
use App\UsuariosTipos;
use App\UsuariosBitacoras;

class UsuariosController extends Controller
{
    public function index() {
        $objUsuarios = Usuarios::get();

        return view('contents.usuarios.Consultar', ['objUsuarios' => $objUsuarios]);
    }

    public function bitacora() {
        $objBitacora = UsuariosBitacoras::orderBy('pk_usuario_bitacora', 'DESC')->get();

        return view('contents.usuarios.Bitacora', ['objBitacora' => $objBitacora]);
    }

    public function registro() {
        $lstUsuariosTipos = UsuariosTipos::where('eliminado', 0)->get();

        return view('contents.usuarios.Registrar', ['lstUsuariosTipos' => $lstUsuariosTipos]);
    }

    public function store(Request $request) {
        $objReturn = new ActionReturn('panel/usuarios/registrar', 'panel/usuarios');

        if(FormatValidation::isValidString($request['txtNombre']) && FormatValidation::isValidString($request['txtApellidoP'])
            && FormatValidation::isValidString($request['txtUsuario']) && FormatValidation::isValidString($request['txtCorreo'])) {
            
            $objUsuarioValidate = Usuarios::where('correo', $request['txtCorreo'])
                                        ->orWhere('usuario', $request['txtUsuario'])
                                        ->get();
            if(sizeof($objUsuarioValidate) < 1) {

                //CREACIÓN DE OBJETO USUARIO
                $objUsuario = new Usuarios();
                $objUsuario->pk_usuario_tipo    = FormatValidation::getPrimaryKey($request['cmbTipoUsuario']);
                $objUsuario->nombre             = FormatValidation::getValidString($request['txtNombre']);
                $objUsuario->apellido_paterno  = FormatValidation::getValidString($request['txtApellidoP']);
                $objUsuario->apellido_materno  = FormatValidation::getValidString($request['txtApellidoM']);
    
                $objUsuario->correo            = FormatValidation::getValidString($request['txtCorreo']);
                $objUsuario->usuario           = FormatValidation::getValidString($request['txtUsuario']);                    
                $objUsuario->password          = bcrypt(FormatValidation::getValidString($request['txtContrasena']));
    
                try {
                    if($objUsuario->create()) {
                        $objBitacora = new UsuariosBitacoras();
                        $objBitacora->descripcion   = "Agregó un usuario con ID: ".$objUsuario->pk_usuario;
                        $objBitacora->create();

                        $objReturn->setResult(true, Messages::USUARIOS_CREATE_TITLE, Messages::USUARIOS_CREATE_MESSAGE);
                    } else {
                        $objReturn->setResult(false, Errors::USUARIOS_CREATE_03_TITLE, Errors::USUARIOS_CREATE_03_MESSAGE);
                    }
                } catch(Exception $exception) {
                    $objReturn->setResult(false, Errors::getErrors($exception->getCode())['title'], Errors::getErrors($exception->getCode())['message']);
                }
            } else {
                $objReturn->setResult(false, Errors::USUARIOS_CREATE_02_TITLE, Errors::USUARIOS_CREATE_02_MESSAGE);
            }
        } else {
            $objReturn->setResult(false, Errors::USUARIOS_CREATE_01_TITLE, Errors::USUARIOS_CREATE_01_MESSAGE);
        }

        return $objReturn->getRedirectPath();
    }
}
