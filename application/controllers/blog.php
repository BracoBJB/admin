<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		
	}

	public function nueva_entrada()
	{
		
        if(!$this->session->userdata('username'))
		{
			redirect(base_url().'admin');
		}
		$usuario=$this->session->userdata('username');
		$data["user"] = $usuario;

        $data["titulo"] = "Crear entrada";
        $data["header_links"] = "new_post_header";
		$data["script"] = "new_post_script";
		
		$consulta = $this->consultas->consulta_SQL("SELECT CONCAT(nombre,' ', apellido_p,' ', apellido_m) as name,cod_docente FROM docente WHERE activo = TRUE");
		if(!is_null($consulta)) {
			$data["docentes"] = $consulta->result_array();
		}

        $this->load->view("head",$data);
        $this->load->view("nav");
        $this->load->view('new_post'); 	
		$this->load->view("footer");

	}
	public function lista()
	{
		if(!$this->session->userdata('username'))
		{
			redirect(base_url().'admin');
		}
		$usuario=$this->session->userdata('username');
		$data["user"] = $usuario;

		$data["titulo"] = "Lista de entradas";

		$this->load->view("head",$data);
		$this->load->view("nav");
		$this->load->view('list_post'); 	
		$this->load->view("footer");
	}
}