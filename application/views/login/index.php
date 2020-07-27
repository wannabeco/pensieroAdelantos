<!--                                                    
     ("`-''-/").___....''"`-._
      `6_ 6  )   `-.  (     ).`-.__.`) 
      (_Y_.)'  ._   )  `._ `. ``-..-'
    _..`..'_..-_/  /..'_.' ,'
   (il),-''  (li),'  ((!.-'

   Desarrollado por  @orugal
-->
<!DOCTYPE html>
<html lang="en" ng-app="projectRegistro">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $titulo ?> </title>
    <!-- Bootstrap -->
    <link href="<?php echo base_url()?>res/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url()?>res/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url()?>res/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?php echo base_url()?>res/vendors/animate.css/animate.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo base_url()?>res/css/sweetalert.css" />
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url()?>res/img/favicon.png" />		
    <!-- Custom Theme Style -->
    <link href="<?php echo base_url()?>res/build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login"  ng-controller="login" ng-init="loginInit()">
    
	


	<?php $this->load->view($centro);?>

	<script type="text/javascript" src="<?php echo base_url()?>res/js/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>res/js/jquery-ui-1.10.3.custom.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>res/js/sweetalert.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>res/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>res/js/angular.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>res/js/app.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>res/js/factory.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>res/js/login/controller.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>res/js/material.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>res/js/ripples.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>res/js/validator.js"></script>
	<script type="text/javascript">
		var configLogin =  {
			apiUrl: '<?php echo base_url()?>'
		}
			$.material.init();
	</script>




  </body>
</html>
