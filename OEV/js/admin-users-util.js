/* Cambia el color del boton y el Valor del Mismo
	Fue diseñado para la tabla de Aceptar-Rechazar
	Pero puede Ser utilizado si se utilizan las mismas
	clases
*/
$(document).ready(function(){
	/*Funcion para aceptar al usuario*/
	$(".accept-user").click(function() {
		user_selecter_ajax_helper(true,$(this).parent().parent());
	});                
                
	/*Funcion para rechazar al usuario*/
	$(".reject-user").click(function() {
		user_selecter_ajax_helper(false,$(this).parent().parent());
	});   


	/*Funcion para hacer la llamada AJAX al servidor con el Token de Seguridad*/
	function user_selecter_ajax_helper(accept,parent){
			/*Datos de la tabla con Respecto al usuario*/
			var data={ 
			's_token':$('#csrf_token').attr('value'),
			'Username':$(parent).find('#username').text(),
			'idUsuario': parseInt($(parent).find('#username').attr('value')),
			'idDepartamento':parseInt($(parent).find('#departamento').attr('value')),
			'Tipo_Usuario':$(parent).find('#tipo_usuario').val(),
			'Vista_Administrador':parseInt(get_real($.trim($(parent).find('#vista_administrador').text()))),
			'Vista_Usuario_Extension':parseInt(get_real($.trim($(parent).find('##vista_usuario_extension').text()))),
			'Vista_Supervisor_Extension':parseInt(get_real($.trim($(parent).find('#vista_supervisor_extension').text()))),
			'Vista_Profesor':parseInt(get_real($.trim($(parent).find('#vista_profesor').text()))),
			'Vista_Cliente':parseInt(get_real($.trim($(parent).find('#vista_cliente').text()))),
			'Vista_Legal':parseInt(get_real($.trim($(parent).find('#vista_legal').text()))),
			'Usuario_Aceptado':(accept?'a':'r'),
			'Usuario_Activo':(accept?1:0)
			};

			/*Hace la llamada y maneja la respuesta con un popup en caso de que haya habido un error*/
			$.ajax({
			     type: "POST",
			     url: "aceptaUsuarios/insertData",
			     data: data ,
			     success: function(msg){
						var mensaje = $.parseJSON(msg);
						//console.log($.parseJSON(msg));
						if(mensaje['response'] ==  "true"){
							noty({text: mensaje['mensaje'], type: 'success'});
							//Elimina la fila del usuario aceptado, si es que se acepto
							$(parent).remove();
						}else{
							noty({text: mensaje['mensaje']+"<br\>"+mensaje['errores'], type: 'error'});
						}

			     },
				error: function(msg){
						noty({text: "Ha habido un error en el sistema, intenetelo nuevamente.", type: 'error'});
						//console.log($.parseJSON(msg));				
				}
			});
	}

	/*Regresa 1 o 0 dependiendo de si es un si o no al servidor*/
	function get_real( value ){
		if(value == "No"){
			return 0;
		}else{
			return 1;
		}
	}
});
