<?php
						//$datos_usuario=$this->session->all_userdata();
							$attributes = array('id' => 'auth-for', 'class' => 'clearfix' , 'autocomplete' => 'off');
							echo validation_errors(); 
							echo form_open('cambioContrasena/cambiarContrasenaU',$attributes);
?>
<input type="hidden" name="idUsuario" value="<?php echo 4;//$datos_usuario['idUsuario'];?>" />
Contrase&ntilde;a Actual: <input type="password" name="passwordActual" ><br>
Nueva Contrase&ntilde;a: <input type="password" name="password" ><br>
Validar Contrase&ntilde;a: <input type="password" name="password_conf" ><br>
<input type="submit" value="Submit">
<?php
echo form_close();
?>