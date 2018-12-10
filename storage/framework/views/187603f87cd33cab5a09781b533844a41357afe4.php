<!DOCTYPE html>
<html lang="es">
<head>
	
	<meta charset="utf-8">
	<meta name="description" content="Sistema de Gestión de Flotillas">
	<meta name="keyword" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title> <?php echo e($_PAGE_TITLE); ?> | <?php echo $__env->yieldContent('title', '*** TITLE ***'); ?> </title>
 
    <?php echo $__env->yieldContent('components.Stylesheets'); ?>
    <?php echo $__env->yieldContent('components.Favicon'); ?>
	
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body id="mimin" class="dashboard">
    <?php echo $__env->yieldContent('components.Header'); ?>
    <div class="container-fluid mimin-wrapper">
        <?php echo $__env->yieldContent('components.LeftSideMenu'); ?>
    
        <!-- start: content -->
        <div id="content">
            <?php echo $__env->yieldContent('components.Panel'); ?>

            <div class="col-md-12" style="padding:20px;">
                <?php echo $__env->yieldContent('content', '*** CONTENT ***'); ?>
            </div>
        </div>
        <!-- end: content -->
    </div>

    <?php echo $__env->yieldContent('components.LeftSideMenuMobile'); ?>

    <?php echo $__env->yieldContent('components.Scripts'); ?>
</body>
</html>