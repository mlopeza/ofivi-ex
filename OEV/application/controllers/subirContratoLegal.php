<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class subirContratoLegal
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
		$proyectos['proyectos'] = $this->proyecto->selectProyectosAceptados($usuario);
		
		//Se cargan las Vistas
		$this->load->view('usuarios/header',$vista);
		$this->load->view('usuarios/usuario_proyecto/menu_uproyecto');
        $this->load->view('usuarios/usuario_proyecto/subir_ContratoLegal',$proyectos);
		$this->load->view('usuarios/footer');
		$this->load->view('usuarios/usuario_proyecto/Scripts/subirContratoLegal');
    }
    
    function do_upload()
	{
		$this->load->model('documento');
		$this->load->helper('url');

		
		if($_FILES["archivoContrato"]["size"] > 0){
			$tmpName = $_FILES["archivoContrato"]['tmp_name'];
			$fp = fopen($tmpName, 'r');
			$file = fread($fp, filesize($tmpName));
			$file = addslashes($file);
			fclose($fp);
		}
		$data = $this->input->post();
		
		$this->documento->setIdProyecto($this->input->post('idProyectoContrato'));
		$this->documento->setTitulo($this->input->post('tituloContrato'));
		$this->documento->setArchivo($file);
		$this->documento->setEsLegal(1);
		$aceptada = $this->input->post('esAceptada') == 1 ? 1 : 0;
		$this->documento->setEstaAceptado($aceptada);
		
		$this->documento->insert();
		redirect('subirContratoLegal', 'location'); 
	}
}
