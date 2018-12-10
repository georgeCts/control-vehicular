<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class VehiculosInspecciones extends Model
{
    protected $table = 'vehiculos_inspecciones';
    public $timestamps = false;
    protected $primaryKey = 'pk_vehiculo_inspeccion';

    /* RELATIONSHIP - INICIO */
    public function vehiculo() {
        return $this->belongsTo('App\Vehiculos', 'pk_vehiculo', 'pk_vehiculo');
    }

    public function operador() {
        return $this->belongsTo('App\Operadores', 'pk_operador', 'pk_operador');
    }

    public function usuarioEntrega() {
        return $this->belongsTo('App\Usuarios', 'entrega_pk_usuario', 'pk_usuario');
    }

    public function operadorRecibe() {
        return $this->belongsTo('App\Operadores', 'recibe_pk_operador', 'pk_operador');
    }

    public function creacionUsuario() {
        return $this->belongsTo('App\Usuarios', 'pk_usuario', 'creacion_pk_usuario');
    }

    public function modificacionUsuario() {
        return $this->belongsTo('App\Usuarios', 'pk_usuario', 'modificacion_pk_usuario');
    }
    /* RELATIONSHIP - FIN */


    public function save(array $options = array()) {

        $this['modificacion_pk_usuario'] = Auth::user()->pk_usuario;
        $this['modificacion_fecha'] = date('Y-m-d H:i:s');

        return parent::save($options);
    }

    public function create(array $options = array()) {
        if( $this['pk_vehiculo_inspeccion'] === null) {
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
            return $this->save();
        } else {
            return false;
        } 
    }
}
