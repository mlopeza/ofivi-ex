<?php
class contacto_model extends CI_Model
{
    var $idContacto = '';
    var $idEmpresa = '';
    var $Nombre = '';
    var $ApellidoP = '';
    var $ApellidoM = '';
    var $email = '';
    var $Contacto_Activo = '';
    var $Recibe_Correos = '';
    
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
    function getContactosDeEmpresa($idEmpresa, $nombre)
    {
        $this->load->database();
        $nombre = preg_replace('/\s\s+/', ' ', $nombre);
        $claves = preg_split("/[\s]+/", $nombre);
        $q      = "";
        foreach ($claves as $c) {
            $q = $q . 'Nombre like "%' . $c . '%" OR
				ApellidoP like "%' . $c . '%" OR
				ApellidoM like "%' . $c . '%" OR ';
        }
        
        if (strcmp("", $nombre) == 0) {
            $query = $this->db->query('
				SELECT idContacto as id, CONCAT (Nombre, " ",ApellidoP," ",ApellidoM," ",email) as name
				FROM Contacto
				WHERE idEmpresa=' . $idEmpresa . '
				');
            return $query->result();
        }
        
        $query = $this->db->query('
			SELECT idContacto as id, CONCAT (Nombre, " ",ApellidoP," ",ApellidoM," ",email) as name
			FROM Contacto
			WHERE idEmpresa=' . $idEmpresa . '
			AND 
			(	
				' . $q . '
				lower(CONCAT (Nombre, " ",ApellidoP," ",ApellidoM," ",email)) like lower("%' . $nombre . '%")
			)
			');
        return $query->result();
        
    }
    
    //Crea los contactos de un proyecto, además de los telefonos
    function creaContactosConTelefono($contactos, $idEmpresa)
    {
        //Se guardaran los contactos creados recientemente
        $arregloContactos = array();
        
        //Crea los contactos
        $this->load->database();
        foreach ($contactos as $contacto) {
            $telefonos             = $contacto['telefonos'];
            $contacto['idEmpresa'] = $idEmpresa;
            //Elimina Los telefonos del arreglo
            unset($contacto['telefonos']);
            //Inserta el contacto en la base de datos
            $this->db->insert('Contacto', $contacto);
            $idContacto         = $this->db->query("SELECT LAST_INSERT_ID() as idContacto;")->result();
            //Agrega el Nuevo elemento al arreglo
            $c                  = $idContacto[0]->idContacto;
            $arregloContactos[] = $c;
            //Inserta los telefonos
            foreach ($telefonos as $telefono) {
                $telefono['idContacto'] = $c;
                $this->db->insert('Contacto_Telefono', $telefono);
            }
        }
        
        return $arregloContactos;
    }
    
    //Funcion que regresa los contactos de cierta empresa
    function getContactosEmpresa($idEmpresa)
    {
        $this->load->database();
        $query = $this->db->query('SELECT CONCAT( Nombre, " ", ApellidoP, " ", ApellidoM ) AS nombre, idContacto,puesto,departamento
						  FROM contacto
						  Where idEmpresa =' . $idEmpresa);
        return $query->result();
    }
    
    
    /*Regresa toda la informacion de los contactos junto sus telefonos*/
    function getContactosDeEmpresaCompletos($idEmpresa)
    {
        $this->load->database();
        $this->db->select("c.Departamento,c.Puesto,c.idContacto,c.Nombre,c.apellidoP,c.apellidoM,c.email,c.Recibe_Correos");
        $this->db->from("Contacto c");
        $this->db->where("c.idEmpresa", $idEmpresa);
        $this->db->where("c.Contacto_Activo", '1');
        $contactos = $this->db->get()->result();
        $contador  = 0;
        $resultado = array();
        foreach ($contactos as $contacto) {
            $this->db->select("ct.*");
            $this->db->from("Contacto_Telefono ct");
            $this->db->where("ct.idContacto", $contacto->idContacto);
            $resultado[$contador][0] = $contacto;
            $resultado[$contador][1] = $this->db->get()->result();
            $contador++;
        }
        return $resultado;
    }
    
    /*Actualiza los telefonos de los contactos y los datos de los mismos*/
    function updateContactos($idEmpresa, $contactos)
    {
        $this->load->database();
        foreach ($contactos as $contacto) {
            $telefonos = array();
            if (isset($contacto['telefonos'])) {
                $telefonos = $contacto['telefonos'];
                unset($contacto['telefonos']);
            }
            $this->updateInsertTelefonos($telefonos, $contacto['idContacto']);
            $this->db->where('idContacto', $contacto['idContacto']);
            unset($contacto['idContacto']);
            $this->db->update('Contacto', $contacto);
        }
        
    }
    
    /*Inserta Nuevos Contactos, junto con sus telefonos*/
    function createContactos($idEmpresa, $contactos)
    {
        $this->load->database();
        foreach ($contactos as $contacto) {
            $contacto['idEmpresa'] = $idEmpresa;
            $telefonos             = array();
            if (isset($contacto['telefonos'])) {
                $telefonos = $contacto['telefonos'];
                unset($contacto['telefonos']);
            }
            $this->db->insert('Contacto', $contacto);
            $idContacto = $this->db->query("SELECT LAST_INSERT_ID() as idContacto;")->result();
            $c          = $idContacto[0]->idContacto;
            $this->updateInsertTelefonos($telefonos, $c);
        }
        
    }
    
    /*Inserta los telefonso de un contacto en la base de datos*/
    function updateInsertTelefonos($telefonos, $idContacto)
    {
        $this->load->database();
        foreach ($telefonos as $telefono) {
            $telefono['idContacto'] = $idContacto;
            //Si el telefono existia, lo actualiza
            if (isset($telefono['idTelefono'])) {
                $this->db->where('idTelefono', $telefono['idTelefono']);
                unset($telefono['idTelefono']);
                $this->db->update('Contacto_Telefono', $telefono);
                //De lo contrario lo agrega
            } else {
                $this->db->insert('Contacto_Telefono', $telefono);
            }
        }
    }
    
    //Se da de baja un contacto
    function deleteContact($idContacto)
    {
        $this->load->database();
        $this->db->where('idContacto', $idContacto);
        $this->db->update('Contacto', array(
            'Contacto_Activo' => '0'
        ));
    }
    
    //Se da de baja un contacto
    function deleteTelefono($idTelefono)
    {
        $this->load->database();
        $this->db->where('idTelefono', $idTelefono);
        $this->db->delete('Contacto_Telefono');
    }
    
    //Regresa los contactos de una empresa y si se encuentran o no en un proyecto
    function getContactosDeProyecto($idProyecto, $idEmpresa)
    {
        $this->load->database();
        $query = $this->db->query('
			SELECT c.idContacto,CONCAT (Nombre, " ",ApellidoP," ",ApellidoM) as name, c.email,coalesce(p.idProyecto,0) as asignado
			FROM Contacto c
            LEFT JOIN Contacto_Proyecto p ON p.idContacto = c.idContacto AND p.idProyecto=' . $idProyecto . '
            WHERE c.Contacto_Activo=1');
        return $query->result();
    }
    
    /*Elimina una relacion enter un proyecto y un contacto*/
    function eliminaRelacion($idProyecto, $idContacto)
    {
        $this->load->database();
        $this->db->delete('Contacto_Proyecto', array(
            'idProyecto' => $idProyecto,
            'idContacto' => $idContacto
        ));
    }
    
    /*Crea una relacion entre un contacto y un proyecto*/
    function creaRelacion($idProyecto, $idContacto)
    {
        $this->load->database();
        $this->db->insert('Contacto_Proyecto', array(
            'idProyecto' => $idProyecto,
            'idContacto' => $idContacto
        ));
    }
    
    /*Regresa toda la informacion de un contacto*/
    function regresaInformacion($idContacto)
    {
        $this->load->database();
        $query = $this->db->query("
				select g.nombre as grupo,e.Nombre as empresa, CONCAT (u.Nombre,' ',u.ApellidoP, ' ',u.ApellidoM) as nombre, u.email,u.departamento as departamento, u.puesto as puesto
				from grupo as g, empresa as e,  contacto as u
				where g.idGrupo = e.idGrupo AND
				u.idEmpresa = e.idEmpresa AND
				u.idContacto = " . $idContacto)->result();
        return $query;
    }
    
    /*Regresa los telefonos de un contacto*/
    function regresaTelefono($idContacto)
    {
        $this->load->database();
        $query = $this->db->query("Select CONCAT('(',lada,')',telefono) as telefono, extension, descripcion, descripcionExtra as subextension
		From contacto_telefono
		Where idContacto =" . $idContacto)->result();
        return $query;
    }
    
    /*Agrega un contacto  a la base de datos, o si tiene un id lo actualiza*/
    function agregaContacto($data)
    {
        $this->load->database();
        $this->db->trans_start();
        $telefonos = $data['telefonos'];
        unset($data['telefonos']);
        $id = -1;
        if (isset($data['idContacto'])) {
            $id = $data['idContacto'];
            $this->db->where('idContacto', $data['idContacto']);
            $this->db->update('Contacto', $data);
        } else {
            $this->db->insert('Contacto', $data);
            $idx = $this->db->query("SELECT LAST_INSERT_ID() as idContacto;")->result();
            $id  = $idx[0]->idContacto;
        }
        
        //ELimina los Telefonos y los sobreescribe
        $this->db->where('idContacto', $id);
        $this->db->delete('Contacto_Telefono');
        
        for ($i = 0; $i < sizeof($telefonos); $i++) {
            $telefonos[$i]['idContacto'] = $id;
        }
        if (sizeof($telefonos) > 0) {
            $this->db->insert_batch('Contacto_Telefono', $telefonos);
        }
        $this->db->trans_complete();
    }
    
    
    
    function TrimStr($str)
    {
        $str = trim($str);
        for ($i = 0; $i < strlen($str); $i++) {
            if (substr($str, $i, 1) != " ") {
                $ret_str .= trim(substr($str, $i, 1));
                
            } else {
                while (substr($str, $i, 1) == " ") {
                    $i++;
                }
                $ret_str .= " ";
                $i--; // *** 
            }
        }
        return $ret_str;
    }
    
    function getContactosActivos()
    {
        $this->load->database();
        $query = $this->db->query('
			SELECT 
          e.idEmpresa as idEmpresa,
					g.Nombre as Grupo, 
					e.Nombre as Empresa,
					CONCAT(c.Nombre," ", c.ApellidoP, " ", c.ApellidoM) as Nombre,
          c.Puesto,
					c.email as Email,
					c.idContacto as idContacto
			FROM Contacto c
			INNER JOIN Empresa e ON e.idEmpresa = c.idEmpresa
			INNER JOIN Grupo g ON g.idGrupo = e.idGrupo
			WHERE c.Contacto_Activo = 1
			');
        return $query->result();
        
    }
}

?>
