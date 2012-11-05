
<div id="content" class="span9 section-body">
<?php echo form_open_multipart(); ?>
<?php echo form_close(); ?> 
                    <div id="section-body" class="tabbable"> <!-- Only required for left/right tabs -->
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab1" data-toggle="tab">Campus</a></li>
                            <li><a href="#tab2" data-toggle="tab">Escuela</a></li>
                            <li><a href="#tab3" data-toggle="tab">Departamento</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab1">
                                <div class="row-fluid">
                                    <!--Inicio de Primera parte-->
                                    <div class="span6">
                                        <div id="accordion1" class="accordion">
                                            <div class="accordion-group">
                                                <div class="accordion-heading">
                                                    <a class="accordion-toggle" data-toggle="collapse" href="#control" data-original-title="">
                                                        <i class="icon-list-alt icon-white"></i> <span class="divider-vertical"></span> Campus Actuales <i class="icon-chevron-down icon-white pull-right"></i>
                                                    </a>
                                                </div>
                                                <div id="control" class="accordion-body in collapse" style="height: auto; ">
                                                    <div class="accordion-inner paddind">
                                                        <table  class="table table-bordered table-striped pull-left" id="tabla-campus" >
                                                            <thead>
                                                                <tr>
                                                                  <td>Nombre</td>
                                                                  <td>Ciudad</td>
                                                                  <td>Acción</td>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="contactos-body">

                                                            </tbody>
                                                            <tfoot><tr><td colspan="3"></td></tr></tfoot>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div> 
                                    <!--Fin de la primera parte-->
                                    <!--Segunda Parte-->
                                    <div class="span6">
                                        <div id="accordion1" class="accordion">
                                            <div class="accordion-group">
                                                <div class="accordion-heading">
                                                    <a class="accordion-toggle" data-toggle="collapse" href="#control" data-original-title="">
                                                        <i class="icon-list-alt icon-white"></i> <span class="divider-vertical"></span> Campus <i class="icon-chevron-down icon-white pull-right"></i>
                                                    </a>
                                                </div>
                                                <div id="control" class="accordion-body in collapse" style="height: auto; ">
                                                    <div class="accordion-inner paddind">
                                                        <input id="id-Campus" type="hidden"/>
                                                        <form class="form-horizontal">                    
                                                            <fieldset>
                                                                <div class="control-group">
                                                                    <label for="focusedInput" class="control-label">Nombre</label>
                                                                    <div class="controls">
                                                                        <input type="text" value="" id="nombre-Campus" class="input-xlarge focused">
                                                                    </div>
                                                                </div>
                                                                <div class="control-group">
                                                                    <label for="focusedInput" class="control-label">Ciudad</label>
                                                                    <div class="controls">
                                                                        <input type="text" value="" id="ciudad-Campus" class="input-xlarge focused">
                                                                    </div>
                                                                </div>
                                                                <div class="form-actions">
                                                                    <button class="btn btn-primary" id="guardarCampus" type="button">Guardar</button>
                                                                </div>
                                                            </fieldset>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>                                 
                                    <!--Fin de Segunda parte-->
                                </div><!--Row Fluid-->
                            </div>


                            <!--Segunda Tab-->                            
							<div class="tab-pane" id="tab2">
                                <div class="row-fluid">
                                    <!--Inicio de Primera parte-->
                                    <div class="span6">
                                        <div id="accordion1" class="accordion">
                                            <div class="accordion-group">
                                                <div class="accordion-heading">
                                                    <a class="accordion-toggle" data-toggle="collapse" href="#control" data-original-title="">
                                                        <i class="icon-list-alt icon-white"></i> <span class="divider-vertical"></span> Escuelas Actuales <i class="icon-chevron-down icon-white pull-right"></i>
                                                    </a>
                                                </div>
                                                <div id="control" class="accordion-body in collapse" style="height: auto; ">
                                                    <div class="accordion-inner paddind">
                                                    <form class="form-horizontal">
                                                            <fieldset>
                                                                <div class="control-group">
                                                                    <label for="selectError" class="control-label">Campus</label>
                                                                    <div class="controls">
                                                                        <select id="selectCampus-Escuela">
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </fieldset>
                                                        </form>
                                                        <br/><br/>
                                                        <table  class="table table-bordered table-striped pull-left" id="tabla-escuela" >
                                                            <thead>
                                                                <tr>
                                                                  <td>Nombre</td>
                                                                  <td>Ubucación</td>
                                                                  <td>Acción</td>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="contactos-body">
                                                            </tbody>
                                                            <tfoot><tr><td colspan="3"></td></tr></tfoot>
                                                        </table>
                                                     <br/><br/>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div> 
                                    <!--Fin de la primera parte-->
                                    <!--Segunda Parte-->
                                    <div class="span6">
                                        <div id="accordion1" class="accordion">
                                            <div class="accordion-group">
                                                <div class="accordion-heading">
                                                    <a class="accordion-toggle" data-toggle="collapse" href="#control" data-original-title="">
                                                        <i class="icon-list-alt icon-white"></i> <span class="divider-vertical"></span> Escuela <i class="icon-chevron-down icon-white pull-right"></i>
                                                    </a>
                                                </div>
                                                <div id="control" class="accordion-body in collapse" style="height: auto; ">
                                                    <div class="accordion-inner paddind">
                                                        <input id="id-Escuela" type="hidden"/>
                                                        <input id="id-CampusEscuela" type="hidden"/>
                                                        <form class="form-horizontal">                    
                                                            <fieldset>
                                                                <div class="control-group">
                                                                    <label for="focusedInput" class="control-label">Nombre</label>
                                                                    <div class="controls">
                                                                        <input type="text" value="" id="nombre-Escuela" class="input-xlarge focused">
                                                                    </div>
                                                                </div>
                                                                <div class="control-group">
                                                                    <label for="focusedInput" class="control-label">Ubicacion</label>
                                                                    <div class="controls">
                                                                        <input type="text" value="" id="ubicacion-Escuela" class="input-xlarge focused">
                                                                    </div>
                                                                </div>
                                                                <div class="form-actions">
                                                                    <button class="btn btn-primary" id="guardarEscuela" type="button">Guardar</button>
                                                                </div>
                                                            </fieldset>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>                                 
                                    <!--Fin de Segunda parte-->
                                </div><!--Row Fluid-->
                            </div>

                            <div class="tab-pane" id="tab3">
                                <div class="row-fluid">
                                    <!--Inicio de Primera parte-->
                                    <div class="span6">
                                        <div id="accordion1" class="accordion">
                                            <div class="accordion-group">
                                                <div class="accordion-heading">
                                                    <a class="accordion-toggle" data-toggle="collapse" href="#control" data-original-title="">
                                                        <i class="icon-list-alt icon-white"></i> <span class="divider-vertical"></span> Escuelas Actuales <i class="icon-chevron-down icon-white pull-right"></i>
                                                    </a>
                                                </div>
                                                <div id="control" class="accordion-body in collapse" style="height: auto; ">
                                                    <div class="accordion-inner paddind">
                                                    <form class="form-horizontal">
                                                            <fieldset>
                                                                <input type="hidden" id="id-Departamento" value=""/>
                                                                <div class="control-group">
                                                                    <label for="selectError" class="control-label">Campus</label>
                                                                    <div class="controls">
                                                                        <select id="selectCampus-Departamento">
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="control-group">
                                                                    <label for="selectError" class="control-label">Escuela</label>
                                                                    <div class="controls">
                                                                        <select id="selectEscuela-Departamento">
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </fieldset>
                                                        </form>
                                                        <br/><br/>
                                                        <table  class="table table-bordered table-striped pull-left" id="tabla-departamento" >
                                                            <thead>
                                                                <tr>
                                                                  <td>Nombre</td>
                                                                  <td>Ubucación</td>
                                                                  <td>Acción</td>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="contactos-body">
                                                            </tbody>
                                                            <tfoot><tr><td colspan="3"></td></tr></tfoot>
                                                        </table>
                                                     <br/><br/>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div> 
                                    <!--Fin de la primera parte-->
                                    <!--Segunda Parte-->
                                    <div class="span6">
                                        <div id="accordion1" class="accordion">
                                            <div class="accordion-group">
                                                <div class="accordion-heading">
                                                    <a class="accordion-toggle" data-toggle="collapse" href="#control" data-original-title="">
                                                        <i class="icon-list-alt icon-white"></i> <span class="divider-vertical"></span> Escuela <i class="icon-chevron-down icon-white pull-right"></i>
                                                    </a>
                                                </div>
                                                <div id="control" class="accordion-body in collapse" style="height: auto; ">
                                                    <div class="accordion-inner paddind">
                                                        <input id="id-Departamento" type="hidden"/>
                                                        <form class="form-horizontal">                    
                                                            <fieldset>
                                                                <div class="control-group">
                                                                    <label for="focusedInput" class="control-label">Nombre</label>
                                                                    <div class="controls">
                                                                        <input type="text" value="" id="nombre-Departamento" class="input-xlarge focused">
                                                                    </div>
                                                                </div>
                                                                <div class="control-group">
                                                                    <label for="focusedInput" class="control-label">Ubicacion</label>
                                                                    <div class="controls">
                                                                        <input type="text" value="" id="ubicacion-Departamento" class="input-xlarge focused">
                                                                    </div>
                                                                </div>
                                                                <div class="form-actions">
                                                                    <button class="btn btn-primary" id="guardarDepartamento" type="button">Guardar</button>
                                                                </div>
                                                            </fieldset>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>                                 
                                    <!--Fin de Segunda parte-->
                                </div><!--Row Fluid-->
                            </div>
                        </div>
                    </div>
                </div>
