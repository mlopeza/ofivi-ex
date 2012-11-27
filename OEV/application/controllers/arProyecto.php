<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class arProyecto
extends CI_Controller {

    public function index()
    {
		//Sesiones

		$this->load->helper('url');
        $this->load->helper('form');
		$this->load->model('grupo_area_model');
		$this->load->model('proyecto');
		$this->load->helper('security');		
		$this->load->model('usuariomodel');

		$this->load->library('session');
		//Cargar la sesion		
		$datos_usuario=$this->session->all_userdata();
		$vista = array('vista'=>$datos_usuario['vista']);

        //Regresa los proyectos iniciados por el usuario y que esten activos
        $proyectos=$this->proyecto->getProyectosAsignados($this->usuariomodel->obtenId($datos_usuario['username']),1);
        $areas = $this->grupo_area_model->getGruposyAreas();
		//Se cargan las Vistas
		$this->load->view('usuarios/header',$vista);
		$this->load->view('usuarios/usuario_proyecto/menu_uproyecto');
        $this->load->view('usuarios/usuario_proyecto/arProyecto',array('proyectos'=>$proyectos,'areas'=>$areas));
		$this->load->view('usuarios/footer');
		$this->load->view('usuarios/usuario_proyecto/Scripts/arProyecto');
    }

	//Regresa los contactos dando como parametro una empresa
    public function getDescripciones()
    {
		$data = $this->input->post();
        try{
	    	$this->load->model('proyecto');
    		$resultado=$this->proyecto->getDescripciones($data['idProyecto']);
       		echo json_encode(array('response'=>'true','mensaje'=>$resultado));
        }catch(Exception $e){
			echo json_encode(array('response'=>'false','mensaje'=>"Hubo un error en el Sistema, favor de intentarlo mas tarde.".$e->getMessage()));
		}
    }

	//Regresa los contactos dando como parametro una empresa
    public function setRespuesta()
    {
		$data = $this->input->post();
        try{
	    	$this->load->model('proyecto');
    		$resultado=$this->proyecto->setRespuesta($data['idProyecto'],$data['data']);
	     	echo json_encode(array('response'=>'true'));
        }catch(Exception $e){
			echo json_encode(array('response'=>'false','mensaje'=>"Hubo un error en el Sistema, favor de intentarlo mas tarde.".$e->getMessage()));
		}
    }

}
