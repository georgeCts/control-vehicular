<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library\Messages;
use App\Library\Errors;
use App\Library\FormatValidation;
use App\Library\Returns\ActionReturn;
use App\Library\Returns\AjaxReturn;
use App\Proveedores;
use App\UsuariosBitacoras;

class ProveedoresController extends Controller
{
    public function index() {
        $objProveedores = Proveedores::where('eliminado', 0)->get();

        return view('contents.proveedores.Consultar', ['objProveedores' => $objProveedores]);
    }

    public function registro() {
        return view('contents.proveedores.Registrar');
    }

    public function store(Request $request) {
        
        $objReturn = new ActionReturn('panel/proveedores/registrar', 'panel/proveedores');

        if( FormatValidation::isValidString($request['txtNombreComercial'])) {

            $proveedor = new Proveedores();
            $proveedor->nombre_comercial    = FormatValidation::getValidString($request['txtNombreComercial']);
            $proveedor->telefono            = FormatValidation::getValidString($request['txtTelefono']);
            $proveedor->domicilio           = FormatValidation::getValidString($request['txtDomicilio']);
            $proveedor->ciudad              = FormatValidation::getValidString($request['txtCiudad']);
            $proveedor->estado              = FormatValidation::getValidString($request['txtEstado']);
            
            $proveedor->contacto_nombre     = FormatValidation::getValidString($request['txtContacto']);
            $proveedor->contacto_telefono   = FormatValidation::getValidString($request['txtContactoTelefono']);
            $proveedor->contacto_correo     = FormatValidation::getValidString($request['txtContactoCorreo']);

            try {
                if($proveedor->create()) {
                    $objBitacora = new UsuariosBitacoras();
                    $objBitacora->descripcion   = "Registró un nuevo proveedor: ".$objProveedor->nombre_comercial;
                    $objBitacora->create();

                    $objReturn->setResult(true, Messages::PROVEEDORES_CREATE_TITLE, Messages::PROVEEDORES_CREATE_MESSAGE);
                } else {
                    $objReturn->setResult(false, Errors::PROVEEDORES_CREATE_02_TITLE, Errors::PROVEEDORES_CREATE_02_MESSAGE);
                }
            } catch(Exception $exception) {
                $objReturn->setResult(false, Errors::getErrors($exception->getCode())['title'], Errors::getErrors($exception->getCode())['message']);
            }
        } else {
            $objReturn->setResult(false, Errors::PROVEEDORES_CREATE_01_TITLE, Errors::PROVEEDORES_CREATE_01_MESSAGE);
        }

        return $objReturn->getRedirectPath();

    }

    public function edit($pkProveedor) {
        $objProveedor = Proveedores::where('pk_proveedor', $pkProveedor)->first();

        return view('contents.proveedores.Editar', ['objProveedor' => $objProveedor]);
    }

    public function update(Request $request) {

        $objReturn = new ActionReturn('panel/proveedores/editar' . $request->pkProveedor, 'panel/proveedores');
        $objProveedor = Proveedores::where('pk_proveedor', $request->pkProveedor)->first();
        
        if($objProveedor != null) {

            if( FormatValidation::isValidString($request['txtNombreComercial'])) {
    
                
                $objProveedor->nombre_comercial    = FormatValidation::getValidString($request['txtNombreComercial']);
                $objProveedor->telefono            = FormatValidation::getValidString($request['txtTelefono']);
                $objProveedor->domicilio           = FormatValidation::getValidString($request['txtDomicilio']);
                $objProveedor->ciudad              = FormatValidation::getValidString($request['txtCiudad']);
                $objProveedor->estado              = FormatValidation::getValidString($request['txtEstado']);
                
                $objProveedor->contacto_nombre     = FormatValidation::getValidString($request['txtContacto']);
                $objProveedor->contacto_telefono   = FormatValidation::getValidString($request['txtContactoTelefono']);
                $objProveedor->contacto_correo     = FormatValidation::getValidString($request['txtContactoCorreo']);
    
                try {
                    if($objProveedor->update()) {
                        $objBitacora = new UsuariosBitacoras();
                        $objBitacora->descripcion   = "Modificó un proveedor con ID: ".$objProveedor->pk_proveedor;
                        $objBitacora->create();

                        $objReturn->setResult(true, Messages::PROVEEDORES_EDIT_TITLE, Messages::PROVEEDORES_EDIT_MESSAGE);
                    } else {
                        $objReturn->setResult(false, Errors::PROVEEDORES_EDIT_03_TITLE, Errors::PROVEEDORES_EDIT_03_MESSAGE);
                    }
                } catch(Exception $exception) {
                    $objReturn->setResult(false, Errors::getErrors($exception->getCode())['title'], Errors::getErrors($exception->getCode())['message']);
                }
            } else {
                $objReturn->setResult(false, Errors::PROVEEDORES_EDIT_02_TITLE, Errors::PROVEEDORES_EDIT_02_MESSAGE);
            }
        } else {
            $objReturn->setResult(false, Errors::PROVEEDORES_EDIT_01_TITLE, Errors::PROVEEDORES_EDIT_01_MESSAGE);
        }


        return $objReturn->getRedirectPath();
    }

    public function delete($pkProveedor) {
        
    }
}
