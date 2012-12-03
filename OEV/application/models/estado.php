<?php
Class Estado extends CI_Model
{
    var $idProyecto = '';
    var $tiempoActualizacion = '';
    var $idUsuario = '';
    var $estado = '';
    
    function getIdProyecto()
    {
        return $this->idProyecto;
    }
    
    function getTiempoActualizacion()
    {
        return $this->tiempoActualizacion;
    }
    
    function getIdUsuario()
    {
        return $this->idUsuario;
    }
    
    function getEstado()
    {
        return $this->estado;
    }
    
    function setIdProyecto($param)
    {
        $this->idProyecto = $param;
    }
    
    function setIdUsuario($param)
    {
        $this->idUsuario = $param;
    }
    
    function setTiempoActualizacion($param)
    {
        $this->tiempoActualizacion = $param;
    }
    
    function setEstado($param)
    {
        $this->estado = $param;
    }
    
    function insert()
    {
        $this->load->database();
        $data = array(
            'idProyecto' => $this->idProyecto,
            'idUsuario' => $this->idUsuario,
            'estado' => $this->estado
        );
        $this->db->insert('Estado', $data);
    }
    
    function getAllEstados($idProyecto)
    {
        $this->load->database();
        $qry   = "SELECT CONCAT(u.nombre,' ' ,u.apellidoP,' ',u.apellidoM) as nombre, e.estado, e.tiempoActualizacion as fecha
				From usuario as u, estado as e
				WHERE e.idProyecto = " . $idProyecto . " AND
				u. idUsuario = e.idUsuario
				ORDER BY tiempoActualizacion DESC";
        $query = $this->db->query($qry);
        return $query->result();
    }
    
    function getEstadoProyecto($idProyecto)
    {
        $this->load->database();
        $qry   = "SELECT e.estado
				From estado as e
				WHERE e.idProyecto = " . $idProyecto . " 
				ORDER BY tiempoActualizacion DESC LIMIT 1 ";
        $query = $this->db->query($qry);
        return $query->result();
    }
}
?>
