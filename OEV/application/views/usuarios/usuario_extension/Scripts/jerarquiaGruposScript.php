<script  type="text/javascript" >
    var gTable;
    var eTable;
    var lTable;
	$(document).ready(function(){
		//Inicializa las tablas
        gTable = $('#tabla-grupos').dataTable();
        eTable = $('#tabla-empresas').dataTable();
        lTable = $('#tabla-lista').dataTable();

		//Trae todos los grupos de la base de datos
		getGrupos();
		getLista();

	$("#crear-proyecto").click(function(){
		window.location.replace("altaProyecto");
	});
	$("#actualizar-lista").click(getLista);
    //Remueve un grupo de la base de datos
    $(".removeGrupo").live("click",function(){
        id=$(this).attr('id');
    		noty({
    			animateOpen: {opacity: 'show'},
    			animateClose: {opacity: 'hide'},
    			layout: 'center',
    			text: "Deseas eliminar el Grupo?", 
    			buttons: [
    		    {type: 'btn btn-mini btn-primary', text: 'Sí', click: function($noty) {
                        ajaxCall('jerarquiaGrupos/deleteGrupo',{'idGrupo':id},function(){
                            noty({text: "El Grupo se ha eliminado.", type: 'success'});
							limpiarGrupo();
							limpiarEmpresa();
							getGrupos();
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

    //Remueve una Empresa de la base de datos
    $(".removeEmpresa").live("click",function(){
        id=$(this).attr('id');
    		noty({
    			animateOpen: {opacity: 'show'},
    			animateClose: {opacity: 'hide'},
    			layout: 'center',
    			text: "Deseas eliminar la Empresa?", 
    			buttons: [
    		    {type: 'btn btn-mini btn-primary', text: 'Sí', click: function($noty) {
                        ajaxCall('jerarquiaGrupos/deleteEmpresa',{'idEmpresa':id},function(){
                            noty({text: "La Empresa se ha eliminado.", type: 'success'});
							limpiarGrupo();
							limpiarEmpresa();
							getGrupos();
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

		//Manda el Grupo a Edicion
		$(".editGrupo").live("click",function(){
			$("#EtiquetaGrupo").html("- Edición");
			$("#grupo-input").val($(this).parent().parent().children(":first").html());
			$("#grupo-input").attr('idGrupo',$(this).attr('id'));
		});


		//Manda el Grupo para Guardarlo en la base de datos
		$("#guardar-grupo").click(function(){
			data = {}
			nombre = $("#grupo-input").val().trim();
			idGrupo = $("#grupo-input").attr('idGrupo');
			if(idGrupo != "" && idGrupo != undefined)
				data.idGrupo = idGrupo;

			if(nombre == ""){
				noty({text: "El nombre del Grupo no debe de estar vacío.", type: 'error'});
				return;
			}
			data.nombre = nombre;
			ajaxCall('jerarquiaGrupos/saveGrupo',data,function(response){
				response = $.parseJSON(response);
				noty({text: "El grupo "+nombre+" se ha guardado con éxito", type: 'success'});
				limpiarGrupo();
				limpiarEmpresa();
				getGrupos();
			});

		});

		//Manda la empresa a edicion
		$(".editEmpresa").live("click",function(){
			$("#EtiquetaEmpresa").html("- Edición");
			$("#empresa-input").val($(this).parent().parent().children(":first").html());
			$("#empresa-input").attr('idEmpresa',$(this).attr('id'));
		});

		//Manda a la empresa a guardar en la base de datos
		$("#guardar-empresa").click(function(){
			data = {}

			idGrupo = $("#empresa-grupo-input").attr('idGrupo');
			nombre = $("#empresa-input").val().trim();
			idEmpresa = $("#empresa-input").attr('idEmpresa');

			if(idGrupo != "" && idGrupo != undefined){
				data.idGrupo = idGrupo;
			}else{
				noty({text: "Se debe seleccionar primero un Grupo.", type: 'error'});
				return;
			}

			if(idEmpresa != "" && idEmpresa != undefined)
				data.idEmpresa = idEmpresa;

			if(nombre == ""){
				noty({text: "El nombre de la empresa no debe de estar vacío.", type: 'error'});
				return;
			}
			data.nombre = nombre;
			ajaxCall('jerarquiaGrupos/saveEmpresa',data,function(response){
				response = $.parseJSON(response);
				noty({text: "La Empresa "+nombre+" se ha guardado con éxito", type: 'success'});
				limpiarGrupo();
				limpiarEmpresa();
				getGrupos();
			});

		});


		$("#limpiar-grupo").click(function(){
			limpiarGrupo();
		});

		$("#limpiar-empresa").click(function(){
			limpiarEmpresa();
		});

		//Trae todas las empresas relacionadas con elGrupo al que se le dio click
		$('#tabla-grupos tbody tr').live("click",function () {
			// Obtiene la posicion de a lo que se dio click
			idGrupo = $(this).find('button').filter(':first').attr('id');
			getEmpresas(idGrupo);
			var aPos = gTable.fnGetPosition( this );
			$("#empresa-grupo-input").val(gTable.fnGetData(aPos[0])[aPos][0]);
			$("#empresa-grupo-input").attr('idGrupo',idGrupo);
            $.each($(".colorea-proyecto"),function(index,elemento){
                    $(elemento).attr("style","");
            });

            $(this).attr("style","background-color:whiteSmoke;");


		});

	});


	//Limpia los campos de Empresa
	function limpiarGrupo(){
		$("#grupo-input").val("");
		$("#grupo-input").attr('idGrupo',"");
		$("#EtiquetaGrupo").html("");
	}


	//Limpia los campos de Grupo
	function limpiarEmpresa(){
		$("#empresa-grupo-input").val("");
		$("#empresa-grupo-input").attr('idGrupo',"");
		$("#empresa-input").val("");
		$("#empresa-input").attr('idEmpresa',"");
		$("#EtiquetaEmpresa").html("");
	}


	/*Busca los Grupos en la Bse de datos*/
	function getGrupos(){
		//Elimina todo lo que haya en la tabla de Grupos
		cleanTable(gTable);
		cleanTable(eTable);
		ajaxCall("jerarquiaGrupos/getGrupos",undefined,function(data){
			//COnvierte los datos JSON en objeto
			data = $.parseJSON(data);
			$.each(data,function(index,value){
                id = value.idGrupo;
                delete value.idGrupo;
				delete value.activo;
                insertElement(gTable,id,value,"Grupo")                
            });
		});

	}

	/*Busca los Grupos en la Bse de datos*/
	function getLista(){
		//Elimina todo lo que haya en la tabla de Grupos
		cleanTable(lTable);
		ajaxCall("jerarquiaGrupos/getLista",undefined,function(data){
			//COnvierte los datos JSON en objeto
			data = $.parseJSON(data);
			$.each(data,function(index,value){
                insertElement2(lTable,value);
            });
		});

	}


	/*Busca los Grupos en la Base de datos*/
	function getEmpresas(idGrupo){
		//Elimina todo lo que haya en la tabla de Grupos
		cleanTable(eTable);
		ajaxCall("jerarquiaGrupos/getEmpresas",{'idGrupo':idGrupo},function(data){
			//COnvierte los datos JSON en objeto
			data = $.parseJSON(data);
			$.each(data,function(index,value){
                id = value.idEmpresa;
                delete value.idGrupo;
                delete value.idEmpresa;
				delete value.activo;
                insertElement(eTable,id,value,"Empresa")                
            });
		});

	}


    /*Inserta un elemento a la tabla*/
    function insertElement2(table,value){
       //Crea un arreglo del objeto
       arreglo=objectToArray(value);
       //Asigna el elemento a la tabla
       $(table).dataTable().fnAddData(arreglo);
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
        return '<button id="'+id+'" class="btn btn-info edit'+type+'" type="button"><i class="icon-edit icon-white"></i></button>&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-danger remove'+type+'" id="'+id+'" type="button"><i class="icon-remove icon-white"></i></button>'
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
