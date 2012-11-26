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
    
	function setIdReporte($param){
		$this->idReporte = $param;
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
	function getReportesDeProyecto($usuario,$proyecto)
	{
		$this->load->database();
		$this->db->select("r.idreporte, u.nombre, u.apellidop, r.titulo");
		$this->db->from('usuario_proyecto up');
		$this->db->join('reporte r','up.idProyecto = r.idProyecto AND r.idProyecto = '.$proyecto.' AND up.idusuario = '.$usuario.' AND ((up.Responsable = 0 AND r.idUsuario = up.idUsuario) OR (up.Responsable <> 0))');
		$this->db->join('usuario u','r.idusuario = u.idusuario');
		$this->db->order_by("r.idReporte, r.titulo");
		$query = $this->db->get();
		return $query->result();
	}
	
	/*
	 * Busca los reportes que escribio el usuario 
	 */
	function getReportesDeProyectoAutor($usuario,$proyecto)
	{
		$this->load->database();
		$this->db->select("r.idreporte, u.nombre, u.apellidop, r.titulo");
		$this->db->from('reporte r');
		$this->db->join('usuario u','r.idusuario = u.idusuario AND r.idProyecto = '.$proyecto.' AND r.idusuario = '.$usuario);
		$this->db->order_by("r.idReporte, r.titulo");
		$query = $this->db->get();
		return $query->result();
	}

	/*
	 * Busca los datos del reporte
	 */
	function getDescripcionReporte($param){
		$this->load->database();
		$this->db->select('titulo, Reporte as contenido');
		$this->db->from('reporte');
		$this->db->where('idReporte',$param);
		return $this->db->get()->result();
		
	}
	
	/*
	 * Actualiza descripcion del reporte
	 * Recibe el id del reporte
	 * idRep
	 */
	function modificaReporte($idRep){
		$this->load->database();
		$arreglo = array(
			'Titulo' => $this->titulo,
			'Reporte' => $this->Reporte);
		$this->db->where('idReporte', $idRep);
		$this->db->update('reporte',$arreglo);
	 }	
}
