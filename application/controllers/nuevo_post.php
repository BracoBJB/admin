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
				'rules' => 'trim|required|strip_tags|callback_check_enlace_2'
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

			$tiene_comentario = $this->input->post('coment') === "Permite";
			$post_activo = $this->input->post('activo') === "Activo";
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
				'activo' => $post_activo,
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

		if(is_null($id_post)) {
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

	public function preview_modified($id_post = null) {
		if(!$this->session->userdata('username'))
		{
			redirect(base_url().'admin');
		}

		if(is_null($id_post)) {
			redirect(base_url() . "nuevo_post");
		} else {
			$data["titulo"] = "Articulo creato";
			$data["user"] = $this->session->userdata('username');
			$data["onLoad"] = '';

        	$this->load->view("head",$data);
        	$this->load->view("nav");
        	$this->load->view("post/preview_post_modified"); 	
			$this->load->view("footer");
		}
	}

	public function modificar() {
		$id_post = $this->session->flashdata('id_post');
		$rules = array(
			array(
				'field' => 'titulo',
				'label' => 'Titulo del Articulo',
				'rules' => 'trim|required|strip_tags|callback_check_enlace['.$id_post.']'
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
			$this->editar($id_post);
		} else {

			

			$tiene_comentario = $this->input->post('coment') === "Permite";
			$post_activo = $this->input->post('activo') === "Activo";
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
				'activo' => $post_activo,
				'permite_comentario' => $tiene_comentario,
				'descripcion' => $this->input->post('descripcion')
			);
			// update_table($tabla,$data,$where)
			$is_inserted = $this->consultas->update_table('est_post',$data,'id_post='.$id_post);
			//$sql = $this->db->set($data)->get_compiled_insert('entrada');
			//echo $sql;

			if($is_inserted) {
				//$id_post =  $this->db->insert_id();
				$this->consultas->delete_table('est_post_autor','id_post='.$id_post);

				$arr_autor = $this->input->post('docente[]');
				foreach($arr_autor as $autor) {
					$data = array(
						'id_post' =>$id_post,
						'cod_docente' =>$autor
					);	
					$this->consultas->insert_table('est_post_autor',$data);
				}

				$this->consultas->delete_table('est_post_poblacion','id_post='.$id_post);
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

				redirect(base_url() . "nuevo_post/preview_modified/".$id_post);
				
			}
		}
	}

	public function editar($id_post = null) {
		if(!$this->session->userdata('username'))
		{
			redirect(base_url().'admin');
		}
		if(is_null($id_post)) {
			redirect(base_url().'nuevo_post');
		}
		$post = $this->consultas->get_post($id_post);
		if(is_null($post)) {
			redirect(base_url().'nuevo_post');
		}
		
		$consulta = $this->consultas->consulta_SQL("SELECT CONCAT(nombre,' ', apellido_p,' ', 		apellido_m) as name,cod_docente FROM docente WHERE activo = TRUE");
		if(!is_null($consulta)) {
			$data["docentes"] = $consulta->result_array();
		}
		
		$data["titulo"] = "Crear articulo";
		$data["carreras"] = $this->consultas->get_all_carreras();
		$data["tipo_poblacion"] = $this->consultas->get_poblacion();
		$data["user"] = $this->session->userdata('username');
		$data["onLoad"] = '';

		$this->session->set_flashdata('id_post',$id_post);

		$post = $this->consultas->get_post($id_post);
		$data['post'] = $post;
		$data['autores'] = $this->consultas->get_post_autor($id_post);
		$post_poblacion = $this->consultas->get_post_poblacion($id_post);
		$id_poblacion = $post_poblacion->id_poblacion;
		$data['id_poblacion'] = $id_poblacion;
		$data['p_selected'] = $this->consultas->get_items_post($id_post,$id_poblacion);
		//explode(",", $post_poblacion->poblacion_seleccionada);
		$p_todos = $this->consultas->get_id_poblacion("Todos");
		$p_grup = $this->consultas->get_id_poblacion("Grupo");
		
		$select_poblacion = is_null($id_post)?$this->input->post('select_poblacion'):$post_poblacion->id_poblacion; 
		$carrera = is_null($id_post)?$this->input->post('carrera'):$post->carrera;	
		$p_selecionada = $this->consultas->get_poblacion_type($carrera,$id_poblacion);

		if(!is_null($select_poblacion) && $select_poblacion != $p_todos) {
			if(!is_null($p_selecionada)) {
				$data["p_sel"] = $p_selecionada->result();
			}
			$data["label_poblacion_sel"] = $select_poblacion == $p_grup ?"Seleccione Grupo(s)":"Seleccione semestre(s)";

			/*
			if($select_poblacion == $p_grup) {
				$carreras = $this->consultas->get_grupos_carrera($carrera);
				if(!is_null($carreras)) {
					$data["g_sel"] = $carreras->result();
				}
				$data["label_poblacion_sel"] ="Seleccione Grupo(s)";
			} else {
				$grupos = $this->consultas->get_semestres_carrera($carrera);
				if(!is_null($grupos)) {
					$data["s_sel"] = $grupos->result();
				}
				$data["label_poblacion_sel"] ="Seleccione semestre(s)";
			}*/
		} else {
			$data["label_poblacion_sel"] ="Selecciono todos los estudiantes";
		}
		

        $this->load->view("head",$data);
        $this->load->view("post/new_post_header");
        $this->load->view("nav");
        $this->load->view("post/new_post"); 	
		$this->load->view("footer");
	}

	public function eliminar($id_post) {

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

    public function check_enlace($titulo,$id_post = null) {
		$enlace = url_title(convert_accented_characters($titulo),'-',TRUE);
		$result = is_null($id_post) ?$this->consultas->exist_enlace($enlace):$this->consultas->exist_enlace($enlace,$id_post);
		if($result) {
			$this->form_validation->set_message('check_enlace','El titulo '.$titulo.' ya esta registrado.') ;
			return FALSE;
		} else {
			return TRUE;
		}
	}

	public function check_enlace_2($titulo) {
		$enlace = url_title(convert_accented_characters($titulo),'-',TRUE);
		$result = $this->consultas->exist_enlace($enlace,null);
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