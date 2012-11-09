<div id="content" class="span9 section-body">

                    <div id="section-body" class="tabbable">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab1" data-toggle="tab">Crear Reportes</a></li>
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
                                                        <i class="icon-th icon-white"></i> <span class="divider-vertical"></span> Reporte <i class="icon-chevron-down icon-white pull-right"></i>
                                                    </a>
                                                </div>
                                                <div id="notification" class="accordion-body collapse in">
                                                    <div class="accordion-inner paddind">
                                                        <!----->
                                                        <?php
															$attributes = array('id' => 'reporte-profesor', 'class' => 'clearfix' , 'autocomplete' => 'off');
															echo form_open('generaReporte/alta',$attributes);
														?>
														<div class="control-group">		
															<label for="selectError" class="control-label">Proyecto</label>
															<div class="controls">
																<select id="idProyecto" name="idProyecto" style="width:520px;">
																	<?php
																		foreach($proyectos as $row){
																		echo '<option value='.$row->idProyecto.'>'.$row->nombre.'</>';
																	}?>
																</select>
															</div>
														</div>
														<div class="control-group">
															<label for="focusedInput" class="control-label">Titulo del reporte</label>
															<div class="controls">
																<input type="text" value="" name="titulo" id="titulo" class="input-xlarge focused">
															</div>
                                                        </div>
														<div class="tab-pane">
															<textarea id="reporteProyecto" name="reporteProyecto" class="textarea" placeholder="Escribe reporte ..." style="width: 520px; height: 200px"></textarea>
														</div>
														<div class="controls">
															<label class="checkbox">
                                                            <input type="checkbox" name="reporteFinal" value="1" id="reporteFinal">
																Reporte final
                                                            </label>
                                                        </div>
														<div class="form-actions">
															<button class="btn btn-primary" id="GuardarReporte" type="button">Guardar</button>
                                                        </div>
														<?php
														echo form_close();
														?>
                                                        
                                                        
                                                        

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div> <!--  end row-fluid -->
                            </div>
                        </div>
                    </div>
                </div>
