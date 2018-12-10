<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablePrivilegiosCategorias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //TABLA PRIVILEGIOS_CATEGORIAS
        Schema::create('privilegios_categorias', function(Blueprint $table) {
            $table->increments('pk_privilegio_categoria');
            $table->string('privilegio_categoria', 80)->unique();
            $table->integer('menu_orden')->nullable();
            $table->string('menu_icono', 100)->nullable();
        });



        //NEW ROW
        DB::statement("INSERT INTO
            privilegios_categorias
        (
            pk_privilegio_categoria, privilegio_categoria, menu_orden, menu_icono
        )
        VALUES
            (1, 'Vehículos', 1, 'fa-car'),
            (4, 'Servicios', 2, 'fa-wrench'),
            (2, 'Operadores', 3, 'fa-drivers-license'),
            (3, 'Proveedores', 4, 'fa-building-o'),
            (5, 'Usuarios', 5, 'fa-users')");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('privilegios_categorias');
    }
}
