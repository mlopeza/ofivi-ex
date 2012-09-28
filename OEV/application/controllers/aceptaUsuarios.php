<?php
class AceptaUsuarios extends CI_Controller {

	public function index()
	{
		$this->load->helper('url');
		$this->load->helper('formatter');
		$this->load->model('usuariomodel');
        $this->load->helper('form');
		$query['data']=$this->usuariomodel->getUsuariosPendientes();
		$this->load->view('usuarios/header');
		$this->load->view('usuarios/administrador/menu_administrador');
		$this->load->view('usuarios/administrador/acepta_usuario',$query);
		$this->load->view('usuarios/footer');
		
	}

	public function insertData()
	{

		$post_data = $_GET;
		print_r($post_data);die();
 
 	
    
		/*$posts = array();
        foreach($_POST as $key => $value) {
			$posts[$key] = $this->post($key);
			echo "<p>Key: ".$key. " Value:" . $value . "</p>\n";
        }*/
	}
}
?>
