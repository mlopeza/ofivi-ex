<?php
class Usuariomodel extends CI_Model {

	var $idUsuario = '' ;
	var $idDepartamento = '' ;
	var $Username = '';
	var $Nombre = '';
    var	$ApellidoP = '';
	var $ApellidoM = '';
	var $email = '';	
	var $Vista_Profesor = '';
    var $Vista_Administrador = '';
	var $Vista_Supervisor_Extension = '';
	var $Vista_Usuario_Extension = '';
	var $Vista_Legal = '';
	var $Vista_Cliente = ''; //Todavía no se implementará.
 	var $Usuario_Activo = '';
	var $password ='';
	var $Usuario_Aceptado = '';
	var $Tipo_Usuario = '';
	
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

	//Funcion que agrega una clausula where a la busqueda

	function getUsuariosPendientes(){
		$this->load->database();
        $query = $this->db->query('
			SELECT d.idDepartamento as idDepartamento,
					d.Nombre as Departamento,
					e.Nombre as Escuela, 
					c.Nombre as Campus,
					u.* 
			FROM Usuario u
			INNER JOIN Departamento d ON d.idDepartamento = u.idDepartamento
			INNER JOIN Escuela e ON e.idEscuela = d.idEscuela
			INNER JOIN Campus c ON e.idCampus = c.idCampus
			WHERE u.Usuario_Aceptado = \'e\'
			');
		
		return $query;

	}

	//Función para validar que el usuario puso correctamente su contraseña.
	function validLogin(){
		$this->load->database();
		if(hash('sha256',$this->input->post('password')) == $this->password && $this->Usuario_Activo == 1){
			if($this->Vista_Administrador)
			return 1;
			else if($this->Vista_Profesor)
			return 2;
			else if ($this->Vista_Supervisor_Extension)
			return 3;
			else if($this->Vista_Usuario_Extension)
			return 4;
			else 
			return 5;
		}
		else
		{
			return 0;
		}
		
	}
	//Función find para poder buscar solo un usuario dependiendo de su id.
	function encontrarUsuario(){
		$this->load->database();
		$query = $this->db->get_where('usuario', array('Username' => $this->Username));
				
		if ($query->num_rows() > 0)
		{
   			$row = $query->row(); 
			$this->Username = $row->Username;
   			$this->idUsuario = $row->idUsuario;
   			$this->idDepartamento = $row->idDepartamento;
   			$this->Nombre = $row->Nombre;
   			$this->ApellidoP = $row->ApellidoP;
			$this->ApellidoM = $row->ApellidoM;
			$this->password = $row->password;			
			$this->email = $row->email;
			$this->Tipo_Usuario = $row->Tipo_Usuario;
			$this->Usuario_Aceptado = $row->Usuario_Aceptado;
			$this->Usuario_Activo = $row->Usuario_Activo;
			$this->Vista_Administrador = $row->Vista_Administrador;
			$this->Vista_Profesor = $row->Vista_Profesor;
			$this->Vista_Supervisor_Extension = $row->Vista_Supervisor_Extension;
			$this->Vista_Usuario_Extension = $row->Vista_Usuario_Extension;
			$this->Vista_Legal = $row->Vista_Legal;
			return TRUE;
		}
		else
		return FALSE;
	}
	


	//Funcion para actualizar un usuario,proporcionando el id
	//y un arreglo con los datos
	function actualiza_usuario_array($id,$arreglo=array()){
		$this->load->database();
		$this->db->where('idUsuario', $id);
		$this->db->update('Usuario', $arreglo);
	}

	//Función para hacerle un update a los datos.
	function actualizarUsuario(){
		$this->load->database();
		//Se crea el arreglo con el cual se hara el update de la tabla.
		$data = array(
				'idDepartamento' => $this->idDepartamento,
				'Nombre' => $this->Nombre,
				'ApellidoP' => $this->ApellidoP,
				'ApellidoM' => $this->ApellidoM,
				'email' => $this->email,
				'Tipo_Usuario' =>$this->Tipo_Usuario,
				'Vista_Profesor' => $this->Vista_Profesor,
				'Vista_Administrador' => $this->Vista_Administrador,
				'Vista_Supervisor_Extension' => $this-> Vista_Supervisor_Extension,
				'Vista_Usuario_Extension' => $this-> Vista_Usuario_Extension,
				'Vista_Legal' => $this->Vista_Legal,
				'Usuario_Activo' =>  $this->Usuario_Activo,
				'password' => $this->password,
				'Usuario_Aceptado' => $this->Usuario_Aceptado,
				'Username' => $this->Username
            );
		$this->db->where('idUsuario', $this->idUsuario);
		$this->db->update('usuario',$data);	 
	}

	//Función para insertar un usuario a la tabla de usuarios.
	function insertarUsuario(){
		$this->load->database();
		$arreglo = array(
		'idUsuario'=>$this->idUsuario,
		'idDepartamento'=>$this->idDepartamento,
		'Username'=>$this->Username,
		'Nombre'=>$this->Nombre,
		'ApellidoP'=>$this->ApellidoP,
		'ApellidoM'=>$this->ApellidoM,
		'email'=>$this->email,
		'password'=>$this->password,
		'Tipo_Usuario'=>$this->Tipo_Usuario,
		'Vista_Profesor'=>$this->Vista_Profesor,
		'Vista_Administrador'=>$this->Vista_Administrador,
		'Vista_Supervisor_Extension'=>$this->Vista_Supervisor_Extension,
		'Vista_Usuario_Extension'=>$this->Vista_Usuario_Extension,
		'Vista_Legal'=>$this->Vista_Legal,
		'Vista_Cliente'=>$this->Vista_Cliente,
		'Usuario_Activo'=>$this->Usuario_Activo,
		'Usuario_Aceptado'=>$this->Usuario_Aceptado

		);
		$this->db->insert('usuario',$arreglo);
		
	}
	//Get de los atributos de Usuario.	
	function getUsername(){
		return $this->Username;
	}
	function getUsuarioAceptado(){
		return $this->Usuario_Aceptado;
	}
	function getidUsuario(){
		return $this->idUsuario;
	}
	function getNombre(){
		return $this->Nombre;
	}
	function getApellidoP(){
		return $this->ApellidoP;
	}
	function getApellidoM(){
		return $this->ApellidoM;
	}
	function getEmail(){
		return $this->email;
	}	
	function getVistaProfesor(){
		return $this->Vista_Profesor;
	}
	function getVistaAdministrador(){
		return $this->Vista_Administrador;
	}
	function getVistaSupervisorExtension(){
		return $this->Vista_Supervisor_Extension;
	}
	function getVistaUsuarioExtension(){
		return $this->Vista_Usuario_Extension;
	}
	function getVistaLegal(){
		return $this->Vista_Legal;
	}
	function getUsuarioActivo(){
		return $this->Usuario_Activo;
	}
	function getpassword(){
		return $this->password;
	}
	function getTipoUsuario(){
		return $this->Tipo_Usuario;
	}
	function getIdDepartamento(){
		return $this->idDepartamento;
	}
	//Set de todos los atributos
	function setUsername($param1){
		$this->Username = $param1;
	}
	function setUsuarioAceptado($param1){
		$this->Usuario_Aceptado = $param1;
	}
	function setidUsuario($param1){
		$this->idUsuario = $param1;
	}
	function setNombre($param1){
		$this->Nombre = $param1;
	}
	function setApellidoP($param1){
		$this->ApellidoP = $param1;
	}
	function setApellidoM($param1){
		$this->ApellidoM = $param1;
	}
	function setEmail($param1){
		$this->email = $param1;
	}
	function setTipoUsuario($param1){
		$this->Tipo_Usuario = $param1;
	}	
	function setVistaProfesor($param1){
		$this->Vista_Profesor = $param1;
	}
	function setVistaAdministrador($param1){
		$this->Vista_Administrador = $param1;
	}
	function setVistaLegal($param1){
		$this->Vista_Legal = $param1;
	}
	function setVistaSupervisorExtension($param1){
		$this->Vista_Supervisor_Extension = $param1;
	}
	function setVistaUsuarioExtension($param1){
		$this->Vista_Usuario_Extension = $param1;
	}
	function setUsuarioActivo($param1){
		$this->Usuario_Activo = $param1;
	}
	function setpassword($param1){
		$this->password = hash('sha256',$param1);		
	}
	function setIdDepartamento($param1){
		$this->idDepartamento = $param1;
	}
}
?>
