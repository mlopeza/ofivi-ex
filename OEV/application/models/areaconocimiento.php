<?php
class AreaConocimiento extends CI_Model {
	
    function __construct()
    {
        $this->load->database();
        parent::__construct();
    }

	function addArea($data){
		if(isset($data['idArea_Conocimiento'])){
			$this->db->where('idArea_Conocimiento',$data['idArea_Conocimiento']);
			$this->db->update('Area_Conocimiento',$data);
		}else{
			$this->db->insert('Area_Conocimiento',$data);
		}
	}

	function deleteArea($id){
		$this->db->where('idArea_Conocimiento',$id);
		$this->db->delete('Area_Conocimiento');
	}

}
?>
