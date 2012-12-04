<?php
class Grupo_Area_Model extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    //Función que se encarga de ir a la BD y traer todos los usuarios que existan en la tabla.
    function getGrupos()
    {
        $this->load->database();
        $query = $this->db->get('Grupo_Area');
        return $query->result();
    }
    
    function getGruposyAreas()
    {
        $this->load->database();
        $grupos = $this->db->query('
            SELECT idGrupo_Area,nombre 
            FROM Grupo_Area g
        ')->result();
        
        $matriz;
        for ($i = 0; $i < sizeof($grupos); $i++) {
            $matriz[$i][0] = $grupos[$i];
            $matriz[$i][1] = $this->db->query('
            SELECT idArea_Conocimiento,area 
            FROM Area_Conocimiento a
            WHERE a.idGrupo_Area = ' . $grupos[$i]->idGrupo_Area)->result();
        }
        
        return $matriz;
    }
}
?>
