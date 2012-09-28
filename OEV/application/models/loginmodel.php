<?php
class Loginmodel extends CI_Model {

	var $idUsuario = '' ;
	var $idDepartamento = '' ;
	var $Nombre = '';
    var	$ApellidoP = '';
	var $ApellidoM = '';
	var $email = '';	
	var $Usuario_Extension = '';
	var $Supervisor_Extension = '';
    var	$Profesor= '';
	var $Administrador = '';
	var $Vista_Profesor = '';
    var $Vista_Administrador = '';
	var $Vista_Supervisor_Extension = '';
	var $Vista_Usuario_Extension = '';
 	var $Usuario_Activo = '';
	var $Contrasena ='';
	var $Usuario_Aceptado = '';
	
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    //Función que se encarga de ir a la BD y traer todos los usuarios que existan en la tabla.
    function getUsuarios()
    {
		$this->load->database();
        $query = $this->db->get('usuario');
        return $query->result();
    }
	//Función para validar que el usuario puso correctamente su contraseña.
	function validLogin(){
		$this->load->database();
		if(do_hash($this->input->post('password'), 'md5') == $this->Contrasena){
			return TRUE;
		}
		else
		{
			return FALSE;
		}
		
	}
	//Función find para poder buscar solo un usuario dependiendo de su id.
	function encontrarUsuario(){
		$this->load->database();
		$query = $this->db->get_where('usuario', array('id' => $id));
				
		if ($query->num_rows() > 0)
		{
   			$row = $query->row(); 
   			$this->idUsuario = $row->idUsuario;
   			$this->idDepartamento = $row->idDepartamento;
   			$this->Nombre = $row->Nombre;
   			$this->ApellidoP = $row->ApellidoP;
			$this->ApellidoM = $row->ApellidoM;
			$this->Contrasena = $row->Contrasena;			
			$this->email = $row->email;
			$this->Profesor = $row->Profesor;
			$this->Usuario_Aceptado = $row->Usuario_Aceptado;
			$this->Usuario_Activo = $row->Usuario_Activo;
			$this->Usuario_Extension = $row->Usuario_Extension;
			$this->Vista_Administrador = $row->Vista_Administrador;
			$this->Vista_Profesor = $row->Vista_Profesor;
			$this->Vista_Supervisor_Extension = $row->Vista_Supervisor;
			$this->Vista_Usuario_Extension = $row->Vista_Usuario_Extension;
			$this->Administrador = $row->Administrador;
			$this->Supervisor_Extension = $row->Supervisor_Extension;
			return TRUE;
		}
		else
		return FALSE;
	}
	
	//Función para hacerle un update a los datos.
	function actualizarUsuario(){
		$this->load->database();
		$data = array(
               'Contrasena' => $this->Contrasena,
               'email' => $this->email,
               'Vista_Usuario_Extension' => $this->Vista_Usuario_Extension,
			   	   
            );
		$this->db->where('idUsuario', $this->input->post('idUsuario'));
		$this->db->insert('usuario',$data);	 
	}
	//Función para insertar un usuario a la tabla de usuarios.
	function insertarUsuario(){
		$this->load->database();
		$arreglo = array(
		'idUsuario'=>$this->input->post('username'),
		'Contrasena'=>do_hash($this->input->post('password'), 'md5'),
		'email'=>$this->input->post('email'),
		'campus'=>$this->input->post('campus'),
		'escuela'=>$this->input->post('escuela'),
		'departamento'=>$this->input->post('departamento'));
		$this->db->insert('usuario',$arreglo);
		
	}
	//Get de los atributos de Usuario.	
	function getUsuarioAceptado(){
		return $Usuario_Aceptado;
	}
	function getidUsuario(){
		return $idUsuario;
	}
	function getNombre(){
		return $Nombre;
	}
	function getApellidoP(){
		return $ApellidoP;
	}
	function getApellidoM(){
		return $ApellidoM;
	}
	function getEmail(){
		return $email;
	}
	function getUsuarioExtension(){
		return $Usuario_Extension;
	}
	function getSupervisionExtension(){
		return $Supervision_Extension;
	}
	function getProfesor(){
		return $Profesor;
	}
	function getVistaProfesor(){
		return $Vista_Profesor;
	}
	function getVistaAdministrador(){
		return $Vista_Administrador;
	}
	function getVistaSupervisorExtension(){
		return $Vista_Supervisor_Extension;
	}
	function getVistaUsuarioExtension(){
		return $Vista_Usuario_Extension;
	}
	function getUsuarioActivo(){
		return $Usuario_Activo;
	}
	function getContrasena(){
		return $Contrasena;
	}
	//Set de todos los atributos
	function setUsuarioAceptado(){
		$Usuario_Aceptado = $this->input->post('usuario_aceptado');
	}
	function setidUsuario(){
		$idUsuario = $this->input->post('idUsuario');
	}
	function setNombre(){
		$Nombre = $this->input->post('nombre');
	}
	function setApellidoP(){
		$ApellidoP = $this->input->post('apellidoP');
	}
	function setApellidoM(){
		$ApellidoM = $this->input->post('apellidoM');
	}
	function setEmail(){
		$email = $this->input->post('email');
	}
	function setUsuarioExtension(){
		$Usuario_Extension = $this->input->post('usuario_extension');
	}
	function setSupervisionExtension(){
		$Supervision_Extension = $this->input->post('supervision_extension');
	}
	function setProfesor(){
		$Profesor = $this->input->post('profesor');
	}
	function setVistaProfesor(){
		$Vista_Profesor = $this->input->post('vista_profesor');
	}
	function setVistaAdministrador(){
		$Vista_Administrador = $this->input->post('vista_administrador');
	}
	function setVistaSupervisorExtension(){
		$Vista_Supervisor_Extension = $this->input->post('vista_supervisor_extension');
	}
	function setVistaUsuarioExtension(){
		$Vista_Usuario_Extension = $this->input->post('vista_usuario_extension');
	}
	function setUsuarioActivo(){
		$Usuario_Activo = $this->input->post('usuario_activo');
	}
	function setContrasena(){
		$Contrasena = $this->input->post('contrasena');
	}
}
?>