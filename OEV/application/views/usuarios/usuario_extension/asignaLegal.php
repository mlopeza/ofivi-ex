<div id="content" class="span9 section-body" />
<?php echo form_open_multipart(); ?>
<?php echo form_close(); ?> 
<div id="section-body" class="tabbable" />
<!-- Only required for left/right tabs -->
<ul class="nav nav-tabs">
  <li class="active"><a href="#tab1" data-toggle="tab">Proyectos</a></li>
</ul>
<div class="tab-content">
  <div class="tab-pane active" id="tab1">
    <div class="row-fluid">
      <!--Tabs2-->
      <div class="span4">
        <div id="accordion1" class="accordion">
          <div class="accordion-group">
            <div class="accordion-heading">
              <a class="accordion-toggle" data-toggle="collapse" href="#latest" data-original-title="">
              <i class="icon-star-empty icon-white"></i> <span class="divider-vertical"></span> Proyectos Activos <i class="icon-chevron-down icon-white pull-right"></i>
              </a>
            </div>
            <div id="latest" class="accordion-body collapse in">
              <div class="accordion-inner paddind" style="overflow: auto;">
                <!--Elemento 1-->
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Grupo</th>
                      <th>Empresa</th>
                      <th>Proyecto</th>
                    </tr>
                  </thead>
                  <tbody id="proyectos-iniciados-body">
                    <?php
                      foreach($proyectos as $proyecto){
                      ?>
                    <tr class="colorea-proyecto" idProyecto="<?php echo $proyecto->idProyecto; ?>" class="tabla-proyectos">
                      <td><?php echo $proyecto->Grupo; ?></td>
                      <td><?php echo $proyecto->Empresa; ?></td>
                      <td><?php echo $proyecto->Proyecto; ?></td>
                    </tr>
                    <?php } ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="3" style="text-align:right;">
                      </td>
                    </tr>
                  </tfoot>
                </table>
                <br />
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="span8">
        <div id="accordion2" class="accordion">
          <div class="accordion-group">
            <div class="accordion-heading">
              <a class="accordion-toggle" data-toggle="collapse" href="#elements" data-original-title="">
              <i class="icon-adjust icon-white"></i> <span class="divider-vertical"></span> Historial de Asignación  <i class="icon-chevron-down icon-white pull-right"></i>
              </a>
            </div>
            <div id="elements" class="accordion-body collapse in">
              <div class="accordion-inner paddind" style="overflow: auto;">
                <!--Elemento 2-->
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <td>Nombre</td>
                      <td>Acción</td>
                    </tr>
                  <tbody id="contenedor-interno-profesores2"></tbody>
                  </thead>
                </table>
                <br />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row-fluid">
      <div class="span8">
        <div id="accordion3" class="accordion">
          <div class="accordion-group">
            <div class="accordion-heading">
              <a class="accordion-toggle" data-toggle="collapse" href="#notification" data-original-title="">
              <i class="icon-user icon-white"></i> <span class="divider-vertical"></span> Usuarios Legal <i class="icon-chevron-down icon-white pull-right"></i>
              </a>
            </div>
            <div id="notification" class="accordion-body collapse in">
              <div class="accordion-inner paddind" style="overflow: auto;">
                <!--Elemento 3-->
                <div class="row-fluid show-grid">
                  <!--Las Diferentes areas y los checkbox-->                                                            
                  <div class="span12">
                    <!--Grupos y Areas para las llamadas-->
                    <div id="accordion" class="ui-accordion ui-widget ui-helper-reset ui-accordion-icons" role="tablist">
                      <!--Los Profesores que resultaron de los checkbox-->
                      <div id="contenedor-profesores" class="span12">
                        <table class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              <td>Nombre</td>
                              <td>Acción</td>
                            </tr>
                          <tbody id="contenedor-interno-profesores">
                            <?php  
                              foreach($legal as $row){
                              	echo '<tr>';
                              	echo '<td id='.$row->idUsuario.'>';
                              	echo $row->nombre;
                              	echo '</td><td>';
                              	
                              	echo "<button type='button' id=".$row->idUsuario." class='asignar-profesor btn btn-primary'>Asignar</button>";
                              	echo '</td><tr>';
                              
                              }
                              ?>
                          </tbody>
                          </thead>
                        </table>
                        <br />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
