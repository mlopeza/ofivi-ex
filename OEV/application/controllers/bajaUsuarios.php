<?php
class BajaUsuarios extends CI_Controller {

	public function index()
	{
		$this->load->helper('url');
		$this->load->helper('administrador');
		$this->load->model('usuariomodel');
        $this->load->helper('form');
		$this->load->helper('security');		
		$this->load->library('session');
    if($this->session->userdata('vista')){
    
    }else{
      redirect('/logincontroller', 'location');
    }
		//Toma las variables de la session
		$vista= array('vista'=>$this->session->userdata('vista'));
		$query['data']=$this->usuariomodel->getUsuariosActivos();
		//Manda los datos al header
		$this->load->view('usuarios/header',$vista);
		$this->load->view('usuarios/administrador/menu_administrador');
		$this->load->view('usuarios/administrador/baja_usuario',$query);
		$this->load->view('usuarios/footer');
		
	}
	public function dardeBaja(){
		$data = $this->input->post();
		if ($data['idUsuario'] == ''){
			$mensaje = array('response'=>'false','mensaje' => array('mensaje'=>'Error en la actualización.'), 'errores' => validation_errors());
			echo json_encode($mensaje);
		}else{
			$mensaje = array('response'=>'true','mensaje'=>'La actualizacion se realizó correctamente.');
			//Obtiene y limpia los datos
			$this->load->model('usuariomodel');
			$usuario=$this->usuariomodel->darDeBaja($data['idUsuario']);
			echo json_encode($mensaje);
		}
	}
}
?>
