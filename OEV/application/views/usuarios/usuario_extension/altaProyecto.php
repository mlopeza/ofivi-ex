<?php
$attributes = array('id' => 'auth-for', 'class' => 'clearfix' , 'autocomplete' => 'off');
echo form_open('altaProyecto/alta',$attributes);
?>
<div id="content" class="span9 section-body">

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
                                                                            <option>NA</option>
                                                                            <option>FEMSA</option>
                                                                        </select>
                                                                        <span class="help-inline"></span>
                                                                    </div>
                                                                </div>
                                                                <div class="control-group">
                                                                    <label for="selectError" class="control-label">Empresa</label>
                                                                    <div class="controls">
                                                                        <select id="Empresa">
                                                                            <option>OXXO</option>
                                                                        </select>
                                                                        <span class="help-inline"></span>
                                                                    </div>
                                                                </div>
                                                                <div class="form-actions">
                                                                    <button class="btn btn-primary" type="submit">Guardar</button>
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
                                                    <div class="accordion-inner" style="text-align:center">
																			<div class="control-group">
                                                         		<label for="focusedInput" class="control-label">Contactos</label>
                                                               <div class="controls">
                                                               	<input type="text" name="contactos" class='input' id="demo-input-local" name="blah"/>
                                                               </div>
                                                         </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <!--/Tabs2-->


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
                                                    <div class="accordion-inner">
                                                        
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="tab-pane" id="tab3">
                                <textarea id="descripcionUsuario" name="descripcionUsuario" class="textarea" placeholder="Descripción ..." style="width: 810px; height: 200px"></textarea>
                            </div>
                            <div class="tab-pane" id="tab4">
                                <textarea id="descripcionAEV" name="descripcionAEV" class="textarea" placeholder="Descripción ..." style="width: 810px; height: 200px"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
<?php
echo form_close();
?>
