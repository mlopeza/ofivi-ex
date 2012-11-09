<?php
class ModificarPerfil extends CI_Controller {

	public function index()
	{
		$this->load->helper('url');
		$this->load->helper('administrador');
		$this->load->model('usuariomodel');
        $this->load->helper('form');
		$this->load->helper('security');		
		$this->load->library('session');
		//Toma las variables de la session
		$vista= array('vista'=>$this->session->userdata('vista'));

		//Manda los datos al header
		$this->load->view('usuarios/header',$vista);
        $this->load->view('usuarios/modificarPerfil');
		$this->load->view('usuarios/footer');
        $this->load->view('usuarios/Scripts/modificarPerfilScript');
		
	}

	public function getUserData()
	{
        $data = $this->input->post();
        if(!isset($data['idUsuario'])){
            return;
        }
        $this->load->model('usuariomodel');
        //Regresa los datso completos del Usuario
        $datos_usuario=$this->usuariomodel->getAllUserData($data);
		echo json_encode($datos_usuario);
	}

	public function deleteTelefono()
	{
        $data = $this->input->post();
        if(!isset($data['idTelefono'])){
            return;
        }
        $this->load->model('usuariomodel');
        $this->usuariomodel->deleteTelefono($data);
	}


	public function savePerfil()
	{
        $data = $this->input->post();
        if(!isset($data['usuario'])){
            return;
        }
        $this->load->model('usuariomodel');
        //Guarda Todo
        $this->usuariomodel->savePerfil($data);
	}
}

?>
