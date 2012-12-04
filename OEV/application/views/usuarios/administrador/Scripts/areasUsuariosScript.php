<script  type="text/javascript" >
    var gTable;
    var eTable;
    var lTable;
	idGrupoGlobal = -1;
	idEmpresaGlobal = -1;
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

		//Trae todos los grupos de la base de datos
		getGrupos();

    //Remueve un grupo de la base de datos
    $(".removeGrupo").live("click",function(){
        console.log(this);
        id=$(this).attr('id');
    		noty({
    			animateOpen: {opacity: 'show'},
    			animateClose: {opacity: 'hide'},
    			layout: 'center',
    			text: "Deseas eliminar el grupo?", 
    			buttons: [
    		    {type: 'btn btn-mini btn-primary', text: 'Sí', click: function($noty) {
                        ajaxCall('areasUsuarios/deleteGrupo',{'idGrupo_Area':id},function(){
                            noty({text: "El grupo se ha eliminado.", type: 'success'});
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
        console.log(this);
        id=$(this).attr('id');
    		noty({
    			animateOpen: {opacity: 'show'},
    			animateClose: {opacity: 'hide'},
    			layout: 'center',
    			text: "Deseas eliminar la especialidad?", 
    			buttons: [
    		    {type: 'btn btn-mini btn-primary', text: 'Sí', click: function($noty) {
                        ajaxCall('areasUsuarios/deleteArea',{'idArea_Conocimiento':id},function(){
                            noty({text: "La especialidad se ha eliminado.", type: 'success'});
							limpiarGrupo();
							limpiarEmpresa();
							getEmpresas();
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
        console.log(this);
			$("#EtiquetaGrupo").html("- Edición");
			$("#grupo-input").val($(this).parent().parent().children(":first").html());
			$("#grupo-input").attr('idGrupo',$(this).attr('id'));
		});


		//Manda el Grupo para Guardarlo en la base de datos
		$("#guardar-grupo").click(function(){
        console.log(this);
			data = {}
			$("#grupo-creacion").html("");
			$("#grupo-creacion").attr('idGrupo',"-1");
			$("#empresa-creacion").html("");
			$("#empresa-creacion").attr('idEmpresa',"-1");
			$("#empresa-grupo-input").val("");
			$("#empresa-grupo-input").attr('idGrupo',"");
			idGrupoGlobal = -1;
			nombre = $("#grupo-input").val().trim();
			idGrupo = $("#grupo-input").attr('idGrupo');
			if(idGrupo != "" && idGrupo != undefined)
				data.idGrupo_Area = idGrupo;

			if(nombre == ""){
				noty({text: "El nombre de la categoría no debe de estar vacío.", type: 'error'});
				return;
			}
			data.nombre = nombre;
      console.log(data);
			ajaxCall('areasUsuarios/saveGrupo',data,function(response){
        console.log(response);
				response = $.parseJSON(response);
				noty({text: "El Grupo "+nombre+" se ha guardado con éxito", type: 'success'});
				limpiarGrupo();
				limpiarEmpresa();
				getGrupos();
			});

		});

		//Manda la empresa a edicion
		$(".editEmpresa").live("click",function(){ 
        console.log(this);
        changeData(this);
        });

		//Manda a la empresa a guardar en la base de datos
		$("#guardar-empresa").click(function(){
        console.log(this);
      edemp=$("#solo")
			data = {}

			idGrupo = $("#empresa-grupo-input").attr('idGrupo');
			nombre = $(edemp).val().trim();
			idEmpresa = $(edemp).attr('idEmpresa');

			if(idGrupo != "" && idGrupo != undefined){
				data.idGrupo_Area = idGrupo;
			}else{
				noty({text: "Se debe seleccionar primero una Categoría.", type: 'error'});
				return;
			}

			if(idEmpresa != "" && idEmpresa != undefined)
				data.idArea_Conocimiento = idEmpresa;

			if(nombre == ""){
				noty({text: "El nombre de la subcategoría no debe de estar vacío.", type: 'error'});
				return;
			}
			data.area = nombre;
      console.log("Data",data.idCategoria);
			ajaxCall('areasUsuarios/addArea',data,function(response){
        console.log(response);
				response = $.parseJSON(response);
				$(edemp).attr('idEmpresa',response['idEmpresa']);
				getEmpresas();
				idEmpresaGlobal=response['idEmpresa'];
				noty({text: "La subcategoría "+nombre+" se ha guardado con éxito", type: 'success'});
			});

		});


		$("#limpiar-grupo").click(function(){
        console.log(this);
			limpiarGrupo();
		});

		$("#limpiar-empresa").click(function(){
        console.log(this);
			limpiarEmpresa();
		});

		//Trae todas las empresas relacionadas con elGrupo al que se le dio click
		$('#tabla-grupos tbody tr').live("click",function () {
        console.log(this);
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
      $(this).attr("style","background-color:whiteSmoke;");
			idEmpresaGlobal = -1;
			

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
		$("#solo").val("");
		$("#solo").attr('idEmpresa',"");
		$("#ete").html("");
	}


	/*Busca los Grupos en la Bse de datos*/
	function getGrupos(){
		//Elimina todo lo que haya en la tabla de Grupos
		cleanTable(gTable);
		cleanTable(eTable);
		ajaxCall("areasUsuarios/getGrupos",undefined,function(data){
			//COnvierte los datos JSON en objeto
      console.log(data);
			data = $.parseJSON(data);
			$.each(data,function(index,value){
                id = value.idGrupo_Area;
                delete value.idGrupo_Area;
                insertElement(gTable,id,value,"Grupo")                
            });
		});

	}

	/*Busca los Grupos en la Base de datos*/
	function getEmpresas(){
		//Elimina todo lo que haya en la tabla de Grupos
		cleanTable(eTable);
		ajaxCall("areasUsuarios/getAreas",{'idGrupo_Area':idGrupoGlobal},function(data){
			//Convierte los datos JSON en objeto
			data = $.parseJSON(data);
			$.each(data,function(index,value){
                id = value.idArea_Conocimiento;
                delete value.idGrupo_Area;
                delete value.idArea_Conocimiento;
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

  function changeData(e){
			$("#ete").html("- Edición");
      x=$(e).parent().parent().children(":first").html();
			$('#solo').attr('idEmpresa',$(e).attr('id')).val(x);
  }
</script>
