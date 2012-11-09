
    <link href="<?php echo base_url("css/calendar/dailog.css");?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url("css/calendar/calendar.css");?>" rel="stylesheet" type="text/css" /> 
    <link href="<?php echo base_url("css/calendar/dp.css");?>" rel="stylesheet" type="text/css" />   
    <link href="<?php echo base_url("css/calendar/alert.css");?>" rel="stylesheet" type="text/css" /> 
    <link href="<?php echo base_url("css/calendar/main.css");?>" rel="stylesheet" type="text/css" />

    <script src="<?php echo base_url("js/calendar/src/jquery.js");?>" type="text/javascript"></script>    
    <script src="<?php echo base_url("js/calendar/src/Plugins/Common.js");?>" type="text/javascript"></script>    
    <script src="<?php echo base_url("js/calendar/src/Plugins/datepicker_lang_ES.js");?>" type="text/javascript"></script>     
    <script src="<?php echo base_url("js/calendar/src/Plugins/jquery.datepicker.js");?>" type="text/javascript"></script>
    <script src="<?php echo base_url("js/calendar/src/Plugins/jquery.alert.js");?>" type="text/javascript"></script>    
    <script src="<?php echo base_url("js/calendar/src/Plugins/jquery.ifrmdailog.js");?>" defer="defer" type="text/javascript"></script>
    <script src="<?php echo base_url("js/calendar/src/Plugins/wdCalendar_lang_ES.js");?>" type="text/javascript"></script>    
    <script src="<?php echo base_url("js/calendar/src/Plugins/jquery.calendar.js");?>" type="text/javascript"></script>  
    <script type="text/javascript">
        $(document).ready(function() {     
           var view="week";          
            var DATA_FEED_URL = "/OEV/calendarPHP/datafeed.php";
            console.log($("#idUsuario-sistema").attr('idusuario'));
            var op = {
                view: view,
                theme:3,
                showday: new Date(),
                EditCmdhandler:Edit,
                DeleteCmdhandler:Delete,
                ViewCmdhandler:View,    
                onWeekOrMonthToDay:wtd,
                onBeforeRequestData: cal_beforerequest,
                onAfterRequestData: cal_afterrequest,
                onRequestDataError: cal_onerror, 
                autoload:true,
        		extParam:[{'name':"idUsuario",'value':$("#idUsuario-sistema").attr('idusuario')}],
                url: DATA_FEED_URL + "?method=list",  
                quickAddUrl: DATA_FEED_URL + "?method=add", 
                quickUpdateUrl: DATA_FEED_URL + "?method=update",
                quickDeleteUrl: DATA_FEED_URL + "?method=remove"        
            };

            var $dv = $("#calhead");
            var _MH = 500;
            var dvH = $dv.height() + 2;
            op.height = _MH - dvH;
            op.eventItems =[];
            var p = $("#gridcontainer").bcalendar(op).BcalGetOp();
            if (p && p.datestrshow) {
                $("#txtdatetimeshow").text(p.datestrshow);
            }
            $("#caltoolbar").noSelect();
            
            $("#hdtxtshow").datepicker({ picker: "#txtdatetimeshow", showtarget: $("#txtdatetimeshow"),
            onReturn:function(r){                          
                            var p = $("#gridcontainer").gotoDate(r).BcalGetOp();
                            if (p && p.datestrshow) {
                                $("#txtdatetimeshow").text(p.datestrshow);
                            }
                     } 
            });
            function cal_beforerequest(type)
            {
                var t="Cargando datos...";
                switch(type)
                {
                    case 1:
                        t="Cargando datos...";
                        break;
                    case 2:                      
                    case 3:  
                    case 4:    
                        t="La peticion esta siendo procesada ...";                                   
                        break;
                }
                $("#errorpannel").hide();
                $("#loadingpannel").html(t).show();    
            }
            function cal_afterrequest(type)
            {
                switch(type)
                {
                    case 1:
                        $("#loadingpannel").hide();
                        break;
                    case 2:
                    case 3:
                    case 4:
                        $("#loadingpannel").html("Exito!");
                        window.setTimeout(function(){ $("#loadingpannel").hide();},2000);
                    break;
                }              
               
            }
            function cal_onerror(type,data)
            {
                $("#errorpannel").show();
            }
            function Edit(data)
            {
               var eurl="calendar/edit?id={0}&start={2}&end={3}&isallday={4}&title={1}&idUsuario="+$("#idUsuario-sistema").attr('idusuario');   
                if(data)
                {
                    var url = StrFormat(eurl,data);
                    console.log(url);
                    OpenModelWindow(url,{ width: 600, height: 400, caption:"Editar Evento",onclose:function(){
                       $("#gridcontainer").reload();
                    }});
                }
            }    
            function View(data)
            {
                var str = "";
                $.each(data, function(i, item){
                    str += "[" + i + "]: " + item + "\n";
                });
                alert(str);               
            }    
            function Delete(data,callback)
            {           
                $.alerts.okButton="Ok";  
                $.alerts.cancelButton="Cancel";
                hiConfirm("Estas seguro de eliminar este evento?", 'Confirm',function(r){ r && callback(0);});           
            }
            function wtd(p)
            {
               if (p && p.datestrshow) {
                    $("#txtdatetimeshow").text(p.datestrshow);
                }
                $("#caltoolbar div.fcurrent").each(function() {
                    $(this).removeClass("fcurrent");
                })
                $("#showdaybtn").addClass("fcurrent");
            }
            //to show day view
            $("#showdaybtn").click(function(e) {
                //document.location.href="#day";
                $("#caltoolbar div.fcurrent").each(function() {
                    $(this).removeClass("fcurrent");
                })
                $(this).addClass("fcurrent");
                var p = $("#gridcontainer").swtichView("day").BcalGetOp();
                if (p && p.datestrshow) {
                    $("#txtdatetimeshow").text(p.datestrshow);
                }
            });
            //to show week view
            $("#showweekbtn").click(function(e) {
                //document.location.href="#week";
                $("#caltoolbar div.fcurrent").each(function() {
                    $(this).removeClass("fcurrent");
                })
                $(this).addClass("fcurrent");
                var p = $("#gridcontainer").swtichView("week").BcalGetOp();
                if (p && p.datestrshow) {
                    $("#txtdatetimeshow").text(p.datestrshow);
                }

            });
            //to show month view
            $("#showmonthbtn").click(function(e) {
                //document.location.href="#month";
                $("#caltoolbar div.fcurrent").each(function() {
                    $(this).removeClass("fcurrent");
                })
                $(this).addClass("fcurrent");
                var p = $("#gridcontainer").swtichView("month").BcalGetOp();
                if (p && p.datestrshow) {
                    $("#txtdatetimeshow").text(p.datestrshow);
                }
            });
            
            $("#showreflashbtn").click(function(e){
                $("#gridcontainer").reload();
            });
            
            //Add a new event
            $("#faddbtn").click(function(e) {
                var url ="edit.php";
                OpenModelWindow(url,{ width: 500, height: 400, caption: "Crear nuevo Evento."});
            });
            //go to today
            $("#showtodaybtn").click(function(e) {
                var p = $("#gridcontainer").gotoDate().BcalGetOp();
                if (p && p.datestrshow) {
                    $("#txtdatetimeshow").text(p.datestrshow);
                }


            });
            //previous date range
            $("#sfprevbtn").click(function(e) {
                var p = $("#gridcontainer").previousRange().BcalGetOp();
                if (p && p.datestrshow) {
                    $("#txtdatetimeshow").text(p.datestrshow);
                }

            });
            //next date range
            $("#sfnextbtn").click(function(e) {
                var p = $("#gridcontainer").nextRange().BcalGetOp();
                if (p && p.datestrshow) {
                    $("#txtdatetimeshow").text(p.datestrshow);
                }
            });
            
        });
    </script> 
