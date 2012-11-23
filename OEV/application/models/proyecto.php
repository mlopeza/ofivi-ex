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
        $this->load->database();
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


	function altaProyecto($idEmpresa,$Nombre,$descripcionU,$descripcionAEV,$iniciadoPor,$idProyecto){
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
		$id=-100;
		if($idProyecto >=0){
			$this->db->where('idProyecto',$idProyecto);
			$this->db->update('Proyecto',$data);
			$id=$idProyecto;
		}else{
			$this->db->insert('Proyecto', $data);
			$idx = $this->db->query("SELECT LAST_INSERT_ID() as idProyecto;")->result();
			$id=$idx[0]->idProyecto;
		}
		//Regresa el id del Proyecto Recien Creado
		return $id;					
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
		if(sizeof($data) > 0){
			$this->db->trans_start();
				$this->db->where('idProyecto',$idProyecto);
				$this->db->delete('Contacto_Proyecto');
				$this->db->insert_batch('Contacto_Proyecto', $data);
			$this->db->trans_complete();
		}
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
	function findPAP($empresa,$activo,$idUsuario){
		$this->load->database();
				$query = $this->db->query('SELECT Proyecto.idProyecto, Proyecto.nombre
										   From Proyecto, Estado
										   WHERE idEmpresa = '.$empresa.' AND
										   Proyecto.idProyecto = Estado.idProyecto AND
										   Estado.idUsuario = '.$idUsuario.' AND										   
										   Proyecto_Activo = '.$activo );
			return $query->result();
	}
	function findPAU($empresa,$activo,$idUsuario){
		$this->load->database();
				$query = $this->db->query('SELECT idProyecto, nombre
										   From Proyecto
										   WHERE idEmpresa = '.$empresa.' AND
										   iniciadoPor = '.$idUsuario.'   AND
										   Proyecto_Activo = '.$activo );
			return $query->result();
	}
	
	/*
	 * Regresa un arreglo con todos los proyectos en los que pertenece un usuario
	 */
	 function selectProyectos($usuario){
		$this->load->database();
		$this->db->select('p.idProyecto, p.nombre');
		$this->db->from('proyecto p');
		$this->db->join('usuario_proyecto up','up.idProyecto = p.idProyecto AND up.idUsuario = '.$usuario.'','inner');
		$query = $this->db->get();
		return $query->result();
	}

	/*
	 * Regresa un arreglo con todos los proyectos en los que pertenece un usuario y que son aceptados
	 */
	 function selectProyectosAceptados($usuario){
		$this->load->database();
		$this->db->select('p.idProyecto, p.nombre');
		$this->db->from('proyecto p');
		$this->db->join('usuario_proyecto up','up.idProyecto = p.idProyecto AND up.acepto = 1 AND up.idUsuario = '.$usuario.'','inner');
		$query = $this->db->get();
		return $query->result();
	}



	/*
	 * Funcion que regresa los contactos del cierto proyecto.
	 */
	function getCA($idProyecto){
		$this->load->database();
		$query = $this->db->query(' Select c.idContacto, CONCAT(c.Nombre," ", c.ApellidoP," ", c.ApellidoM) as nombre
									FROM contacto as c, contacto_proyecto as cp
									WHERE  cp.idProyecto = '.$idProyecto.' AND
									cp.idContacto = c.idContacto  ' );
		return $query->result();
	}

     /*Regresa todos los proyectos que inicio un usuario
        idUsuario    El id del Usuario
        activo       Si el proyecto est activo o no.
    */
	function getProyectosIniciados($idUsuario,$activo){
		$this->load->database();
        return $this->db->query("
                                SELECT idProyecto,p.nombre as Proyecto,e.nombre as Empresa,g.nombre as Grupo
                                FROM Proyecto p
                                INNER JOIN Empresa e ON e.idEmpresa = p.idEmpresa
                                INNER JOIN Grupo g ON g.idGrupo = e.idGrupo
                                WHERE iniciadoPor='".$idUsuario."' AND Proyecto_Activo = ".$activo."
                                ORDER BY Grupo,Empresa,Proyecto
                                ")->result();
	}

    function getAsignados($idProyecto){
        $this->load->database();
        $this->db->select('up.tiempo_solicitud,up.tiempo_respuesta,up.acepto,u.idUsuario, u.Nombre, u.ApellidoP, u.ApellidoM, u.email, u.Tipo_Usuario, d.nombre as Departamento,c.Nombre as Campus, e.Nombre as Escuela');
        $this->db->from('Usuario u');
        $this->db->join('Departamento d','d.idDepartamento = u.idDepartamento','inner');
        $this->db->join('Escuela e','e.idEscuela = d.idEscuela','inner');
        $this->db->join('Campus c','c.idCampus = e.idCampus','inner');
        $this->db->join('Usuario_Proyecto up','up.idUsuario = u.idUsuario AND up.activa = 1 AND up.idProyecto='.$idProyecto,'inner');
        $this->db->order_by("Campus", "asc"); 
        $this->db->order_by("Escuela", "asc"); 
        $this->db->order_by("Departamento", "asc");
        return $this->db->get()->result();
    }

    function setProfesor($data){
        $this->load->database();
        if(sizeof($this->db->get('Usuario_Proyecto')->result()) != 0){
            $this->db->delete('Usuario_Proyecto',$data);
            $this->db->insert('Usuario_Proyecto',$data);
        }else{
            $this->db->insert('Usuario_Proyecto',$data);
        }
    }

    //Pone la asignacion como inactiva
    function eliminaAsignacion($data){
        $this->load->database();
        $this->db->where($data);
        $this->db->update('Usuario_Proyecto', array('activa'=>0)); 
    }

	function getProyectosAsignados($idUsuario,$activo){
		$this->load->database();
        return $this->db->query("
                                SELECT up.idProyecto,p.nombre as Proyecto,e.nombre as Empresa,g.nombre as Grupo
                                FROM Usuario_Proyecto up
                                INNER JOIN Proyecto p ON up.idProyecto = p.idProyecto
                                INNER JOIN Empresa e ON e.idEmpresa = p.idEmpresa
                                INNER JOIN Grupo g ON g.idGrupo = e.idGrupo
                                WHERE up.idUsuario=".$idUsuario." AND up.activa = ".$activo." AND up.acepto = 0
                                ORDER BY Grupo,Empresa,Proyecto
                                ")->result();
	}

    function getDescripciones($idProyecto){
		$this->load->database();
        return $this->db->query("
                                SELECT descripcionUsuario as cliente,descripcionAEV as usuario
                                FROM Proyecto
                                WHERE idProyecto=".$idProyecto." AND Proyecto_Activo = 1
                                ")->result();

    }

    function setRespuesta($idProyecto,$data){
		$this->load->database();
        $this->db->where(array('idProyecto'=>$idProyecto));
        $this->db->update('Usuario_Proyecto',$data);
    }

	/*
	*
	*
	*/
	function getUA($idProyecto){
		$this->load->database();
		$query = $this->db->query(' Select c.idUsuario, CONCAT(c.Nombre, " ", c.ApellidoP," ", c.ApellidoM) as nombre
									FROM usuario as c, usuario_proyecto as cp, proyecto as p
									WHERE p.idProyecto = cp.idProyecto AND
									cp.idUsuario = c.idUsuario AND
									p.idProyecto = '.$idProyecto );
		return $query->result();
}




	function getCATP($idProyecto){
		$this->load->database();
		$query = $this->db->query(' Select c.Categoria
									From categoria as c, categoria_proyecto as cp
									Where '.$idProyecto.' = cp.idProyecto AND
									cp.idCategoria = c.idCategoria' );
		return $query->result();
}





function getEA($idProyecto){
		$this->load->database();
		$query = $this->db->query(' Select e.idEstado, e.tiempoActualizacion, e.Estado, u.Nombre, u.ApellidoP, u.ApellidoM
									FROM estado as e, proyecto as p, usuario as u
									WHERE p.idProyecto ='.$idProyecto.' 
										  e.idProyecto = p.idProyecto AND
										  e.idUsuario = u.idUsuario '  );
		return $query->result();
}
	
	/*
	 * Modifica si un proyecto esta activo o no
	 */
	function modificarActivo($proyecto,$activo)
	{
		$this->load->database();
		$data = array('Proyecto_Activo'=>$activo);
		$this->db->where('idProyecto',$proyecto);
		$this->db->update('proyecto',$data);
	}
	
	function getProyectosAceptados($idUsuario)
	{
		$this->load->database();
        return $this->db->query("
                                SELECT up.idProyecto,p.nombre as Proyecto,e.nombre as Empresa,g.nombre as Grupo
                                FROM Usuario_Proyecto up
                                INNER JOIN Proyecto p ON up.idProyecto = p.idProyecto
                                INNER JOIN Empresa e ON e.idEmpresa = p.idEmpresa
                                INNER JOIN Grupo g ON g.idGrupo = e.idGrupo
                                WHERE up.idUsuario=".$idUsuario." AND up.activa = 1 AND up.acepto = 1
                                ORDER BY Grupo,Empresa,Proyecto
                                ")->result();

	/*
	*	Busca todos los proyectos iniciados por un usuario
	*
	*/

	function getProyectosUsuario($idUsuario){
		$this->load->database();
		$this->db->select("g.nombre as Grupo,g.idGrupo ,e.nombre as Empresa,e.idEmpresa,p.idProyecto,p.nombre as Proyecto");
		$this->db->from('Proyecto p');
		$this->db->join('Empresa e','p.idEmpresa = e.idEmpresa','inner');
		$this->db->join('Grupo g','g.idGrupo = e.idGrupo','inner');
		$this->db->where('p.iniciadoPor',$idUsuario);
		$query = $this->db->get();
		return $query->result();
	}

	//Elimina un Proyecto de la base de datos
	function deleteProyecto($idProyecto){
		if(!isset($idProyecto))
			return;
		$this->load->database();
		$this->db->trans_start();
			$this->db->where('idProyecto',$idProyecto);
			$this->db->delete('Proyecto');
			$this->db->where('idProyecto',$idProyecto);
			$this->db->delete('Contacto_Proyecto');
		$this->db->trans_complete();
	}


	//Regresa un Proyecto
	function getProyecto($idProyecto){
		$this->load->database();
		$this->db->where('idProyecto',$idProyecto);
		$query=$this->db->get('Proyecto');
		return $query->result();
	}

	//Regresa los contactos del Proyecto;
	function getContactos($idProyecto){
		$this->load->database();
		$query = $this->db->query('
				SELECT c.idContacto as id, CONCAT (Nombre, " ",ApellidoP," ",ApellidoM," ",email) as name
				From Contacto c
				INNER JOIN Contacto_Proyecto cp ON c.idContacto = cp.idContacto AND cp.idProyecto='.$idProyecto.' ');
		return $query->result();
	}
}
?>
