<?php
		
		$attributes = array('id' => 'auth-for', 'class' => 'clearfix' , 'autocomplete' => 'off');
		echo form_open('cambioContrasena/cambiarContrasena',$attributes);
		echo "<select name = 'susuario'>";
		foreach($usuarios as $row){
			echo "<option id=".$row->idUsuarios." value=".$row->email.">".$row->Username."</option>";
		}
		echo "</select>";
?>
Nueva Contrase&ntilde;a: <input type="password" name="password" ><br>
Validar Contrase&ntilde;a: <input type="password" name="password_conf" ><br>
<input type="submit" value="Submit">
<?php
echo form_close();
?>