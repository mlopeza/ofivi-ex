<?php
class Logincontroller extends CI_Controller {

	//Metodo que carga la página donde el usuario podrá loggearse o soliticitar una cuenta.
	public function index()
	{
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->view('login');
	}
	
	//Funcion para solicitar una cuenta
	public function signup()
	{
		$this->load->model('usuariomodel');
		$this->load->model('departamento');
		$this->departamento->set_nombre($this->input->post('departamento'));		
		$this->load->helper('url');
		//Se busca el departamento para poder agregarlo a tabla de usaurios.
		if($this->departamento->find()){			
			$this->usuariomodel->insertarUsuario(
			$this->departamento->get_id_departamento(),$this->input->post('username'),$this->input->post('nombre'),	$this->input->post('apellido_paterno'),$this->input->post('apellido_materno'),$this->input->post('email'),$this->input->post('password'),$this->input->post('tipo-usuario'),0,'e');
		}
		$this->load->view('register_sucess');
	}	
	//Funcion para cambiar la vista.
	public function cambioVista($nombre)
	{
		$this->load->library('session');
		$this->load->model('usuariomodel');
		$this->load->helper('url');
		$usuario = $this->session->userdata('username');		
		$this->usuariomodel->encontrarUsuarioVista($usuario);
		$vistas['vista'] = array(
							'Usuario' => $this->usuariomodel->getVistaUsuarioExtension(),
							'Supervisor' => $this->usuariomodel->getVistaSupervisorExtension(),
							'Administrador' => $this->usuariomodel->getVistaAdministrador(),
							'Legal' => $this->usuariomodel->getVistaLegal(),
							'Profesor' => $this->usuariomodel->getVistaProfesor() );
		if($nombre == 'Usuario'){
					$this->load->view('usuarios/header',$vistas);					
					$this->load->view('usuarios/usuario_extension/menu_extension',$vistas);
					$this->load->view('usuarios/footer');			
		}
		else if( $nombre == 'Supervisor'){
					$this->load->view('usuarios/header',$vistas);					
//					$this->load->view('usuarios/administrador/menu_administrador',$vistas);
					$this->load->view('usuarios/footer');						
		}
		else if ($nombre == 'Administrador'){
					$this->load->view('usuarios/header',$vistas);					
					$this->load->view('usuarios/administrador/menu_administrador',$vistas);
					$this->load->view('usuarios/footer');			
		}
		else if ($nombre == 'Legal'){
//					$this->load->view('usuarios/header',$vistas);					
//					$this->load->view('usuarios/administrador/menu_administrador',$vistas);
//					$this->load->view('usuarios/footer');						
					echo "prueba";
		}
		else if ($nombre == 'Profesor'){			
					$this->load->view('usuarios/header',$vistas);					
					$this->load->view('usuarios/usuario_proyecto/menu_uproyecto',$vistas);
					$this->load->view('usuarios/footer');					
		}
		
	}

	public function logout(){
		$this->load->helper('url');
		$this->load->helper('security');		
		$this->load->library('session');
		$data = array();
		$this->session->set_userdata($data);
		$this->session->sess_destroy();
		redirect(base_url("index.php/logincontroller"), 'location'); 
		
	}


	//Funcion para loggearse.
	public function login()
	{
		$this->load->model('usuariomodel');
		$this->load->helper('security');		
		$this->load->library('session');
		$this->load->helper('url');
		$this->usuariomodel->setUsername($this->input->post('username'));
		//se verifica que el usuario exista en la base de datos.
		if($this->usuariomodel->encontrarUsuario()){
			//Se valida el login del usuario y  lo redirige a una vista que tenga permitido usar el usuario.
			switch($this->usuariomodel->validLogin()){
				case 0:
					$this->load->view('login_failed');
					break;
				case 1:					
						$vistas['vista'] = array(
							'Usuario' => $this->usuariomodel->getVistaUsuarioExtension(),
							'Supervisor' => $this->usuariomodel->getVistaSupervisorExtension(),
							'Administrador' => $this->usuariomodel->getVistaAdministrador(),
							'Legal' => $this->usuariomodel->getVistaLegal(),
							'Profesor' => $this->usuariomodel->getVistaProfesor() );
						$newdata = array(
                            'idUsuario' => $this->usuariomodel->getidUsuario(),
        	           		'username'  => $this->usuariomodel->getUsername(),
	            	       'email'     => $this->usuariomodel->getEmail(),
						   'nombre'    => $this->usuariomodel->getNombre()." ".$this->usuariomodel->getApellidoP()
			               );
					$this->session->set_userdata($newdata);
					$this->session->set_userdata($vistas);
					$this->load->view('usuarios/header',$vistas);					
					$this->load->view('usuarios/administrador/menu_administrador',$vistas);
					$this->load->view('usuarios/footer');					
					break;
		/*		case 2:
					$vistas['vista'] = array(
						'Usuario' => $this->usuariomodel->getVistaUsuarioExtension(),
						'Supervisor' => $this->usuariomodel->getVistaSupervisorExtension(),
						'Administrador' => $this->usuariomodel->getVistaAdministrador(),
						'Legal' => $this->usuariomodel->getVistaLegal(),
						'Profesor' => $this->usuariomodel->getVistaProfesor() );
					$newdata = array(
        	           'username'  => $this->usuariomodel->getUsername(),
            	       'email'     => $this->usuariomodel->getEmail(),
					   'nombre'    => $this->usuariomodel->getNombre()." ".$this->usuariomodel->getApellidoP()
		               );
					$this->session->set_userdata($newdata);
					$this->load->view('vistas/header');									
		//			$this->load->view('vistas/profesor',$vistas);
					$this->load->view('vistas/footer');					
					break;
				case 3:
					$vistas['vista'] = array(
						'Usuario' => $this->usuariomodel->getVistaUsuarioExtension(),
						'Supervisor' => $this->usuariomodel->getVistaSupervisorExtension(),
						'Administrador' => $this->usuariomodel->getVistaAdministrador(),
						'Legal' => $this->usuariomodel->getVistaLegal(),
						'Profesor' => $this->usuariomodel->getVistaProfesor() );
					$newdata = array(
        	           'username'  => $this->usuariomodel->getUsername(),
            	       'email'     => $this->usuariomodel->getEmail(),
					   'nombre'    => $this->usuariomodel->getNombre()." ".$this->usuariomodel->getApellidoP()
		               );
					$this->session->set_userdata($newdata);
					$this->load->view('vistas/footer');				
	//				$this->load->view('vistas/supervisor',$vistas);
					$this->load->view('vistas/header');
					break;/*/
				case 4:
					$vistas['vista'] = array(
						'Usuario' => $this->usuariomodel->getVistaUsuarioExtension(),
						'Supervisor' => $this->usuariomodel->getVistaSupervisorExtension(),
						'Administrador' => $this->usuariomodel->getVistaAdministrador(),
						'Legal' => $this->usuariomodel->getVistaLegal(),
						'Profesor' => $this->usuariomodel->getVistaProfesor() );
					$newdata = array(
        	           'username'  => $this->usuariomodel->getUsername(),
            	       'email'     => $this->usuariomodel->getEmail(),
					   'nombre'    => $this->usuariomodel->getNombre()." ".$this->usuariomodel->getApellidoP()
		               );
					$this->session->set_userdata($newdata);
					$this->session->set_userdata($vistas);
					$this->load->view('usuarios/header',$vistas);					
					$this->load->view('usuarios/usuario_extension/menu_extension',$vistas);
					$this->load->view('usuarios/footer');	
					break;
				/*case 5:
				$vistas['vista'] = array(
						'Usuario' => $this->usuariomodel->getVistaUsuarioExtension(),
						'Supervisor' => $this->usuariomodel->getVistaSupervisorExtension(),
						'Administrador' => $this->usuariomodel->getVistaAdministrador(),
						'Legal' => $this->usuariomodel->getVistaLegal(),
						'Profesor' => $this->usuariomodel->getVistaProfesor() );
					$newdata = array(
        	           'username'  => $this->usuariomodel->getUsername(),
            	       'email'     => $this->usuariomodel->getEmail(),
					   'nombre'    => $this->usuariomodel->getNombre()." ".$this->usuariomodel->getApellidoP()
		               );
					$this->session->set_userdata($newdata);
					$this->load->view('vistas/header');
//					$this->load->view('vistas/legal',$vistas);
					$this->load->view('vistas/footer');
					break;
				 case 6:
					echo "Usuario ciego D:";
					break;*/
			}			
				
		}
		else
		$this->load->view('login_failed');
	}
}
?>
