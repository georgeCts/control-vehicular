<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use DB;
use Auth;
use Session;

class Usuarios extends Authenticatable
{
    use Notifiable;
    protected $table = 'usuarios';
    public $timestamps = false;
    protected $primaryKey = 'pk_usuario';

    protected $fillable = ['pk_usuario_tipo', 'nombre', 'apellido_paterno', 'apellido_materno', 'correo', 'imagen', 'usuario', 'password', 'numero_accesos', 'ultimo_acceso_fecha', 'creacion_pk_usuario', 'creacion_fecha', 'modificacion_pk_usuario', 'modificacion_fecha', 'eliminado'];
    protected $hidden = ['password', 'remember_token'];

    /* RELATIONSHIPS - INICIO */
    public function usuarioTipo() {
        return $this->belongsTo('App\UsuariosTipos', 'pk_usuario_tipo', 'pk_usuario_tipo');
    }

    public function creacionUsuario() {
        return $this->belongsTo('App\Usuarios', 'pk_usuario', 'creacion_pk_usuario');
    }

    public function modificacionUsuario() {
        return $this->belongsTo('App\Usuarios', 'pk_usuario', 'modificacion_pk_usuario');
    }

    public function privilegios() {
        return $this->belongsToMany('App\Privilegios', 'usuarios_privilegios', 'pk_usuario', 'pk_privilegio');
    }
    /* RELATIONSHIPS - FIN */

    public function save(array $options = array()) {

        $this['modificacion_pk_usuario'] = Auth::user()->pk_usuario;
        $this['modificacion_fecha'] = date('Y-m-d H:i:s');

        return parent::save($options);
    }

    public function create(array $options = array()) {
        if( $this['pk_usuario'] === null) {
            $this['creacion_pk_usuario'] = (Auth::check())? Auth::user()->pk_usuario : 1;
            $this['creacion_fecha'] = date('Y-m-d H:i:s');
            $this['modificacion_pk_usuario'] = (Auth::check())? Auth::user()->pk_usuario : 1;
            $this['modificacion_fecha'] = date('Y-m-d H:i:s');
            return parent::save($options);
        } else {
            return false;
        }
    }

    public function update(array $attributes = array(), array $options = array()) {
        return save($options);
    }

    public function delete() {
        if( $this['eliminado'] == 0) {
            $this['modificacion_pk_usuario'] = Auth::user()->pk_usuario;
            $this['modificacion_fecha'] = date('Y-m-d H:i:s');
            $this['eliminado'] = 1;
            return save();
        } else {
            return false;
        } 
    }
}
