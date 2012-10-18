<?php
class Empresa extends CI_Model {
	
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	//Declaración de variables e inicalización
	
	var $idGrupo= '';
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
		$query = $this->db->get_where('grupo', array('nombre' => $this->nombre));
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
            );
		$this->db->where('idGrupo', $this->idGrupo);
		$this->db->update('grupo',$data);	 	
	}
	function insert(){
		$this->load->database();
		//Se crea el arreglo con el cual se hara el update de la tabla.
		$data = array(
					'idGrupo'=> $this->idGrupo,
					'nombre' => $this->nombre,
					'idEmpresa' =>$this->idEmpresa
            );

		$this->db->insert('grupo',$data);	 	
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
		
}
?>
