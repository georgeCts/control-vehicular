<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class VehiculosTipos extends Model
{
    protected $table = "vehiculos_tipos";
    public $timestamps = false;
    protected $primaryKey = 'pk_vehiculo_tipo';

    protected $fillable = ['pk_vehiculo_tipo', 'vehiculo_tipo', 'creacion_pk_usuario', 'creacion_fecha', 'modificacion_pk_usuario', 'modificacion_fecha', 'eliminado'];

    /* RELATIONSHIP - INICIO */
    public function vehiculos() {
        return $this->hasMany('App\Vehiculos', 'pk_vehiculo_tipo', 'pk_vehiculo_tipo');
    }
    /* RELATIONSHIP - FIN */


    public function save(array $options = array()) {

        $this['modificacion_pk_usuario'] = Auth::user()->pk_usuario;
        $this['modificacion_fecha'] = date('Y-m-d H:i:s');

        return parent::save($options);
    }

    public function create(array $options = array()) {
        if( $this['pk_vehiculo_tipo'] === null) {
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
