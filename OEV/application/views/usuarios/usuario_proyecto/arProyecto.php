<div id="content" class="span9 section-body">
<?php echo form_open_multipart(); ?>
<?php echo form_close(); ?> 
                    <div id="section-body" class="tabbable"> <!-- Only required for left/right tabs -->
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab1" data-toggle="tab">Proyectos</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab1">

                                <div class="row-fluid">
                                    <!--Tabs2-->
                                    <div class="span4">
                                        <div id="accordion1" class="accordion">
                                            <div class="accordion-group">
                                                <div class="accordion-heading">
                                                    <a class="accordion-toggle" data-toggle="collapse" href="#latest" data-original-title="">
                                                        <i class="icon-star-empty icon-white"></i> <span class="divider-vertical"></span> Proyectos Pendientes <i class="icon-chevron-down icon-white pull-right"></i>
                                                    </a>
                                                </div>
                                                <div id="latest" class="accordion-body collapse in">
                                                    <div class="accordion-inner paddind">
                                                    <!--Elemento 1-->
                                                    <table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th>Grupo</th>
                                                                    <th>Empresa</th>
                                                                    <th>Proyecto</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="proyectos-iniciados-body">
                                                            <?php
                                                                foreach($proyectos as $proyecto){
                                                            ?>
                                                                <tr class="colorea-proyecto" idProyecto="<?php echo $proyecto->idProyecto; ?>" class="tabla-proyectos">
                                                                       <td><?php echo $proyecto->Grupo; ?></td>
                                                                       <td><?php echo $proyecto->Empresa; ?></td>
                                                                       <td><?php echo $proyecto->Proyecto; ?></td>
                                                                </tr>
                                                            <?php } ?>
                                                            </tbody>
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
                                    <div class="span8">
                                        <div id="accordion2" class="accordion">
                                            <div class="accordion-group">
                                                <div class="accordion-heading">
                                                    <a class="accordion-toggle" data-toggle="collapse" href="#elements" data-original-title="">
                                                        <i class="icon-adjust icon-white"></i> <span class="divider-vertical"></span> Panel General  <i class="icon-chevron-down icon-white pull-right"></i>
                                                    </a>
                                                </div>
                                                <div id="elements" class="accordion-body collapse in">
                                                    <div class="accordion-inner paddind" style="overflow: auto;">
                                                    <!--Elemento 2-->
                                                        <div class="row-fluid show-grid span12">
                                                               <form class="form-horizontal">
                                                               <fieldset>
                                                               <div class="control-group">
                                                                    <label for="focusedInput" class="control-label">Información extra.</label>
                                                                    <div class="controls">
                                                                        <input type="text" value="" id="focusedInput" class="informacion-extra input-xlarge focused">
                                                                    </div>
                                                                </div>
                                                               <div class="control-group">
                                                                    <label for="focusedInput" class="control-label">Sugerencia de Asignación.</label>
                                                                    <div class="controls ui-widget">
                                                                        <input type="text" id="usuarios-autocomplete" class="informacion-sugerencia input-xlarge focused"/>
                                                                    </div>
                                                                </div>
                                                                </fieldset>
                                                                </form>
                                                        </div>
                                                        <div class="row-fluid show-grid span12">
                                                                <div class="form-actions">
                                                                    <button id="aceptar-proyecto" class="btn btn-primary" type="button">Aceptar</button>
                                                                    <button id="rechazar-proyecto" class="btn">Rechazar</button>
                                                                </div>
                                                        </div>

                                                        <br/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row-fluid">
                                    <div class="span12">
                                        <div id="accordion3" class="accordion">
                                            <div class="accordion-group">
                                                <div class="accordion-heading">
                                                    <a class="accordion-toggle" data-toggle="collapse" href="#notification" data-original-title="">
                                                        <i class="icon-user icon-white"></i> <span class="divider-vertical"></span> Descripciones <i class="icon-chevron-down icon-white pull-right"></i>
                                                    </a>
                                                </div>
                                                <div id="notification" class="accordion-body collapse in">
                                                    <div class="accordion-inner paddind">
                                                    <!--Elemento 3-->
                                                        <div class="row-fluid show-grid span12">
                                                        <div class="tabbable span12">
                                                            <ul class="nav nav-tabs">
                                                                <li class="active"><a data-toggle="tab" href="#tab0">Descripción Cliente</a></li>
                                                                <li class=""><a data-toggle="tab" href="#tab2">Descripcion Usuario de Extensíon</a></li>
                                                            </ul>
                                                            <div style="height:400px;padding-bottom: 9px; border-bottom: 1px solid #ddd;" class="tab-content">
                                                                <div id="tab0" class="tab-pane active">
                                                                    <textarea id="descripcionUsuario" class="textarea" style="width:98%;height:85%;" placeholder="Descripción ..." ></textarea>
                                                                </div>
                                                                <div id="tab2" class="tab-pane">
                                                                    <textarea id="descripcionUEV" class="textarea" style="width:98%;height:85%;" placeholder="Descripción ..."></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div></div>
                                <div class="row-fluid">
                                    
                                </div>
                                
                                

                            </div>
                        </div>
                    </div>
                </div>
