<?php
class Logincontroller extends CI_Controller {

	//Metodo que carga la página donde el usuario podrá loggearse o soliticitar una cuenta.
	public function index()
	{
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('campus');
		$array=array("campus"=>$this->campus->selectN());
		$this->load->view('login',$array);
		$this->load->view('Script/validarUsername.html');		
	}

	//Funcion para solicitar una cuenta
	public function signup()
	{
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->database();
		$this->form_validation->set_rules('username', 'Username', 'required|is_unique[usuario.Username]');
		$this->form_validation->set_rules('password', 'Password', 'required|matches[password_confirm]|trim');
		$this->form_validation->set_rules('password_confirm', 'Password Confirmation', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[usuario.email]');
        $this->load->helper('mail');
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('register_failed');
		}
		else{
			$this->load->model('usuariomodel');
			$this->load->model('departamento');
			$this->departamento->set_nombre($this->input->post('departamento'));		
			$this->load->helper('url');
			//Se busca el departamento para poder agregarlo a tabla de usaurios.
			if($this->departamento->find()){			
				$this->usuariomodel->insertarUsuario(
						$this->departamento->get_id_departamento(),$this->input->post('username'),$this->input->post('nombre'),	$this->input->post('apellido_paterno'),$this->input->post('apellido_materno'),$this->input->post('email'),$this->input->post('password'),$this->input->post('tipo-usuario'),0,'e');
			}
        enviaMail($this,$this->input->post('email'),"Bienvenido a OFIVEX",mensajeRegistro($this->input->post('nombre'),$this->input->post('username'),$this->input->post('password')));
			$this->load->view('register_sucess');
		}
	}	

	//Funcion para cambiar la vista.
	public function cambioVista($nombre)
	{
		$this->load->library('session');
		$this->load->model('usuariomodel');
		$this->load->helper('url');
		$usuario = $this->session->userdata('username');		
		$vistas['vista'] = $this->session->userdata('vistas');		
		$this->usuariomodel->encontrarUsuarioVista($usuario);
		$datos_usuario=$this->session->all_userdata();
		$vista = array('vista'=>$datos_usuario['vista']);
		$this->load->view('usuarios/header',$vista);					
		if($nombre == 'Usuario'){
			$this->load->view('usuarios/usuario_extension/menu_extension',$vistas);			
		}
		else if( $nombre == 'Supervisor'){

		}
		else if ($nombre == 'Administrador'){
			$this->load->view('usuarios/administrador/menu_administrador',$vistas);
		}
		else if ($nombre == 'Legal'){
			$this->load->view('usuarios/usuario_legal/menu_legal',$vistas);
		}
		else if ($nombre == 'Profesor'){			
			$this->load->view('usuarios/usuario_proyecto/menu_uproyecto',$vistas);
		}

		$this->load->view('usuarios/footer');						

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
								$this->load->view('usuarios\usuario_proyecto\menu_uproyecto',$vistas);
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
					$this->load->view('vistas/footer');				
					$this->load->view('vistas/supervisor',$vistas);
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
					break;*/
			}			

		}
		else
			$this->load->view('login_failed');
	}
	/*Regresa las empresas en Formato JSON*/
	public function validaUsername(){
		//Obtiene la informacion del POST
		$data = $this->input->post();
		//echo var_dump($data);
		if($data['usuario'] == null){
			//Si no vienen Datos, regresa error
			$mensaje = array('response'=>'false','mensaje'=>'Error al recibir informacion.');
			echo json_encode($mensaje);
		}else{
			//Regresa las empresas del Grupo
			$this->load->model('usuariomodel');
			$this->usuariomodel->setUsername($data['usuario']);
			$resultado=!($this->usuariomodel->encontrarUsuario());
			//Se envia el resultado
			$mensaje = array('response'=>'true','mensaje'=>$resultado);
			echo json_encode($mensaje);
		}
	}
/*Regresa las empresas en Formato JSON*/
	public function getEscuela(){
		//Obtiene la informacion del POST
		$data = $this->input->post();
		//echo var_dump($data);
		if($data['escuela'] == null){
			//Si no vienen Datos, regresa error
			$mensaje = array('response'=>'false','mensaje'=>'Error al Buscar los Proyectos.');
			echo json_encode($mensaje);
		}else{
			//Regresa las empresas del Grupo
			$this->load->model('campus');
			$resultado=$this->campus->getEscuelas(array("idCampus"=>$data['escuela']));
			//Regresa a categoria del proyecto.
			$this->load->model('escuela');
			$resultado2=$this->escuela->getDepartamentos(array("idEscuela"=>$resultado[0]->idEscuela));
	
			//Se envia el resultado
			$mensaje = array('response'=>'true','escuela'=>$resultado,'departamento'=>$resultado2);
			echo json_encode($mensaje);
		}
	}


/*Regresa las empresas en Formato JSON*/
	public function getDepartamento(){
		//Obtiene la informacion del POST
		$data = $this->input->post();
		//echo var_dump($data);
		if($data['departamento'] == null){
			//Si no vienen Datos, regresa error
			$mensaje = array('response'=>'false','mensaje'=>'Error al Buscar los Proyectos.');
			echo json_encode($mensaje);
		}else{
			//Regresa a categoria del proyecto.
			$this->load->model('escuela');
			$resultado2=$this->escuela->getDepartamentos(array("idEscuela"=>$data['departamento']));
	
			//Se envia el resultado
			$mensaje = array('response'=>'true','departamento'=>$resultado2);
			echo json_encode($mensaje);
		}
	}

}
?>
