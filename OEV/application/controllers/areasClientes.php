<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class areasClientes
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
		$proyectos['proyectos'] = $this->proyecto->selectProyectos($usuario);
		
		//Se cargan las Vistas
		$this->load->view('usuarios/header',$vista);
		$this->load->view('usuarios/administrador/menu_administrador');
        $this->load->view('usuarios/administrador/areasClientesVista',$proyectos);
		$this->load->view('usuarios/footer');
		$this->load->view('usuarios/administrador/Scripts/areasClienteScript');
    }

	//Regresa todas las categorias
    public function getCategorias()
    {
		$this->load->model('categoria');
		//Regresa todas las categorias en JSON
		echo json_encode($this->categoria->getAllCategoriasSupra($this->input->post()));
    }

	public function deleteCategoria(){
		$this->load->model('categoria');
		$idCategoria = $this->input->post('idCategoria');
		$this->categoria->deleteCategoria($idCategoria);
	}

	public function addCategoria(){
		$this->load->model('categoria');
		$data = $this->input->post();
		echo json_encode($data);
		$this->categoria->addCategoria($data);
	}

  public function getSupra(){
    $this->load->model('supracategoria');
    $data = $this->supracategoria->getAllSupraCategorias();
    echo json_encode($data);
  }

  public function saveSupra(){
    $this->load->model('supracategoria');
    $this->supracategoria->addSupraCategoria($this->input->post());
    echo json_encode(array());
  }

  public function deleteSupra(){
    $this->load->model('supracategoria');
    $this->supracategoria->deleteSupraCategoria($this->input->post('idSupraCategoria'));
    echo json_encode(array());
  }

}
