<div id="content" class="span9 section-body">
  <input type="hidden" value="" id="idProyecto" />
  <link href="<?php echo base_url("css/popup-window.css");?> " rel="stylesheet">

  <?php echo form_open_multipart(); ?>
  <?php echo form_close(); ?> 
  <div id="section-body" class="tabbable">
    <!-- Only required for left/right tabs -->
    <ul class="nav nav-tabs">
      <li class="active"><a href="#tab1" data-toggle="tab">Datos Básicos</a></li>
      <li><a href="#tab2" data-toggle="tab">Información de Contactos</a></li>
      <li><a href="#tab3" data-toggle="tab">Descripción del Cliente</a></li>
      <li><a href="#tab4" data-toggle="tab">Interpretación de Usuario</a></li>
    </ul>
    <div class="tab-content">
      <div style="margin-bottom:5px;padding:5px;background: #333333;text-shadow: 1px 1px #222222;color: #FFFFFF;font-size:large">
        <span style="font-weight:bold;margin-left:20px;">Grupo:</span>
        <span class="Grupo-Breadcrumb"></span>
        <span style="font-weight:bold;margin-left:20px;">Empresa:</span>
        <span class="Empresa-Breadcrumb"></span>
        <span style="font-weight:bold;margin-left:20px;">Proyecto:</span>
        <span class="Proyecto-Breadcrumb"></span>
      </div>
      <div class="tab-pane active" id="tab1">
        <div class="row-fluid">
          <div class="span5">
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
                          <label for="focusedInput" class="control-label">Nombre de Proyecto.</label>
                          <div class="controls">
                            <input type="text" id="nombre_proyecto" name="nombre_proyecto" value="" id="focusedInput" class="input-large focused" />
                          </div>
                        </div>
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
                        <div class="form-actions">
                          <button class="btn btn-primary GuardarTodo" id="GuardarTodo" type="button">Guardar Proyecto</button>
                        </div>
                      </fieldset>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="span7">
            <div id="accordion1" class="accordion">
              <div class="accordion-group">
                <div class="accordion-heading">
                  <a class="accordion-toggle" data-toggle="collapse" href="#control2222" data-original-title="">
                  <i class="icon-list-alt icon-white"></i> <span class="divider-vertical"></span> Categorías del Proyecto<i class="icon-chevron-down icon-white pull-right"></i>
                  </a>
                </div>
                <div id="control2222" class="accordion-body collapse in">
                  <div class="accordion-inner paddind" style="overflow: auto;">
                    <div id="accordion" class="ui-accordion ui-widget ui-helper-reset ui-accordion-icons" role="tablist">
                      <?php
                        if(sizeof($supra) == 0){
                        ?>
                      <div>No Hay Categorías Registradas</div>
                      <br />
                      <?php
                        }
                        foreach($supra as $s){
                        $contador=0; $imprimi=0;
                        ?>
                      <div>
                        <h3 class="ui-accordion-header ui-helper-reset ui-state-default ui-state-active ui-corner-top ui-state-focus" role="tab" aria-expanded="true" aria-selected="true" tabindex="0"><span class="ui-icon ui-icon-triangle-1-s">
                          </span><a href="#"><?php echo $s['Supra']->Nombre; ?></a>
                        </h3>
                        <div class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom ui-accordion-content-active" style="height: 31px; " role="tabpanel">
                          <?php
                            if(sizeof($s['Categorias']) == 0){
                            		?>
                          <div class="span12">No hay Categorias</div>
                        </div>
                      </div>
                      <?php
                        continue;
                        }
                                 ?>
                      <?php foreach($s['Categorias'] as $sub){
                        if($contador%2 == 0){echo '<div class="row-fluid">';$contador++;}                            
                        ?>
                      <div class="span5"><?php $imprimi++; echo $sub->Categoria;?></div>
                      <div class="span1"><input type="checkbox" class="categoriaCheckbox" id="<?php echo $sub->idCategoria;?>" idSupraCategoria="<?php echo $sub->idSupraCategoria;?>" /></div>
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
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="tab-pane" id="tab2">
    <div class="row-fluid">
      <div class="span6">
        <div id="accordion1" class="accordion">
          <div class="accordion-group">
            <div class="accordion-heading">
              <a class="accordion-toggle" data-toggle="collapse" href="#event" data-original-title="">
              <i class="icon-bookmark icon-white"></i> <span class="divider-vertical"></span> Agregar Contacto <i class="icon-chevron-down icon-white pull-right"></i>
              </a>
            </div>
            <div id="event" class="accordion-body collapse in">
              <div class="accordion-inner paddind" style="overflow: auto;">
                <fieldset>
                  <form class="form-horizontal">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Contactos Guardados</th>
                        </tr>
                      </thead>
                      <tbody id="contactos-body-guardados">
                        <tr>
                          <td><input type="text" style="max-width:400px;" class="input" id="demo-input-local" name="blah" /><br /></td>
                        </tr>
                      </tbody>
                      <tfoot>
                        <tr>
                          <td>
                          </td>
                        </tr>
                      </tfoot>
                    </table>
                  </form>
                </fieldset>
                <div class="form-actions">
                  <button class="btn btn-primary GuardarTodo" id="GuardarTodo" type="button">Guardar Proyecto</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--Tabs3-->
      <div class="span6">
        <div id="accordion2" class="accordion">
          <div class="accordion-group">
            <div class="accordion-heading">
              <a class="accordion-toggle" data-toggle="collapse" href="#statements" data-original-title="">
              <i class="icon-globe icon-white"></i> <span class="divider-vertical"></span> Crear Contacto <i class="icon-chevron-down icon-white pull-right"></i>
              </a>
            </div>
            <div id="statements" class="accordion-body collapse in">
              <div class="accordion-inner paddind" style="overflow: auto;">
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
                          <th>Ext.</th>
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
                      <button class="btn btn-primary" id="agrega-contacto-arreglo" type="button">Guardar Contacto</button>
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
  <div class="tab-pane" id="tab3">
    <fieldset />
    <textarea id="descripcionCliente" name="descripcionUsuario" class="textarea" placeholder="Descripci&oacute;n ..." style="width: 810px; height: 400px"></textarea>
    <div class="form-actions">
      <button class="btn btn-primary GuardarTodo" id="GuardarTodo" type="button">Guardar Proyecto</button>
      <button class="btn btn-primary Ventana" id="ventana" type="button">Ventana</button>
      <div   class="popup_window_css" id="sample">
		<table class="popup_window_css">
			<tr    class="popup_window_css">
				<td    class="popup_window_css">
					<div   class="popup_window_css_head"><img src="images/close.gif" alt="" width="9" height="9" />Informaci&oacute;n de proyecto </div>
						<div   class="popup_window_css_body">
                        	<div style="border: 1px solid #808080; padding: 6px; background: #FFFFFF;" id='texto'>
						</div>
                    </div>
					<div   class="popup_window_css_foot"><img src="images/about.gif" alt="" width="6" height="6" />
                    </div>
               </td>
           </tr>
        </table>
    </div>
    </div>
  </div>
  <div class="tab-pane" id="tab4">
    <fieldset />
    <textarea id="descripcionUsuario" name="descripcionAEV" class="textarea" placeholder="Descripci&oacute;n ..." style="width: 810px; height: 400px"></textarea>
    <div class="form-actions">
      <button class="btn btn-primary GuardarTodo" id="GuardarTodo" type="button">Guardar Proyecto</button>
    </div>
  </div>
</div>
</div>
</div>
