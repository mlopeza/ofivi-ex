<?php
class Loginmodel extends CI_Model {

    var $Id   = '';
    var $Usuario = '';
    var $Contrasena    = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function get_usuarios()
    {
		$this->load->database();
        $query = $this->db->get('usuario');
        return $query->result();
    }
	function getId()
	{
		return $Id;
	}
	function getUsuario()
	{
		return $Usuario;
	}
	function getContrasena()
	{
		return $Contrasena;
	}
	function setId($entrada){
		$Id = $entrada;
	}
	function setUsuario($entrada){
		$Usuario = $entrada;
	}
	function setContrasena($entrada){
		$Contrasena = $entrada;
	}
}
?>