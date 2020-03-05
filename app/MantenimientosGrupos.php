<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MantenimientosGrupos extends Model
{
    protected $table = "mantenimientos_grupos";
    public $timestamps = false;
    protected $primaryKey = 'pk_mantenimiento_grupo';

    public function create(array $options = array()) {
        if( $this['pk_mantenimiento_grupo'] === null) {
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
