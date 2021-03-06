<?php
class Escuela extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    //Declaración de variables e inicalización
    
    var $idEscuela = '';
    var $idCampus = '';
    var $Nombre = '';
    var $Ubicacion = '';
    
    //Métodos GET
    
    function get_id_escuela()
    {
        return $this->idEscuela;
    }
    function get_id_campus()
    {
        return $this->idCampus;
    }
    function get_nombre()
    {
        return $this->Nombre;
    }
    function get_ubicacion()
    {
        return $this->Ubicacion;
    }
    
    //Métodos SET
    
    function set_id_escuela($idesc)
    {
        $this->idEscuela = $idesc;
    }
    function set_id_campus($idcamp)
    {
        $this->idCampus = $idcamp;
    }
    function set_nombre($name)
    {
        $this->Nombre = $name;
    }
    function set_ubicacion($location)
    {
        $this->Ubicacion = $location;
    }
    
    //Método FIND
    
    function find()
    {
        $this->load->database();
        $query = $this->db->get_where('escuela', array(
            'Nombre' => $this->Nombre
        ));
        if ($query->num_rows() > 0) {
            $row             = $query->row();
            $this->idCampus  = $row->idCampus;
            $this->idEscuela = $row->idEscuela;
            $this->ubicacion = $row->ubicacion;
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    //Funcion update
    
    function update()
    {
        $this->load->database();
        //Se crea el arreglo con el cual se hara el update de la tabla.
        $data = array(
            'Nombre' => $this->nombre,
            'Ubicacion' => $this->ubicacion
        );
        $this->db->where('idEscuela', $this->idEscuela);
        $this->db->update('escuela', $data);
    }
    function insert()
    {
        $this->load->database();
        //Se crea el arreglo con el cual se hara el update de la tabla.
        $data = array(
            'idDepartamento' => $this->idDepartamento,
            'idEscuela' => $this->idEscuela,
            'nombre' => $this->nombre,
            'ubicacion' => $this->ubicacion
        );
        
        $this->db->insert('departamento', $data);
    }
    //Función Select de Nombres
    function selectN($id)
    {
        $this->load->database();
        $this->db->select('Nombre,idEscuela');
        $this->db->order_by("Nombre", "asc");
        $query = $this->db->get_where('escuela', array(
            'idCampus' => $id
        ));
        return $query->result();
    }
    
    //Elimina una Escuela
    function deleteEscuela($idEscuela)
    {
        $this->load->database();
        $this->db->delete('Escuela', $idEscuela);
    }
    
    //Elimina una Escuela
    function insertaEscuela($data)
    {
        $this->load->database();
        if (isset($data['idEscuela'])) {
            $this->db->where('idEscuela', $data['idEscuela']);
            unset($data['idEscuela']);
            unset($data['idCampus']);
            $this->db->update('Escuela', $data);
        } else {
            $this->db->insert('Escuela', $data);
        }
    }
    
    //Regresa todos los departamentos
    function getDepartamentos($data)
    {
        $this->load->database();
        $this->db->where($data);
        $query = $this->db->get('departamento');
        return $query->result();
    }
}
?>
