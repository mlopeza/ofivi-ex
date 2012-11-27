<script type="text/javascript" >
	$(document).ready(function(){
    proyecto_global = -1;
            //Se selecciona un Proyecto
            $(".colorea-proyecto").live("click",function(){
                $.each($(".colorea-proyecto"),function(index,elemento){
                    $(elemento).attr("style","");
                });
                $(this).attr("style","background-color:whiteSmoke;");
                proyecto_global=$(this).attr('idproyecto');
                regresaDescripciones(proyecto_global,$('iframe')[0],$('iframe')[1]);
            });

            $("#aceptar-proyecto").click(function(){
                mandarRespuesta(1);
            });

            $("#rechazar-proyecto").click(function(){
                if($(".informacion-extra").val().trim() == ""){
                    noty({text: "Se debe dar una razon por la cual se rechaza.", type: 'error'});
                    return;
                }
                mandarRespuesta(2);
            });
        });

    function mandarRespuesta(respuesta){
        if(proyecto_global == -1) return;
        data={
                'idProyecto':proyecto_global,
                'data':{'Razon':$(".informacion-sugerencia").val().trim(),
                        'sugerencia':$(".informacion-extra").val().trim(),
                        'acepto':respuesta,
                        'idUsuario':$("#idUsuario-sistema").attr('idUsuario')
                       }
            };
        $.ajax({
            type: "POST",
            url: "arProyecto/setRespuesta",
            data: data ,
            success: function(msg){
                console.log(msg);
                mensaje=$.parseJSON(msg);
             if(mensaje['response'] == "false"){
                 noty({text:"Error al contactar al servidor.", type: 'error'});
             }else{
                 noty({text:respuesta == 1?"Proyecto Aceptado.":"Proyecto Rechazado", type: 'success'});
				 setTimeout(function() { location.reload(); }, 2500);
             }
            },
             error: function(msg){
             noty({text: "Ha habido un error en el sistema, intentelo nuevamente.", type: 'error'});
            }
        });        

    }

    function regresaDescripciones(idProyecto,cliente,usuario){
        data={'idProyecto':idProyecto};
        $.ajax({
            type: "POST",
            url: "arProyecto/getDescripciones",
            data: data ,
            success: function(msg){
                console.log(msg);
                mensaje=$.parseJSON(msg);
             if(mensaje['response'] == "false"){
                 noty({text:"Error al contactar al servidor.", type: 'error'});
             }else{
                    console.log(cliente);
                    console.log(usuario);
                    console.log(mensaje['mensaje'][0]['cliente'])
                    console.log(mensaje['mensaje'][0]['usuario'])
                    $(cliente).contents().find('.wysihtml5-editor').html(mensaje['mensaje'][0]['cliente']);
                    $(usuario).contents().find('.wysihtml5-editor').html(mensaje['mensaje'][0]['usuario']);
             }
            },
             error: function(msg){
             noty({text: "Ha habido un error en el sistema, intentelo nuevamente.", type: 'error'});
            }
        });
    }    
</script>

