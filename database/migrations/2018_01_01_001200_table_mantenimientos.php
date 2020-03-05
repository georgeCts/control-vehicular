<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableMantenimientos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //TABLA RECORDATORIOS
        Schema::create('mantenimientos', function(Blueprint $table) {
            $table->increments('pk_mantenimiento');
            $table->integer('pk_vehiculo')->unsigned();
            $table->datetime('inicio_fecha')->nullable();
            $table->datetime('terminacion_fecha');
            $table->decimal('odometro', 14, 2);
            $table->decimal('costo', 14, 2);

            $table->string('referencia', 255)->nullable();
            $table->integer('pk_mantenimiento_tipo')->nullable()->unsigned();
            $table->integer('pk_mantenimiento_grupo')->nullable()->unsigned();
            $table->integer('pk_proveedor')->nullable()->unsigned();
            $table->mediumText('descripcion');

            $table->integer('creacion_pk_usuario')->unsigned();
            $table->datetime('comentarios');

            $table->integer('modificacion_pk_usuario')->unsigned();
            $table->datetime('modificacion_fecha');
            $table->boolean('eliminado')->default(0);
        });

        //FOREIGNS KEYS
        Schema::table('mantenimientos', function($table) {
            $table->foreign('pk_vehiculo')->references('pk_vehiculo')->on('vehiculos');
            $table->foreign('pk_mantenimiento_tipo')->references('pk_mantenimiento_tipo')->on('mantenimientos_tipos');
            $table->foreign('pk_mantenimiento_grupo')->references('pk_mantenimiento_grupo')->on('mantenimientos_grupos');
            $table->foreign('pk_proveedor')->references('pk_proveedor')->on('proveedores');
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
        Schema::table('mantenimientos', function($table) {
            $table->dropForeign(['pk_vehiculo']);
            $table->dropForeign(['pk_mantenimiento_tipo']);
            $table->dropForeign(['pk_mantenimiento_grupo']);
            $table->dropForeign(['pk_proveedor']);
            $table->dropForeign(['creacion_pk_usuario']);
            $table->dropForeign(['modificacion_pk_usuario']);
        });

        Schema::dropIfExists('mantenimientos');
    }
}
