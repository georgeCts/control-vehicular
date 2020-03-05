<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableMantenimientosGrupos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //TABLA GRUPOS DE MANTENIMIENTO
        Schema::create('mantenimientos_grupos', function (Blueprint $table) {

            $table->increments('pk_mantenimiento_grupo');
            $table->string('nombre', 255);

            $table->boolean('eliminado')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mantenimientos_grupos');
    }
}
