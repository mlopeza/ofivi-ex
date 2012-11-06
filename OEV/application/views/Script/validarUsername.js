<script  type="text/javascript" >
	$(document).ready(function(){
		
		//Llena el primer campo
		$("#id_username").blur(function(){
			validateUsername($(this).val());						
		});
		
	function validateUsername(valor){
			/*Username a verificar si se encuentra*/
			var data={ 
			's_token':$('#s_token').attr('value'),
			'usuario':valor,
			};
			/*Hace la llamada y maneja la respuesta con un popup en caso de que haya habido un error*/
			$.ajax({
			     type: "POST",
			     url: "logincontroller/validaUsername",
			     data: data ,
			     success: function(msg){

						var mensaje = $.parseJSON(msg);
						if(mensaje['response'] ==  "true"){
						//	if(mensaje['mensaje']){
								noty({text: "Username correcto", type: 'success'});	
						//	}
						//	else{
						//		noty({text: "El usuario existe en la base de datos", type: 'error'});	
						//	}
						}else{
							noty({text: "Favor de llenar de nuevo el usuario", type: 'error'});
						}

			     },
				error: function(msg){
						noty({text: "Ha habido un error en el sistema, intentelo nuevamente.", type: 'error'});
				}
			});
	}
	});

</script>
