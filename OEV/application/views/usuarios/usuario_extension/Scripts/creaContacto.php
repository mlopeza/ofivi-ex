<script type="text/javascript" >
	/*Logica de Creación de Proyecto*/
	$(document).ready(function(){
        //Para evitar que salga de la pagina sin guardar


		//Llena el primer campo
		$("#Grupo").change(function() {
			getEmpresas($(this).children('option').filter(':selected').attr('id'),$(this));

		});

		//Trae los contactos de una empresa
		$("#Empresa").live("change",function(){
            $("#contactos-body").empty();
            buscaContactos($(this).children('option').filter(':selected').attr('id'));
		});

		//Agrega un Nuevo campo para los telefonos
		$("#contacto-nuevo-telefono").click(function(){
        window.onbeforeunload=confirmarSalida;
			var o = $('<tr><td><input class="descripcion" type="text" style="max-width:100px;"></input></td><td><input class="lada" style="max-width:25px;" type="text"></input></td><td><input class="telefono" style="max-width:50px;" type="text"></input></td><td><input class="extension" type="text" style="max-width:30px;"></input></td><td><input class="descripcionExtra" type="text" style="max-width:50px;"></input></td><td><button class="btn btn-danger remove-telefono" type="button"><i class="icon-remove icon-white"></i></button></td></tr>');
			$("#contacto-telefonos-body").append(o);
		});

		//Remueve un telefono de la lista
		$(".remove-telefono").live("click",function(){
            nodo = this;
    		noty({
    			animateOpen: {opacity: 'show'},
    			animateClose: {opacity: 'hide'},
    			layout: 'center',
    			text: "Deseas eliminar el Telefono?", 
    			buttons: [
    		    {type: 'btn btn-mini btn-primary', text: 'Sí', click: function($noty) {eliminarTelefonoDB($(nodo));$noty.close();} },
    		    {type: 'btn btn-mini btn-danger', text: 'No', click: function($noty) {$noty.close();} }
    		    ],
    		  closable: false,
    		  timeout: false
    		});
    		return false;
		});

		//Remueve un telefono de la lista
    	$('.remove-telefono-tabla').live("click",function() {
            nodo = this;
    		noty({
    			animateOpen: {opacity: 'show'},
    			animateClose: {opacity: 'hide'},
    			layout: 'center',
    			text: "Deseas eliminar el Contacto?", 
    			buttons: [
    		    {type: 'btn btn-mini btn-primary', text: 'Sí', click: function($noty) {eliminarContactoDB($(nodo));$noty.close();} },
    		    {type: 'btn btn-mini btn-danger', text: 'No', click: function($noty) {$noty.close();}}
    		    ],
    		  closable: false,
    		  timeout: false
    		});
    		return false;
    	});



		//Regresa los datos para edicion
		$(".edit-telefono-tabla").live("click",function(){
            window.onbeforeunload=confirmarSalida;
			regresaEdicion($(this).parent().parent());
			$(this).parent().parent().remove();
		});

		//Agrega un Contacto a la Tabla
		$("#agrega-contacto-arreglo").click(function(){
            window.onbeforeunload=confirmarSalida;
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
						telefonos[index]["idTelefono"] = $(nodo).find('.telefono').attr("idTelefono");
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
					telefonos:JSON.stringify(telefonos),
                    class:"newContact",
                    idContacto:$("#contacto-nombre").attr("idContacto")
			});

			a.append("<td>"+$("#contacto-nombre").val()+" "+$("#contacto-ap").val()+" "+$("#contacto-am").val()+"</td>")
			a.append("<td>"+atelefonos+"</td>");
			a.append("<td style=\"text-align:center;\"><button class=\"btn btn-info edit-telefono-tabla\" type=\"button\"><i class=\"icon-edit icon-white\"></i></button>&nbsp;&nbsp;&nbsp;&nbsp;<button class=\"btn btn-danger remove-telefono-tabla\" type=\"button\"><i class=\"icon-remove icon-white\"></i></button></td>");
			$("#contactos-body").append(a);

			//Limpia datos de la forma
			$("#contacto-nombre").val("");
			$("#contacto-nombre").removeAttr("idContacto");
			$("#contacto-ap").val("");
			$("#contacto-am").val("");
			$("#contacto-enviar").attr('checked', false);
			$("#contacto-email").val("");
			$("#contacto-departamento").val("");
			$("#contacto-puesto").val("");
			$("#contacto-telefonos-body").empty();
		});
			
		//Envia todo al servidor para guardarse
		$("#GuardarTodo").click(function(){

			if($(this).hasClass('disabled-button') || $("#Empresa").children('option').filter(':selected').attr('id') == undefined){
					return;
			}
			//No permite que se toque el boton
			$(this).addClass('disabled-button');

			idEmpresa=$("#Empresa").children('option').filter(':selected').attr('id');
			idUsuario=$("#idUsuario-sistema").attr('idUsuario');
			idGrupo=$("#Grupo").children('option').filter(':selected').attr('id');
			var old_contactos = {};			
            var new_contactos = {};
			$.each($("#contactos-body").children().filter(".newContact").filter("[idContacto]"),function(index,a){
				old_contactos[index]={};
				old_contactos[index]['Nombre']=$(a).attr('nombre');
				old_contactos[index]['idContacto']=$(a).attr('idContacto');
				old_contactos[index]['ApellidoP']=$(a).attr('apellidop');
				old_contactos[index]['ApellidoM']=$(a).attr('apellidom');
				old_contactos[index]['email']=$(a).attr('email');
				old_contactos[index]['departamento']=$(a).attr('departamento');
				old_contactos[index]['puesto']=$(a).attr('puesto');
				old_contactos[index]['Recibe_Correos']=$(a).attr('recibe');
				old_contactos[index]['telefonos']=$.parseJSON($(a).attr('telefonos'));
			});

			$.each($("#contactos-body").children().filter(".newContact").filter(":not([idContacto])"),function(index,a){
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

			var data={ 
			'idEmpresa':idEmpresa,
			'idGrupo':idGrupo,
			'newContactos':new_contactos,
			'oldContactos':old_contactos
			};
			/*Hace la llamada y maneja la respuesta con un popup en caso de que haya habido un error*/
			$.ajax({
			     type: "POST",
			     url: "creaContacto/guardaContactos",
			     data: data ,
			     success: function(msg){
								mensaje=$.parseJSON(msg);
							if(mensaje['response'] == "true"){
								noty({text: "Los datos se han guardado correctamente.", type: 'success'});
                                window.onbeforeunload=null;
							}else{
								noty({text:"No se ha podido guardar en la base de datos.", type: 'error'});
							}
                           setTimeout(function() { location.reload(); }, 3000);      
			     },
				error: function(msg){
						noty({text: "Ha habido un error en el sistema, intentelo nuevamente.", type: 'error'});
				}
			});
			//Carga nuevamente la pagina
		});
	});



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
						//Rellena los contactos con empresa
						buscaContactos($("#Empresa").children('option').filter(':selected').attr('id'));

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
			$("#contacto-nombre").attr('idContacto',$(nodo).attr('idContacto'));
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
						$(o).find('.telefono').attr("idTelefono",value['idTelefono']);
						$(o).find('.extension').val(value["extension"]);
						$(o).find('.lada').val(value["lada"]);
						$(o).find('.descripcionExtra').val(value["descripcionExtra"]);
				$("#contacto-telefonos-body").append(o);
			});
			
	}

	function buscaContactos(idEmpresa){
			/*Datos de la tabla con Respecto al usuario*/
			var data={ 
			's_token':$('#s_token').attr('value'),
			'idEmpresa':idEmpresa,
			};
			/*Hace la llamada y maneja la respuesta con un popup en caso de que haya habido un error*/
			$.ajax({
			     type: "POST",
			     url: "creaContacto/getContactos",
			     data: data,
			     success: function(msg){
						var mensaje = $.parseJSON(msg);
						if(mensaje['response'] ==  true){
							appendContactos(mensaje['mensaje']);
						}else{
							noty({text: "Error al traer los contactos", type: 'error'});
						}
			     },
				error: function(msg){
						noty({text: "Ha habido un error en el sistema, intentelo nuevamente.", type: 'error'});
				}
			});
	}

	function appendContactos(contactos){
		nodo = $("#contactos-body");
		$.each(contactos,function(index,value){
			agregaElementoDB(value);
		});

	}
    
    //Hace una llamada para eliminar el contacto
    function eliminarContactoDB(nodo){
        padre=nodo.parent().parent();
        idContacto=$(padre).attr('idContacto');
        if(idContacto == undefined){
            $(padre).remove();
        }else{
			var data={ 
			's_token':$('#s_token').attr('value'),
			'idContacto':idContacto,
			};
			/*Hace la llamada y maneja la respuesta con un popup en caso de que haya habido un error*/
			$.ajax({
			     type: "POST",
			     url: "creaContacto/deleteContacto",
			     data: data,
			     success: function(msg){
                        noty({force: true, layout: 'center', text: 'El usuario se ha eliminado.', type: 'success'});
                        $(padre).remove();
                        
			     },
				error: function(msg){
						noty({text: "Ha habido un error en el sistema, intentelo nuevamente.", type: 'error'});
				}
			});
        }
    }

    //Hace una llamada para eliminar el contacto
    function eliminarTelefonoDB(nodo){
        padre=nodo.parent().parent();
        idTelefono=$(padre).find(".telefono").attr("idTelefono");
        if(idTelefono == undefined){
            $(padre).remove();
        }else{
			var data={ 
			's_token':$('#s_token').attr('value'),
			'idTelefono':idTelefono,
			};
			/*Hace la llamada y maneja la respuesta con un popup en caso de que haya habido un error*/
			$.ajax({
			     type: "POST",
			     url: "creaContacto/deleteTelefono",
			     data: data,
			     success: function(msg){
                        noty({force: true, layout: 'center', text: 'El Telefono se ha eliminado.', type: 'success'});
                        $(padre).remove();
			     },
				error: function(msg){
						noty({text: "Ha habido un error en el sistema, intentelo nuevamente.", type: 'error'});
				}
			});
        }
    }


	//Agrega contactos traidos de la base de Datos a la tabla
	function agregaElementoDB(contacto){
			//Los telefonos del contacto
			//Agrega todos los telefonos a un objeto
			var telefonos = contacto[1];
			var atelefonos="";
			$(telefonos).each(function(index,nodo){	
						if(nodo["extension"] == ""){
							atelefonos = atelefonos+nodo['telefono']+"<br>"
						}else{
							atelefonos=atelefonos+nodo['telefono']+" ext."+nodo["extension"]+"<br>";

						}
			});
            
			a=$('<tr></tr>').attr({
				    nombre: contacto[0]['Nombre'],
				    apellidop: contacto[0]['ApellidoP'],
					apellidom: contacto[0]['ApellidoM'],
					recibe:contacto[0]['Recibe_Correos']==0?"false":"true",
					email:contacto[0]['email'],
                    puesto:contacto[0]['puesto'],
                    departamento:contacto[0]['departamento'],
                    idContacto:contacto[0]['idContacto'],
					telefonos:JSON.stringify(telefonos),
                    class:"oldContact"
			});

			a.append("<td>"+contacto[0]['Nombre']+" "+contacto[0]['ApellidoP']+" "+contacto[0]['ApellidoM']+"</td>")
			a.append("<td>"+atelefonos+"</td>");
			a.append("<td style=\"text-align:center;\"><button class=\"btn btn-info edit-telefono-tabla\" type=\"button\"><i class=\"icon-edit icon-white\"></i></button>&nbsp;&nbsp;&nbsp;&nbsp;<button class=\"btn btn-danger remove-telefono-tabla\" type=\"button\"><i class=\"icon-remove icon-white\"></i></button></td>");
			$("#contactos-body").append(a);

	}

    function confirmarSalida(){
        return "Aún quedan cambios pendientes, deseas salir?";
    }
</script>
