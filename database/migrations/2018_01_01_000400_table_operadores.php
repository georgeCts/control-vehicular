<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableOperadores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //TABLA PROVEEDORES
        Schema::create('operadores', function(Blueprint $table) {
            
            $table->increments('pk_operador');
            $table->string('nombre', 255);
            $table->string('telefono', 40)->nullable();
            $table->string('domicilio', 255)->nullable();

            $table->string('licencia_url', 255)->nullable();
            $table->string('licencia_folio', 40)->nullable();
            $table->date('licencia_vigencia');


            $table->integer('creacion_pk_usuario')->unsigned();
            $table->datetime('creacion_fecha');

            $table->integer('modificacion_pk_usuario')->unsigned();
            $table->datetime('modificacion_fecha');
            $table->boolean('eliminado')->default(0);
        });

        //FOREIGNS KEYS
        Schema::table('operadores', function($table) {
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
        Schema::table('operadores', function($table) {
            $table->dropForeign(['creacion_pk_usuario']);
            $table->dropForeign(['modificacion_pk_usuario']);
        });

        Schema::dropIfExists('operadores');
    }
}
