<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class organizacion
extends CI_Controller {

    public function index()
    {
		//Sesiones

		$this->load->helper('url');
        $this->load->helper('form');
		$this->load->model('usuariomodel');
		$this->load->helper('security');		
		$this->load->library('session');
		//Se carga el Modelo de Grupos
		$this->load->model('grupo');
		//Cargar la sesion		
		$datos_usuario=$this->session->all_userdata();
		$vista = array('vista'=>$datos_usuario['vista']);
		//Se buscan todos los Grupos disponibles
		$query['data']=$this->grupo->getAllGroups();
		//Se cargan las Vistas
		$this->load->view('usuarios/header',$vista);
		$this->load->view('usuarios/administrador/menu_administrador');
        $this->load->view('usuarios/administrador/organizacion',$query);
		$this->load->view('usuarios/footer');
		$this->load->view('usuarios/administrador/Scripts/organizacionScript');
    }

    //Regresa todos los campus disponibles
    public function getCampus()
    {
		$this->load->model('campus');
		$resultado=$this->campus->getAll();
		echo json_encode($resultado);
    }

    //Actualiza o Inserta un nuevo campus
    public function saveCampus(){
		$this->load->model('campus');
		$this->campus->saveCampus($this->input->post());
    }

    //Actualiza o Inserta un nuevo campus
    public function deleteCampus(){
		$this->load->model('campus');
		$this->campus->deleteCampus($this->input->post());
    }

    //Se toman todas las escuelas de un campus
    public function getEscuelas(){
		$this->load->model('campus');
		$resultado=$this->campus->getEscuelas($this->input->post());
        echo json_encode($resultado);
    }

    //Se elimina una escuela
    public function deleteEscuela(){
		$this->load->model('escuela');
		$this->escuela->deleteEscuela($this->input->post());
    }

    //Se agrega una escuela
    public function saveEscuela(){
		$this->load->model('escuela');
		$this->escuela->insertaEscuela($this->input->post());
    }

    //Se agrega una escuela
    public function getDepartamentos(){
		$this->load->model('escuela');
		$response=$this->escuela->getDepartamentos($this->input->post());
        echo json_encode($response);
    }

    //Se elimina un departamento
    public function deleteDepartamento(){
		$this->load->model('departamento');
		$this->departamento->deleteDepartamento($this->input->post());
    }


    //Se Guarda un departamento
    public function saveDepartamento(){
		$this->load->model('departamento');
		$this->departamento->insertaDepartamento($this->input->post());
    }

}
