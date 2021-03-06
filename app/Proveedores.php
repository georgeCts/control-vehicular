<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Proveedores extends Model
{
    protected $table = 'proveedores';
    public $timestamps = false;
    protected $primaryKey = 'pk_proveedor';

    protected $fillable = ['nombre_comercial', 'telefono', 'domicilio', 'ciudad', 'estado', 'contacto_nombre', 'contacto_telefono', 'contacto_correo', 'creacion_pk_usuario', 'creacion_fecha', 'modificacion_pk_usuario', 'modificacion_fecha', 'eliminado'];

    /* RELATIONSHIPS - INICIO */
    public function creacionUsuario() {
        return $this->belongsTo('App\Usuarios', 'pk_usuario', 'creacion_pk_usuario');
    }

    public function modificacionUsuario() {
        return $this->belongsTo('App\Usuarios', 'pk_usuario', 'modificacion_pk_usuario');
    }

    public function gastoAdicional() {
        return $this->hasMany('App\GastosAdicionales', 'pk_proveedor', 'pk_proveedor');
    }
    /* RELATIONSHIPS - FIN */

    
    public function save(array $options = array()) {

        $this['modificacion_pk_usuario'] = Auth::user()->pk_usuario;
        $this['modificacion_fecha'] = date('Y-m-d H:i:s');

        return parent::save($options);
    }

    public function create(array $options = array()) {
        if( $this['pk_proveedor'] === null) {
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
        return parent::save($options);
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
