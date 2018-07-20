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
		$data["user"] = $this->session->userdata('username');

        $data["titulo"] = "Crear entrada";
        $data["header_links"] = "new_post_header";
		$data["script"] = "new_post_script";
		
		$consulta = $this->consultas->consulta_SQL("SELECT CONCAT(nombre,' ', apellido_p,' ', apellido_m) as name,cod_docente FROM docente WHERE activo = TRUE");
		if(!is_null($consulta)) {
			$data["docentes"] = $consulta->result_array();
		}
		$semestres = $this->consultas->consulta_SQL("select semestre from semestre group by semestre order by semestre asc");
		if(!is_null($semestres)) {
			$data["semestres"] = $semestres->result_array();
		}
		//$data["user"] = $usuario;
		$data["onLoad"] = '';

        $this->load->view("head",$data);
        $this->load->view("nav");
        $this->load->view("new_post"); 	
		$this->load->view("footer");

	}

	public function validar() {

		if(!$this->session->userdata('username'))
		{
			redirect(base_url().'admin');
		}

        $data["titulo"] = "Crear entrada";
        $data["header_links"] = "new_post_header";
		$data["script"] = "new_post_script";
		
		$consulta = $this->consultas->consulta_SQL("SELECT CONCAT(nombre,' ', apellido_p,' ', apellido_m) as name,cod_docente FROM docente WHERE activo = TRUE");
		if(!is_null($consulta)) {
			$data["docentes"] = $consulta->result_array();
		}
		$semestres = $this->consultas->consulta_SQL("select semestre from semestre group by semestre order by semestre asc");
		if(!is_null($semestres)) {
			$data["semestres"] = $semestres->result_array();
		}

		/*
		$this->form_validation->set_rules('titulo', 'Titulo del Post','trim|required|strip_tags|xss_clean');
		$this->form_validation->set_rules('tema', 'Tema','required');
		$this->form_validation->set_rules('docente', 'Nombre de docente','required');
		$this->form_validation->set_rules('semestre', 'Semestre','required');

		
		$this->form_validation->set_error_delimiters('<span class="badge badge-pill badge-danger">Error</span>','<br>');
		*/

		if($this->form_validation->run() === FALSE) {
			$this->load->view("head",$data);
        	$this->load->view("nav");
        	$this->load->view('new_post'); 	
			$this->load->view("footer");
		} else {
			$titulo = $this->input->post('titulo');
			$tiene_comentario = $this->input->post('coment') === "Permitir Comentarios";

			$enlace = url_title(convert_accented_characters($titulo),'-',TRUE);
			$fecha = date('Y-m-d H:i:s');
			$data = array(
				'id_usuario' => $this->session->userdata('username'),
				'cod_docente' => $this->input->post('docente'),
				'titulo' => $titulo,
				'contenido' => $this->input->post('editor1'),
				'semestre' => $this->input->post('semestre'),
				'tema' => $this->input->post('tema'),
				'enlace' => $enlace,
				'fecha' => $fecha,
				'borrador' => FALSE,
				'comentarios' => $tiene_comentario
			);
			$this->consultas->insertArray('entrada',$data);
			//$sql = $this->db->set($data)->get_compiled_insert('entrada');
			//echo $sql;

			$this->load->view("head",$data);
        	$this->load->view("nav");
        	$this->load->view("preview_post"); 	
			$this->load->view("footer");
		}
	}

	public function editar_entrada($id_entrada) {
		$this->load->view("head",$data);
		$this->load->view("nav");
		echo $id_entrada;
		$this->load->view("footer");
	}

	public function data_submitted() {
		$data = array(
			'user_name' => $this->input->post('u_name'),
			'user_email_id' => $this->input->post('u_email')
		);
		
		// Show submitted data on view page again.
		$this->load->view("view_form", $data);
	}

	
     
    public function custom_message()
    {
        // basic required field with trim prepping applied
        $this->form_validation->set_rules('alphabets_text_field', 'Text Field Five', 'required|alpha',
            array('required'=>'Please enter Text Field Five!','alpha'=>'Only alphabets please!'));
         
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('validate_form');
        }
        else
        {
            // load success template...
            echo "It's all Good!";
        }
    }
		
	public function lista()
	{
		if(!$this->session->userdata('username'))
		{
			redirect(base_url().'admin');
		}

		$data["titulo"] = "Lista de entradas";
		$data["header_links"] = "list_post_header";
		$data["script"] = "list_post_script";
		$data["entradas"] =  $this->consultas->get_list_post();
		$data["user"] = $this->session->userdata('username');
		$data["onLoad"] = '';

		$this->load->view("head",$data);
		$this->load->view("nav");
		$this->load->view("list_post"); 	
		$this->load->view("footer");
	}

	public function check_enlace($titulo) {
		$enlace = url_title(convert_accented_characters($titulo),'-',TRUE);
		$result = $this->consultas->exist_enlace($enlace);
		if($result) {
			$this->form_validation->set_message('check_enlace','El titulo '.$titulo.' ya esta registrado.') ;
			return FALSE;
		} else {
			return TRUE;
		}
	}
}