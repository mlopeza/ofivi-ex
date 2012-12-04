/*Cambia el color del boton y el Valor del Mismo
	Fue diseñado para la tabla de Aceptar-Rechazar
	Pero puede Ser utilizado si se utilizan las mismas
	clases
*/
$(document).ready(function(){
	$(".yes-button").click(function() {
		nodo=$(this).parent().parent().parent().children(":first");
		nodo.addClass("btn-success");
		nodo.removeClass("btn-danger");
		nodo.next().addClass("btn-success");
		nodo.next().removeClass("btn-danger");
		nodo.html("<i class=\"icon-ok icon-white\"></i> Sí");
	});                
                
	$(".no-button").click(function() {
		nodo=$(this).parent().parent().parent().children(":first");
		nodo.removeClass("btn-success")
		nodo.addClass("btn-danger");
		nodo.next().removeClass("btn-success")
		nodo.next().addClass("btn-danger");
		nodo.html("<i class=\"icon-remove icon-white\"></i> No");
	});   
});
