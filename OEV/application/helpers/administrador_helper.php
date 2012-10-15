<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('evalua_tipo_boton'))
{
    function evalua_tipo_boton($var = '0', $name = 'none')
    {
		if($var == 1){
			return '<div class="btn-group"><button id="'.$name.'" class="btn btn-success"><i class="icon-ok icon-white"></i> Sí</button><button data-toggle="dropdown" class="btn btn-success dropdown-toggle"><span class="caret"></span></button><ul class="dropdown-menu"><li><a class="yes-button" data-original-title="">Sí</a></li><li><a class="no-button" data-original-title="">No</a></li></ul></div>';
		}else{
			return '<div class="btn-group"><button id="'.$name.'" class="btn btn-danger"><i class="icon-remove icon-white"></i> No</button><button data-toggle="dropdown" class="btn btn-danger dropdown-toggle"><span class="caret"></span></button><ul class="dropdown-menu"><li><a class="yes-button" data-original-title="">Sí</a></li><li><a class="no-button" data-original-title="">No</a></li></ul></div>';
		}
    }   
}

if ( ! function_exists('get_configuracion'))
{
    function get_configuracion($elemento = '')
    {
$c = array(
        	'administrador/acepta_usuario' => array(
            array(
                'field' => 'idDepartamento',
                'label' => 'departamento',
                'rules' => 'trim|required|is_natural|xssclean|'
                ),
            array(
                'field' => 'idUsuario',
                'label' => 'idUsuario',
                'rules' => 'trim|required|is_natural|xssclean'
                ),
            array(
                'field' => 'Usuario_Aceptado',
                'label' => 'usuario_aceptado',
                'rules' => 'trim|required|xssclean'
                ),
            array(
                'field' => 'Tipo_Usuario',
                'label' => 'Tipo_Usuario',
                'rules' => 'trim|required|xssclean'
                ),
            array(
                'field' => 'Username',
                'label' => 'username',
                'rules' => 'trim|required|xssclean'
                ),
            array(
                'field' => 'Vista_Administrador',
                'label' => 'vista_administrador',
                'rules' => 'trim|required|is_natural|xssclean'
                ),
            array(
                'field' => 'Vista_Cliente',
                'label' => 'vista_cliente',
                'rules' => 'trim|required|is_natural|xssclean'
                ),
            array(
                'field' => 'Vista_Legal',
                'label' => 'vista_legal',
                'rules' => 'trim|required|is_natural|xssclean'
                ),
            array(
                'field' => 'Vista_Profesor',
                'label' => 'vista_profesor',
                'rules' => 'trim|required|is_natural|xssclean'
                ),
            array(
                'field' => 'Vista_Supervisor_Extension',
                'label' => 'vista_supervisor_extension',
                'rules' => 'trim|required|is_natural|xssclean'
                ),
            array(
                'field' => 'Vista_Usuario_Extension',
                'label' => 'vista_usuario_extension',
                'rules' => 'trim|required|is_natural|xssclean'
                )
            )                          
		);
		return $c[$elemento];
    }   
}
?>
