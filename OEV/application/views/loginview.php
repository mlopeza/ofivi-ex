<?php
echo form_open('logincontroller/send');
?>
Usuario:<input name="usuario" type="text" /><br>
Contrasena:<input name="contrasena" type="number"/> <br>

<input name="login" type="submit" value="Login">
<?php
echo form_close();
?>
