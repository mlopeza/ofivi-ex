<script type="text/javascript" >
    var uTable;
	$(document).ready(function(){
            uTable = $('#tabla-usuarios').dataTable();
            getUsuarios();
    });

  function getUsuarios(){
    cleanTable(uTable);
    ajaxCall("<?php echo base_url("asignaProyecto/getAllUsuarios");?>",undefined,function(data){
          console.log(data);
          data = $.parseJSON(data);
          $.each(data,function(index,value){
                id = value.idUsuario;
                value.Datos = '<a name="'+value.idUsuario+'" href="1" class="clsVentanaIFrame" rel="prueba">Información</a>';
                delete value.Departamento;
                delete value.Escuela;
                delete value.idUsuario;
                delete value.idDepartamento;
                delete value.Usuario;
                delete value.Email;
                console.log(value);
                insertElement(uTable,id,value,"Usuario");                
          });
    });      
  }


    /*Inserta un elemento a la tabla*/
    function insertElement(table,id,value,type){
       //Crea un arreglo del objeto
       arreglo=objectToArray(value);
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
<script type="text/javascript">
$(document).ready(function(){
	//evento que se produce al hacer clic en el boton cerrar de la ventana
	$('.clsVentanaCerrar').live('click',function(eEvento){
		//prevenimos el comportamiento normal del enlace
		eEvento.preventDefault();
		//buscamos la ventana padre (del boton "cerrar")
		var $objVentana=$($(this).parents().get(1));
		
		//cerramos la ventana suavemente
		$objVentana.fadeOut(300,function(){
			//eliminamos la ventana del DOM
			$(this).remove();
			//ocultamos el overlay suavemente
			$('#divOverlay').fadeOut(500,function(){
				//eliminamos el overlay del DOM
				$(this).remove();
			});
		});
	});
	
	$('.clsVentanaIFrame').live("click", function(e) {
        
		//prevenir el comportamiento normal del enlace
		e.preventDefault();
		var prueba = $(this).prop('href').split('/');
		console.log(prueba[prueba.length-1]);
		if(prueba[prueba.length-1]==1){
			getInfoProfesor($(this),$(this).prop('name'));
		}else{			
			getInfoContacto($(this),$(this).prop('name'));

		}
		
	});
		function getInfoProfesor(elemento,idUsuario){
			/*Datos de la tabla con Respecto al usuario*/
			var data={ 
			's_token':$('#s_token').attr('value'),
			'idUsuario':idUsuario,						
			};
			/*Hace la llamada y maneja la respuesta con un popup en caso de que haya habido un error*/
			$.ajax({
			     type: "POST",
			     url: "<?php echo base_url("informacion/getInfoProfesor");?>",
			     data: data ,
			     success: function(msg){
						var mensaje = $.parseJSON(msg);
						console.log(mensaje);
						if(mensaje['response'] ==  "true"){
								//obtenemos la pagina que queremos cargar en la ventana y el titulo
										
										//creamos la nueva ventana para mostrar el contenido y la capa para el titulo
										var $objVentana=$('<div class="clsVentana">'), $objVentanaTitulo=$('<div class="clsVentanaTitulo">');
										
										//agregamos el titulo establecido y el boton cerrar
										$objVentanaTitulo.append('<strong>Información del profesor</strong>');
										$objVentanaTitulo.append('<a href="" class="clsVentanaCerrar">Cerrar</a>');
										
										//agregamos la capa de titulo a la ventana
										$objVentana.append($objVentanaTitulo);
										
										//creamos la capa que va a mostrar el contenido
										var $objVentanaContenido=$('<div class="clsVentanaContenido">');
										
								//		$objVentanaContenido.append('<iframe src="'++'">')
										//agregamos la capa de contenido a la ventana
										$objVentana.append(mensaje['mensaje']);
										
										//creamos el overlay con sus propiedades css y lo agregamos al body
										var $objOverlay=$('<div id="divOverlay">').css({
											opacity: .5,
											display: 'none'
										});
										$('body').append($objOverlay);
										
										//animamos el overlay y cuando su animacion termina seguimos con la ventana
										$objOverlay.fadeIn(function(){
											//agregamos la nueva ventana al body
											$('body').append($objVentana);
											//mostramos la ventana suavemente ;)
											$objVentana.fadeIn();
										})
						}else{
							noty({text: mensaje['mensaje'], type: 'error'});
						}

			     },
				error: function(msg){
						noty({text: "Ha habido un error en el sistema, intentelo nuevamente.", type: 'error'});
				}
			});
	}
function getInfoContacto(elemento,idContacto){
			/*Datos de la tabla con Respecto al usuario*/
			var data={ 
			's_token':$('#s_token').attr('value'),
			'idContacto':idContacto,						
			};
			/*Hace la llamada y maneja la respuesta con un popup en caso de que haya habido un error*/
			$.ajax({
			     type: "POST",
			     url: "<?php echo base_url("informacion/getInfoContacto");?>",
			     data: data ,
			     success: function(msg){
					 console.log(msg);
						var mensaje = $.parseJSON(msg);
						
						if(mensaje['response'] ==  "true"){
								//obtenemos la pagina que queremos cargar en la ventana y el titulo
										
										//creamos la nueva ventana para mostrar el contenido y la capa para el titulo
										var $objVentana=$('<div class="clsVentana">'), $objVentanaTitulo=$('<div class="clsVentanaTitulo">');
										
										//agregamos el titulo establecido y el boton cerrar
										$objVentanaTitulo.append('<strong>Información del contacto</strong>');
										$objVentanaTitulo.append('<a href="" class="clsVentanaCerrar">Cerrar</a>');
										
										//agregamos la capa de titulo a la ventana
										$objVentana.append($objVentanaTitulo);
										
										//creamos la capa que va a mostrar el contenido
										var $objVentanaContenido=$('<div class="clsVentanaContenido">');
										
								//		$objVentanaContenido.append('<iframe src="'++'">')
										//agregamos la capa de contenido a la ventana
										$objVentana.append(mensaje['mensaje']);
										//creamos el overlay con sus propiedades css y lo agregamos al body
										var $objOverlay=$('<div id="divOverlay">').css({
											opacity: .5,
											display: 'none'
										});
										$('body').append($objOverlay);
										
										//animamos el overlay y cuando su animacion termina seguimos con la ventana
										$objOverlay.fadeIn(function(){
											//agregamos la nueva ventana al body
											$('body').append($objVentana);
											//mostramos la ventana suavemente ;)
											$objVentana.fadeIn();
										})
						}else{
							noty({text: mensaje['mensaje'], type: 'error'});
						}

			     },
				error: function(msg){
						noty({text: "Ha habido un error en el sistema, intentelo nuevamente.", type: 'error'});
				}
			});
	}

});



</script>



