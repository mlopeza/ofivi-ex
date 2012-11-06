<div class="span4">
                                                            <!--Grupos y Areas para las llamadas-->
                                                            <div id="accordion" class="ui-accordion ui-widget ui-helper-reset ui-accordion-icons" role="tablist">
                                                              <?php
                                                                
                                                                foreach($areas as $area){
                                                                $contador=0; $imprimi=0;
                                                                ?>
                                                              <div>
                                                                <h3 class="ui-accordion-header ui-helper-reset ui-state-default ui-state-active ui-corner-top ui-state-focus" role="tab" aria-expanded="true" aria-selected="true" tabindex="0"><span class="ui-icon ui-icon-triangle-1-s"></span><a href="#"><?php echo $area[0]->nombre; ?></a></h3>
                                                                <div class="ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom ui-accordion-content-active" style="height: 31px; " role="tabpanel">
                                                                            <?php foreach($area[1] as $sub){

                                                                                if($contador%2 == 0){echo '<div class="row-fluid">';$contador++;}                            
                                                                            ?>
                                                                                <div class="span5"><?php $imprimi++; echo $sub->area."->".$sub->tiene_especialidad;?></div><div class="span1"><input type="checkbox" class="areaCheckbox" id="<?php echo $sub->idArea_Conocimiento; if($sub->tiene_especialidad!=0){ echo 'checked="checked"';}?>"/></div>
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
                                                            </div>