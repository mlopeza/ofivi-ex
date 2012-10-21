<?php
class Proyecto extends CI_Model{

    var $nombre='';
    var $descripcionUsuario='';
    var $descripcionAEV='';
    var $Proyecto_Activo=1;
    
    function getNombre(){
		return $nombre;
	}
	
	function getDescripcionUsuario(){
		return $descripcionUsuario;
	}
	
	function getDescripcionAEV(){
		return $descripcionAEV;
	}
	
	function getProyecto_Activo(){
		return $Proyecto_Activo;
	}
	
	function setNombre(){
		$nombre = $this->input->post('nombre_proyecto');
	}
	
	function setDescripcionAEV(){
		$descripcionAEV = $this->input->post('descripcionAEV');
	}
	
	function setDescripcionUsuario(){
		$descripcionUsuario = $this->input->post('descripcionUsuario');
	}
	
	function setProyecto_Activo(){
		$Proyecto_Activo = $this->input->post('Proyecto_Activo');
	}
    
    function __construct()
    {
        parent::__construct();
    }

    function alta(){
        $this->load->database();
        $proyecto = array(
			'nombre'=>$this->input->post('nombre_proyecto'),
			'descripcionUsuario'=>$this->input->post('descripcionUsuario'),
			'descripcionAEV'=>$this->input->post('descripcionAEV'));
		$this->db->insert('Proyecto',$proyecto);
    }
    
    //Funcion para obtener el ultimo registro.
    function ultimo(){
		$this->load->database();
		$query = $this->db->query('SELECT LAST_INSERT_ID()');
		$row = $query->row_array();
		return $row['LAST_INSERT_ID()'];
	}


	function altaProyecto($idEmpresa,$Nombre,$descripcionU,$descripcionAEV){
		//Descripciones de Usuario, preparando para guardarse en BLOB
		$d1 = mysql_real_escape_string($descripcionU);
		$d2 = mysql_real_escape_string($descripcionAEV);
		$data = array(
	   		'nombre' => $Nombre ,
   			'idEmpresa' => $idEmpresa ,
   			'descripcionUsuario' => $d1,
   			'descripcionAEV' => $d2,
   			'Proyecto_Activo' => 1
		);
		$this->db->insert('Proyecto', $data);
		$id = $this->db->query("SELECT LAST_INSERT_ID() as idProyecto;")->result();

		//Regresa el id del Proyecto Recien Creado
		return $id[0]->idProyecto;					
	}


	//Agrega los contactos al proyecto
	function agregaContactos($viejos,$nuevos,$idProyecto){
		$data = array();
		//Obtiene los datos de los contactos viejos
		
		foreach($viejos as $c){
			$data[]=array('idProyecto'=>$idProyecto,'idContacto'=>$c['id']);
		}

		foreach($nuevos as $c){
			$data[]=array('idProyecto'=>$idProyecto,'idContacto'=>$c);
		}
		if(sizeof($data) > 0)
			$this->db->insert_batch('Contacto_Proyecto', $data); 
	}
}
?>
