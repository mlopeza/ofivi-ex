<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ActualizaEspecialidad extends CI_Controller
{
    public function index()
    {
        //Sesiones
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('usuariomodel');
        $this->load->helper('security');
        $this->load->library('session');
        //Cargar la sesion		
        if ($this->session->userdata('vista')) {
        } else {
            redirect('/logincontroller', 'location');
        }
        $datos_usuario = $this->session->all_userdata();
        $vista         = array(
            'vista' => $datos_usuario['vista']
        );
        //		echo json_encode($datos_usuario);
        //Regresa los proyectos iniciados por el usuario y que esten activos
        $areas         = $this->usuariomodel->getEspecialidad($datos_usuario['username']);
        //Se cargan las Vistas
        $this->load->view('usuarios/header', $vista);
        $this->load->view('usuarios/usuario_proyecto/menu_uproyecto');
        $this->load->view('usuarios/usuario_extension/actualizaEspecialidad', array(
            'areas' => $areas
        ));
        $this->load->view('usuarios/footer');
        $this->load->view('usuarios/usuario_proyecto/Scripts/asignaEspecialidad');
    }
    public function actualizar()
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
        $datos_usuario = $this->session->all_userdata();
        $this->usuariomodel->deleteEspecialidad($this->usuariomodel->obtenId($datos_usuario['username']));
        foreach ($this->input->post("especialidad") as $especialidad) {
            $this->usuariomodel->agregaEspecialidad($especialidad, $this->usuariomodel->obtenId($datos_usuario['username']));
        }
        //Cargar la sesion		
        $datos_usuario = $this->session->all_userdata();
        $vista         = array(
            'vista' => $datos_usuario['vista']
        );
        //		echo json_encode($datos_usuario);
        //Regresa los proyectos iniciados por el usuario y que esten activos
        $areas         = $this->usuariomodel->getEspecialidad($datos_usuario['username']);
        //Se cargan las Vistas
        $this->load->view('usuarios/header', $vista);
        $this->load->view('usuarios/usuario_proyecto/menu_uproyecto');
        $this->load->view('usuarios/usuario_extension/actualizaEspecialidad', array(
            'areas' => $areas
        ));
        $this->load->view('usuarios/footer');
        $this->load->view('usuarios/usuario_proyecto/Scripts/asignaEspecialidad');
        $this->load->view('usuarios/usuario_proyecto/Scripts/notyfi');
    }
}
?>
