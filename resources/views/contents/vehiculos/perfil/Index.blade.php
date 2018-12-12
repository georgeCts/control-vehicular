@section('title', 'Vehiculos')

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/plugins/datatables.bootstrap.min.css') }}"/>
@endsection

@section('panel')
    <div class="col-md-6">
        <h3 class="animated fadeInLeft">
            <span class="fa-truck fa"></span> Vehículos              
        </h3>
        <h5 style="margin-left: 15px;">
            <span clas="text-muted">
                <i class="fa-folder-open fa"></i> {{$objVehiculo->vehiculo_nombre}}
            </span>
        </h5>
    </div>

    <div class="col-md-6 text-right m-t-20">
        <a href="/panel/vehiculos" class="btn btn-dark"><i class="fa fa-table"></i> Inventario</a>
    </div>
@endsection

@section('content')
    <div class="col-md-6 col-md-offset-3">
    @if(Session::has('success_message'))
        <div class="alert alert-success col-md-12 col-sm-12  alert-icon alert-dismissible fade in" role="alert">
            <div class="col-md-2 col-sm-2 icon-wrapper text-center">
                <span class="fa fa-check fa-2x"></span></div>
                <div class="col-md-10 col-sm-10">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <p><strong>{{ Session::get('success_title' )}}!</strong> {{ Session::get('success_message' )}}</p>
                </div>
            </div>
        </div>
    @endif
    </div>

    <div class="col-md-12 padding-20">
        <div class="panel panel-default">            
            <div class="panel-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="active">
                        <a data-toggle="tab" href="#informacion">Información</a>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="tab" href="#combustible">Combustible</a>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="tab" href="#mantenimiento">Mantenimientos</a>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="tab" href="#incidente">Incidentes</a>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="tab" href="#recordatorio">Recordatorios</a>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="tab" href="#actividad">Actividades</a>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="tab" href="#operador">Operadores</a>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="tab" href="#documento">Documentos</a>
                    </li>
                    <li class="nav-item">
                        <a data-toggle="tab" href="#fotografia">Fotografías</a>
                    </li>
                </ul>
    
                <div class="tab-content" id="myTabContent">
                    <!-- CONTENIDO DE INFORMACION -->
                    <div class="tab-pane fade in active" id="informacion">
                        <div class="row padding-20">
                            <div class="col-md-12">
                                <div class="panel panel-success">
                                    <div class="panel-heading">
                                        <h4 class="text-white">INFORMACI&Oacute;N B&Aacute;SICA</h4>
                                    </div>

                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-4 col-sm-6">
                                                <table class="table">
                                                    <thead></thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <small>
                                                                    <strong>Registro en <u>miFlota.mx</u></strong>
                                                                </small>
                                                            </td>
                                                            <td>{{$objVehiculo->creacion_fecha}}
                                                        </tr>
                                                        <tr>
                                                            <td><small><strong>Marca</strong></small></td>
                                                            <td>{{$objVehiculo->vehiculo_marca}}
                                                        </tr>
                                                        <tr>
                                                            <td><small><strong>Modelo</strong></small></td>
                                                            <td>{{$objVehiculo->vehiculo_modelo}}
                                                        </tr>
                                                        <tr>
                                                            <td><small><strong>A&ntilde;o</strong></small></td>
                                                            <td>{{$objVehiculo->vehiculo_ano}}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="col-md-4 col-sm-6">
                                                <table class="table">
                                                    <thead></thead>
                                                    <tbody>
                                                        <tr>
                                                            <td><small><strong>Tipo de Veh&iacute;culo</strong></small></td>
                                                            <td>{{$objVehiculo->vehiculoTipo->vehiculo_tipo}}
                                                        </tr>
                                                        <tr>
                                                            <td><small><strong>No. de Serie</strong></small></td>
                                                            <td>{{$objVehiculo->vehiculo_numero_serie}}
                                                        </tr>
                                                        <tr>
                                                            <td><small><strong>Licencia o Placa</strong></small></td>
                                                            <td>{{$objVehiculo->vehiculo_placa}}
                                                        </tr>
                                                        <tr>
                                                            <td><small><strong>Grupo</strong></small></td>
                                                            <td>{{(($objVehiculo->pk_vehiculo_grupo != null)?$objVehiculo->vehiculoGrupo->vehiculo_grupo:'') }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="col-md-4 col-sm-6">
                                                <table class="table">
                                                    <thead></thead>
                                                    <tbody>
                                                        <tr>
                                                            <td><small><strong>Color</strong></small></td>
                                                            <td>{{$objVehiculo->vehiculo_color}}
                                                        </tr>
                                                        <tr>
                                                            <td><small><strong>Aseguradora</strong></small></td>
                                                            <td>{{$objVehiculo->vehiculo_seguro}}
                                                        </tr>
                                                        <tr>
                                                            <td><small><strong>P&oacute;liza de Seguto</strong></small></td>
                                                            <td>{{$objVehiculo->vehiculo_poliza}}
                                                        </tr>
                                                        <tr>
                                                            <td><small><strong>Grupo</strong></small></td>
                                                            <td>{{(($objVehiculo->vehiculo_poliza_vigencia != null)?$objVehiculo->vehiculo_poliza_vigencia:'No registrado') }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row padding-20">
                            <div class="col-md-6">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <h4>DETALLES DE COMPRA</h4>
                                            </div>

                                            <div class="col-sm-6 pull-right">                                                
                                                <a href="/panel/vehiculos/dat_compra/{{$objVehiculo->pk_vehiculo}}" class="btn btn-dark pull-right"> Actualizar</a>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>

                                    <div class="panel-body">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td><small><strong>Fecha de Compra</strong></small></td>
                                                    <td>{{(($objCompra->compra_fecha != null)?$objCompra->compra_fecha:'No registrado')}}
                                                </tr>
                                                <tr>
                                                    <td><small><strong>Precio de Compra</strong></small></td>
                                                    <td>{{(($objCompra->compra_precio != null)?'$'.$objCompra->compra_precio:'No registrado')}}
                                                </tr>
                                                <tr>
                                                    <td><small><strong>Proveedor</strong></small></td>
                                                    <td>{{(($objCompra->pk_proveedor != null)?$objCompra->pk_proveedor:'No registrado')}}
                                                </tr>
                                                <tr>
                                                    <td><small><strong>Od&oacute;metro al Comprar</strong></small></td>
                                                    <td>{{(($objCompra->compra_odometro != null)?$objCompra->compra_odometro:'No registrado')}}</td>
                                                </tr>
                                                <tr>
                                                    <td><small><strong>Fecha L&iacute;mite de Garant&iacute;a</strong></small></td>
                                                    <td>{{(($objCompra->garantia_limite_fecha != null)?$objCompra->garantia_limite_fecha:'No registrado')}}</td>
                                                </tr>
                                                <tr>
                                                    <td><small><strong>L&iacute;mite de Garant&iacute;a por Uso (Km)</strong></small></td>
                                                    <td>{{(($objCompra->garantia_limite_odometro != null)?$objCompra->garantia_limite_odometro:'No registrado')}}</td>
                                                </tr>
                                                <tr>
                                                    <td><small><strong>Notas</strong></small></td>
                                                    <td>{{$objCompra->notas}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <h4>DETALLES DE CR&Eacute;DITO</h4>
                                            </div>

                                            <div class="col-sm-6 pull-right">                                                
                                                <a href="/panel/vehiculos/dat_credito/{{$objVehiculo->pk_vehiculo}}" class="btn btn-dark pull-right"> Actualizar</a>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>

                                    <div class="panel-body">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td><small><strong>Fecha Inicial</strong></small></td>
                                                    <td>{{(($objCredito->fecha_inicial != null)?$objCredito->fecha_inicial:'No registrado')}}
                                                </tr>
                                                <tr>
                                                    <td><small><strong>Fecha Final</strong></small></td>
                                                    <td>{{(($objCredito->fecha_final != null)?$objCredito->fecha_final:'No registrado')}}
                                                </tr>
                                                <tr>
                                                    <td><small><strong>Pago Mensual</strong></small></td>
                                                    <td>{{(($objCredito->pago_mensual != null)?$objCredito->pago_mensual:'No registrado')}}
                                                </tr>
                                                <tr>
                                                    <td><small><strong>Monto Financiado</strong></small></td>
                                                    <td>{{(($objCredito->monto_financiado != null)?$objCredito->monto_financiado:'No registrado')}}</td>
                                                </tr>
                                                <tr>
                                                    <td><small><strong>Tasa de Inter&eacute;s</strong></small></td>
                                                    <td>{{(($objCredito->tasa_interes != null)?$objCredito->tasa_interes:'No registrado')}}</td>
                                                </tr>
                                                <tr>
                                                    <td><small><strong>Valor Residual</strong></small></td>
                                                    <td>{{(($objCredito->valor_residual != null)?$objCredito->valor_residual:'No registrado')}}</td>
                                                </tr>
                                                <tr>
                                                    <td><small><strong>Instituci&oacute;n Financiera</strong></small></td>
                                                    <td>{{(($objCredito->institucion_financiera != null)?$objCredito->institucion_financiera:'No registrado')}}</td>
                                                </tr>
                                                <tr>
                                                    <td><small><strong>No. de Cuenta</strong></small></td>
                                                    <td>{{(($objCredito->numero_cuenta != null)?$objCredito->numero_cuenta:'No registrado')}}</td>
                                                </tr>
                                                <tr>
                                                    <td><small><strong>Notas</strong></small></td>
                                                    <td>{{$objCredito->notas}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- FIN CONTENIDO INFORMACION -->
    
                    <!-- CONTENIDO DE INCIDENTES -->
                    <div class="tab-pane fade" id="incidente">
                        <div class="panel panel-default padding-20">
                            <div class="panel-heading">
                                <h4>INCIDENTES REPORTADOS</h4>
                            </div>
                
                            <div class="panel-body">
                                <div class="responsive-table">
                                    <table id="dtIncidentes" class="table table-striped" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-left">Fechas</th>
                                                <th class="text-center">Veh&iacute;culo</th>
                                                <th class="text-left">Incidente</th>
                                                <th class="text-center">Reportó</th>
                                                <th class="text-left">Estatus</th>
                                                <th class="text-center">Imagen</th>
                                                <th class="text-center">Acci&oacute;nes</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($lstIncidentes as $item)
                                                <tr>
                                                    <td class="text-center">{{ $item->pk_incidente }}</td>
                                                    <td class="text-left">
                                                        <small>Reporte: <strong>{{$item->fecha_reporte}}</strong></small>
                                                        <br />
                                                        <small>Vencimiento: <strong>{{(($item->fecha_vencimiento != null)?$item->fecha_vencimiento:'N/A')}}</strong></small>
                                                    </td>
                                                    <td class="text-center">
                                                        <a href="/panel/vehiculos/perfil_veh/{{$item->vehiculo->pk_vehiculo}}">{{ $item->vehiculo->vehiculo_nombre  }}</a>
                                                    </td>
                                                    <td class="text-left">
                                                        @if($item->incidenteImportancia->incidente_importancia == 'Baja')
                                                            <span class="label label-primary">{{$item->descripcion}}</span>
                                                        @elseif($item->incidenteImportancia->incidente_importancia == 'Moderada')
                                                            <span class="label label-warning">{{$item->descripcion}}</span>
                                                        @else
                                                            <span class="label label-danger">{{$item->descripcion}}</span>
                                                        @endif                                                                                                                        
                                                        <br />
                                                        <br />
                                                        <span data-toggle="tooltip" data-placement="bottom" class="ttip label label-primary" title="{{$item->descripcion_detallada}}"> Ver detalles </span>
                                                        <br />
                                                        <small>Odómetro: <strong>{{$item->medicion}}</strong></small>
                                                    </td>                                    
                                                    <td class="text-center">{{$item->creacionUsuario->nombre}} {{ $item->creacionUsuario->apellido_paterno}}</td>
                                                    <td class="text-left">
                                                        <span class="label label-{{(($item->estatus != 'PENDIENTE')?'primary':'warning')}}">{{$item->estatus}}</span>
                                                        @if($item->fecha_cerrado != null)
                                                            <br /><br />
                                                            <small>Fecha: <strong>{{$item->fecha_cerrado}}</strong></small>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        @if($item->url_imagen != null)
                                                            <a href="{{ Storage::disk('s3')->url($item->url_imagen) }}" target="_blank">
                                                                <img class="img-thumbnail img-fluid" src="{{ Storage::disk('s3')->url($item->url_imagen) }}" style="max-width: 150px;" />
                                                            </a>
                                                        @else
                                                            <a href="{{ asset('images/no_imagen.png') }}" target="_blank">
                                                                <img class="img-thumbnail img-fluid" src="{{ asset('images/no_imagen.png') }}" style="max-width: 150px;" />
                                                            </a>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="btn-group" role="group">
                                                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <span class="fa fa-cog"></span>
                                                                <span class="fa fa-angle-down"></span>
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                            <li><a href="/panel/vehiculos/editar_inc/{{ $item->pk_incidente }}"><i class="fa fa-pencil"></i> Editar</a></li>
                                                            <li><a href="#"><i class="fa fa-thumbs-up"></i> Cerrar</a></li>
                                                            <li><a href="#"><i class="fa fa-trash"></i> Eliminar</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-left">Fechas</th>
                                                <th class="text-center">Veh&iacute;culo</th>
                                                <th class="text-left">Incidente</th>
                                                <th class="text-center">Reportó</th>
                                                <th class="text-left">Estatus</th>
                                                <th class="text-center">Imagen</th>
                                                <th class="text-center">Acci&oacute;nes</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>                                        
                    </div>
                    <!-- FIN CONTENIDO INCIDENTES -->

                    <!-- CONTENIDO DE DOCUMENTOS -->
                    <div class="tab-pane fade" id="documento">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="panel panel-default padding-20">
                                    <div class="panel-heading">
                                        <h4>DOCUMENTOS</h4>
                                    </div>
                        
                                    <div class="panel-body">                                
                                        <div class="responsive-table">
                                            <table id="dtDocumentos" class="table table-striped" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th class="text-left"></th>
                                                        <th class="text-left">Nombre</th>
                                                        <th class="text-left">Descripci&oacute;n</th>
                                                        <th class="text-center">Acci&oacute;nes</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($lstDocumentos as $item)
                                                        <tr>
                                                            <td class="text-left"><i class="fa fa-file-text"></i></td>
                                                            <td class="text-left">
                                                                <a href="#"></a>
                                                            </td>
                                                            <td class="text-left"></td>
                                                            <td class="text-center">
                                                                <div class="btn-group" role="group">
                                                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        <span class="fa fa-cog"></span>
                                                                        <span class="fa fa-angle-down"></span>
                                                                    </button>
                                                                    <ul class="dropdown-menu">
                                                                        <li><a href="#"><i class="fa fa-trash"></i> Eliminar</a></li>
                                                                    </ul>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th class="text-left"></th>
                                                        <th class="text-left">Nombre</th>
                                                        <th class="text-left">Descripci&oacute;n</th>
                                                        <th class="text-center">Acci&oacute;nes</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>   
                            </div>

                            <div class="col-md-4">
                                <div class="panel panel-primary padding-20">
                                    <div class="panel-heading">
                                        <h4 class="text-white">CARGAR DOCUMENTOS</h4>
                                    </div>

                                    <div class="panel-body">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- FIN CONTENIDO DOCUMENTOS -->

                </div>                
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="{{ asset('assets/js/plugins/jquery.datatables.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/datatables.bootstrap.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#dtIncidentes').DataTable();
        $('#dtDocumentos').DataTable();
        $('.ttip').tooltip();
    });
</script>
@endsection

{{-- INICIO DECLARACIONES OBLIGATORIAS --}}

@include('components.LeftSideMenu')
@include('components.LeftSideMenuMobile')
@include('components.Header')
@include('components.Scripts')
@include('components.Panel')
@include('components.Stylesheets')
@include('components.Favicon')

@extends('components.Main')