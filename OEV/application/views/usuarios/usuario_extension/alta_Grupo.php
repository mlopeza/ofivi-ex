<div id="section-body" class="tabbable">
  <!-- Only required for left/right tabs -->
  <div class="tab-content">
    <div class="tab-pane active" id="tab1">
      <div class="row-fluid">
        <div class="span8">
          <div id="accordion3" class="accordion">
            <div class="accordion-group">
              <div class="accordion-heading">
                <a class="accordion-toggle" data-toggle="collapse" href="#event" data-original-title="">
                <i class="icon-comment icon-white"></i> <span class="divider-vertical"></span>Crear Grupos<i class="icon-chevron-down icon-white pull-right"></i>
                </a>
              </div>
              <div id="notification" class="accordion-body collapse in">
                <div class="accordion-inner paddind">
                  <?php
                    $attributes = array('id' => 'auth-for', 'class' => 'clearfix form-horizontal' , 'autocomplete' => 'off');
                    echo form_open('altaGrupo/alta',$attributes);
                    ?>
                  <br /><br /><br />
                  <fieldset>
                    <div class="control-group">
                      <label for="focusedInput" class="control-label">Nombre Grupo</label>
                      <div class="controls">
                        <input type="text" value="" name="nombre_grupo" id="nombre_grupo" class="input-xlarge focused" />
                      </div>
                    </div>
                    <div class="form-actions">
                      <button class="btn btn-primary" type="submit">Guardar</button>
                    </div>
                  </fieldset>
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
