<?php
class Categoria extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }
    
    /*	Regresa todas 
    las categorias existentes en la
    Base de datos
    */
    function getAllCategorias()
    {
        $query = $this->db->get('Categoria');
        return $query->result();
    }
    
    
    /*Obtiene todas las categorias que tienen como padre a la
    supracategoria*/
    function getAllCategoriasSupra($data)
    {
        $this->db->where($data);
        $query = $this->db->get('Categoria');
        return $query->result();
    }
    
    /*	
    Elimina una Categoria de la BD
    */
    function deleteCategoria($idCategoria)
    {
        $this->db->where('idCategoria', $idCategoria);
        $this->db->delete('Categoria');
    }
    
    
    /*	
    Inserta o Actualiza una Categoria
    */
    function addCategoria($data)
    {
        if (isset($data['idCategoria'])) {
            $this->db->where('idCategoria', $data['idCategoria']);
            $this->db->update('Categoria', $data);
        } else {
            $this->db->insert('Categoria', $data);
        }
    }
}
?>

