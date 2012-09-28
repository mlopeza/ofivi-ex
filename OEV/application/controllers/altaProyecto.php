<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class altaProyecto
extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -  
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
		$this->load->helper('url');
        $this->load->helper('form');
		$this->load->view('usuarios/header');
		$this->load->view('usuarios/usuario_extension/menu_extension');
        $this->load->view('usuarios/usuario_extension/altaProyecto');
		$this->load->view('usuarios/footer');
    }

    public function alta()
    {	$this->load->model('proyecto');
		$this->load->model('estado');
		
		$array = array('username' => 'Pedro',
		'idUsuario' => 2);
		$this->session->set_userdata($array);	
		
		$this->proyecto->alta();	//Se registra el proyecto
		$ultimoid = $this->proyecto->ultimo();	//Se obtiene el ID del ultimo proyecto registrado
		
		//Sesion estatica para pruebas
		$this->load->library('session');
		$usuario = $this->session->userdata('username');
		$idUsuario = $this->session->userdata('idUsuario');
		//Fin de Sesion estatica
		
		$this->estado->insert($ultimoid,$idUsuario);
		
		
		echo '\n Todo bien ;) ' . $usuario . '  Id = '. $idUsuario;
		
		
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
