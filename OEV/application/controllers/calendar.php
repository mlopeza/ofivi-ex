<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Calendar extends CI_Controller
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
        $this->load->model('proyecto');
        //Cargar la sesion y se obtiene el id del usuario
        $datos_usuario          = $this->session->all_userdata();
        $vista                  = array(
            'vista' => $datos_usuario['vista']
        );
        $usuario                = $datos_usuario['idUsuario'];
        //Se buscan todos los proyectos relacionados al usuario
        $proyectos['proyectos'] = $this->proyecto->selectProyectos($usuario);
        
        $this->load->view('usuarios/header', $vista);
        //$this->load->view('usuarios/usuario_proyecto/menu_uproyecto');
        $this->load->view('usuarios/common/calendario');
        $this->load->view('usuarios/footer');
        $this->load->view('usuarios/common/Scripts/calendarioScript');
    }
    
    public function edit()
    {
        $this->load->file("calendarPHP/edit.php");
    }
    
    
}
