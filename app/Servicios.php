<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Servicios extends Model
{
    protected $table = "servicios";
    public $timestamps = false;
    protected $primaryKey = 'pk_servicio';

    protected $fillable = ['pk_servicio', 'nombre', 'descripcion', 'eliminado'];

    /* RELATIONSHIP - INICIO */
    public function mantenimientos() {
        return $this->hasMany('App\Mantenimientos', 'mantenimiento_servicio', 'pk_servicio', 'pk_mantenimiento');
    }
    /* RELATIONSHIP - FIN */


    public function create(array $options = array()) {
        if( $this['pk_servicio'] === null) {
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
            $this['eliminado'] = 1;
            return parent::save($options);
        } else {
            return false;
        }
    }
}
