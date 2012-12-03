<div id="content" class="span9 section-body">
  <input type="hidden" value="" id="idProyecto" />
  <?php echo form_open_multipart(); ?>
  <?php echo form_close(); ?> 
  <div id="section-body" class="tabbable">
    <!-- Only required for left/right tabs -->
    <ul class="nav nav-tabs">
      <li class="active"><a href="#tab1" data-toggle="tab">Editar Proyecto</a></li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane active" id="tab1">
        <div class="row-fluid">
          <div class="span12">
            <div id="accordion1" class="accordion">
              <div class="accordion-group">
                <div class="accordion-heading">
                  <a class="accordion-toggle" data-toggle="collapse" href="#control" data-original-title="">
                  <i class="icon-list-alt icon-white"></i> <span class="divider-vertical"></span>Proyectos<i class="icon-chevron-down icon-white pull-right"></i>
                  </a>
                </div>
                <div id="control" class="accordion-body collapse in">
                  <div class="accordion-inner paddind" style="overflow: auto;">
                    <table id="tabla-proyectos" class="table table-bordered pull-left">
                      <thead>
                        <tr>
                          <th>Grupo</th>
                          <th>Empresa</th>
                          <th>Proyecto</th>
                          <th>Acción</th>
                        </tr>
                      </thead>
                    </table>
                    <br /><br /><br />
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
