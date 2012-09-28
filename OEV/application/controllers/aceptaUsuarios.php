<?php
class AceptaUsuarios extends CI_Controller {

	public function index()
	{
		$this->load->helper('url');
		$this->load->helper('formatter');
		$this->load->model('usuariomodel');
		$query['data']=$this->usuariomodel->getUsuariosPendientes();
		$this->load->view('usuarios/header');
		$this->load->view('usuarios/administrador/menu_administrador');
		$this->load->view('usuarios/administrador/acepta_usuario',$query);
		$this->load->view('usuarios/footer');
		
	}
}
?>
