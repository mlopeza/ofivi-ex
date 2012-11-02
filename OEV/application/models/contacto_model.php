<?php
class contacto_model extends CI_Model {

	var $idContacto = '' ;
	var $idEmpresa = '' ;
	var $Nombre = '' ;
	var $ApellidoP = '' ;
	var $ApellidoM = '' ;
	var $email = '' ;
	var $Contacto_Activo = '' ;
	var $Recibe_Correos = '' ;

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    //Función que se encarga de ir a la BD y traer todos los usuarios que existan en la tabla.
    function getContactos()
    {
		$this->load->database();
        $query = $this->db->get('Contacto');
        return $query->result();
    }

	//Funcion que regresa los contactos de cierta empresa con el nombre parecido
	function getContactosDeEmpresa($idEmpresa,$nombre){
		$this->load->database();
        $query = $this->db->query('
			SELECT idContacto as id, CONCAT (Nombre, " ",ApellidoP," ",ApellidoM," ",email) as name
			FROM Contacto
			WHERE idEmpresa='.$idEmpresa.'
			AND 
			(	Nombre like "%'.$nombre.'%" OR
				ApellidoP like "%'.$nombre.'%" OR
				ApellidoM like "%'.$nombre.'%"
			)
			');
		return $query->result();

	}

	//Crea los contactos de un proyecto, además de los telefonos
	function creaContactosConTelefono($contactos,$idEmpresa){
		//Se guardaran los contactos creados recientemente
		$arregloContactos = array();

		//Crea los contactos
		$this->load->database();
		foreach ($contactos as $contacto){
			$telefonos = $contacto['telefonos'];
			$contacto['idEmpresa']=$idEmpresa;
			//Elimina Los telefonos del arreglo
			unset($contacto['telefonos']);
			//Inserta el contacto en la base de datos
			$this->db->insert('Contacto', $contacto); 
			$idContacto = $this->db->query("SELECT LAST_INSERT_ID() as idContacto;")->result();
			//Agrega el Nuevo elemento al arreglo
			$c = $idContacto[0]->idContacto;
			$arregloContactos[]=$c;			
			//Inserta los telefonos
			foreach($telefonos as $telefono){
				$telefono['idContacto']=$c;
				$this->db->insert('Contacto_Telefono', $telefono);
			}
		}

		return $arregloContactos;
	}

<<<<<<< HEAD
	//Funcion que regresa los contactos de cierta empresa
	function getContactosEmpresa($idEmpresa){
		$this->load->database();
		$query=$this->db->query('SELECT CONCAT( Nombre, " ", ApellidoP, " ", ApellidoM ) AS nombre, idContacto,puesto,departamento
						  FROM contacto
						  Where idEmpresa ='. $idEmpresa);
		return $query->result();
	}

=======
>>>>>>> master
	function getContactosDeEmpresaCompletos($idEmpresa){
		$this->load->database();
		$this->db->select("c.*");
		$this->db->from("Contacto c");
		$this->db->where("c.idEmpresa",$idEmpresa);
		$this->db->where("c.Contacto_Activo",'1');
		$contactos=$this->db->get()->result();
		$contador=0;
        $resultado=array();
		foreach($contactos as $contacto){
			$this->db->select("ct.*");
			$this->db->from("Contacto_Telefono ct");
			$this->db->where("ct.idContacto",$contacto->idContacto);
			$resultado[$contador][0]=$contacto;
			$resultado[$contador][1]=$this->db->get()->result();
			$contador++;
		}
		return $resultado;
	}
    
    /*Actualiza los telefonos de los contactos y los datos de los mismos*/
    function updateContactos($idEmpresa,$contactos){
        $this->load->database();
        foreach($contactos as $contacto){
            $telefonos = array();
            if(isset($contacto['telefonos'])){
               $telefonos=$contacto['telefonos'];
               unset($contacto['telefonos']);
            }
            $this->updateInsertTelefonos($telefonos,$contacto['idContacto']);
            $this->db->where('idContacto', $contacto['idContacto']);
            unset($contacto['idContacto']);
            $this->db->update('Contacto', $contacto);
        }

    }

    /*Inserta Nuevos Contactos*/
    function createContactos($idEmpresa,$contactos){
        $this->load->database();
        foreach($contactos as $contacto){
            $contacto['idEmpresa']=$idEmpresa;
            $telefonos = array();
            if(isset($contacto['telefonos'])){
               $telefonos=$contacto['telefonos'];
               unset($contacto['telefonos']);
            }
            $this->db->insert('Contacto', $contacto);
			$idContacto = $this->db->query("SELECT LAST_INSERT_ID() as idContacto;")->result();
			$c = $idContacto[0]->idContacto;
            $this->updateInsertTelefonos($telefonos,$c);            
        }

    }

    function updateInsertTelefonos($telefonos,$idContacto){
        $this->load->database();
        foreach($telefonos as $telefono){
             $telefono['idContacto']=$idContacto;
            //Si el telefono existia, lo actualiza
            if(isset($telefono['idTelefono'])){
                $this->db->where('idTelefono', $telefono['idTelefono']);
                unset($telefono['idTelefono']);
                $this->db->update('Contacto_Telefono', $telefono);
            //De lo contrario lo agrega
            }else{
                $this->db->insert('Contacto_Telefono', $telefono);
            }
        }
    }

    //Se da de baja un contacto
    function deleteContact($idContacto){
        $this->load->database();
        $this->db->where('idContacto',$idContacto);
        $this->db->update('Contacto', array('Contacto_Activo'=>'0'));
    }

    //Se da de baja un contacto
    function deleteTelefono($idTelefono){
        $this->load->database();
        $this->db->where('idTelefono',$idTelefono);
        $this->db->delete('Contacto_Telefono');
    }

    //Regresa los contactos de una empresa y si se encuentran o no en un proyecto
    function getContactosDeProyecto($idProyecto,$idEmpresa){
        $this->load->database();
        $query = $this->db->query('
			SELECT c.idContacto,CONCAT (Nombre, " ",ApellidoP," ",ApellidoM) as name, c.email,coalesce(p.idProyecto,0) as asignado
			FROM Contacto c
            LEFT JOIN Contacto_Proyecto p ON p.idContacto = c.idContacto AND p.idProyecto='.$idProyecto.'
            WHERE c.Contacto_Activo=1');
        return $query->result();
    }

    function eliminaRelacion($idProyecto,$idContacto){
        $this->load->database();
        $this->db->delete('Contacto_Proyecto', array('idProyecto' => $idProyecto,'idContacto'=>$idContacto));
   }
    function creaRelacion($idProyecto,$idContacto){
        $this->load->database();
        $this->db->insert('Contacto_Proyecto', array('idProyecto' => $idProyecto,'idContacto'=>$idContacto));
   }

}
?>
