<?php
class Logincontroller extends CI_Controller {

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
			//Se valida el login del usuario y  lo redirige a una vista que tenga permitido usar el usuario.
			switch($this->usuariomodel->validLogin()){
				case 0:
					echo "Usuario No Logro Accesar";
					$this->load->view('vistas/daccess');
					break;
				case 1:					
					$this->session->set_userdata($newdata);
					$this->load->view('vistas/header',$vistas);					
					$this->load->view('vistas/admin',$vistas);
					$this->load->view('vistas/footer');					
					break;
				case 2:
					$this->session->set_userdata($newdata);
					$this->load->view('vistas/header');									
		//			$this->load->view('vistas/profesor',$vistas);
					$this->load->view('vistas/footer');					
					break;
				case 3:
					$this->session->set_userdata($newdata);
					$this->load->view('vistas/footer');				
	//				$this->load->view('vistas/supervisor',$vistas);
					$this->load->view('vistas/header');
					break;
				case 4:
					$this->session->set_userdata($newdata);
					$this->load->view('vistas/header');
//					$this->load->view('vistas/userext',$vistas);
					$this->load->view('vistas/footer');
					break;
				case 5:
					echo "Usuario ciego D:";
					break;
			}			
				
		}
	}
}
?>