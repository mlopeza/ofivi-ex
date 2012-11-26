<script type="text/javascript" >
	/*Logica de Creación de Proyecto*/
	proyecto_global=-1;
	reporte_global=-1;
	$(document).ready(function(){
		
		
		//Se selecciona un Proyecto
        $(".colorea-proyecto").live("click",function(){
                $.each($(".colorea-proyecto"),function(index,elemento){
                    $(elemento).attr("style","");
                });

                $(this).attr("style","background-color:whiteSmoke;");
                proyecto_global=$(this).attr('idproyecto');
                
                $('iframe').contents().find('.wysihtml5-editor').html("Seleccione reporte...");
				$("#idReporteHidden").val('');
				$("#titulo-reporte").val('');
                
    
                getReportesProyecto(proyecto_global);
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
        
        //Guarda los cambios al reporte
        $("#GuardarReporte").click(function(){
            if(proyecto_global==-1 || reporte_global==-1){
				noty({text: "No se ha escogido ningún proyecto.", type: 'error'});
                return;
            }
            
            noty({text: "Se guardaron las modificaciones.", type: 'success'});
            $("#reporte-proyecto").submit();
        });
       
	});
		
	// Obtiene los reportes de un proyecto
	function getReportesProyecto(proyecto_global){
            //Busca los reportes de un Proyecto
            console.log("Get Reportes del Proyecto");
            data={'idProyecto':proyecto_global};
			$.ajax({
			     type: "POST",
			     url: "modificarReportes/reportesDeProyectoAutor",
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
									$("#idReporteHidden").val('');
									$("#titulo-reporte").val('');
									reporte_global = -1;
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
            
            $(nodo).append("<tr class='colorea-reporte' idreporte='"+elemento['idreporte']+"' class='tabla-reportes'><td>"+
			elemento['nombre']+" "+elemento['apellidop']+"</td><td>"+
			elemento['titulo']+"</td></tr>");
             
        
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
			     url: "modificarReportes/getReporte",
			     data: data,
			     success: function(msg){
								console.log(msg);
								mensaje=$.parseJSON(msg);
							if(mensaje['response'] == "false"){
								noty({text: mensaje['mensaje'], type: 'error'});
							}else{
								//Se agrega el titulo y contenido del reporte
								$("#titulo-reporte").val(mensaje['mensaje'][0]['titulo'])
                                $(contenido).contents().find('.wysihtml5-editor').html(mensaje['mensaje'][0]['contenido']);
                                //Agrega id al elemento oculto
                                $("#idReporteHidden").val(reporte_global);
                            }
			     },
				error: function(msg){
						noty({text: "Ha habido un error en el sistema, intentelo nuevamente.", type: 'error'});
				}
			});
			console.log("Fin de getReporte");
    }
</script>
