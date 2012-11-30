<script  type="text/javascript" >
    var pTable;
	$(document).ready(function(){
		//Inicializa las tablas
        pTable = $('#tabla-proyectos').dataTable();

		//Trae los Proyectos Iniciados por el Usuario
		getProyectos();



    //Remueve un Proyecto
    $(".removeProyecto").live("click",function(){
		console.log($(this).attr('id'));
        	data=$.parseJSON($(this).attr('id'));
		id=data.idProyecto;
    		noty({
    			animateOpen: {opacity: 'show'},
    			animateClose: {opacity: 'hide'},
    			layout: 'center',
    			text: "Deseas eliminar el Proyecto?", 
    			buttons: [
    		    {type: 'btn btn-mini btn-primary', text: 'Sí', click: function($noty) {
                        ajaxCall('<?php echo base_url("proyectoExterno");?>/deleteProyecto',{'idProyecto':id},function(){
                            noty({text: "El Proyecto se ha eliminado.", type: 'success'});
							getProyectos();
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
		$(".editProyecto").live("click",function(){
			data = $.parseJSON($(this).attr('id'));
			window.location.replace("<?php echo base_url("");?>proyectoExterno/aceptaProyecto?idProyecto="+data.idProyecto);
		});

	});

	/*Busca los Grupos en la Bse de datos/
	function getProyectos(){
		//Elimina todo lo que haya en la tabla de Grupos
		cleanTable(pTable);
		data = {};
		ajaxCall("getProyectosExternos",data,function(data){
			//COnvierte los datos JSON en objeto
			data = $.parseJSON(data);
			console.log(data);
			$.each(data,function(index,value){
				id = {
					'idProyecto':value.idProyecto,
					}
				delete value.idProyecto;
                insertElement(pTable,JSON.stringify(id),value,"Proyecto");
            });
		});

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
        return '<button id=\''+id+'\' class="btn btn-info edit'+type+'" type="button"><i class="icon-edit icon-white"></i></button>&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-danger remove'+type+'" id=\''+id+'\' type="button"><i class="icon-remove icon-white"></i></button>'
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
