<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableIncidentesImportancia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //TABLA TIPOS DE IMPORTANCIA
        Schema::create('incidentes_importancia', function (Blueprint $table) {

            $table->increments('pk_incidente_importancia');
            $table->string('incidente_importancia');
            
            $table->boolean('eliminado')->default(0);
        });

        //REGISTRO DE TIPOS DE IMPORTANCIA
        DB::statement("INSERT INTO
            incidentes_importancia
        (
            pk_incidente_importancia, incidente_importancia, eliminado
        )
            VALUES
        ( 1, 'Crítica', 0),
        ( 2, 'Moderada', 0), 
        ( 3, 'Baja', 0)");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('incidentes_importancia');
    }
}
