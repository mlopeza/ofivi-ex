<?php
class Informacion extends CI_Controller
{
    public function index()
    {
    }
    public function getInfoProfesor()
    {
        $data = $this->input->post();
        //echo var_dump($data);
        if ($data['idUsuario'] == null) {
            //Si no vienen Datos, regresa error
            $mensaje = array(
                'response' => 'false',
                'mensaje' => 'No se ha seleccionado ningúna empresa.'
            );
            echo json_encode($mensaje);
        } else {
            //Regresa las empresas del Grupo
            $this->load->model('usuariomodel');
            $query     = $this->usuariomodel->regresaInformacion($data['idUsuario']);
            $resultado = '<table width="200" border="1" class="table table-bordered">
  <tr>
    <th scope="row">Nombre</th>
    <td>' . $query[0]->nombre . '</td>
  </tr>
  <tr>
    <th scope="row">Email</th>
    <td>' . $query[0]->email . '</td>
  </tr>';
            $resultado = $resultado . '
  <tr>
    <th scope="row">Departamento</th>
    <td>' . $query[0]->departamento . '</td>
  </tr>
    <tr>
    <th scope="row">Escuela</th>
    <td>' . $query[0]->escuela . '</td>
  </tr>
    <tr>
    <th scope="row">Campus</th>
    <td>' . $query[0]->campus . '</td>
  </tr>
</table>
<table width="200" border="1" class="table table-bordered">
<tr>
<th> Descripci&oacute;n</th>
<th> Telefono</th>
<th> Extension</th>
<th> Sub-Extensi&oacute;n</th>
';
            
            $query2 = $this->usuariomodel->regresaTelefono($data['idUsuario']);
            foreach ($query2 as $row) {
                $resultado = $resultado . '  
  <tr>
  	<td>' . $row->descripcion . '</td>
    <td>' . $row->telefono . '</td>';
                $resultado = $resultado . '<td>';
                if ($row->extension != null) {
                    $resultado = $resultado . $row->extension . '</td><td>';
                } else {
                    $resultado = $resultado . "--</td><td>";
                }
                
                if ($row->subextension != null) {
                    $resultado = $resultado . $row->subextension . '</td>';
                } else {
                    $resultado = $resultado . "--</td>";
                }
                $resultado = $resultado . '</tr>';
            }
            $resultado = $resultado . "</table>";
            //Se envia el resultado			
            $mensaje   = array(
                'response' => 'true',
                'mensaje' => $resultado,
                'query' => $query
            );
            echo json_encode($mensaje);
        }
    }
    public function getInfoContacto()
    {
        $data = $this->input->post();
        //echo var_dump($data);
        if ($data['idContacto'] == null) {
            //Si no vienen Datos, regresa error
            $mensaje = array(
                'response' => 'false',
                'mensaje' => 'No se ha seleccionado ningúna empresa.'
            );
            echo json_encode($mensaje);
        } else {
            //Regresa las empresas del Grupo
            $this->load->model('contacto_model');
            $query     = $this->contacto_model->regresaInformacion($data['idContacto']);
            $resultado = '<table width="200" border="1" class="table table-bordered">
  <tr>
    <th scope="row">Nombre</th>
    <td>' . $query[0]->nombre . '</td>
  </tr>
  <tr>
    <th scope="row">Email</th>
    <td>' . $query[0]->email . '</td>
  </tr>
  <tr>
    <th scope="row">Puesto</th>
    <td>' . $query[0]->puesto . '</td>
  </tr>
  <tr>
    <th scope="row">Departamento</th>
    <td>' . $query[0]->departamento . '</td>
  </tr>
  <tr>
    <th scope="row">Empresa</th>
    <td>' . $query[0]->empresa . '</td>
  </tr>
    <tr>
    <th scope="row">Grupo</th>
    <td>' . $query[0]->grupo . '</td>
  </tr>
</table>
<table width="200" border="1" class="table table-bordered">
<tr>
<th> Descripci&oacute;n</th>
<th> Telefono</th>
<th> Extension</th>
<th> Sub-Extensi&oacute;n</th>
';
            
            $query2 = $this->contacto_model->regresaTelefono($data['idContacto']);
            foreach ($query2 as $row) {
                $resultado = $resultado . '  
  <tr>
  	<td>' . $row->descripcion . '</td>
    <td>' . $row->telefono . '</td>';
                $resultado = $resultado . '<td>';
                if ($row->extension != null) {
                    $resultado = $resultado . $row->extension . '</td><td>';
                } else {
                    $resultado = $resultado . "--</td><td>";
                }
                
                if ($row->subextension != null) {
                    $resultado = $resultado . $row->subextension . '</td>';
                } else {
                    $resultado = $resultado . "--</td>";
                }
                $resultado = $resultado . '</tr>';
            }
            $resultado = $resultado . "</table>";
            //Se envia el resultado			
            $mensaje   = array(
                'response' => 'true',
                'mensaje' => $resultado,
                'query' => $query
            );
            echo json_encode($mensaje);
        }
    }
    
}
?>
