<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehiculosStatus extends Model
{
    protected $table = "vehiculos_status";
    public $timestamps = false;
    protected $primaryKey = 'pk_vehiculo_status';

    protected $fillable = ['pk_vehiculo_status', 'vehiculo_status', 'eliminado'];

    /* RELATIONSHIP - INICIO */
    public function vehiculos() {
        return $this->hasMany('App\Vehiculos', 'pk_vehiculo_status', 'pk_vehiculo_status');
    }
    /* RELATIONSHIP - FIN */

}
