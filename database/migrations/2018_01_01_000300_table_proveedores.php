<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableProveedores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //TABLA PROVEEDORES
        Schema::create('proveedores', function(Blueprint $table) {
            
            $table->increments('pk_proveedor');
            $table->string('nombre_comercial', 255);
            $table->string('telefono', 40)->nullable();
            $table->string('domicilio', 255)->nullable();
            $table->string('ciudad', 100)->nullable();
            $table->string('estado', 100)->nullable();

            $table->string('contacto_nombre', 255)->nullable();
            $table->string('contacto_telefono', 40)->nullable();
            $table->string('contacto_correo', 150)->nullable();


            $table->integer('creacion_pk_usuario')->unsigned();
            $table->datetime('creacion_fecha');

            $table->integer('modificacion_pk_usuario')->unsigned();
            $table->datetime('modificacion_fecha');
            $table->boolean('eliminado')->default(0);
        });

        //FOREIGNS KEYS
        Schema::table('proveedores', function($table) {
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
        Schema::table('proveedores', function($table) {
            $table->dropForeign(['creacion_pk_usuario']);
            $table->dropForeign(['modificacion_pk_usuario']);
        });

        Schema::dropIfExists('proveedores');
    }
}
