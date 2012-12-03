
<?php
class BajaContacto extends CI_Controller {

	//Metodo que carga la página donde el usuario podrá loggearse o soliticitar una cuenta.
	public function index()
	{
		$this->load->helper('url');
		$this->load->library('session');
    if($this->session->userdata('vista')){
    
    }else{
      redirect('/logincontroller', 'location');
    }
		$this->load->model('grupo');
		$this->load->model('empresa');
		$this->load->model('contacto_model');
		$resultado['grupos'] = $this->grupo->getAllGroups()->result();
		$resultado['empresas']= $this->empresa->getEmpresasDeGrupo($resultado['grupos'][0]->idGrupo);
		$resultado['contacto']= $this->contacto_model->getContactosEmpresa($resultado['empresas'][0]->idEmpresa);
		$this->load->view('usuarios/header');
		$this->load->view('usuarios/usuario_extension/baja_Contacto',$resultado);
		$this->load->view('usuarios/footer');		
	}
}
?>
