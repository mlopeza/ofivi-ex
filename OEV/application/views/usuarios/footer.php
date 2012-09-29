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
        <script src="<?php echo base_url("js/jquery-ui.min.js");?>"></script>
        <script src="<?php echo base_url("js/button-utils.js");?>"></script>
        <script src="<?php echo base_url("js/jquery.dataTables.js");?>"></script>
		<script src="<?php echo base_url("js/simple-search.js");?>"></script>
		<script src="<?php echo base_url("js/admin-users-util.js");?>"></script>
		<script src="<?php echo base_url("js/bootstrap-wysihtml5.js");?>"></script>
		<script src="<?php echo base_url("js/bootstrap-datepicker.js");?>"></script>
        <script src="<?php echo base_url("js/jquery.min.js");?>"></script>
        <script src="<?php echo base_url("js/bootstrap.min.js");?>"></script>
        <script src="<?php echo base_url("js/jquery.dataTables.js");?>"></script>
        <script src="<?php echo base_url("js/jquery-ui.min.js");?>"></script>
        <script src="<?php echo base_url("js/button-utils.js");?>"></script>
        <script src="<?php echo base_url("js/jquery.tokeninput.js");?>"></script>
        <script src="<?php echo base_url("js/wysihtml5-0.3.0.js");?>"></script>
        <script src="<?php echo base_url("js/bootstrap-wysihtml5.js");?>"></script>
        <script src="<?php echo base_url("js/bootstrap-datepicker.js");?>"></script>
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


            //wysihtml5
                $('.textarea').wysihtml5();
                $('a.style').click(function(){
                    var style = $(this).attr('href');
                    $('.links-css').attr('href','css/' + style);
                    return false;
                });
                 $("#demo-input-local").tokenInput([
                {id: 7, name: "Ruby"},
                {id: 11, name: "Python"},
                {id: 13, name: "JavaScript"},
                {id: 17, name: "ActionScript"},
                {id: 19, name: "Scheme"},
                {id: 23, name: "Lisp"},
                {id: 29, name: "C#"},
                {id: 31, name: "Fortran"},
                {id: 37, name: "Visual Basic"},
                {id: 41, name: "C"},
                {id: 43, name: "C++"},
                {id: 47, name: "Java"}
            ]); 

            });
        </script>

<script>
    $(function(){
      window.prettyPrint && prettyPrint();

            
      var startDate = new Date(2012,1,20);
      var endDate = new Date(2012,1,25);
      $('#end').datepicker()
        .on('changeDate', function(ev){
          if (ev.date.valueOf() > endDate.valueOf()){
            $('#alert').show().find('strong').text('The start date can not be greater then the end date');
          } else {
            $('#alert').hide();
            startDate = new Date(ev.date);
            $('#startDate').text($('#end').data('date'));
          }
          $('#end').datepicker('hide');
        });
    });
  </script>

    </body>
</html>
