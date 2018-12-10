<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Exceptions\ApplicationException;
use \Exception;
use DB;
use Auth;

use App\VehiculosOdometro;
use App\VehiculosInfCompra;
use App\VehiculosInfCredito;

class Vehiculos extends Model
{
    protected $table = 'vehiculos';
    public $timestamps = false;
    protected $primaryKey = 'pk_vehiculo';

    protected $fillable = [ 'vehiculo_nombre', 
                            'vehiculo_marca', 
                            'vehiculo_modelo', 
                            'vehiculo_ano', 
                            
                            'pk_vehiculo_tipo', 
                            'pk_vehiculo_status', 
                            'pk_vehiculo_medida_uso', 
                            'pk_vehiculo_medida_combustible',
                            
                            'pk_vehiculo_grupo',
                            'vehiculo_numero_serie',
                            'vehiculo_placa',
                            'vehiculo_color',
                            'vehiculo_seguro',
                            'vehiculo_poliza',
                            'vehiculo_poliza_vigencia',

                            'creacion_pk_usuario', 
                            'creacion_fecha', 
                            'modificacion_pk_usuario', 
                            'modificacion_fecha', 
                            'eliminado'];

    /* RELATIONSHIPS - INICIO */
    public function vehiculoTipo() {
        return $this->belongsTo('App\VehiculosTipos', 'pk_vehiculo_tipo', 'pk_vehiculo_tipo');
    }

    public function vehiculoStatus() {
        return $this->belongsTo('App\VehiculosStatus', 'pk_vehiculo_status', 'pk_vehiculo_status');
    }

    public function vehiculoMedidaUso() {
        return $this->belongsTo('App\VehiculosMedidasUso', 'pk_vehiculo_medida_uso', 'pk_vehiculo_medida_uso');
    }

    public function vehiculoMedidaCombustible() {
        return $this->belongsTo('App\VehiculosMedidasCombustible', 'pk_vehiculo_medida_combustible', 'pk_vehiculo_medida_combustible');
    }

    public function vehiculoGrupo() {
        return $this->belongsTo('App\VehiculosGrupos', 'pk_vehiculo_grupo', 'pk_vehiculo_grupo');
    }


    //ODOMETRO
    public function vehiculoUltimoOdometro() {
        return $this->hasOne('App\VehiculosOdometro', 'pk_vehiculo', 'pk_vehiculo');
    }

    public function vehiculoOdometro() {
        return $this->hasMany('App\VehiculosOdometro', 'pk_vehiculo', 'pk_vehiculo');
    }


    //GASTOS ADICIONALES
    public function gastoAdicional() {
        return $this->hasMany('App\GastosAdicionales', 'pk_vehiculo', 'pk_vehiculo');
    }

    public function creacionUsuario() {
        return $this->belongsTo('App\Usuarios', 'pk_usuario', 'creacion_pk_usuario');
    }

    public function modificacionUsuario() {
        return $this->belongsTo('App\Usuarios', 'pk_usuario', 'modificacion_pk_usuario');
    }
    /* RELATIONSHIPS - FIN */

    
    public function save(array $options = array()) {

        $this['modificacion_pk_usuario'] = Auth::user()->pk_usuario;
        $this['modificacion_fecha'] = date('Y-m-d H:i:s');

        return parent::save($options);
    }

    public function create(array $options = array(), $innerTransaction = true) {

        if($innerTransaction) DB::beginTransaction();

        try {
            if( $this['pk_vehiculo'] === null) {
                $this['creacion_pk_usuario'] = (Auth::check())? Auth::user()->pk_usuario : 1;
                $this['creacion_fecha'] = date('Y-m-d H:i:s');
                $this['modificacion_pk_usuario'] = (Auth::check())? Auth::user()->pk_usuario : 1;
                $this['modificacion_fecha'] = date('Y-m-d H:i:s');

                if($this->save()) {

                    $objOdometro = new VehiculosOdometro();
                    $objOdometro->pk_vehiculo = $this['pk_vehiculo'];
                    $objOdometro->odometro = 0;
                    $objOdometro->create();

                    $objCompra = new VehiculosInfCompra();
                    $objCompra->pk_vehiculo = $this['pk_vehiculo'];
                    $objCompra->create();

                    $objCredito = new VehiculosInfCredito();
                    $objCredito->pk_vehiculo = $this['pk_vehiculo'];
                    $objCredito->create();

                    if($innerTransaction) DB::commit();
                    return true;

                } else {
                    throw new ApplicationException('VEHICULOS_CREATE_02');
                }
            } else {
                throw new ApplicationException('VEHICULOS_CREATE_02');
            }
        } catch(ApplicationException $exception) {
            if($innerTransaction) DB::rollBack();
            throw $exception;
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
