<?php
$attributes = array('id' => 'auth-for', 'class' => 'clearfix' , 'autocomplete' => 'off');
echo form_open('altaEmpresa/alta',$attributes);
?>
<label for="focusedInput" class="control-label">Grupo.</label>
	<select id="grupo" name="grupo">
	<option value=''></option>;
	<?php
		foreach($grupos as $row){
		echo '<option value='.$row->idGrupo.'>'.$row->nombre.'</>';
		}?>
</select>
	<label for="focusedInput" class="control-label">Nombre de Empresa.</label>

		<input type="text"  id="nombre_empresa" name="nombre_empresa" value="" id="focusedInput" class="input-xlarge focused">
<button class="btn btn-primary" type="submit">Guardar</button>
<?php
echo form_close();
?>
