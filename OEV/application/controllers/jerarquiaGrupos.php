<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class jerarquiaGrupos extends CI_Controller
{
    public function index()
    {
        //Sesiones
        
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('usuariomodel');
        $this->load->helper('security');
        $this->load->library('session');
        if ($this->session->userdata('vista')) {
        } else {
            redirect('/logincontroller', 'location');
        }
        //Se carga el Modelo de Proyecto
        //Cargar la sesion y se obtiene el id del usuario
        $datos_usuario = $this->session->all_userdata();
        $vista         = array(
            'vista' => $datos_usuario['vista']
        );
        $usuario       = $datos_usuario['idUsuario'];
        //Se buscan todos los proyectos relacionados al usuario
        
        //Se cargan las Vistas
        $this->load->view('usuarios/header', $vista);
        $this->load->view('usuarios/usuario_extension/menu_extension');
        $this->load->view('usuarios/usuario_extension/jerarquiaGruposVista');
        $this->load->view('usuarios/footer');
        $this->load->view('usuarios/usuario_extension/Scripts/jerarquiaGruposScript');
    }
    
    //Regresa Todos los grupos de la base de datos
    public function getGrupos()
    {
        $this->load->model('grupo');
        echo json_encode($this->grupo->getAllGroups2());
    }
    
    //Regresa Las empresas de un Grupo
    public function getEmpresas()
    {
        $idGrupo = $this->input->post('idGrupo');
        $this->load->model('grupo');
        if (!isset($idGrupo))
            $idGrupo = 0;
        echo json_encode($this->grupo->getEmpresas($idGrupo));
    }
    
    //Regresa Las empresas de un Grupo
    public function saveGrupo()
    {
        $data = $this->input->post();
        $this->load->model('grupo');
        $this->grupo->saveGrupo($data);
        echo json_encode(array(
            "mensaje" => "Acción relizada con éxito"
        ));
    }
    
    //Regresa Las empresas de un Grupo
    public function saveEmpresa()
    {
        $data = $this->input->post();
        $this->load->model('empresa');
        $result = $this->empresa->saveEmpresa($data);
        echo json_encode($result[0]);
    }
    
    //Pone inactivo un Grupo
    public function deleteGrupo()
    {
        $data = $this->input->post();
        $this->load->model('grupo');
        $this->grupo->deleteGrupo($data);
        echo json_encode(array(
            "mensaje" => "Acción relizada con éxito",
            "data" => $data
        ));
    }
    
    //Pone inactivo una empresa
    public function deleteEmpresa()
    {
        $data = $this->input->post();
        $this->load->model('empresa');
        $this->empresa->deleteEmpresa($data);
        echo json_encode(array(
            "mensaje" => "Acción relizada con éxito"
        ));
    }
    
    public function getLista()
    {
        $this->load->model('grupo');
        echo json_encode($this->grupo->getJerarquia());
    }
    
}
