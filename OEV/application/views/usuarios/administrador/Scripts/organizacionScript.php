<script type="text/javascript" >
    var oTable;
    var eTable;
    var dTable;
	$(document).ready(function(){
        //Funciones de Campus
        oTable = $('#tabla-campus').dataTable();
        eTable = $('#tabla-escuela').dataTable();
        dTable = $('#tabla-departamento').dataTable();
        getCampus();

    //Pone a un campus en edicion
    $(".editCampus").live("click",function(){
        id=$(this).attr('id');
        //Se debe dar el objeto, no un arreglo
        tr=$(this).parent().parent()[0];
        nombre = $(tr).children(":nth-child(1)").html();
        ciudad = $(tr).children(":nth-child(2)").html();
        $("#nombre-Campus").val(nombre);
        $("#ciudad-Campus").val(ciudad);
        $("#id-Campus").val(id);
        //Se elimina el campo de la tabla
        oTable.fnDeleteRow(tr);
    });

    //Remueve un campus de la base de datos
    $(".removeCampus").live("click",function(){
        id=$(this).attr('id');
    		noty({
    			animateOpen: {opacity: 'show'},
    			animateClose: {opacity: 'hide'},
    			layout: 'center',
    			text: "Deseas eliminar el Campus?", 
    			buttons: [
    		    {type: 'btn btn-mini btn-primary', text: 'Sí', click: function($noty) {
                        ajaxCall('organizacion/deleteCampus',{'idCampus':id},function(){
                            noty({text: "El campus se ha eliminado.", type: 'success'});
                            getCampus();
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

    //Guarda unc ampus en la base de datos
    $("#guardarCampus").click(function(){
        data={};
        data.Nombre=$("#nombre-Campus").val().trim();
        data.Ciudad=$("#ciudad-Campus").val().trim();
        if(data.nombre == "" || data.ciudad == ""){
            noty({text: "Faltan campos por llenar del Campus.", type: 'error'});
            return;
        }


        idCampus = $("#id-Campus").val();
        if(idCampus != ""){
            data.idCampus = idCampus;
        }

        ajaxCall('organizacion/saveCampus',data,function(data){
            //Si se completo la transacción se avisará que se hizo con éxito
            noty({text: "El campus se ha guardado correctamente.", type: 'success'});
            getCampus();
            //Limpia Datos
            $("#nombre-Campus").val("");
            $("#ciudad-Campus").val("");
            $("#id-Campus").val("");
        });
    });

    //Busca Nuevamente las escuelas
    $("#selectCampus-Escuela").change(getEscuelas);

    //Pone a un campus en edicion
    $(".editEscuela").live("click",function(){
        id=$(this).attr('id');
        //Se debe dar el objeto, no un arreglo
        tr=$(this).parent().parent()[0];
        nombre = $(tr).children(":nth-child(1)").html();
        ubicacion = $(tr).children(":nth-child(2)").html();
        ciudad = $(tr).children(":nth-child(2)").html();
        $("#nombre-Escuela").val(nombre);
        $("#ubicacion-Escuela").val(ubicacion);
        $("#id-Escuela").val(id);
        $("#id-CampusEscuela").val($("#selectCampus-Escuela option:selected").attr('id'));
        //Se elimina el campo de la tabla
        oTable.fnDeleteRow(tr);
    });

    //Remueve una escuela de la base de datos
    $(".removeEscuela").live("click",function(){
        id=$(this).attr('id');
    		noty({
    			animateOpen: {opacity: 'show'},
    			animateClose: {opacity: 'hide'},
    			layout: 'center',
    			text: "Deseas eliminar la Escuela?", 
    			buttons: [
    		    {type: 'btn btn-mini btn-primary', text: 'Sí', click: function($noty) {
                        ajaxCall('organizacion/deleteEscuela',{'idEscuela':id},function(){
                            noty({text: "La escuela se ha eliminado.", type: 'success'});
                            getEscuelas();
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

    //Guarda una escuela en la base de datos
    $("#guardarEscuela").click(function(){
        data={};
        data.Nombre=$("#nombre-Escuela").val().trim();
        data.Ubicacion=$("#ubicacion-Escuela").val().trim();
        data.idCampus = $("#selectCampus-Escuela option:selected").attr('id');
        if(data.nombre == "" || data.ubicacion == ""){
            noty({text: "Faltan campos por llenar de la Escuela.", type: 'error'});
            return;
        }

        if(data.idCampus == "" || data.idCampus == undefined){
            noty({text: "No se ha escogido un Campus.", type: 'error'});
            return;
        }
        idEscuela = $('#id-Escuela').val().trim();
        if(idEscuela != ""){
            data.idEscuela = idEscuela;
        }

        ajaxCall('organizacion/saveEscuela',data,function(data){
            //Si se completo la transacción se avisará que se hizo con éxito
            noty({text: "El campus se ha guardado correctamente.", type: 'success'});
            getEscuelas();
            getEscuelasCampus();
            //Limpia Datos
            $("#nombre-Escuela").val("");
            $("#ubicacion-Escuela").val("");
            $("#id-CampusEscuela").val("");
            $("#id-Escuela").val("");
        });
    });

    //Busca las escuelas en el tab de Departamentos
    $("#selectCampus-Departamento").change(getEscuelasCampus);
    $("#selectEscuela-Departamento").change(getDepartamentosEscuelas);

    //Pone a un campus en edicion
    $(".editDepartamento").live("click",function(){
        id=$(this).attr('id');
        //Se debe dar el objeto, no un arreglo
        tr=$(this).parent().parent()[0];
        nombre = $(tr).children(":nth-child(1)").html();
        ubicacion = $(tr).children(":nth-child(2)").html();
        $("#nombre-Departamento").val(nombre);
        $("#ubicacion-Departamento").val(ubicacion);
        $("#id-Departamento").val(id);
        //Se elimina el campo de la tabla
        dTable.fnDeleteRow(tr);
    });


    //Remueve una escuela de la base de datos
    $(".removeDepartamento").live("click",function(){
        id=$(this).attr('id');
        console.log("idDepartaemnto",id);
    		noty({
    			animateOpen: {opacity: 'show'},
    			animateClose: {opacity: 'hide'},
    			layout: 'center',
    			text: "Deseas eliminar el Departamento?", 
    			buttons: [
    		    {type: 'btn btn-mini btn-primary', text: 'Sí', click: function($noty) {
                        ajaxCall('organizacion/deleteDepartamento',{'idDepartamento':id},function(data){
                            console.log(data);
                            noty({text: "El departamento ha sido eliminado.", type: 'success'});
                            getDepartamentosEscuelas();
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


    //Guarda una escuela en la base de datos
    $("#guardarDepartamento").click(function(){
        data={};
        data.Nombre=$("#nombre-Departamento").val().trim();
        data.Ubicacion=$("#ubicacion-Departamento").val().trim();
        data.idEscuela = $("#selectEscuela-Departamento option:selected").attr('id');
        if(data.nombre == "" || data.ubicacion == ""){
            noty({text: "Faltan campos por llenar del Departamento.", type: 'error'});
            return;
        }

        if(data.idEscuela == "" || data.idEscuela == undefined){
            noty({text: "No se ha escogido una Escuela.", type: 'error'});
            return;
        }

        idDepartamento = $('#id-Departamento').val().trim();
        if(idDepartamento != ""){
            data.idDepartamento = idDepartamento;
        }

        ajaxCall('organizacion/saveDepartamento',data,function(data){
            //Si se completo la transacción se avisará que se hizo con éxito
            noty({text: "El departamento se ha guardado correctamente.", type: 'success'});
            getDepartamentosEscuelas();
            //Limpia Datos
            $("#nombre-Departamento").val("");
            $("#ubicacion-Departamento").val("");
            $("#id-Departamento").val("");
        });
    });

    });


    function getDepartamentosEscuelas(){
            $("#nombre-Departamento").val("");
            $("#ubicacion-Departamento").val("");
            $("#id-Departamento").val("");
            data={'idEscuela':$("#selectEscuela-Departamento option:selected").attr('id')};
            cleanTable(dTable);
            if(data.idEscuela == "" || data.idEscuela == undefined)
                return;
            url='organizacion/getDepartamentos';
            console.log(data)
            ajaxCall(url,data,continueDepartamentos);
    }

    //Se agregan los departamentos a la tabla
    function continueDepartamentos(response){
            response=$.parseJSON(response);
            $.each(response,function(index,value){
                id = value.idDepartamento;
                delete value.idEscuela;
                delete value.idDepartamento;
                insertElement(dTable,id,value,"Departamento")                
            });
    }

    function getEscuelasCampus(){
            data={'idCampus':$("#selectCampus-Departamento option:selected").attr('id')};
            url='organizacion/getEscuelas';
            console.log(data);
            ajaxCall(url,data,function(data){
                data=$.parseJSON(data);
                console.log("Data",data);
                eSelect = $("#selectEscuela-Departamento");
                $(eSelect).empty();
                $.each(data,function(index,elemento){
                    $(eSelect).append($('<option id="'+elemento.idEscuela+'">'+elemento.Nombre+'-'+elemento.Ubicacion+'</option>'));
                });
                getDepartamentosEscuelas();

            });
    }

    /*Funcion para llenar la tabla de Campus*/
    function getCampus(){
            data={};
            url='organizacion/getCampus';
            ajaxCall(url,data,continueCampus);
    }

    /*Funcion para llenar la tabal de escuelas*/
    function getEscuelas(){
        $("#nombre-Escuela").val("");
        $("#ubicacion-Escuela").val("");
        $("#id-Escuela").val("");
        $("#id-CampusEscuela").val("");
            data={'idCampus':$("#selectCampus-Escuela option:selected").attr('id')};
            url='organizacion/getEscuelas';
            ajaxCall(url,data,continueEscuelas);
    }

    //Función que continua cone l proceso de Campus
    function continueCampus(response){
            response=$.parseJSON(response);
            cleanTable(oTable);
            //Se agregan al select de Escuelas
            fillSelectCampus(response);
            //Se agregan a la tabla de campus
            $.each(response,function(index,value){
                id = value.idCampus;
                delete value.idCampus;
                insertElement(oTable,id,value,"Campus")                
            });
            //Se llama para ctualizar las escuelas
            getEscuelas();
            getEscuelasCampus();
    }

    function continueEscuelas(response){
            response=$.parseJSON(response);
            cleanTable(eTable);
            //Se agregan al select de Escuelas
            //Se agregan a la tabla de campus
            $.each(response,function(index,value){
                id = value.idEscuela;
                delete value.idEscuela;
                delete value.idCampus;
                insertElement(eTable,id,value,"Escuela")                
            });
    }

    //Rellena el select de Campus
    function fillSelectCampus(elementos){
        eSelect = $("#selectCampus-Escuela");
        dSelect = $("#selectCampus-Departamento");
        $(eSelect).empty();
        $(dSelect).empty();
        $.each(elementos,function(index,elemento){
            $(eSelect).append($('<option id="'+elemento.idCampus+'">'+elemento.Nombre+'-'+elemento.Ciudad+'</option>'));
            $(dSelect).append($('<option id="'+elemento.idCampus+'">'+elemento.Nombre+'-'+elemento.Ciudad+'</option>'));
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
