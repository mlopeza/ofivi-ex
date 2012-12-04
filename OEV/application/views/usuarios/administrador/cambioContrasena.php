<div id="content" class="span9 section-body">
  <div id="section-body" class="tabbable">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#tab1" data-toggle="tab" data-original-title="">Contraseña</a></li>
    </ul>
    <div class="tab-content">
      <div class="span12">
        <div id="accordion1" class="accordion">
          <div class="accordion-group">
            <div class="accordion-heading">
              <a href="#graph" data-toggle="collapse" class="accordion-toggle in" data-original-title="">
              <i class="icon-signal icon-white"></i> <span class="divider-vertical"></span> Cambiar contrase&ntilde;as <i class="icon-chevron-down icon-white pull-right"></i>
              </a>
            </div>
            <div class="accordion-body collapse in" id="graph" style="height: auto;">
              <div class="accordion-inner paddind">
                <h3 id="mensaje-mensaje"><?php 
                  if(isset($mensaje)){
                      echo $mensaje;
                  }
                  ?></h3>
                <?php
                  $attributes = array('id' => 'auth-for', 'class' => 'clearfix' , 'autocomplete' => 'off');
                  echo form_open('cambioContrasena/cambiarContrasena',$attributes);
                  echo "<select name = 'susuario'>";
                  foreach($usuarios as $row){
                  	echo "<option id=".$row->idUsuarios." value=".$row->email.">".$row->Username."</option>";
                  }
                  echo "</select>";
                  ?>
                <br />  <br />
                Nueva Contrase&ntilde;a: <input type="password" name="password" /><br />
                Repetir Contrase&ntilde;a: <input type="password" name="password_conf" /><br />
                <input type="submit" value="Submit" />
                <?php
                  echo form_close();
                  ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
