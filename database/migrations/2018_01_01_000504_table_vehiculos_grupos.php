<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableVehiculosGrupos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //TABLA GRUPOS DE VEHICULOS
        Schema::create('vehiculos_grupos', function (Blueprint $table) {

            $table->increments('pk_vehiculo_grupo');
            $table->string('vehiculo_grupo');

            $table->integer('creacion_pk_usuario')->unsigned();
            $table->datetime('creacion_fecha');
            $table->integer('modificacion_pk_usuario')->unsigned();
            $table->datetime('modificacion_fecha');
            
            $table->boolean('eliminado')->default(0);
        });

        //FOREIGNS KEYS
        Schema::table('vehiculos_grupos', function($table) {
            $table->foreign('creacion_pk_usuario')->references('pk_usuario')->on('usuarios');
            $table->foreign('modificacion_pk_usuario')->references('pk_usuario')->on('usuarios');
        });

        //REGISTRO DE GRUPOS DE VEHICULOS
        DB::statement("INSERT INTO
            vehiculos_grupos
        (
            pk_vehiculo_grupo, vehiculo_grupo, creacion_pk_usuario, creacion_fecha, modificacion_pk_usuario, modificacion_fecha, eliminado
        )
            VALUES
        ( 1, 'Soporte', 1, NOW(), 1, NOW(), 0),
        ( 2, 'Consultoría', 1, NOW(), 1, NOW(), 0),
        ( 3, 'Operaciones', 1, NOW(), 1, NOW(), 0)");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //FOREIGNS KEYS
        Schema::table('vehiculos_grupos', function($table) {
            $table->dropForeign(['creacion_pk_usuario']);
            $table->dropForeign(['modificacion_pk_usuario']);
        });

        Schema::dropIfExists('vehiculos_grupos');
    }
}
