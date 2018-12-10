<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableVehiculosInspeccionesFicheros extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //TABLA FICHERO DE INSPECCIONES
        Schema::create('vehiculos_inspecciones_ficheros', function (Blueprint $table) {

            $table->increments('pk_vehiculo_inspeccion_fichero');
            $table->integer('pk_vehiculo_inspeccion')->unsigned();
            $table->string('url_imagen', 255);

            $table->integer('creacion_pk_usuario')->unsigned();
            $table->datetime('creacion_fecha');
            $table->integer('modificacion_pk_usuario')->unsigned();
            $table->datetime('modificacion_fecha');
            
            $table->boolean('eliminado')->default(0);
        });

        //FOREIGNS KEYS
        Schema::table('vehiculos_inspecciones_ficheros', function($table) {
            $table->foreign('pk_vehiculo_inspeccion')->references('pk_vehiculo_inspeccion')->on('vehiculos_inspecciones');
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
        Schema::table('vehiculos_inspecciones_ficheros', function($table) {
            $table->dropForeign(['pk_vehiculo_inspeccion']);
            $table->dropForeign(['creacion_pk_usuario']);
            $table->dropForeign(['modificacion_pk_usuario']);
        });

        Schema::dropIfExists('vehiculos_inspecciones_ficheros');
    }
}
