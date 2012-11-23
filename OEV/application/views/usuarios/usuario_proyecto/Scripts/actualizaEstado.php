<script type="text/javascript" >
	/*Logica de Creación de Proyecto*/
	proyecto_global=-1;
	$(document).ready(function(){
		
		
		//Se selecciona un Proyecto
        $(".colorea-proyecto").live("click",function(){
                $.each($(".colorea-proyecto"),function(index,elemento){
                    $(elemento).attr("style","");
                });

                $(this).attr("style","background-color:whiteSmoke;");
                proyecto_global=$(this).attr('idproyecto');
                
	            console.log("idProyecto = "+proyecto_global);
                $("#idProyectoActualizar").val(proyecto_global);
                getEstadoProyecto();
        });
	
		//Actualiza estado del Proyecto
        $("#actualizar").click(function(){
			if($(this).hasClass('disabled-button')){
					return;
			}
			
            if(proyecto_global==-1){
				noty({text: "No se ha escogido ningún proyecto.", type: 'error'});
                return;
            }
            estadoNuevo=$("#nuevoEstado").children('option').filter(':selected').attr('value');
            
            console.log("Estado nuevo "+ estadoNuevo);
            if(estadoNuevo == ""){
				noty({text: "No se ha seleccionado nuevo estado.", type: 'error'});
                return;
            }
			//No permite que se toque el boton
			$(this).addClass('disabled-button');
            noty({text: "Se actualizo el estado del proyecto.", type: 'success'});
            
            $("#actualizar-proyecto").submit();
        });
	});
	
	// Obtiene estado de un proyecto
	function getEstadoProyecto(){
            //Busca el estado de un Proyecto
            console.log("Get estado del Proyecto");
            data={'idProyecto':proyecto_global};
            
			$.ajax({
			     type: "POST",
			     url: "actualizaEstado/getEstadoProyecto",
			     data: data,
			     success: function(msg){
								console.log("msg "+msg);
								mensaje=$.parseJSON(msg);
								//Berifica que el proyecto tenga reportes
								if(mensaje['mensaje'] == null || mensaje['mensaje'] == ""){
									noty({text: "No hay estados para este proyecto", type: 'warning'});
									//nodo=$("#reportes-actuales-body");
									//$(nodo).empty();
									$("#estadoActual").val("Seleccione reporte...");
								}else{
									console.log("mensaje "+mensaje);
									if(mensaje['response'] == "false"){
										noty({text: mensaje['mensaje'], type: 'error'});
									}else{
										$("#estadoActual").val(mensaje['mensaje'][0]['estado']);
									}
								}
			     },
				error: function(msg){
						noty({text: "Ha habido un error en el sistema, intentelo nuevamente.", type: 'error'});
				}
			});
    }
</script>
