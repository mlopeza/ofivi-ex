<script type="text/javascript" >
	$(document).ready(function(){
		$.ajax({
			     type: "POST",
			     url: "/OEV/altaProyecto/getDatosProyecto",
			     data: {'idProyecto':<?php echo $idProyecto;?>} ,
			     success: function(msg){
								mensaje=$.parseJSON(msg);
                console.log(mensaje);
								d = mensaje.proyecto;
								c = mensaje.contactos;
								d = d[0];
								$.each(c,function(index,value){
									$("#demo-input-local").tokenInput("add",value);
								});
								$($('iframe')[0]).contents().find('.wysihtml5-editor').html("").html(d.descripcionUsuario);
								$($('iframe')[1]).contents().find('.wysihtml5-editor').html("").html(d.descripcionAEV);
								$("#nombre_proyecto").val(d.nombre);
								$(".Proyecto-Breadcrumb").html("").html(d.nombre);
								$("#idProyecto").val(d.idProyecto);
                //Selecciona las categorias
                checkbox = $(".categoriaCheckbox");
                $.each(mensaje['categorias'],function(index,value){
                        $(checkbox).filter("#"+value['idCategoria']).attr('checked', true);
                })
			     },
				error: function(msg){
						noty({text: "Ha habido un error en el sistema, intentelo nuevamente.", type: 'error'});
				}
			});


	});
</script>
