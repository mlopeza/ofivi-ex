<script type="text/javascript" >
    var oTable;
	$(document).ready(function(){
        oTable = $('#tabla-areas').dataTable();
		getCategorias();


		//Remueve la categoria
		$(".removeCategoria").live("click",function(){
			console.log($(this).attr('id'));
			ajaxCall('areasClientes/deleteCategoria',{'idCategoria':$(this).attr('id')},function(data){
				console.log(data);
				noty({text: "La categoría se ha elimiando correctamente.", type: 'success'});
				getCategorias();
			})
		});	


		//Remueve la categoria
		$(".editCategoria").live("click",function(){
			$("#nombre-categoria").attr('idCategoria',$(this).attr('id'));
			$("#nombre-categoria").val($(this).parent().parent().children(":first").html());
			p = $(this).parent().parent()[0];
			oTable.fnDeleteRow(p);
		});

		//Remueve la categoria
		$("#addCategoria").live("click",function(){
			d={'data':{}}
			idCategoria = $("#nombre-categoria").attr('idCategoria');
			//Si tiene un Id de edicion lo agrega
			if( idCategoria != ""  && idCategoria != undefined){
				d.data.idCategoria = idCategoria;
			}
			//Agrega el valor
			d.data.Categoria = $("#nombre-categoria").val();
			console.log(d)
			ajaxCall('areasClientes/addCategoria',d,function(data){
				console.log(data);
				noty({text: "La categoría se agrego correctamente.", type: 'success'});
				//Pone en blanco nuevamente los datos
				$("#nombre-categoria").attr('idCategoria','');
				$("#nombre-categoria").val("");
				getCategorias();
			});
		});

	});

	/*Trea todas las areas disponibles*/
	function getCategorias(){
		cleanTable(oTable);
		ajaxCall('areasClientes/getCategorias',{},function(data){
			console.log(data);
			datum = $.parseJSON(data);
			//Agrega los elementos a la tabla
			$.each(datum,function(index,element){
				id = element.idCategoria;
				delete element.idCategoria;
				insertElement(oTable,id,element); 
			});
		});

	}



    /*Inserta un elemento a la tabla*/
    function insertElement(table,id,value){
       //Crea un arreglo del objeto
       arreglo=objectToArray(value);
       //Trae los botones de edicion
       arreglo[arreglo.length]=getBotonEdicion(id);
       //Asigna el elemento a la tabla
       $(table).dataTable().fnAddData(arreglo);
    }

    //Regresa un boton de la clase y con el id
    function getBotonEdicion(id){
		return '<button id="'+id+'" class="btn btn-info editCategoria" type="button"><i class="icon-edit icon-white"></i></button>&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-danger removeCategoria" id="'+id+'" type="button"><i class="icon-remove icon-white"></i></button>'
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
