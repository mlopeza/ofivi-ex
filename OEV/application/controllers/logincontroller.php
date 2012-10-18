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
		//Se busca el departamento para poder agregarlo a tabla de usaurios.
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
		}		
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
        	           		'username'  => $this->usuariomodel->getUsername(),
	            	       'email'     => $this->usuariomodel->getEmail(),
						   'nombre'    => $this->usuariomodel->getNombre()." ".$this->usuariomodel->getApellidoP()
			               );
					$this->session->set_userdata($newdata);
					$this->load->view('usuarios/header',$vistas);					
					$this->load->view('usuarios/administrador/menu_administrador',$vistas);
					$this->load->view('usuarios/footer');					
					break;
				case 2:
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
					$this->load->view('usuarios/header',$vistas);									
					$this->load->view('usuarios/profesor',$vistas);
					$this->load->view('usuarios/footer');					
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
					$this->load->view('usuarios/header',$vistas);				
					$this->load->view('usuarios/supervisor',$vistas);
					$this->load->view('usuarios/footer');
					break;
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
					$this->load->view('usuarios/header',$vistas);					
					$this->load->view('usuarios/usuario_extension/menu_extension',$vistas);
					$this->load->view('usuarios/footer');	
					break;
				case 5:
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
					$this->load->view('usuarios/header',$vistas);
					$this->load->view('usuarios/legal',$vistas);
					$this->load->view('usuarios/footer');
					break; 
				 case 6:
					break;
			}			
				
		}
		else
		$this->load->view('login_failed');
	}
}
?>