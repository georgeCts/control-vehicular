<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableRecordatoriosUsuarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //TABLA RECORDATORIOS
        Schema::create('recordatorios_usuarios', function(Blueprint $table) {
            $table->increments('pk_recordatorio_usuario');
            $table->integer('pk_recordatorio')->unsigned();
            $table->integer('pk_usuario')->unsigned();

            $table->integer('creacion_pk_usuario')->unsigned();
            $table->datetime('creacion_fecha');

            $table->integer('modificacion_pk_usuario')->unsigned();
            $table->datetime('modificacion_fecha');
            $table->boolean('eliminado')->default(0);
        });

        //FOREIGNS KEYS
        Schema::table('recordatorios_usuarios', function($table) {
            $table->foreign('pk_recordatorio')->references('pk_recordatorio')->on('recordatorios');
            $table->foreign('pk_usuario')->references('pk_usuario')->on('usuarios');
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
        Schema::table('recordatorios_usuarios', function($table) {
            $table->dropForeign(['pk_recordatorio']);
            $table->dropForeign(['pk_usuario']);
            $table->dropForeign(['creacion_pk_usuario']);
            $table->dropForeign(['modificacion_pk_usuario']);
        });

        Schema::dropIfExists('recordatorios_usuarios');
    }
}
