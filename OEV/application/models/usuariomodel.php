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
	//Función para validar que el usuario puso correctamente su contraseña.
	function validLogin(){
		$this->load->database();
		if(hash('sha512',$this->input->post('password')) == $this->password && $this->Usuario_Activo == 1){
			if($this->Vista_Administrador)
			return 1;
			else if($this->Vista_Profesor)
			return 2;
			else if ($this->Vista_Supervisor_Extension)
			return 3;
			else if($this->Vista_Usuario_Extension)
			return 4;
			else if($this->Vista_Legal)		
			return 5;
			else 
			return 6;
		}
		else
		{
			return 0;
		}
		
	}
	//Función find para poder buscar solo un usuario dependiendo de su id.
	function encontrarUsuarioVista($usuario){
		$this->load->database();
		$query = $this->db->get_where('usuario', array('Username' => $usuario));
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
	function insertarUsuario($idDepartamento,$username,$nombre,$apellido_paterno,$apellido_materno,$email,$password,$tipo_usuario,$usuario_activo,$usuario_aceptado){
		$this->load->database();
		$arreglo = array(
		'idDepartamento'=>$idDepartamento,
		'Username'=>$username,
		'Nombre'=>$nombre,
		'ApellidoP'=>$apellido_paterno,
		'ApellidoM'=>$apellido_materno,
		'email'=>$email,
		'password'=>hash('sha512',$password),
		'Tipo_Usuario'=>$tipo_usuario,
		'Vista_Profesor'=>0,
		'Vista_Administrador'=>0,
		'Vista_Supervisor_Extension'=>0,
		'Vista_Usuario_Extension'=>0,
		'Vista_Legal'=>0,
		'Vista_Cliente'=>0,
		'Usuario_Activo'=>0,
		'Usuario_Aceptado'=>'e'

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
		$this->password = hash('sha512',$param1);		
	}
	function setIdDepartamento($param1){
		$this->idDepartamento = $param1;
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
	function darDeBaja($idUsuario){
		$this->load->database();
		$data = array('Usuario_Activo' => 0);
		$this->db->where('idUsuario', $idUsuario);
		$this->db->update('usuario', $data); 
	}
	
	function getUsuariosActivos(){
		$this->load->database();
        $query = $this->db->query('
			SELECT d.idDepartamento as idDepartamento,
					d.Nombre as Departamento,
					e.Nombre as Escuela, 
					c.Nombre as Campus, 
					CONCAT(u.Nombre," ", u.ApellidoP, " ", u.ApellidoM) as Nombre,
					u.email as Email,
					u.idUsuario as idUsuario,
					u.Username as Usuario
			FROM Usuario u
			INNER JOIN Departamento d ON d.idDepartamento = u.idDepartamento
			INNER JOIN Escuela e ON e.idEscuela = d.idEscuela
			INNER JOIN Campus c ON e.idCampus = c.idCampus
			WHERE u.Usuario_Activo = 1
			');

		return $query;

	}
    //Funcion para actualizar un usuario,proporcionando el id
    //y un arreglo con los datos
    function actualiza_usuario_array($id,$arreglo=array()){
        $this->load->database();
        $this->db->where('idUsuario', $id);
        $this->db->update('Usuario', $arreglo);

        //Regresa los datos del usuario
        $this->db->where('idUsuario', $id);
        $query=$this->db->get('Usuario');
        return $query->result();
    }

    //Regresa lso profesores que cumplen con una lista de Areas
    function getUsuariosAreas($lista){
        $this->load->database();
        $this->db->select('u.idUsuario, u.Nombre, u.ApellidoP, u.ApellidoM, u.email, u.Tipo_Usuario, d.nombre as Departamento,c.Nombre as Campus, e.Nombre as Escuela');
        $this->db->from('Usuario u');
        $this->db->join('Departamento d','d.idDepartamento = u.idDepartamento','inner');
        $this->db->join('Escuela e','e.idEscuela = d.idEscuela','inner');
        $this->db->join('Campus c','c.idCampus = e.idCampus','inner');
        $this->db->order_by("Campus", "asc"); 
        $this->db->order_by("Escuela", "asc"); 
        $this->db->order_by("Departamento", "asc"); 
        $this->db->where_in('u.idUsuario',$this->getListaUsuariosArea($lista));
        return $this->db->get()->result();

    }

    //Funcion Recursiva para verificar si los Profesores pertenecen a Varias Areas de Conocimiento
    function getListaUsuariosArea($lista){
        $this->load->database();
        $query = "SELECT idUsuario FROM Usuario_Area WHERE idArea_Conocimiento=".$lista[0];
        unset($lista[0]);
        foreach($lista as $elemento){
            $query="SELECT idUsuario FROM Usuario_Area WHERE idArea_Conocimiento = ".$elemento." AND idUsuario IN(".$query.")";
        }
        $contador = 0;
        $q=array();
        foreach($this->db->query($query)->result() as $fila){
            $q[$contador] = $fila->idUsuario;
            $contador++;
        }
        return sizeof($q) == 0? array('-1'):$q;
    }

    function getUsuariosName($nombre){
		$this->load->database();
        $query = $this->db->query('
			SELECT CONCAT (Nombre, " ",ApellidoP," ",ApellidoM," ",email) as name
			FROM Usuario
			WHERE 
				Nombre like "%'.$nombre.'%" OR
				ApellidoP like "%'.$nombre.'%" OR
				ApellidoM like "%'.$nombre.'%"
			');
		return $query->result();
    }

	function actualizarInfo($email,$password){
	$this->load->database();
	$data = array(
               'password' => hash('sha512',$password)
            );

	$this->db->where('Username', $email);
	$this->db->update('usuario', $data);	
	}

	function obtenId($usuario){
		$this->load->database();
		$query = $this->db->query('SELECT idUsuario FROM usuario WHERE username="'.$usuario.'"')->result();
		return $query[0]->idUsuario;
	}
	function obtenEmail($usuario){
		$this->load->database();
		$query = $this->db->query('SELECT email FROM usuario WHERE username="'.$usuario.'"')->result();
		return $query[0]->email;
	}
	function obtenNombre($usuario){
		$this->load->database();
		$query = $this->db->query('SELECT Nombre,ApellidoP FROM usuario WHERE username="'.$usuario.'"')->result();
		return $query;
	}
	function getEspecialidad($usuario){
        $this->load->database();
        $grupos= $this->db->query('
            SELECT idGrupo_Area,nombre 
            FROM Grupo_Area g
        ')->result();

        $matriz;
        for($i=0;$i<sizeof($grupos);$i++){
            $matriz[$i][0]=$grupos[$i];
            $matriz[$i][1]=$this->db->query('
			 SELECT Area_Conocimiento.idArea_Conocimiento,area,COALESCE(usuario_area.idUsuario,0) as tiene_especialidad
            FROM Area_Conocimiento
			LEFT JOIN usuario_area ON area_conocimiento.idArea_Conocimiento = usuario_area.idArea_Conocimiento
	AND usuario_area.idUsuario = '.$this->obtenId($usuario).'
            WHERE Area_Conocimiento.idGrupo_Area = '.$grupos[$i]->idGrupo_Area)->result(); 
        }

        return $matriz;
    }

	function deleteEspecialidad($usuario){
	 $this->load->database();
	 $this->db->delete('usuario_area', array('idUsuario' => $usuario));
	}
	function agregaEspecialidad($especialidad,$usuario){
		$this->load->database();
		$data = array(
		   'idUsuario' => $usuario ,
		   'idArea_Conocimiento' => $especialidad 
		);
		
		$this->db->insert('usuario_area', $data); 
	}


    function getAllUserData($data){
        $this->load->database();
        $this->db->where($data);
        $userdata = array();
        $userdata['usuario'] = $this->db->get('Usuario');
        $userdata['usuario'] = $userdata['usuario']->result();
        $userdata['usuario'] = $userdata['usuario'][0];
        $this->db->where($data);
        $userdata['telefonos'] = $this->db->get('Usuario_Telefono');
        $userdata['telefonos'] = $userdata['telefonos']->result();
        return $userdata;
    }

    //Elimina un telefono
    function deleteTelefono($data){
        $this->load->database();
        $this->db->delete('Usuario_Telefono',$data);
        
    }

    //Guarda los datos del usuario
    function savePerfil($data){
        $this->load->database();
        $this->db->where('idUsuario',$data['usuario']['idUsuario']);
        $this->db->update('Usuario',$data['usuario']);

        foreach($data['telefonos'] as $telefono){
            if(isset($telefono['idTelefono'])){
                $this->db->where('idTelefono',$telefono['idTelefono']);
                $this->db->update('Usuario_Telefono',$telefono);
            }else{
                $telefono['idUsuario']=$data['usuario']['idUsuario'];
                $this->db->insert('Usuario_Telefono',$telefono);
            }
        }
        
    }
	function regresaInformacion($idUsuario){
		$this->load->database();
		$query=$this->db->query("
				select d.nombre as departamento,e.Nombre as escuela,c.Nombre as campus, CONCAT (u.Nombre,' ',u.ApellidoP, ' ',u.ApellidoM) as nombre, u.email
				from departamento as d, escuela as e, campus as c, usuario as u
				where d.idEscuela = e.idEscuela AND
				e.idCampus = c.idCampus AND
				u.idDepartamento = d.idDepartamento AND
				u.idUsuario = ".$idUsuario)->result();
		return $query;
	}

}
?>

