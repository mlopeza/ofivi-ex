<html>
	<head>
		<title><p>Hola Mundo</p></title>
	</head>
<body>
	<form action="/OEV/index.php/proyectoExterno/altaProyectoExterno" method="post" id="commentform">
     
 
		<table width="40" border="0">
			<tr>
			<td width="33%">Nombres <input type="text" name="nombre" id="nombre" size="28" tabindex="1" class="styled" /></td>
			<td width="33%">Apellido Paterno <input type="text" name="apellidoP" id="apellidoP" size="28" tabindex="1" class="styled" /></td>
			<td width="34%">Apellido Materno <input type="text" name="apellidoM" id="apellidoM" size="28" tabindex="1" class="styled" /></td> </tr>
		</table>
		<p>
		Correo electr&oacute;nico<br> <input type="text" name="email" id="email" size="32" tabindex="1" class="styled" /><br>
		Empresa <br> <input type="text" name="empresa" id="empresa" size="32" tabindex="1" class="styled" /><br>
		Puesto <br> <input type="text" name="puesto" id="puesto" size="32" tabindex="1" class="styled" />
		<br> Estado de la Rep&uacute;blica <br>

		<select name="estadoRep" id="estadoRep" >
					  <option value="N/A" selected="selected">---</option>
					  <option value="Aguascalientes" >Aguascalientes</option>
					  <option value="Baja California">Baja California</option>
					  <option value="Baja California Sur">Baja California Sur</option>
					  <option value="Campeche">Campeche</option>
					  <option value="Chiapas">Chiapas</option>
					  <option value="Chihuahua">Chihuahua</option>
					  <option value="Coahuila">Coahuila</option>
					  <option value="Colima">Colima</option>
					  <option value="Distrito Federal">Distrito Federal</option>
					  <option value="Durango">Durango</option>
					  <option value="Estado de México">Estado de México</option>
					  <option value="Guanajuato">Guanajuato</option>
					  <option value="Guerrero">Guerrero</option>
					  <option value="Hidalgo">Hidalgo</option>
					  <option value="Jalisco">Jalisco</option>
					  <option value="Michoacán">Michoacán</option>
					  <option value="Morelos">Morelos</option>
					  <option value="Nayarit">Nayarit</option>
					  <option value="Nuevo León">Nuevo León</option>
					  <option value="Oaxaca">Oaxaca</option>
					  <option value="Puebla">Puebla</option>
					  <option value="Querétaro">Querétaro</option>
					  <option value="Quintana Roo">Quintana Roo</option>
					  <option value="San Luis Potosí">San Luis Potosí</option>
					  <option value="Sinaloa">Sinaloa</option>
					  <option value="Sonora">Sonora</option>
					  <option value="Tabasco">Tabasco</option>
					  <option value="Tamaulipas">Tamaulipas</option>
					  <option value="Tlaxcala">Tlaxcala</option>
					  <option value="Veracruz">Veracruz</option>
					  <option value="Yucatán">Yucatán</option>
					  <option value="Zacatecas">Zacatecas</option>
				  </select>
				 <br>
		<table width="40px" border="0">
			<tr>
			<td width="11%"><div align="center">Lada <input type="text" name="lada" id="lada" size="7" tabindex="1" class="styled" />
			</div></td>

			<td width="28%"><div align="center">Tel&eacute;fono
			<input type="text" name="telefono" id="telefono" size="22" tabindex="1" class="styled" />
			</div></td>

			<td width="14%"><div align="center">Ext
			<input type="text" name="extension" id="extension" size="10" tabindex="1" class="styled" />
			</div></td>

			<td width="14%"><div align="center">Sub-ext
			<input type="text" name="informacionExtra" id="informacionExtra" size="10" tabindex="1" class="styled" />
			</div></td>


			<td width="33%"><p>&nbsp;</p><p></p></td>
			</tr>
		</table>
		<p>Categor&iacute;a<br />
		<select name="categoria" size="1" id="categoria">
			<option value="NA" selected="selected">---</option>
			<option value="Categoria1">ADMINISTRACI&Oacute;N Y NEGOCIOS</option>
			<option value="Categoria2">ARQUITECTURA Y CONSTRUCCI&Oacute;N</option>
			<option value="Categoria3">BIOTECNOLOG&Iacute;A Y ALIMENTOS</option>
			<option value="Categoria4">CIENCIAS SOCIALES</option>
			<option value="Categoria5" >DESARROLLO PERSONAL</option>
			<option value="Categoria6">DESARROLLO SOSTENIBLE</option>
			<option value="Categoria7" >EMPRENDIMIENTO</option>
			<option value="Categoria8">IDIOMAS</option>
			<option value="Categoria9">INGENIER&Iacute;A Y DISE&Ntilde;O</option>
			<option value="Categoria10">MEDICINA</option>
			<option value="Categoria11">MEJORA DEL DESEMPE&Ntilde;O EMPRESARIAL</option>
			<option value="Categoria12">TECNOLOG&Iacute;AS DE INFORMACI&Oacute;N</option>
			<option value="Categoria13">OTRAS</option>
		</select>
		</p>
		<p>Subcategor&iacute;a<br />
		<input type="text" name="subCategoria" id="subCategoria" size="52" tabindex="1" class="styled" />
		<br>
		<p>Nombre de proyecto<br />
		<input type="text" name="nombreProyecto" id="nombreProyecto" size="52" tabindex="1" class="styled" />
		<br>
		<p>Descripci&oacute;n del servicio que solicita.<br />
		<textarea name="descripcionUsuario" cols="80%" rows="6" class="submitdate" id="descripcionUsuario" tabindex="2">Especificaciones del proyecto, dudas y/o comentarios.</textarea></p> 
		 
		<p>
		  <input type="submit" name="Enviar" id="Enviar" value="Enviar Solicitud" />
		</p> 
 
</form>
</body>
</html>
