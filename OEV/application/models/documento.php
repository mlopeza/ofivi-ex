<?php
class Documento extends CI_Model{
	
	var $idDocumento;
	var $idProyecto = '';
	var $Titulo = 'Sin titulo';
	var $Archivo = '';
	var $esLegal = 0;
	var $esPropuesta = 0;
	var $estaAceptado = 0;
	var $Type = '';
	var $Size = 0;
	var $Extension = '';
	
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
	
	function getType()
	{
		return $this->Type;
	}
	
	function getSize()
	{
		return $this->Size;
	}
	
	function getExtension()
	{
		return $this->Extension;
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
	
	function setType($param)
	{
		 $this->Type = $param;
	}
	
	function setSize($param)
	{
		 $this->Size = $param;
	}
	
	function setExtension($param)
	{
		 $this->Extension = $param;
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
			'estaAceptado' => $this->estaAceptado,
			'Type' => $this->Type,
			'Size' => $this->Size,
			'Extension' => $this->Extension);
		$this->db->insert('documento',$data);
	}

	function getDocument($idDocument){
		$this->load->database();
		$query = $this->db->get_where('documento', array('idProyecto' => $idDocument));
		return $query->result();
	}
	function getDocumentDownload($idProyecto,$esLegal){
		$this->load->database();
		$query = $this->db->get_where('documento', array('idProyecto' => $idProyecto,'esLegal'=>$esLegal));
		return $query->result();
	}

	
	/*
	 * Elimina las propuestas de un proyecto
	 */
	 function deletePropuestas()
	 {
		 $this->load->database();
		 $this->db->where('idProyecto',$this->idProyecto);
		 $this->db->where('esPropuesta',1);
		 $this->db->delete('documento');
	 }
	
	/*
	 * Elimina las contratos legales de un proyecto
	 */
	 function deleteContratos()
	 {
		 $this->load->database();
		 $this->db->where('idProyecto',$this->idProyecto);
		 $this->db->where('esLegal',1);
		 $this->db->delete('documento');
	 }

}
?>
