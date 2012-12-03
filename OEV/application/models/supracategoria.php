<?php
class SupraCategoria extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }
    
    /*	Regresa todas 
    las Supra Categorias existentes en la
    Base de datos
    */
    function getAllSupraCategorias()
    {
        $query = $this->db->get('SupraCategoria');
        return $query->result();
    }
    
    
    /*	
    Elimina una Supra Categoria de la BD
    */
    function deleteSupraCategoria($id)
    {
        $this->db->where('idSupraCategoria', $id);
        $this->db->delete('SupraCategoria');
    }
    
    
    /*	
    Inserta o Actualiza una Categoria
    */
    function addSupraCategoria($data)
    {
        if (isset($data['idSupraCategoria'])) {
            $this->db->where('idSupraCategoria', $data['idSupraCategoria']);
            $this->db->update('SupraCategoria', array(
                'Nombre' => $data['Nombre']
            ));
        } else {
            $this->db->insert('SupraCategoria', array(
                'Nombre' => $data['Nombre']
            ));
        }
    }
    
    function getCategorias($id)
    {
        $this->db->where('idSupraCategoria', $id);
        $query = $this->db->get('Categoria');
        return $query->result();
    }
    
    /*Regresa todas las categorias con subCategorias*/
    function getSCWC()
    {
        $supra  = $this->getAllSupraCategorias();
        $matrix = array();
        //Busca todas las categorias de una Supra Categoria
        for ($i = 0; $i < sizeof($supra); $i++) {
            $matrix[$i]               = array();
            $matrix[$i]['Categorias'] = $this->getCategorias($supra[$i]->idSupraCategoria);
            $matrix[$i]['Supra']      = $supra[$i];
        }
        
        return $matrix;
    }
}
?>

