<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehiculosMedidasCombustible extends Model
{
    protected $table = "vehiculos_medida_combustible";
    public $timestamps = false;
    protected $primaryKey = 'pk_vehiculo_medida_combustible';

    protected $fillable = ['pk_vehiculo_medida_combustible', 'vehiculo_medida_combustible', 'eliminado'];

    /* RELATIONSHIP - INICIO */
    public function vehiculos() {
        return $this->hasMany('App\Vehiculos', 'pk_vehiculo_medida_combustible', 'pk_vehiculo_medida_combustible');
    }
    /* RELATIONSHIP - FIN */
}
