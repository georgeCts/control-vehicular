<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class VehiculosInspeccionesFicheros extends Model
{
    protected $table = 'vehiculos_inspecciones_ficheros';
    public $timestamps = false;
    protected $primaryKey = 'pk_vehiculo_inspeccion_fichero';

    /* RELATIONSHIP - INICIO */
    public function inspeccion() {
        return $this->belongsTo('App\VehiculosInspecciones', 'pk_vehiculo_inspeccion', 'pk_vehiculo_inspeccion');
    }

    public function save(array $options = array()) {

        $this['modificacion_pk_usuario'] = Auth::user()->pk_usuario;
        $this['modificacion_fecha'] = date('Y-m-d H:i:s');

        return parent::save($options);
    }

    public function create(array $options = array()) {
        if( $this['pk_vehiculo_inspeccion_fichero'] === null) {
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
