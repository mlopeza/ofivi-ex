<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class listaContactos
extends CI_Controller {

    public function index()
    {
		//Sesiones

		$this->load->helper('url');
        $this->load->helper('form');
		$this->load->model('grupo_area_model');
		$this->load->model('proyecto');
		$this->load->helper('security');		

		$this->load->library('session');
    if($this->session->userdata('vista')){
    
    }else{
      redirect('/logincontroller', 'location');
    }
		//Cargar la sesion		
		$datos_usuario=$this->session->all_userdata();
		$vista = array('vista'=>$datos_usuario['vista']);

		//Se cargan las Vistas
		$this->load->view('usuarios/header',$vista);
		$this->load->view('usuarios/usuario_extension/menu_extension');
        $this->load->view('usuarios/usuario_extension/listaContactosVista');
		$this->load->view('usuarios/footer');
		$this->load->view('usuarios/usuario_extension/Scripts/listaContactosScript');
    }

  public function getAllContactos(){
    $this->load->model('contacto_model');
    echo json_encode($this->contacto_model->getContactosActivos());
  }
}
