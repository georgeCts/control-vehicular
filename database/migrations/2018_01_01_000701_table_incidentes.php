<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableIncidentes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //TABLA INCIDENTES
        Schema::create('incidentes', function(Blueprint $table) {
            
            $table->increments('pk_incidente');
            $table->integer('pk_vehiculo')->unsigned();
            $table->date('fecha_reporte');
            $table->string('descripcion', 255);
            $table->integer('pk_incidente_importancia')->unsigned();
            $table->mediumText('descripcion_detallada', 150)->nullable();
            
            $table->decimal('medicion', 14, 2)->nullable();
            $table->date('fecha_vencimiento')->nullable();
            $table->string('url_imagen', 255)->nullable();
            
            $table->enum('estatus', ['PENDIENTE', 'CERRADO'])->default('PENDIENTE');
            $table->date('fecha_cerrado')->nullable();

            $table->integer('creacion_pk_usuario')->unsigned();
            $table->datetime('creacion_fecha');

            $table->integer('modificacion_pk_usuario')->unsigned();
            $table->datetime('modificacion_fecha');
            $table->boolean('eliminado')->default(0);
        });

        //FOREIGNS KEYS
        Schema::table('incidentes', function($table) {
            $table->foreign('pk_vehiculo')->references('pk_vehiculo')->on('vehiculos');
            $table->foreign('pk_incidente_importancia')->references('pk_incidente_importancia')->on('incidentes_importancia');
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
        Schema::table('incidentes', function($table) {
            $table->dropForeign(['pk_vehiculo']);
            $table->dropForeign(['pk_incidente_importancia']);
            $table->dropForeign(['creacion_pk_usuario']);
            $table->dropForeign(['modificacion_pk_usuario']);
        });

        Schema::dropIfExists('incidentes');
    }
}
