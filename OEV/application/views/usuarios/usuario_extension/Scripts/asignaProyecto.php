<script type="text/javascript" >
	/*Logica de Creación de Proyecto*/
    proyecto_global=-1;
    var uTable;
	$(document).ready(function(){
            uTable = $('#tabla-usuarios').dataTable();
            getUsuarios();


            $(".cancelar-asignacion").live("click",function(){
            data = {'data':{'idUsuario':$(this).attr('id'),'idProyecto':proyecto_global}};
	    		$.ajax({
	    		     type: "POST",
	    		     url: "asignaProyecto/eliminaAsignacion",
	    		     data: data ,
	    		     success: function(msg){
	    							mensaje=$.parseJSON(msg);
                                    console.log(msg);
	    						if(mensaje['response'] == "false"){
	    							noty({text:"Error al Intentar Cancelar la peticion.", type: 'error'});
	    						}else{
	    							noty({text:"Peticion Cancelada.", type: 'success'});
                                    getAsignadosProyecto(mensaje['mensaje']);
                                }
	    		     },
	    			error: function(msg){
	    					noty({text: "Ha habido un error en el sistema, intentelo nuevamente.", type: 'error'});
	    			}
    			});
            });
            // Accordion
            $("#accordion").accordion({
              header: "h3"
            });

            //Se selecciona un Proyecto
            $(".colorea-proyecto").live("click",function(){
                $.each($(".colorea-proyecto"),function(index,elemento){
                    $(elemento).attr("style","");
                });

                $(this).attr("style","background-color:whiteSmoke;");
                proyecto_global=$(this).attr('idproyecto');    
                getAsignadosProyecto();
            });
            //Obtiene los Ids de las areas a las cuales esta asignado el profesor
            $(".areaCheckbox").change(function(){
                $("#contenedor-interno-profesores").empty();
                var lista = {};
                $.each($(".areaCheckbox").filter(":checked"),function(index,valor){
                    lista[index]=$(valor).attr('id');
                });
                consultaProfesores(lista);
            });

        $(".asignar-profesor").live("click",function(){
                if(proyecto_global == -1) return;
                $.blockUI({ 
          				theme:     true, 
          				title:    'OFIVEX', 
          				message:  '<p>Procesando.</p>'
            			});
                //Obtiene los datos del Profesor y le manda una Peticion
                data={'data':{'idUsuario':$(this).attr('id'),'idProyecto':proyecto_global},'idUsuarioExtension':$("#idUsuario-sistema").attr('idUsuario')};
			$.ajax({
			     type: "POST",
			     url: "asignaProyecto/asignaProfesor",
			     data: data ,
			     success: function(msg){
                console.log(msg);
								mensaje=$.parseJSON(msg);
							if(mensaje['response'] == "false"){
								noty({text: mensaje['mensaje'], type: 'error'});
							}else{
                                noty({text: "Peticion Enviada al Usuario", type: 'success'});
                                getAsignadosProyecto();
                            }
								$.unblockUI();
			     },
				error: function(msg){
						noty({text: "Ha habido un error en el sistema, intentelo nuevamente.", type: 'error'});
								$.unblockUI();
				}
			});
        });
    });


    function consultaProfesores(lista){
            //Si el objeto esta vacio, no manda nada
            if($.isEmptyObject(lista))
                return;

            //Guarda el objeto lista
            data = {'lista':lista};
			$.ajax({
			     type: "POST",
			     url: "asignaProyecto/buscaProfesores",
			     data: data ,
			     success: function(msg){
								mensaje=$.parseJSON(msg);
                                console.log(msg);
							if(mensaje['response'] == "false"){
								noty({text: mensaje['mensaje'], type: 'error'});
							}else{
                                agregaUsuarioTabla(mensaje['mensaje']);
                            }
			     },
				error: function(msg){
						noty({text: "Ha habido un error en el sistema, intentelo nuevamente.", type: 'error'});
				}
			});
    }

    //Agrega Los usuarios que se encontraron en la tabla
    function agregaUsuarioTabla(lista){
        nodo=$("#contenedor-interno-profesores");
        $.each(lista,function(index,elemento){
            if(elemento['Tipo_Usuario'] == 'a'){
                elemento['Tipo_Usuario']="Administrador";
            }else if(elemento['Tipo_Usuario'] == 'u'){
                elemento['Tipo_Usuario']="Usuario de Extensión";
            }else if(elemento['Tipo_Usuario'] == 'p'){
                elemento['Tipo_Usuario']="Profesor";
            }else if(elemento['Tipo_Usuario'] == 'l'){
                elemento['Tipo_Usuario']="Legal";
            }else if(elemento['Tipo_Usuario'] == 'v'){
                elemento['Tipo_Usuario']="Administrador de Extensión";
            }
            $(nodo).append("<tr><td>"+elemento['Campus']+"</td><td>"+elemento['Escuela']+"</td><td>"+elemento['Departamento']+"</td><td>"+elemento['Nombre']+" "+elemento['ApellidoP']+" "+elemento['ApellidoM']+"</td><td>"+elemento['Tipo_Usuario']+"</td><td>"+elemento['email']+"</td><td><button type='button' id='"+elemento['idUsuario']+"' class='asignar-profesor btn btn-primary'>Asignar</button></td></tr>");
        });
        getAsignadosProyecto();
    }

    function agregaUsuarioTabla2(lista){

        nodo=$("#contenedor-interno-profesores2");
        $(nodo).empty();
        $.each(lista,function(index,elemento){
            if(elemento['Tipo_Usuario'] == 'a'){
                elemento['Tipo_Usuario']="Administrador";
            }else if(elemento['Tipo_Usuario'] == 'u'){
                elemento['Tipo_Usuario']="Usuario de Extensión";
            }else if(elemento['Tipo_Usuario'] == 'p'){
                elemento['Tipo_Usuario']="Profesor";
            }else if(elemento['Tipo_Usuario'] == 'l'){
                elemento['Tipo_Usuario']="Legal";
            }else if(elemento['Tipo_Usuario'] == 'v'){
                elemento['Tipo_Usuario']="Administrador de Extensión";
            }

            if(elemento['acepto'] == 0){
                elemento['acepto']="Sin Responder";
            }else if(elemento['acepto'] == 1){
                elemento['acepto']="Aceptado";
            }else if(elemento['acepto'] == 2){
                elemento['acepto']="Rechazado";
            }else if(elemento['acepto'] == 3){
                elemento['acepto']="Cancelada";
            }
            $(nodo).append("<tr><td>"+elemento['Campus']+"</td><td>"+elemento['Escuela']+
                            "</td><td>"+elemento['Departamento']+"</td><td>"+elemento['Nombre']+
                            " "+elemento['ApellidoP']+" "+elemento['ApellidoM']+"</td><td>"+
                            elemento['Tipo_Usuario']+"</td><td>"+elemento['email']+"</td><td>"+
                            elemento['tiempo_solicitud']+"</td><td>"+(elemento['tiempo_respuesta']==null?"":elemento['tiempo_respuesta'])+
                            "</td><td>"+elemento['acepto']+"</td>"+
                            "</td><td>"+elemento['Razon']+"</td>"+
                            "</td><td>"+elemento['sugerencia']+"</td>"+
                            "<td><button type='button' id='"+elemento['idUsuario']+"' class='cancelar-asignacion btn btn-primary'>Cancelar</button></td></tr>");
        });
    }

    function getAsignadosProyecto(){
            //Busca los Usuarios Asignados al Proyecto
            console.log("Get Asignados al Proyecto");
            data={'idProyecto':proyecto_global};
			$.ajax({
			     type: "POST",
			     url: "asignaProyecto/profesoresAsignados",
			     data: data ,
			     success: function(msg){
								mensaje=$.parseJSON(msg);
							if(mensaje['response'] == "false"){
								noty({text: mensaje['mensaje'], type: 'error'});
							}else{
                                agregaUsuarioTabla2(mensaje['mensaje']);
                            }
			     },
				error: function(msg){
						noty({text: "Ha habido un error en el sistema, intentelo nuevamente.", type: 'error'});
				}
			});
    }

  function getUsuarios(){
    cleanTable(uTable);
    ajaxCall("asignaProyecto/getAllUsuarios",undefined,function(data){
          console.log(data);
          data = $.parseJSON(data);
          $.each(data,function(index,value){
                id = value.idUsuario;
                value.Datos = '<a name="'+value.idUsuario+'" href="1" class="clsVentanaIFrame" rel="prueba">Información</a>';
                delete value.Departamento;
                delete value.Escuela;
                delete value.idUsuario;
                delete value.idDepartamento;
                delete value.Usuario;
                delete value.Email;
                console.log(value);
                insertElement(uTable,id,value,"Usuario");                
          });
    });      
  }


    /*Inserta un elemento a la tabla*/
    function insertElement(table,id,value,type){
       //Crea un arreglo del objeto
       arreglo=objectToArray(value);
       //Trae los botones de edicion
       arreglo[arreglo.length]=getBotonEdicion(type,id);
       //Asigna el elemento a la tabla
       $(table).dataTable().fnAddData(arreglo);
    }

    //Regresa un boton de la clase y con el id
    function getBotonEdicion(type,id){
        return "<button type='button' id='"+id+"' class='asignar-profesor btn btn-primary'>Asignar</button>";
    }

    //Convierte un 
    function objectToArray(o){
        i = 0;
        arreglo = new Array();
        $.each(o,function(index,value){
            arreglo[i]=value;
            i++;
        })
        return arreglo;
    }

    /*Elimina los nodos de la tabla*/
    function cleanTable(table){
            table.fnClearTable();
    }

    /*Hace una llamada de AJAX Generica al servidor*/
    function ajaxCall(url,data,continueFunc){
			$.ajax({
			     type: "POST",
			     url: url,
			     data: data ,
			     success: continueFunc,
				error: function(msg){
						noty({text: "Ha habido un error en el sistema, intentelo nuevamente.", type: 'error'});
				}
			});
    }
</script>
<script type="text/javascript">
$(document).ready(function(){
	//evento que se produce al hacer clic en el boton cerrar de la ventana
	$('.clsVentanaCerrar').live('click',function(eEvento){
		//prevenimos el comportamiento normal del enlace
		eEvento.preventDefault();
		//buscamos la ventana padre (del boton "cerrar")
		var $objVentana=$($(this).parents().get(1));
		
		//cerramos la ventana suavemente
		$objVentana.fadeOut(300,function(){
			//eliminamos la ventana del DOM
			$(this).remove();
			//ocultamos el overlay suavemente
			$('#divOverlay').fadeOut(500,function(){
				//eliminamos el overlay del DOM
				$(this).remove();
			});
		});
	});
	
	$('.clsVentanaIFrame').live("click", function(e) {
        
		//prevenir el comportamiento normal del enlace
		e.preventDefault();
		var prueba = $(this).prop('href').split('/');
		console.log(prueba[prueba.length-1]);
		if(prueba[prueba.length-1]==1){
			getInfoProfesor($(this),$(this).prop('name'));
		}else{			
			getInfoContacto($(this),$(this).prop('name'));

		}
		
	});
		function getInfoProfesor(elemento,idUsuario){
			/*Datos de la tabla con Respecto al usuario*/
			var data={ 
			's_token':$('#s_token').attr('value'),
			'idUsuario':idUsuario,						
			};
			/*Hace la llamada y maneja la respuesta con un popup en caso de que haya habido un error*/
			$.ajax({
			     type: "POST",
			     url: "<?php echo base_url("informacion/getInfoProfesor");?>",
			     data: data ,
			     success: function(msg){
						var mensaje = $.parseJSON(msg);
						console.log(mensaje);
						if(mensaje['response'] ==  "true"){
								//obtenemos la pagina que queremos cargar en la ventana y el titulo
										
										//creamos la nueva ventana para mostrar el contenido y la capa para el titulo
										var $objVentana=$('<div class="clsVentana">'), $objVentanaTitulo=$('<div class="clsVentanaTitulo">');
										
										//agregamos el titulo establecido y el boton cerrar
										$objVentanaTitulo.append('<strong>Información del profesor</strong>');
										$objVentanaTitulo.append('<a href="" class="clsVentanaCerrar">Cerrar</a>');
										
										//agregamos la capa de titulo a la ventana
										$objVentana.append($objVentanaTitulo);
										
										//creamos la capa que va a mostrar el contenido
										var $objVentanaContenido=$('<div class="clsVentanaContenido">');
										
								//		$objVentanaContenido.append('<iframe src="'++'">')
										//agregamos la capa de contenido a la ventana
										$objVentana.append(mensaje['mensaje']);
										
										//creamos el overlay con sus propiedades css y lo agregamos al body
										var $objOverlay=$('<div id="divOverlay">').css({
											opacity: .5,
											display: 'none'
										});
										$('body').append($objOverlay);
										
										//animamos el overlay y cuando su animacion termina seguimos con la ventana
										$objOverlay.fadeIn(function(){
											//agregamos la nueva ventana al body
											$('body').append($objVentana);
											//mostramos la ventana suavemente ;)
											$objVentana.fadeIn();
										})
						}else{
							noty({text: mensaje['mensaje'], type: 'error'});
						}

			     },
				error: function(msg){
						noty({text: "Ha habido un error en el sistema, intentelo nuevamente.", type: 'error'});
				}
			});
	}
function getInfoContacto(elemento,idContacto){
			/*Datos de la tabla con Respecto al usuario*/
			var data={ 
			's_token':$('#s_token').attr('value'),
			'idContacto':idContacto,						
			};
			/*Hace la llamada y maneja la respuesta con un popup en caso de que haya habido un error*/
			$.ajax({
			     type: "POST",
			     url: "<?php echo base_url("informacion/getInfoContacto");?>",
			     data: data ,
			     success: function(msg){
					 console.log(msg);
						var mensaje = $.parseJSON(msg);
						
						if(mensaje['response'] ==  "true"){
								//obtenemos la pagina que queremos cargar en la ventana y el titulo
										
										//creamos la nueva ventana para mostrar el contenido y la capa para el titulo
										var $objVentana=$('<div class="clsVentana">'), $objVentanaTitulo=$('<div class="clsVentanaTitulo">');
										
										//agregamos el titulo establecido y el boton cerrar
										$objVentanaTitulo.append('<strong>Información del contacto</strong>');
										$objVentanaTitulo.append('<a href="" class="clsVentanaCerrar">Cerrar</a>');
										
										//agregamos la capa de titulo a la ventana
										$objVentana.append($objVentanaTitulo);
										
										//creamos la capa que va a mostrar el contenido
										var $objVentanaContenido=$('<div class="clsVentanaContenido">');
										
								//		$objVentanaContenido.append('<iframe src="'++'">')
										//agregamos la capa de contenido a la ventana
										$objVentana.append(mensaje['mensaje']);
										//creamos el overlay con sus propiedades css y lo agregamos al body
										var $objOverlay=$('<div id="divOverlay">').css({
											opacity: .5,
											display: 'none'
										});
										$('body').append($objOverlay);
										
										//animamos el overlay y cuando su animacion termina seguimos con la ventana
										$objOverlay.fadeIn(function(){
											//agregamos la nueva ventana al body
											$('body').append($objVentana);
											//mostramos la ventana suavemente ;)
											$objVentana.fadeIn();
										})
						}else{
							noty({text: mensaje['mensaje'], type: 'error'});
						}

			     },
				error: function(msg){
						noty({text: "Ha habido un error en el sistema, intentelo nuevamente.", type: 'error'});
				}
			});
	}

});



</script>



