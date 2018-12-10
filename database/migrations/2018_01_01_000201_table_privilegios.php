<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablePrivilegios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //TABLA PRIVILEGIOS_CATEGORIAS
        Schema::create('privilegios', function(Blueprint $table) {
            $table->increments('pk_privilegio');
            $table->integer('pk_privilegio_categoria')->unsigned();
            $table->integer('padre_pk_privilegio')->unsigned()->nullable();
            $table->string('privilegio', 150)->unique();
            $table->string('etiqueta', 120);

            $table->boolean('menu');
            $table->integer('menu_orden')->nullable();
            $table->string('menu_url', 200)->nullable();
            $table->boolean('activo');

        });


        //FOREIGNS KEYS
        Schema::table('privilegios', function($table) {
            $table->foreign('pk_privilegio_categoria')->references('pk_privilegio_categoria')->on('privilegios_categorias');
        });


        DB::statement("INSERT INTO
            privilegios
        (
            pk_privilegio, pk_privilegio_categoria, padre_pk_privilegio, privilegio, etiqueta, 
            menu, menu_orden, menu_url, activo
        )
        VALUES
            (1, 1, NULL, 'VEHICULOS', 'Inventario',                 1, 1, 'vehiculos', 1),
            (2, 1, NULL, 'VEHICULOS_REGISTRAR', 'Registrar',        1, 2, 'vehiculos/registrar', 1),
            (3, 1, NULL, 'VEHICULOS_COMBUSTIBLE', 'Combustible',    1, 3, 'vehiculos/cargas', 1),
            (4, 1, NULL, 'VEHICULOS_INCIDENTE', 'Incidentes',       1, 4, 'vehiculos/incidentes', 1),
            (5, 1, NULL, 'VEHICULOS_RECORDATORIO', 'Recordatorios', 1, 5, 'vehiculos/recordatorios', 1),
            (6, 1, NULL, 'VEHICULOS_GASTOS_ADICIONALES', 'Gastos Adicionales',    1, 6, 'vehiculos/gastos', 1),
            (7, 1, NULL, 'VEHICULOS_TIPOS', 'Tipos de Vehículo',    1, 7, 'vehiculos/tipos', 1),
            (8, 1, NULL, 'VEHICULOS_GRUPOS', 'Grupos',              1, 8, 'vehiculos/grupos', 1),
            (9, 1, NULL, 'VEHICULOS_ARCHIVO', 'Archivo',            1, 9, 'vehiculos/archivo', 1),
            (10, 1, NULL, 'VEHICULOS_REPORTES', 'Reportes',         1, 10, 'vehiculos/reportes', 1),


            (11, 4, NULL, 'SERVICIOS', 'Bitácora',                      1, 1, 'servicios/bitacora', 1),
            (12, 4, NULL, 'SERVICIOS_APLICAR_MANT', 'Aplicar Mantenimiento',  1, 2, 'servicios/aplicar_mant', 1),
            (13, 4, NULL, 'SERVICIOS_GRUPO', 'Grupos',                  1, 3, 'servicios/grupos', 1),
            (14, 4, NULL, 'SERVICIOS_RECORDATORIO', 'Recordatorios',    1, 4, 'servicios/recordatorios', 1),
            (15, 4, NULL, 'SERVICIOS_CATALOGO', 'Catálogo Servicios',   1, 5, 'servicios', 1),

            (16, 2, NULL, 'OPERADORES', 'Consultar',                    1, 1, 'operadores', 1),
            (17, 2, NULL, 'OPERADORES_ASIGNACION', 'Asignaciones',      1, 2, 'operadores/asignaciones', 1),


            (18, 3, NULL, 'PROVEEDORES', 'Consultar',                   1, 1, 'proveedores', 1),
            (19, 3, NULL, 'PROVEEDORES_REGISTRAR', 'Registrar',         1, 2, 'proveedores/registrar', 1),

            (20, 5, NULL, 'USUARIOS', 'Consultar',                      1, 1, 'usuarios', 1),
            (21, 5, NULL, 'USUARIOS_BITACORA', 'Bitácora',              1, 2, 'usuarios/bitacora', 1),
            (22, 5, NULL, 'USUARIOS_ROLES', 'Roles y Facultades',       1, 3, 'usuarios/roles', 1);");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('privilegios', function($table) {
            $table->dropForeign(['pk_privilegio_categoria']);
        });
        
        Schema::dropIfExists('privilegios');
    }
}
