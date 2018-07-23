<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lista_post extends CI_Controller
{
    function __construct()
	{
		parent::__construct();
    }
    
    function index() {
        if(!$this->session->userdata('username'))
		{
			redirect(base_url().'admin');
		}

		$data["titulo"] = "Lista de publicaciones";
		$data["posts"] =  $this->consultas->get_list_post();
		$data["user"] = $this->session->userdata('username');
		$data["onLoad"] = '';

		$this->load->view("head",$data);
		//$this->load->view("post/list_post_header");
		$this->load->view("nav");
		$this->load->view("post/list_post"); 	
		$this->load->view("footer");
    }
}