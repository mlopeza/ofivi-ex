<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class altaEmpresa extends CI_Controller
{
    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -  
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function index()
    {
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helper('array');
        $this->load->helper('security');
        $this->load->library('session');
        if ($this->session->userdata('vista')) {
        } else {
            redirect('/logincontroller', 'location');
        }
        $datos_usuario = $this->session->all_userdata();
        $vista         = array(
            'vista' => $datos_usuario['vista']
        );
        
        $this->load->view('usuarios/header', $vista);
        $this->load->view('usuarios/usuario_extension/menu_extension');
        
        $this->load->model('grupo');
        
        $grupos['grupos'] = $this->grupo->selectGrupos();
        $this->load->view('usuarios/usuario_extension/alta_Empresa', $grupos);
        //$this->load->view('usuarios/usuario_extension/alta_Empresa');
        $this->load->view('usuarios/footer');
    }
    
    public function alta()
    {
        $this->load->model('empresa');
        $this->load->helper('url');
        $this->empresa->set_id_grupo($this->input->post('grupo'));
        $this->empresa->set_nombre($this->input->post('nombre_empresa'));
        $this->empresa->insert(); //Se registra el proyecto
        redirect('altaEmpresa', 'location');
        
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
