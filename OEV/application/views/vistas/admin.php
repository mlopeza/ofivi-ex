<?php
echo $this->session->userdata('username');
foreach ($vista as $permiso){
	echo 'Permiso = '.$permiso;
}
?>