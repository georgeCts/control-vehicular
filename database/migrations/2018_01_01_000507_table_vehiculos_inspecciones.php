<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TableVehiculosInspecciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //TABLA VEHICULOS TIPOS
        Schema::create('vehiculos_inspecciones', function(Blueprint $table) {
            
            $table->increments('pk_vehiculo_inspeccion');

            $table->date('fecha_inspeccion');
            $table->integer('pk_operador')->unsigned();
            $table->decimal('kilometraje_salida', 14, 2);
            $table->decimal('kilometraje_llegada', 14, 2)->nullable();
            $table->date('vigencia_licencia');
            $table->string('numero_unidad', 50);
            $table->string('telefono_vehiculo', 50)->nullable();

            $table->integer('pk_vehiculo')->unsigned();
            $table->integer('entrega_pk_usuario')->unsigned();
            $table->integer('recibe_pk_operador')->unsigned();

            $table->string('url_firma_entrega', 255)->nullable();
            $table->string('url_firma_recibe', 255)->nullable();


            $table->boolean('triangulos_reflejantes')->default(0);
            $table->boolean('gato')->default(0);
            $table->boolean('herramientas')->default(0);
            $table->boolean('llanta_refaccion')->default(0);

            $table->boolean('presion_llantas')->default(0);
            $table->boolean('dibujo_llantas')->default(0);
            $table->boolean('limpieza')->default(0);
            $table->boolean('aseguramiento_carga')->default(0);
            $table->boolean('dano_carroceria')->default(0);
            $table->boolean('condicion_escape')->default(0);
            $table->boolean('limpiaparabrisa')->default(0);
            $table->boolean('parabrisa')->default(0);
            $table->boolean('aire_acondicionado')->default(0);

            $table->string('nivel_combustible', 30);
            $table->boolean('nivel_anticongelante', 30)->default(0);
            $table->boolean('nivel_aceite', 30)->default(0);
            $table->boolean('liquido_limpiador', 30)->default(0);
            $table->boolean('fuga_visible')->default(0);
            $table->boolean('cables_corriente')->default(0);

            $table->boolean('luces_delanteras')->default(0);
            $table->boolean('luces_traseras')->default(0);
            $table->boolean('luces_intermitentes')->default(0);

            $table->boolean('tarjeta_circulacion')->default(0);
            $table->boolean('poliza_seguro')->default(0);
            $table->boolean('registro_mantenimiento')->default(0);

            $table->mediumText('comentarios')->nullable();
            $table->string('imagen_dano', 255);

            $table->integer('creacion_pk_usuario')->unsigned();
            $table->datetime('creacion_fecha');
            $table->integer('modificacion_pk_usuario')->unsigned();
            $table->datetime('modificacion_fecha');

            $table->boolean('eliminado')->default(0);
        });

        //FOREIGNS KEYS
        Schema::table('vehiculos_inspecciones', function($table) {
            $table->foreign('pk_operador')->references('pk_operador')->on('operadores');
            $table->foreign('pk_vehiculo')->references('pk_vehiculo')->on('vehiculos');
            $table->foreign('entrega_pk_usuario')->references('pk_usuario')->on('usuarios');
            $table->foreign('recibe_pk_operador')->references('pk_operador')->on('operadores');
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
        Schema::table('vehiculos_inspecciones', function($table) {
            $table->dropForeign(['pk_operador']);
            $table->dropForeign(['pk_vehiculo']);
            $table->dropForeign(['recibe_pk_operador']);
            $table->dropForeign(['entrega_pk_usuario']);
            $table->dropForeign(['creacion_pk_usuario']);
            $table->dropForeign(['modificacion_pk_usuario']);
        });

        Schema::dropIfExists('vehiculos_inspecciones');
    }
}
