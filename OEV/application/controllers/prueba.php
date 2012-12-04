<?php
class Informacion extends CI_Controller {
	public function index()
	{

	}
	public function getInfoProfesor(){
		$data = $this->input->post();
		//echo var_dump($data);
		if($data['idUsuario'] == null){
			//Si no vienen Datos, regresa error
			$mensaje = array('response'=>'false','mensaje'=>'No se ha seleccionado ningúna empresa.');
			echo json_encode($mensaje);
		}else{
			//Regresa las empresas del Grupo
			$this->load->model('usuariomodel');
			$resultado=$this->empresa->getEPAU($data['activo'],$data['idGrupo'],$data['idUsuario']);			
			//Se envia el resultado			
			$mensaje = array('response'=>'true','mensaje'=>$resultado);
			echo json_encode($mensaje);
		}
	}

}
?>