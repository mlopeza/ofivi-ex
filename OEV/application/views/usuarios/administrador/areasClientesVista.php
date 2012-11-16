
<div id="content" class="span9 section-body">
<?php echo form_open_multipart(); ?>
<?php echo form_close(); ?> 
                    <div id="section-body" class="tabbable"> <!-- Only required for left/right tabs -->
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab1" data-toggle="tab">Categorías</a></li>
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
                                                        <i class="icon-list-alt icon-white"></i> <span class="divider-vertical"></span> Categorías actuales <i class="icon-chevron-down icon-white pull-right"></i>
                                                    </a>
                                                </div>
                                                <div id="control" class="accordion-body in collapse" style="height: auto; ">
                                                    <div class="accordion-inner paddind">
                                                        <table  class="table table-bordered table-striped pull-left" id="tabla-areas" >
                                                            <thead>
                                                                <tr>
                                                                  <td>Area</td>
                                                                  <td>Acción</td>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="areas-body">
                                                            </tbody>
                                                            <tfoot><tr><td colspan="2"></td></tr></tfoot>
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
                                                        <i class="icon-list-alt icon-white"></i> <span class="divider-vertical"></span>Categoría Nueva<i class="icon-chevron-down icon-white pull-right"></i>
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
                                                                        <input type="text" value="" id="nombre-categoria" class="input-xlarge focused">
                                                                    </div>
                                                                </div>
                                                                <div class="form-actions">
                                                                    <button class="btn btn-primary" id="addCategoria" type="button">Guardar</button>
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
