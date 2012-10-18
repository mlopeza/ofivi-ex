<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class altaProyecto
extends CI_Controller {

    public function index()
    {
		$this->load->helper('url');
        $this->load->helper('form');

		//Se carga el Modelo de Grupos
		$this->load->model('grupo');

		//Se buscan todos los Grupos disponibles
		$query['data']=$this->grupo->getAllGroups();
		//Se cargan las Vistas
		$this->load->view('usuarios/header');
		$this->load->view('usuarios/usuario_extension/menu_extension');
        $this->load->view('usuarios/usuario_extension/altaProyecto',$query);
		$this->load->view('usuarios/footer');
    }

    public function alta()
    {	$this->load->model('proyecto');
		$this->load->model('estado');
		
		
		$this->proyecto->alta();	//Se registra el proyecto
		$ultimoid = $this->proyecto->ultimo();	//Se obtiene el ID del ultimo proyecto registrado
		
		//Sesion estatica para pruebas
		$this->load->library('session');
		
		$array = array('username' => 'Pedro',
		'idUsuario' => 2);
		$this->session->set_userdata($array);	
		$usuario = $this->session->userdata('username');
		$idUsuario = $this->session->userdata('idUsuario');
		//Fin de Sesion estatica
		
		$this->estado->insert($ultimoid,$idUsuario);
				
		
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
