<?php 
Class Estado extends CI_Model{
	
	var $idProyecto = '';
	var $tiempoActualizacion = '';
	var $idUsuario = '';
	var $estado = '';
	
	function getIdProyecto(){
		return $idProyecto;
	}
	
	function getTiempoActualizacion(){
		return $tiempoActualizacion;
	}
	
	function getIdUsuario(){
		return $idUsuario;
	}
	
	function getEstado(){
		return $estado;
	}
	
	function setIdProyecto(){
		$idProyecto = $this->input->post('idProyecto');
	}
	
	function setIdUsuario(){
		$idUsuario = $this->input->post('idUsuario');
	}
	
	function setTiempoActualizacion(){
		$tiempoActualizacion = $this->input->post('tiempoActualizacion');
	}
	
	function setEstado(){
		$estado = $this->input->post('estado');
	}
	
	function insert($proyectoid,$usuarioid){
		$this->load->database();
		$estado = array(
			'idProyecto' => $proyectoid,
			'idUsuario'=> $usuarioid,
			'estado' => 'Registrado');
		$this->db->insert('Estado',$estado);			
	}
	function getAllEstados($idProyecto){
		$this->load->database();
		$qry = "SELECT CONCAT(u.nombre,' ' ,u.apellidoP,' ',u.apellidoM) as nombre, e.estado, e.tiempoActualizacion as fecha
				From usuario as u, estado as e
				WHERE e.idProyecto = ".$idProyecto." AND
				u. idUsuario = e.idUsuario";
		$query = $this->db->query($qry);
		return $query->result();
	}
			
}
?>
