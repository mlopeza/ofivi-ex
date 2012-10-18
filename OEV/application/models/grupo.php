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


	
	function getAllGroups(){
		$this->load->database();
		$query = $this->db->query('SELECT idGrupo,nombre FROM Grupo');
		return $query;
	}
		
}
?>
