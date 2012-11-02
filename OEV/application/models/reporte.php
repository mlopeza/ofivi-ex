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
	
	/*
	 * Busca los reportes que escribio el usuario 
	 * y aquellos de los que es responsable del proyecto
	 */
	function getReportes($usuario)
	{
		$this->load->database();
		$this->db->select('up.idUsuario, r.idUsuario autor, p.nombre proyecto, p.idProyecto, r.titulo, r.reporte');
		$this->db->from('usuario_proyecto up');
		$this->db->join('proyecto p','up.idProyecto = p.idProyecto AND up.idUsuario = '.$usuario.'','inner');
		$this->db->join('reporte r','p.idProyecto = r.idProyecto AND ((up.Responsable = 0 AND r.idUsuario = up.idUsuario) OR (up.Responsable <> 0))');
		$this->db->order_by("p.nombre, r.idReporte, r.titulo");
		$query = $this->db->get();
		return $query->result();
	}
}
