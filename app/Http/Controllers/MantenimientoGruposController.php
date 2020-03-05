<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MantenimientosGrupos;

class MantenimientoGruposController extends Controller
{
    public function index() {
        $lstGrupos = MantenimientosGrupos::where('eliminado', 0)->orderBy('pk_mantenimiento_grupo', 'DESC')->get();

        return View('contents.servicios.grupos.Index', ['lstGrupos' => $lstGrupos]);
    }

    public function agregar() {
        return View('contents.servicios.grupos.Agregar');
    }

    public function store(Request $request) {

    }

    public function editar($pkGrupo) {
        $return = redirect('panel/servicios/grupos');
        $objGrupo = MantenimientosGrupos::where('pk_mantenimiento_grupo', $pkGrupo)->first();

        if($objGrupo != null) {
            $return = View('contents.servicios.grupos.Editar', ['objGrupo' => $objGrupo]);
        }

        return $return;
    }

    public function update(Request $request) {

    }
}
