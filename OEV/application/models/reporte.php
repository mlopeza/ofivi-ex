<?php
class Reporte extends CI_Model{
	
	var $idReporte = '';
	var $idUsuario = '';
	var $idProyecto = '';
	var $titulo = 'Sin titulo';
	var $Reporte = '';
	var $reporteFinal = 0;
	
	function __construct()
    {
        parent::__construct();
    }
    
    function getIdReporte(){
		return $this->idReporte;
	}
	
	function getIdUsuario(){
		return $this->idUsuario;
	}
	
	function getIdProyecto(){
		return $this->idProyecto;
	}
	
	function getTitulo(){
		return $this->titulo;
	}
	
	function getReporte(){
		return $this->reporte;
	}
	
	function getReporteFinal(){
		return $this->reporteFinal;
	}
    
	function setIdUsuario($param){
		$this->idUsuario = $param;
	}
	
	function setIdProyecto($param){
		$this->idProyecto = $param;
	}
	
	function setTitulo($param){
		$this->titulo = $param;
	}
	
	function setReporte($param){
		$this->Reporte = $param;
	}
	
	function setReporteFinal($param){
		$this->reporteFinal = $param;
	}
	
	/*
	 * Inserta el reporte a la base de datos
	 */
	function insert(){
		$this->load->database();
		$arreglo = array(
			'idUsuario' => $this->idUsuario,
			'idProyecto' => $this->idProyecto,
			'titulo' => $this->titulo,
			'Reporte' => $this->Reporte,
			'reporteFinal' => $this->reporteFinal);
		$this->db->insert('reporte',$arreglo);
	}
	
	/*
	 * Actualiza reporte
	 */
	function update(){
		$this->load->database();
		$arreglo = array(
			'idUsuario' => $this->idUsuario,
			'idProyecto' => $this->idProyecto,
			'titulo' => $this->titulo,
			'Reporte' => $this->Reporte,
			'reporteFinal' => $this->reporteFinal);
		$this->db->where('idReporte', $this->idReporte);
		$this->db->update('reporte',$arreglo);
	}
}