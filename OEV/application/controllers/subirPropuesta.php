<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class subirPropuesta
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
		$this->load->model('usuariomodel');
		//Cargar la sesion y se obtiene el id del usuario
		$datos_usuario=$this->session->all_userdata();
		$vista = array('vista'=>$datos_usuario['vista']);
		$usuario = $this->usuariomodel->obtenId($datos_usuario['username']);
		//Se buscan todos los proyectos relacionados al usuario
		$proyectos['proyectos'] = $this->proyecto->selectProyectosAceptadosNoFinalizados($usuario);
		
		//Se cargan las Vistas
		$this->load->view('usuarios/header',$vista);
		$this->load->view('usuarios/usuario_proyecto/menu_uproyecto');
        $this->load->view('usuarios/usuario_proyecto/subir_Propuesta',$proyectos);
		$this->load->view('usuarios/footer');
		$this->load->view('usuarios/usuario_proyecto/Scripts/subirPropuesta');
    }
    
    function do_upload()
	{
		$this->load->model('documento');
		$this->load->helper('url');

		
		if($_FILES["archivoPropuesta"]["size"] > 0){
			$tmpName = $_FILES["archivoPropuesta"]['tmp_name'];
			$fileSize = $_FILES['archivoPropuesta']['size'];
			$file_info = pathinfo($_FILES['archivoPropuesta']['name']);
			$fileExt = pathinfo($_FILES['archivoPropuesta']['name'], PATHINFO_EXTENSION); //Obtiene la extension del archivo
			$fileType = $_FILES['archivoPropuesta']['type'];
			$fp = fopen($tmpName, 'r');
			$file = fread($fp, filesize($tmpName));
			$file = addslashes($file);
			fclose($fp);
		}
		$data = $this->input->post();
		
		$this->documento->setIdProyecto($this->input->post('idProyectoPropuesta'));
		$this->documento->setTitulo($this->input->post('tituloPropuesta'));
		$this->documento->setArchivo($file);
		$this->documento->setEsPropuesta(1);
		$this->documento->setType($fileType);
		$this->documento->setSize($fileSize);
		$this->documento->setExtension($fileExt);
		//$aceptada = $this->input->post('esAceptada') == 1 ? 1 : 0;
		//$this->documento->setEstaAceptado($aceptada);
		
		$this->documento->deletePropuestas();
		$this->documento->insert();
		sleep(3);
		redirect('subirPropuesta', 'location'); 
	}
}
?>
