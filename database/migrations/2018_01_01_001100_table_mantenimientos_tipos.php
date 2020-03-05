<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableMantenimientosTipos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //TABLA TIPOS DE MANTENIMIENTO
        Schema::create('mantenimientos_tipos', function (Blueprint $table) {

            $table->increments('pk_mantenimiento_tipo');
            $table->string('mantenimiento_tipo');

            $table->boolean('eliminado')->default(0);
        });

        //REGISTRO DE MEDIDA DE COMBUSTIBLE
        DB::statement("INSERT INTO
            mantenimientos_tipos
        (
            pk_mantenimiento_tipo, mantenimiento_tipo, eliminado
        )
            VALUES
        ( 1, 'Preventivo', 0),
        ( 2, 'Correctivo', 0)");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mantenimientos_tipos');
    }
}
