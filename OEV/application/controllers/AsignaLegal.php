<?php
class AsignaLegal extends CI_Controller {

	public function index()
	{
		
		//Sesiones

		$this->load->helper('url');
        $this->load->helper('form');
		$this->load->model('usuariomodel');
		$this->load->model('proyecto');
		$this->load->helper('security');		

		$this->load->library('session');
		//Cargar la sesion		
		$datos_usuario=$this->session->all_userdata();
		$vista = array('vista'=>$datos_usuario['vista']);

        //Regresa los proyectos iniciados por el usuario y que esten activos
        $proyectos=$this->proyecto->getProyectosIniciados($datos_usuario['idUsuario'],1);
		$legal =$this->usuariomodel->regresaLegalSP();
		//Se cargan las Vistas
		$this->load->view('usuarios/header',$vista);
		$this->load->view('usuarios/usuario_extension/menu_extension');
        $this->load->view('usuarios/usuario_extension/asignaLegal',array('proyectos'=>$proyectos,'legal'=>$legal));
		

		$this->load->view('usuarios/footer');
		$this->load->view('usuarios/usuario_extension/Scripts/asignaLegal');
//		$this->load->view('usuarios/usuario_extension/Scripts/asignaProyecto');
    }
	function asingaLegal(){
		$data = $this->input->post();
        try{
        $this->load->helper('mail');
	    	$this->load->model('proyecto');
	    	$this->load->model('usuariomodel');
    		$respuesta=$this->usuariomodel->insertaLegal($data['idUsuario'],$data['idProyecto']);
			$result1=$this->proyecto->getResumenProyecto($data['idProyecto']);
          	$result2=$this->usuariomodel->getUsuario($data['idUsuario']);
          //Mensaje al Usuario de Asignacion          
            $mensaje=$this->load->view('mensajes/mensajeAsignacion',array('r'=>$result1,'p'=>$result2),true);
            $sent = enviaMail($this,$result2->email,'Nuevo Proyecto en OFIVEX',$mensaje);
          
        //Respuesta
    		echo json_encode(array('response'=>'true','mensaje'=>"Usuario Asignado"));
        }catch(Exception $e){
			echo json_encode(array('response'=>'false','mensaje'=>"Hubo un error en el Sistema, favor de intentarlo mas tarde.".$e->getMessage()));
		}
	}
	function eliminaAsignacion(){
		$data = $this->input->post();
        try{
        $this->load->helper('mail');
	    	$this->load->model('proyecto');
	    	$this->load->model('usuariomodel');
    		$respuesta=$this->usuariomodel->eliminaLegal($data['idUsuario'],$data['idProyecto']);
			$result1=$this->proyecto->getResumenProyecto($data['idProyecto']);
          	$result2=$this->usuariomodel->getUsuario($data['idUsuario']);
          //Mensaje al Usuario de Asignacion          
            $mensaje=$this->load->view('mensajes/mensajeAsignacion',array('r'=>$result1,'p'=>$result2),true);
            $sent = enviaMail($this,$result2->email,'Nuevo Proyecto en OFIVEX',$mensaje);
          
        //Respuesta
    		echo json_encode(array('response'=>'true','mensaje'=>"Usuario Eliminado"));
        }catch(Exception $e){
			echo json_encode(array('response'=>'false','mensaje'=>"Hubo un error en el Sistema, favor de intentarlo mas tarde.".$e->getMessage()));
		}
	}
	function legalAsignados(){
		$data = $this->input->post();
        try{
        $this->load->helper('mail');
	    	$this->load->model('proyecto');
	    	$this->load->model('usuariomodel');
    		$respuesta=$this->usuariomodel->regresaLegalCP();

          
        //Respuesta
    		echo json_encode(array('response'=>'true','mensaje'=>$respuesta));
        }catch(Exception $e){
			echo json_encode(array('response'=>'false','mensaje'=>"Hubo un error en el Sistema, favor de intentarlo mas tarde.".$e->getMessage()));
		}
}
function legalAsignar(){
		$data = $this->input->post();
        try{
        $this->load->helper('mail');
	    	$this->load->model('proyecto');
	    	$this->load->model('usuariomodel');
    		$respuesta=$this->usuariomodel->regresaLegalSP();

          
        //Respuesta
    		echo json_encode(array('response'=>'true','mensaje'=>$respuesta));
        }catch(Exception $e){
			echo json_encode(array('response'=>'false','mensaje'=>"Hubo un error en el Sistema, favor de intentarlo mas tarde.".$e->getMessage()));
		}
}
}
?>
