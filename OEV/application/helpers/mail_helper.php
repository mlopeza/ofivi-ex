<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('enviaMail'))
{
    function enviaMail($o,$destinatario,$asunto,$mensaje)
    {
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_port' => 465,
            'mailtype'  => 'html', 
            'smtp_user' => 'ofivex@gmail.com',
            'smtp_pass' => 'oficinadeextensionvirtual2012',
        );
        $o->load->library('email', $config);
        $o->email->set_newline("\r\n");

        $o->email->from('ofivex@gmail.com', 'Oficina de Extensión Virtual');
        $o->email->to($destinatario);

        $o->email->subject($asunto);
        $o->email->message($mensaje);
        return $o->email->send();
        
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

if ( ! function_exists('mensajeRecordatorio1'))
{
    function mensajeRecordatorio1($r)
    {
        
        $mensaje = " Hola <strong>".$r[0]->Nombre." ".$r[0]->ApellidoP."</strong> tus actividades que empezaran dentro de la proxima hora son:\n\n";
        
        //Crea lso recordatorios
        foreach($r as $rec){
            $mensaje = $mensaje."<strong>Nombre :</strong>".$rec->Subject."\n".
                        "<strong>Inicio:</strong>".$rec->StartTime."\n".
                        "<strong>Fin:</strong>".$rec->EndTime."\n".
                        ($rec->Location != ""?"<strong>Lugar:</strong>".$rec->Location."\n":"").
                        ($rec->Description != ""?"<strong>Descripcion:</strong>".$rec->Description."\n":"").
                        ($rec->isAllDayEvent == "1"?"<strong><em>Todo el día</em></strong>":"")."\n";
        }
        return $mensaje;
    }   
}
if ( ! function_exists('mensajeContrasena'))
{
    function mensajeContrasena($r,$password)
    {
        
        $mensaje = " Hola <strong>".$r[0]->Nombre." ".$r[0]->ApellidoP."</strong> se te mando el correo con motivo de avisarte que la contraseña. Tu nueva contraseña será: <br/> <br/>";
        
        //Crea lso recordatorios
        
        $mensaje = $mensaje."<strong>Contraseña :</strong>".$password."\n";
        
        return $mensaje;
    }   
}
?>
