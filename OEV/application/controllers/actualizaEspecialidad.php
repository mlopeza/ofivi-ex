<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ActualizaEspecialidad
extends CI_Controller {

    public function index()
    {
		//Sesiones

		$this->load->helper('url');
        $this->load->helper('form');
		$this->load->model('usuariomodel');
		$this->load->helper('security');		

		$this->load->library('session');
		//Cargar la sesion		
		$datos_usuario=$this->session->all_userdata();
		$vista = array('vista'=>$datos_usuario['vista']);

        //Regresa los proyectos iniciados por el usuario y que esten activos
        $areas = $this->usuariomodel->getEspecialidad($datos_usuario['idUsuario']);
		//Se cargan las Vistas
		foreach($areas as $lin){
			foreach($lin[1] as $row){
				echo $row->tiene_especialidad;
			}
		}
//		$this->load->view('usuarios/header',$vista);
//		$this->load->view('usuarios/usuario_extension/menu_extension');
//        $this->load->view('usuarios/usuario_extension/actualizaEspecialidad',array('areas'=>$areas));
//		$this->load->view('usuarios/footer');
    }
}
?>