<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableVehiculos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //TABLA VEHICULOS TIPOS
        Schema::create('vehiculos', function(Blueprint $table) {
            
            $table->increments('pk_vehiculo');
            $table->string('vehiculo_nombre', 255);
            $table->string('vehiculo_marca', 100);
            $table->string('vehiculo_modelo', 100);
            $table->integer('vehiculo_ano')->nullable();

            $table->integer('pk_vehiculo_tipo')->unsigned();
            $table->integer('pk_vehiculo_status')->unsigned();
            $table->integer('pk_vehiculo_medida_uso')->unsigned();
            $table->integer('pk_vehiculo_medida_combustible')->unsigned();

            $table->integer('pk_vehiculo_grupo')->nullable()->unsigned();
            $table->string('vehiculo_numero_serie', 100)->nullable();          
            $table->string('vehiculo_placa', 100)->nullable();
            $table->string('vehiculo_color', 100)->nullable();
            $table->string('vehiculo_seguro', 255)->nullable();
            $table->string('vehiculo_poliza', 255)->nullable();
            $table->date('vehiculo_poliza_vigencia')->nullable();

            $table->integer('creacion_pk_usuario')->unsigned();
            $table->datetime('creacion_fecha');
            $table->integer('modificacion_pk_usuario')->unsigned();
            $table->datetime('modificacion_fecha');
            $table->boolean('eliminado')->default(0);
        });

        //FOREIGNS KEYS
        Schema::table('vehiculos', function($table) {
            $table->foreign('pk_vehiculo_tipo')->references('pk_vehiculo_tipo')->on('vehiculos_tipos');
            $table->foreign('pk_vehiculo_status')->references('pk_vehiculo_status')->on('vehiculos_status');
            $table->foreign('pk_vehiculo_medida_uso')->references('pk_vehiculo_medida_uso')->on('vehiculos_medida_uso');
            $table->foreign('pk_vehiculo_medida_combustible')->references('pk_vehiculo_medida_combustible')->on('vehiculos_medida_combustible');
            $table->foreign('pk_vehiculo_grupo')->references('pk_vehiculo_grupo')->on('vehiculos_grupos');
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
        Schema::table('vehiculos', function($table) {
            $table->dropForeign(['pk_vehiculo_tipo']);
            $table->dropForeign(['pk_vehiculo_status']);
            $table->dropForeign(['pk_vehiculo_medida_uso']);
            $table->dropForeign(['pk_vehiculo_medida_combustible']);
            $table->dropForeign(['pk_vehiculo_grupo']);
            $table->dropForeign(['creacion_pk_usuario']);
            $table->dropForeign(['modificacion_pk_usuario']);
        });

        Schema::dropIfExists('vehiculos');
    }
}
