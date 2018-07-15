<?php
class Main extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		if(!$this->session->userdata('username'))
		{
			redirect(base_url().'admin');
		}
		$usuario=$this->session->userdata('username');
		$data= array('titulo'=> 'Bienvenido');
		$this->load->view("head",$data);
		$onload='';
		$data= array('user'=> $usuario,'onLoad'=>$onload);
		$this->load->view("nav", $data);
		$this->load->view("main");
		$this->load->view("footer");
	}	
}
?>