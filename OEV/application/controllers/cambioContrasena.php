<?php
class CambioContrasena extends CI_Controller {

	//Metodo que carga la página donde el usuario podrá loggearse o soliticitar una cuenta.
	public function index()
	{
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('usuariomodel');
		$usuarios = $this->usuariomodel->getUsuarios();
		$resultado = array('usuarios'=>$usuarios);
		$this->load->view('/usuarios/administrador/cambioContrasena',$resultado);
	}
	public function cambiarContrasenaUsuario(){
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->view('/usuarios/usuario_extension/cambioContrasena');
	}
	public function cambiarContrasena()
	{
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('usuariomodel');
		$this->form_validation->set_rules('password', 'Password', 'required|matches[password_conf]');
		$this->form_validation->set_rules('password_conf', 'Password Confirmation', 'required');
		if ($this->form_validation->run() == FALSE)
		{
	        $this->load->helper('mail');
			$this->usuariomodel->actualizarInfo($this->input->post('susuario'),$this->input->post('password'));	
            enviaMail($this,$this->usuariomodel->obtenEmail($this->input->post('susuario')),
					  "Información de cuenta de OFIVEX",
					  mensajeContrasena(
					  	$this->usuariomodel->obtenNombre(
							$this->input->post('susuario')
						),
						$this->input->post('password')
					)
			);            
		}
		else
		{
			$usuarios = $this->usuariomodel->getUsuarios();
			$resultado = array('usuarios'=>$usuarios);
			$this->load->view('/usuarios/administrador/cambioContrasena',$resultado);
		}

	}
	public function cambiarContrasenaU(){
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->model('usuariomodel');
		$this->form_validation->set_rules('passwordActual', 'Password Actual', 'callback_username');
		$this->form_validation->set_rules('password', 'Password', 'required|matches[password_conf]|trim');
		$this->form_validation->set_rules('password_conf', 'Password Confirmation', 'required');		
		$this->form_validation->set_message('required','%s Campo Requerido');
		$this->form_validation->set_message('matches','Contrase&ntilde;a no son iguales');
		if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('/usuarios/usuario_extension/cambioContrasena');
			}
			else
			{				
			//	$this->usuariomodel->actualizaContra($this->input->post('idUsuario'),$this->input->post('password'));	
			//	$this->load->view('/usuarios/usuario_extension/cambioContrasena');
				//$this->load->view('usuarios/usuario_extension/Scripts/cambiarContrasena');
			}
	}
	public function username($str)
	{
		$this->load->model('usuariomodel');
		if ($this->usuariomodel->comparaContra($this->input->post('idUsuario'),$str) == 0)
		{
			$this->form_validation->set_message('username', 'Las Contrase&ntilde;as no coinciden');

			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
}
?>
