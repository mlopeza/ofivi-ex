<div id="content" class="span9 section-body">
  <div id="section-body" class="tabbable">
    <!-- Only required for left/right tabs -->
    <ul class="nav nav-tabs">
      <li class="active"><a href="#tab1" data-toggle="tab">Usuarios</a></li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane active" id="tab1">
        <div class="row-fluid">
          <!--Tabs2-->
          <div class="span15" style="min-width:2500px;">
            <div id="accordion1" class="accordion">
              <div class="accordion-group">
                <div class="accordion-heading">
                  <a class="accordion-toggle" data-toggle="collapse" href="#notification" data-original-title="">
                  <i class="icon-th icon-white"></i> <span class="divider-vertical"></span>  Usuarios Actuales <i class="icon-chevron-down icon-white pull-right"></i>
                  </a>
                </div>
                <div id="notification" class="accordion-body collapse in">
                  <div class="accordion-inner paddind">
                    <table class="table table-bordered table-striped pull-left" id="example">
                      <thead>
                        <tr>
                          <th>Username</th>
                          <th>Campus</th>
                          <th>Escuela</th>
                          <th>Departamento</th>
                          <th>Nombre</th>
                          <th>Correo</th>
                          <th>Acción</th>
                        </tr>
                      </thead>
                      <?php foreach($data->result() as $row){ ?>
                      <tr>
                        <td id="username" value="<?php echo $row->idUsuario; ?>"><?php echo $row->Usuario; ?></td>
                        <td id="campus" value=""><?php echo $row->Campus; ?></td>
                        <td id="escuela" value=""><?php echo $row->Escuela; ?></td>
                        <td id="departamento" value="<?php echo $row->idDepartamento; ?>"><?php echo $row->Departamento; ?></td>
                        <td id="nombre"><?php echo $row->Nombre; ?></td>
                        <td id="email"><?php echo $row->Email;?></td>
                        </td>
                        <td style="text-align:center;">
                          <button class="btn btn-danger rechazar-usuario">Dar de Baja</button> 
                        </td>
                      </tr>
                      <?php 
                        }; ?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <th>Username</th>
                          <th>Campus</th>
                          <th>Escuela</th>
                          <th>Departamento</th>
                          <th>Nombre</th>
                          <th>Correo</th>
                          <th>Acción</th>
                        </tr>
                      </tfoot>
                    </table>
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
