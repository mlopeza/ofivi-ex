<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class descargarPropuesta
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
		//Cargar la sesion y se obtiene el id del usuario
		$datos_usuario=$this->session->all_userdata();
		$vista = array('vista'=>$datos_usuario['vista']);
		$usuario = $datos_usuario['idUsuario'];
		//Se buscan todos los proyectos relacionados al usuario
		$proyectos['proyectos'] = $this->proyecto->selectProyectosAceptados($usuario);
		
		//Se cargan las Vistas
		$this->load->view('usuarios/header',$vista);
		$this->load->view('usuarios/usuario_proyecto/menu_uproyecto');
        $this->load->view('usuarios/usuario_proyecto/subir_Propuesta',$proyectos);
		$this->load->view('usuarios/footer');
		$this->load->view('usuarios/usuario_proyecto/Scripts/subirPropuesta');
    }
    
    function do_download()
	{
		$this->load->model('documento');
		$this->load->helper('url');

		$documento=$this->documento->getDocument(3);
		$size = $documento[0]->Size;
		$type = $documento[0]->Extension;
		$name = $documento[0]->Titulo;
		$content = $documento[0]->Archivo;

		header("Content-length: ".$size."");
		header("Content-type: ".$type."");
		header('Content-Disposition: attachment; filename="'.$name.'"');
		echo $content;
	}
}
?>
