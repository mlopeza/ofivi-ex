<script  type="text/javascript" >
	$(document).ready(function(){
		//Llena el primer campo
		$("#sgrupo").change(function() {
						getEmpresas($(this).children('option').filter(':selected').attr('id'),$(this));			
		});
		$('[name="estado"]').change(function() {
						getGrupo($(this).val());						
		});

	function getGrupo(valor){
			/*Datos a mandar para indicar si esta activo o no*/
			var data={ 
			's_token':$('#s_token').attr('value'),
			'activo':valor,
			};
			/*Hace la llamada y maneja la respuesta con un popup en caso de que haya habido un error*/
			$.ajax({
			     type: "POST",
			     url: "avancesproyecto/getGrupos",
			     data: data ,
			     success: function(msg){

						var mensaje = $.parseJSON(msg);

						if(mensaje['response'] ==  "true"){
								//Agrega las Empresas al nodo seleccionado
								var sGrupo = $('#sgrupo');								
								var sEmpresas = $('#sempresa');
								var sProyectos = $('#sproyecto');
								//Elimina nodos
								$(sGrupo).empty();
								$(sEmpresas).empty();
								$(sProyectos).empty();
								//Agrega los nodos que se buscaron
								appendGrupo(mensaje['grupo'],sGrupo);
								appendEmpresas(mensaje['mensaje'],sEmpresas);													
							appendProyectos(mensaje['proyectos'],sProyectos);
						}else{
							noty({text: mensaje['mensaje'], type: 'error'});
						}

			     },
				error: function(msg){
						noty({text: "Ha habido un error en el sistema, intentelo nuevamente.", type: 'error'});
				}
			});
	}
	//Regresa las empresas que pertenecen a un Grupo y las
	//Inserta en el OptionS List
	function getEmpresas(idGrupo,elemento){
			/*Datos de la tabla con Respecto al usuario*/
			var data={ 
			's_token':$('#s_token').attr('value'),
			'idGrupo':idGrupo,
			'activo':$('[name="estado"]').val(),
			};
			/*Hace la llamada y maneja la respuesta con un popup en caso de que haya habido un error*/
			$.ajax({
			     type: "POST",
			     url: "avancesproyecto/getEmpresas",
			     data: data ,
			     success: function(msg){

						var mensaje = $.parseJSON(msg);
						if(mensaje['response'] ==  "true"){
								//Agrega las Empresas al nodo seleccionado
								var sEmpresas = $('#sempresa');
								var sProyectos = $('#sproyecto');
								//Elimina nodos
								$(sEmpresas).empty();
								$(sProyectos).empty();
								//Agrega los nodos que se buscaron
								appendEmpresas(mensaje['mensaje'],sEmpresas);
							 	console.log(mensaje['proyectos']);							
								appendProyectos(mensaje['proyectos'],sProyectos);
						}else{
							noty({text: mensaje['mensaje'], type: 'error'});
						}

			     },
				error: function(msg){
						noty({text: "Ha habido un error en el sistema, intentelo nuevamente.", type: 'error'});
				}
			});
	}
	
	function getProyectos(idEmpresa,elemento){
			/*Datos de la tabla con Respecto al usuario*/
			var data={ 
			's_token':$('#s_token').attr('value'),
			'idEmpresa':idEmpresa,
			'activo':$('[name="estado"]').val(),			
			};
			/*Hace la llamada y maneja la respuesta con un popup en caso de que haya habido un error*/
			$.ajax({
			     type: "POST",
			     url: "avancesproyecto/getProyecto",
			     data: data ,
			     success: function(msg){
					 	console.log(msg);
						var mensaje = $.parseJSON(msg);
						console.log(mensaje);
						if(mensaje['response'] ==  "true"){
								//Agrega las Empresas al nodo seleccionado
								var sProyectos = $('#sproyecto');
								//Elimina nodos

								$(sProyectos).empty();
								//Agrega los nodos que se buscaron
								appendProyecto(mensaje['mensaje'],sProyectos);
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
	function appendProyectos(nodos,elemento){
		if(nodos.length == 0){
			$(elemento).append($("<option>").append("No hay Proyectos registrados").attr('id','0'));
		}else{
			$(nodos).each(function(index,nodo){
				$(elemento).append($("<option>").append(nodo['nombre']).attr('id',nodo['idProyecto']));
			});
		}
	}	
	function appendGrupo(nodos,elemento){
		if(nodos.length == 0){
			$(elemento).append($("<option>").append("No hay Proyectos registrados").attr('id','0'));
		}else{
			$(nodos).each(function(index,nodo){
				$(elemento).append($("<option>").append(nodo['nombre']).attr('id',nodo['idGrupo']));
			});
		}
	}		

		
	});

</script>
