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
			$this->usuariomodel->actualizarInfo($this->input->post('susuario'),$this->input->post('password'));
			$resultado = array("pass"=>$this->input->post('password'));
			// subject
			$titulo = 'Cambio de Contraseña';
			// message
			// Para enviar un correo HTML mail, la cabecera Content-type debe fijarse
			$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
			$cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";
			// Mail it
			mail($this->input->post('susuario'), $titulo, $this->load->view('/usuarios/administrador/mailContrasena',$resultado,'TRUE'), $cabeceras);
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