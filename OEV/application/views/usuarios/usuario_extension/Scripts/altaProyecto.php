<script type="text/javascript" >
	/*Logica de Creación de Proyecto*/
	var contacto_telefono='<tr><td><input class="descripcion" type="text"></input></td><td><input class="telefono" type="text"></input></td><td><input class="extension" type="text"></input></td><td><button class="btn btn-danger"><i class="icon-warning-sign icon-white"></i>Borrar</button>></td></tr>'
	var telefono_new="<tr></tr>";
	$(document).ready(function(){
		//Llena el primer campo
		$("#Grupo").change(function() {
			getEmpresas($(this).children('option').filter(':selected').attr('id'),$(this));
			
		});


		//Agrega un Nuevo campo para los telefonos
		$("#contacto-nuevo-telefono").click(function(){
			var o = $("<tr>").append("<td></td>");
			console.log(o);
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
