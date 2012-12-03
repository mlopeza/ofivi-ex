<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class creaContacto extends CI_Controller
{
    public function index()
    {
        //Sesiones
        $data = $this->input->get();
        if (!isset($data['idGrupo']))
            $data['idGrupo'] = -1;
        
        if (!isset($data['idEmpresa']))
            $data['idEmpresa'] = -1;
        
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('usuariomodel');
        $this->load->helper('security');
        $this->load->library('session');
        if ($this->session->userdata('vista')) {
        } else {
            redirect('/logincontroller', 'location');
        }
        //Se carga el Modelo de Grupos
        $this->load->model('grupo');
        //Cargar la sesion		
        $datos_usuario = $this->session->all_userdata();
        $vista         = array(
            'vista' => $datos_usuario['vista']
        );
        //Se buscan todos los Grupos disponibles
        $query['data'] = $this->grupo->getAllGroups();
        //Se cargan las Vistas
        $this->load->view('usuarios/header', $vista);
        $this->load->view('usuarios/usuario_extension/menu_extension');
        $this->load->view('usuarios/usuario_extension/creaContacto', $query);
        $this->load->view('usuarios/footer');
        $this->load->view('usuarios/usuario_extension/Scripts/altaProyecto', $data);
        $this->load->view('usuarios/usuario_extension/Scripts/creaContacto');
    }
    
    //Regresa los contactos dando como parametro una empresa
    public function getContactos()
    {
        $data = $this->input->post();
        $this->load->model('contacto_model');
        $resultado = $this->contacto_model->getContactosDeEmpresaCompletos($data['idEmpresa']);
        echo json_encode(array(
            'mensaje' => $resultado,
            'response' => true
        ));
    }
    
    public function guardaContactos()
    {
        $data = $this->input->post();
        $this->load->model('contacto_model');
        if (!(isset($data['idEmpresa']))) {
            echo json_encode(array(
                "response" => "false"
            ));
            return;
        }
        
        if (isset($data['oldContactos']))
            $this->contacto_model->updateContactos($data['idEmpresa'], $data['oldContactos']);
        
        if (isset($data['newContactos']))
            $this->contacto_model->createContactos($data['idEmpresa'], $data['newContactos']);
        echo json_encode(array(
            "response" => "true"
        ));
    }
    
    public function deleteContacto()
    {
        $data = $this->input->post();
        $this->load->model('contacto_model');
        $this->contacto_model->deleteContact($data['idContacto']);
        
    }
    
    public function deleteTelefono()
    {
        $data = $this->input->post();
        $this->load->model('contacto_model');
        $this->contacto_model->deleteTelefono($data['idTelefono']);
        
    }
    
}
