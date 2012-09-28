<?php
class Logincontroller extends CI_Controller {

	public function index()
	{
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->view('login');
	}
	public function signup()
	{
		$this->load->model('usuariomodel');
		$this->load->model('departamento');
		$this->departamento->set_nombre($this->input->post('departamento'));
		if($this->departamento->find()){
			
			$this->usuariomodel->setIdDepartamento($this->departamento->get_id_departamento());

			$this->usuariomodel->setUsername($this->input->post('username'));
		$this->usuariomodel->setNombre($this->input->post('nombre'));
			$this->usuariomodel->setApellidoP($this->input->post('apellido-paterno'));
			$this->usuariomodel->setPassword($this->input->post('password'));
			$this->usuariomodel->setTipoUsuario($this->input->post('tipo-usuario'));
			$this->usuariomodel->setUsuarioActivo(0);
			$this->usuariomodel->setUsuarioAceptado('e');
			$this->usuariomodel->insertarUsuario();
			echo 'Departamento Encontrado. Llego hasta el final';

		}		
	}	
	public function login()
	{
		$this->load->model('usuariomodel');
		$this->load->helper('security');		
		$this->usuariomodel->setUsername($this->input->post('username'));				
		if($this->usuariomodel->encontrarUsuario()){

			switch($this->usuariomodel->validLogin()){
				case 0:
					echo "Usuario No Logro Accesar";
					break;
				case 1:
					echo "Vista Administrador";
					break;
				case 2:
					echo "Vista Profesor";
					break;
				case 3:
					echo "Vista Supervisor Extension";
					break;
				case 4:
					echo "Vista Usuario de Extension";
					break;
				case 5:
					echo "Usuario ciego D:";
					break;
			}			
				
		}
	}
}
?>