<div id="section-body" class="tabbable"> <!-- Only required for left/right tabs -->
                        
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab1">

                                
                                <div class="row-fluid">
                                    <div class="span8">
                                        <div id="accordion3" class="accordion">
                                            <div class="accordion-group">
                                                <div class="accordion-heading">
                                                    <a class="accordion-toggle" data-toggle="collapse" href="#event" data-original-title="">
                                                        <i class="icon-comment icon-white"></i> <span class="divider-vertical"></span>Crear Grupos<i class="icon-chevron-down icon-white pull-right"></i>
                                                    </a>
                                                </div>
                                                <div id="notification" class="accordion-body collapse in">
                                                    <div class="accordion-inner paddind">
													<?php
													$attributes = array('id' => 'auth-for', 'class' => 'clearfix' , 'autocomplete' => 'off');
													echo form_open('altaEmpresa/alta',$attributes);
													?>
													<fieldset>
													<div class="control-group">		
														<label for="selectError" class="control-label">Grupos</label>
                                                        <div class="controls">
													<select id="grupo" name="grupo">
													<option value=''></option>;
													<?php
														foreach($grupos as $row){
														echo '<option value='.$row->idGrupo.'>'.$row->nombre.'</>';
													}?>
													</select>
													</div>
													</div>
														<label for="focusedInput" class="control-label">Nombre de Empresa.</label>
															<input type="text"  id="nombre_empresa" name="nombre_empresa" value="" id="focusedInput" class="input-xlarge focused">
                                                         <div class="form-actions">
															<button class="btn btn-primary" type="submit">Guardar</button>
                                                         </div>
													</fieldset>
													<?php
														echo form_close();
													?> 

                                                </div>
                                            </div>

                                        </div>
                                    </div></div>
                                
                                
                                

                            </div>
                        </div>
                    </div>
