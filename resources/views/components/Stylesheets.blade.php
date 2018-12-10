@section('components.Stylesheets')

    <!-- start: Css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">

        <!-- plugins -->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/plugins/font-awesome.min.css') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/plugins/simple-line-icons.css') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/plugins/animate.min.css') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/plugins/sweetalert2.min.css') }}"/>
        <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
	<!-- end: Css -->
    
    @yield('stylesheets')

@endsection