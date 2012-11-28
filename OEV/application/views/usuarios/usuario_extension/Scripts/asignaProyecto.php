<script type="text/javascript" >
	/*Logica de Creación de Proyecto*/
    proyecto_global=-1;
	$(document).ready(function(){

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
			     },
				error: function(msg){
						noty({text: "Ha habido un error en el sistema, intentelo nuevamente.", type: 'error'});
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
</script>
