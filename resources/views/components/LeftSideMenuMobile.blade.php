@section('components.LeftSideMenuMobile')

    <!-- start: Mobile -->
    <div id="mimin-mobile" class="reverse">
        <div class="mimin-mobile-menu-list">
            <div class="col-md-12 sub-mimin-mobile-menu-list animated fadeInLeft">
                <ul class="nav nav-list">
                    <li @if (Request::path() == 'panel') 
                            {!!'class="active ripple"' !!}  
                        @else 
                            {!!'class="ripple"' !!}  
                        @endif>
                        <a href="{{URL::to('panel')}}" class="nav-header">
                            <span class="fa-home fa"></span>Dashboard 
                        </a>
                    </li>

                    @foreach ($_PRIVILEGIOS_MENU_ as $itemPrivilegioMenu)
                        <li @if (Request::path() == 'panel/') 
                                {!!'class="active ripple"' !!}  
                            @else 
                                {!!'class="ripple"' !!}  
                            @endif>
                            <a class="tree-toggle nav-header">
                                <span class="{{ $itemPrivilegioMenu['categoria']['menu_icono'] }} fa"></span>{{ $itemPrivilegioMenu['categoria']['privilegio_categoria'] }}
                                <span class="fa-angle-right fa right-arrow text-right"></span>
                            </a>

                            @if( sizeof($itemPrivilegioMenu['privilegios']) > 0 )
                                <ul class="nav nav-list tree">
                                    @foreach ($itemPrivilegioMenu['privilegios'] as $itemPrivilegio)
                                        <li><a href="{{URL::to('panel/' . $itemPrivilegio['menu_url']) }}">{{ $itemPrivilegio['etiqueta'] }}</a></li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                    <li class="ripple">
                        <a href="{{URL::to('logout')}}" class="nav-header">
                            <span class="fa-power-off fa"></span>Cerrar Sesi&oacute;n
                        </a>
                    </li>
                </ul>
            </div>
        </div>       
    </div>
    <button id="mimin-mobile-menu-opener" class="animated rubberBand btn btn-circle btn-danger">
        <span class="fa fa-bars"></span>
    </button>
    <!-- end: Mobile -->
@endsection