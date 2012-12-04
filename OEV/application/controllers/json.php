<?php
class Json extends CI_Controller {
	
	public function campus(){
		$this->load->model('campus');
		$result = $this->campus->selectN();		
		echo json_encode($result);
	}
	public function escuela(){
		$this->load->model('escuela');
		$result = $this->escuela->selectN(/*Aquí va el parametro del id del campus*/);		
		echo json_encode($result);
	}
	public function departamento(){
		$this->load->model('departamento');
		$result = $this->departamento->selectN(/*Aquí va el parametro del id del Departamento*/);		
		echo json_encode($result);
	}
}
?>