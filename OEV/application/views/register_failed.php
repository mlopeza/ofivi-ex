<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>DASHBOARD</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="Mario Adri&aacute;n L&oacute;pez Alem&aacute;n" />
    <!--  styles -->
    <!-- bootstrap css -->
    <link href="<?php echo base_url("css/bootstrap.min.css");?>" rel="stylesheet" />
    <!-- base css -->
    <link href="<?php echo base_url("css/base.css");?>" rel="stylesheet" />
    <!-- login page css -->
    <link href="<?php echo base_url("css/error-page.css");?>" rel="stylesheet" />
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!-- fav and touch icons -->
    <style type="text/css">
      body {
      padding-top: 60px;
      padding-bottom: 40px;
      }
      .sidebar-nav {
      padding: 9px 0;
      }
    </style>
    <!-- bootstrap responsive css -->
    <link href="css/bootstrap-responsive.css" rel="stylesheet" />
    <!-- media queries css -->
    <link href="css/media-fluid.css" rel="stylesheet" />
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>
  <body class="error">
    <!--Inicia la Barra Superior-->
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <!--Logo del Sistema-->
          <a class="brand"><img src="<?php echo base_url("img/logo-small.png");?>" alt="logo" /></a>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="span12">
          <div class="errorWrapper">
            <h1 class="pageErrorTitle">Fall&oacute; al registrarse.</h1>
            <!-- Aqui se puede poner un mensaje con respecto al problema que haya ocurrido-->
            <span>Por favor intentelo de nuevo o contacte al administrador.</span>
            <br />
            <a href="javascript:history.back()" class="btn btn-info btn-toolbar btn-large"><i class="icon-chevron-left icon-white"></i> Regresar a la p&aacute;gina anterior.</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Le javascript
      ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url("js/jquery.min.js");?>"></script>
    <script src="<?php echo base_url("js/bootstrap.min.js");?>"></script>
  </body>
</html>
