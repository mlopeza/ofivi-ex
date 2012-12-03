<script type="text/javascript" >
	/*Logica de Creación de Proyecto*/
	reporte_global=-1;
	$(document).ready(function(){
		
		
		//Se selecciona un Proyecto
        $(".colorea-proyecto").live("click",function(){
                $.each($(".colorea-proyecto"),function(index,elemento){
                    $(elemento).attr("style","");
                });

                $(this).attr("style","background-color:whiteSmoke;");
                proyecto_global=$(this).attr('idproyecto');
                

				muestraDescripcion(proyecto_global);
                $("#idProyectoExterno").val(proyecto_global);
                $("#idProyectoExterno").val(proyecto_global);
				$("#idProyectoExternoR").val(proyecto_global);

            });

		//Se selecciona un Reporte
        $(".colorea-reporte").live("click",function(){
                $.each($(".colorea-reporte"),function(index,elemento){
                    $(elemento).attr("style","");
                });

                $(this).attr("style","background-color:whiteSmoke;");
                
            console.log("antes "+reporte_global);
            console.log(this);
                reporte_global=$(this).attr('idreporte');
                
            console.log("despues "+reporte_global);
    
                getReporte(reporte_global,$('iframe'));
            });
			
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
            
        //Guarda los cambios al reporte
        $("#AceptaProyectoExterno").click(function(){
            if(proyecto_global==-1 ){
				noty({text: "No se ha escogido ningún proyecto.", type: 'error'});
                return;
            }
            
            noty({text: "El proyecto aparecera en la lista editar proyectos.", type: 'success'});
            $("#proyecto-externo").submit();
        });
		
		$("#RechazaProyectoExterno").click(function(){
            if(proyecto_global==-1 ){
				noty({text: "No se ha escogido ningún proyecto.", type: 'error'});
                return;
            }
            
            noty({text: "El proyecto se inactivara.", type: 'success'});
            $("#proyecto-externo-rechazado").submit();
        });
       
	});
		
	// Obtiene los reportes de un proyecto
	function getReportesProyecto(proyecto_global){
            //Busca los reportes de un Proyecto
            console.log("Get Reportes del Proyecto");
            data={'idProyecto':proyecto_global};
			$.ajax({
			     type: "POST",
			     url: "verReportes/reportesDeProyecto",
			     data: data,
			     success: function(msg){
								console.log("msg "+msg);
								mensaje=$.parseJSON(msg);
								//Berifica que el proyecto tenga reportes
								if(mensaje['mensaje'] == null || mensaje['mensaje'] == ""){
									noty({text: "No hay reportes para este proyecto", type: 'warning'});
									nodo=$("#reportes-actuales-body");
									$(nodo).empty();
									$('iframe').contents().find('.wysihtml5-editor').html("Seleccione reporte...");
								}else{
									console.log("mensaje "+mensaje);
									if(mensaje['response'] == "false"){
										noty({text: mensaje['mensaje'], type: 'error'});
									}else{
										agregaReporteTabla2(mensaje['mensaje']);
									}
								}
			     },
				error: function(msg){
						noty({text: "Ha habido un error en el sistema, intentelo nuevamente.", type: 'error'});
				}
			});
    }
    
    function agregaReporteTabla2(lista){

        nodo=$("#reportes-actuales-body");
        $(nodo).empty();
        $.each(lista,function(index,elemento){
            
           esfinal = elemento['reporteFinal'] == 0 ? elemento['titulo'] : elemento['titulo']+' (Final)';
           $(nodo).append("<tr class='colorea-reporte' idreporte='"+elemento['idreporte']+"' class='tabla-reportes'><td>"+
		   elemento['nombre']+" "+elemento['apellidop']+"</td><td>"+
		   esfinal +"</td></tr>");
             
        
        });
    }
		
	// Obtiene la descripcion del reportes
	function getReporte(reporte_global,contenido){
            //Busca los reportes 
            console.log("Get Reporte");
            console.log(reporte_global);
            data={'idReporte':reporte_global};
			$.ajax({
			     type: "POST",
			     url: "verReportes/getReporte",
			     data: data,
			     success: function(msg){
								console.log(msg);
								mensaje=$.parseJSON(msg);
							if(mensaje['response'] == "false"){
								noty({text: mensaje['mensaje'], type: 'error'});
							}else{
								//Linea que agrega el contenido del reporte
                                $(contenido).contents().find('.wysihtml5-editor').html(mensaje['mensaje'][0]['contenido']);
                            }
			     },
				error: function(msg){
						noty({text: "Ha habido un error en el sistema, intentelo nuevamente.", type: 'error'});
				}
			});
			console.log("Fin de getReporte");
    }
    
    
    /*
    function agregaReporteAreaTexto(lista){

        nodo=$("#reportes-actuales-body");
        $(nodo).empty();
        $.each(lista,function(index,elemento){
            
            //$(nodo).append("<tr class='colorea-reporte' idReporte='"+elemento['idReporte']+" class='tabla-proyectos'><td>"+
			//elemento['nombre']+" "+elemento['apellidop']+"</td><td>"+
			//elemento['titulo']+"</td></tr>");
             
        
        });
    }*/
	
	function muestraDescripcion(proyecto_global)
	{
		$.ajax({
			     type: "POST",
			     url: "/OEV/altaProyecto/getDatosProyecto",
			     data: {'idProyecto':proyecto_global} ,
			     success: function(msg){
								console.log(msg);
								mensaje=$.parseJSON(msg);
								console.log(mensaje);
								d = mensaje.proyecto;
								c = mensaje.contactos;
								d = d[0];
								$.each(c,function(index,value){
									$("#demo-input-local").tokenInput("add",value);
								});
								//$($('iframe')[0]).contents().find('.wysihtml5-editor').html("").html(d.descripcionUsuario);
								//$($('iframe')[1]).contents().find('.wysihtml5-editor').html("").html(d.descripcionAEV);
								//$("#nombre_proyecto").val(d.nombre);
								//$(".Proyecto-Breadcrumb").html("").html(d.nombre);
								//$("#idProyecto").val(d.idProyecto);
								//creamos la nueva ventana para mostrar el contenido y la capa para el titulo
										var $objVentana=$('<div class="clsVentana">'), $objVentanaTitulo=$('<div class="clsVentanaTitulo">');
										
										//agregamos el titulo establecido y el boton cerrar
										$objVentanaTitulo.append('<strong>Descripci&oacute;n de proyecto</strong>');
										$objVentanaTitulo.append('<a href="" class="clsVentanaCerrar">Cerrar</a>');
										
										//agregamos la capa de titulo a la ventana
										$objVentana.append($objVentanaTitulo);
										
										//creamos la capa que va a mostrar el contenido
										var $objVentanaContenido=$('<div class="clsVentanaContenido">');
										
								//		$objVentanaContenido.append('<iframe src="'++'">')
										//agregamos la capa de contenido a la ventana
										$objVentana.append(d.descripcionUsuario);
										
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
                //Selecciona las categorias
                checkbox = $(".categoriaCheckbox");
                $.each(mensaje['categorias'],function(index,value){
                        $(checkbox).filter("#"+value['idCategoria']).attr('checked', true);
                })
			     },
				error: function(msg){
						noty({text: "Ha habido un error en el sistema, intentelo nuevamente.", type: 'error'});
				}
			})
	}
	
	
</script>
