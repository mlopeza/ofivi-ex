<?php
class Documento extends CI_Model{
	
	var $idDocumento;
	var $idProyecto = '';
	var $Titulo = 'Sin titulo';
	var $Archivo = '';
	var $esLegal = 0;
	var $esPropuesta = 0;
	var $estaAceptado = 0;
	
	function getIdDocumento()
	{
		return $this->idDocumento;
	}
	
	function getIdProyecto()
	{
		return $this->idProyecto;
	}
	
	function getTitulo()
	{
		return $this->Titulo;
	}
	
	function getArchivo()
	{
		return $this->Archivo;
	}
	
	function getEsLegal()
	{
		return $this->esLegal;
	}
	
	function getEsPropuesta()
	{
		return $this->esPropuesta;
	}
	
	function getEstaAceptado()
	{
		return $this->estaAceptado;
	}
	
	function setIdDocumento($param)
	{
		$this->idDocumento = $param;
	}
	
	function setIdProyecto($param)
	{
		$this->idProyecto = $param;
	}
	
	function setTitulo($param)
	{
		$this->Titulo = $param;
	}
	
	function setArchivo($param)
	{
		$this->Archivo = $param;
	}
	
	function setEsLegal($param)
	{
		$this->esLegal = $param;
	}
	
	function setEsPropuesta($param)
	{
		$this->esPropuesta = $param;
	}
	
	function setEstaAceptado($param)
	{
		$this->estaAceptado = $param;
	}

	/*
	 * Guarda el archivo de la propuesta en la base de datos
	 * Resive idProyecto y archivo
	 */
	function insert()
	{
		$this->load->database();
		$data = array(
			'idProyecto' => $this->idProyecto,
			'Titulo' => $this->Titulo,
			'Archivo' => $this->Archivo,
			'esLegal' => $this->esLegal,
			'esPropuesta' => $this->esPropuesta,
			'estaAceptado' => $this->estaAceptado);
		$this->db->insert('documento',$data);
	}
}
?>
