<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class asignaContacto
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
		//Se carga el Modelo de Grupos
		$this->load->model('grupo');
		//Cargar la sesion		
		$datos_usuario=$this->session->all_userdata();
		$vista = array('vista'=>$datos_usuario['vista']);
		//Se buscan todos los Grupos disponibles
		$query['data']=$this->grupo->getAllGroups();
		
		//Se cargan las Vistas
		$this->load->view('usuarios/header',$vista);
		$this->load->view('usuarios/usuario_extension/menu_extension');
        $this->load->view('usuarios/usuario_extension/asignaContacto',$query);
		$this->load->view('usuarios/footer');
		$this->load->view('usuarios/usuario_extension/Scripts/asignaContacto');
    }

	//Regresa los contactos dando como parametro una empresa
    public function getContactos()
    {
		$data = $this->input->post();
		$this->load->model('contacto_model');
		$resultado=$this->contacto_model->getContactosDeProyecto($data['idProyecto'],$data['idEmpresa']);
		echo json_encode($resultado);
    }

	/*Regresa las empresas en Formato JSON*/
	public function getEmpresas(){
		//Obtiene la informacion del POST
		$data = $this->input->post();
		//echo var_dump($data);
		if($data['idGrupo'] == null){
			//Si no vienen Datos, regresa error
			$mensaje = array('response'=>'false','mensaje'=>'Error al Buscar el Grupo.');
			echo json_encode($mensaje);
		}else{
			//Regresa las empresas del Grupo
			$this->load->model('empresa');
			$resultado=$this->empresa->getEmpresasDeGrupo($data['idGrupo']);
			//Se envia el resultado
			$mensaje = array('response'=>'true','mensaje'=>$resultado);
			echo json_encode($mensaje);
		}
	}

	/*Regresa los Proyectos en formato JSON*/
	public function getProyectos(){
		//Obtiene la informacion del POST
		$data = $this->input->post();
		//echo var_dump($data);
		if(!isset($data['idEmpresa'])){
			//Si no vienen Datos, regresa error
			$mensaje = array('response'=>'false','mensaje'=>'Error al Buscar la Empresa.');
			echo json_encode($mensaje);
		}else{
			//Regresa las empresas del Grupo
			$this->load->model('empresa');
			$resultado=$this->empresa->getProyectosDeEmpresa($data['idEmpresa']);
			//Se envia el resultado
			$mensaje = array('response'=>'true','mensaje'=>$resultado);
			echo json_encode($mensaje);
		}
	}

	public function eRelacion(){
		//Obtiene la informacion del POST
		$data = $this->input->post();
			//Regresa las empresas del Grupo
			$this->load->model('contacto_model');
			$this->contacto_model->eliminaRelacion($data['idProyecto'],$data['idContacto']);
			//Se envia el resultado
			$mensaje = array('response'=>'true');
			echo json_encode($data);
		}

	public function cRelacion(){
		//Obtiene la informacion del POST
		$data = $this->input->post();
			//Regresa las empresas del Grupo
			$this->load->model('contacto_model');
			$this->contacto_model->creaRelacion($data['idProyecto'],$data['idContacto']);
			//Se envia el resultado
			$mensaje = array('response'=>'true');
			echo json_encode($data);
		}


}
