<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehiculosMedidasUso extends Model
{
    protected $table = "vehiculos_medida_uso";
    public $timestamps = false;
    protected $primaryKey = 'pk_vehiculo_medida_uso';

    protected $fillable = ['pk_vehiculo_medida_uso', 'vehiculo_medida_uso', 'eliminado'];

    /* RELATIONSHIP - INICIO */
    public function vehiculos() {
        return $this->hasMany('App\Vehiculos', 'pk_vehiculo_medida_uso', 'pk_vehiculo_medida_uso');
    }
    /* RELATIONSHIP - FIN */
}
