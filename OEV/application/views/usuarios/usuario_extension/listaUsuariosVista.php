<link href="<?php echo base_url("css/projectAdvances.css"); ?>" rel="stylesheet" />
<link href="<?php echo base_url("css/ventanas-modales.css"); ?>" rel="stylesheet" />
<div id="content" class="span9 section-body">
  <?php echo form_open_multipart(); ?>
  <?php echo form_close(); ?> 
  <div id="section-body" class="tabbable">
    <!-- Only required for left/right tabs -->
    <ul class="nav nav-tabs">
      <li class="active"><a href="#tab2" data-toggle="tab">Lista de Usuarios</a></li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane active" id="tab2">
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
