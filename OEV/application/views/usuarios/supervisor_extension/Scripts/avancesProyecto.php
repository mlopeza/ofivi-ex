<script  type="text/javascript" >
	$(document).ready(function(){
		
		//Llena el primer campo
		$("#sgrupo").change(function() {
						getEmpresas($(this).children('option').filter(':selected').attr('id'),$(this));			
		});
	    $("#sempresa").change(function() {
						getProyectos($(this).children('option').filter(':selected').attr('id'),$(this));			
		});
		$("#sproyecto").change(function() {
						getInfo($(this).children('option').filter(':selected').attr('id'),$(this));			
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
						console.log(msg);
						var mensaje = $.parseJSON(msg);
						if(mensaje['response'] ==  "true"){
								//Agrega las Empresas al nodo seleccionado
								var sGrupo = $('#sgrupo');								
								var sEmpresas = $('#sempresa');
								var sProyectos = $('#sproyecto');
								var sCategoria = $('[name = "categoria"]');
								var sContactos = $('[name = "contacto"]');
								var sProfesor = $('[name="profesor"]');
								var sEstados = $('#sestados');
								var sDocumentos = $('[name = "documento"]');
								//Elimina nodos
								$(sGrupo).empty();
								$(sEmpresas).empty();
								$(sProyectos).empty();
								$(sCategoria).empty();
								$(sProfesor).empty();
								$(sContactos).empty();
								$(sEstados).empty();
								$(sDocumentos).empty();
								//Agrega los nodos que se buscaron
								appendGrupo(mensaje['grupo'],sGrupo);
								appendEmpresas(mensaje['mensaje'],sEmpresas);													
							    appendProyectos(mensaje['proyectos'],sProyectos);
								appendCategoria(mensaje['categoria'],sCategoria,mensaje['supracategoria']);
								appendProfesor(mensaje['usuario'],sProfesor);
								appendContacto(mensaje['contacto'],sContactos);
								appendEstado(mensaje['estado'],sEstados);
								appendDocument(mensaje['documento'],sDocumentos);
							$('#showThis').attr("style","display:inline-table");
							$('#showThis2').attr("style","display:inline-table");
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
								var sCategoria = $('[name = "categoria"]');
								var sContactos = $('[name = "contacto"]');
								var sProfesor = $('[name="profesor"]');
								var sEstados = $('#sestados');
								var sDocumentos = $('[name = "documento"]');
								
								//Elimina nodos
								$(sEmpresas).empty();
								$(sProyectos).empty();
								$(sCategoria).empty();
								$(sProfesor).empty();
								$(sContactos).empty();
								$(sEstados).empty();
								$(sDocumentos).empty();
								
								//Agrega los nodos que se buscaron
								appendEmpresas(mensaje['mensaje'],sEmpresas);			
								appendProyectos(mensaje['proyectos'],sProyectos);
								appendCategoria(mensaje['categoria'],sCategoria,mensaje['supracategoria']);
								appendProfesor(mensaje['usuario'],sProfesor);
								appendContacto(mensaje['contacto'],sContactos);
																appendEstado(mensaje['estado'],sEstados);
																								appendDocument(mensaje['documento'],sDocumentos);


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
			     url: "avancesproyecto/getProyectos",
			     data: data ,
			     success: function(msg){
					 	console.log(msg);
						var mensaje = $.parseJSON(msg);
						console.log(mensaje);
						if(mensaje['response'] ==  "true"){
								//Agrega las Empresas al nodo seleccionado
								var sProyectos = $('#sproyecto');
								var sCategoria = $('[name = "categoria"]');
								var sContactos = $('[name = "contacto"]');							
								var sProfesor = $('[name="profesor"]');								
								var sEstados = $('#sestados');
								var sDocumentos = $('[name = "documento"]');
								
								//Elimina nodo
								$(sProyectos).empty();
								$(sCategoria).empty();
								$(sProfesor).empty();
								$(sContactos).empty();
								$(sEstados).empty();
								$(sDocumentos).empty();
								
								//Agrega los nodos que se buscaron
								appendProyectos(mensaje['mensaje'],sProyectos);
								appendCategoria(mensaje['categoria'],sCategoria,mensaje['supracategoria']);
								appendProfesor(mensaje['usuario'],sProfesor);
								appendContacto(mensaje['contacto'],sContactos);
								appendEstado(mensaje['estado'],sEstados);
								appendDocument(mensaje['documento'],sDocumentos);
								
						
						}else{
							noty({text: mensaje['mensaje'], type: 'error'});
						}

			     },
				error: function(msg){
						noty({text: "Ha habido un error en el sistema, intentelo nuevamente.", type: 'error'});
				}
			});
	}
	function getInfo(idProyecto,elemento){
			/*Datos de la tabla con Respecto al usuario*/
			var data={ 
			's_token':$('#s_token').attr('value'),
			'idProyecto':idProyecto,
			'activo':$('[name="estado"]').val(),			
			};
			/*Hace la llamada y maneja la respuesta con un popup en caso de que haya habido un error*/
			$.ajax({
			     type: "POST",
			     url: "avancesproyecto/getInfo",
			     data: data ,
			     success: function(msg){
						var mensaje = $.parseJSON(msg);
						console.log(mensaje);
						if(mensaje['response'] ==  "true"){
								//Agrega las Empresas al nodo seleccionado
								var sCategoria = $('[name = "categoria"]');
								var sContactos = $('[name = "contacto"]');
								var sProfesor = $('[name="profesor"]');
								var sDocumentos = $('[name = "documento"]');
								
								//Elimina nodo
								$(sCategoria).empty();
								$(sProfesor).empty();
								$(sContactos).empty();
																$(sDocumentos).empty();

								//Agrega los nodos que se								 buscaron
								appendCategoria(mensaje['categoria'],sCategoria,mensaje['supracategoria']);
								appendProfesor(mensaje['usuario'],sProfesor);
								appendContacto(mensaje['contacto'],sContactos);
								appendDocument(mensaje['documento'],sDocumentos);
								
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
	function appendCategoria(nodos,elemento,nodotes){
		if(nodos.length == 0){
			$(elemento).append('No tiene categoria asignada');
		}else{
			var supracategoria = $('<ul>');
			$(nodotes).each(function(index,nodo){
				supracategoria.append($("<li>").append(nodo['Nombre']));
				var categoria = $('<ul>');
					$(nodos).each(function(index,nodote){
							if(nodo['idSupraCategoria'] == nodote ['idSupraCategoria'])
							$(categoria).append($('<li>').append(nodote['Categoria']));
					});
				$(supracategoria).append($(categoria));
			});
			$(elemento).append($(supracategoria))
		}
	}	
	function appendProfesor(nodos,elemento){
		if(nodos.length == 0){
			$(elemento).append($("<li>").append("No tiene usuarios asignados").attr('id','0'));
		}else{
			$(nodos).each(function(index,nodo){
				$(elemento).append($("<li>")
									.append($("<a>")
									.append(nodo['nombre'])
											.attr({'name':nodo['idUsuario'],'href':'1','class':'clsVentanaIFrame','rel':'prueba'})));
			});
		}
	}	
	function appendDocument(nodos,elemento){
		if(nodos.length == 0){
			$(elemento).append($("<li>").append("No tiene documentos guardados").attr('id','0'));
		}else{
			$(nodos).each(function(index,nodo){
				if(nodo['esLegal'] == 1){
				$(elemento).append($("<li>")
									.append($("<a>")
									.append("Legal")
											.attr({'href':'/OEV/avancesproyectoU/do_download/1/'+nodo['idProyecto'],'rel':'prueba'})));
				}
				else
				{
					$(elemento).append($("<li>")
									.append($("<a>")
									.append("Propuesta")
											.attr({'href':'/OEV/avancesproyectoU/do_download/0/'+nodo['idProyecto'],'rel':'prueba'})));
				}
			});
		}
	}	
			
	function appendContacto(nodos,elemento){
		if(nodos.length == 0){
			$(elemento).append($("<li>").append("No hay contactos registrados").attr('id','0'));
		}else{
			$(nodos).each(function(index,nodo){
				$(elemento).append($("<li>")
									.append($("<a>")
									.append(nodo['nombre'])
											.attr({'name':nodo['idContacto'],'href':'0','class':'clsVentanaIFrame','rel':'Información del profesor'})));
			});
		}
	}	
	function appendEstado(nodos,elemento){
		if(nodos.length == 0){
			$(elemento).append($("<td>").append("No hay status registrados").attr('id','0'));
			$(elemento).append($("<td>").append("").attr('id','1'));
			$(elemento).append($("<td>").append("").attr('id','2'));
		}else{
			$(nodos).each(function(index,nodo){
				var tr = $("<tr>");
				tr.append($("<td>").append(nodo['estado']));
				tr.append($("<td>").append(nodo['nombre']));
				tr.append($("<td>").append(nodo['fecha']));
				$(elemento).append(tr);
			});
		}
	}	
	});

</script>
