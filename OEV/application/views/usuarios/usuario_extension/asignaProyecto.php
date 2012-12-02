<link href="<?php echo base_url("css/projectAdvances.css"); ?>" rel="stylesheet">
<link href="<?php echo base_url("css/ventanas-modales.css"); ?>" rel="stylesheet">
<div id="content" class="span9 section-body">
  <?php echo form_open_multipart(); ?>
  <?php echo form_close(); ?> 
  <div id="section-body" class="tabbable">
    <!-- Only required for left/right tabs -->
    <ul class="nav nav-tabs">
      <li class="active"><a href="#tab1" data-toggle="tab">Proyectos</a></li>
      <li><a href="#tab2" data-toggle="tab">Lista de Usuarios</a></li>
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
                          <td>Campus</td>
                          <td>Escuela</td>
                          <td>Departamento</td>
                          <td>Nombre</td>
                          <td>Tipo</td>
                          <td>Correo</td>
                          <td style="min-width:150px;">Solicitud</td>
                          <td style="min-width:150px;">Respuesta</td>
                          <td>Estatus</td>
                          <td>Comentario</td>
                          <td>Sugerencia</td>
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
          <div class="span12">
            <div id="accordion3" class="accordion">
              <div class="accordion-group">
                <div class="accordion-heading">
                  <a class="accordion-toggle" data-toggle="collapse" href="#notification" data-original-title="">
                  <i class="icon-user icon-white"></i> <span class="divider-vertical"></span> Profesores <i class="icon-chevron-down icon-white pull-right"></i>
                  </a>
                </div>
                <div id="notification" class="accordion-body collapse in">
                  <div class="accordion-inner paddind" style="overflow: auto;">
                    <!--Elemento 3-->
                    <div class="row-fluid show-grid">
                      <!--Las Diferentes areas y los checkbox-->                                                            
                      <div class="span4">
                        <!--Grupos y Areas para las llamadas-->
                        <div id="accordion" class="ui-accordion ui-widget ui-helper-reset ui-accordion-icons" role="tablist">
                          <?php
                            foreach($areas as $area){
                            $contador=0; $imprimi=0;
                            ?>
                          <div>
                            <h3 class="ui-accordion-header ui-helper-reset ui-state-default ui-state-active ui-corner-top ui-state-focus" role="tab" aria-expanded="true" aria-selected="true" tabindex="0"><span class="ui-icon ui-icon-triangle-1-s"></span><a href="#"><?php echo utf8_decode( $area[0]->nombre); ?></a></h3>
                            <div class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom ui-accordion-content-active" style="height: 31px; " role="tabpanel">
                              <?php foreach($area[1] as $sub){
                                if($contador%2 == 0){echo '<div class="row-fluid">';$contador++;}                            
                                ?>
                              <div class="span5"><?php $imprimi++; echo $sub->area;?></div>
                              <div class="span1"><input type="checkbox" class="areaCheckbox" id="<?php echo $sub->idArea_Conocimiento;?>" /></div>
                              <?php 
                                if($imprimi%2 == 0){
                                     $contador++;
                                     echo "</div>";    
                                }
                                
                                }?>
                            </div>
                          </div>
                          <?php 
                            if($imprimi%2 != 0){
                                    echo "</div>";
                            }
                            }
                            
                            ?>
                        </div>
                      </div>
                      <!--Los Profesores que resultaron de los checkbox-->
                      <div id="contenedor-profesores" class="span8">
                        <table class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              <td>Campus</td>
                              <td>Escuela</td>
                              <td>Departamento</td>
                              <td>Nombre</td>
                              <td>Tipo</td>
                              <td>Correo</td>
                              <td>Acción</td>
                            </tr>
                          <tbody id="contenedor-interno-profesores"></tbody>
                          </thead>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane" id="tab2">
        <div class="row-fluid">
          <!--Tabs2-->
          <div class="span12">
            <div id="accordion1" class="accordion">
              <div class="accordion-group">
                <div class="accordion-heading">
                  <a class="accordion-toggle" data-toggle="collapse" href="#latest2" data-original-title="">
                  <i class="icon-star-empty icon-white"></i> <span class="divider-vertical"></span> Lista de Usuarios <i class="icon-chevron-down icon-white pull-right"></i>
                  </a>
                </div>
                <div id="latest2" class="accordion-body collapse in">
                  <div class="accordion-inner paddind" style="overflow: auto;">
                    <table id="tabla-usuarios" class="table table-bordered table-striped">
                      <thead>
                        <th>Campus</th>
                        <th>Nombre</th>
                        <th>Datos</th>
                        <th>Acción</th>
                      </thead>
                    </table>
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
