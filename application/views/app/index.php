<!DOCTYPE html>
<html lang="es" ng-app="projectRegistro">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="images/favicon.ico" type="image/ico" />

    <title><?php echo $titulo ?></title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url()?>res/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url()?>res/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url()?>res/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo base_url()?>res/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url()?>res/css/sweetalert.css" />
    
	
    <!-- bootstrap-progressbar -->
    <link href="<?php echo base_url()?>res/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="<?php echo base_url()?>res/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo base_url()?>res/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <link href="<?php echo base_url()?>res/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url()?>res/build/css/custom.min.css" rel="stylesheet">
    <link href="<?php echo base_url()?>res/css/kerrodal.css?<?php echo rand(0,10000)?>" rel="stylesheet">
    
    <link rel="stylesheet" href="<?php echo base_url()?>res/build/css/sistema.css?<?php echo rand(0,10000)?>" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php if(isset($output)){?>
            <?php foreach($output->css_files as $file): ?>
            <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
            <?php endforeach; ?>
    <?php }?>

  </head>

  <body class="nav-md" class="ng-cloak " ng-cloak>
    <div class="container body">
      <div class="main_container">
            <?php echo traerCabeza() ?>
            <!-- page content -->
            <div class="right_col" role="main">
                <?php $this->load->view($centro) ?>
               
            </div>
             <!-- footer content -->
             <footer>
                <div class="pull-right">
                    Derechos reservados
                </div>
                <div class="clearfix"></div>
                </footer>
                <!-- /footer content -->
        </div>
    </div>
    <!-- jQuery -->
    <!-- <script type="text/javascript" src="<?php echo base_url()?>res/vendors/jquery/dist/jquery.min.js"></script> -->
    <script type="text/javascript" src="<?php echo base_url()?>res/js/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>res/js/jquery-ui-1.10.3.custom.js"></script>
    <!-- Angular-->
    <script type="text/javascript" src="<?php echo base_url()?>res/js/angular.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>res/js/sweetalert.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>res/js/app.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>res/js/factory.js?<?php echo rand(0,10000)?>"></script>
    <script type="text/javascript" src="<?php echo base_url()?>res/js/material.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url()?>res/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url()?>res/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url()?>res/vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="<?php echo base_url()?>res/vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="<?php echo base_url()?>res/vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="<?php echo base_url()?>res/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url()?>res/vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="<?php echo base_url()?>res/vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="<?php echo base_url()?>res/vendors/Flot/jquery.flot.js"></script>
    <script src="<?php echo base_url()?>res/vendors/Flot/jquery.flot.pie.js"></script>
    <script src="<?php echo base_url()?>res/vendors/Flot/jquery.flot.time.js"></script>
    <script src="<?php echo base_url()?>res/vendors/Flot/jquery.flot.stack.js"></script>
    <script src="<?php echo base_url()?>res/vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="<?php echo base_url()?>res/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="<?php echo base_url()?>res/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="<?php echo base_url()?>res/vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="<?php echo base_url()?>res/vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="<?php echo base_url()?>res/vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="<?php echo base_url()?>res/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="<?php echo base_url()?>res/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="<?php echo base_url()?>res/vendors/moment/min/moment.min.js"></script>
    <script src="<?php echo base_url()?>res/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap-datetimepicker -->    
    <script src="<?php echo base_url()?>res/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
    <script src="<?php echo base_url()?>res/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url()?>res/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url()?>res/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url()?>res/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="<?php echo base_url()?>res/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="<?php echo base_url()?>res/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo base_url()?>res/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="<?php echo base_url()?>res/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    
    <script src="https://kit.fontawesome.com/44485b0623.js" crossorigin="anonymous"></script>


    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url()?>res/build/js/custom.min.js"></script>
    <script>
        $(document).ready(function()
        {
            $('#fechasFiltro').daterangepicker({
                timePicker: false,
                locale: {
                    format: 'YYYY-MM-DD'
                }
            });
        });
    </script>


    <?php 
        //esta línea me permite insertar archivos de controladores angular js.
        // ver el archivo application/helpers/funciones_helper.php
        echo insertaArchivosControlesAngularJS(); 
    ?>
    <script type="text/javascript">
        var configLogin =  {
            apiUrl: '<?php echo base_url()?>'
        }
        //$.material.init();
        // setTimeout(function(){
        //     $('[data-toggle="tooltip"]').tooltip();
        // },1000);
    </script>
    <?php if(isset($output)){?>
        <?php foreach($output->js_files as $file): ?>
                    <script src="<?php echo $file; ?>"></script>
        <?php endforeach; ?>
    <?php } ?>

  </body>
</html>