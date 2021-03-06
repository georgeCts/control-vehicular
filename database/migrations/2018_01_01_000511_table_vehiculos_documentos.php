<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableVehiculosDocumentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //TABLA DOCUMENTOS DE VEHICULOS
        Schema::create('vehiculos_documentos', function (Blueprint $table) {

            $table->increments('pk_vehiculo_documento');
            $table->integer('pk_vehiculo')->unsigned();
            $table->string('titulo', 255)->nullable();
            $table->mediumText('descripcion')->nullable();
            $table->string('url_documento', 255);

            $table->integer('creacion_pk_usuario')->unsigned();
            $table->datetime('creacion_fecha');
            $table->integer('modificacion_pk_usuario')->unsigned();
            $table->datetime('modificacion_fecha');
            
            $table->boolean('eliminado')->default(0);
        });

        //FOREIGNS KEYS
        Schema::table('vehiculos_documentos', function($table) {
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
        Schema::table('vehiculos_documentos', function($table) {
            $table->dropForeign(['pk_vehiculo']);
            $table->dropForeign(['creacion_pk_usuario']);
            $table->dropForeign(['modificacion_pk_usuario']);
        });

        Schema::dropIfExists('vehiculos_documentos');
    }
}
