<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class areasClientes
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
		$proyectos['proyectos'] = $this->proyecto->selectProyectos($usuario);
		
		//Se cargan las Vistas
		$this->load->view('usuarios/header',$vista);
		$this->load->view('usuarios/administrador/menu_administrador');
        $this->load->view('usuarios/administrador/areasClientesVista',$proyectos);
		$this->load->view('usuarios/footer');
		$this->load->view('usuarios/administrador/Scripts/areasClienteScript');
    }

	//Regresa todas las categorias
    public function getCategorias()
    {
		$this->load->model('categoria');
		//Regresa todas las categorias en JSON
		echo json_encode($this->categoria->getAllCategorias());
    }

	public function deleteCategoria(){
		$this->load->model('categoria');
		$idCategoria = $this->input->post('idCategoria');
		$this->categoria->deleteCategoria($idCategoria);
	}

	public function addCategoria(){
		$this->load->model('categoria');
		$data = $this->input->post('data');
		echo json_encode($data);
		$this->categoria->addCategoria($data);
	}

	//Regresa los reportes de un proyecto de un determinado usuario
    public function reportesDeProyectoAutor()
    {
		$data = $this->input->post();
        try{
	    	$this->load->model('reporte');
	    	$this->load->library('session');
			//Cargar la sesion y se obtiene el id del usuario
			$datos_usuario=$this->session->all_userdata();
			$usuario = $datos_usuario['idUsuario'];
	    	$resultado = $this->reporte->getReportesDeProyectoAutor($usuario,$data['idProyecto']);
			echo json_encode(array('response'=>'true','mensaje'=>$resultado));
        }catch(Exception $e){
			echo json_encode(array('response'=>'false','mensaje'=>"Hubo un error en el Sistema, favor de intentarlo mas tarde.".$e->getMessage()));
		}
    }
    
	/*
	 * Obtiene la descripcion del reporte seleccionado
	 */
	public function getReporte()
	{
		$data = $this->input->post();
        try{
	    	$this->load->model('reporte');
	    	$resultado = $this->reporte->getDescripcionReporte($data['idReporte']);
			echo json_encode(array('response'=>'true','mensaje'=>$resultado));
        }catch(Exception $e){
			echo json_encode(array('response'=>'false','mensaje'=>"Hubo un error en el Sistema, favor de intentarlo mas tarde.".$e->getMessage()));
		}
	}
	
	public function modificaReporte()
	{
		$this->load->model('reporte');
		$this->load->helper('url');
		
		$this->reporte->setReporte($this->input->post('reporteProyecto'));
			
		$this->reporte->modificaReporte($this->input->post('idReporteHidden'));
		redirect('modificarReportes', 'location'); 
		
	}
}
