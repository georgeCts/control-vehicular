<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Recordatorios extends Model
{
    protected $table = "recordatorios";
    public $timestamps = false;
    protected $primaryKey = 'pk_recordatorio';

    /* RELATIONSHIP - INICIO */
    public function vehiculo() {
        return $this->belongsTo('App\Vehiculos', 'pk_vehiculo', 'pk_vehiculo');
    }

    public function notificados() {
        return $this->hasMany('App\RecordatoriosUsuarios', 'pk_recordatorio', 'pk_recordatorio');
    }

    public function creacionUsuario() {
        return $this->hasOne('App\Usuarios', 'pk_usuario', 'creacion_pk_usuario');
    }

    public function modificacionUsuario() {
        return $this->hasOne('App\Usuarios', 'pk_usuario', 'modificacion_pk_usuario');
    }
    /* RELATIONSHIP - FIN */

    public function save(array $options = array()) {

        $this['modificacion_pk_usuario'] = Auth::user()->pk_usuario;
        $this['modificacion_fecha'] = date('Y-m-d H:i:s');

        return parent::save($options);
    }

    public function create(array $options = array()) {
        if( $this['pk_recordatorio'] === null) {
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
