<div id="content" class="span9 section-body">

                    <div id="section-body" class="tabbable">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab1" data-toggle="tab">Proyectos Externos</a></li>
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
                                                        <i class="icon-th icon-white"></i> <span class="divider-vertical"></span>  Proyectos <i class="icon-chevron-down icon-white pull-right"></i>
                                                    </a>
                                                </div>
                                                <div id="notification" class="accordion-body collapse in">
                                                    <div class="accordion-inner paddind">
                                                    <table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th>Proyectos</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="reportes-de-proyecto-body">
                                                            </tbody>
                                                            <?php
                                                            if(empty($proyectos)) {
																?>
																<tr class="colorea-proyecto" idProyecto="-1" class="tabla-proyectos">
                                                                       <td>No hay propuestas de proyectos externos</td>
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
                                            </div>

                                        </div>
                                    </div>
                                </div> <!--  end row-fluid -->
                                <div class="row-fluid">
                                    <div class="span6">
                                        <div id="accordion2" class="accordion">
                                            <div class="accordion-group">
                                                <div class="accordion-heading">
                                                    <a class="accordion-toggle" data-toggle="collapse" href="#gallery" data-original-title="">
                                                        <i class="icon-th icon-white"></i> <span class="divider-vertical"></span> Acci&oacute;n <i class="icon-chevron-down icon-white pull-right"></i>
                                                    </a>
                                                <div id="notification" class="accordion-body collapse in">
                                                    <div class="accordion-inner paddind">
														<?php
															$attributes = array('id' => 'proyecto-externo', 'class' => 'clearfix' , 'autocomplete' => 'off');
															echo form_open('proyectoExterno/aceptaProyecto',$attributes);
														?>
														<input type="hidden" name="idProyectoExterno" id="idProyectoExterno" value=-1 />
														<button class="btn btn-primary" id="AceptaProyectoExterno" type="button">Aceptar Proyecto</button>
                                                        
														<?php
														echo form_close();
														?>
                                                        <?php
															$attributes = array('id' => 'proyecto-externo-rechazado', 'class' => 'clearfix' , 'autocomplete' => 'off');
															echo form_open('proyectoExterno/rechazaProyecto',$attributes);
														?>
														<input type="hidden" name="idProyectoExternoR" id="idProyectoExternoR" value=-1 />
														<button class="btn btn-primary" id="RechazaProyectoExterno" type="button">Rechazar Proyecto</button>
                                                        
														<?php
														echo form_close();
														?>                                                        
                                                        <br/>
                                                    </div>
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
