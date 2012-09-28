/*Cambia el color del boton y el Valor del Mismo
	Fue diseñado para la tabla de Aceptar-Rechazar
	Pero puede Ser utilizado si se utilizan las mismas
	clases
*/
$(document).ready(function(){
	$(".accept-user").click(function() {
		user_selecter_ajax_helper(true,$(this).parent().parent());
	});                
                
	$(".reject-user").click(function() {
		user_selecter_ajax_helper(false,$(this).parent().parent());
	});   


	function user_selecter_ajax_helper(accept,parent){


			
			var data={ 
			'csrf_test_name':$('#csrf_token').attr('value'),
			'insert': accept, 
			'username':$(parent).find('#username').text(),
			'idUsuario': $(parent).find('#username').attr('value'),
			'departamento':$(parent).find('#departamento').attr('value'),
			'tipo_usuario':$(parent).find('#tipo_usuario').val(),
			'vista_administrador':get_real($.trim($(parent).find('#vista_administrador').text())),
			'vista_usuario_extension':get_real($.trim($(parent).find('##vista_usuario_extension').text())),
			'vista_supervisor_extension':get_real($.trim($(parent).find('#vista_supervisor_extension').text())),
			'vista_profesor':get_real($.trim($(parent).find('#vista_profesor').text())),
			'vista_cliente':get_real($.trim($(parent).find('#vista_cliente').text())),
			'vista_legal':get_real($.trim($(parent).find('#vista_legal').text()))
			};

			$.ajax({
			     type: "GET",
				 datatype: 'json',
				 contentType: "application/json; charset=utf-8",
			     url: "aceptaUsuarios/insertData",
				 cache:false,
			     data: data , //assign the var here 
			     success: function(msg){
				        alert( "Data Saved: " + msg );
			     }
			});
	}

	function get_real( value ){
		if(value == "No"){
			return 0;
		}else{
			return 1;
		}
	}
});
