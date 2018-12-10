<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IncidentesImportancia extends Model
{
    protected $table = "incidentes_importancia";
    public $timestamps = false;
    protected $primaryKey = 'pk_incidente_importancia';

    protected $fillable = ['pk_incidente_importancia', 'incidente_importancia', 'eliminado'];

    /* RELATIONSHIP - INICIO */
    public function incidentes() {
        return $this->hasMany('App\Incidentes', 'pk_incidente_importancia', 'pk_incidente_importancia');
    }
    /* RELATIONSHIP - FIN */
}
