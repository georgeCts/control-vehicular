<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class UsuariosBitacoras extends Model
{
    protected $table = "usuarios_bitacora";
    public $timestamps = false;
    protected $primaryKey = 'pk_usuario_bitacora';

    protected $fillable = ['pk_usuario_bitacora', 'descripcion', 'pk_usuario', 'creacion_fecha'];

    /* RELATIONSHIP - INICIO */
    public function usuario() {
        return $this->belongsTo('App\Usuarios', 'pk_usuario', 'pk_usuario');
    }
    /* RELATIONSHIP - FIN */


    public function save(array $options = array()) {
        return parent::save($options);
    }

    public function create(array $options = array()) {
        if( $this['pk_usuario_bitcora'] === null) {
            $this['pk_usuario'] = Auth::user()->pk_usuario;
            $this['creacion_fecha'] = date('Y-m-d H:i:s');
            return $this->save($options);
        } else {
            return false;
        }
    }

    public function update(array $attributes = array(), array $options = array()) {
        //return save($options);
    }

    public function delete() {
        //
    }
}
