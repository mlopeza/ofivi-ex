<?php
class Departamento extends CI_Model {
	
	 function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	//Declaración e inicialización de variables.
	var $idDepartamento = '';
	var $idEscuela= '';
	var $nombre = '';
	var $ubicacion = '';
	
	//Funciones Get para las variables.
	
	function get_id_departamento(){
		return $this->idDepartamento;
	}
	function get_id_escuela(){
		return $this->idEscuela;
	}
	function get_nombre(){
		return $this->nombre;
	}
	function get_ubicacion(){
		return $this->ubicacion;
	}
	
	//Funciones Set para las variables.
	
	function set_id_departamento($iddep){
		$this->idDepartamento = $iddep;
	}
	function set_id_escuela($idesc){
		$this->idEscuela = $idesc;
	}
	function set_nombre($name){
		$this->nombre =$name;
	}
	function set_ubicacion($location){
		$this->ubicacion = $location;
	}
	
	//Función find
	
	function find (){
		$this->load->database();
		$query = $this->db->get_where('departamento', array('nombre' => $this->nombre));
		if ($query->num_rows() > 0)
		{
   			$row = $query->row(); 
			$this->idDepartamento = $row->idDepartamento;
			$this->idEscuela = $row->idEscuela;
			$this->ubicacion = $row->ubicacion;
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
					'ubicacion' => $this->ubicacion					
            );
		$this->db->where('idDepartamento', $this->idDepartamento);
		$this->db->update('departamento',$data);	 	
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

		$this->db->insert('departamento',$data);	 	
	}
	//Función Select de Nombres
	function selectN($id){
		$this->load->database();
		$this->db->select('nombre,idDepartamento');
		$this->db->order_by("nombre", "asc");
		$query = $this->db->get_where('departamento',array('idEscuela'=>$id));
		return $query->result();
	}		
}
?>