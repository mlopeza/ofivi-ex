<div id="content" class="span9 section-body">

                    <div id="section-body" class="tabbable"> <!-- Only required for left/right tabs -->
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab1" data-toggle="tab">Contrato Legal</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab1">

                                <div class="row-fluid">
                                    <!--Tabs2-->
                                    <div class="span7">
                                        <div id="accordion1" class="accordion">
                                            <div class="accordion-group">
                                                <div class="accordion-heading">
                                                    <a class="accordion-toggle" data-toggle="collapse" href="#notification" data-original-title="">
                                                        <i class="icon-th icon-white"></i> <span class="divider-vertical"></span>  Subir Contrato Legal <i class="icon-chevron-down icon-white pull-right"></i>
                                                    </a>
                                                </div>
                                                <div id="notification" class="accordion-body collapse in">
                                                    <div class="accordion-inner paddind">
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
													<!--?php echo $error;? -->

													<?php
														$attributes = array('id' => 'subir-contrato', 'class' => 'clearfix' , 'autocomplete' => 'off');
														//echo form_open('subirContrato/do_upload',$attributes);
														echo form_open_multipart('subirContratoLegal/do_upload',$attributes);
													?>
													<div class="control-group">
														<label for="tituloContrato" class="control-label">Titulo del contrato</label>
														<div class="controls">
															<input type="hidden" id='idProyectoContrato' name='idProyectoContrato' value=''/>
															<input type="text"  id="tituloContrato" name="tituloContrato" value="" class="input-xlarge focused">
															<span class="help-inline"></span>
														</div>
													</div>
													<div class="control-group">
														<label for="archivoContrato" class="control-label">Archivo del contrato</label>
														<div class="controls">
															<input type="file"  id="archivoContrato" name="archivoContrato">
															<span class="help-inline"></span>
														</div>
														
													</div>
													<div class="form-actions">
														<button class="btn btn-primary" id="uploadFile" type="button">Subir archivo</button>
														<button class="btn">Cancelar</button>
													</div>
													<?php
														echo form_close();
													?>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div></div>
                            </div>
                        </div>
                    </div>
                </div>
