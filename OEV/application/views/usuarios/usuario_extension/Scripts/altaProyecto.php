<script type="text/javascript" >
	/*Logica de Creación de Proyecto*/
	$(document).ready(function(){
		//Llena el primer campo
		$("#Grupo").change(function() {
			getEmpresas($(this).children('option').filter(':selected').attr('id'),$(this));
			
		});


		//Agrega un Nuevo campo para los telefonos
		$("#contacto-nuevo-telefono").click(function(){
			var o = $('<tr><td><input class="descripcion" type="text" style="max-width:100px;"></input></td><td><input class="telefono" style="max-width:100px;" type="text"></input></td><td><input class="extension" type="text" style="max-width:100px;"></input></td><td><button class="btn btn-danger remove-telefono" type="button"><i class="icon-remove icon-white"></i></button></td></tr>');
			$("#contacto-telefonos-body").append(o);
		});

		$(".remove-telefono").live("click",function(){
			$(this).parent().parent().remove();
		});

		//Agrega un Contacto a la Tabla
		$("#agrega-contacto-arreglo").click(function(){
			//Los telefonos del contacto
			var body = $("#contacto-telefonos-body");
				console.log(body.children());
			
			//Agrega todos los telefonos a un objeto
			var telefonos = {};
			var atelefonos="";
			$(body.children()).each(function(index,nodo){
					telefonos[index] = {};
					telefonos[index]["descripcion"] = $(nodo).find('.descripcion').val();
					telefonos[index]["telefono"] = $(nodo).find('.telefono').val();
					telefonos[index]["extension"] = $(nodo).find('.extension').val();
					atelefonos=atelefonos+telefonos[index]["telefono"];
	
					if(telefonos[index]["extension"] == ""){
						atelefonos = atelefonos+"<br>"
					}else{
						atelefonos=atelefonos+" ext."+telefonos[index]["extension"]+"<br>";

					}
			});

			console.log(JSON.stringify(telefonos));
			console.log($.parseJSON(JSON.stringify(telefonos)));
			
			a=$('<tr></tr>').attr({
				    nombre: $("#contacto-nombre").val(),
				    apellidop: $("#contacto-ap").val(),
					apellidom: $("#contacto-am").val(),
					recibe:$("#contacto-enviar").is(':checked'),
					email:$("#contacto-email").val(),
					telefonos:JSON.stringify(telefonos)
			});

			a.append("<td>"+$("#contacto-nombre").val()+" "+$("#contacto-ap").val()+" "+$("#contacto-am").val()+"</td>")
			a.append("<td>"+atelefonos+"</td>");
			a.append("<td>Accion</td>");
			$("#contactos-body").append(a);
		});


	});


	//Regresa las empresas que pertenecen a un Grupo y las
	//Inserta en el OptionS List
	function getEmpresas(idGrupo,elemento){
			/*Datos de la tabla con Respecto al usuario*/
			var data={ 
			's_token':$('#csrf_token').attr('value'),
			'idGrupo':idGrupo,
			};

			/*Hace la llamada y maneja la respuesta con un popup en caso de que haya habido un error*/
			$.ajax({
			     type: "POST",
			     url: "altaProyecto/getEmpresas",
			     data: data ,
			     success: function(msg){
						var mensaje = $.parseJSON(msg);
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
	}

</script>
