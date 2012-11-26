<div id="content" class="span9 section-body">
  <div id="section-body" class="tabbable">
    <!-- Only required for left/right tabs -->
    <ul class="nav nav-tabs">
      <li id="pes1" class="active"><a href="#tab1" data-toggle="tab">Crear Contacto</a></li>
      <li id="pes2" ><a href="#tab2" data-toggle="tab" id="tab-contactos" >Lista de Contactos</a></li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane active" id="tab1">
        <div class="row-fluid">
          <!--Tabs3-->
          <div class="span4">
            <div id="accordion1" class="accordion">
              <div class="accordion-group">
                <div class="accordion-heading">
                  <a class="accordion-toggle" data-toggle="collapse" href="#control" data-original-title="">
                  <i class="icon-list-alt icon-white"></i> <span class="divider-vertical"></span> Datos de la Empresa<i class="icon-chevron-down icon-white pull-right"></i>
                  </a>
                </div>
                <div id="control" class="accordion-body collapse in">
                  <div class="accordion-inner paddind" style="overflow: auto;">
                    <form class="form-vertical">
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
                      </fieldset>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="span8">
            <div id="accordion2" class="accordion">
              <div class="accordion-group">
                <div class="accordion-heading">
                  <a class="accordion-toggle" data-toggle="collapse" href="#statements" data-original-title="">
                  <i class="icon-globe icon-white"></i> <span class="divider-vertical"></span><span id="edicion-contacto">Crear</span> Contacto <i class="icon-chevron-down icon-white pull-right"></i>
                  </a>
                </div>
                <div id="statements" class="accordion-body collapse in">
                  <div class="accordion-inner paddind">
                    <input type="hidden" value="" id="idContacto"/>
                    <form class="form-horizontal">
                      <fieldset>
                        <div class="control-group">
                          <label for="focusedInput" class="control-label">Nombre</label>
                          <div class="controls">
                            <input type="text" value="" id="contacto-nombre" class="input-xlarge focused" />
                          </div>
                        </div>
                        <div class="control-group">
                          <label for="focusedInput" class="control-label">Apellido Paterno</label>
                          <div class="controls">
                            <input type="text" value="" id="contacto-ap" class="input-xlarge focused" />
                          </div>
                        </div>
                        <div class="control-group">
                          <label for="focusedInput" class="control-label">Apellido Materno</label>
                          <div class="controls">
                            <input type="text" value="" id="contacto-am" class="input-xlarge focused" />
                          </div>
                        </div>
                        <div class="control-group">
                          <label for="focusedInput" class="control-label">Correo Electrónico</label>
                          <div class="controls">
                            <input type="text" value="" id="contacto-email" class="input-xlarge focused" />
                          </div>
                        </div>
                        <div class="control-group">
                          <label for="focusedInput" class="control-label">Puesto</label>
                          <div class="controls">
                            <input type="text" value="" id="contacto-puesto" class="input-xlarge focused" />
                          </div>
                        </div>
                        <div class="control-group">
                          <label for="focusedInput" class="control-label">Departamento</label>
                          <div class="controls">
                            <input type="text" value="" id="contacto-departamento" class="input-xlarge focused" />
                          </div>
                        </div>
                        <div class="control-group">
                          <label for="optionsCheckbox2" class="control-label">Pregunta al Cliente</label>
                          <div class="controls">
                            <label class="checkbox">
                            <input type="checkbox" value="option1" id="contacto-enviar" />
                            Se pueden enviar correos?
                            </label>
                          </div>
                        </div>
                        <table class="table table-bordered">
                          <thead>
                            <tr>
                              <th>Descripción</th>
                              <th>Lada</th>
                              <th>Telefono</th>
                              <th>ext</th>
                              <th>SubExt.</th>
                              <th>Acción</th>
                            </tr>
                          </thead>
                          <tbody id="contacto-telefonos-body">
                          </tbody>
                          <tfoot>
                            <tr>
                              <td colspan="6" style="text-align:right;">
                              </td>
                            </tr>
                            <tr>
                              <td colspan="6" style="text-align:right;">
                                <button class="btn btn-primary" type="button" id="contacto-nuevo-telefono">Nuevo</button>
                              </td>
                            </tr>
                          </tfoot>
                        </table>
                        <br />
                        <div class="form-actions">
                          <button class="btn btn-primary" id="agrega-contacto-arreglo" type="button">Guardar</button>
                          <button class="btn" id="limpiar-contacto" type="button">Limpiar</button>
                        </div>
                      </fieldset>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane" id="tab2">
        <div class="row-fluid">
          <!--Tabs3-->
          <div class="span7">
            <div id="accordion1" class="accordion">
              <div class="accordion-group">
                <div class="accordion-heading">
                  <a class="accordion-toggle" data-toggle="collapse" href="#control-contactos" data-original-title="">
                  <i class="icon-list-alt icon-white"></i> <span class="divider-vertical"></span> Contactos de la Empresa<i class="icon-chevron-down icon-white pull-right"></i>
                  </a>
                </div>
                <div id="control-contactos" class="accordion-body collapse in">
                  <div class="accordion-inner" style="overflow: auto;">
                    <table id="tabla-contactos" class="table table-bordered pull-left">
                      <thead><tr><th>Departamento</th><th>Puesto</th><th>Nombre</th><th>Correo Electrónico</th><th>Acción</th></tr></thead>
                    </table>
                    <br/><br/><br/>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="span5">
            <div id="accordion1" class="accordion">
              <div class="accordion-group">
                <div class="accordion-heading">
                  <a class="accordion-toggle" data-toggle="collapse" href="#control-contactos-t" data-original-title="">
                  <i class="icon-list-alt icon-white"></i> <span class="divider-vertical"></span> Telefonos de contacto<i class="icon-chevron-down icon-white pull-right"></i>
                  </a>
                </div>
                <div id="control-contactos-t" class="accordion-body collapse in">
                  <div class="accordion-inner" style="overflow: auto;">
                    <div><strong>Recibe Correos:</strong><span id="RecibeCorreos">..</span></div>
                    <table id="tabla-telefono" class="table table-bordered pull-left">
                      <thead><tr><th>Descripción</th><th>Lada</th><th>Telefono</th><th>Extensión</th><th>SubExtensión</th></tr></thead>
                      <tbody></tbody>
                    </table>
                    <br/><br/><br/>
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
