<!-- Inicia Primera parte-->
<div id="content" class="span9 section-body">
  <div id="section-body" class="tabbable">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#tab1" data-toggle="tab" data-original-title="">Jerarquia de Empresas</a></li>
      <li><a href="#tab2" data-toggle="tab" data-original-title="">Lista de Empresas</a></li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane active" id="tab1">
        <!--/Row fluid-->
        <div class="row-fluid">
          <!--Tabs2-->
          <div class="span4">
            <div id="accordion2" class="accordion">
              <div class="accordion-group">
                <div class="accordion-heading">
                  <a href="#widget-tabs" data-toggle="collapse" class="accordion-toggle in" data-original-title="">
                  <i class="icon-th-large icon-white"></i> <span class="divider-vertical"></span> Grupos <i class="icon-chevron-down icon-white pull-right"></i>
                  </a>
                </div>
                <div class="accordion-body collapse in" id="widget-tabs">
                  <div class="accordion-inner" style="padding:5px;">
                    <!--Inner-->
                    <table id="tabla-grupos" class="table table-bordered pull-left">
                      <thead>
                        <th>Nombre</th>
                        <th>Acción</th>
                      </thead>
                    </table>
                    <!--/Inner-->                                                        
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="span4">
            <div id="accordion3" class="accordion">
              <div class="accordion-group">
                <div class="accordion-heading">
                  <a href="#annoncement" data-toggle="collapse" class="accordion-toggle in" data-original-title="">
                  <i class="icon-th-large icon-white"></i> <span class="divider-vertical"></span> Empresas <i class="icon-chevron-down icon-white pull-right"></i>
                  </a>
                </div>
                <div class="accordion-body collapse in" id="annoncement">
                  <div class="accordion-inner" style="padding:5px;">
                    <!--Inner-->
                    <table id="tabla-empresas" class="table table-bordered pull-left">
                      <thead>
                        <th>Nombre</th>
                        <th>Acción</th>
                      </thead>
                    </table>
                    <!--/Inner-->
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="span4">
            <div id="accordion4" class="accordion">
              <div class="accordion-group">
                <div class="accordion-heading">
                  <a href="#event" data-toggle="collapse" class="accordion-toggle" data-original-title="">
                  <i class="icon-th-large icon-white"></i> <span class="divider-vertical"></span> Agregar/Editar Grupo <span id="EtiquetaGrupo"></span> <i class="icon-chevron-down icon-white pull-right"></i>
                  </a>
                </div>
                <div class="accordion-body in collapse" id="event" style="height: auto;">
                  <div class="accordion-inner paddind" style="overflow: auto;">
                    <!--Elemento 2-->
                    <form class="form-vertical">
                      <fieldset>
                        <div class="control-group">
                          <label for="focusedInput" class="control-label">Grupo:</label>
                          <div class="controls">
                            <input type="text" id="grupo-input" class="informacion-extra input-large focused" />
                          </div>
                        </div>
                      </fieldset>
                    </form>
                    <div class="form-actions">
                      <button id="guardar-grupo" class="btn btn-primary" type="button">Guardar</button>
                      <button id="limpiar-grupo" class="btn" type="button">Limpiar</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div id="accordion4" class="accordion">
              <div class="accordion-group">
                <div class="accordion-heading">
                  <a href="#event10" data-toggle="collapse" class="accordion-toggle" data-original-title="">
                  <i class="icon-th-large icon-white"></i> <span class="divider-vertical"></span> Agregar/Editar Empresa <span id="EtiquetaEmpresa"></span> <i class="icon-chevron-down icon-white pull-right"></i>
                  </a>
                </div>
                <div class="accordion-body in collapse" id="event10" style="height: auto;">
                  <div class="accordion-inner paddind" style="overflow: auto;">
                    <!--Elemento 2-->
                    <form class="form-vertical">
                      <fieldset>
                        <div class="control-group">
                          <label for="focusedInput" class="control-label">Grupo:</label>
                          <div class="controls">
                            <input disabled type="text" id="empresa-grupo-input" class="informacion-extra input-large focused" />
                          </div>
                        </div>
                        <div class="control-group">
                          <label for="focusedInput" class="control-label">Nombre de Empresa:</label>
                          <div class="controls ui-widget">
                            <input type="text" id="empresa-input" class="informacion-sugerencia input-large focused" />
                          </div>
                        </div>
                      </fieldset>
                    </form>
                    <div class="form-actions">
                      <button id="guardar-empresa" class="btn btn-primary" type="button">Guardar</button>
                      <button id="limpiar-empresa" class="btn" type="button">Limpiar</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div id="accordion4" class="accordion">
              <div class="accordion-group">
                <div class="accordion-heading">
                  <a href="#event101" data-toggle="collapse" class="accordion-toggle" data-original-title="">
                  <i class="icon-th-large icon-white"></i> <span class="divider-vertical"></span> Crear Proyecto <span id="EtiquetaEmpresa"></span> <i class="icon-chevron-down icon-white pull-right"></i>
                  </a>
                </div>
                <div class="accordion-body in collapse" id="event101" style="height: auto;">
                  <div class="accordion-inner paddind" style="overflow: auto;">
                    <fieldset>
                      <table class="table table-bordered pull-left">
                        <thead>
                          <tr>
                            <th>Grupo</th>
                            <th>Empresa</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td id="grupo-creacion" idgrupo="-1"></td>
                            <td idempresa="-1" id="empresa-creacion"></td>
                          </tr>
                        </tbody>
                      </table>
                      <br /><br />
                    </fieldset>
                    <div class="form-actions">
                      <button id="crear-proyecto" class="btn btn-danger" type="button">Crear Proyecto</button>
                      <button id="crear-contacto" class="btn btn-primary" type="button">Crear Contacto</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane" id="tab2">
        <div class="span9">
          <div id="accordion3" class="accordion">
            <div class="accordion-group">
              <div class="accordion-heading">
                <a href="#annoncement2" data-toggle="collapse" class="accordion-toggle in" data-original-title="">
                <i class="icon-th-large icon-white"></i> <span class="divider-vertical"></span> Lista de Empresas <i class="icon-chevron-down icon-white pull-right"></i>
                </a>
              </div>
              <div class="accordion-body collapse in" id="annoncement2">
                <div class="accordion-inner paddind" style="padding:5px;">
                  <button id="actualizar-lista" class="btn btn-primary" type="button">Actualizar Lista</button>														
                  <br /><br />
                  <!--Inner-->
                  <table id="tabla-lista" class="table table-bordered pull-left">
                    <thead>
                      <th>Grupo</th>
                      <th>Empresa</th>
                    </thead>
                  </table>
                  <!--/Inner-->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
