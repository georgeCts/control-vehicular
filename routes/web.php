<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', 'LoginController@index');
Route::post('/login', ['as' => 'login-panel', 'uses' => 'LoginController@access']);
Route::get('/logout', 'LoginController@logout');

Route::group([  'prefix'    => 'panel',
                'middleware'=> 'panel.auth'], function() {

    //DASHBOARD
    Route::get('/', 'DashboardController@index');

    //USUARIOS
    Route::get('/usuarios', 'UsuariosController@index');
    Route::get('/usuarios/bitacora', 'UsuariosController@bitacora');
    Route::get('/usuarios/registrar', 'UsuariosController@registro');
    Route::post('/usuarios/registrar', ['as' => 'new-usuario', 'uses' => 'UsuariosController@store']);

    //PROVEEDORES
    Route::get('/proveedores', 'ProveedoresController@index');
    Route::get('/proveedores/registrar', 'ProveedoresController@registro');
    Route::post('/proveedores/registrar', ['as' => 'new-proveedor', 'uses' => 'ProveedoresController@store']);

    Route::get('/proveedores/editar/{pkProveedor}', 'ProveedoresController@edit');
    Route::put('/proveedores/modificar', ['as' => 'update-proveedor', 'uses' => 'ProveedoresController@update']);

    //OPERADORES
    Route::get('/operadores', 'OperadoresController@index');
    Route::get('/operadores/registrar', 'OperadoresController@registro');
    Route::post('/operadores/registrar', ['as' => 'new-operador', 'uses' => 'OperadoresController@store']);

    Route::get('/operadores/editar/{pkOperador}', 'OperadoresController@edit');
    Route::put('/operadores/modificar', ['as' => 'update-operador', 'uses' => 'OperadoresController@update']);

    //VEHICULOS
    Route::get('/vehiculos', 'VehiculosController@index');
    Route::get('/vehiculos/registrar', 'VehiculosController@registro');
    Route::post('/vehiculos/registrar', ['as' => 'new-vehiculo', 'uses' => 'VehiculosController@store']);
    Route::get('/vehiculos/cambio_status/{pkVehiculo}/{pkStatus}', 'VehiculosController@cambioStatus');

    Route::get('/vehiculos/editar/{pkVehiculo}', 'VehiculosController@editar');
    Route::put('/vehiculos/modificar', ['as' => 'update-vehiculo', 'uses' => 'VehiculosController@update']);

    //PERFIL DE VEHICULOS
    Route::get('/vehiculos/perfil_veh/{pkVehiculo}', 'VehiculosController@perfil');

    //DATOS DE COMPRA DE VEHICULO
    Route::get('/vehiculos/dat_compra/{pkVehiculo}', 'VehiculosController@compra');
    Route::put('/vehiculos/dat_compra', ['as' => 'update-vehiculo-compra', 'uses' => 'VehiculosController@updateCompra']);

    //DATOS DE CREDITO DE VEHICULO
    Route::get('/vehiculos/dat_credito/{pkVehiculo}', 'VehiculosController@credito');
    Route::put('/vehiculos/dat_credito', ['as' => 'update-vehiculo-credito', 'uses' => 'VehiculosController@updateCredito']);

    //DOCUMENTOS DE VEHICULO
    Route::post('/vehiculos/subir_doc_veh', 'VehiculosController@uploadDocumento');
    Route::get('/vehiculos/borrar_doc_veh/{pkVehiculoDocumento}', 'VehiculosController@deleteDocumento');

    //FOTOGRAFÍAS DE VEHICULO
    Route::post('/vehiculos/subir_foto_veh', 'VehiculosController@uploadFotografia');
    Route::get('/vehiculos/borrar_foto_veh/{pkVehiculoFotografia}', 'VehiculosController@deleteFotografia');

    //TIPOS DE VEHICULOS
    Route::get('/vehiculos/tipos', 'VehiculosTiposController@index');
    Route::get('/vehiculos/agregar_tipo', 'VehiculosTiposController@registro');
    Route::post('/vehiculos/agregar_tipo', ['as' => 'new-tipo-vehiculo', 'uses' => 'VehiculosTiposController@store']);

    Route::get('/vehiculos/editar_tipo/{pkVehiculoTipo}', 'VehiculosTiposController@editar');
    Route::put('/vehiculos/editar_tipo', ['as' => 'update-tipo-vehiculo', 'uses' => 'VehiculosTiposController@update']);

    //GRUPOS DE VEHICULOS
    Route::get('/vehiculos/grupos', 'VehiculosGruposController@index');
    Route::get('/vehiculos/agregar_grupo', 'VehiculosGruposController@registro');
    Route::post('/vehiculos/agregar_grupo', ['as' => 'new-grupo-vehiculo', 'uses' => 'VehiculosGruposController@store']);

    Route::get('/vehiculos/editar_grupo/{pkVehiculoGrupo}', 'VehiculosGruposController@editar');
    Route::put('/vehiculos/editar_grupo', ['as' => 'update-grupo-vehiculo', 'uses' => 'VehiculosGruposController@update']);

    //GASTOS ADICIONALES
    Route::get('/vehiculos/gastos', 'GastosAdicionalesController@index');
    Route::get('/vehiculos/registrar_gasto', 'GastosAdicionalesController@registro');
    Route::post('/vehiculos/registrar_gasto', ['as' => 'new-gasto-adicional', 'uses' => 'GastosAdicionalesController@store']);

    Route::get('/vehiculos/editar_gasto/{pkGasto}', 'GastosAdicionalesController@editar');
    Route::put('/vehiculos/editar_gasto', ['as' => 'update-gasto-adicional', 'uses' => 'GastosAdicionalesController@update']);
    Route::post('/vehiculos/subir_doc_gasto', 'GastosAdicionalesController@upload');
    Route::get('/vehiculos/eliminar_doc_gasto/{pkGasto}', 'GastosAdicionalesController@deleteDocument');

    //INCIDENTES
    Route::get('/vehiculos/incidentes', 'IncidentesController@index');
    Route::get('/vehiculos/reportar_inc', 'IncidentesController@registro');
    Route::post('/vehiculos/reportar_inc', ['as' => 'new-incidente', 'uses' => 'IncidentesController@store']);

    Route::get('/vehiculos/editar_inc/{pkIncidente}', 'IncidentesController@editar');
    Route::put('/vehiculos/editar_inc', ['as' => 'update-incidente', 'uses' => 'IncidentesController@update']);
    Route::post('/vehiculos/subir_foto_inc', 'IncidentesController@upload');
    Route::get('/vehiculos/eliminar_foto_inc/{pkIncidente}', 'IncidentesController@deletePhoto');

    //INSPECCIONES
    Route::get('/vehiculos/inspecciones/{pkVehiculo}', 'InspeccionesController@index');
    Route::get('/vehiculos/inspecciones/{pkVehiculo}/registrar_insp', 'InspeccionesController@registro');
    Route::post('/vehiculos/inspecciones/registrar_insp', ['as' => 'new-inspeccion', 'uses' => 'InspeccionesController@store']);
    Route::get('/vehiculos/inspecciones/imprimir/{pkInspeccion}', 'InspeccionesController@print');

    Route::get('/vehiculos/inspecciones/subir_fotos/{pkInspeccion}', 'InspeccionesController@showPhotos');
    Route::post('/vehiculos/subir_foto_ins', 'InspeccionesController@upload');
    Route::get('/vehiculos/eliminar_foto_ins/{pkFichero}', 'InspeccionesController@deletePhoto');

    //RECORDATORIOS
    Route::get('/vehiculos/recordatorios', 'RecordatoriosController@index');
    Route::get('/vehiculos/agregar_recordatorio', 'RecordatoriosController@registro');
    Route::post('/vehiculos/agregar_recordatorio', ['as' => 'new-recordatorio', 'uses' => 'RecordatoriosController@store']);

    Route::get('/vehiculos/editar_recordatorio/{pkRecordatorio}', 'RecordatoriosController@editar');
    Route::put('/vehiculos/editar_recordatorio', ['as' => 'update-recordatorio', 'uses' => 'RecordatoriosController@update']);
});
