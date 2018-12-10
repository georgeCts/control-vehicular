<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class GastosAdicionales extends Model
{
    protected $table = "gastos_adicionales";
    public $timestamps = false;
    protected $primaryKey = 'pk_gasto_adicional';

    protected $fillable = [ 'pk_gasto_adicional', 
                            'fecha', 
                            'concepto', 
                            'referencia', 
                            'importe', 
                            'pk_vehiculo', 
                            'pk_operador', 
                            'pk_proveedor', 
                            'comentarios', 
                            'creacion_pk_usuario', 
                            'creacion_fecha', 
                            'modificacion_pk_usuario', 
                            'modificacion_fecha', 
                            'eliminado'];

    /* RELATIONSHIP - INICIO */
    public function vehiculo() {
        return $this->belongsTo('App\Vehiculos', 'pk_vehiculo', 'pk_vehiculo');
    }

    public function proveedor() {
        return $this->belongsTo('App\Proveedores', 'pk_proveedor', 'pk_proveedor');
    }

    public function operador() {
        return $this->belongsTo('App\Operadores', 'pk_operador', 'pk_operador');
    }

    public function creacionUsuario() {
        return $this->belongsTo('App\Usuarios', 'pk_usuario', 'creacion_pk_usuario');
    }

    public function modificacionUsuario() {
        return $this->belongsTo('App\Usuarios', 'pk_usuario', 'modificacion_pk_usuario');
    }
    /* RELATIONSHIP - FIN */


    public function save(array $options = array()) {

        $this['modificacion_pk_usuario'] = Auth::user()->pk_usuario;
        $this['modificacion_fecha'] = date('Y-m-d H:i:s');

        return parent::save($options);
    }

    public function create(array $options = array()) {
        if( $this['pk_gasto_adicional'] === null) {
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
