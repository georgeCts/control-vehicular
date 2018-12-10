<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableUsuariosBitacora extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //TABLA BITACORAS DE USUARIO
        Schema::create('usuarios_bitacora', function (Blueprint $table) {

            $table->increments('pk_usuario_bitacora');
            $table->integer('pk_usuario')->unsigned();
            $table->string('descripcion')->default('');
            $table->datetime('creacion_fecha');
        });

        //FOREIGNS KEYS
        Schema::table('usuarios_bitacora', function($table) {
            $table->foreign('pk_usuario')->references('pk_usuario')->on('usuarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usuarios_bitacora', function($table) {
            $table->dropForeign(['pk_usuario']);
        });

        Schema::dropIfExists('usuarios_bitacora');
    }
}
