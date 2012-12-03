<div id="menu-left" class="span3">
                    <div class="sidebar-nav">
                        <ul class="nav nav-list">
                            <li><a class="current active" data-original-title=""><i class="icon-th-large icon-white"></i><span>Administrador</span></a></li>
							<li class="accordion-menu">
                                <a href="#collapseOne" data-toggle="collapse" class="accordion-toggle"><i class="icon-signal"></i><span>Administración de Sistema<i class="icon-chevron-down pull-right"></i></span></a>
                                <div class="accordion-body collapse dropdown" id="collapseOne">
                                    <div class="accordion-inner">
                                        <ul class="nav nav-list">
                                            <li><a href="<?php echo base_url("/aceptaUsuarios");?>">Solicitudes Actuales</a></li>
                                            <li><a href="<?php echo base_url("/bajaUsuarios");?>">Baja de Usuarios</a></li>
                                            <li><a href="<?php echo base_url("/organizacion");?>">Organización del Sistema Tecnológico</a></li>
                                            <li><a href="<?php echo base_url("/areasUsuarios");?>">Especialidades de Usuarios</a></li>
                                            <li><a href="<?php echo base_url("/cambioContrasena");?>">Cambiar contrase&ntilde;a de usuarios</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
							<li class="accordion-menu">
                                <a href="#collapseTwo" data-toggle="collapse" class="accordion-toggle"><i class="icon-signal"></i><span>Vista de Clientes<i class="icon-chevron-down pull-right"></i></span></a>
                                <div class="accordion-body collapse dropdown" id="collapseTwo">
                                    <div class="accordion-inner">
                                        <ul class="nav nav-list">
                                            <li><a href="<?php echo base_url("/areasClientes");?>">Categorías Mostradas</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <div class="togglemenuleft"><a class="toggle-menu" data-original-title=""><i class="icon-circle-arrow-left icon-white"></i></a></div>
                    </div>
</div>
