<script type="text/javascript" >
	$(document).ready(function(){
     $("#GuardarReporte").click(function(){
            if($("#idProyecto option:selected")[0] == undefined || $("#idProyecto option:selected")[0] == ""){
				noty({text: "No se ha escogido ningún proyecto.", type: 'error'});
                return;
            }
            $("#reporte-profesor").submit();
        });
    });    
</script>
