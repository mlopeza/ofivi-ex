<?php
class Logincontroller extends CI_Controller {

	public function index()
	{
		$this->load->helper('form');
		$this->load->view('loginview');
	}
	public function send()
	{
		$this->load->model('loginmodel');
		$usuarios = $this->loginmodel->get_usuarios();
		foreach($usuarios as $usuario){
			if($usuario->Usuario == $_POST['usuario'] && $usuario->Contrasena == $_POST['contrasena']){
				if($usuario->Id === 1){
					echo 'Entraste al index para el usuario con Id 1';
					break;
				}
				else{
					echo 'Entraste al index para el usuario con Id 2';
					break;
				}
			}			
		}		
	}
}
?>