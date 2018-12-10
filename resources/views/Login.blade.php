<!DOCTYPE html>
<html lang="es">
<head>

  <meta charset="utf-8">
  <meta name="description" content="Sistema de Gestión de Flotillas">
  <meta name="keyword" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $_PAGE_TITLE }}</title>

  <!-- start: Css -->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">

  <!-- plugins -->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/plugins/font-awesome.min.css') }}"/>
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/plugins/simple-line-icons.css') }}"/>
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/plugins/animate.min.css') }}"/>
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/plugins/icheck/skins/flat/aero.css') }}"/>
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
  <!-- end: Css -->

  <link rel="shortcut icon" href="{{ asset('assets/img/logomi.png') }}">
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
</head>

<body id="mimin" class="dashboard form-signin-wrapper">

    <div class="container">

        @if(Session::has('login_error_message'))
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="alert alert-warning col-md-12 col-sm-12 alert-icon alert-dismissible fade in" role="alert">
                        <div class="col-md-2 col-sm-2 icon-wrapper text-center">
                            <span class="fa fa-exclamation-triangle fa-2x"></span>
                        </div>
                        <div class="col-md-10 col-sm-10">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <p><strong>{{ Session::get('login_error_title' )}}</strong> <br /> {{ Session::get('login_error_message' )}}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {!! Form::open(['route' => 'login-panel', 'class' => 'form-signin']) !!}
            <div class="panel periodic-login">
                <div class="panel-body text-center">
                    <h1 class="atomic-symbol">Mi</h1>
                    <p class="atomic-mass">{{ $_SYSTEM_VERSION }}</p>
                    <p class="element-name">MiFlota</p>

                    <i class="icons icon-arrow-down"></i>
                    <div class="form-group form-animate-text" style="margin-top:40px !important;">
                        <input type="text" name="user" class="form-text" required>
                        <span class="bar"></span>
                        <label>Usuario</label>
                    </div>
                    <div class="form-group form-animate-text" style="margin-top:40px !important;">
                        <input type="password" name="password" class="form-text" required>
                        <span class="bar"></span>
                        <label>Contrase&ntilde;a</label>
                    </div>
                    <label class="pull-left">
                        <input type="checkbox" class="icheck pull-left" name="remember_me"/> Recordarme
                    </label>
                    <input type="submit" class="btn col-md-12" value="Accesar"/>
                </div>
                <div class="text-center" style="padding:5px;">
                    <a href="forgotpass.html">Olvid&eacute; mi contraseña </a>
                    <a href="reg.html">| Soporte</a>
                </div>
            </div>
        {!! Form::close() !!}

    </div>

    <!-- end: Content -->
    <!-- start: Javascript -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.ui.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

    <script src="{{ asset('assets/js/plugins/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/icheck.min.js') }}"></script>

    <!-- custom -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('input').iCheck({
            checkboxClass: 'icheckbox_flat-aero',
            radioClass: 'iradio_flat-aero'
            });
       });
    </script>
    <!-- end: Javascript -->
</body>
</html>