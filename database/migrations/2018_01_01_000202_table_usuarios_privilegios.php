<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableUsuariosPrivilegios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //TABLA PRIVILEGIOS_USUARIOS
        Schema::create('usuarios_privilegios', function(Blueprint $table) {
            $table->primary(['pk_usuario', 'pk_privilegio']);
            $table->integer('pk_usuario')->unsigned();
            $table->integer('pk_privilegio')->unsigned();

            $table->integer('creacion_pk_usuario')->unsigned();
            $table->datetime('creacion_fecha');
        });

        //NEW ROW
        DB::statement("INSERT INTO
            usuarios_privilegios
        (
            pk_usuario, pk_privilegio, creacion_pk_usuario, creacion_fecha
        )
        VALUES
            (1, 1, 1, '2017-01-01 00:00:00'),
            (1, 2, 1, '2017-01-01 00:00:00'),
            (1, 3, 1, '2017-01-01 00:00:00'),
            (1, 4, 1, '2017-01-01 00:00:00'),
            (1, 5, 1, '2017-01-01 00:00:00'),
            (1, 6, 1, '2017-01-01 00:00:00'),

            (1, 7, 1, '2017-01-01 00:00:00'),
            (1, 8, 1, '2017-01-01 00:00:00'),
            (1, 9, 1, '2017-01-01 00:00:00'),
            (1, 0, 1, '2017-01-01 00:00:00'),
            (1, 11, 1, '2017-01-01 00:00:00'),
            (1, 12, 1, '2017-01-01 00:00:00'),

            (1, 13, 1, '2017-01-01 00:00:00'),
            (1, 14, 1, '2017-01-01 00:00:00'),
            (1, 15, 1, '2017-01-01 00:00:00'),
            (1, 16, 1, '2017-01-01 00:00:00'),
            (1, 17, 1, '2017-01-01 00:00:00'),
            (1, 18, 1, '2017-01-01 00:00:00'),

            (1, 19, 1, '2017-01-01 00:00:00'),
            (1, 20, 1, '2017-01-01 00:00:00'),
            (1, 21, 1, '2017-01-01 00:00:00'),
            (1, 22, 1, '2017-01-01 00:00:00');");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios_privilegios');
    }
}
