<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableServicios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //TABLA TIPOS DE SERVICIOS
        Schema::create('servicios', function (Blueprint $table) {

            $table->increments('pk_servicio');
            $table->string('nombre', 255);
            $table->mediumText('descripcion')->nullable();

            $table->boolean('eliminado')->default(0);
        });

        //REGISTRO DE TIPOS DE SERVICIO
        DB::statement("INSERT INTO
            servicios
        (
            pk_servicio, nombre, eliminado
        )
            VALUES
        ( 1, 'A/C Reemplazo Compresor', 0),
        ( 2, 'A/C Diagnóstico', 0),
        ( 3, 'A/C Recarga de Gas', 0),
        ( 4, 'A/C Reemplazo Condensador', 0),
        ( 5, 'A/C Reemplazo Evaporador', 0),
        ( 6, 'Balanceo de Llantas', 0),
        ( 7, 'Cambio de Aceite', 0),
        ( 8, 'Cambio de Líquido de Transmisión', 0),
        ( 9, 'Diagnóstico de Sistema de Carga', 0),
        ( 10, 'Inspección de Banda de Motor', 0),
        ( 11, 'Inspección de incidentes_importanciaatería', 0),
        ( 12, 'Inspección de incidentes_importanciarenos', 0),
        ( 13, 'Lavado', 0),
        ( 14, 'Otro Mantenimiento', 0),
        ( 15, 'Reemplazo Alternador', 0),
        ( 16, 'Reemplazo de Amortiguadores', 0),
        ( 17, 'Reemplazo de Anticongelante', 0),
        ( 18, 'Reemplazo de Arranque', 0),
        ( 19, 'Reemplazo de Balatas de Freno', 0),
        ( 20, 'Reemplazo de Baleros de Ruedas', 0),
        ( 21, 'Reemplazo de Banda de Motor', 0),
        ( 22, 'Reemplazo de Batería', 0),
        ( 23, 'Reemplazo de Bobina de Arranque', 0),
        ( 24, 'Reemplazo de Bomba de Aceite', 0),
        ( 25, 'Reemplazo de Bomba de Agua', 0),
        ( 26, 'Reemplazo de Bomba de Combustible', 0),
        ( 27, 'Reemplazo de Bomba de Dirección', 0),
        ( 28, 'Reemplazo de Caliper de Freno', 0),
        ( 29, 'Reemplazo de Convertidor Catalítico', 0),
        ( 30, 'Reemplazo de Escape', 0),
        ( 31, 'Reemplazo de Filtro de Aceite', 0),
        ( 32, 'Reemplazo de Filtro de Transmisión', 0),
        ( 33, 'Reemplazo de Inyectores de Combustible', 0),
        ( 34, 'Reemplazo de Limpiabrisas', 0),
        ( 35, 'Reemplazo de Llanta', 0),
        ( 36, 'Reemplazo de Manguera de Calefacción', 0),
        ( 37, 'Reemplazo de Manguera de Dirección', 0),
        ( 38, 'Reemplazo de Motor/Regulador de Ventana', 0),
        ( 39, 'Reemplazo de Rótulas', 0),
        ( 40, 'Reemplazo de Sensor de Oxígeno', 0),
        ( 41, 'Reemplazo de Soportes de Motor', 0),
        ( 42, 'Reemplazo de Termostato', 0),
        ( 43, 'Reemplazo de Tornillos Estabilizadores', 0),
        ( 44, 'Reemplazo de Transmisión', 0),
        ( 45, 'Reemplazo Filtro de Aire', 0),
        ( 46, 'Reparación de Radiador', 0),
        ( 47, 'Revisión de Soportes de Motor', 0),
        ( 48, 'Revisión de Suspensión', 0),
        ( 49, 'Rotación de Llantas', 0),
        ( 50, 'Servicio a Llanta', 0),
        ( 51, 'Servicio de Afinación Básica', 0),
        ( 52, 'Servicio de Afinación Mayor', 0),
        ( 53, 'Servicio de Alineación', 0),
        ( 54, 'Servicio Programado de Agencia', 0)");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servicios');
    }
}
