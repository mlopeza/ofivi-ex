<?php
class EnviaRecordatorios extends CI_Controller {

	public function index()
	{

        //Se carga el Helper
        $this->load->helper('mail');
        $this->load->database();
        //Se carga la Base de Datos

        //Se hace el Query de todos los usuarios que tengan pendienet un recordatorio
        $this->db->select('c.idUsuario');	
        $this->db->from('jqcalendar c');
        $this->db->where(array('enviado'=>0,'StartTime < '=>'DAT_SUB(now(),INTERVAL 1 HOUR)'));
        $this->db->group_by("c.idUsuario");
        $query = $this->db->get();
        $result = $query->result();
        
        //Se mandan los e-mails e los recordatorios pendientes en la ultima hora
        foreach($result as $usuario){
            $this->db->select('u.Nombre, u.ApellidoP,u.email,c.Subject,c.Location,c.Description,c.StartTime,c.EndTime,c.isAllDayEvent');
            $this->db->from('Usuario u');
            $this->db->join('jqcalendar c',
                            'c.idUSuario = u.idUsuario',
                            'inner');
            $this->db->where(array('u.idUsuario'=>$usuario->idUsuario,'c.StartTime <'=>'DAT_SUB(now(),INTERVAL 1 HOUR)'));

            $query=$this->db->get();
            //Se crea el mansaje que sera enviado al usuario
            //$mensaje = $this->load->view('mensajes/mensajeRecordatorios', '', true);;
            $result = $query->result();
            $mensaje=$this->load->view('mensajes/mensajeRecordatorios',array('r'=>$result),true);
            $sent = enviaMail($this,$result[0]->email,'Recordatorios OFIVEX',$mensaje);
            if($sent){
                $this->db->where(array('idUsuario'=>$usuario->idUsuario,'StartTime <'=>'DAT_SUB(now(),INTERVAL 1 HOUR)'));
                $this->db->update('jqcalendar',array('enviado'=>1));
                echo "Enviado";
            }else{
                echo "No enviado";
            }
        }

	}

}

?>
