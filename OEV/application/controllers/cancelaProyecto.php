<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CancelaProyecto
extends CI_Controller {

    public function index()
    {
		//Sesiones

		$this->load->helper('url');
        $this->load->helper('form');
		$this->load->model('usuariomodel');
		$this->load->helper('security');		
		$this->load->library('session');
		//Se carga el Modelo de Proyecto
		$this->load->model('proyecto');
		//Cargar la sesion y se obtiene el id del usuario
		$datos_usuario=$this->session->all_userdata();
		$vista = array('vista'=>$datos_usuario['vista']);
		$usuario = $datos_usuario['idUsuario'];
		//Se buscan todos los proyectos relacionados al usuario
		$proyectos['proyectos'] = $this->proyecto->getProyectosIniciados($usuario,1);
		
		//Se cargan las Vistas
		$this->load->view('usuarios/header',$vista);
		$this->load->view('usuarios/usuario_extension/menu_extension');
        $this->load->view('usuarios/usuario_extension/cancela_Proyecto',$proyectos);
		$this->load->view('usuarios/footer');
		$this->load->view('usuarios/usuario_extension/Scripts/cancelaProyecto');
    }
    
    function cancelar()
	{
		$this->load->model('estado');
		$this->load->model('proyecto');
		$this->load->helper('url');
		$this->load->library('session');

		//Cargar la sesion y se obtiene el id del usuario
		$datos_usuario=$this->session->all_userdata();
		$vista = array('vista'=>$datos_usuario['vista']);
		$usuario = $datos_usuario['idUsuario'];
		
		$idProyecto = $this->input->post('idProyectoCancelar');
		$this->estado->setIdProyecto($idProyecto);
		$this->estado->setIdUsuario($usuario);
		$this->estado->setEstado('Cancelado');
		
		$this->proyecto->modificarActivo($idProyecto,0);
		$this->estado->insert();
		sleep(3);
		redirect('cancelaProyecto', 'location'); 
	}
}
