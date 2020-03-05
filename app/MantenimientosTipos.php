<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MantenimientosTipos extends Model
{
    protected $table = "mantenimientos_tipos";
    public $timestamps = false;
    protected $primaryKey = 'pk_mantenimiento_tipo';
}
