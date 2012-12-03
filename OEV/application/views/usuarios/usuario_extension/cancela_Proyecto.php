<div id="content" class="span9 section-body">
  <div id="section-body" class="tabbable">
    <!-- Only required for left/right tabs -->
    <ul class="nav nav-tabs">
      <li class="active"><a href="#tab1" data-toggle="tab">Cancelar Proyectos</a></li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane active" id="tab1">
        <div class="row-fluid">
          <!--Tabs2-->
          <div class="span7">
            <div id="accordion1" class="accordion">
              <div class="accordion-group">
                <div class="accordion-heading">
                  <a class="accordion-toggle" data-toggle="collapse" href="#notification" data-original-title="">
                  <i class="icon-th icon-white"></i> <span class="divider-vertical"></span>  Cancelar Proyecto <i class="icon-chevron-down icon-white pull-right"></i>
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
                        <td>No hay proyectos para este usuario</td>
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
                <div id="notification" class="accordion-body collapse in">
                  <div class="accordion-inner paddind">
                    <!--?php echo $error;? -->
                    <?php
                      $attributes = array('id' => 'cancelar-proyecto', 'class' => 'clearfix' , 'autocomplete' => 'off');
                      echo form_open('cancelaProyecto/cancelar',$attributes);
                      ?>
                    <div class="form-actions">
                      <input type="hidden" id="idProyectoCancelar" name="idProyectoCancelar" value="" />
                      <button class="btn btn-primary" id="uploadFile" type="button">Cancelar Proyecto</button>
                    </div>
                    <?php
                      echo form_close();
                      ?>
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
