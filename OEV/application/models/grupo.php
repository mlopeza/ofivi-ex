	<?php
class Grupo extends CI_Model {
	
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	//Declaración de variables e inicalización
	
	var $idGrupo= '';
	var $nombre='';
	
	//Métodos GET
	
	function get_id_grupo(){
		return $this->idGrupo;
	}
	function get_nombre(){
		return $this->nombre;
	}

	
	//Métodos SET
	
	function set_id_grupo($idcamp){
		$this->idGrupo = $idcamp;
	}
	function set_nombre($name){
		$this->nombre = $name;
	}
	
	//Método FIND
	
	function find(){		
		$this->load->database();
		$query = $this->db->get_where('grupo', array('nombre' => $this->nombre));
		if ($query->num_rows() > 0)
		{
   			$row = $query->row(); 
			$this->idGrupo = $row->idGrupo;			
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
            );
		$this->db->where('idGrupo', $this->idGrupo);
		$this->db->update('grupo',$data);	 	
	}
	function insert(){
		$this->load->database();
		//Se crea el arreglo con el cual se hara el update de la tabla.
		$data = array(
					'nombre' => $this->nombre
            );

		$this->db->insert('grupo',$data);	 	
	}
	//Función Select de nombres
	function selectN($id){
		$this->load->database();
		$this->db->order_by("nombre", "asc");
		$query = $this->db->get_where('grupo',array('idGrupo'=>$id));
		return $query->result();
	}

	
	function selectGrupos(){
		$this->load->database();
		$query = $this->db->get('grupo');
		//$row = $query->row_array();
		//return array($row);
		return $query->result();
	}

	function getAllGroups(){
		$this->load->database();
		$query = $this->db->query('SELECT idGrupo,nombre FROM Grupo ORDER BY nombre ASC');
		return $query;
	}

	function getAllGroups2(){
		$this->load->database();
		$query = $this->db->query('SELECT idGrupo,nombre FROM Grupo where activo = 1 ORDER BY nombre ASC');
		return $query->result();
	}

	function getEmpresas($idGrupo){
		$this->load->database();
		$this->db->where(array('idGrupo'=>$idGrupo,'activo'=>1));
		$query = $this->db->get('Empresa');
		return $query->result();
	}


	//Guarda un grupo en la base de datos
	function saveGrupo($data){
		$this->load->database();
		if(isset($data['idGrupo'])){
			$this->db->where('idGrupo',$data['idGrupo']);
			$this->db->update('Grupo',array('nombre'=>$data['nombre']));
		}else{
			$this->db->insert('Grupo',array('nombre'=>$data['nombre']));
		}
	}

	//Function que regresa todo los grupos que tengan un pryecto ya sea activo o inactivo
	//$activo es una variable que indicara  si se requiere buscar un proyecto activo o inactivo.
	function getGPA($activo){
		$this->load->database();
		$qry = "SELECT DISTINCT g.idGrupo, g.nombre
				FROM Grupo AS g, Empresa e, Proyecto AS p
				WHERE g.idGrupo = e.idGrupo
				AND p.idEmpresa = e.idEmpresa
				AND p.Proyecto_Activo =".$activo."
				ORDER BY g.idGrupo";
		$query = $this->db->query($qry);
		return $query->result();		
	}

	function getGPAP($activo,$idUsuario){
		$this->load->database();
		$qry = "SELECT DISTINCT g.idGrupo, g.nombre
				FROM Grupo AS g, Empresa e, Proyecto AS p ,Estado est
				WHERE g.idGrupo = e.idGrupo
				AND p.idEmpresa = e.idEmpresa
				AND p.Proyecto_Activo =".$activo."
				AND est.idUsuario =".$idUsuario."
				AND est.idProyecto = p.idProyecto
				ORDER BY g.idGrupo";
		$query = $this->db->query($qry);
		return $query->result();		
	}
	function getGPAU($activo,$idUsuario){
		$this->load->database();
		$qry = "SELECT DISTINCT g.idGrupo, g.nombre
				FROM Grupo AS g, Empresa e, Proyecto AS p ,Estado est
				WHERE g.idGrupo = e.idGrupo
				AND p.idEmpresa = e.idEmpresa
				AND p.Proyecto_Activo =".$activo."
				AND est.idUsuario =".$idUsuario."
				AND est.idProyecto = p.idProyecto
				AND est.estado = 'Iniciado'
				ORDER BY g.idGrupo";
		$query = $this->db->query($qry);
		return $query->result();		
	}
		


	//Pone como inactivo un Grupo
	function deleteGrupo($data){
		$this->load->database();
		$this->db->where($data);
		$this->db->update('Grupo',array('activo'=>0));
	}


	//Regresa todos los Grupos con su empresa
	function getJerarquia(){
		$this->load->database();
		$this->db->select('g.nombre as Grupo, e.nombre as Empresa');
		$this->db->from('Grupo g');
		$this->db->join('Empresa e','g.idGrupo = e.idGrupo AND e.activo = 1','inner');
		$this->db->where('g.activo = 1');
		$query = $this->db->get();
		return $query->result();
	}	

}
?>
