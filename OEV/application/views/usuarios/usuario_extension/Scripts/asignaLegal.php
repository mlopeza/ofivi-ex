<script type="text/javascript" >
	/*Logica de Creación de Proyecto*/
    proyecto_global=-1;
	$(document).ready(function(){
            $(".cancelar-asignacion").live("click",function(){
            data = {				
					'idUsuario':$(this).attr('id'),
					'idProyecto':proyecto_global};
	    		$.ajax({
	    		     type: "POST",
	    		     url: "AsignaLegal/eliminaAsignacion",
	    		     data: data ,
	    		     success: function(msg){
						 console.log(msg);
	    							mensaje=$.parseJSON(msg);
                                    
	    						if(mensaje['response'] == "false"){
	    							noty({text:"Error al Intentar Cancelar la peticion.", type: 'error'});
	    						}else{
	    							noty({text:"Peticion Cancelada.", type: 'success'});
                                    getAsignadosProyecto(mensaje['mensaje']);
									actualizaLegales();
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
           

        $(".asignar-profesor").live("click",function(){
                if(proyecto_global == -1) return;
                //Obtiene los datos del Profesor y le manda una Peticion
                data={
					'idUsuario':$(this).attr('id'),
				'idProyecto':proyecto_global};
			$.ajax({
			     type: "POST",
			     url: "AsignaLegal/asingaLegal",
			     data: data ,
			     success: function(msg){
                console.log(msg);
								mensaje=$.parseJSON(msg);
							if(mensaje['response'] == "false"){
								noty({text: mensaje['mensaje'], type: 'error'});
							}else{
                                noty({text: "Peticion Enviada al Usuario", type: 'success'});
								nodo=$("#contenedor-interno-profesores");
								$(nodo).empty();
                                getAsignadosProyecto();
                            }
			     },
				error: function(msg){
						noty({text: "Ha habido un error en el sistema, intentelo nuevamente.", type: 'error'});
				}
			});
        });
    });


    

    //Agrega Los usuarios que se encontraron en la tabla
    function agregaUsuarioTabla(lista){
        nodo=$("#contenedor-interno-profesores");
        $.each(lista,function(index,elemento){            
            $(nodo).append("<tr><td>"+elemento['nombre']+"</td><td><button type='button' id='"+elemento['idUsuario']+"' class='asignar-profesor btn btn-primary'>Asignar</button></td></tr>");
        });
        getAsignadosProyecto();
    }
function actualizaLegales(){
$.ajax({
			     type: "POST",
			     url: "AsignaLegal/legalAsignar",
			     data: data ,
			     success: function(msg){
                console.log(msg);
								mensaje=$.parseJSON(msg);
							if(mensaje['response'] == "false"){
								noty({text: mensaje['mensaje'], type: 'error'});
							}else{
                                noty({text: "Peticion Enviada al Usuario", type: 'success'});
								nodo=$("#contenedor-interno-profesores");
								$(nodo).empty();
                                agregaUsuarioTabla(mensaje['mensaje']);
                            }
			     },
				error: function(msg){
						noty({text: "Ha habido un error en el sistema, intentelo nuevamente.", type: 'error'});
				}
			});
}
    function agregaUsuarioTabla2(lista){

        nodo=$("#contenedor-interno-profesores2");
        $(nodo).empty();
        $.each(lista,function(index,elemento){            
           $(nodo).append("<tr><td>"+elemento['nombre']+"</td><td><button type='button' id='"+elemento['idUsuario']+"' class='cancelar-asignacion btn btn-primary'>Cancelar</button></td></tr>");
		   });
    }

    function getAsignadosProyecto(){
            //Busca los Usuarios Asignados al Proyecto
            console.log("Get Asignados al Proyecto");
            data={'idProyecto':proyecto_global};
			$.ajax({
			     type: "POST",
			     url: "asignaLegal/legalAsignados",
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
</script>
