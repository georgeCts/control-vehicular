|<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableVehiculosTipos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //TABLA TIPOS DE USUARIO
        Schema::create('vehiculos_tipos', function (Blueprint $table) {

            $table->increments('pk_vehiculo_tipo');
            $table->string('vehiculo_tipo');

            $table->integer('creacion_pk_usuario')->unsigned();
            $table->datetime('creacion_fecha');
            $table->integer('modificacion_pk_usuario')->unsigned();
            $table->datetime('modificacion_fecha');
            
            $table->boolean('eliminado')->default(0);
        });

        //FOREIGNS KEYS
        Schema::table('vehiculos_tipos', function($table) {
            $table->foreign('creacion_pk_usuario')->references('pk_usuario')->on('usuarios');
            $table->foreign('modificacion_pk_usuario')->references('pk_usuario')->on('usuarios');
        });

        //REGISTRO DE TIPOS DE USUARIOS
        DB::statement("INSERT INTO
            vehiculos_tipos
        (
            pk_vehiculo_tipo, vehiculo_tipo, creacion_pk_usuario, creacion_fecha, modificacion_pk_usuario, modificacion_fecha, eliminado
        )
            VALUES
        ( 1, 'Automóvil', 1, NOW(), 1, NOW(), 0),
        ( 2, 'Camioneta', 1, NOW(), 1, NOW(), 0), 
        ( 3, 'Motocicleta', 1, NOW(), 1, NOW(), 0)");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //FOREIGNS KEYS
        Schema::table('vehiculos_tipos', function($table) {
            $table->dropForeign(['creacion_pk_usuario']);
            $table->dropForeign(['modificacion_pk_usuario']);
        });

        Schema::dropIfExists('vehiculos_tipos');
    }
}
