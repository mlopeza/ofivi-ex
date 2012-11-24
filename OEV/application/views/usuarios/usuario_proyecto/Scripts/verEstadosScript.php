<script  type="text/javascript" >
    var gTable;
    var eTable;
    var lTable;
	idGrupoGlobal = -1;
	$(document).ready(function(){
				//La ventana de Procesando
					$(document).ajaxStart( 
						$.blockUI({ 
		    		        theme:     true, 
		    		        title:    'OFIVEX', 
		    		        message:  '<p>Procesando.</p>'
		        		})
					).ajaxStop(
						$.unblockUI
					);
		//Inicializa las tablas
        gTable = $('#tabla-grupos').dataTable();
        eTable = $('#tabla-empresas').dataTable();
        lTable = $('#tabla-lista').dataTable();



		//Trae todos los grupos de la base de datos
		getGrupos();
		getLista();

	
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


	


		$("#limpiar-grupo").click(function(){
			limpiarGrupo();
		});

		$("#limpiar-empresa").click(function(){
			limpiarEmpresa();
		});
		
		//Modificar para traer estados o generar algo parecido
		//Trae todas las empresas relacionadas con elGrupo al que se le dio click
		$('#tabla-grupos tbody tr').live("click",function () {
			// Obtiene la posicion de a lo que se dio click
			limpiarEmpresa();
			idGrupo = $(this).find('button').filter(':first').attr('id');
			idGrupoGlobal = idGrupo;
			getEmpresas();
			var aPos = gTable.fnGetPosition( this );
			$("#empresa-grupo-input").val(gTable.fnGetData(aPos[0])[aPos][0]);
			$("#empresa-grupo-input").attr('idGrupo',idGrupo);
            $.each($("#tabla-grupos tbody tr"),function(index,elemento){
                    $(elemento).attr("style","");
            });
			$("#grupo-creacion").html("").html((gTable.fnGetData(aPos[0])[aPos][0]));
			$("#grupo-creacion").attr('idGrupo',idGrupo);
            $(this).attr("style","background-color:whiteSmoke;");
			$("#empresa-creacion").html("");
			$("#empresa-creacion").attr("idEmpresa","-1");
			idEmpresaGlobal = -1;
			

		});

	});


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
	function getEmpresas(){
		//Elimina todo lo que haya en la tabla de Grupos
		cleanTable(eTable);
		ajaxCall("jerarquiaGrupos/getEmpresas",{'idGrupo':idGrupoGlobal},function(data){
			//Convierte los datos JSON en objeto
			data = $.parseJSON(data);
			$.each(data,function(index,value){
                id = value.idEmpresa;
                delete value.idGrupo;
                delete value.idEmpresa;
				delete value.activo;
                insertElement(eTable,id,value,"Empresa")                
            });
    	    $(".editEmpresa").filter("[id="+idEmpresaGlobal+"]").parent().parent().attr("style","background-color:whiteSmoke;");
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
