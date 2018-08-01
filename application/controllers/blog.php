<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller
{
    function __construct()
	{
		parent::__construct();
    }
    /*
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
	*/
	public function post($id_post_modificar = FALSE) {
		if(!$this->session->userdata('username'))
		{
			redirect(base_url().'admin');
		}

		$data["carreras"] = $this->consultas->get_all_carreras();
		$data["tipo_poblacion"] = $this->consultas->get_poblacion();
		$data["user"] = $this->session->userdata('username');
		$data["onLoad"] = '';

		$p_todos = $this->consultas->get_id_poblacion("Todos");
		$p_grup = $this->consultas->get_id_poblacion("Grupo");
		$select_poblacion = null;
		$carrera = null;
		$p_selecionada = null;
		if($id_post_modificar) {
			$data["titulo"] = "Editar post";
			$data["docentes"] = $this->consultas->get_docentes(TRUE)->result();

			$post = $this->consultas->get_post($id_post_modificar);
			if(is_null($post)) {
				redirect(base_url().'exception/identificador-post-invalido');
			}

			$data['post'] = $post;
			$data['autores'] = $this->consultas->get_post_autor($id_post_modificar);

			$post_poblacion = $this->consultas->get_post_poblacion($id_post_modificar);
			$id_poblacion = $post_poblacion->id_poblacion;
			$data['id_poblacion'] = $id_poblacion;
			$data['p_selected'] = $this->consultas->get_items_post($id_post_modificar,$id_poblacion);

			$id_post_modificar_flash = $this->session->flashdata('id_post_modificar_flash');

			$select_poblacion = $id_post_modificar_flash ?$this->input->post('select_poblacion'):$post_poblacion->id_poblacion;
			$carrera = $id_post_modificar_flash ? $this->input->post('carrera'):$post->carrera;
			$p_selecionada = $this->consultas->get_poblacion_type($carrera,$post_poblacion->id_poblacion);

			//Revisar si esto se sigue usando de lo contrario eliminar
			$this->session->set_flashdata('id_post_modificar_flash',$id_post_modificar);
		} else {
			$data["titulo"] = "Crear post";
			$data["docentes"] = $this->consultas->get_docentes()->result();

			$select_poblacion= $this->input->post('select_poblacion');
			$carrera = $this->input->post('carrera');
			$p_selecionada = $this->consultas->get_poblacion_type($carrera,$select_poblacion);
		}
		
		if(!is_null($select_poblacion) && $select_poblacion != $p_todos) {
			if(!is_null($p_selecionada)) {
				$data["p_sel"] = $p_selecionada->result();
			}
			$data["label_poblacion_sel"] = ($select_poblacion == $p_grup) ?"Seleccione Grupo(s)":"Seleccione semestre(s)";
		} else {
			$data["label_poblacion_sel"] ="Selecciono todos los estudiantes";
		}

        $this->load->view("head",$data);
        $this->load->view("post/new_post_header");
        $this->load->view("nav");
        $this->load->view("post/new_post"); 	
		$this->load->view("footer");
	}

    public function registrar() {


		$id_post_modificar = $this->input->post('id_post_modificado');
        
		$rules = array(
			array(
				'field' => 'titulo',
				'label' => 'Titulo del Articulo',
				'rules' => 'trim|required|strip_tags|callback_check_enlace['.$id_post_modificar.']'
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
			,array(
				'field' => 'editor1',
				'label' => 'Contenido',
				'rules' => 'trim|required|min_length[30]'
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
		$this->form_validation->set_error_delimiters('<span style="color:#f00">','</span>');

		$is_new_post = is_null($id_post_modificar) || $id_post_modificar == '0';

		if($this->form_validation->run() === FALSE) {
			if($is_new_post) {
				$this->post();
			} else {
				$this->post($id_post_modificar);
			}
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
				'contenido' => $this->input->post('editor1',FALSE),
				'etiquetas' => '',
				'enlace' => $enlace,
				'fecha' => date('Y-m-d H:i:s'),
				'activo' => $post_activo,
				'permite_comentario' => $tiene_comentario,
				'descripcion' => $this->input->post('descripcion')
			);
			$success = FALSE;
			if($is_new_post) {
				$success = $this->consultas->insert_table('est_post',$data);
			}else {
				$success = $this->consultas->update_table('est_post',$data,'id_post='.$id_post_modificar);
			}
			//$sql = $this->db->set($data)->get_compiled_insert('entrada');
			if($success) {
				$id_post = '0';
				if($is_new_post) {
					$id_post =  $this->db->insert_id();
				} else {
					$id_post =  $id_post_modificar;
					$this->consultas->delete_table('est_post_autor','id_post='.$id_post);
					$this->consultas->delete_table('est_post_poblacion','id_post='.$id_post);
				}

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
				redirect(base_url() . "blog/preview/".$id_post);
			}
		}
	}

	public function preview($id_post = null) {
		if(!$this->session->userdata('username'))
		{
			redirect(base_url().'admin');
		}

		if(is_null($id_post)) {
			redirect(base_url() . "blog/post");
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


	public function exception($mensaje) {
		if(!$this->session->userdata('username'))
		{
			redirect(base_url().'admin');
		}
		
		$data["titulo"] = "Sucedió una excepción";
		$data["user"] = $this->session->userdata('username');
		$data["onLoad"] = '';
		$data["mensaje"] = $mensaje;

		$this->load->view("head",$data);
		$this->load->view("nav");
		$this->load->view("post/exception_post"); 	
		$this->load->view("footer");

	}

	/*
	public function editar($id_post = null) {
		if(!$this->session->userdata('username'))
		{
			redirect(base_url().'admin');
		}
		if(!is_null($id_post)) {
			
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
		} else {
			$data["label_poblacion_sel"] ="Selecciono todos los estudiantes";
		}
		

        $this->load->view("head",$data);
        $this->load->view("post/new_post_header");
        $this->load->view("nav");
        $this->load->view("post/new_post"); 	
		$this->load->view("footer");
	}
	*/
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

	//Validacion a travez de callback
    public function check_enlace($titulo,$id_post = FALSE) {
		$enlace = url_title(convert_accented_characters($titulo),'-',TRUE);
		$result = $id_post ?$this->consultas->exist_enlace($enlace,$id_post):$this->consultas->exist_enlace($enlace);
		if($result) {
			$this->form_validation->set_message('check_enlace','El titulo '.$titulo.' ya esta registrado.') ;
			return FALSE;
		} else {
			return TRUE;
		}
	}

	//validamos el titulo con ajax
	public function comprobar_titulo_ajax() {
		$titulo = $this->input->post('titulo');
		$id_post = $this->input->post('id_post_modificado');
		$enlace = url_title(convert_accented_characters($titulo),'-',TRUE);
		$existe = (($id_post == '0')?$this->consultas->exist_enlace($enlace):$this->consultas->exist_enlace($enlace,$id_post));
		
        if ($existe) {
            echo $id_post.'comprobar titulo:'.(($id_post == '0')?'Ya existe y el post es nuevo':'Ya existe y el post se esta editando');
            return FALSE;
        } else {
            echo '<div style="display:none">1</div>';
            return TRUE;
        }
    }

	//validacion con callback para multiples autores
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

	//validacion con callback para multiples semestres
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

	//validacion con callback para multiples grupos
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


	public function lista() {
        if(!$this->session->userdata('username'))
		{
			redirect(base_url().'admin');
		}

		$data["titulo"] = "Lista de publicaciones";
		$data["posts"] =  $this->consultas->get_list_post();
		$data["user"] = $this->session->userdata('username');
		$data["onLoad"] = '';

		$this->load->view("head",$data);

		$this->load->view("nav");
		$this->load->view("post/list_post"); 	
		$this->load->view("footer");
	}
	
	public function comentarios() {
		if(!$this->session->userdata('username'))
		{
			redirect(base_url().'admin');
		}

		$data["titulo"] = "Verificacion de comentarios";
		$data["user"] = $this->session->userdata('username');
		$data["onLoad"] = '';

		$this->load->view("head",$data);
		$this->load->view("nav");
		$this->load->view("post/coments"); 	
		$this->load->view("footer");
	}
}