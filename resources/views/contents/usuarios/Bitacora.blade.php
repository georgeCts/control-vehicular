@section('title', 'Usuarios')

@section('panel')
    <h3 class="animated fadeInLeft"><span class="fa-users fa"></span> Usuarios</h3>
    <h4 class="animated fadeInLeft m-l-15"><span class="fa-file-text fa"></span> Bit&aacute;cora</h4>
@endsection

@section('content')
    <div class="col-md-12 padding-20">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>REGISTRO DE ACTIVIDADES</h4>
            </div>

            <div class="panel-body">
                <div class="responsive-table">
                    <table class="table table-striped" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">Fecha</th>
                                <th class="text-center">Usuario</th>
                                <th>Acci&oacute;n</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($objBitacora as $itemBitacora)
                                <tr>
                                    <td class="text-center">{{ $itemBitacora->creacion_fecha }}</td>
                                    <td class="text-center">{{ $itemBitacora->usuario->nombre }} {{ $itemBitacora->usuario->apellido_paterno }}</td>
                                    <td>{{ $itemBitacora->descripcion }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th class="text-center">Fecha</th>
                                <th class="text-center">Usuario</th>
                                <th>Acci&oacute;n</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
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