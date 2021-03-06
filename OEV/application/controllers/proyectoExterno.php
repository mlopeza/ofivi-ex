<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class proyectoExterno extends CI_Controller
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
        $this->load->model('usuariomodel');
        //Cargar la sesion y se obtiene el id del usuario
        $datos_usuario          = $this->session->all_userdata();
        $vista                  = array(
            'vista' => $datos_usuario['vista']
        );
        //$usuario = $this->usuariomodel->obtenId($datos_usuario['username']);
        //Se buscan todos los proyectos relacionados al usuario Exterior
        $idUsuarioExterior      = $this->usuariomodel->getExterior();
        $proyectos['proyectos'] = $this->proyecto->selectProyectosExteriores($idUsuarioExterior);
        
        //Se cargan las Vistas
        $this->load->view('usuarios/header', $vista);
        $this->load->view('usuarios/usuario_extension/menu_extension');
        $this->load->view('usuarios/usuario_extension/listaProyectosExternos', $proyectos);
        $this->load->view('usuarios/footer');
        $this->load->view('usuarios/usuario_extension/Scripts/listaProyectosExternosScript');
        
    }
    function altaProyectoExterno()
    {
        $data = $this->input->post();
        $this->load->helper('url');
        $this->load->model('proyecto');
        $this->load->model('usuariomodel');
        $this->load->model('empresa');
        $this->load->model('estado');
        $arreglo = array(
            'nombre',
            'apellidoP',
            'apellidoM',
            'email',
            'estadoRep',
            'empresa',
            'puesto',
            'lada',
            'telefono',
            'extension',
            'informacionExtra',
            'categoria',
            'nombreProyecto',
            'descripcionUsuario'
        );
        foreach ($arreglo as $row) {
            if (isset($data[$row])) {
            } else {
                $data[$row] = 'Sin Informacion';
            }
        }

	$descripcion = "
		Datos de contacto<br/>
				<br/>
				Nombre: " . $data["nombre"] . "<br/>
				Apellido Paterno: " . $data["apellidoP"] . "<br/>
				Apellido Materno: " . $data["apellidoM"] . "<br/>
				Email: " . $data["email"] . "<br/>
				<br/>
				Estado de la rep&uacute;blica: " . $data["estadoRep"] . "<br/>
				Empresa: " . $data["empresa"] . "<br/>
				Puesto: " . $data["puesto"] . "<br/>
				<br/>
				Lada: " . $data["lada"] . "<br/>
				Tel&eacute;fono: " . $data["telefono"] . "<br/>
				Extensi&oacute;n: " . $data["extension"] . "<br/>
				Sub Extensi&oacute;n: " . $data["informacionExtra"] . "<br/>
				
				Datos del proyecto<br/>
				<br/>
				Categor&iacute;a:" . $data["categoria"] . "<br/>
				Subcategor&iacute;a: " . $data["subCategoria"] . "<br/>
				<br/>
				Nombre de proyecto: " . $data["nombreProyecto"] . "<br/>
				Descripci&oacute;n: " . $data["descripcionUsuario"];
        
        //Obtenemos el id del usuario Exterior
        $idUsuarioExterior = $this->usuariomodel->getExterior();
        $idEmpresaExterior = $this->empresa->getExterior();
        
        $data   = array(
            'idEmpresa' => $idEmpresaExterior,
            'nombre' => $data['nombreProyecto'],
            'descripcionUsuario' => $descripcion,
            'descripcionAEV' => '',
            'iniciadoPor' => $idUsuarioExterior
        );
        $idProy = $this->proyecto->altaProyectoExterno($data);
        //Se crea el estado de entrada de proyecto exterior
        $this->estado->setIdProyecto($idProy);
        $this->estado->setIdUsuario($idUsuarioExterior);
        $this->estado->setEstado('Entrada de proyecto externo');
        $this->estado->insert();
        //Regresa los correos del usuario de extension
        $emails=$this->usuariomodel->getCorreosUE();
        if($emails != NULL || !$emails != ""){
          $this->load->helper('mail');
          $mensaje = $this->load->view('mensajes/mensajePexterno', array(
            'mensaje'=>$descripcion
          ), true);
          enviaMail($this, $emails, "Nuevo Proyecto Externo en OFIVEX",$mensaje);        
        }
      	header('Location: /CLIENTE_OVE/contacto.php');
    }
    
    
    function aceptaProyecto()
    {
        $data = $this->input->post();
        $this->load->model('proyecto');
        $this->load->model('usuariomodel');
        $this->load->library('session');
        if ($this->session->userdata('vista')) {
        } else {
            redirect('/logincontroller', 'location');
        }
        $this->load->helper('url');
        //Cargar la sesion y se obtiene el id del usuario
        $datos_usuario = $this->session->all_userdata();
        $usuario       = $this->usuariomodel->obtenId($datos_usuario['username']);
        
        $this->proyecto->updateExterno($data['idProyectoExterno'], $usuario);
        sleep(3);
        redirect('proyectoExterno', 'location');
    }
    function rechazaProyecto()
    {
        $data = $this->input->post();
        $this->load->model('proyecto');
        $this->load->model('usuariomodel');
        $this->load->library('session');
        if ($this->session->userdata('vista')) {
        } else {
            redirect('/logincontroller', 'location');
        }
        $this->load->helper('url');
        //Cargar la sesion y se obtiene el id del usuario
        $datos_usuario = $this->session->all_userdata();
        $usuario       = $this->usuariomodel->obtenId($datos_usuario['username']);
        
        $this->proyecto->updateExternoR($data['idProyectoExternoR'], $usuario);
        sleep(3);
        redirect('proyectoExterno', 'location');
    }
}
?>
