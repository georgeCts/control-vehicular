<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Usuarios;
use App\PrivilegiosCategorias;
use App\Privilegios;

use DB;
use Auth;

class UsuariosPrivilegios extends Model
{
    protected $table = "usuarios_privilegios";
    public $timestamps = false;
    protected $primaryKey = 'pk_usuario';

    protected $fillable = ['pk_usuario', 'pk_privilegio', 'creacion_pk_usuario', 'creacion_fecha'];

    public function create(array $options = array()) {
        $this['creacion_pk_usuario'] = Auth::user()->pk_usuario;
        $this['creacion_fecha'] = date('Y-m-d H:i:s');
        return save($options);
    }

    public static function getPrivilegiosMenu(Usuarios $objUsuario) {
        $return = array();

        $lstPrivilegiosCategorias = PrivilegiosCategorias::orderBy('menu_orden', 'asc')->orderBy('pk_privilegio_categoria', 'asc')->get();

        foreach ($lstPrivilegiosCategorias as $itemPrivilegioCategoria) {
            $lstPrivilegios = $objUsuario->privilegios
                    ->where('pk_privilegio_categoria', '=', $itemPrivilegioCategoria->pk_privilegio_categoria)
                    ->where('menu', '=', 1)
                    ->where('activo', '=', 1)
                    ->sortBy('menu_orden');
            if(sizeof($lstPrivilegios) > 0 ) {
                array_push($return, array(
                    'categoria'         => $itemPrivilegioCategoria,
                    'privilegios'       => $lstPrivilegios
                ));
            }
        }

        return $return;
    }
}
