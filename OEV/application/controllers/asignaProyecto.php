<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class asignaProyecto
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
		//Cargar la sesion		
		$datos_usuario=$this->session->all_userdata();
		$vista = array('vista'=>$datos_usuario['vista']);

        //Regresa los proyectos iniciados por el usuario y que esten activos
        $proyectos=$this->proyecto->getProyectosIniciados($datos_usuario['idUsuario'],1);
        $areas = $this->grupo_area_model->getGruposyAreas();
		//Se cargan las Vistas
		$this->load->view('usuarios/header',$vista);
		$this->load->view('usuarios/usuario_extension/menu_extension');
        $this->load->view('usuarios/usuario_extension/asignaProyecto',array('proyectos'=>$proyectos,'areas'=>$areas));
		$this->load->view('usuarios/footer');
		$this->load->view('usuarios/usuario_extension/Scripts/asignaProyecto');
    }

	//Regresa los contactos dando como parametro una empresa
    public function buscaProfesores()
    {
		$data = $this->input->post();
        try{
	    	$this->load->model('usuariomodel');
    		$resultado=$this->usuariomodel->getUsuariosAreas($data['lista']);
       		echo json_encode(array('response'=>'true','mensaje'=>$resultado));
        }catch(Exception $e){
			echo json_encode(array('response'=>'false','mensaje'=>"Hubo un error en el Sistema, favor de intentarlo mas tarde.".$e->getMessage()));
		}
    }

	//Regresa los contactos dando como parametro una empresa
    public function profesoresAsignados()
    {
		$data = $this->input->post();
        try{
	    	$this->load->model('proyecto');
    		$resultado=$this->proyecto->getAsignados($data['idProyecto']);
		echo json_encode(array('response'=>'true','mensaje'=>$resultado));
        }catch(Exception $e){
			echo json_encode(array('response'=>'false','mensaje'=>"Hubo un error en el Sistema, favor de intentarlo mas tarde.".$e->getMessage()));
		}
    }

	//Regresa los contactos dando como parametro una empresa
    public function asignaProfesor()
    {
		$data = $this->input->post();
        try{
        $this->load->helper('mail');
	    	$this->load->model('proyecto');
	    	$this->load->model('usuariomodel');
    		$respuesta=$this->proyecto->setProfesor($data['data']);
        if($respuesta == True){
          $result1=$this->proyecto->getResumenProyecto($data['data']['idProyecto']);
          $result2=$this->usuariomodel->getUSuario($data['data']['idUsuario']);
          //Mensaje al Usuario de Asignacion
          $mensaje=$this->load->view('mensajes/mensajeAsignacion',array('r'=>$result1,'p'=>$result2),true);
          $sent = enviaMail($this,$result2->email,'Nuevo Proyecto en OFIVEX',$mensaje);
        }
        //Respuesta
    		echo json_encode(array('response'=>'true','mensaje'=>"Usuario Asignado"));
        }catch(Exception $e){
			echo json_encode(array('response'=>'false','mensaje'=>"Hubo un error en el Sistema, favor de intentarlo mas tarde.".$e->getMessage()));
		}
    }


	//Elimina la asignacion de un Usuario a Un proyecto
    public function eliminaAsignacion()
    {
		$data = $this->input->post();
	    	$this->load->model('proyecto');
    		$this->proyecto->eliminaAsignacion($data['data']);
            if($this->db->_error_message() == null){
        		echo json_encode(array('response'=>'true','mensaje'=>"Usuario Eliminado"));
            }else{
    			echo json_encode(array('response'=>'false','mensaje'=>"Hubo un error en el Sistema, favor de intentarlo mas tarde.".$this->db->_error_message()));
            }
    }
}
