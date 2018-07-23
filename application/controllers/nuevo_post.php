<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nuevo_post extends CI_Controller
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
		
		$consulta = $this->consultas->consulta_SQL("SELECT CONCAT(nombre,' ', apellido_p,' ', 		apellido_m) as name,cod_docente FROM docente WHERE activo = TRUE");
		if(!is_null($consulta)) {
			$data["docentes"] = $consulta->result_array();
		}

		$p_todos = $this->consultas->get_id_poblacion("Todos");
		$p_grup = $this->consultas->get_id_poblacion("Grupo");
		$select_poblacion= $this->input->post('select_poblacion');
		$carrera = $this->input->post('carrera');
	
		if(!is_null($select_poblacion) && $select_poblacion != $p_todos) {
			if($select_poblacion == $p_grup) {
				$data["g_sel"] = $this->consultas->get_grupos_carrera($carrera)->result();
				$data["label_poblacion_sel"] ="Seleccione Grupo(s)";
			} else {
				$data["s_sel"] = $this->consultas->get_semestres_carrera($carrera)->result();
				$data["label_poblacion_sel"] ="Seleccione semestre(s)";
			}
		} else {
			$data["label_poblacion_sel"] ="Selecciono todos los estudiantes";
		}
		
		$data["titulo"] = "Crear articulo";
		//$data["script"] = "new_post_script";
		$data["carreras"] = $this->consultas->get_all_carreras();
		$data["tipo_poblacion"] = $this->consultas->get_poblacion();
		$data["user"] = $this->session->userdata('username');
		$data["onLoad"] = '';

        $this->load->view("head",$data);
        $this->load->view("post/new_post_header");
        $this->load->view("nav");
        $this->load->view("post/new_post"); 	
		$this->load->view("footer");
    }

    public function registrar() {
        
		$rules = array(
			array(
				'field' => 'titulo',
				'label' => 'Titulo del Articulo',
				'rules' => 'trim|required|strip_tags|callback_check_enlace'
			)
			,array(
				'field' => 'tema',
				'label' => 'Tema',
				'rules' => 'trim|required|strip_tags'
			)
			,array(
				'field' => 'docente[]',
				'label' => 'Autor',
				'rules' => 'callback_multiple_autor'
			)
			,array(
				'field' => 'descripcion',
				'label' => 'Descripcion',
				'rules' => 'trim|required|strip_tags'
			)
		);

		$p_todos = $this->consultas->get_id_poblacion("Todos");
		$p_grup = $this->consultas->get_id_poblacion("Grupo");

		$select_poblacion= $this->input->post('select_poblacion');
		$carrera = $this->input->post('carrera');
	
		if(!is_null($select_poblacion) && $select_poblacion != $p_todos) {
			if($select_poblacion == $p_grup) {
				array_push($rules, array(
					'field' => 'grupo_sel[]',
					'label' => 'Grupo',
					'rules' => 'callback_multiple_grupo'
				));
			} else {
				array_push($rules, array(
					'field' => 'grupo_sel[]',
					'label' => 'Semestre',
					'rules' => 'callback_multiple_semestre'
				));
			}
		}
		
		$this->form_validation->set_rules($rules);
		$this->form_validation->set_error_delimiters('<span class="badge badge-pill badge-danger">Error</span>','<br>');

		if($this->form_validation->run() === FALSE) {
			$this->index();
		} else {

			$tiene_comentario = $this->input->post('coment') === "Permitir Comentarios";
			$titulo = $this->input->post('titulo');
			$enlace = url_title(convert_accented_characters($titulo),'-',TRUE);

			$data = array(
				'id_usuario' => $this->session->userdata('username'),
				'carrera' => $this->input->post('carrera'),
				'titulo' => $titulo,
				'tema' => $this->input->post('tema'),
				'contenido' => $this->input->post('editor1'),
				'etiquetas' => '',
				'enlace' => $enlace,
				'fecha' => date('Y-m-d H:i:s'),
				'activo' => TRUE,
				'permite_comentario' => $tiene_comentario,
				'descripcion' => $this->input->post('descripcion')
			);
			$is_inserted = $this->consultas->insert_table('est_post',$data);
			//$sql = $this->db->set($data)->get_compiled_insert('entrada');
			//echo $sql;

			if($is_inserted) {
				$id_post =  $this->db->insert_id();

				$arr_autor = $this->input->post('docente[]');
				foreach($arr_autor as $autor) {
					$data = array(
						'id_post' =>$id_post,
						'cod_docente' =>$autor
					);	
					$this->consultas->insert_table('est_post_autor',$data);
				}

				if($select_poblacion != $p_todos) {
					$arr_group = $this->input->post('grupo_sel[]');
					foreach($arr_group as $group) {
						$data = array(
							'id_post' => $id_post,
							'id_poblacion' =>$select_poblacion,
							'item' =>$group
						);
						$this->consultas->insert_table('est_post_poblacion',$data);
					}
				} else {
					$data = array(
						'id_post' => $id_post,
						'id_poblacion' =>$select_poblacion,
						'item' => 'Todos'
					);
					$this->consultas->insert_table('est_post_poblacion',$data);
				}

				redirect(base_url() . "nuevo_post/preview/".$id_post);
			}
		}
	}

	public function preview($id_post = null) {
		if(!$this->session->userdata('username'))
		{
			redirect(base_url().'admin');
		}

		if(isnull($id_post)) {
			redirect(base_url() . "nuevo_post");
		} else {
			$data["titulo"] = "Articulo creato";
			$data["user"] = $this->session->userdata('username');
			$data["onLoad"] = '';

        	$this->load->view("head",$data);
        	$this->load->view("nav");
        	$this->load->view("post/preview_post"); 	
			$this->load->view("footer");
		}
	}
	
	public function get_poblacion_sel()
	{
		$tipo_sel=$_POST['tipo_sel'];
		$carrera=$_POST['carrera'];
		$resultado='';
		if($tipo_sel=='2')
		{
			$get_grupo=$this->consultas->get_semestres_carrera($carrera);
			foreach ($get_grupo ->result() as $fila) {
					$resultado.='<option value="'.$fila->semestre.'" >'.$fila->semestre.'</option>';				
				}
		}
		if($tipo_sel=='3')
		{
			$get_grupo=$this->consultas->get_grupos_carrera($carrera);
			if($get_grupo!=null)
				foreach ($get_grupo ->result() as $fila) {
					$resultado.='<option value="'.$fila->cod_grupo.'" >'.$fila->cod_grupo.'</option>';				
				}
		}
		echo $resultado;
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

	public function multiple_autor($array)
	{
		$arr_course = $this->input->post('docente[]');

		if(empty($arr_course)) {
			$this->form_validation->set_message("multiple_autor",'Debe seleccionar por lo menos un Autor');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	public function multiple_semestre($array)
	{
		$arr_course = $this->input->post('grupo_sel[]');

		if(empty($arr_course)) {
			$this->form_validation->set_message("multiple_semestre",'Debe seleccionar por lo menos un Semestre');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	public function multiple_grupo($array)
	{
		$arr_course = $this->input->post('grupo_sel[]');

		if(empty($arr_course)) {
			$this->form_validation->set_message("multiple_grupo",'Debe seleccionar por lo menos un Grupo');
			return FALSE;
		} else {
			return TRUE;
		}
	}
}