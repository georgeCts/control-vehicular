<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableRecordatorios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        //TABLA RECORDATORIOS
        Schema::create('recordatorios', function(Blueprint $table) {
            $table->increments('pk_recordatorio');
            $table->integer('pk_vehiculo')->unsigned();
            $table->string('nombre', 255);
            $table->mediumText('descripcion');
            $table->date('fecha_vencimiento');
            $table->date('fecha_notificacion');

            $table->integer('creacion_pk_usuario')->unsigned();
            $table->datetime('creacion_fecha');

            $table->integer('modificacion_pk_usuario')->unsigned();
            $table->datetime('modificacion_fecha');
            $table->boolean('eliminado')->default(0);
        });

        //FOREIGNS KEYS
        Schema::table('recordatorios', function($table) {
            $table->foreign('pk_vehiculo')->references('pk_vehiculo')->on('vehiculos');
            $table->foreign('creacion_pk_usuario')->references('pk_usuario')->on('usuarios');
            $table->foreign('modificacion_pk_usuario')->references('pk_usuario')->on('usuarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //FOREIGNS KEYS
        Schema::table('recordatorios', function($table) {
            $table->dropForeign(['pk_vehiculo']);
            $table->dropForeign(['creacion_pk_usuario']);
            $table->dropForeign(['modificacion_pk_usuario']);
        });

        Schema::dropIfExists('recordatorios');
    }
}
