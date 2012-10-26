<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class altaProyecto
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
		$this->load->view('usuarios/usuario_extension/menu_extension');
        $this->load->view('usuarios/usuario_extension/altaProyecto',$query);
		$this->load->view('usuarios/footer');
		$this->load->view('usuarios/usuario_extension/Scripts/altaProyecto');
    }

	//Regresa los contactos dando como parametro una empresa
    public function getContactos()
    {
//		$data = $this->input->post();
		$data = $this->input->get();
		$this->load->model('contacto_model');
		$resultado=$this->contacto_model->getContactosDeEmpresa($data['idEmpresa'],$data['q']);
		error_log(json_encode($data), 0);
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

	public function guardaProyecto(){
		try{
		$data = $this->input->post();
		$this->load->model('contacto_model');
		$this->load->model('proyecto');
		$oldContactos = empty($data['oldContactos'])? array() :$data['oldContactos'];
		$newContactos = empty($data['newContactos'])? array() :$data['newContactos'];
		//Crea los nuevos contactos y regresa un arreglo con sus identificadores
		$arregloContactos = $this->contacto_model->creaContactosConTelefono($newContactos,$data['idEmpresa']);
		//Crea el Proyecto
		$idProyecto = $this->proyecto->altaProyecto($data['idEmpresa'],$data['nombre_proyecto'],$data['descripcionCliente'],$data['descripcionUsuario'],$data['iniciadoPor']);
		//Asigna los contactos al proyecto
        $this->proyecto->agregaContactos($oldContactos,$arregloContactos,$idProyecto);
			echo json_encode(array('response'=>'true','mensaje'=>"El proyecto se creó correctamente."));

		}catch(Exception $e){
			echo json_encode(array('response'=>'false','mensaje'=>"Hubo un error en el Sistema, favor de intentarlo mas tarde.".$e->getMessage()));
		}
	}

}
