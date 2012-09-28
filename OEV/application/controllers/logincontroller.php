<?php
class Logincontroller extends CI_Controller {

	public function index()
	{
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->view('header');
		$this->load->view('login');
		$this->load->view('footer');	
	}
	public function signup()
	{
		$this->load->model('loginmodel');
	}	
	public function login()
	{
			
	}
}
?>