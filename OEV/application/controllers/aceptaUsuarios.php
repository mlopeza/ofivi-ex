<?php
class AceptaUsuarios extends CI_Controller {

	public function index()
	{
		$this->load->helper('url');
		$this->load->helper('administrador');
		$this->load->model('usuariomodel');
        $this->load->helper('form');
		$query['data']=$this->usuariomodel->getUsuariosPendientes();
		$this->load->view('usuarios/header');
		$this->load->view('usuarios/administrador/menu_administrador');
		$this->load->view('usuarios/administrador/acepta_usuario',$query);
		$this->load->view('usuarios/footer');
		
	}

	public function insertData()
	{
		//Validacion de datos de entrada
		$this->load->library('form_validation');
		$this->load->helper('administrador');
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
			$this->usuariomodel->actualiza_usuario_array($idUsuario,$data);
			//Actualiza el Registro
/*			$datum = array(
				'Tipo_Usuario' => 'p',
				'Username' => 'evesdrop_fake_hack_hack',
				'Usuario_Aceptado' => 'a',
				'Vista_Administrador'=> 0,
				'Vista_Cliente'=> 0,
				'Vista_Legal'=> 0,
				'Vista_Profesor'=> 0,
				'Vista_Supervisor_Extension'=> 0,
				'Vista_Usuario_Extension'=> 0,
				'idDepartamento'=> 1
            );*/

			echo json_encode($data);
		}

 
 	
    
		/*$posts = array();
        foreach($_POST as $key => $value) {
			$posts[$key] = $this->post($key);
			echo "<p>Key: ".$key. " Value:" . $value . "</p>\n";
        }*/
	}

}

?>
