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
	
	function insert($id){
		$estado = array(
			'idProyecto' => $id,
			
}
?>
