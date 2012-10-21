
<div id="content" class="span9 section-body">
<?php echo form_open_multipart(); ?>
<?php echo form_close(); ?> 
                    <div id="section-body" class="tabbable"> <!-- Only required for left/right tabs -->
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab1" data-toggle="tab">Datos Básicos</a></li>
                            <li><a href="#tab2" data-toggle="tab">Información de Contactos</a></li>
                            <li><a href="#tab3" data-toggle="tab">Descripción del Cliente</a></li>
                            <li><a href="#tab4" data-toggle="tab">Interpretación de Usuario</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab1">
                                <!--/Tabs2-->
                                <!--Tabs3-->
                                <div class="row-fluid">
                                    <div class="span12">
                                        <div id="accordion1" class="accordion">
                                            <div class="accordion-group">
                                                <div class="accordion-heading">
                                                    <a class="accordion-toggle" data-toggle="collapse" href="#control" data-original-title="">
                                                        <i class="icon-list-alt icon-white"></i> <span class="divider-vertical"></span> Datos de la Empresa<i class="icon-chevron-down icon-white pull-right"></i>
                                                    </a>
                                                </div>
                                                <div id="control" class="accordion-body collapse in">
                                                    <div class="accordion-inner paddind">
                                                        <form class="form-horizontal">
                                                            <fieldset>
                                                                <div class="control-group">
                                                                    <label for="focusedInput" class="control-label">Nombre de Proyecto.</label>
                                                                    <div class="controls">
                                                                        <input type="text"  id="nombre_proyecto" name="nombre_proyecto" value="" id="focusedInput" class="input-xlarge focused">
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
                                                                    <button class="btn btn-primary" id="GuardarTodo" type="button">Guardar</button>
                                                                    <button class="btn">Cancelar</button>
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
                                    <div class="span6">
                                        <div id="accordion1" class="accordion">
                                            <div class="accordion-group">
                                                <div class="accordion-heading">
                                                    <a class="accordion-toggle" data-toggle="collapse" href="#event" data-original-title="">
                                                        <i class="icon-bookmark icon-white"></i> <span class="divider-vertical"></span> Agregar Contacto <i class="icon-chevron-down icon-white pull-right"></i>
                                                    </a>
                                                </div>
                                                <div id="event" class="accordion-body collapse in">
													<div class="accordion-inner paddind">
                                                        <form class="form-horizontal">
														<table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th>Contactos Guardados</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="contactos-body-guardados">
															<tr><td><input type="text" style="min-width:400px;" class='input' id="demo-input-local" name="blah" /><br /></td></tr>
                                                            </tbody>
															<tfoot>
															<tr>
																<td>
																</td>
															</tr>
															</tfoot>
                                                        </table><br /><br />
															<table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th>Nombre</th>
                                                                    <th>Telefonos</th>
                                                                    <th>Acción</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="contactos-body">
                                                            </tbody>
															<tfoot>
															<tr>
																<td colspan="4" style="text-align:right;">
																</td>
															</tr>
															</tfoot>
                                                        </table><br />
														</form>
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
												<div class="accordion-inner paddind">
                                                        <form class="form-horizontal">
                                                            <fieldset>
                                                                <div class="control-group">
                                                                    <label for="focusedInput" class="control-label">Nombre</label>
                                                                    <div class="controls">
                                                                        <input type="text" value="" id="contacto-nombre" class="input-xlarge focused">
                                                                    </div>
                                                                </div>
                                                                <div class="control-group">
                                                                    <label for="focusedInput" class="control-label">Apellido Paterno</label>
                                                                    <div class="controls">
                                                                        <input type="text" value="" id="contacto-ap" class="input-xlarge focused">
                                                                    </div>
                                                                </div>
                                                                <div class="control-group">
                                                                    <label for="focusedInput" class="control-label">Apellido Materno</label>
                                                                    <div class="controls">
                                                                        <input type="text" value="" id="contacto-am" class="input-xlarge focused">
                                                                    </div>
                                                                </div>
                                                                <div class="control-group">
                                                                    <label for="focusedInput"  class="control-label">Correo Electrónico</label>
                                                                    <div class="controls">
                                                                        <input type="text" value="" id="contacto-email" class="input-xlarge focused">
                                                                    </div>
                                                                </div>
                                                                <div class="control-group">
                                                                    <label for="optionsCheckbox2" class="control-label">Pregunta al Cliente</label>
                                                                    <div class="controls">
                                                                        <label class="checkbox">
                                                                            <input type="checkbox" value="option1" id="contacto-enviar">
                                                                            Se pueden enviar correos?
                                                                        </label>
                                                                    </div>
                                                                </div>
															<table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th>Descripción</th>
                                                                    <th>Telefono</th>
                                                                    <th>Extensión</th>
                                                                    <th>Acción</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="contacto-telefonos-body">
                                                            </tbody>
															<tfoot>
															<tr>
																<td colspan="4" style="text-align:right;">
																</td>
															</tr>
															<tr>
																<td colspan="4" style="text-align:right;">
                                                                    <button class="btn btn-primary" type="button" id="contacto-nuevo-telefono">Nuevo</button>
																</td>
															</tr>
															</tfoot>
                                                        </table><br />
                                                                <div class="form-actions">
                                                                    <button class="btn btn-primary" id="agrega-contacto-arreglo" type="button">Agregar</button>
                                                                    <button class="btn">Limpiar</button>
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
                                <textarea id="descripcionCliente" name="descripcionUsuario" class="textarea" placeholder="Descripción ..." style="width: 810px; height: 400px"></textarea>
                            </div>
                            <div class="tab-pane" id="tab4">
                                <textarea id="descripcionUsuario" name="descripcionAEV" class="textarea" placeholder="Descripción ..." style="width: 810px; height: 400px"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
