<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableMantenimientosServicios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mantenimiento_servicio', function (Blueprint $table) {

            $table->increments('pk_mantenimiento_servicio');
            $table->integer('pk_mantenimiento')->unsigned();
            $table->integer('pk_servicio')->unsigned();
        });

        //FOREIGNS KEYS
        Schema::table('mantenimiento_servicio', function($table) {
            $table->foreign('pk_mantenimiento')->references('pk_mantenimiento')->on('mantenimientos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('pk_servicio')->references('pk_servicio')->on('servicios')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::table('mantenimiento_servicio', function($table) {
            $table->dropForeign(['pk_mantenimiento']);
            $table->dropForeign(['pk_servicio']);
        });

        Schema::dropIfExists('mantenimiento_servicio');
    }
}
