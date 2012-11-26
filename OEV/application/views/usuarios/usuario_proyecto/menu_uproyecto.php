<div id="menu-left" class="span3">
                    <div class="sidebar-nav">
                        <ul class="nav nav-list">
                            <li><a href="<?php base_url("altaProyecto");?>" class="current active" data-original-title=""><i class="icon-th-large icon-white"></i><span> Inicio</span></a></li>
							<li class="accordion-menu">
                                <a href="#collapseOne" data-toggle="collapse" class="accordion-toggle"><i class="icon-signal"></i><span>Proyectos<i class="icon-chevron-down pull-right"></i></span></a>
                                <div class="accordion-body collapse dropdown" id="collapseOne">
                                    <div class="accordion-inner">
                                        <ul class="nav nav-list">
                                            <li><a href="<?php echo base_url("arProyecto");?>">Proyectos Pendientes</a></li>
                                            <li><a href="<?php echo base_url("subirPropuesta");?>">Subir Propuesta</a></li>
                                            <li><a href="<?php echo base_url("actualizaEstado");?>">Actualizar Estado</a></li>
                                            <li><a href="<?php echo base_url("/avancesProyectoP");?>">Avances de Proyectos</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
							<li class="accordion-menu">
                                <a href="#collapseTwo" data-toggle="collapse" class="accordion-toggle"><i class="icon-signal"></i><span>Datos de Usuario<i class="icon-chevron-down pull-right"></i></span></a>
                                <div class="accordion-body collapse dropdown" id="collapseTwo">
                                    <div class="accordion-inner">
                                        <ul class="nav nav-list">
                                            <li><a href="<?php echo base_url("actualizaEspecialidad");?>">Especialidades del Usuario</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
							<li class="accordion-menu">
                                <a href="#collapseThree" data-toggle="collapse" class="accordion-toggle"><i class="icon-signal"></i><span>Reportes<i class="icon-chevron-down pull-right"></i></span></a>
                                <div class="accordion-body collapse dropdown" id="collapseThree">
                                    <div class="accordion-inner">
                                        <ul class="nav nav-list">
                                            <li><a href="<?php echo base_url("generaReporte");?>">Generar Reporte</a></li>
                                            <li><a href="<?php echo base_url("modificarReportes");?>">Ver y Editar Reporte</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <div class="togglemenuleft"><a class="toggle-menu" data-original-title=""><i class="icon-circle-arrow-left icon-white"></i></a></div>
                    </div>
</div>
