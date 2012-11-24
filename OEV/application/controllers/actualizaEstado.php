<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ActualizaEstado
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
		$proyectos['proyectos'] = $this->proyecto->getProyectosAceptados($usuario);
		
		//Se cargan las Vistas
		$this->load->view('usuarios/header',$vista);
		$this->load->view('usuarios/usuario_proyecto/menu_uproyecto');
        $this->load->view('usuarios/usuario_proyecto/actualiza_Estado',$proyectos);
		$this->load->view('usuarios/footer');
		$this->load->view('usuarios/usuario_proyecto/Scripts/actualizaEstado');
    }
    
	function actualizaEstadoProyecto()
	{
		$this->load->model('estado');
		$this->load->helper('url');
		$this->load->library('session');

		//Cargar la sesion y se obtiene el id del usuario
		$datos_usuario=$this->session->all_userdata();
		$vista = array('vista'=>$datos_usuario['vista']);
		$usuario = $datos_usuario['idUsuario'];
		
		$idProyecto = $this->input->post('idProyectoActualizar');
		$estado = $this->input->post('nuevoEstado');
		
		$this->estado->setIdProyecto($idProyecto);
		$this->estado->setIdUsuario($usuario);
		$this->estado->setEstado($estado);
		
		$this->estado->insert();
		sleep(3);
		redirect('actualizaEstado', 'location'); 
	}
	
	function getEstadoProyecto()
	{
		$data = $this->input->post();
		try{
			$this->load->model('estado');
			$resultado = $this->estado->getEstadoProyecto($data['idProyecto']);
			echo json_encode(array('response'=>'true','mensaje'=>$resultado));
        }catch(Exception $e){
			echo json_encode(array('response'=>'false','mensaje'=>"Hubo un error en el Sistema, favor de intentarlo mas tarde.".$e->getMessage()));
		}
	}
}
