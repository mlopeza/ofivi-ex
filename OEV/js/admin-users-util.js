/*Cambia el color del boton y el Valor del Mismo
	Fue diseñado para la tabla de Aceptar-Rechazar
	Pero puede Ser utilizado si se utilizan las mismas
	clases
*/
$(document).ready(function(){
	$(".accept-user").click(function() {
		console.log($(this).parent().parent())

	});                
                
	$(".reject-user").click(function() {
		console.log($(this).parent().parent())
	});   
});
