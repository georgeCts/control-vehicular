@section('title', 'Usuarios')

@section('panel')
    <h3 class="animated fadeInLeft">
        <span class="fa-users fa"></span> Usuarios
        <a href="/panel/usuarios/registrar" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Registrar</a>
    </h3>
@endsection

@section('content')
    <div id="users" class="col-md-12 padding-0">
        @foreach($objUsuarios as $item)
            <usuario-card :user="{{$item}}" :tipo="{{$item->usuarioTipo}}"></usuario-card>
        @endforeach
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
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