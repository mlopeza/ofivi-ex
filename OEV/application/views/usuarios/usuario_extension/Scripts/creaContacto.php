<script type="text/javascript" >
	/*Logica para traer los Contactos*/
    var cTable;
	$(document).ready(function(){
       cTable = $('#tabla-contactos').dataTable();
       $("#limpiar-contacto").click(limpiarContacto);
       $("#tab-contactos").click(function(){
             grupo = $("#Grupo option:selected").attr('id');
             empresa = $("#Empresa option:selected").attr('id');
            if(grupo <= 0){
      				noty({text: 'No se ha escogido un Grupo.', type: 'error'});
              $("#pes2").removeClass("active");
              $("#tab2").removeClass("active");
              $("#pes1").addClass("active");
              $("#tab1").addClass("active");
              return;
            }
            if(empresa <= 0){
              $("#pes1").addClass("active");
              $("#tab1").addClass("active");
              $("#pes2").removeClass("active");
              $("#tab2").removeClass("active");
      				noty({text: 'No se ha escogido una Empresa.', type: 'error'});
              return;
            }
            getContactos(empresa);
        });


    //Remueve una Empresa de la base de datos
    $(".removeContacto").live("click",function(){
        id=$(this).attr('id');
    		noty({
    			animateOpen: {opacity: 'show'},
    			animateClose: {opacity: 'hide'},
    			layout: 'center',
    			text: "Deseas eliminar el Contacto?", 
    			buttons: [
    		    {type: 'btn btn-mini btn-primary', text: 'Sí', click: function($noty) {
                        ajaxCall('creaContacto/deleteContacto',{'idContacto':id},function(){
                            noty({text: "El contacto se ha eliminado.", type: 'success'});
                            getContactos($("#Empresa option:selected").attr('id'));
                        });
                        $noty.close();
                    } 
                },
    		    {type: 'btn btn-mini btn-danger', text: 'No', click: function($noty) {$noty.close();}}
    		    ],
    		  closable: false,
    		  timeout: false
    		});
    });

    $(".editContacto").live("click",function(){
        $("#edicion-contacto").html("").html("Editar");
				$("#contacto-telefonos-body").empty();
        id=$(this).attr('id');
        obj=$.parseJSON($(this).parent().find('input').val());
        $("#idContacto").val(obj.contacto.idContacto);
        $("#contacto-nombre").val(obj.contacto.Nombre);
        $("#contacto-ap").val(obj.contacto.apellidoP);
        $("#contacto-am").val(obj.contacto.apellidoM);
        $("#contacto-email").val(obj.contacto.email);
        $("#contacto-puesto").val(obj.contacto.Puesto);
        $("#contacto-departamento").val(obj.contacto.Departamento);
        $("#contacto-enviar").attr('checked',obj.recibe==1?true:false);

			$.each(obj.telefonos,function(index,value){
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

        //Cambia de Tab
        $("#pes1").addClass("active");
        $("#tab1").addClass("active");
        $("#pes2").removeClass("active");
        $("#tab2").removeClass("active");
    });


    		//Trae todas las empresas relacionadas con elGrupo al que se le dio click
    		$('#tabla-contactos tbody tr').live("click",function () {
  			  // Obtiene la posicion de a lo que se dio click
   			  $('#tabla-telefono tbody').empty();
          $("#RecibeCorreos").html("");
          $.each($("#tabla-contactos tbody tr"),function(index,elemento){
               $(elemento).attr("style","");
          });
          $(this).attr("style","background-color:whiteSmoke;");

          //Obtiene los datos del input en json
          obj=$.parseJSON($(this).find('input').val());
          body = $("#tabla-telefono tbody");
          $("#RecibeCorreos").html("").html(obj['recibe']==1?"Sí":"No");
          $.each(obj['telefonos'],function(index,value){
             fila=$("<tr></tr>");
                  $(fila).append($("<td></td>").html(value['descripcion']));
                  $(fila).append($("<td></td>").html(value['lada']));
                  $(fila).append($("<td></td>").html(value['telefono']));
                  $(fila).append($("<td></td>").html(value['extension']));
                  $(fila).append($("<td></td>").html(value['descripcionExtra']));
              $(body).append(fila);
          });
		    });

   });


/*Busca los Grupos en la Base de datos*/
	function getContactos(idEmpresa){
	  	//Elimina todo lo que haya en la tabla de Grupos
	  	cleanTable(cTable);
	  	ajaxCall("creaContacto/getContactos",{'idEmpresa':idEmpresa},function(data){
	  		//Convierte los datos JSON en objeto
	  		data = $.parseJSON(data);
	  		$.each(data['mensaje'],function(index,value){
                  id = value[0].idContacto;
                  ob = jQuery.extend(true, {}, value);;
                  datos_extra={'telefonos':value[1],'recibe':value[0]['Recibe_Correos'],'contacto':value[0]};
                  ob[0].Nombre = value[0].Nombre+" "+value[0].apellidoP+" "+value[0].apellidoM;
                  delete ob[0].idContacto;
                  delete ob[0].apellidoP;
                  delete ob[0].apellidoM;
                  delete ob[0].Recibe_Correos;
                  insertElement(cTable,id,ob[0],"Contacto",datos_extra);
              });
  		});
    }

    /*Inserta un elemento a la tabla*/
    function insertElement(table,id,value,type,telefonos){
       //Crea un arreglo del objeto
       arreglo=objectToArray(value);
       //Trae los botones de edicion
       arreglo[arreglo.length]=getBotonEdicion(type,id,telefonos);
       //Asigna el elemento a la tabla
       $(table).dataTable().fnAddData(arreglo);
    }

    //Regresa un boton de la clase y con el id
    function getBotonEdicion(type,id,telefonos){
        return '<input type="hidden" value=\''+JSON.stringify(telefonos)+'\'></input><button id="'+id+'" class="btn btn-info edit'+type+'" type="button"><i class="icon-edit icon-white"></i></button>&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-danger remove'+type+'" id="'+id+'" type="button"><i class="icon-remove icon-white"></i></button>'
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

    function limpiarContacto(){
  			//Limpia datos de la forma
        if($("#idContacto") != undefined){
            $("#idContacto").val("");
          $("#edicion-contacto").html("").html("Crear")
        }
  			$("#contacto-nombre").val("");
  			$("#contacto-ap").val("");
  			$("#contacto-am").val("");
  			$("#contacto-enviar").attr('checked', false);
  			$("#contacto-email").val("");
  			$("#contacto-departamento").val("");
  			$("#contacto-puesto").val("");
  			$("#contacto-telefonos-body").empty();
      }
</script>
