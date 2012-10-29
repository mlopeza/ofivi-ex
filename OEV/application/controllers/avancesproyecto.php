<?php
class Avancesproyecto extends CI_Controller {

	//Metodo que carga la página donde el usuario podrá loggearse o soliticitar una cuenta.
	public function index()
	{
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->view('usuarios/header');
		$this->load->view('usuarios/usuario_extension/menu_extension');
		$this->load->view('usuarios/usuario_extension/avances_proyecto');
		$this->load->view('usuarios/footer');
		$this->load->view('usuarios/usuario_extension/Scripts/avancesProyecto');
		
	}
	
	/*Regresa las empresas en Formato JSON*/
	public function getEmpresas(){
		//Obtiene la informacion del POST
		$data = $this->input->post();
		//echo var_dump($data);
		if($data['idGrupo'] == null){
			//Si no vienen Datos, regresa error
			$mensaje = array('response'=>'false','mensaje'=>'Error al Buscar el Grupo.');
			echo json_encode($mensaje);
		}else{
			//Regresa las empresas del Grupo
			$this->load->model('empresa');
			$resultado=$this->empresa->getEPA(1,$data['idGrupo']);
			//Regresa las empresas del Grupo
			$this->load->model('proyecto');
			$resultado2=$this->proyecto->findPA($resultado[0]->idEmpresa,1);
			//Se envia el resultado			
			$mensaje = array('response'=>'true','mensaje'=>$resultado,'proyectos'=>$resultado2);
			echo json_encode($mensaje);
		}
	}
	/*Regresa las empresas en Formato JSON*/
	public function getProyectos(){
		//Obtiene la informacion del POST
		$data = $this->input->post();
		//echo var_dump($data);
		if($data['idEmpresa'] == null){
			//Si no vienen Datos, regresa error
			$mensaje = array('response'=>'false','mensaje'=>'Error al Buscar el sd.');
			echo json_encode($mensaje);
		}else{
			//Regresa las empresas del Grupo
			$this->load->model('proyecto');
			$resultado=$this->proyecto->findPA($data['idEmpresa'],1);
			//Se envia el resultado
			$mensaje = array('response'=>'true','mensaje'=>$resultado);
			echo json_encode($mensaje);
		}
	}
		/*Regresa los grupos en Formato JSON*/
	public function getGrupos(){
		//Obtiene la informacion del POST
		$data = $this->input->post();
		//echo var_dump($data);
		if($data['activo'] === null){
			//Si no vienen Datos, regresa error
			$mensaje = array('response'=>'false','mensaje'=>'Error al Buscar el Grupo.');
			echo json_encode($mensaje);
		}else{
			//Regresa el grupo
			$this->load->model('grupo');
			$grupo=$this->grupo->getGPA(1);
			//Regresa las empresas del Grupo
			$this->load->model('empresa');
			$resultado=$this->empresa->getEPA($data['activo'],1);
			//Regresa los proyectos de la empresa
			$this->load->model('proyecto');
			$resultado2=$this->proyecto->findPA($resultado[0]->idEmpresa,1);
			//Se envia el resultado		
			$mensaje = array('response'=>'true','mensaje'=>$resultado,'proyectos'=>$resultado2,'grupo'=>$grupo);
			echo json_encode($mensaje);
		}
	}
}
?>