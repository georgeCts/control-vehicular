<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableVehiculosStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //TABLA TIPOS DE USUARIO
        Schema::create('vehiculos_status', function (Blueprint $table) {

            $table->increments('pk_vehiculo_status');
            $table->string('vehiculo_status');
            $table->string('clase_nombre');
            
            $table->boolean('eliminado')->default(0);
        });

        //REGISTRO DE TIPOS DE USUARIOS
        DB::statement("INSERT INTO
            vehiculos_status
        (
            pk_vehiculo_status, vehiculo_status, clase_nombre, eliminado
        )
            VALUES
        ( 1, 'Asignado', 'primary', 0),
        ( 2, 'Disponible', 'success', 0),
        ( 3, 'En Taller', 'warning', 0),
        ( 4, 'Fuera de Servicio', 'danger', 0)");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehiculos_status');
    }
}
