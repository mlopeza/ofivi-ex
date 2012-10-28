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


	function altaProyecto($idEmpresa,$Nombre,$descripcionU,$descripcionAEV,$iniciadoPor){
		//Descripciones de Usuario, preparando para guardarse en BLOB
		$d1 = mysql_real_escape_string($descripcionU);
		$d2 = mysql_real_escape_string($descripcionAEV);
		$data = array(
	   		'nombre' => $Nombre ,
   			'idEmpresa' => $idEmpresa ,
   			'descripcionUsuario' => $d1,
   			'descripcionAEV' => $d2,
   			'Proyecto_Activo' => 1,
   			'iniciadoPor' => $iniciadoPor
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
	//Función findAll par regresar todos los datos de la tabla.
	function findAll(){
		$this->load->database();
		$query = $this->db->get('proyecto');
		return $query->result();
	}
	
	function findPA($empresa,$activo){
		$this->load->database();
				$query = $this->db->query('SELECT idProyecto, nombre
										   From Proyecto
										   WHERE idEmpresa = '.$empresa.' AND
										   Proyecto_Activo = '.$activo );
			return $query->result();
	}
	
	/*
	 * Regresa un arreglo con todos los proyectos
	 */
	 function selectProyectos(){
		$this->load->database();
		$query = $this->db->get('proyecto');
		return $query->result();
	}
	function getCA($idProyecto,$activo){
		$this->load->database();
		$query = $this->db->query(' Select c.idContacto, c.Nombre, c.ApellidoP, c.ApellidoM
									FROM contacto as c, contacto_proyecto as cp, proyecto as p
									WHERE p.idProyecto = cp.idProyecto AND
									cp.idContacto = c.idContacto AND
									p.Proyecto_Activo =' .$activo.' AND
									p.idProyecto = '.$idProyecto );
		return $query->result();
}
	function getUA($idProyecto,$activo){
		$this->load->database();
		$query = $this->db->query(' Select c.idUsuario, c.Nombre, c.ApellidoP, c.ApellidoM
									FROM usuario as c, usuario_proyecto as cp, proyecto as p
									WHERE p.idProyecto = cp.idProyecto AND
									cp.idUsuario = c.idUsuario AND
									p.Proyecto_Activo =' .$activo.' AND
									p.idProyecto = '.$idProyecto );
		return $query->result();
}
	function getCATPA($idProyecto,$activo){
		$this->load->database();
		$query = $this->db->query(' Select c.Categoria
									From categoria as c, categoria_proyecto as cp, proyecto as p
									Where p.Proyecto_Activo = '.$activo.'  AND
									p.idProyecto = cp.idProyecto AND
									cp.idCategoria = c.idCategoria AND
									p.idProyecto =  '.$idProyecto  );
		return $query->result();
}
function getEA($idProyecto,$activo){
		$this->load->database();
		$query = $this->db->query(' Select e.idEstado, e.tiempoActualizacion, e.Estado, u.Nombre, u.ApellidoP, u.ApellidoM
									FROM estado as e, proyecto as p, usuario as u
									WHERE p.idProyecto ='.$idProyecto.' 
										  e.idProyecto = p.idProyecto AND
										  p.Proyecto_Activo ='.$activo.'  AND
										  e.idUsuario = u.idUsuario '  );
		return $query->result();
}

?>