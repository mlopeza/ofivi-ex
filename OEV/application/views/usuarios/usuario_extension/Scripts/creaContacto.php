<script type="text/javascript" >
	/*Logica de Creación de Proyecto*/
	$(document).ready(function(){
            // Accordion
		$("#accordion").accordion({
              header: "h3"
		});
		//Llena el primer campo
		//Selecciona lo que el mensaje get trae
		seleccionaOpciones();

		$("#Grupo").change(function() {
			getEmpresas($(this).children('option').filter(':selected').attr('id'),$(this));			
		});

		$("#Empresa").change(function(){
			$(".Empresa-Breadcrumb").html("").html($(this).children('option').filter(':selected').val());
		});

		$("#nombre_proyecto").keyup(function(){
			$(".Proyecto-Breadcrumb").html("").html($(this).val());
		});

		//Agrega un Nuevo campo para los telefonos
		$("#contacto-nuevo-telefono").click(function(){
			var o = $('<tr><td><select class="descripcion" style="max-width:100px;"><option>Casa</option><option>Celular</option><option>Oficina</option></select></td><td><input class="lada" style="max-width:25px;" type="text"></input></td><td><input class="telefono" style="max-width:50px;" type="text"></input></td><td><input class="extension" type="text" style="max-width:30px;"></input></td><td><input class="descripcionExtra" type="text" style="max-width:50px;"></input></td><td><button class="btn btn-danger remove-telefono" type="button"><i class="icon-remove icon-white"></i></button></td></tr>');
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
			$.blockUI({ 
				theme:     true, 
				title:    'OFIVEX', 
				message:  '<p>Procesando.</p>'
			});
			//Verifica que no se inserten cosas vacias
			if( $("#contacto-nombre").val().trim() == "" || 
				$("#contacto-ap").val().trim() == "" || 
				$("#contacto-email").val().trim() == ""
			){
				$.unblockUI();
				noty({text: 'Faltan campos del Contacto por llenar.', type: 'error'});
				return;
			}

			empresa=$("#Empresa").children('option').filter(':selected').attr('id');
			if(empresa == "" || empresa == undefined){
				$.unblockUI();
				setTimeout(noty({text: "No se ha seleccionado ninguna empresa.", type: 'error'}),500);
				return;
			}

			//Los telefonos del contacto
			var body = $("#contacto-telefonos-body");
			
			//Agrega todos los telefonos a un objeto
			var telefonos = {};
			$(body.children()).each(function(index,nodo){
					if($(nodo).find('.telefono').val().trim() != ""){
						telefonos[index] = {};
						telefonos[index]["descripcion"] = $(nodo).find('.descripcion').val();
						telefonos[index]["telefono"] = $(nodo).find('.telefono').val();
						telefonos[index]["extension"] = $(nodo).find('.extension').val();
						telefonos[index]["lada"] = $(nodo).find('.lada').val();
						telefonos[index]["descripcionExtra"] = $(nodo).find('.descripcionExtra').val();
					}
			});

			data={
				    'nombre': $("#contacto-nombre").val(),
				    'apellidop': $("#contacto-ap").val(),
					'apellidom': $("#contacto-am").val(),
					'Recibe_Correos':$("#contacto-enviar").is(':checked')?1:0,
					'email':$("#contacto-email").val(),
                    'puesto':$("#contacto-puesto").val(),
                    'departamento':$("#contacto-departamento").val(),
					'telefonos':telefonos,
					'idEmpresa':empresa
			}
			//Se envian los datos al servidor para guardarlo
			$.ajax({
			     type: "POST",
			     url: "/OEV/altaProyecto/guardaContacto",
			     data: data ,
			     success: function(msg){
								mensaje=$.parseJSON(msg);
								$.unblockUI();
								noty({text:"El contacto se ha guardado con exito.", type: 'success'});	
			     },
				error: function(msg){
						$.unblockUI();
						noty({text: "Ha habido un error en el sistema, intentelo nuevamente.", type: 'error'});
				}
			});


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
		$(".GuardarTodo").click(function(){
			$.blockUI({ 
				theme:     true, 
				title:    'OFIVEX', 
				message:  '<p>Procesando.</p>'
			});
			if($(this).hasClass('disabled-button')){
					$.unblockUI();
					return;
			}
			nombre_proyecto=$("#nombre_proyecto").val().trim();
			idEmpresa=$("#Empresa").children('option').filter(':selected').attr('id');
			idUsuario=$("#idUsuario-sistema").attr('idUsuario');
			idGrupo=$("#Grupo").children('option').filter(':selected').attr('id');
			var oldContactos = $("#demo-input-local").tokenInput("get");
			var descripcion_cliente=$($('iframe')[0]).contents().find('.wysihtml5-editor').html();
			var descripcion_usuario=$($('iframe')[1]).contents().find('.wysihtml5-editor').html();
			var categorias = new Array();
			//Agrega todas las categorias en un arreglo
			$.each($(".categoriaCheckbox").filter(":checked"),function(index,value){
				categorias[categorias.length]={'idCategoria':$(value).attr('id')};
			});

			var data={ 
			'nombre_proyecto':nombre_proyecto,
			'idEmpresa':idEmpresa,
            'iniciadoPor':idUsuario,
			'idGrupo':idGrupo,
			'oldContactos':oldContactos,
			'descripcionCliente':descripcion_cliente,
			'descripcionUsuario':descripcion_usuario,
			'categorias':categorias
			};
					if(idEmpresa == "" || idEmpresa == undefined || idEmpresa <= 0){
				$.unblockUI();
                noty({text: "No se ha seleccionado una empresa.", type: 'error'});
                return;
            }

            if(nombre_proyecto == ""){
				$.unblockUI();
                noty({text: "El proyecto no tiene Nombre.", type: 'error'});
                return;
            }

			if($("#idProyecto").val() != "" && $("#idProyecto").val() != undefined)
				data.idProyecto = $("#idProyecto").val();

			/*Hace la llamada y maneja la respuesta con un popup en caso de que haya habido un error*/
			//No permite que se toque el boton
			$(this).addClass('disabled-button');
			$.ajax({
			     type: "POST",
			     url: "/OEV/altaProyecto/guardaProyecto",
			     data: data ,
			     success: function(msg){
                console.log(msg);
								mensaje=$.parseJSON(msg);
							if(mensaje['response'] == "true"){
								noty({text: "El proyecto se ha guardado correctamente.", type: 'success'});	
								$("#idProyecto").val(mensaje['idProyecto']);
								$("#GuardarTodo").removeClass('disabled-button');
							}else{
								noty({text: mensaje['mensaje'], type: 'error'});
								$("#GuardarTodo").removeClass('disabled-button');
							}
					$.unblockUI();
			     },
				error: function(msg){
						noty({text: "Ha habido un error en el sistema, intentelo nuevamente.", type: 'error'});
						$("#GuardarTodo").removeClass('disabled-button');
				}
			});
			//Carga nuevamente la pagina
		});

	});


	function getContactos(){
			var empresa = $("#Empresa").children('option').filter(':selected').attr('id');
			return "/OEV/altaProyecto/getContactos?idEmpresa="+(empresa == null?0:empresa);
	}

	//Regresa las empresas que pertenecen a un Grupo y las
	//Inserta en el OptionS List
	function getEmpresas(idGrupo,elemento,accion){
			/*Datos de la tabla con Respecto al usuario*/
			var data={ 
			's_token':$('#s_token').attr('value'),
			'idGrupo':idGrupo,
			};
			$(".Grupo-Breadcrumb").html("").html($("#Grupo").children('option').filter(':selected').val());
			/*Hace la llamada y maneja la respuesta con un popup en caso de que haya habido un error*/
			$.ajax({
			     type: "POST",
			     url: "/OEV/altaProyecto/getEmpresas",
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
								//Si es el inicio, se selecciona la Empresa que se definio anteriormente
								if(accion == 1){
									sEmpresas.children().filter("[id=<?php echo $idEmpresa;?>]").attr('selected','selected');
								}
								$(sEmpresas).children('option').filter(':selected').val()
								$(".Empresa-Breadcrumb").html("").html($(sEmpresas).children('option').filter(':selected').val());
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
				var o = $('<tr><td><select class="descripcion" style="max-width:100px;"><option>Casa</option><option>Celular</option><option>Oficina</option></select></td><td><input class="lada" style="max-width:25px;" type="text"></input></td><td><input class="telefono" style="max-width:50px;" type="text"></input></td><td><input class="extension" type="text" style="max-width:30px;"></input></td><td><input class="descripcionExtra" type="text" style="max-width:50px;"></input></td><td><button class="btn btn-danger remove-telefono" type="button"><i class="icon-remove icon-white"></i></button></td></tr>');
						$(o).find('.descripcion').children().filter(function() {
							    return $(this).text() == value["descripcion"]; 
							}).attr('selected', true);
						$(o).find('.telefono').val(value["telefono"]);
						$(o).find('.extension').val(value["extension"]);
						$(o).find('.lada').val(value["lada"]);
						$(o).find('.descripcionExtra').val(value["descripcionExtra"]);
				$("#contacto-telefonos-body").append(o);
			});
			
	}

	//Manda pedir la informacion necesaria
	function seleccionaOpciones(){
		$("#Grupo").children().filter("[id=<?php echo $idGrupo;?>]").attr('selected','selected');
		getEmpresas(<?php echo $idGrupo;?>,$("#Grupo"),1);
	}
</script>
