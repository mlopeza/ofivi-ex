<?php
class GrupoArea extends CI_Model {
	
    function __construct()
    {
        // Call the Model constructor
        $this->load->database();
        parent::__construct();
    }
    //Función que se encarga de ir a la BD y traer todos los usuarios que existan en la tabla.
    function getGrupos()
    {
		$this->load->database();
        $query = $this->db->get('Grupo_Area');
        return $query->result();
    }

    function getGruposyAreas(){
        $this->load->database();
        $grupos= $this->db->query('
            SELECT idGrupo_Area,nombre 
            FROM Grupo_Area g
        ')->result();

        $matriz;
        for($i=0;$i<sizeof($grupos);$i++){
            $matriz[$i][0]=$grupos[$i];
            $matriz[$i][1]=$this->db->query('
            SELECT idArea_Conocimiento,area 
            FROM Area_Conocimiento a
            WHERE a.idGrupo_Area = '.$grupos[$i]->idGrupo_Area)->result(); 
        }

        return $matriz;
    }

	function addGrupo($data){
		if(isset($data['idGrupo_Area'])){
			$this->db->where('idGrupo_Area',$data['idGrupo_Area']);
			$this->db->update('Grupo_Area',array('nombre'=>$data['nombre']));
		}else{
			$this->db->insert('Grupo_Area',array('nombre'=>$data['nombre']));
		}
	}


	/*	
		Elimina una Supra Categoria de la BD
	*/
	function deleteGrupo($id){
		$this->db->where('idGrupo_Area',$id);
		$this->db->delete('Grupo_Area');
	}

  function getAreas($data){
    $this->db->where($data);
    return $this->db->get('Area_Conocimiento')->result();
  }
}
?>
