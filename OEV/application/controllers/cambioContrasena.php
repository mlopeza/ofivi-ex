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
	public function cambiarContrasena()
	{
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('usuariomodel');
		$this->form_validation->set_rules('password', 'Password', 'required|matches[password_confirm]');
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
}
?>
