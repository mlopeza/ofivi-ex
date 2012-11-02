        <link href="<?php echo base_url("css/projectAdvances.css"); ?>" rel="stylesheet">
<br />
Activo<input type="radio" name="estado" id="activo" value="1">
Inactivo<input type="radio" name="estado" id="inactivo" value="0"><br />
<?php
		echo "<select id = 'sgrupo'>
				<option> </option>";	
		echo "</select>";
		echo "<select  id = 'sempresa'><option></option></select>";
		echo "<select id = 'sproyecto'></select>\n";
?>
<div>
<table id='showThis' class="table table-bordered">
	<tr>
		<td>
        	Contacto
    	</td>
        <td>
        	<ul name='contacto'>			
			</ul> 
        </td>
    </tr>
	<tr>
		<td>
        	Usuarios
    	</td>
        <td>
        	<ul name='profesor'>			
			</ul> 
        </td>
    </tr>
	<tr>
		<td>
        	Categoría
    	</td>
        <td name='categoria'>
        </td>
    </tr>            
</table></div><div>

<table id='showThis2' border='1'>
	<th>
    	Status
    </th>
</table>
</div>