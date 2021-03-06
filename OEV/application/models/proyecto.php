<?php
class Proyecto extends CI_Model
{
    var $nombre = '';
    var $descripcionUsuario = '';
    var $descripcionAEV = '';
    var $Proyecto_Activo = 1;
    var $idEmpresa;
    var $iniciadoPor;
    
    function getNombre()
    {
        return $this->nombre;
    }
    
    function getDescripcionUsuario()
    {
        return $this->descripcionUsuario;
    }
    
    function getDescripcionAEV()
    {
        return $this->descripcionAEV;
    }
    
    function getProyecto_Activo()
    {
        return $this->Proyecto_Activo;
    }
    
    function getIdEmpresa()
    {
        return $this->idEmpresa;
    }
    
    function getIniciadoPor()
    {
        return $this->iniciadoPor;
    }
    
    function setIdEmpresa($param)
    {
        $this->idEmpresa = $param;
    }
    
    function setIniciadoPor($param)
    {
        $this->iniciadoPor = $param;
    }
    
    function setNombre()
    {
        $this->nombre = $this->input->post('nombre_proyecto');
    }
    
    function setDescripcionAEV()
    {
        $this->descripcionAEV = $this->input->post('descripcionAEV');
    }
    
    function setDescripcionUsuario()
    {
        $this->descripcionUsuario = $this->input->post('descripcionUsuario');
    }
    
    function setProyecto_Activo()
    {
        $this->Proyecto_Activo = $this->input->post('Proyecto_Activo');
    }
    
    function __construct()
    {
        $this->load->database();
        parent::__construct();
    }
    
    function alta()
    {
        $this->load->database();
        $proyecto = array(
            'nombre' => $this->input->post('nombre_proyecto'),
            'descripcionUsuario' => $this->input->post('descripcionUsuario'),
            'descripcionAEV' => $this->input->post('descripcionAEV')
        );
        $this->db->insert('Proyecto', $proyecto);
    }
    
    //Funcion para obtener el ultimo registro.
    function ultimo()
    {
        $this->load->database();
        $query = $this->db->query('SELECT LAST_INSERT_ID()');
        $row   = $query->row_array();
        return $row['LAST_INSERT_ID()'];
    }
    
    
    function altaProyecto($idEmpresa, $Nombre, $descripcionU, $descripcionAEV, $iniciadoPor, $idProyecto)
    {
        $this->load->database();
        //Descripciones de Usuario, preparando para guardarse en BLOB
        $d1   = mysql_real_escape_string($descripcionU);
        $d2   = mysql_real_escape_string($descripcionAEV);
        $data = array(
            'nombre' => $Nombre,
            'idEmpresa' => $idEmpresa,
            'descripcionUsuario' => $d1,
            'descripcionAEV' => $d2,
            'Proyecto_Activo' => 1,
            'iniciadoPor' => $iniciadoPor
        );
        $id   = -100;
        if ($idProyecto >= 0) {
            $this->db->where('idProyecto', $idProyecto);
            $this->db->update('Proyecto', $data);
            $id = $idProyecto;
        } else {
            $this->db->insert('Proyecto', $data);
            $idx = $this->db->query("SELECT LAST_INSERT_ID() as idProyecto;")->result();
            $id  = $idx[0]->idProyecto;
        }
        //Regresa el id del Proyecto Recien Creado
        return $id;
    }
    
    //asigna un proyecto a sus categorias
    function asignaCategorias($idProyecto, $categorias)
    {
        for ($i = 0; $i < sizeof($categorias); $i++) {
            $categorias[$i]['idProyecto'] = $idProyecto;
        }
        $this->db->where('idProyecto', $idProyecto);
        $this->db->delete('Categoria_Proyecto');
        if (sizeof($categorias) != 0)
            $this->db->insert_batch('Categoria_Proyecto', $categorias);
    }
    
    
    function getCategorias($idProyecto)
    {
        $this->db->select('idCategoria');
        $this->db->where('idProyecto', $idProyecto);
        return $this->db->get('Categoria_Proyecto')->result();
    }
    
    //Agrega los contactos al proyecto
    function agregaContactos($viejos, $nuevos, $idProyecto)
    {
        $data = array();
        //Obtiene los datos de los contactos viejos
        
        foreach ($viejos as $c) {
            $data[] = array(
                'idProyecto' => $idProyecto,
                'idContacto' => $c['id']
            );
        }
        
        foreach ($nuevos as $c) {
            $data[] = array(
                'idProyecto' => $idProyecto,
                'idContacto' => $c
            );
        }
        if (sizeof($data) > 0) {
            $this->db->trans_start();
            $this->db->where('idProyecto', $idProyecto);
            $this->db->delete('Contacto_Proyecto');
            $this->db->insert_batch('Contacto_Proyecto', $data);
            $this->db->trans_complete();
        }
    }
    //Función findAll par regresar todos los datos de la tabla.
    function findAll()
    {
        $this->load->database();
        $query = $this->db->get('proyecto');
        return $query->result();
    }
    
    function findPA($empresa, $activo)
    {
        $this->load->database();
        $query = $this->db->query('SELECT idProyecto, nombre
										   From Proyecto
										   WHERE idEmpresa = ' . $empresa . ' AND
										   Proyecto_Activo = ' . $activo);
        return $query->result();
    }
    function findPAP($empresa, $activo, $idUsuario)
    {
        $this->load->database();
        $query = $this->db->query('SELECT Proyecto.idProyecto, Proyecto.nombre
										   From Proyecto, usuario_proyecto
										   WHERE idEmpresa = ' . $empresa . ' AND
										   Proyecto.idProyecto = usuario_proyecto.idProyecto AND													   											usuario_proyecto.idUsuario = ' . $idUsuario . ' AND																			
										   Proyecto_Activo = ' . $activo);
        return $query->result();
    }
    function findPAU($empresa, $activo, $idUsuario)
    {
        $this->load->database();
        $query = $this->db->query('SELECT idProyecto, nombre
										   From Proyecto
										   WHERE idEmpresa = ' . $empresa . ' AND
										   iniciadoPor = ' . $idUsuario . '   AND
										   Proyecto_Activo = ' . $activo);
        return $query->result();
    }
    
    /*
     * Regresa un arreglo con todos los proyectos en los que pertenece un usuario
     */
    function selectProyectos($usuario)
    {
        $this->load->database();
        $this->db->select('p.idProyecto, p.nombre');
        $this->db->from('proyecto p');
        $this->db->join('usuario_proyecto up', 'up.idProyecto = p.idProyecto AND up.idUsuario = ' . $usuario . '', 'inner');
        $query = $this->db->get();
        return $query->result();
    }
    
    /*
     * Regresa un arreglo con todos los proyectos en los que pertenece un usuario y que son aceptados
     */
    function selectProyectosAceptados($usuario)
    {
        $this->load->database();
        $this->db->select('p.idProyecto, p.nombre');
        $this->db->from('proyecto p');
        $this->db->join('usuario_proyecto up', 'up.idProyecto = p.idProyecto AND up.acepto = 1 AND up.idUsuario = ' . $usuario . '', 'inner');
        $query = $this->db->get();
        return $query->result();
    }
    
    
    
    /*
     * Funcion que regresa los contactos del cierto proyecto.
     */
    function getCA($idProyecto)
    {
        $this->load->database();
        $query = $this->db->query(' Select c.idContacto, CONCAT(c.Nombre," ", c.ApellidoP," ", c.ApellidoM) as nombre
									FROM contacto as c, contacto_proyecto as cp
									WHERE  cp.idProyecto = ' . $idProyecto . ' AND
									cp.idContacto = c.idContacto  ');
        return $query->result();
    }
    
    /*Regresa todos los proyectos que inicio un usuario
    idUsuario    El id del Usuario
    activo       Si el proyecto est activo o no.
    */
    function getProyectosIniciados($idUsuario, $activo)
    {
        $this->load->database();
        return $this->db->query("
                                SELECT idProyecto,p.nombre as Proyecto,e.nombre as Empresa,g.nombre as Grupo
                                FROM Proyecto p
                                INNER JOIN Empresa e ON e.idEmpresa = p.idEmpresa
                                INNER JOIN Grupo g ON g.idGrupo = e.idGrupo
                                WHERE iniciadoPor='" . $idUsuario . "' AND Proyecto_Activo = " . $activo . "
                                ORDER BY Grupo,Empresa,Proyecto
                                ")->result();
    }
    
    
    function getAsignados($idProyecto)
    {
        $this->load->database();
        $this->db->select('up.tiempo_solicitud,up.Razon,up.sugerencia,up.tiempo_respuesta,up.acepto,u.idUsuario, u.Nombre, u.ApellidoP, u.ApellidoM, u.email, u.Tipo_Usuario, d.nombre as Departamento,c.Nombre as Campus, e.Nombre as Escuela');
        $this->db->from('Usuario u');
        $this->db->join('Departamento d', 'd.idDepartamento = u.idDepartamento', 'inner');
        $this->db->join('Escuela e', 'e.idEscuela = d.idEscuela', 'inner');
        $this->db->join('Campus c', 'c.idCampus = e.idCampus', 'inner');
        $this->db->join('Usuario_Proyecto up', 'up.idUsuario = u.idUsuario AND up.activa = 1 AND up.idProyecto=' . $idProyecto, 'inner');
        $this->db->order_by("Campus", "asc");
        $this->db->order_by("Escuela", "asc");
        $this->db->order_by("Departamento", "asc");
        return $this->db->get()->result();
    }
    
    function setProfesor($data)
    {
        $this->load->database();
        $this->db->where($data);
        $query = $this->db->get('Usuario_Proyecto')->result();
        if (sizeof($query) != 0) {
            $this->db->delete('Usuario_Proyecto', $data);
            $this->db->insert('Usuario_Proyecto', $data);
            return 0;
        } else {
            $this->db->insert('Usuario_Proyecto', $data);
            return 1;
        }
    }
    
    //Pone la asignacion como inactiva
    function eliminaAsignacion($data)
    {
        $this->load->database();
        $this->db->where($data);
        $this->db->update('Usuario_Proyecto', array(
            'activa' => 0
        ));
    }
    
    function getProyectosAsignados($idUsuario, $activo)
    {
        $this->load->database();
        return $this->db->query("
                                SELECT up.idProyecto,p.nombre as Proyecto,e.nombre as Empresa,g.nombre as Grupo
                                FROM Usuario_Proyecto up
                                INNER JOIN Proyecto p ON up.idProyecto = p.idProyecto
                                INNER JOIN Empresa e ON e.idEmpresa = p.idEmpresa
                                INNER JOIN Grupo g ON g.idGrupo = e.idGrupo
                                WHERE up.idUsuario=" . $idUsuario . " AND up.activa = " . $activo . " AND up.acepto = 0
                                ORDER BY Grupo,Empresa,Proyecto
                                ")->result();
    }
    
    function getDescripciones($idProyecto)
    {
        $this->load->database();
        return $this->db->query("
                                SELECT descripcionUsuario as cliente,descripcionAEV as usuario
                                FROM Proyecto
                                WHERE idProyecto=" . $idProyecto . " AND Proyecto_Activo = 1
                                ")->result();
        
    }
    
    function setRespuesta($idProyecto, $data)
    {
        $this->load->database();
        $this->db->trans_start();
        $this->db->where(array(
            'idProyecto' => $idProyecto,
            'idUsuario' => $data['idUsuario']
        ));
        $this->db->update('Usuario_Proyecto', $data);
        if ($data['acepto'] == 1) {
            $this->asignaEstado($idProyecto, $data['idUsuario'], "Aceptado");
            $this->db->where(array(
                'idProyecto' => $idProyecto
            ));
            $this->db->where(array(
                'idUsuario <>' => $data['idUsuario']
            ));
            $this->db->update('Usuario_Proyecto', array(
                'activa' => 0
            ));
        }
        $this->db->trans_complete();
    }
    
    /*
     *
     *
     */
    function getUA($idProyecto)
    {
        $this->load->database();
        $query = $this->db->query(' Select c.idUsuario, CONCAT(c.Nombre, " ", c.ApellidoP," ", c.ApellidoM) as nombre
									FROM usuario as c, usuario_proyecto as cp, proyecto as p
									WHERE p.idProyecto = cp.idProyecto AND
									cp.idUsuario = c.idUsuario AND
									p.idProyecto = ' . $idProyecto . '
									UNION DISTINCT
									Select u.idUsuario, CONCAT(u.Nombre, " ",u.ApellidoP," ", u.ApellidoM) as nombre
									FROM usuario as u, proyecto as p
									WHERE p.idProyecto = ' . $idProyecto . ' AND
									u.idUsuario = p.iniciadoPor');
        return $query->result();
    }
    
    
    
    
    function getCATP($idProyecto)
    {
        $this->load->database();
        $query = $this->db->query(' Select DISTINCT c.idCategoria,c.idSupraCategoria,c.Categoria
									From categoria as c, categoria_proyecto as cp
									Where ' . $idProyecto . ' = cp.idProyecto AND
									cp.idCategoria = c.idCategoria');
        return $query->result();
    }
    
    function getSCATP($idProyecto)
    {
        $this->load->database();
        $query = $this->db->query(' Select DISTINCT sc.idSupraCategoria,sc.Nombre
									From categoria as c, categoria_proyecto as cp, supracategoria as sc
									Where ' . $idProyecto . ' = cp.idProyecto AND
									cp.idCategoria = c.idCategoria AND
									sc.idSupraCategoria = c.idSupraCategoria ');
        return $query->result();
    }
    
    function getEA($idProyecto)
    {
        $this->load->database();
        $query = $this->db->query(' Select e.idEstado, e.tiempoActualizacion, e.Estado, u.Nombre, u.ApellidoP, u.ApellidoM
									FROM estado as e, proyecto as p, usuario as u
									WHERE p.idProyecto =' . $idProyecto . ' 
										  e.idProyecto = p.idProyecto AND
										  e.idUsuario = u.idUsuario ');
        return $query->result();
    }
    
    /*
     * Modifica si un proyecto esta activo o no
     */
    function modificarActivo($proyecto, $activo)
    {
        $this->load->database();
        $data = array(
            'Proyecto_Activo' => $activo
        );
        $this->db->where('idProyecto', $proyecto);
        $this->db->update('proyecto', $data);
    }
    
    function getProyectosAceptados($idUsuario)
    {
        $this->load->database();
        return $this->db->query("
                                SELECT up.idProyecto,p.nombre as Proyecto,e.nombre as Empresa,g.nombre as Grupo
                                FROM Usuario_Proyecto up
                                INNER JOIN Proyecto p ON up.idProyecto = p.idProyecto
                                INNER JOIN Empresa e ON e.idEmpresa = p.idEmpresa
                                INNER JOIN Grupo g ON g.idGrupo = e.idGrupo
                                WHERE up.idUsuario=" . $idUsuario . " AND up.activa = 1 AND up.acepto = 1
                                ORDER BY Grupo,Empresa,Proyecto
                                ")->result();
    }
    /*
     *	Busca todos los proyectos iniciados por un usuario
     *
     */
    
    function getProyectosUsuario($idUsuario)
    {
        $this->load->database();
        $this->db->select("g.nombre as Grupo,g.idGrupo ,e.nombre as Empresa,e.idEmpresa,p.idProyecto,p.nombre as Proyecto");
        $this->db->from('Proyecto p');
        $this->db->join('Empresa e', 'p.idEmpresa = e.idEmpresa', 'inner');
        $this->db->join('Grupo g', 'g.idGrupo = e.idGrupo', 'inner');
        $this->db->where('p.iniciadoPor', $idUsuario);
        $query = $this->db->get();
        return $query->result();
    }
    
    //Elimina un Proyecto de la base de datos
    function deleteProyecto($idProyecto)
    {
        if (!isset($idProyecto))
            return;
        $this->load->database();
        $this->db->trans_start();
        $this->db->where('idProyecto', $idProyecto);
        $this->db->delete('Contacto_Proyecto');
        $this->db->where('idProyecto', $idProyecto);
        $this->db->delete('Proyecto');
        $this->db->trans_complete();
    }
    
    
    //Regresa un Proyecto
    function getProyecto($idProyecto)
    {
        $this->load->database();
        $this->db->where('idProyecto', $idProyecto);
        $query = $this->db->get('Proyecto');
        return $query->result();
    }
    
    //Regresa los contactos del Proyecto;
    function getContactos($idProyecto)
    {
        $this->load->database();
        $query = $this->db->query('
				SELECT c.idContacto as id, CONCAT (Nombre, " ",ApellidoP," ",ApellidoM," ",email) as name
				From Contacto c
				INNER JOIN Contacto_Proyecto cp ON c.idContacto = cp.idContacto AND cp.idProyecto=' . $idProyecto . ' ');
        return $query->result();
    }
    
    /*
     * Obtiene los proyectos que fueron estan activos y qu eno estan finalizados
     */
    function selectProyectosAceptadosNoFinalizados($usuario)
    {
        $this->load->database();
        $from = '(SELECT p.idProyecto, p.nombre, (
										SELECT e.estado
										FROM estado e
										WHERE e.idProyecto = p.idProyecto
										ORDER BY tiempoActualizacion DESC 
										LIMIT 1
										) as estado
								FROM proyecto p
								INNER JOIN usuario_proyecto up ON up.idProyecto = p.idProyecto
								AND up.acepto =1
								AND up.idUsuario = ' . $usuario . ') p';
        $this->db->select('idProyecto, nombre');
        $this->db->from($from);
        $this->db->where_not_in('estado', 'Finalizado');
        $query = $this->db->get();
        return $query->result();
    }
    
    //Regresa datos acerca del proyecto y a que grupo y empresa pertenece
    function getResumenProyecto($idProyecto)
    {
        $this->load->database();
        $this->db->select('g.nombre as Grupo, e.nombre as Empresa, p.Nombre as Proyecto');
        $this->db->from('Proyecto p');
        $this->db->join('Empresa e', 'p.idEmpresa = e.idEmpresa', 'inner');
        $this->db->join('Grupo g', 'g.idGrupo = e.idGrupo', 'inner');
        $this->db->where('p.idProyecto', $idProyecto);
        $query = $this->db->get()->result();
        return $query[0];
    }
    
    //Pone el estado de iniciado del proyecto
    function iniciaProyecto($idProyecto, $idUsuario)
    {
        $data = array(
            'idProyecto' => $idProyecto,
            'Estado' => 'Inicializado'
        );
        $this->db->where($data);
        $query = $this->db->get('Estado')->result();
        if (sizeof($query) == 0) {
            //Agrega el estado a la base de datos
            $this->db->insert('Estado', array(
                'Estado' => 'Inicializado',
                'idUsuario' => $idUsuario,
                'idProyecto' => $idProyecto
            ));
        }
    }
    
    //Pone el estado en Asignado
    function asignaEstado($idProyecto, $idUsuario, $estado)
    {
        $data = array(
            'idProyecto' => $idProyecto,
            'Estado' => $estado
        );
        $this->db->where($data);
        $query = $this->db->get('Estado')->result();
        if (sizeof($query) == 0) {
            $data['idUsuario'] = $idUsuario;
            //Agrega el estado a la base de datos
            $this->db->insert('Estado', $data);
        }
    }
    
    function altaProyectoExterno($data)
    {
        $this->load->database();
        $this->db->insert('proyecto', $data);
        $idx = $this->db->query("SELECT LAST_INSERT_ID() as idProyecto;")->result();
        $id  = $idx[0]->idProyecto;
        
        //Regresa el id del Proyecto Recien Creado
        return $id;
    }
    
    function selectProyectosExteriores($idUsuario)
    {
        $this->load->database();
        $this->db->where('iniciadoPor', $idUsuario);
        return $this->db->get('proyecto')->result();
    }
    
    function updateExterno($idProy, $usuario)
    {
        $this->load->database();
        
        $data = array(
            'iniciadoPor' => $usuario
        );
        $this->db->where('idProyecto', $idProy);
        
        $this->db->update('proyecto', $data);
    }
    
    function updateExternoR($idProy, $usuario)
    {
        $this->load->database();
        
        $data = array(
            'iniciadoPor' => $usuario,
            'Proyecto_Activo' => 0
        );
        $this->db->where('idProyecto', $idProy);
        
        $this->db->update('proyecto', $data);
    }
}
?>
