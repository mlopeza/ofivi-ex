<?php echo form_open_multipart(); ?>
<?php echo form_close(); ?> 
<div id="content" class="span9 section-body">

                    <div id="section-body" class="tabbable"> <!-- Only required for left/right tabs -->
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
                                                        <i class="icon-th icon-white"></i> <span class="divider-vertical"></span>  Solicitudes de Acceso <i class="icon-chevron-down icon-white pull-right"></i>
                                                    </a>
                                                </div>
                                                <div id="notification" class="accordion-body collapse in">
                                                    <div class="accordion-inner paddind">
                                                        <table  class="table table-bordered table-striped pull-left" id="example" >
                                                            <thead>
                                                                <tr>
                                                                    <th>Username</th>
                                                                    <th>Campus</th>
                                                                    <th>Escuela</th>
                                                                    <th>Departamento</th>
                                                                    <th>Nombre</th>
                                                                    <th>Paterno</th>
                                                                    <th>Materno</th>
                                                                    <th>Correo</th>
                                                                    <th>Tipo</th>
                                                                    <th>Administrador</th>
                                                                    <th>AExtension</th>
                                                                    <th>UExtension</th>
                                                                    <th>UProyectos</th>
                                                                    <th>ULegal</th>
																						  <th>Cliente</th>
																						  <th>Estatus</th>
																						  <th>Acción</th>
                                                                </tr>
                                                            </thead>
															<?php foreach($data->result() as $row){ ?>
                                                                <tr>
                                                                    <td id="username" value="<?php echo $row->idUsuario; ?>"><?php echo $row->Username; ?></td>
                                                                    <td id="campus"><?php echo $row->Campus; ?></td>
                                                                    <td id="escuela"><?php echo $row->Escuela; ?></td>
                                                                    <td id="departamento" value="<?php echo $row->idDepartamento; ?>"><?php echo $row->Departamento; ?></td>
                                                                    <td id="nombre"><?php echo $row->Nombre; ?></td>
                                                                    <td id="apellido_paterno"><?php echo $row->ApellidoP; ?></td>
                                                                    <td id="apellido_materno"><?php echo $row->ApellidoM; ?></td>
                                                                    <td id="email"><?php echo $row->email; ?></td>
                                                                    <td>
																		<?php
																			echo "<select id=\"tipo_usuario\">";
																			switch($row->Tipo_Usuario){
																				case 'a':echo "<option value=\"a\">Administrador</option>"; 
																						echo "<option value=\"u\">Usuario de Extensión</option><option value=\"v\">Administrador de Extensión</option><option value=\"p\">Profesor</option>";
																						break;
																				case 'u':echo "<option value=\"u\">Usuario de Extensión</option>"; 
																						echo "<option value=\"a\">Administrador</option><option value=\"v\">Administrador de Extensión</option><option value=\"p\">Profesor</option>";
																						break;
																				case 'v':echo "<option value=\"v\">Administrador de Extensión</option>";
																						echo "<option value=\"a\">Administrador</option><option value=\"u\">Usuario de Extensión</option><option value=\"p\">Profesor</option>";
																						break;
																				case 'p':echo "<option value=\"p\">Profesor</option>";
																						echo "<option value=\"a\">Administrador</option><option value=\"u\">Usuario de Extensión</option><option value=\"v\">Administrador de Extensión</option>";
																						break;
																			} 
																			echo "</select>";


																		?>
																	</td>
                                                                    <td><?php echo evalua_tipo_boton(ord($row->Vista_Administrador),'vista_administrador'); ?></td>
                                                                    <td><?php echo evalua_tipo_boton(ord($row->Vista_Supervisor_Extension),'vista_supervisor_extension'); ?></td>
                                                                    <td><?php echo evalua_tipo_boton(ord($row->Vista_Usuario_Extension),'vista_usuario_extension'); ?></td>
                                                                    <td><?php echo evalua_tipo_boton(ord($row->Vista_Profesor),'vista_profesor'); ?></td>
																	<td><?php echo evalua_tipo_boton(ord($row->Vista_Cliente),'vista_cliente'); ?></td>
																	<td><?php echo evalua_tipo_boton(ord($row->Vista_Legal),'vista_legal'); ?></td>
																	<td>
																		<?php 
																				switch($row->Usuario_Aceptado){
																						case 'a': echo "Aceptado";break;
																						case 'e': echo "En espera";break;
																						case 'r': echo "Rechazado";break;
																				}

																		?>

																	</td>
																						  <td style="text-align:center;">
																						  		<button class="btn btn-primary accept-user">Aceptar</button>
																						  		<button class="btn btn-danger reject-user">Rechazar</button>
																						  </td>
                                                                </tr>
															<? }; ?>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <th>Username</th>
                                                                    <th>Campus</th>
                                                                    <th>Escuela</th>
                                                                    <th>Departamento</th>
                                                                    <th>Nombre</th>
                                                                    <th>Paterno</th>
                                                                    <th>Materno</th>
                                                                    <th>Correo</th>
                                                                    <th>Tipo</th>
                                                                    <th>Administrador</th>
                                                                    <th>AExtension</th>
                                                                    <th>UExtension</th>
                                                                    <th>UProyectos</th>
                                                                    <th>ULegal</th>
																						  <th>Cliente</th>
																						  <th>Estatus</th>
																						  <th>Acción</th>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                        <br />

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div></div>

                            </div>
                        </div>
                    </div>
                </div>
