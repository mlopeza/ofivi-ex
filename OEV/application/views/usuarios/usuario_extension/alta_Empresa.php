<?php
$attributes = array('id' => 'auth-for', 'class' => 'clearfix' , 'autocomplete' => 'off');
echo form_open('altaEmpresaGrupo/alta',$attributes);
?>
<input type="text"  id="nombre_empresa" name="nombre_empresa" value="" id="focusedInput" class="input-xlarge focused">

<?php
echo form_close();
?>
