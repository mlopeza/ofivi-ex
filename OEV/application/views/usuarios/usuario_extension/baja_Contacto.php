<?php
		echo "<select id ='sgrupo'>";	
		foreach($grupos as $row){
			echo "<option value=".$row->idGrupo."> ".$row->nombre."</option>";
		}
		echo "</select>";
		echo "<select  id = 'sempresa'><option></option></select>";
?>
<table  class="table table-bordered table-striped pull-left" id="example" >
                                                            <thead>
                                                                <tr>
                                                                    <th>Nombre</th>
                                                                    <th>Puesto</th>
                                                                    <th>Departamento</th>
                                                                    <th>Activo</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
															<?php // foreach($data->result() as $row){ ?>
                                                                <tr>
                                                                  <!--  <td name="nombre" value="<?php echo $row->idUsuario; ?>"><?php echo $row->Username; ?></td>	
                                                                    <td name="puesto"><?php echo $row->area; ?></td>
                                                                    <td name="departamento"><?php echo $row->departamento; ?></td>
																						  <td style="text-align:center;">
																						  		<button class="btn btn-primary accept-user">Dar de Baja</button
																						  </td>-->
                                                                </tr>
															<? //}; ?>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <th>Nombre</th>
                                                                    <th>Puesto</th>
                                                                    <th>Departamento</th>
                                                                    <th>Activo</th>
                                                                </tr>
                                                            </tfoot>
                                                        </table>