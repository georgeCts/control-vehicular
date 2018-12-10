<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableUsuariosTipos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //TABLA TIPOS DE USUARIO
        Schema::create('usuarios_tipos', function (Blueprint $table) {

            $table->increments('pk_usuario_tipo');
            $table->string('usuario_tipo');
            $table->string('descripcion')->default('');

            $table->integer('creacion_pk_usuario')->unsigned();
            $table->datetime('creacion_fecha');
            $table->integer('modificacion_pk_usuario')->unsigned();
            $table->datetime('modificacion_fecha');
            
            $table->boolean('eliminado')->default(0);
        });

        //REGISTRO DE TIPOS DE USUARIOS
        DB::statement("INSERT INTO
            usuarios_tipos
        (
            pk_usuario_tipo, usuario_tipo, descripcion, creacion_pk_usuario, creacion_fecha, modificacion_pk_usuario, modificacion_fecha, eliminado
        )
            VALUES
        ( 1, 'Administrador', 'Administradores principales del sistema', 1, NOW(), 1, NOW(), 0), 
        ( 2, 'Monitor', 'Administradores de menor rango, solo pueden monitorear algunas caracteristicas.', 1, NOW(), 1, NOW(), 0)");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios_tipos');
    }
}
