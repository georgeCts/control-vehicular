<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableVehiculosMedidaCombustible extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //TABLA MEDIDAS DE COMBUSTIBLE
        Schema::create('vehiculos_medida_combustible', function (Blueprint $table) {

            $table->increments('pk_vehiculo_medida_combustible');
            $table->string('vehiculo_medida_combustible');
            
            $table->boolean('eliminado')->default(0);
        });

        //REGISTRO DE MEDIDA DE COMBUSTIBLE
        DB::statement("INSERT INTO
            vehiculos_medida_combustible
        (
            pk_vehiculo_medida_combustible, vehiculo_medida_combustible, eliminado
        )
            VALUES
        ( 1, 'Litros', 0),
        ( 2, 'Galones', 0)");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehiculos_medida_combustible');
    }
}
