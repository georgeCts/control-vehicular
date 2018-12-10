<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableVehiculosInfCredito extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //TABLA VEHICULO CREDITO
        Schema::create('vehiculos_inf_credito', function (Blueprint $table) {

            $table->increments('pk_vehiculo_inf_credito');
            $table->integer('pk_vehiculo')->unsigned();
            $table->date('fecha_inicial')->nullable();
            $table->date('fecha_final')->nullable();
            $table->decimal('pago_mensual', 14, 2)->nullable();
            $table->decimal('monto_financiado', 14, 2)->nullable();
            $table->decimal('tasa_interes', 14, 2)->nullable();
            $table->decimal('valor_residual', 14, 2)->nullable();
            $table->string('institucion_financiera', 255)->nullable();
            $table->string('numero_cuenta', 100)->nullable();
            $table->mediumText('notas')->nullable();

            $table->integer('creacion_pk_usuario')->unsigned();
            $table->datetime('creacion_fecha');
            $table->integer('modificacion_pk_usuario')->unsigned();
            $table->datetime('modificacion_fecha');
            
            $table->boolean('eliminado')->default(0);
        });

        //FOREIGNS KEYS
        Schema::table('vehiculos_inf_credito', function($table) {
            $table->foreign('pk_vehiculo')->references('pk_vehiculo')->on('vehiculos');
            $table->foreign('creacion_pk_usuario')->references('pk_usuario')->on('usuarios');
            $table->foreign('modificacion_pk_usuario')->references('pk_usuario')->on('usuarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //FOREIGNS KEYS
        Schema::table('vehiculos_inf_credito', function($table) {
            $table->dropForeign(['pk_vehiculo']);
            $table->dropForeign(['creacion_pk_usuario']);
            $table->dropForeign(['modificacion_pk_usuario']);
        });

        Schema::dropIfExists('vehiculos_inf_credito');
    }
}
