<script type="text/javascript" >
	$(document).ready(function(){
        getUserData();


     $("#GuardarReporte").click(function(){
            if($("#idProyecto option:selected")[0] == undefined || $("#idProyecto option:selected")[0] == ""){
				noty({text: "No se ha escogido ningún proyecto.", type: 'error'});
                return;
            }
            $("#reporte-profesor").submit();
        });


		$("#usuario-nuevo-telefono").click(function(){
			var o = $('<tr><td><input class="descripcion" type="text" style="max-width:100px;"></input></td><td><input class="lada" style="max-width:25px;" type="text"></input></td><td><input class="telefono" style="max-width:50px;" type="text"></input></td><td><input class="extension" type="text" style="max-width:30px;"></input></td><td><input class="descripcionExtra" type="text" style="max-width:50px;"></input></td><td><button class="btn btn-danger remove-telefono" type="button"><i class="icon-remove icon-white"></i></button></td></tr>');
			$("#usuario-telefonos-body").append(o);
		});

        $("#GuardaModificaciones").click(function(){        
            data={'usuario':{},'telefonos':new Array()};
            data['usuario'].idUsuario=$("#idUsuario-sistema").attr('idusuario');
            data['usuario'].Nombre=$("#usuario-nombre").val();
            data['usuario'].ApellidoP=$("#usuario-ap").val();
            data['usuario'].ApellidoM=$("#usuario-am").val();
            data['usuario'].email=$("#usuario-email").val();

            if(data.usuario.Nombre == ""){
				noty({text: "El campo nombre no puede estar vacío.", type: 'error'});
                return;
            }

            if(data.usuario.ApellidoP == ""){
				noty({text: "El campo Apellido Paterno no puede estar vacío.", type: 'error'});
                return;
            }

            if(data.usuario.email == ""){
				noty({text: "El campo Correo Electrónico no puede estar vacío.", type: 'error'});
                return;
            }

            arreglo = new Array();
            deseo_continuar = false;
            contestado = false;
            $.each($("#usuario-telefonos-body").children(),function(index,value){
                e = {};
                if($(value).attr('id') != undefined)
                    e.idTelefono = $(value).attr('id');
                e.descripcion = $(value).find('.descripcion').val();
                e.telefono = $(value).find('.telefono').val();
                e.extension = $(value).find('.extension').val();
                e.lada = $(value).find('.lada').val();
                e.descripcionExtra=$(value).find('.descripcionExtra').val();
                if((e.telefono == "" || e.descripcion == "") && deseo_continuar == false && contestado == false){
                    deseo_continuar=confirm("Los telefonos sin descripcion o sin telefono no se guardarán. Desea continuar?");
                    contestado = true;
                }
                if(e.telefono != "" && e.descripcion != "")                
                    data['telefonos'][data['telefonos'].length] = e;
            });
            if(deseo_continuar == false && contestado == true){
                return;
            }
        
            //Se guardan todos los datos
            ajaxCall('modificarPerfil/savePerfil',data,function(response){
				noty({text: "Los datos se han guardado correctamente.", type: 'success'});
                $("#usuario-telefonos-body").empty();
                getUserData();
            });
        });

		//Remueve un telefono de la lista
		$(".remove-telefono").live("click",function(){
            padre=$(this).parent().parent()
    		noty({
    			animateOpen: {opacity: 'show'},
    			animateClose: {opacity: 'hide'},
    			layout: 'center',
    			text: "Deseas eliminar el Telefono?", 
    			buttons: [
    		    {type: 'btn btn-mini btn-primary', text: 'Sí', click: 
                        function($noty){
                            data={'idTelefono':$(padre).attr('id')};
                            if($(padre).attr('id')=="" || $(padre).attr('id') == undefined){
                                $(padre).remove();
                                return;
                            }
                            ajaxCall("modificarPerfil/deleteTelefono",data,
                                function(x){
                                    noty({text: "El telefono se ha eliminado con exito.", type: 'success'});
                                }
                            );
                            $noty.close();
                            $(padre).remove();
                            
                        } 
                },
    		    {type: 'btn btn-mini btn-danger', text: 'No', click: function($noty) {$noty.close();} }
    		    ],
    		  closable: false,
    		  timeout: false
    		});

		});


    });    



    function getUserData(){
        data = {};
        data.idUsuario = $("#idUsuario-sistema").attr('idusuario');
        if(data.idUsuario == undefined || data.idUsuario == ""){
            noty({text: "Error al obtener el Id del Usuario.", type: 'error'});
        }
        ajaxCall("modificarPerfil/getUserData",data,function(data){
            data=$.parseJSON(data);
            console.log(data);
            $("#usuario-nombre").val(data['usuario'].Nombre);
            $("#usuario-ap").val(data['usuario'].ApellidoP);
            $("#usuario-am").val(data['usuario'].ApellidoM);
            $("#usuario-email").val(data['usuario'].email);
            //Telefonos
            $.each(data['telefonos'],function(index,value){
				var o = $('<tr id="'+value.idTelefono+'" ><td><input class="descripcion" type="text" style="max-width:100px;"></input></td><td><input class="lada" style="max-width:25px;" type="text"></input></td><td><input class="telefono" style="max-width:50px;" type="text"></input></td><td><input class="extension" type="text" style="max-width:30px;"></input></td><td><input class="descripcionExtra" type="text" style="max-width:50px;"></input></td><td><button class="btn btn-danger remove-telefono" type="button"><i class="icon-remove icon-white"></i></button></td></tr>');
						$(o).find('.descripcion').val(value["descripcion"]);
						$(o).find('.telefono').val(value["telefono"]);
						$(o).find('.extension').val(value["extension"]);
						$(o).find('.lada').val(value["lada"]);
						$(o).find('.descripcionExtra').val(value["descripcionExtra"]);
				$("#usuario-telefonos-body").append(o);
            });
        });

    }

    function ajaxCall(url,data,func){
			$.ajax({
			     type: "POST",
			     url: url,
			     data: data ,
			     success: func,
				error: function(msg){
						noty({text: "Ha habido un error en el sistema, intentelo nuevamente.", type: 'error'});
				}
			});

    }
</script>

