<?php 
Class Estado extends CI_Model{
	
	var $idProyecto = '';
	var $tiempoActualizacion = '';
	var $idUsuario = '';
	var $estado = '';
	
	function getIdProyecto(){
		return $this->idProyecto;
	}
	
	function getTiempoActualizacion(){
		return $this->tiempoActualizacion;
	}
	
	function getIdUsuario(){
		return $this->idUsuario;
	}
	
	function getEstado(){
		return $this->estado;
	}
	
	function setIdProyecto($param){
		$this->idProyecto = $param;
	}
	
	function setIdUsuario($param){
		$this->idUsuario = $param;
	}
	
	function setTiempoActualizacion($param){
		$this->tiempoActualizacion = $param;
	}
	
	function setEstado($param){
		$this->estado = $param;
	}
	
	function insert(){
		$this->load->database();
		$data = array(
			'idProyecto' => $this->idProyecto,
			'idUsuario'=> $this->idUsuario,
			'estado' => $this->estado);
		$this->db->insert('Estado',$data);			
	}
}
?>
