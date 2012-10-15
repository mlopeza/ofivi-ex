            </div>
            <footer>
                <p><strong>&copy; Oficina de Extensión Virtual - 2012</strong></p>
            </footer>
        </div><!--/.fluid-container-->

        <!-- Javascript
        ================================================== -->
        <!-- Se pone al final del documento para que se cargue rápido -->
        <script src="<?php echo base_url("js/bootstrap.min.js");?>"></script>
        <script src="<?php echo base_url("js/bootstrap-datepicker.js");?>"></script>
        <script src="<?php echo base_url("js/jquery.min.js");?>"></script>
        <script src="<?php echo base_url("js/bootstrap.min.js");?>"></script>
        <script src="<?php echo base_url("js/button-utils.js");?>"></script>
        <script src="<?php echo base_url("js/button-utils.js");?>"></script>
        <script src="<?php echo base_url("js/jquery.dataTables.js");?>"></script>
		  <script src="<?php echo base_url("js/simple-search.js");?>"></script>
		  <script src="<?php echo base_url("js/admin-users-util.js");?>"></script>
		  <script src="<?php echo base_url("js/bootstrap-wysihtml5.js");?>"></script>
		  <script src="<?php echo base_url("js/bootstrap-datepicker.js");?>"></script>
        <script src="<?php echo base_url("js/jquery.dataTables.js");?>"></script>
        <script src="<?php echo base_url("js/button-utils.js");?>"></script>
        <script src="<?php echo base_url("js/jquery.tokeninput.js");?>"></script>
        <script src="<?php echo base_url("js/wysihtml5-0.3.0.js");?>"></script>
        <script src="<?php echo base_url("js/jquery.dataTables.js");?>"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $('.togglemenuleft').click(function(){
                    $('#menu-left').toggleClass('span1');
                    $('#menu-left').toggleClass('icons-only');
                    $('#menu-left').toggleClass('span3');
                    $('#content').toggleClass('span9');
                    $('#content').toggleClass('span11');
                    $(this).find('i').toggleClass('icon-circle-arrow-right');
                    $(this).find('i').toggleClass('icon-circle-arrow-left');
                    $('#menu-left').find('span').toggle();
                    $('#menu-left').find('.dropdown').toggle();
                });

                $('#menu-left a').click(function(){
                    $('#menu-left').find('a').removeClass('active');
                    $(this).addClass('active');
                });
                $('a').tooltip('hide');
                $('a.style').click(function(){
                    var style = $(this).attr('href');
                    $('.links-css').attr('href','css/' + style);
                    return false;
                });
                               // switch style 

                $(".switcher").click(function(){
                    if($(this).find('i').hasClass('icon-circle-arrow-right'))
                    $('.theme').animate({left:'0px'},500);
                    else
                    $('.theme').animate({left:'-89'},500);

                    $(this).find('i').toggleClass('icon-circle-arrow-right');
                    $(this).find('i').toggleClass('icon-circle-arrow-left');
                });
                                // sort table 
                $('#example').dataTable();
                $('a.style').click(function(){
                    var style = $(this).attr('href');
                    $('.links-css').attr('href','css/' + style);
                    return false;
                });
                // switch style 
            });
        </script>
    </body>
</html>
