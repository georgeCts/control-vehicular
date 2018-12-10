@section('components.LeftSideMenu')
    <!-- start:Left Menu -->
    <div id="left-menu">
        <div class="sub-left-menu scroll">
            <ul class="nav nav-list">
                <li><div class="left-bg"></div></li>
                <li class="time">
                    <h1 class="animated fadeInLeft">21:00</h1>
                    <p class="animated fadeInRight">Sat,October 1st 2029</p>
                </li>
                <li @if (Request::path() == 'panel') 
                        {!!'class="active ripple"' !!}  
                    @else 
                        {!!'class="ripple"' !!}  
                    @endif>
                    <a href="{{URL::to('panel')}}" class="nav-header"><span class="fa-dashboard fa"></span> Panel</a>
                </li>

                @foreach ($_PRIVILEGIOS_MENU_ as $itemPrivilegioMenu)
                    <li @if (Request::path() == 'panel/') 
                            {!!'class="active ripple"' !!}  
                        @else 
                            {!!'class="ripple"' !!}  
                        @endif>
                        <a class="tree-toggle nav-header">
                            <span class="{{ $itemPrivilegioMenu['categoria']['menu_icono'] }} fa"></span> {{ $itemPrivilegioMenu['categoria']['privilegio_categoria'] }}
                            <span class="fa-angle-right fa right-arrow text-right"></span>
                        </a>
                        @if( sizeof($itemPrivilegioMenu['privilegios']) > 0 )
                            <ul class="nav nav-list tree">
                                @foreach ($itemPrivilegioMenu['privilegios'] as $itemPrivilegio)
                                    <li @if (Request::path() == ('panel/') . $itemPrivilegio['menu_url'] ) {!!'class="active"' !!}  @endif><a href="{{URL::to('panel/' . $itemPrivilegio['menu_url']) }}">{{ $itemPrivilegio['etiqueta'] }}</a></li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
                <li class="ripple">
                    <a href="{{URL::to('logout')}}" class="nav-header"><span class="fa-power-off fa"></span> Cerrar Sesi&oacute;n</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- end: Left Menu -->
@endsection