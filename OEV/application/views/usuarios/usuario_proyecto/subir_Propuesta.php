<div id="section-body" class="tabbable"> <!-- Only required for left/right tabs -->
                        
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab1">

                                
                                <div class="row-fluid">
                                    <div class="span8">
                                        <div id="accordion3" class="accordion">
                                            <div class="accordion-group">
                                                <div class="accordion-heading">
                                                    <a class="accordion-toggle" data-toggle="collapse" href="#event" data-original-title="">
                                                        <i class="icon-comment icon-white"></i> <span class="divider-vertical"></span>Agregar Propuesta de proyecto<i class="icon-chevron-down icon-white pull-right"></i>
                                                    </a>
                                                </div>
                                                <div id="notification" class="accordion-body collapse in">
													<div class="accordion-inner paddind">
                                                    <!--Elemento 1-->
                                                    <table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th>Proyectos Actuales</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="proyectos-body">
                                                            </tbody>
                                                            <?php
                                                            if(empty($proyectos)) {
																?>
																<tr class="colorea-proyecto" idProyecto="-1" class="tabla-proyectos">
                                                                       <td>No hay proyectos para este usuario</td>
                                                                </tr>
															<?php }else 
                                                                foreach($proyectos as $proyecto){
                                                            ?>
                                                                <tr class="colorea-proyecto" idProyecto="<?php echo $proyecto->idProyecto; ?>" class="tabla-proyectos">
                                                                       <td><?php echo $proyecto->nombre; ?></td>
                                                                </tr>
                                                            <?php }
                                                            ?>
															<tfoot>
															<tr>
																<td colspan="3" style="text-align:right;">
																</td>
															</tr>
															</tfoot>
                                                        </table>
                                                        <br/>
                                                    </div>
											</div>
											<!--------------->
											<div id="notification" class="accordion-body collapse in">
												<div class="accordion-inner paddind">
													<div class="control-group">
														<label for="tituloPropuesta" class="control-label">Titulo de la propuesta</label>
														<div class="controls">
															<input type="hidden" id='idProyectoPropuesta' value=''/>
															<input type="text"  id="tituloPropuesta" name="tituloPropuesta" value="" class="input-xlarge focused">
															<span class="help-inline"></span>
														</div>
														<div class="controls">
															<label class="checkbox">
                                                            <input type="checkbox" name="reporteFinal" value="1" id="reporteFinal">
																¿Aceptada?
                                                            </label>
                                                        </div>
													</div>
													<div class="control-group">
														<label for="archivoPropuesta" class="control-label">Archivo de la propuesta</label>
														<div class="controls">
															<input type="file"  id="tituloPropuesta" name="tituloPropuesta">
															<span class="help-inline"></span>
														</div>
														
													</div>
													<div class="form-actions">
														<button class="btn btn-primary" id="GuardarTodo" type="button">Guardar</button>
														<button class="btn">Cancelar</button>
													</div>
													<!----------------->
												</div>
											</div>
										</div>
                                    </div>
                            </div>
                        </div>
                    </div>
                    </div>
