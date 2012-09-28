<?php
class Campus extends CI_Model {
	
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	//Declaración de variables e inicalización
	
	var $idCampus= '';
	var $Nombre='';
	var $Ciudad='';
	
	//Métodos GET
	
	function get_id_campus(){
		return $this->idCampus;
	}
	function get_nombre(){
		return $this->Nombre;
	}
	function get_ciudad(){
		return $this->Ciudad;
	}
	
	//Métodos SET
	
	function set_id_campus($idcamp){
		$this->idCampus = $idcamp;
	}
	function set_nombre($name){
		$this->Nombre = $name;
	}
	function set_ciudad($city){
		$this->Ciudad = $city;
	}
	
	//Método FIND
	
	function find(){		
		$this->load->database();
		$query = $this->db->get_where('campus', array('Nombre' => $this->Nombre));
		if ($query->num_rows() > 0)
		{
   			$row = $query->row(); 
			$this->idCampus = $row->idCampus;			
			$this->Ciudad = $row->Ciudad;
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
					'Nombre' => $this->nombre,
					'Ciudad' => $this->Ciudad					
            );
		$this->db->where('idCampus', $this->idCampus);
		$this->db->update('campus',$data);	 	
	}
	function insert(){
		$this->load->database();
		//Se crea el arreglo con el cual se hara el update de la tabla.
		$data = array(
					'idDepartamento'=> $this->idDepartamento,
					'idEscuela'=> $this->idEscuela,
					'nombre' => $this->nombre,
					'ubicacion' => $this->ubicacion					
            );

		$this->db->insert('campus',$data);	 	
	}
		
}
?>