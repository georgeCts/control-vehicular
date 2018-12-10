<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableVehiculosInfCompra extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //TABLA VEHICULO COMPRA
        Schema::create('vehiculos_inf_compra', function (Blueprint $table) {

            $table->increments('pk_vehiculo_inf_compra');
            $table->integer('pk_vehiculo')->unsigned();
            $table->date('compra_fecha')->nullable();
            $table->decimal('compra_precio', 14, 2)->nullable();
            $table->integer('pk_proveedor')->nullable()->unsigned();
            $table->decimal('compra_odometro', 14, 2)->nullable();
            $table->date('garantia_limite_fecha')->nullable();
            $table->decimal('garantia_limite_odometro', 14, 2)->nullable();
            $table->mediumText('notas')->nullable();

            $table->integer('creacion_pk_usuario')->unsigned();
            $table->datetime('creacion_fecha');
            $table->integer('modificacion_pk_usuario')->unsigned();
            $table->datetime('modificacion_fecha');
            
            $table->boolean('eliminado')->default(0);
        });

        //FOREIGNS KEYS
        Schema::table('vehiculos_inf_compra', function($table) {
            $table->foreign('pk_vehiculo')->references('pk_vehiculo')->on('vehiculos');
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
        Schema::table('vehiculos_inf_compra', function($table) {
            $table->dropForeign(['pk_vehiculo']);
            $table->dropForeign(['pk_proveedor']);
            $table->dropForeign(['creacion_pk_usuario']);
            $table->dropForeign(['modificacion_pk_usuario']);
        });

        Schema::dropIfExists('vehiculos_inf_compra');
    }
}
