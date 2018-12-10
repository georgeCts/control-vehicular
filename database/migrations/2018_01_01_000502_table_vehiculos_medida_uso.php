<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableVehiculosMedidaUso extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //TABLA MEDIDAS DE USO
        Schema::create('vehiculos_medida_uso', function (Blueprint $table) {

            $table->increments('pk_vehiculo_medida_uso');
            $table->string('vehiculo_medida_uso');
            
            $table->boolean('eliminado')->default(0);
        });

        //REGISTRO DE MEDIDAS DE USO
        DB::statement("INSERT INTO
            vehiculos_medida_uso
        (
            pk_vehiculo_medida_uso, vehiculo_medida_uso, eliminado
        )
            VALUES
        ( 1, 'Kilómetros', 0),
        ( 2, 'Millas', 0),
        ( 3, 'Horas', 0)");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehiculos_medida_uso');
    }
}
