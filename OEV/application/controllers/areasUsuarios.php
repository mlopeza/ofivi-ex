<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class areasUsuarios
extends CI_Controller {

    public function index()
    {
		//Sesiones

		$this->load->helper('url');
    $this->load->helper('form');
		$this->load->model('usuariomodel');
		$this->load->helper('security');		
		$this->load->library('session');
    if($this->session->userdata('vista')){
    
    }else{
      redirect('/logincontroller', 'location');
    }
		//Se carga el Modelo de Proyecto
		$this->load->model('proyecto');
		//Cargar la sesion y se obtiene el id del usuario
		$datos_usuario=$this->session->all_userdata();
		$vista = array('vista'=>$datos_usuario['vista']);
		//Se cargan las Vistas
		$this->load->view('usuarios/header',$vista);
		$this->load->view('usuarios/administrador/menu_administrador');
    $this->load->view('usuarios/administrador/areasUsuariosVista');
		$this->load->view('usuarios/footer');
		$this->load->view('usuarios/administrador/Scripts/areasUsuariosScript');
    }

	//Regresa todas las categorias
    public function getAreas()
    {
    $this->load->model('grupoarea');
		//Regresa todas las categorias en JSON
		echo json_encode($this->grupoarea->getAreas($this->input->post()));
    }

	public function deleteArea(){
		$this->load->model('areaconocimiento');
		$idArea_Conocimiento = $this->input->post('idArea_Conocimiento');
		$this->areaconocimiento->deleteArea($idArea_Conocimiento);
	}

	public function addArea(){
		$this->load->model('areaconocimiento');
		$data = $this->input->post();
		echo json_encode($data);
		$this->areaconocimiento->addArea($data);
	}

  public function getGrupos(){
    $this->load->model('grupoarea');
    $data = $this->grupoarea->getGrupos();
    echo json_encode($data);
  }

  public function saveGrupo(){
    $this->load->model('grupoarea');
    $this->grupoarea->addGrupo($this->input->post());
    echo json_encode(array());
  }

  public function deleteGrupo(){
    $this->load->model('grupoarea');
    $this->grupoarea->deleteGrupo($this->input->post('idGrupo_Area'));
    echo json_encode(array());
  }

}
