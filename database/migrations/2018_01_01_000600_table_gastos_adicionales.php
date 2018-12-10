<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableGastosAdicionales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //TABLA GASTOS ADICIONALES
        Schema::create('gastos_adicionales', function(Blueprint $table) {
            
            $table->increments('pk_gasto_adicional');
            $table->date('fecha');
            $table->string('concepto', 255);
            $table->string('referencia', 150)->nullable();
            $table->decimal('importe', 14, 2);

            $table->integer('pk_vehiculo')->unsigned();
            $table->integer('pk_operador')->nullable()->unsigned();
            $table->integer('pk_proveedor')->nullable()->unsigned();

            $table->text('comentarios')->nullable();
            $table->string('url_documento', 255)->nullable();

            $table->integer('creacion_pk_usuario')->unsigned();
            $table->datetime('creacion_fecha');

            $table->integer('modificacion_pk_usuario')->unsigned();
            $table->datetime('modificacion_fecha');
            $table->boolean('eliminado')->default(0);
        });

        //FOREIGNS KEYS
        Schema::table('gastos_adicionales', function($table) {
            $table->foreign('pk_vehiculo')->references('pk_vehiculo')->on('vehiculos');
            $table->foreign('pk_operador')->references('pk_operador')->on('operadores');
            $table->foreign('pk_proveedor')->references('pk_proveedor')->on('proveedores');
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
        Schema::table('gastos_adicionales', function($table) {
            $table->dropForeign(['pk_vehiculo']);
            $table->dropForeign(['pk_operador']);
            $table->dropForeign(['pk_proveedor']);
            $table->dropForeign(['creacion_pk_usuario']);
            $table->dropForeign(['modificacion_pk_usuario']);
        });

        Schema::dropIfExists('gastos_adicionales');
    }
}
