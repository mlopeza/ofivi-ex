<div id="content" class="span9 section-body">
  <?php echo form_open_multipart(); ?>
  <?php echo form_close(); ?> 
  <div id="section-body" class="tabbable">
    <!-- Only required for left/right tabs -->
    <ul class="nav nav-tabs">
      <li class="active"><a href="#tab1" data-toggle="tab">Agregar Contactos</a></li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane active" id="tab1">
        <!--/Tabs2-->
        <!--Tabs3-->
        <div class="row-fluid">
          <div class="span5">
            <div id="accordion1" class="accordion">
              <div class="accordion-group">
                <div class="accordion-heading">
                  <a class="accordion-toggle" data-toggle="collapse" href="#control" data-original-title="">
                  <i class="icon-list-alt icon-white"></i> <span class="divider-vertical"></span> Proyecto <i class="icon-chevron-down icon-white pull-right"></i>
                  </a>
                </div>
                <div id="control" class="accordion-body collapse in">
                  <div class="accordion-inner paddind">
                    <form class="form-horizontal">
                      <fieldset>
                        <div class="control-group">
                          <label for="selectError" class="control-label">Grupo</label>
                          <div class="controls">
                            <select id="Grupo">
                              <?php
                                $res = $data->result();
                                if(sizeof($res) == 0){
                                	echo "<option id=\"0\">No hay Grupos Registrados</option>";
                                }else{
                                	echo "<option id=\"0\"></option>";
                                	foreach($res as $row){ 
                                ?>
                              <option id="<?php echo $row->idGrupo; ?>">
                                <?php  echo $row->nombre;  ?>
                              </option>
                              <?php
                                }	
                                }
                                ?>
                            </select>
                            <span class="help-inline"></span>
                          </div>
                        </div>
                        <div class="control-group">
                          <label for="selectError" class="control-label">Empresa</label>
                          <div class="controls">
                            <select id="Empresa">
                            </select>
                            <span class="help-inline"></span>
                          </div>
                        </div>
                        <div class="control-group">
                          <label for="selectError" class="control-label">Proyecto</label>
                          <div class="controls">
                            <select id="Proyecto">
                            </select>
                            <span class="help-inline"></span>
                          </div>
                        </div>
                      </fieldset>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="span7">
            <div id="accordion2" class="accordion">
              <div class="accordion-group">
                <div class="accordion-heading">
                  <a class="accordion-toggle" data-toggle="collapse" href="#control2" data-original-title="">
                  <i class="icon-list-alt icon-white"></i> <span class="divider-vertical"></span> Contactos <i class="icon-chevron-down icon-white pull-right"></i>
                  </a>
                </div>
                <div id="control2" class="accordion-body collapse in">
                  <div class="accordion-inner paddind">
                    <table class="table table-bordered table-striped pull-left" id="tabla-contactos">
                      <thead>
                        <tr>
                          <td>Asignado</td>
                          <td>Nombre</td>
                          <td>Correo Electrónico</td>
                        </tr>
                      </thead>
                      <tbody id="contactos-body">
                      </tbody>
                      <tfoot>
                        <tr>
                          <td colspan="3"></td>
                        </tr>
                      </tfoot>
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
