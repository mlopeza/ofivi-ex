<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('evalua_tipo_boton'))
{
    function evalua_tipo_boton($var = '0')
    {
		if($var == 1){
			return '<div class="btn-group"><button class="btn btn-success"><i class="icon-ok icon-white"></i> Sí</button><button data-toggle="dropdown" class="btn btn-success dropdown-toggle"><span class="caret"></span></button><ul class="dropdown-menu"><li><a class="yes-button" data-original-title="">Sí</a></li><li><a class="no-button" data-original-title="">No</a></li></ul></div>';
		}else{
			return '<div class="btn-group"><button class="btn btn-danger"><i class="icon-remove icon-white"></i> No</button><button data-toggle="dropdown" class="btn btn-danger dropdown-toggle"><span class="caret"></span></button><ul class="dropdown-menu"><li><a class="yes-button" data-original-title="">Sí</a></li><li><a class="no-button" data-original-title="">No</a></li></ul></div>';
		}
    }   
}
?>
