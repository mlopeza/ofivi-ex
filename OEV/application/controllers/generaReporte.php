<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class generaReporte
extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -  
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
		$this->load->helper('url');
        $this->load->helper('form');
		$this->load->model('usuariomodel');
		$this->load->helper('security');		
		$this->load->library('session');
		$this->load->model('proyecto');
		//Cargar la sesion		
		$datos_usuario=$this->session->all_userdata();
		$vista = array('vista'=>$datos_usuario['vista']);
		
		//Obtener lista de proyectos
		$proyectos['proyectos'] = $this->proyecto->selectProyectos();
		
		//Se cargan las Vistas
		$this->load->view('usuarios/header',$vista);
		$this->load->view('usuarios/usuario_extension/menu_extension');
        $this->load->view('usuarios/usuario_extension/genera_Reporte',$proyectos);
		$this->load->view('usuarios/footer');
		//$this->load->view('usuarios/usuario_extension/Scripts/altaProyecto');
    }
    
    public function alta()
    {
		$this->load->model('reporte');
		$this->load->helper('url');
		$this->load->model('usuariomodel');
		$this->load->library('session');
		
		//Se toma el id del usuario de la sesion		
		$datos_usuario=$this->session->all_userdata();
		$usuario = $datos_usuario['idUsuario'];
		$this->usuariomodel->setUsername($usuario);
		
		//Se agregan los datos del reporte
		$this->reporte->setIdProyecto($this->input->post('idProyecto'));
		$this->reporte->setIdUsuario($usuario);
		$this->reporte->setTitulo($this->input->post('titulo'));
		$this->reporte->setReporte($this->input->post('reporteProyecto'));
		$final = $this->input->post('reporteFinal') == 1 ? 1 : 0;
		$this->reporte->setReporteFinal($final);
		
		//Se inserta el reporte
		$this->reporte->insert();
		redirect('generaReporte', 'location'); 
	}
}
