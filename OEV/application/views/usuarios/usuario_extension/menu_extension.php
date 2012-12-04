<div id="menu-left" class="span3">
  <div class="sidebar-nav">
    <ul class="nav nav-list">
      <li><a class="current active" data-original-title=""><i class="icon-th-large icon-white"></i><span>Usuario de extensión</span></a></li>
      <li class="accordion-menu">
        <a href="#collapseTwo" data-toggle="collapse" class="accordion-toggle"><i class="icon-signal"></i><span>Empresas<i class="icon-chevron-down pull-right"></i></span></a>
        <div class="accordion-body collapse dropdown" id="collapseTwo">
          <div class="accordion-inner">
            <ul class="nav nav-list">
              <li><a href="<?php echo base_url("jerarquiaGrupos");?>">Alta de Grupos y Empresas</a></li>
              <li><a href="<?php echo base_url("creaContacto");?>">Contactos</a></li>
            </ul>
          </div>
        </div>
      </li>
      <li class="accordion-menu">
        <a href="#collapseOne" data-toggle="collapse" class="accordion-toggle"><i class="icon-signal"></i><span>Proyectos<i class="icon-chevron-down pull-right"></i></span></a>
        <div class="accordion-body collapse dropdown" id="collapseOne">
          <div class="accordion-inner">
            <ul class="nav nav-list">
              <li><a href="<?php echo base_url("altaProyecto");?>">Alta de Proyecto</a></li>
              <li><a href="<?php echo base_url("altaProyecto/listaProyectos");?>">Edita Proyecto</a></li>
              <li><a href="<?php echo base_url("asignaProyecto");?>">Asigna Usuario de Proyecto</a></li>
              <li><a href="<?php echo base_url("AsignaLegal");?>">Asigna Usuario Legal</a></li>
              <li><a href="<?php echo base_url("proyectoExterno");?>">Proyectos Externos</a></li>
              <li><a href="<?php echo base_url("actualizaEstadoUE");?>">Actualizar Estado</a></li>
              <li><a href="<?php echo base_url("avancesproyectoU");?>">Avances de Proyectos</a></li>
              <li><a href="<?php echo base_url("verReportes");?>">Ver Reportes de Proyecto</a></li>
            </ul>
          </div>
        </div>
      </li>
      <li class="accordion-menu">
        <a href="#collapseThree" data-toggle="collapse" class="accordion-toggle"><i class="icon-signal"></i><span>Usuarios<i class="icon-chevron-down pull-right"></i></span></a>
        <div class="accordion-body collapse dropdown" id="collapseThree">
          <div class="accordion-inner">
            <ul class="nav nav-list">
              <li><a href="<?php echo base_url("asignaProyecto/listaUsuarios");?>">Lista de Usuarios</a></li>
            </ul>
          </div>
        </div>
      </li>
      <li class="accordion-menu">
        <a href="#collapseFour" data-toggle="collapse" class="accordion-toggle"><i class="icon-signal"></i><span>Contactos<i class="icon-chevron-down pull-right"></i></span></a>
        <div class="accordion-body collapse dropdown" id="collapseFour">
          <div class="accordion-inner">
            <ul class="nav nav-list">
              <li><a href="<?php echo base_url("listaContactos");?>">Lista de Contactos</a></li>
            </ul>
          </div>
        </div>
      </li>
    </ul>
    <div class="togglemenuleft"><a class="toggle-menu" data-original-title=""><i class="icon-circle-arrow-left icon-white"></i></a></div>
  </div>
</div>
