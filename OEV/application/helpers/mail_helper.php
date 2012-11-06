<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('enviaMail'))
{
    function enviaMail($o,$destinatario,$asunto,$mensaje)
    {
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_port' => 465,
            'smtp_user' => 'ofivex@gmail.com',
            'smtp_pass' => 'oficinadeextensionvirtual2012',
        );
        $o->load->library('email', $config);
        $o->email->set_newline("\r\n");

        $o->email->from('ofivex@gmail.com', 'Oficina de Extensión Virtual');
        $o->email->to($destinatario);

        $o->email->subject($asunto);
        $o->email->message($mensaje);
        $o->email->send();
    }   
}

if ( ! function_exists('mensajeRegistro'))
{
    function mensajeRegistro($nombre,$usuario,$password)
    {
        $mensaje = "Hola ".$nombre." te has registrado en OFIVEX. \n\n".
                   "En cuanto seas aceptado se te notificará por correo.\n".
                   "Tus datos de registro son:\n".
                   "Usuario:".$usuario."\n".
                   "Contraseña:".$password."\n";
        return $mensaje;
    }   
}

if ( ! function_exists('mensajeAlta'))
{
    function mensajeAlta($usuario)
    {
        $situacion=$usuario->Usuario_Aceptado == "r"?"rechazada":"aceptada";

        $mensaje = "Hola ".$usuario->Nombre." ".$usuario->ApellidoP.".\n".
                   "Tu cuenta ha sido ".$situacion." en OFIVEX.\n";
            if($situacion == "rechazada"){
                $mensaje=$mensaje."Para cualquier duda o aclaración, puedes dirigirte al administrador del sistema.";
            }else{
                $mensaje=$mensaje."Tu usuario de acceso es:".$usuario->Username."\n Y tu contraseña ya fue proporcionada en el correo anterior.";
            }
        return $mensaje;
    }   
}


?>
