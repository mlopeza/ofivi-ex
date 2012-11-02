<script type="text/javascript" >
    var oTable;
	/*Logica de Creación de Proyecto*/
	$(document).ready(function(){
        //Inicializa la tabla
        oTable = $('#tabla-contactos').dataTable( );
		//Llena el primer campo
		$("#Grupo").change(function() {
			getElementos($(this).children('option').filter(':selected').attr('id'),$(this),"getEmpresas","Grupo","Empresa",false);
		});
		$("#Empresa").change(function() {
			getElementos($(this).children('option').filter(':selected').attr('id'),$(this),"getProyectos","Empresa","Proyecto",true);
		});
		$("#Proyecto").change(function() {
		    getContactos();
		});
	$(".yes-btt").live("click",function() {
		nodo=$(this).parent().parent().parent().children(":first");
		if($(nodo).hasClass("btn-success"))
            return;
        callServer(($(this).attr('id')),"cRelacion");
		nodo.addClass("btn-success");
		nodo.removeClass("btn-danger");
		nodo.next().addClass("btn-success");
		nodo.next().removeClass("btn-danger");
		nodo.html("<i class=\"icon-ok icon-white\"></i> Sí");
	});                
                
	$(".no-btt").live("click",function() {
		nodo=$(this).parent().parent().parent().children(":first");
		if($(nodo).hasClass("btn-danger"))
            return;
		nodo.removeClass("btn-success")
		nodo.addClass("btn-danger");
		nodo.next().removeClass("btn-success")
		nodo.next().addClass("btn-danger");
		nodo.html("<i class=\"icon-remove icon-white\"></i> No");
        callServer(($(this).attr('id')),"eRelacion");
	});   

		});
			

	//Regresa las empresas que pertenecen a un Grupo y las
	//Inserta en el OptionS List
	function getElementos(id,elemento,direccion,name,out,fill){
			/*Datos de la tabla con Respecto al usuario*/
            idName="id"+name;
			var data={};
            data['s_token']=$('#s_token').attr('value');
            data[idName]=id;

			/*Hace la llamada y maneja la respuesta con un popup en caso de que haya habido un error*/
			$.ajax({
			     type: "POST",
			     url: "asignaContacto/"+direccion,
			     data: data ,
			     success: function(msg){

						var mensaje = $.parseJSON(msg);
						if(mensaje['response'] ==  "true"){
								//Agrega las Empresas al nodo seleccionado
								var nodo = $('#'+out);
								//Elimina nodos
								$(nodo).empty();
								//Agrega los nodos que se buscaron
								appendElementos(mensaje['mensaje'],nodo,out);
                                if(out=="Empresa"){
                                    getElementos($("#Empresa").children('option').filter(':selected').attr('id'),$(this),"getProyectos","Empresa","Proyecto",true);
                                }else if(out == "Proyecto"){
                        		    getContactos();
                                }
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
	function appendElementos(nodos,elemento,name){
		if(nodos.length == 0){
			$(elemento).append($("<option>").append("No hay Registros").attr('id','0'));
		}else{
			$(nodos).each(function(index,nodo){
				$(elemento).append($("<option>").append(nodo['nombre']).attr('id',nodo['id'+name]));
			});
		}
	}

    function getContactos(){
            idProyecto=$("#Proyecto").children('option').filter(':selected').attr('id');
            idEmpresa=$("#Empresa").children('option').filter(':selected').attr('id');
            var aTrs = oTable.fnGetNodes();
            $.each(aTrs,function(index,value){
                oTable.fnDeleteRow(value);
            });
            if(idProyecto == undefined || idProyecto <=0 || idEmpresa == undefined || idEmpresa <=0)
                return;
			/*Datos de la tabla con Respecto al usuario*/
			var data={};
            data['s_token']=$('#s_token').attr('value');
            data['idProyecto']=idProyecto;
            data['idEmpresa']=idEmpresa;

			/*Hace la llamada y maneja la respuesta con un popup en caso de que haya habido un error*/
			$.ajax({
			     type: "POST",
			     url: "asignaContacto/getContactos",
			     data: data ,
			     success: function(msg){
                        agregaContactos($.parseJSON(msg));
			     },
				error: function(msg){
						noty({text: "Ha habido un error en el sistema, intentelo nuevamente.", type: 'error'});
				}
			});
    }



    function agregaContactos(elementos){
       $.each(elementos,function(index,elemento){
           $('#tabla-contactos').dataTable().fnAddData( [
	        	regresaCorrecto(elemento['asignado'],elemento['idContacto']),
	        	elemento['name'],
	        	elemento['email']]
            );
        }); 
    }

    function regresaCorrecto(i,id){
        if(i !="0"){
            return '<div class="btn-group"><button id="vista_administrador" class="btn btn-success"><i class="icon-ok icon-white"></i> Sí</button><button data-toggle="dropdown" class="btn dropdown-toggle btn-success"><span class="caret"></span></button><ul class="dropdown-menu"><li><a id="'+id+'" class="yes-btt" data-original-title="">Sí</a></li><li><a id="'+id+'" class="no-btt" data-original-title="">No</a></li></ul></div>';
        }else{
            return '<div class="btn-group"><button id="vista_supervisor_extension" class="btn btn-danger"><i class="icon-remove icon-white"></i> No</button><button data-toggle="dropdown" class="btn btn-danger dropdown-toggle"><span class="caret"></span></button><ul class="dropdown-menu"><li><a id="'+id+'" class="yes-btt" data-original-title="">Sí</a></li><li><a id="'+id+'" class="no-btt" data-original-title="">No</a></li></ul></div>';
        }
    }



    function callServer(idContacto,accion){
			/*Hace la llamada y maneja la respuesta con un popup en caso de que haya habido un error*/
            data={"idContacto":idContacto,"idProyecto":$("#Proyecto").children('option').filter(':selected').attr('id')};
			$.ajax({
			     type: "POST",
			     url: "asignaContacto/"+accion,
			     data: data ,
			     success: function(msg){
                        if(accion=="eRelacion"){
                            noty({text: "Se ha eliminado la relacion con el Contacto", type: 'success'});
                        }else{
                            noty({text: "Se ha creado la relacion con el Contacto", type: 'success'});
                        }
			     },
				error: function(msg){
						noty({text: "Ha habido un error en el sistema, intentelo nuevamente.", type: 'error'});
				}
			});
    }




</script>
