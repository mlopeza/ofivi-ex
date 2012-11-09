<div id="content" class="span9 section-body">

                    <div id="section-body" class="tabbable">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab1" data-toggle="tab">Modificar Reportes</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab1">

                                <div class="row-fluid">
                                    <!--Tabs2-->
                                    <div class="span12">
                                        <div id="accordion1" class="accordion">
                                            <div class="accordion-group">
                                                <div class="accordion-heading">
                                                    <a class="accordion-toggle" data-toggle="collapse" href="#notification" data-original-title="">
                                                        <i class="icon-th icon-white"></i> <span class="divider-vertical"></span> Proyectos <i class="icon-chevron-down icon-white pull-right"></i>
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
                                                            <tbody id="reportes-de-proyecto-body">
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
                                                        <br/>
                                                        
                                                        

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div> <!--  end row-fluid -->
                                <div class="row-fluid">
                                    <div class="span12">
                                        <div id="accordion2" class="accordion">
                                            <div class="accordion-group">
                                                <div class="accordion-heading">
                                                    <a class="accordion-toggle" data-toggle="collapse" href="#gallery" data-original-title="">
                                                        <i class="icon-th icon-white"></i> <span class="divider-vertical"></span> Reportes <i class="icon-chevron-down icon-white pull-right"></i>
                                                    </a>
                                                <div id="notification" class="accordion-body collapse in">
                                                    <div class="accordion-inner paddind">

                                                   <table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th>Autor</th>
                                                                    <th>Titulo</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="reportes-actuales-body"></tbody>
															<tfoot>
															<tr>
																<td colspan="3" style="text-align:right;">
																</td>
															</tr>
															</tfoot>
                                                        </table>
                                                        <br/>
                                                    </div>
                                                    <?php
															$attributes = array('id' => 'reporte-proyecto', 'class' => 'clearfix' , 'autocomplete' => 'off');
															echo form_open('modificarReportes/modificaReporte',$attributes);
													?>

												    <textarea style="width:98%; height: 100%;" id="reporteProyecto" name="reporteProyecto" class="textarea" placeholder="Seleccione reporte..." style="width: 800px; height: 200px"></textarea>

													<input type='hidden' name='idReporteHidden' id='idReporteHidden' value=''/>
													<div class="form-actions">
															<button class="btn btn-primary" id="GuardarReporte" type="button">Guardar Cambios</button>
                                                    </div>
													</div>
													<?php
														echo form_close();
													?>     
                                                        
                                                        

                                                    </div>
                                                </div>
                                                </div>
                                                
                                            </div>

                                        </div>
                                    </div>
                                </div><!--  end row-fluid -->
                            </div>
                        </div>
                    </div>
                </div>
