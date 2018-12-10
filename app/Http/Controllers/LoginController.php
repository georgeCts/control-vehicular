<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library\Errors;
use App\Usuarios;
use Auth;
use Session;
use Redirect;

class LoginController extends Controller
{
    public function index() {

        if(Auth::check()) {
            return Redirect('/panel');
        } else {
            return view("Login");
        }
    }

    public function access(Request $request) {
        if(Auth::attempt([  'usuario'   => $request['user'], 
                            'password'  => $request['password']])) {
            
            $this->accessLog();
            
           return Redirect('/panel');
        } else {
            Session::flash("login_error_title", Errors::LOGIN_01_TITLE);
            Session::flash("login_error_message", Errors::LOGIN_01_MESSAGE);
            return Redirect('/login');
        }
    }

    public function accessLog() {
        $objUsuario = Usuarios::where('pk_usuario', Auth::user()->pk_usuario)->first();
        $objUsuario->numero_accesos     = (int)Auth::user()->numero_accesos + 1;
        $objUsuario->ultimo_acceso_fecha = date('Y-m-d H:i:s');

        $objUsuario->save();
    }

    public function logout() {
        if (Auth::check()) {
           Auth::logout();
           Session::flush();
        }
        return Redirect('/login');
   }
}
