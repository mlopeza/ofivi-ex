<div id="content" class="span9 section-body" />
<div id="section-body" class="tabbable" />
<!-- Only required for left/right tabs -->
<ul class="nav nav-tabs">
  <li class="active"><a href="#tab1" data-toggle="tab">Actualizar Estado</a></li>
</ul>
<div class="tab-content" />
<div class="tab-pane active" id="tab1">
  <div class="row-fluid">
    <!--Tabs1-->
    <div class="span7">
      <div id="accordion1" class="accordion">
        <div class="accordion-group">
          <div class="accordion-heading">
            <a class="accordion-toggle" data-toggle="collapse" href="#notification" data-original-title="">
            <i class="icon-th icon-white"></i> <span class="divider-vertical"></span> Proyectos asignados <i class="icon-chevron-down icon-white pull-right"></i>
            </a>
          </div>
          <div id="notification" class="accordion-body collapse in">
            <div class="accordion-inner paddind">
              <!--Elemento 1-->
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Grupo</th>
                    <th>Empresa</th>
                    <th>Proyecto</th>
                  </tr>
                </thead>
                <tbody id="proyectos-body">
                </tbody>
                <?php
                  if(empty($proyectos)) {
                  ?>
                <tr class="colorea-proyecto" idProyecto="-1" class="tabla-proyectos">
                  <td colspan="3">No hay proyectos para este usuario</td>
                </tr>
                <?php }else 
                  foreach($proyectos as $proyecto){
                  ?>
                <tr class="colorea-proyecto" idProyecto="<?php echo $proyecto->idProyecto; ?>" class="tabla-proyectos">
                  <td><?php echo $proyecto->Grupo; ?></td>
                  <td><?php echo $proyecto->Empresa; ?></td>
                  <td><?php echo $proyecto->Proyecto; ?></td>
                </tr>
                <?php }
                  ?>
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
          <!--------------->
        </div>
      </div>
    </div>
  </div>
  <!----Termina Tabs1---------->
  <div class="tab-content">
    <div class="tab-pane active" id="tab1">
      <div class="row-fluid">
        <!--Tabs2-->
        <div class="span7">
          <div id="accordion" class="accordion">
            <div class="accordion-group">
              <div class="accordion-heading">
                <a class="accordion-toggle" data-toggle="collapse" href="#notification2" data-original-title="">
                <i class="icon-th icon-white"></i> <span class="divider-vertical"></span> Actualizar Estado <i class="icon-chevron-down icon-white pull-right"></i>
                </a>
              </div>
              <div id="notification2" class="accordion-body collapse in">
                <div class="accordion-inner paddind">
                  <!--Elemento 1-->
                  <!---Inicia nuevo estado---------->
                  <div id="notification" class="accordion-body collapse in">
                    <div class="accordion-inner paddind">
                      <?php
                        $attributes = array('id' => 'actualizar-proyecto', 'class' => 'clearfix' , 'autocomplete' => 'off');
                        echo form_open('actualizaEstado/actualizaEstadoProyecto',$attributes);
                        ?>
                      <label for="nuevoEstado" class="control-label">Selecciona nuevo estado</label>
                      <input type="hidden" id="idProyectoActualizar" name="idProyectoActualizar" value="" />
                      <select id="nuevoEstado" name="nuevoEstado">
                        <option value=""></option>
                        <option value="En proceso" id="En proceso">En proceso</option>
                        <option value="Finalizado" id="Finalizado">Finalizado</option>
                      </select>
                      <button class="btn btn-primary" id="actualizar" type="button">Actualizar Estado</button>
                      <?php
                        echo form_close();
                        ?>
                    </div>
                  </div>
                  <!---Termina nuevo estado----->
                  <br />
                </div>
              </div>
              <!--------------->
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-------------->
    <div class="tab-content">
      <div class="tab-pane active" id="tab1">
        <div class="row-fluid">
          <!--Tabs2-->
          <div class="span7">
            <div id="accordion" class="accordion">
              <div class="accordion-group">
                <div class="accordion-heading">
                  <a class="accordion-toggle" data-toggle="collapse" href="#notification3" data-original-title="">
                  <i class="icon-th icon-white"></i> <span class="divider-vertical"></span> Historial de Estados <i class="icon-chevron-down icon-white pull-right"></i>
                  </a>
                </div>
                <div id="notification3" class="accordion-body collapse in">
                  <div class="accordion-inner paddind">
                    <!--Elemento 1-->
                    <div id="notification" class="accordion-body collapse in">
                      <div class="accordion-inner paddind">
                        <table class="table table-bordered">
                          <thead>
                            <tr>
                              <th>Creador</th>
                              <th>Estado</th>
                              <th>Fecha de cambio</th>
                            </tr>
                          </thead>
                          <tbody id="estados-proyecto-body"></tbody>
                          <tfoot>
                            <tr>
                              <td colspan="3" style="text-align:right;">
                              </td>
                            </tr>
                          </tfoot>
                        </table>
                        <br />
                      </div>
                      <!----------------->
                    </div>
                    <!---Termina historial de estados---------->
                    <br />
                  </div>
                </div>
                <!--------------->
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-------------->
    </div>
  </div>
</div>
