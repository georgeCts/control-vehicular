<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableVehiculosFotografias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //TABLA FOTOGRAFÍAS DE VEHICULOS
        Schema::create('vehiculos_fotografias', function (Blueprint $table) {

            $table->increments('pk_vehiculo_fotografia');
            $table->integer('pk_vehiculo')->unsigned();
            $table->string('titulo', 255)->nullable();
            $table->mediumText('descripcion')->nullable();
            $table->string('url_fotografia', 255);

            $table->integer('creacion_pk_usuario')->unsigned();
            $table->datetime('creacion_fecha');
            $table->integer('modificacion_pk_usuario')->unsigned();
            $table->datetime('modificacion_fecha');
            
            $table->boolean('eliminado')->default(0);
        });

        //FOREIGNS KEYS
        Schema::table('vehiculos_fotografias', function($table) {
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
        Schema::table('vehiculos_fotografias', function($table) {
            $table->dropForeign(['pk_vehiculo']);
            $table->dropForeign(['creacion_pk_usuario']);
            $table->dropForeign(['modificacion_pk_usuario']);
        });

        Schema::dropIfExists('vehiculos_fotografias');
    }
}
