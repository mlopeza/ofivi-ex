<?php
class AvancesproyectoP extends CI_Controller {

	//Metodo que carga la página donde el usuario podrá loggearse o soliticitar una cuenta.
	public function index()
	{
		$this->load->helper('url');
		$this->load->library('session');
        $datos_usuario=$this->session->all_userdata();
        $vista = array('vista'=>$datos_usuario['vista']);
		$this->load->view('usuarios/header',$vista);
		$this->load->view('usuarios/usuario_proyecto/menu_uproyecto');
		$this->load->view('usuarios/usuario_proyecto/avances_proyecto');
		$this->load->view('usuarios/footer');
		$this->load->view('usuarios/usuario_proyecto/Scripts/avancesProyecto');
		$this->load->view('usuarios/usuario_extension/Scripts/ventanas-modales');
		
		
	}

	
	public function getEmpresas(){
		//Obtiene la informacion del POST
		$data = $this->input->post();
		//echo var_dump($data);
		if($data['idGrupo'] == null){
			//Si no vienen Datos, regresa error
			$mensaje = array('response'=>'false','mensaje'=>'No se ha seleccionado ningúna empresa.');
			echo json_encode($mensaje);
		}else{
			//Regresa las empresas del Grupo
			$this->load->model('empresa');
			$resultado=$this->empresa->getEPAP($data['activo'],$data['idGrupo'],$data['idGrupo']);			
			//Regresa las empresas del Grupo
			$this->load->model('proyecto');
			$resultado2=$this->proyecto->findPAP($resultado[0]->idEmpresa,$data['activo'],$data['idGrupo']);
			//Regresa a categoria del proyecto.
			$resultado3=$this->proyecto->getCATP($resultado2[0]->idProyecto);
			$resultado4=$this->proyecto->getUA($resultado2[0]->idProyecto);
			$resultado5=$this->proyecto->getCA($resultado2[0]->idProyecto);
			$this->load->model('estado');
			$resultado6=$this->estado->getAllEstados($resultado2[0]->idProyecto);
			$this->load->model('documento');
			$resultado7=$this->documento->getDocument($resultado2[0]->idProyecto);
			$resultado8=$this->proyecto->getSCATP($resultado2[0]->idProyecto);			
			
			//Se envia el resultado			
			$mensaje = array('response'=>'true','mensaje'=>$resultado,'proyectos'=>$resultado2,'categoria'=>$resultado3,'usuario'=>$resultado4,'contacto'=>$resultado5,'estado'=>$resultado6,'documento'=>$resultado7,'supracategoria'=>$resultado8);
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
			$mensaje = array('response'=>'false','mensaje'=>'Error al Buscar los Proyectos.');
			echo json_encode($mensaje);
		}else{
			//Regresa las empresas del Grupo
			$this->load->model('proyecto');
			$resultado=$this->proyecto->findPAP($data['idEmpresa'],$data['activo'],$data['idGrupo']);
			//Regresa a categoria del proyecto.
			$resultado2=$this->proyecto->getCATP($resultado[0]->idProyecto);
			$resultado3=$this->proyecto->getUA($resultado[0]->idProyecto);
			$resultado4=$this->proyecto->getCA($resultado[0]->idProyecto);
			$this->load->model('estado');
			$resultado6=$this->estado->getAllEstados($resultado[0]->idProyecto);	
			$this->load->model('documento');
			$resultado7=$this->documento->getDocument($resultado[0]->idProyecto);		
			$resultado8=$this->proyecto->getSCATP($resultado2[0]->idProyecto);			
			
			//Se envia el resultado
			$mensaje = array('response'=>'true','mensaje'=>$resultado,'categoria'=>$resultado2,'usuario'=>$resultado3,'contacto'=>$resultado4,'estado'=>$resultado6,'documento'=>$resultado7,'supracategoria'=>$resultado8);
			echo json_encode($mensaje);
		}
	}
		public function getInfo(){
		//Obtiene la informacion del POST
		$data = $this->input->post();
		//echo var_dump($data);
		if($data['idProyecto'] == null){
			//Si no vienen Datos, regresa error
			$mensaje = array('response'=>'false','mensaje'=>'Error al Buscar los Proyectos.');
			echo json_encode($mensaje);
		}else{
			//Regresa las empresas del Grupo
			$this->load->model('proyecto');
			//Regresa a categoria del proyecto.
			$resultado2=$this->proyecto->getCATP($data['idProyecto']);
			$resultado3=$this->proyecto->getUA($data['idProyecto']);
			$resultado4=$this->proyecto->getCA($data['idProyecto']);
						$this->load->model('estado');
			$resultado6=$this->estado->getAllEstados($data['idProyecto']);
			$this->load->model('documento');
			$resultado7=$this->documento->getDocument($data['idProyecto']);
			$resultado8=$this->proyecto->getSCATP($resultado2[0]->idProyecto);			
			
			//Se envia el resultado
			$mensaje = array('response'=>'true','categoria'=>$resultado2,'usuario'=>$resultado3,'contacto'=>$resultado4,'estado'=>$resultado6,'documento'=>$resultado7,'supracategoria'=>$resultado8);
			echo json_encode($mensaje);
		}
	}
		/*Regresa los grupos en Formato JSON*/
	public function getGrupos(){
				//Obtiene la informacion del POST
		$data = $this->input->post();
		//echo var_dump($data);
		if($data['activo'] === null || !isset($data['activo'])){
			//Si no vienen Datos, regresa error
			$mensaje = array('response'=>'false','mensaje'=>'Error al Buscar los Grupos.');
			echo json_encode($mensaje);
		}else{
			//Regresa el grupo
			$this->load->model('grupo');
			$grupo=$this->grupo->getGPAP($data['activo'],$data['idUsuario']);
			//Regresa las empresas del Grupo
			if(!empty($grupo)){
			$this->load->model('empresa');
			$resultado=$this->empresa->getEPAP($data['activo'],$grupo[0]->idGrupo,$data['idUsuario']);
			//Regresa los proyectos de la empresa
			$this->load->model('proyecto');
			$resultado2=$this->proyecto->findPAP($resultado[0]->idEmpresa,$data['activo'],$data['idUsuario']);
			//Regresa a categoria del proyecto.
			$resultado3=$this->proyecto->getCATP($resultado2[0]->idProyecto);
			$resultado4=$this->proyecto->getUA($resultado2[0]->idProyecto);
			$resultado5=$this->proyecto->getCA($resultado2[0]->idProyecto);
			//Regresa los estados del proyecto.
			$this->load->model('estado');
			$resultado6=$this->estado->getAllEstados($resultado2[0]->idProyecto);
			$this->load->model('documento');
			$resultado7=$this->documento->getDocument($resultado2[0]->idProyecto);			
			$resultado8=$this->proyecto->getSCATP($resultado2[0]->idProyecto);						
				//Se envia el resultado		
			$mensaje = array('response'=>'true','mensaje'=>$resultado,'proyectos'=>$resultado2,'grupo'=>$grupo,'categoria'=>$resultado3,'usuario'=>$resultado4,'contacto'=>$resultado5,'estado'=>$resultado6,'documento'=>$resultado7,'supracategoria'=>$resultado8);}
			else{
				$mensaje = array('response'=>'false','mensaje'=>'No existen proyectos en la base de datos.','grupo'=>$grupo);}
			echo json_encode($mensaje);
		}
	}
	function do_download($esLegal,$idProyecto)
	{
		$this->load->model('documento');
		$this->load->helper('url');
		$documento=$this->documento->getDocumentDownload($idProyecto,$esLegal);
		$size = $documento[0]->Size;
		$type = $documento[0]->Extension;
		$name = $documento[0]->Titulo;
		$content = stripslashes($documento[0]->Archivo);
		header("Content-length: ".$size."");
		header("Content-type: ".$type."");
		header('Content-Disposition: attachment; filename="'.$name.'"');
		echo $content;
	}
}
?>
