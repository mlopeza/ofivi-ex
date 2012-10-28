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
	//Funcion que regresa los contactos de cierta empresa
	function getContactosEmpresa($idEmpresa){
		$this->load->database();
		$query=$this->db->query('SELECT CONCAT( Nombre, " ", ApellidoP, " ", ApellidoM ) AS nombre, idContacto,puesto,departamento
						  FROM contacto
						  Where idEmpresa ='. $idEmpresa);
		return $query->result();
	}
}
?>
