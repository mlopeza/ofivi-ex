<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>OFIVEX</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="Mario Adri&#65533;n L&#65533;pez Alem&#65533;n" />
    <style type="text/css">
      body {
      padding-top: 60px;
      padding-bottom: 40px;
      }
    </style>
    <!--  styles -->
    <!-- bootstrap css -->
    <link href="<?php echo base_url("css/bootstrap.min.css");?>" rel="stylesheet" />
    <!-- base css -->
    <link href="<?php echo base_url("css/base.css");?>" rel="stylesheet" />
    <!-- login page css -->
    <link href="<?php echo base_url("css/login.css");?>" rel="stylesheet" />
    <link href="<?php echo base_url("css/noty.css"); ?>" rel="stylesheet" />
    <link href="<?php echo base_url("css/noty-css/noty_theme_default.css"); ?>" rel="stylesheet" />
    <link href="<?php echo base_url("css/noty-css/jquery.noty.css"); ?>" rel="stylesheet"
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!-- fav and touch icons -->
  </head>
  <body>
    <!--Inicia la Barra Superior-->
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <!--Logo del Sistema-->
          <a class="brand"><img src="<?php echo base_url("img/logo-small.png");?>" alt="logo" /></a>
        </div>
      </div>
    </div>
    <!--Finaliza la Barra Superior-->
    <div class="container-fluid">
      <div class="row-fluid">
        <!--Inicio de Solicitud de Cuenta-->
        <div class="singup" style="display:none;">
          <div class="accounts-form" id="signup">
            <h2>Solicita una cuenta al administrador.</h2>
            <hr class="small" />
            <?php
              $attributes = array('id' => 'auth-for', 'class' => 'clearfix' , 'autocomplete' => 'off', 'name'=> 'forma');
              echo form_open('logincontroller/signup',$attributes);
              ?>
            <div class="input">
              <input type="text" maxlength="30" name="username" placeholder="Usuario" id="id_username" required />
            </div>
            <div class="input">
              <input type="text" maxlength="30" name="nombre" placeholder="Nombre" id="name" required />
            </div>
            <div class="input">
              <input type="text" maxlength="30" name="apellido_paterno" placeholder="Apellido Paterno" id="lastname1" required />
            </div>
            <div class="input">
              <input type="text" maxlength="30" name="apellido_materno" placeholder="Apellido Materno" id="lastname2" required />
            </div>
            <div class="input">
              <input type="text" maxlength="75" name="email" placeholder="Email" id="id_email" required />
              <div class="email_suggestion" style="display: none;"></div>
            </div>
            <div class="input">
              <input type="password" id="id_password" name="password" placeholder="Contrase&ntilde;a" required />
            </div>
            <div class="input">
              <input type="password" id="id_password" name="password_confirm" placeholder="Confirma contrase&ntilde;a" required />
            </div>
            <div class="input">
              <select name="campus" id="select-escuela">
              <?php foreach($campus as $camp){
                echo "<option value=".$camp->idCampus.">".$camp->Nombre."</option>";}
                	?>
              </select>
            </div>
            <div class="input">
              <select name="escuela" id="select-escuela">
                <option>Escuela</option>
              </select>
            </div>
            <div class="input">
              <select name="departamento" id="select-escuela">
                <option>Departamento</option>
              </select>
            </div>
            <div class="input">
              <select name="tipo-usuario" id="select-usuario">
                <option value="">Tipo de Usuario</option>
                <option value="a">Administrador de Extensión</option>
                <option value="u">Usuario de Extensión</option>
                <option value="p">Usuario de Proyectos</option>
                <option value="l">Usuario de Legal </option>
              </select>
            </div>
            <div class="actions">
              <input type="submit" class="btn btn-success" value="Solicitar Cuenta" name="submit" />
            </div>
            <p class="note"><span class="label label-warning">¿Ya tienes una cuenta?</span> &nbsp;<a href="#">Inicia Sesión</a></p>
            <?php
              echo form_close();
              ?>	
          </div>
        </div>
        <!--Finaliza Solicitud de Cuenta-->
        <!--Inicia Inicio de Sesion-->
        <div class="singin" style="display:block;">
          <div class="accounts-form">
            <h2>Inicia sesión con tu cuenta.</h2>
            <hr class="small" />
            <?php
              $attributes2 = array('id' => 'login', 'class' => 'clearfix' , 'autocomplete' => 'off');
              echo form_open('logincontroller/login',$attributes2);
              ?>
            <div class="input">
              <input type="text" maxlength="30" name="username" placeholder="N&oacute;mina" id="username" required />
            </div>
            <div class="input">
              <input type="password" id="password" name="password" placeholder="Contrase&ntilde;a" required />
            </div>
            <div class="actions">
              <input type="submit" class="btn btn-success" value="Iniciar Sesi&oacute;n" />
            </div>
            <p class="note"><span class="label label-info"> ¿Necesitas una cuenta? </span>  &nbsp; <a href="#"> Solicítala!</a> </p>
            </form>
          </div>
        </div>
        <!--Finaliza Inicio de Sesion-->
      </div>
    </div>
    <!-- JavaScript
      ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url("js/jquery.min.js");?>"></script>
    <script src="<?php echo base_url("js/bootstrap.min.js");?>"></script>
    <script src="<?php echo base_url("js/jquery.noty.js");?>"></script>
    <!--Este apartado permite hacer el cambio entre la solicitud y el inicio de Sesion-->
    <script type="text/javascript">
      $('.note a').click(function(){
          $('.singup').toggle(1000);
          $('.singin').toggle(1000);
      });
      
    </script>    
  </body>
</html>
