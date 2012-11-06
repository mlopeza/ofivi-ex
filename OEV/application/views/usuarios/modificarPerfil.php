<?php echo form_open_multipart(); ?>
<?php echo form_close(); ?> 
<div id="content" class="span12 section-body">
                    <div id="section-body" class="tabbable"> <!-- Only required for left/right tabs -->
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab1" data-toggle="tab">Modificar Datos de Usuario</a></li>
                        </ul>
                        <div class="tab-content">                            
									<div class="tab-pane active" id="tab1">
                                <div class="row-fluid">
                                    <!--Tabs3-->
                                    <div class="span6">
                                        <div id="accordion2" class="accordion">
                                            <div class="accordion-group">
                                                <div class="accordion-heading">
                                                    <a class="accordion-toggle" data-toggle="collapse" href="#statements" data-original-title="">
                                                        <i class="icon-globe icon-white"></i> <span class="divider-vertical"></span> Datos de Usuario <i class="icon-chevron-down icon-white pull-right"></i>
                                                    </a>
                                                </div>
                                                <div id="statements" class="accordion-body collapse in">
												<div class="accordion-inner paddind">
                                                        <form class="form-horizontal">
                                                            <fieldset>
                                                                <div class="control-group">
                                                                    <label for="focusedInput" class="control-label">Nombre</label>
                                                                    <div class="controls">
                                                                        <input type="text" value="" id="usuario-nombre" class="input-xlarge focused">
                                                                    </div>
                                                                </div>
                                                                <div class="control-group">
                                                                    <label for="focusedInput" class="control-label">Apellido Paterno</label>
                                                                    <div class="controls">
                                                                        <input type="text" value="" id="usuario-ap" class="input-xlarge focused">
                                                                    </div>
                                                                </div>
                                                                <div class="control-group">
                                                                    <label for="focusedInput" class="control-label">Apellido Materno</label>
                                                                    <div class="controls">
                                                                        <input type="text" value="" id="usuario-am" class="input-xlarge focused">
                                                                    </div>
                                                                </div>
                                                                <div class="control-group">
                                                                    <label for="focusedInput"  class="control-label">Correo Electrónico</label>
                                                                    <div class="controls">
                                                                        <input type="text" value="" id="usuario-email" class="input-xlarge focused">
                                                                    </div>
                                                                </div>
                                                                <div class="form-actions">
                                                                    <button class="btn btn-primary" id="GuardaModificaciones" type="button">Guardar</button>
                                                                    <button class="btn btn-danger" type="button" onclick="history.go(-1);">Cancelar</button>
                                                                </div>
                                                            </fieldset>
                                                        </form>


                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>                                    <div class="span6">
                                        <div id="accordion2" class="accordion">
                                            <div class="accordion-group">
                                                <div class="accordion-heading">
                                                    <a class="accordion-toggle" data-toggle="collapse" href="#statements2" data-original-title="">
                                                        <i class="icon-globe icon-white"></i> <span class="divider-vertical"></span> Telefonos <i class="icon-chevron-down icon-white pull-right"></i>
                                                    </a>
                                                </div>
                                                <div id="statements2" class="accordion-body collapse in">
												<div class="accordion-inner paddind">
															<table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th>Descripción</th>
                                                                    <th>Lada</th>
                                                                    <th>Telefono</th>
                                                                    <th>Extensión</th>
                                                                    <th>Extra</th>
                                                                    <th>Acción</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="usuario-telefonos-body">
                                                            </tbody>
															<tfoot>
															<tr>
																<td colspan="6" style="text-align:right;">
																</td>
															</tr>
															<tr>
																<td colspan="6" style="text-align:right;">
                                                                    <button class="btn btn-primary" type="button" id="usuario-nuevo-telefono">Nuevo</button>
																</td>
															</tr>
															</tfoot>
                                                        </table><br />
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
