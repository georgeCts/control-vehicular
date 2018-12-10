<!DOCTYPE html>
<html lang="es">
<head>
	
	<meta charset="utf-8">
	<meta name="description" content="Sistema de Gestión de Flotillas">
	<meta name="keyword" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title> {{$_PAGE_TITLE}} | @yield('title', '*** TITLE ***') </title>
 
    @yield('components.Stylesheets')
    @yield('components.Favicon')
	
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body id="mimin" class="dashboard">
    @yield('components.Header')
    <div class="container-fluid mimin-wrapper">
        @yield('components.LeftSideMenu')
    
        <!-- start: content -->
        <div id="content">
            @yield('components.Panel')

            <div class="col-md-12" style="padding:20px;">
                @yield('content', '*** CONTENT ***')
            </div>
        </div>
        <!-- end: content -->
    </div>

    @yield('components.LeftSideMenuMobile')

    @yield('components.Scripts')
</body>
</html>