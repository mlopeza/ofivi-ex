<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>OFIVEX</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="Mario Adri&aacute;n L&oacute;pez Alem&aacute;n" />
    <!-- bootstrap css -->
    <link href="<?php echo base_url("css/bootstrap.min.css");?> " rel="stylesheet" />
    <!-- base css -->
    <link class="links-css" href="<?php echo base_url("css/base.css"); ?>" rel="stylesheet" />
    <!-- home page css -->
    <link href="<?php echo base_url("css/home-page.css"); ?>" rel="stylesheet" />
    <style type="text/css">
      body {
      padding-top: 60px;
      padding-bottom: 40px;
      }
      .sidebar-nav {
      padding: 9px 0;
      }
    </style>
    <!-- datepicker css -->
    <link href="<?php echo base_url("css/datepicker.css");?>" rel="stylesheet" />
    <!-- responsive css -->
    <link href="<?php echo base_url("css/bootstrap-responsive.css");?>" rel="stylesheet" />
    <!-- media query css -->
    <link href="<?php echo base_url("css/bootstrap-wysihtml5.css");?>" rel="stylesheet" />
    <link href="<?php echo base_url("css/bootstrap-responsive.css");?>" rel="stylesheet" />
    <link href="<?php echo base_url("css/forms.css"); ?>" rel="stylesheet" />
    <link href="<?php echo base_url("css/noty.css"); ?>" rel="stylesheet" />
    <link href="<?php echo base_url("css/noty-css/noty_theme_default.css"); ?>" rel="stylesheet" />
    <link href="<?php echo base_url("css/noty-css/jquery.noty.css"); ?>" rel="stylesheet"
    <link href="<?php echo base_url("css/media-fluid.css");?>" rel="stylesheet" />
    <link href="<?php echo base_url("css/jquery-ui-bootstrap-1.8.16.custom.css");?> " rel="stylesheet" />
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#"><img src="<?php echo base_url("img/logo-small.png");?>" alt="logo" /></a>
          <ul class="nav pull-left bar-root">
            <li class="divider-vertical"></li>
            <!--Cambio de Rol del Usuario-->
            <li class="dropdown">
              <a href="#" style="text-align:center" data-toggle="dropdown">
                <i class="icon-user icon-white"></i>
                <div>Rol</div>
              </a>
              <ul class="dropdown-menu">
                <!-- Se mdespliega las vistas a que tiene acceso y se redirige a esa vista al darle click-->
                <?php 
                  foreach ($vista as $key=>$rol){
                  	if($rol == 1){
                  			echo "<li><a href=".base_url("index.php/logincontroller/cambioVista/".$key).">".$key."</a></li>";
                  	}
                  }
                  ?>            
              </ul>
            </li>
            <!--Calendario de Usuario-->
            <li class="dropdown">
              <a href="<?php echo base_url("calendar");?>" style="text-align:center">
                <i class="icon-calendar icon-white"></i>
                <div>Calendario</div>
              </a>
            </li>
          </ul>
          <!--Inicio de Recuadro de Usuario-->
          <div class="group-menu nav-collapse">
            <ul class="nav pull-right">
              <li class="divider-vertical"></li>
              <li class="dropdown">
                <!--Nombre de Usuario-->
                <!--Igual sería buena idea poner el Rol Actual del Usuario en Este apartado-->
                <a data-toggle="dropdown" id="idUsuario-sistema" idUsuario="<?php echo $this->session->userdata('idUsuario'); ?>" href="#"><?php echo $this->session->userdata('username'); ?><b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li>
                    <div class="modal-header">
                      <h3><?php echo $this->session->userdata('nombre');?></h3>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                        <!--Imagen del Usuario-->
                        <div class="span3 pull-right">
                          <!--Cuenta de Usuario-->
                          <h5><?php echo $this->session->userdata('email');?></h5>
                          <!--Acceder a la CUenta del Usuario-->
                          <a href="<?php echo base_url("/cambioContrasena/cambiarContrasenaUsuario");?>" class="link-modal">Cambiar Contraseña</a>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <a href="<?php echo base_url("/modificarPerfil");?>" class="btn btn-info pull-left">Modificar Perfil</a>
                      <a class="btn btn-info" href="<?php echo base_url("index.php/logincontroller/logout");?>">Cerrar Sesión</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
          <!--Fin de Recuadro de Usuario-->
        </div>
      </div>
    </div>
    <div class="container-fluid" />
    <div class="row-fluid" />
