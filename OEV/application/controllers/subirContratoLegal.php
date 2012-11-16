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
		$this->load->view('usuarios/usuario_legal/menu_legal');
        $this->load->view('usuarios/usuario_legal/subir_ContratoLegal',$proyectos);
		$this->load->view('usuarios/footer');
		$this->load->view('usuarios/usuario_legal/Scripts/subirContratoLegal');
    }
    
    function do_upload()
	{
		$this->load->model('documento');
		$this->load->helper('url');

		
		if($_FILES["archivoContrato"]["size"] > 0){
			$tmpName = $_FILES["archivoContrato"]['tmp_name'];
			$tmpName = $_FILES["archivoContrato"]['tmp_name'];
			$fileSize = $_FILES['archivoContrato']['size'];
			$file_info = pathinfo($_FILES['archivoContrato']['name']);
			$fileExt = pathinfo($_FILES['archivoContrato']['name'], PATHINFO_EXTENSION); //Obtiene la extension del archivo
			$fileType = $_FILES['archivoContrato']['type'];
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
		$this->documento->setType($fileType);
		$this->documento->setSize($fileSize);
		$this->documento->setExtension($fileExt);
		//$aceptada = $this->input->post('esAceptada') == 1 ? 1 : 0;
		//El contrato legal esta aceptado por defacto
		$this->documento->setEstaAceptado(1);
		
		$this->documento->deleteContratos();
		$this->documento->insert();
		sleep(3);
		redirect('subirContratoLegal', 'location'); 
	}
}
