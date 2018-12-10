<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Operadores extends Model
{
    protected $table = 'operadores';
    public $timestamps = false;
    protected $primaryKey = 'pk_operador';

    protected $fillable = ['nombre', 'telefono', 'domicilio', 'licencia_url', 'licencia_folio', 'licencia_vigencia', 'creacion_pk_usuario', 'creacion_fecha', 'modificacion_pk_usuario', 'modificacion_fecha', 'eliminado'];

    /* RELATIONSHIPS - INICIO */
    public function creacionUsuario() {
        return $this->belongsTo('App\Usuarios', 'pk_usuario', 'creacion_pk_usuario');
    }

    public function modificacionUsuario() {
        return $this->belongsTo('App\Usuarios', 'pk_usuario', 'modificacion_pk_usuario');
    }

    public function gastoAdicional() {
        return $this->hasMany('App\GastosAdicionales', 'pk_operador', 'pk_operador');
    }
    /* RELATIONSHIPS - FIN */



    public function save(array $options = array()) {

        $this['modificacion_pk_usuario'] = Auth::user()->pk_usuario;
        $this['modificacion_fecha'] = date('Y-m-d H:i:s');

        return parent::save($options);
    }

    public function create(array $options = array()) {
        if( $this['pk_operador'] === null) {
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
            return save();
        } else {
            return false;
        } 
    }
}
