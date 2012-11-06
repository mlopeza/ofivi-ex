<?php
class AceptaUsuarios extends CI_Controller {

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
		$query['data']=$this->usuariomodel->getUsuariosPendientes();
		//Manda los datos al header
		$this->load->view('usuarios/header',$vista);
		$this->load->view('usuarios/administrador/menu_administrador');
		$this->load->view('usuarios/administrador/acepta_usuario',$query);
		$this->load->view('usuarios/footer');
		
	}

	public function insertData()
	{
		//Validacion de datos de entrada
		$this->load->library('form_validation');
		$this->load->helper('administrador');
        $this->load->helper('mail');
		$this->form_validation->set_rules(get_configuracion('administrador/acepta_usuario'));
		
		if ($this->form_validation->run('administrador_acepta_usuario') == FALSE){
			$mensaje = array('response'=>'false','mensaje' => array('mensaje'=>'Error en la actualización.'), 'errores' => validation_errors());
			echo json_encode($mensaje);
		}else{
			$mensaje = array('response'=>'true','mensaje'=>'La actualizacion se realizó correctamente.');
			//Obtiene y limpia los datos
			$data = $this->input->post();
			$this->load->model('usuariomodel');
			$idUsuario = $data['idUsuario'];
			unset($data['idUsuario']);
			unset($data['s_token']);
			$usuario=$this->usuariomodel->actualiza_usuario_array($idUsuario,$data);
			echo json_encode($mensaje);
            enviaMail($this,$usuario[0]->email,"Información de cuenta de OFIVEX",mensajeAlta($usuario[0]));            
		}
	}

}

?>
