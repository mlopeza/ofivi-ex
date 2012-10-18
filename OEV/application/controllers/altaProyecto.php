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
		$this->load->view('usuarios/usuario_extension/menu_extension',$vista);
        $this->load->view('usuarios/usuario_extension/altaProyecto',$query);
		$this->load->view('usuarios/footer');
		$this->load->view('usuarios/usuario_extension/Scripts/altaProyecto');
    }

    public function alta()
    {
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


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
