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

                                                            <!--Grupos y Areas para las llamadas-->
                              															<?php
                                                                $attributes = array('id' => 'auth-for', 'class' => 'clearfix' , 'autocomplete' => 'off');
                                                                echo form_open('actualizaEspecialidad/actualizar',$attributes);
                                                            ?>
                                                            <div id="accordion" class="ui-accordion ui-widget ui-helper-reset ui-accordion-icons" role="tablist">
                                                              <?php
                                                                
                                                                foreach($areas as $area){
                                                                $contador=0; $imprimi=0;
                                                                ?>
                                                              <div>
                                                                <h3 class="ui-accordion-header ui-helper-reset ui-state-default ui-state-active ui-corner-top ui-state-focus" role="tab" aria-expanded="true" aria-selected="true" tabindex="0"><span class="ui-icon ui-icon-triangle-1-s"></span><a href="#"><?php echo utf8_decode($area[0]->nombre); ?></a></h3>
                                                                <div class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom ui-accordion-content-active" style="height: 31px; " role="tabpanel">
                                                                            <?php foreach($area[1] as $sub){

                                                                                if($contador%2 == 0){echo '<div class="row-fluid">';$contador++;}                            
                                                                            ?>
                                                                                <div class="span5"><?php $imprimi++; echo $sub->area;?></div><div class="span1"><input type="checkbox" name = "especialidad[]" class="areaCheckbox" value="<?php echo $sub->idArea_Conocimiento;?>"id="<?php echo $sub->idArea_Conocimiento; 
																				if($sub->tiene_especialidad>0){ 
																					echo '" checked="checked"';
																				}?>"/></div>
                                                                            <?php 
                                                                                        if($imprimi%2 == 0){
                                                                                             $contador++;
                                                                                             echo "</div>";    
                                                                                        }

                                                                           }?>

                                                                </div>
                                                              </div>
                                                            <?php 
                                                                    if($imprimi%2 != 0){
                                                                            echo "</div>";
                                                                    }
                                                              }
                                                                   
                                                            ?>
                                                            </div>
                                                            <div class="form-actions">
                                                                    <button id="aceptar-proyecto" class="btn btn-primary" type="submit">Actualizar</button>
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
                                </div> <!--  end row-fluid -->
                            </div>
                        </div>
                    </div>
                </div>
