<?php
class CambioContrasena extends CI_Controller
{
    //Metodo que carga la página donde el usuario podrá loggearse o soliticitar una cuenta.
    public function index()
    {
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('usuariomodel');
        $this->load->helper('security');
        $this->load->library('session');
        if ($this->session->userdata('vista')) {
        } else {
            redirect('/logincontroller', 'location');
        }
        //Trae todos los usuarios
        $usuarios  = $this->usuariomodel->getUsuariosAA();
        $resultado = array(
            'usuarios' => $usuarios
        );
        
        $datos_usuario = $this->session->all_userdata();
        $vista         = array(
            'vista' => $datos_usuario['vista']
        );
        $this->load->view('usuarios/header', $vista);
        $this->load->view('usuarios/administrador/menu_administrador');
        $this->load->view('/usuarios/administrador/cambioContrasena', $resultado);
        $this->load->view('usuarios/footer');
        
    }
    public function cambiarContrasenaUsuario()
    {
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
        $vista         = array(
            'vista' => $datos_usuario['vista']
        );
        $this->load->view('usuarios/header', $vista);
        $this->load->view('/usuarios/usuario_extension/cambioContrasena');
        $this->load->view('usuarios/footer');
    }
    public function cambiarContrasena()
    {
        $this->load->helper(array(
            'form',
            'url'
        ));
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->helper('security');
        $this->load->library('session');
        $this->load->model('usuariomodel');
        $this->form_validation->set_rules('password', 'Password', 'required|matches[password_conf]');
        $this->form_validation->set_rules('password_conf', 'Password Confirmation', 'required');
        if ($this->session->userdata('vista')) {
        } else {
            redirect('/logincontroller', 'location');
        }
        
        //Vistas
        $datos_usuario = $this->session->all_userdata();
        $vista         = array(
            'vista' => $datos_usuario['vista']
        );
        $this->load->view('usuarios/header', $vista);
        $this->load->view('usuarios/administrador/menu_administrador');
        $usuarios  = $this->usuariomodel->getUsuariosAA();
        $resultado = array(
            'usuarios' => $usuarios,
            "mensaje" => "Contrase&ntilde;a cambiada!"
        );
        if ($this->form_validation->run() == TRUE) {
            $this->load->helper('mail');
            $this->usuariomodel->actualizarInfo($this->input->post('susuario'), $this->input->post('password'));
            enviaMail($this, $this->usuariomodel->obtenEmail($this->input->post('susuario')), "Información de cuenta de OFIVEX", mensajeContrasena($this->usuariomodel->obtenNombre($this->input->post('susuario')), $this->input->post('password')));
            $this->load->view('/usuarios/administrador/cambioContrasena', $resultado);
        } else {
            $this->load->view('/usuarios/administrador/cambioContrasena', $resultado);
        }
        $this->load->view('usuarios/footer');
    }
    public function cambiarContrasenaU()
    {
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('usuariomodel');
        $this->load->helper('security');
        $this->load->library('session');
        if ($this->session->userdata('vista')) {
        } else {
            redirect('/logincontroller', 'location');
        }
        $this->load->library('form_validation');
        $this->load->model('usuariomodel');
        
        $datos_usuario = $this->session->all_userdata();
        $vista         = array(
            'vista' => $datos_usuario['vista']
        );
        $this->load->view('usuarios/header', $vista);
        
        
        $this->form_validation->set_rules('passwordActual', 'Password Actual', 'callback_username');
        $this->form_validation->set_rules('password', 'Password', 'required|matches[password_conf]|trim');
        $this->form_validation->set_rules('password_conf', 'Password Confirmation', 'required');
        $this->form_validation->set_message('required', '%s Campo Requerido.');
        $this->form_validation->set_message('matches', 'Las Contrase&ntilde;as no son iguales.');
        
        //Vistas
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('/usuarios/usuario_extension/cambioContrasena');
        } else {
            $this->usuariomodel->actualizaContra($this->input->post('idUsuario'), $this->input->post('password'));
            $this->load->view('contrasenaActualizada');
        }
        $this->load->view('usuarios/footer');
    }
    public function username($str)
    {
        $this->load->model('usuariomodel');
        if ($this->usuariomodel->comparaContra($this->input->post('idUsuario'), $str) == 0) {
            $this->form_validation->set_message('username', 'La Contrase&ntilde;a introducida no coincide con la del usuario.');
            
            return FALSE;
        } else {
            return TRUE;
        }
    }
}
?>
