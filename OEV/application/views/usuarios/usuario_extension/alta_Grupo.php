<?php
$attributes = array('id' => 'auth-for', 'class' => 'clearfix' , 'autocomplete' => 'off');
echo form_open('altaGrupo/alta',$attributes);
?>

	<label for="focusedInput" class="control-label">Nombre de Grupo.</label>

		<input type="text"  id="nombre_grupo" name="nombre_grupo" value="" id="focusedInput" class="input-xlarge focused">
<button class="btn btn-primary" type="submit">Guardar</button>
<?php
echo form_close();
?>
