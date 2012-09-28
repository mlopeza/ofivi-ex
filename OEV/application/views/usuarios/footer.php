            </div>
            <footer>
                <p><strong>&copy; Oficina de Extensión Virtual - 2012</strong></p>
            </footer>
        </div><!--/.fluid-container-->

        <!-- Javascript
        ================================================== -->
        <!-- Se pone al final del documento para que se cargue rápido -->
        <script src="<?php echo base_url("js/jquery.min.js");?>"></script>
        <script src="<?php echo base_url("js/bootstrap.min.js");?>"></script>        
        <script src="<?php echo base_url("js/charts/jquery.flot.js");?>"></script>
        <script src="<?php echo base_url("js/charts/jquery.flot.resize.js");?>"></script>
        <script src="<?php echo base_url("js/charts/jquery.flot.pie.js");?>"></script>
        <script src="<?php echo base_url("js/charts/customcharts.js");?>"></script>
        <script src="<?php echo base_url("js/jquery-ui.min.js");?>"></script>
        <script src="<?php echo base_url("js/button-utils.js");?>"></script>
        <script src="<?php echo base_url("js/jquery.dataTables.js");?>"></script>
		<script src="<?php echo base_url("js/simple-search.js");?>"></script>

        <script type="text/javascript">
            $(document).ready(function(){
                $('.togglemenuleft').click(function(){
                    $('#menu-left').toggleClass('span1');
                    $('#menu-left').toggleClass('icons-only');
                    $('#menu-left').toggleClass('span3');
                    
					//Reducia el tamaño del Contenido, lo removí
                    //$('#content').toggleClass('span6');
                    //$('#content').toggleClass('span8');
                    
                    $(this).find('i').toggleClass('icon-circle-arrow-right');
                    $(this).find('i').toggleClass('icon-circle-arrow-left');
                    $('#menu-left').find('span').toggle();
                    $('#menu-left').find('.dropdown').toggle();
                });

                // sort table 
                $('#example').dataTable();
                $('a.style').click(function(){
                    var style = $(this).attr('href');
                    $('.links-css').attr('href','css/' + style);
                    return false;
                });       
                $('#menu-left a').click(function(){

                    $('#menu-left').find('a').removeClass('active');
                    $(this).addClass('active');
                });
		        // tool tip
                $('a').tooltip('hide');

       			 //datePciker
                $("#datepicker").datepicker();
				// switch style 
                $('a.style').click(function(){
                    var style = $(this).attr('href');
                    $('.links-css').attr('href','css/' + style);
                    return false;
                });

                $(".switcher").click(function(){
                    if($(this).find('i').hasClass('icon-circle-arrow-right'))
                    $('.theme').animate({left:'0px'},500);
                    else
                    $('.theme').animate({left:'-89'},500);

                    $(this).find('i').toggleClass('icon-circle-arrow-right');
                    $(this).find('i').toggleClass('icon-circle-arrow-left');
                });

            });
        </script>
    </body>
</html>
