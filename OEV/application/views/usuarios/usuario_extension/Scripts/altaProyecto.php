<script type="text/javascript" >
	/*Logica de Creación de Proyecto*/
	$(document).ready(function(){
		//Llena el primer campo
		$("#Grupo").change(function() {
			getEmpresas($(this).children('option').filter(':selected').attr('id'),$(this));			
		});


		//Agrega un Nuevo campo para los telefonos
		$("#contacto-nuevo-telefono").click(function(){
			var o = $('<tr><td><input class="descripcion" type="text" style="max-width:100px;"></input></td><td><input class="lada" style="max-width:25px;" type="text"></input></td><td><input class="telefono" style="max-width:50px;" type="text"></input></td><td><input class="extension" type="text" style="max-width:30px;"></input></td><td><input class="descripcionExtra" type="text" style="max-width:50px;"></input></td><td><button class="btn btn-danger remove-telefono" type="button"><i class="icon-remove icon-white"></i></button></td></tr>');
			$("#contacto-telefonos-body").append(o);
		});

		//Remueve un telefono de la lista
		$(".remove-telefono").live("click",function(){
			$(this).parent().parent().remove();
		});

		//Remueve un telefono de la lista
		$(".remove-telefono-tabla").live("click",function(){
			$(this).parent().parent().remove();
		});

		//Regresa los datos para edicion
		$(".edit-telefono-tabla").live("click",function(){
			regresaEdicion($(this).parent().parent());
			$(this).parent().parent().remove();
		});

		//Agrega un Contacto a la Tabla
		$("#agrega-contacto-arreglo").click(function(){

			//Verifica que no se inserten cosas vacias
			if( $("#contacto-nombre").val().trim() == "" || 
				$("#contacto-ap").val().trim() == "" || 
				$("#contacto-email").val().trim() == ""
			){
				noty({text: 'Faltan campos del Contacto por llenar.', type: 'error'});
				return;
			}
			//Los telefonos del contacto
			var body = $("#contacto-telefonos-body");
			
			//Agrega todos los telefonos a un objeto
			var telefonos = {};
			var atelefonos="";
			$(body.children()).each(function(index,nodo){
					if($(nodo).find('.telefono').val().trim() != ""){
						telefonos[index] = {};
						telefonos[index]["descripcion"] = $(nodo).find('.descripcion').val();
						telefonos[index]["telefono"] = $(nodo).find('.telefono').val();
						telefonos[index]["extension"] = $(nodo).find('.extension').val();
						telefonos[index]["lada"] = $(nodo).find('.lada').val();
						telefonos[index]["descripcionExtra"] = $(nodo).find('.descripcionExtra').val();
						atelefonos=atelefonos+telefonos[index]["telefono"];
	
						if(telefonos[index]["extension"] == ""){
							atelefonos = atelefonos+"<br>"
						}else{
							atelefonos=atelefonos+" ext."+telefonos[index]["extension"]+"<br>";

						}
					}
			});

			a=$('<tr></tr>').attr({
				    nombre: $("#contacto-nombre").val(),
				    apellidop: $("#contacto-ap").val(),
					apellidom: $("#contacto-am").val(),
					recibe:$("#contacto-enviar").is(':checked'),
					email:$("#contacto-email").val(),
                    puesto:$("#contacto-puesto").val(),
                    departamento:$("#contacto-departamento").val(),
					telefonos:JSON.stringify(telefonos)
			});

			a.append("<td>"+$("#contacto-nombre").val()+" "+$("#contacto-ap").val()+" "+$("#contacto-am").val()+"</td>")
			a.append("<td>"+atelefonos+"</td>");
			a.append("<td style=\"text-align:center;\"><button class=\"btn btn-info edit-telefono-tabla\" type=\"button\"><i class=\"icon-edit icon-white\"></i></button>&nbsp;&nbsp;&nbsp;&nbsp;<button class=\"btn btn-danger remove-telefono-tabla\" type=\"button\"><i class=\"icon-remove icon-white\"></i></button></td>");
			$("#contactos-body").append(a);

			//Limpia datos de la forma
			$("#contacto-nombre").val("");
			$("#contacto-ap").val("");
			$("#contacto-am").val("");
			$("#contacto-enviar").attr('checked', false);
			$("#contacto-email").val("");
			$("#contacto-departamento").val("");
			$("#contacto-puesto").val("");
			$("#contacto-telefonos-body").empty();
		});
			
		//Consulta AJAX de Clientes
	    $("#demo-input-local").tokenInput(getContactos);

		//Envia todo al servidor para guardarse
		$("#GuardarTodo").click(function(){

			if($(this).hasClass('disabled-button')){
					return;
			}
			//No permite que se toque el boton
			$(this).addClass('disabled-button');

			nombre_proyecto=$("#nombre_proyecto").val();
			idEmpresa=$("#Empresa").children('option').filter(':selected').attr('id');
			idUsuario=$("#idUsuario-sistema").attr('idUsuario');
			idGrupo=$("#Grupo").children('option').filter(':selected').attr('id');
			var new_contactos = {};			
			$.each($("#contactos-body").children(),function(index,a){
				new_contactos[index]={};
				new_contactos[index]['Nombre']=$(a).attr('nombre');
				new_contactos[index]['ApellidoP']=$(a).attr('apellidop');
				new_contactos[index]['ApellidoM']=$(a).attr('apellidom');
				new_contactos[index]['email']=$(a).attr('email');
				new_contactos[index]['departamento']=$(a).attr('departamento');
				new_contactos[index]['puesto']=$(a).attr('puesto');
				new_contactos[index]['Recibe_Correos']=$(a).attr('recibe');
				new_contactos[index]['telefonos']=$.parseJSON($(a).attr('telefonos'));
			});
			var oldContactos = $("#demo-input-local").tokenInput("get");
			var descripcion_cliente=$($('iframe')[0]).contents().find('.wysihtml5-editor').html();
			var descripcion_usuario=$($('iframe')[1]).contents().find('.wysihtml5-editor').html();

			var data={ 
			'nombre_proyecto':nombre_proyecto,
			'idEmpresa':idEmpresa,
            'iniciadoPor':idUsuario,
			'idGrupo':idGrupo,
			'newContactos':new_contactos,
			'oldContactos':oldContactos,
			'descripcionCliente':descripcion_cliente,
			'descripcionUsuario':descripcion_usuario
			};
			console.log(data);
			/*Hace la llamada y maneja la respuesta con un popup en caso de que haya habido un error*/
			$.ajax({
			     type: "POST",
			     url: "altaProyecto/guardaProyecto",
			     data: data ,
			     success: function(msg){
								console.log(msg);
								mensaje=$.parseJSON(msg);
							if(mensaje['response'] == "true"){
								noty({text: mensaje['mensaje'], type: 'success'});
								setTimeout(function() { location.reload(); }, 3000);
							}else{
								noty({text: mensaje['mensaje'], type: 'error'});
								$(this).removeClass('disabled-button');
							}
			     },
				error: function(msg){
						noty({text: "Ha habido un error en el sistema, intentelo nuevamente.", type: 'error'});
						$(this).removeClass('disabled-button');
				}
			});
			//Carga nuevamente la pagina
		});

	});


	function getContactos(){
			var empresa = $("#Empresa").children('option').filter(':selected').attr('id');
			return "altaProyecto/getContactos?idEmpresa="+(empresa == null?0:empresa);
	}

	//Regresa las empresas que pertenecen a un Grupo y las
	//Inserta en el OptionS List
	function getEmpresas(idGrupo,elemento){
			/*Datos de la tabla con Respecto al usuario*/
			var data={ 
			's_token':$('#s_token').attr('value'),
			'idGrupo':idGrupo,
			};
			/*Hace la llamada y maneja la respuesta con un popup en caso de que haya habido un error*/
			$.ajax({
			     type: "POST",
			     url: "altaProyecto/getEmpresas",
			     data: data ,
			     success: function(msg){
						var mensaje = $.parseJSON(msg);
						console.log(mensaje);
						if(mensaje['response'] ==  "true"){
								//Agrega las Empresas al nodo seleccionado
								var sEmpresas = $('#Empresa');
								//Elimina nodos
								$(sEmpresas).empty();
								//Agrega los nodos que se buscaron
								appendEmpresas(mensaje['mensaje'],sEmpresas);
						}else{
							noty({text: mensaje['mensaje'], type: 'error'});
						}

			     },
				error: function(msg){
						noty({text: "Ha habido un error en el sistema, intentelo nuevamente.", type: 'error'});
				}
			});
	}


	/*Agrega todos los elementos de un arreglo a un nodo*/
	function appendEmpresas(nodos,elemento){
		if(nodos.length == 0){
			$(elemento).append($("<option>").append("No hay Empresas Registradas").attr('id','0'));
		}else{
			$(nodos).each(function(index,nodo){
				$(elemento).append($("<option>").append(nodo['nombre']).attr('id',nodo['idEmpresa']));
			});
		}
	}


	function regresaEdicion(nodo){
			$("#contacto-nombre").val($(nodo).attr('nombre'));
			$("#contacto-ap").val($(nodo).attr('apellidop'));
			$("#contacto-am").val($(nodo).attr('apellidom'));
			$("#contacto-enviar").attr('checked', $(nodo).attr('recibe'));
			$("#contacto-email").val($(nodo).attr('email'));
            $("#contacto-puesto").val($(nodo).attr('puesto'));
            $("#contacto-departamento").val($(nodo).attr('departamento'));
			nodos = $.parseJSON($(nodo).attr('telefonos'));

			//Se iteran los telefonos y se agregan al body nuevamente
			$.each(nodos,function(index,value){
				var o = $('<tr><td><input class="descripcion" type="text" style="max-width:100px;"></input></td><td><input class="lada" style="max-width:25px;" type="text"></input></td><td><input class="telefono" style="max-width:50px;" type="text"></input></td><td><input class="extension" type="text" style="max-width:30px;"></input></td><td><input class="descripcionExtra" type="text" style="max-width:50px;"></input></td><td><button class="btn btn-danger remove-telefono" type="button"><i class="icon-remove icon-white"></i></button></td></tr>');
						$(o).find('.descripcion').val(value["descripcion"]);
						$(o).find('.telefono').val(value["telefono"]);
						$(o).find('.extension').val(value["extension"]);
						$(o).find('.lada').val(value["lada"]);
						$(o).find('.descripcionExtra').val(value["descripcionExtra"]);
				$("#contacto-telefonos-body").append(o);
			});
			
	}
</script>
