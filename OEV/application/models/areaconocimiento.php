<?php
class AreaConocimiento extends CI_Model
{
    function __construct()
    {
        $this->load->database();
        parent::__construct();
    }
    
    /*Esta función recibe un parámetro, 
    que es un arreglo con los elementos (idGrupo, idArea,area).*/
    function addArea($data)
    {
        if (isset($data['idArea_Conocimiento'])) {
            $this->db->where('idArea_Conocimiento', $data['idArea_Conocimiento']);
            $this->db->update('Area_Conocimiento', $data);
        } else {
            $this->db->insert('Area_Conocimiento', $data);
        }
    }
    
    /*Esta función recibe como parametro el $id de un area de 
    conocimiento (idArea_Conocimiento) que es un valor entero.*/
    function deleteArea($id)
    {
        $this->db->where('idArea_Conocimiento', $id);
        $this->db->delete('Area_Conocimiento');
    }
    
}
?>
