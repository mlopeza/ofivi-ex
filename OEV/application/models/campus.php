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

  //Regresa el id del Cmpus	
	function get_id_campus(){
		return $this->idCampus;
	}

  //Regresa el Nombre del campus
	function get_nombre(){
		return $this->Nombre;
	}

  //Regresa la ciudad del campus
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
	//Busca en la Tabla de Campus, los datos del Campus con el Id del objeto
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
	//Actualiza la base de datos con el objeto actual
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

	//Función Select de Nombres de todos los campus.
	function selectN(){
		$this->load->database();
		$this->db->select('Nombre,idCampus');
		$this->db->order_by("Nombre", "asc");
		$query = $this->db->get('campus');
		return $query->result();
	}

    //Regresa todos los campus disponibles
    function getAll(){
        $this->load->database();
        $query=$this->db->get('Campus');
        return $query->result();
    }		


    function saveCampus($data){
        $this->load->database();
        if(isset($data['idCampus'])){
            $this->db->where('idCampus',$data['idCampus']);
            $this->db->update('Campus',$data);
        }else{
            $this->db->insert('Campus',$data);
        }
    }

    function deleteCampus($data){
        $this->load->database();
        if(isset($data['idCampus'])){
            $this->db->delete('Campus',$data);
        }
    }

    function getEscuelas($campus){
        $this->load->database();
        if(isset($campus['idCampus'])){
            $this->db->where($campus);
            $query=$this->db->get('Escuela');
            return $query->result();
        }
    }
}
?>
