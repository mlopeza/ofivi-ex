<script type="text/javascript" >
	/*Logica de Creación de Proyecto*/
	proyecto_global=-1;
	$(document).ready(function(){
		
		
		//Se selecciona un Proyecto
        $(".colorea-proyecto").live("click",function(){
                $.each($(".colorea-proyecto"),function(index,elemento){
                    $(elemento).attr("style","");
                });

                $(this).attr("style","background-color:whiteSmoke;");
                proyecto_global=$(this).attr('idproyecto');
                
	            console.log("idProyecto = "+proyecto_global);
                $("#idProyectoContrato").val(proyecto_global);
        });
	
		//Guarda los cambios al reporte
        $("#uploadFile").click(function(){
            if(proyecto_global==-1){
				noty({text: "No se ha escogido ningún proyecto.", type: 'error'});
                return;
            }
            
            $.blockUI({ 
				theme: true, 
				title: 'OFIVEX', 
				message: '<p>Subieno archivo...<br/>Al terminar la transerencia se cerrara este mensaje</p>'
			});
            $("#subir-contrato").submit();
        });
	});
</script>
