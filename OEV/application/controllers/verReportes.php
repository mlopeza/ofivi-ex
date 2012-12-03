<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class verReportes extends CI_Controller
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
        $proyectos['proyectos'] = $this->proyecto->getProyectosIniciados($usuario, 1);
        
        //Se cargan las Vistas
        $this->load->view('usuarios/header', $vista);
        $this->load->view('usuarios/usuario_extension/menu_extension');
        $this->load->view('usuarios/usuario_extension/ver_Reportes', $proyectos);
        $this->load->view('usuarios/footer');
        $this->load->view('usuarios/usuario_extension/Scripts/verReporte');
    }
    
    //Regresa los reportes de un proyecto
    public function reportesDeProyecto()
    {
        $data = $this->input->post();
        try {
            $this->load->model('reporte');
            $this->load->library('session');
            if ($this->session->userdata('vista')) {
            } else {
                redirect('/logincontroller', 'location');
            }
            //Cargar la sesion y se obtiene el id del usuario
            $datos_usuario = $this->session->all_userdata();
            $usuario       = $datos_usuario['idUsuario'];
            $resultado     = $this->reporte->getReportesDeProyecto($usuario, $data['idProyecto']);
            echo json_encode(array(
                'response' => 'true',
                'mensaje' => $resultado
            ));
        }
        catch (Exception $e) {
            echo json_encode(array(
                'response' => 'false',
                'mensaje' => "Hubo un error en el Sistema, favor de intentarlo mas tarde." . $e->getMessage()
            ));
        }
    }
    
    /*
     * Obtiene la descripcion del reporte seleccionado
     */
    public function getReporte()
    {
        $data = $this->input->post();
        try {
            $this->load->model('reporte');
            $resultado = $this->reporte->getDescripcionReporte($data['idReporte']);
            echo json_encode(array(
                'response' => 'true',
                'mensaje' => $resultado
            ));
        }
        catch (Exception $e) {
            echo json_encode(array(
                'response' => 'false',
                'mensaje' => "Hubo un error en el Sistema, favor de intentarlo mas tarde." . $e->getMessage()
            ));
        }
    }
}
