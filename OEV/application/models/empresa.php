<?php
class Empresa extends CI_Model {
	
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	//Declaración de variables e inicalización
	
	var $idGrupo;
	var $nombre='';
	var $idEmpresa = '';
	
	//Métodos GET
	
	function get_id_grupo(){
		return $this->idGrupo;
	}
	function get_nombre(){
		return $this->nombre;
	}
	function get_id_empresa(){
		return $this->idEmpresa;
	}

	
	//Métodos SET
	
	function set_id_grupo($idcamp){
		$this->idGrupo = $idcamp;
	}
	function set_nombre($name){
		$this->nombre = $name;
	}
	function set_id_empresa($idemp){
		$this->idEmpresa;
	}
	
	//Método FIND
	
	function find(){		
		$this->load->database();
		$query = $this->db->get_where('empresa', array('nombre' => $this->nombre));
		if ($query->num_rows() > 0)
		{
   			$row = $query->row(); 
			$this->idGrupo = $row->idGrupo;
			$this->idEmpresa= $row->idEmpresa;			
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	//Funcion update
	
	function update(){
		$this->load->database();
		//Se crea el arreglo con el cual se hara el update de la tabla.
		$data = array(
					'nombre' => $this->nombre,
					'idGrupo' => $this->idGrupo			
            );
		$this->db->where('idEmpresa', $this->idEmpresa);
		$this->db->update('empresa',$data);	 	
	}
	function insert(){
		$this->load->database();
		//Se crea el arreglo con el cual se hara el update de la tabla.
		$data = array(
					'idGrupo'=> $this->idGrupo,
					'nombre' => $this->nombre
            );

		$this->db->insert('empresa',$data);	 	
	}
	//Función Select de nombres
	function selectN(){
		$this->load->database();
		$this->db->order_by("nombre", "asc");
		$query = $this->db->get('empresa');
		return $query->result();
	}

	//Regresa las Empresas que pertenecen a cierto Grupo
	function getEmpresasDeGrupo($idGrupo){
		$this->load->database();
		$query = $this->db->query('SELECT 
									idEmpresa,nombre 
									FROM Empresa
									WHERE idGrupo='.$idGrupo.'
									ORDER BY nombre ASC');
		return $query->result();
	}


	//Function que regresa las empresas que cuentan con proyectos activos.
	//$ativo hace rreferencia a si se desea buscar un 
	function getEPA($activo, $grupo){
		$this->load->database();
		$query = $this->db->query('SELECT DISTINCT e.idEmpresa, e.nombre
								   From Empresa as e, Proyecto as P
								   WHERE e.idEmpresa = p.idEmpresa AND
								   p.Proyecto_Activo = '.$activo.' AND
								   e.idGrupo = '.$grupo.'
								   Order by e.idEmpresa');
		return $query->result();
	}		
	function getEPAP($activo, $grupo,$idUsuario){
		$this->load->database();
		$query = $this->db->query('SELECT DISTINCT e.idEmpresa, e.nombre
								   From Empresa as e, Proyecto as P, usuario_proyecto as est
								   WHERE e.idEmpresa = p.idEmpresa AND
								   p.Proyecto_Activo = '.$activo.' AND
								   e.idGrupo = '.$grupo.' AND
								   est.idUsuario = '.$idUsuario.' AND
								   est.idProyecto = p.idProyecto
								   Order by e.idEmpresa');
		return $query->result();
	}		
	function getEPAU($activo, $grupo,$idUsuario){
		$this->load->database();
		$query = $this->db->query('SELECT DISTINCT e.idEmpresa, e.nombre
								   From Empresa as e, Proyecto as P
								   WHERE e.idEmpresa = p.idEmpresa AND
								   p.Proyecto_Activo = '.$activo.' AND
								   e.idGrupo = '.$grupo.' AND
								   p.iniciadoPor = '.$idUsuario.' 
								   Order by e.idEmpresa');
		return $query->result();
	}		


	//Regresa las Empresas que pertenecen a cierto Grupo
	function getProyectosDeEmpresa($idEmpresa){
		$this->load->database();
		$query = $this->db->query('SELECT 
									idProyecto,nombre 
									FROM Proyecto
									WHERE idEmpresa='.$idEmpresa.'
									ORDER BY nombre ASC');
		return $query->result();
	}

	function saveEmpresa($data){
		$this->load->database();
		if(isset($data['idEmpresa'])){
			$this->db->where('idEmpresa',$data['idEmpresa']);
			$this->db->update('Empresa',array('nombre'=>$data['nombre']));
		}else{
			$this->db->insert('Empresa',$data);
			$query=$this->db->query("select LAST_INSERT_ID() as idEmpresa;");
			return $query->result();
		}
	}

	function deleteEmpresa($data){
		$this->load->database();
		$this->db->where($data);
		$this->db->update('Empresa',array('activo'=>0));
	}

}
?>

