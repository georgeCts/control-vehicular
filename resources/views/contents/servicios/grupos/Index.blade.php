@section('title', 'Servicios')

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/plugins/datatables.bootstrap.min.css') }}"/>
@endsection

@section('panel')
    <div class="col-md-6">
        <h3 class="animated fadeInLeft">
            <span class="fa-wrench fa"></span> Servicios
        </h3>
        <h5 style="margin-left: 15px;">
            <span clas="text-muted">
                <i class="fa-circle-o fa"></i> Grupos de Mantenimiento
            </span>
        </h5>
    </div>

    <div class="col-md-6 text-right m-t-20">
        <a href="/panel/servicios/agregar_grupo" class="btn btn-primary"><i class="fa fa-plus"></i> Agregar Grupo</a>
        <a href="/panel/servicios/bitacora" class="btn btn-dark"><i class="fa fa-book"></i> Bitácora</a>
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
            <div class="panel-heading">
                <h4>GRUPOS REGISTRADOS</h4>
            </div>

            <div class="panel-body">
                <div class="responsive-table">
                    <table id="dtGrupos" class="table table-striped" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-left">Nombre</th>
                                <th class="text-center">Acci&oacute;n</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lstGrupos as $item)
                                <tr>
                                    <td class="text-center">{{ $item->pk_mantenimiento_grupo }}</td>
                                    <td class="text-left">
                                        <strong>{{ $item->nombre }}</strong>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="fa fa-cog"></span>
                                                <span class="fa fa-angle-down"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                            <li><a href="/panel/servicios/editar_grupo/{{ $item->pk_mantenimiento_grupo }}"><i class="fa fa-pencil"></i> Editar</a></li>
                                            <li><a href="#"><i class="fa fa-trash"></i> Eliminar</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-left">Nombre</th>
                                <th class="text-center">Acci&oacute;n</th>
                            </tr>
                        </tfoot>
                    </table>
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
        $('#dtGrupos').DataTable();
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