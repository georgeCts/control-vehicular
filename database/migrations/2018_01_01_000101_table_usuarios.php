<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableUsuarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //TABLA ADMINISTRADORES
        Schema::create('usuarios', function(Blueprint $table) {
            
            $table->increments('pk_usuario');
            $table->integer('pk_usuario_tipo')->unsigned();
            $table->string('nombre', 100);
            $table->string('apellido_paterno', 100);
            $table->string('apellido_materno', 100)->nullable();
            $table->string('correo', 150)->unique()->nullable();
            $table->string('imagen', 255)->default('avatar.jpg');
            
            /*** CONTROL DE ACCESO ***/
            $table->string('usuario', 150)->unique()->nullable();
            $table->string('password', 255)->nullable();
            $table->rememberToken();

            $table->integer('numero_accesos')->default(0);
            $table->datetime('ultimo_acceso_fecha')->nullable();

            $table->integer('creacion_pk_usuario')->unsigned();
            $table->datetime('creacion_fecha');

            $table->integer('modificacion_pk_usuario')->unsigned();
            $table->datetime('modificacion_fecha');
            $table->boolean('eliminado')->default(0);
        });

        //FOREIGNS KEYS
        Schema::table('usuarios', function($table) {
            $table->foreign('pk_usuario_tipo')->references('pk_usuario_tipo')->on('usuarios_tipos');
            $table->foreign('creacion_pk_usuario')->references('pk_usuario')->on('usuarios');
            $table->foreign('modificacion_pk_usuario')->references('pk_usuario')->on('usuarios');
        });

        //NEW ROW
        DB::statement("INSERT INTO
                usuarios
            (
                pk_usuario, 
                pk_usuario_tipo, 
                nombre, 
                apellido_paterno, 
                apellido_materno,
                correo,
                usuario,
                password,
                creacion_pk_usuario, 
                creacion_fecha, 
                modificacion_pk_usuario, 
                modificacion_fecha, 
                eliminado
            ) VALUES (
                1, 
                1, 
                'Admin', 
                '', 
                '', 
                'jorge.cortes@ib-mexico.com',
                'admin',
                '" . bcrypt('1234567890') . "',
                1, 
                NOW(), 
                1, 
                NOW(), 
                0
            )");  
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //FOREIGNS KEYS
        Schema::table('usuarios', function($table) {
            $table->dropForeign(['pk_usuario_tipo']);
            $table->dropForeign(['creacion_pk_usuario']);
            $table->dropForeign(['modificacion_pk_usuario']);
        });

        Schema::dropIfExists('usuarios');
    }
}
