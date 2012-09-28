<div id="content" class="span9 section-body">

                    <div id="section-body" class="tabbable"> <!-- Only required for left/right tabs -->
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab1" data-toggle="tab">Tables</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab1" style="min-width:2500px;">

                                <div class="row-fluid">
                                    <!--Tabs2-->
                                    <div class="span20">
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
                                                                    <td><?php echo $row->Username; ?></td>
                                                                    <td><?php echo $row->Campus; ?></td>
                                                                    <td><?php echo $row->Escuela; ?></td>
                                                                    <td><?php echo $row->Departamento; ?></td>
                                                                    <td><?php echo $row->Nombre; ?></td>
                                                                    <td><?php echo $row->ApellidoP; ?></td>
                                                                    <td><?php echo $row->ApellidoM; ?></td>
                                                                    <td><?php echo $row->email; ?></td>
                                                                    <td>
																		<?php
																			echo "<select>";
																			switch($row->Tipo_Usuario){
																				case 'a':echo "<option>Administrador</option>"; 
																						echo "<option>Usuario de Extensión</option><option>Administrador de Extensión</option><option>Profesor</option>";
																						break;
																				case 'u':echo "<option>Usuario de Extensión</option>"; 
																						echo "<option>Administrador</option><option>Administrador de Extensión</option><option>Profesor</option>";
																						break;
																				case 'v':echo "<option>Administrador de Extensión</option>";
																						echo "<option>Administrador</option><option>Usuario de Extensión</option><option>Profesor</option>";
																						break;
																				case 'p':echo "<option>Profesor</option>";
																						echo "<option>Administrador</option><option>Usuario de Extensión</option><option>Administrador de Extensión</option>";
																						break;
																			} 
																			echo "<select>";


																		?>
																	</td>
                                                                    <td><?php echo evalua_tipo_boton(ord($row->Vista_Administrador)); ?></td>
                                                                    <td><?php echo evalua_tipo_boton(ord($row->Vista_Supervisor_Extension)); ?></td>
                                                                    <td><?php echo evalua_tipo_boton(ord($row->Vista_Usuario_Extension)); ?></td>
                                                                    <td><?php echo evalua_tipo_boton(ord($row->Vista_Profesor)); ?></td>
																	<td><?php echo evalua_tipo_boton(ord($row->Vista_Cliente)); ?></td>
																	<td><?php echo evalua_tipo_boton(ord($row->Vista_Legal)); ?></td>
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
																						  		<button class="btn btn-primary">Aceptar</button>
																						  		<button class="btn btn-danger">Rechazar</button>
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
