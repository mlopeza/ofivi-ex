<html>
<head>
<title>Alta de proyecto</title>
</head>
<body>
<?php
$attributes = array('id' => 'auth-for', 'class' => 'clearfix' , 'autocomplete' => 'off');
echo form_open('altaProyecto/alta',$attributes);
?>
Nombre de proyecto: <input type="text" id="nombre" name="nombre"><br>
Descripción: <input type="text" id="descripcionUsuario" name="descripcionUsuario"><br>
Interpretación: <input type="text" id="descripcionAEV" name="descripcionAEV"><br>
<input type="submit" value="Crear">
<?php
echo form_close();
?>
</body>
</html>
