@section('title', 'Usuarios')

@section('panel')
    <h3 class="animated fadeInLeft">
        <span class="fa-users fa"></span> Usuarios
        <a href="/panel/usuarios/registrar" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Registrar</a>
    </h3>
@endsection

@section('content')
    <div class="col-md-12 padding-0">
        @foreach($objUsuarios as $item)
            <div class="col-md-4 padding-0 text-center">
                <div class="badges-v1 {{(($item->usuarioTipo->pk_usuario_tipo == 1)?'bg-dark':'bg-grey')}} padding-15">
                    <div class="badges-ribbon">
                        @if($item->usuarioTipo->pk_usuario_tipo == 1)
                            <div class="badges-ribbon-content badge-success">{{ $item->usuarioTipo->usuario_tipo }}</div>
                        @else
                            <div class="badges-ribbon-content badge-info">{{ $item->usuarioTipo->usuario_tipo }}</div>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-md-12 text-center text-white"><h3>{{ $item->nombre }} {{ $item->apellido_paterno }}</h3></div>
                        <img src="{{ asset('assets/img/'.$item->imagen) }}" class="img-circle avatar-users" />                        
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3 text-center" style="margin-top:30px;">
                            <a href="#" role="button" class="btn btn-warning">Editar Perfil</a>
                        </div>
                    </div>

                    <hr />

                    <div class="text-left">
                        <p class="font-13 text-white">
                            <strong>Email:</strong>
                            <span class="m-l-15">{{ $item->correo }}</span>
                            <br />
                            <strong>N&uacute;mero de Accesos:</strong>
                            <span class="m-l-15">{{ $item->numero_accesos }}</span>
                            <br />
                            <strong>&Uacute;ltimo de Acceso:</strong>
                            <span class="m-l-15">{{ (($item->ultimo_acceso_fecha != null)?\Carbon\Carbon::parse($item->ultimo_acceso_fecha)->format('j F y, H:i'):'-')}}</span>
                        </p>
                    </div>           
                </div>
            </div>
        @endforeach
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