<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class VehiculosInfCompra extends Model
{
    protected $table = "vehiculos_inf_compra";
    public $timestamps = false;
    protected $primaryKey = 'pk_vehiculo_inf_compra';

    /* RELATIONSHIP - INICIO */
    public function vehiculo() {
        return $this->belongsTo('App\Vehiculos', 'pk_vehiculo', 'pk_vehiculo');
    }
    /* RELATIONSHIP - FIN */

    public function save(array $options = array()) {

        $this['modificacion_pk_usuario'] = Auth::user()->pk_usuario;
        $this['modificacion_fecha'] = date('Y-m-d H:i:s');

        return parent::save($options);
    }

    public function create(array $options = array()) {
        if( $this['pk_vehiculo_inf_compra'] === null) {
            $this['creacion_pk_usuario'] = Auth::user()->pk_usuario;
            $this['creacion_fecha'] = date('Y-m-d H:i:s');
            return $this->save($options);
        } else {
            return false;
        }
    }

    public function update(array $attributes = array(), array $options = array()) {
        return $this->save($options);
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
