<link href="<?php echo base_url("css/projectAdvances.css"); ?>" rel="stylesheet" />
<link href="<?php echo base_url("css/ventanas-modales.css"); ?>" rel="stylesheet" />
<div id="content" class="span9 section-body">
  <div id="section-body" class="tabbable">
    <!-- Only required for left/right tabs -->
    <ul class="nav nav-tabs">
      <li class="active"><a href="#tab1" data-toggle="tab">Avances de Proyectos</a></li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane active" id="tab1">
        <div class="row-fluid">
          <div class="span12">
            <div id="accordion1" class="accordion">
              <div class="accordion-group">
                <div class="accordion-heading">
                  <a class="accordion-toggle" data-toggle="collapse" href="#event" data-original-title="">
                  <i class="icon-bookmark icon-white"></i> <span class="divider-vertical"></span> Avances <i class="icon-chevron-down icon-white pull-right"></i>
                  </a>
                </div>
                <div id="event" class="accordion-body collapse in">
                  <div class="accordion-inner paddind">
                    <br />
                    Activo<input type="radio" name="estado" id="activo" value="1" />
                    Inactivo<input type="radio" name="estado" id="inactivo" value="0" /><br />
                    <?php
                      echo "<select id = 'sgrupo'>
                      		<option> </option>";	
                      echo "</select>";
                      echo "<select  id = 'sempresa'><option></option></select>";
                      echo "<select id = 'sproyecto'></select>\n";
                      ?>
                    <div>
                      <table id="showThis" class="table table-bordered">
                        <tr>
                          <td>
                            Contacto
                          </td>
                          <td>
                            <ul name="contacto">			
                            </ul>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            Usuarios
                          </td>
                          <td>
                            <ul name="profesor">			
                            </ul>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            Categoría
                          </td>
                          <td name="categoria">
                          </td>
                        </tr>
                        <tr>
                          <td>
                            Documentos
                          </td>
                          <td>
                            <ul name="documento">
                            </ul>
                          </td>
                        </tr>
                      </table>
                    </div>
                    <div>
                      <br />
                      <table id="showThis2" class="table table-bordered">
                        <th>
                          Status
                        </th>
                        <th>
                          Usuario
                        </th>
                        <th>
                          Fechas de modificaci&oacute;n
                        </th>
                        <tbody id="sestados">
                        </tbody>
                      </table>
                      <?php
                        echo "<input type='hidden' id='idUsuario' value=".$this->session->userdata('idUsuario')."  />";
                        ?>
                      <br />
                      <br />
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
</div>
