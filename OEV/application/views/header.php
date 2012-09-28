<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>OFIVEX</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Mario Adrián López Alemán" >

 <!-- bootstrap css -->
        <link href="<?php echo base_url("css/bootstrap.min.css");?> " rel="stylesheet">
         <!-- base css -->
        <link class="links-css" href="<?php echo base_url("css/base.css"); ?>" rel="stylesheet">
         <!-- home page css -->
        <link href="<?php echo base_url("css/home-page.css"); ?>" rel="stylesheet">
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
        <link href="<?php echo base_url("css/datepicker.css");?>" rel="stylesheet"/>
         <!-- responsive css -->
        <link href="<?php echo base_url("css/bootstrap-responsive.css");?>" rel="stylesheet">
         <!-- media query css -->
        <link href="<?php echo base_url("css/media-fluid.css");?>" rel="stylesheet">

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
                    <a class="brand" href="index.html"><img src="<?php echo base_url("img/logo-small.png");?>" alt="logo" /></a>
                    <ul class="nav pull-left bar-root">
                        <li class="divider-vertical"></li>
						<!--Los Nuevos mensajes, este solo debe contener la cantidad de mensajes nuevos-->
                        <li class="dropdown">
                        <a style="text-align:center" href="#" data-toggle="dropdown" > <i class="icon-envelope icon-white"></i><span class="label label-important">5</span><div>Mensajes</div></a> 
                            <ul class="dropdown-menu">
                                <li><a href="inbox.html"><img src="<?php echo base_url("img/small/thumb1.png");?>" alt="" /> Subject : Project <p class='help-block'><small>From: ab.alhyane@gmail.com</small></p><span class="label">23/09/2012</span></a></li>
                                <li class="divider"></li>
                                <li><a href="inbox.html"><img src="<?php echo base_url("img/small/thumb2.png");?>" alt="" /> Subject : Film <p class='help-block'><small>From: ab.alhyane@gmail.com</small></p><span class="label">21/04/2012</span> </a></li>
                                <li class="divider"></li>
                                <li><a href="inbox.html"><img src="<?php echo base_url("img/small/thumb3.png");?>" alt="" /> Subject : Meeting <p class='help-block'><small>From: ab.alhyane@gmail.com</small></p><span class="label">20/02/2012</span></a></li>
                                <li class="divider"></li>
                                <li><a href="inbox.html"><img src="<?php echo base_url("img/small/thumb4.png");?>" alt="" /> Subject : Tasks <p class='help-block'><small>From: ab.alhyane@gmail.com</small></p><span class="label">19/01/2012</span></a></li>
                                <li class="divider"></li>
                                <li class="active"><a href="inbox.html"> Show All </a></li>
                            </ul>
                        </li>
						<!--Los Proyectos actuales-->
                        <li class="dropdown">
                        <a style="text-align:center" href="#" data-toggle="dropdown" ><i class="icon-folder-open icon-white"></i><span class="label label-info">2</span><div>Proyectos</div></a> 
                            <ul class="dropdown-menu">
                                <li><a href="inbox.html"><img src="<?php echo base_url("img/small/thumb1.png");?>" alt="" /> Subject : Project <p class='help-block'><small>From: ab.alhyane@gmail.com</small></p><span class="label">23/09/2012</span></a></li>
                                <li class="divider"></li>
                                <li><a href="inbox.html"><img src="<?php echo base_url("img/small/thumb2.png");?>" alt="" /> Subject : Film <p class='help-block'><small>From: ab.alhyane@gmail.com</small></p><span class="label">21/04/2012</span> </a></li>
                                <li class="divider"></li>
                                <li><a href="inbox.html"><img src="<?php echo base_url("img/small/thumb3.png");?>" alt="" /> Subject : Meeting <p class='help-block'><small>From: ab.alhyane@gmail.com</small></p><span class="label">20/02/2012</span></a></li>
                                <li class="divider"></li>
                                <li><a href="inbox.html"><img src="<?php echo base_url("img/small/thumb4.png");?>" alt="" /> Subject : Tasks <p class='help-block'><small>From: ab.alhyane@gmail.com</small></p><span class="label">19/01/2012</span></a></li>
                                <li class="divider"></li>
                                <li class="active"><a href="inbox.html"> Show All </a></li>
                            </ul>
                        </li>
						<!--Cambio de Rol del Usuario-->
                        <li class="dropdown">
                        	<a href="#" style="text-align:center" data-toggle="dropdown" > <i class="icon-user icon-white"></i><div>Rol</div></a> 
                            <ul class="dropdown-menu">
                                <li><a href="#"> Administrador de Extensión</a></li>
                                <li><a href="#"> Usuario de Extensión</a></li>
                                <li><a href="#"> Usuario de Proyecto </a></li>
                            </ul>
                        </li>
						<!--Calendario de Usuario-->
                        <li class="dropdown">
                        	<a href="#" style="text-align:center" data-toggle="dropdown" > <i class="icon-calendar icon-white"></i><div>Calendario</div></a> 
                        </li>
                    </ul>
				<!--Inicio de Recuadro de Usuario-->
                    <div class="group-menu nav-collapse"> 
                        <ul class="nav pull-right">
                            <li class="divider-vertical"></li>
                            <li class="dropdown">
								<!--Nombre de Usuario-->
								<!--Igual sería buena idea poner el Rol Actual del Usuario en Este apartado-->
                                <a data-toggle="dropdown" href="#">Nombre De Usuario<b class="caret"></b></a>
                               <ul class="dropdown-menu">
                                    <li>
                                        <div class="modal-header">
                                            <h3>Kostali Youssef - Admin</h3>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
												<!--Imagen del Usuario-->
                                                <div class="span1"><img src="<?php echo base_url("img/avatar/photo.png");?>"
 alt="avatar" /></div>
                                                <div class="span3 pull-right">
													<!--Cuenta de Usuario-->
                                                    <h5>mail@gmail.com</h5>
													<!--Acceder a la CUenta del Usuario-->
                                                    <a href="#" class="link-modal" >Account</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="#" class="btn btn-info pull-left">Modificar Perfil</a>
                                            <a class="btn btn-info" href="login.html">Cerrar Sesión</a>
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

        <div class="container-fluid">
            <div class="row-fluid">
                <div id='content' class="span6 section-body">
                    <div id="section-body" class="tabbable">