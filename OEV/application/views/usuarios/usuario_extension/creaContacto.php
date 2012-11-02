
<div id="content" class="span9 section-body">
<?php echo form_open_multipart(); ?>
<?php echo form_close(); ?> 
                    <div id="section-body" class="tabbable"> <!-- Only required for left/right tabs -->
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab1" data-toggle="tab">Crear Contacto</a></li>
                        </ul>
                        <div class="tab-content">                            
									<div class="tab-pane active" id="tab1">
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
																<br /><br />
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
                                                        <button class="btn btn-primary" id="GuardarTodo" type="button">Guardar</button><br/><br/>
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
                                                                    <label for="focusedInput"  class="control-label">Puesto</label>
                                                                    <div class="controls">
                                                                        <input type="text" value="" id="contacto-puesto" class="input-xlarge focused">
                                                                    </div>
                                                                </div>
                                                                <div class="control-group">
                                                                    <label for="focusedInput"  class="control-label">Departamento</label>
                                                                    <div class="controls">
                                                                        <input type="text" value="" id="contacto-departamento" class="input-xlarge focused">
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
                                                                    <th>Lada</th>
                                                                    <th>Telefono</th>
                                                                    <th>ext</th>
                                                                    <th>Extra</th>
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
                        </div>
                    </div>
                </div>
