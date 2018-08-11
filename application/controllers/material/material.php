<?php
class Material extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}
	public function lista()
	{
		if(!$this->session->userdata('username'))
		{
			redirect(base_url());
		}
		$usuario=$this->session->userdata('username');
		$data= array('titulo'=> 'Lista de Material Académico Publicado');
			$onload='onload="get_lista()"';

		$this->load->view("head",$data);
		$data= array('user'=> $usuario,'onLoad'=>$onload);
		$this->load->view("nav", $data);

		$this->load->view("material/lista_material");
		$this->load->view("footer");
	}	
	public function get_lista()
	{
		$resultado='';
		$get_lista=$this->consultas->get_lista_material();
		if($get_lista!=null)
			foreach ($get_lista ->result() as $fila) {
				$get_grupos=$this->consultas->get_material_grupo($fila->id_material);
				$grupos='';
				if($get_grupos!=null)
					foreach ($get_grupos ->result() as $row) {
					$grupos.=$row->cod_grupo.'<br>';
					}
				$nom_docente=$this->consultas->get_nom_docente($fila->cod_docente);
				$nom_materia=$fila->cod_materia.' '.$this->consultas->get_nom_materia($fila->cod_materia,$fila->carrera);

				$fecha_nueva= explode("-", $fila->fecha);
                $fecha=$fecha_nueva[2].'/'.$fecha_nueva[1].'/'.$fecha_nueva[0];
                $resultado.='<tr id="'.$fila->id_material.'">
		                        <td>'.$fila->id_material.'</td>
		                        <td>'.$fila->titulo.'</td>
		                        <td>'.$fecha.'</td>
								<td>'.$fila->contenido.'</td>								
								<td>'.$fila->gestion.'</td>
								<td>'.$fila->carrera.'</td>
								<td>'.$nom_docente.'</td>
								<td>'.$nom_materia.'</td>
								<td>'.$fila->nom_archivo.'</td>
								<td nowrap><button class="btn btn-success btn-sm"  onclick=\'edit_material('.$fila->id_material.');\'><span class="fa fa-pencil"></span></button>
									<button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalMensajes" onclick=\'seguro_del('.$fila->id_material.',"'.$fila->titulo.'");\' ><i class="fa fa-times"></i></button></td>
							</tr>';
			}
		echo $resultado;
	}
	public function nuevo()
	{
		if(!$this->session->userdata('username'))
		{
			redirect(base_url());
		}
		$usuario=$this->session->userdata('username');		
		$data= array('titulo'=> 'Nuevo Material', 'header_links' => 'post/new_post_header','script' => 'post/new_post_script');
		$onload='onload="get_materias();"';
		$this->load->view("head",$data);
		$consulta_carreras=$this->consultas->get_all_carreras();
		$docentes=$this->consultas->get_docentes();


		$data= array('user'=> $usuario,'onLoad'=>$onload,'carreras'=>$consulta_carreras,'docentes'=>$docentes);
		$this->load->view("nav", $data);

		$this->load->view("material/nuevo_material");
		$this->load->view("footer");
	}
	public function subir()
	{
          $carrera=$_POST['carrera'];
          $docente=$_POST['docente'];
          $materias=$_POST['materias'];
          $grupo_sel=$_POST['grupo_sel'];
          $titulo=$_POST['titulo'];
          $incluir_archivo=$_POST['incluir_archivo'];
          $contenido=$_POST['contenido'];
          $nombre_archivo='';
		  $gestion=$this->consultas->get_last_gestion()->row()->valor;

          if($incluir_archivo=='true')
          {
            $grupo_sel=explode(',',$grupo_sel);
			$archivo = $_FILES['archivo'];
          	$nombre = strtolower($archivo['name']);
			$temporal = $archivo['tmp_name'];
			$partesNombre = explode('.', $nombre);
			$extensionArchivo = end($partesNombre);
			$nuevoNombre = rand(1000000000, 9999999999). '.' . $extensionArchivo;
			$nueva_ruta=$_SERVER['DOCUMENT_ROOT'].'/admin/plantillas/archivos/'.$nombre;
			// $nueva_ruta=$_SERVER['DOCUMENT_ROOT'].'/admin/plantillas/archivos/'.$nuevoNombre;
			// print_r($_FILES);
			// echo $temporal.'-'.$nueva_ruta;
			move_uploaded_file($temporal,$nueva_ruta);
          	$nombre_archivo=$nombre;
          }
		$data = array(
						'gestion' =>$gestion,
						'titulo' =>$titulo,
						'contenido' =>$contenido,
						'cod_docente' =>$docente,
						'nom_archivo' =>$nombre_archivo,
						'url' =>$nombre_archivo,
						'carrera' =>$carrera,
						'fecha' =>date('Y-m-d H:i:s'),	
						'cod_materia' =>$materias,	
						);			
		$this->consultas->insert_table('est_material',$data);
					$id =  $this->db->insert_id();

		for ($i=0; $i < count($grupo_sel); $i++) { 
			$data = array(
				'id_material' =>$id,
				'cod_grupo' =>$grupo_sel[$i],
				);			
			$this->consultas->insert_table('est_material_grupo',$data);
		}
		echo 'exito';		

	}
	public function get_materias()
	{
		$cod_pensum=$_POST['cod_pensum'];
		$cod_docente=$_POST['cod_docente'];
		$gestion=$this->consultas->get_last_gestion()->row()->valor;
		$sql="SELECT DISTINCT nombre_materia_oficial, materia.sigla_materia, nivel_materia FROM asignacion_docente INNER JOIN materia ON materia.cod_pensum = asignacion_docente.cod_pensum AND materia.sigla_materia = asignacion_docente.sigla_materia WHERE asignacion_docente.cod_docente = '$cod_docente' AND asignacion_docente.gestion = '$gestion' AND asignacion_docente.cod_pensum = '$cod_pensum' ORDER BY nivel_materia, materia.sigla_materia";
		$get_materias=$this->consultas->consulta_SQL($sql);
		$resultado='';
		if($get_materias!=null)
		{
			foreach ($get_materias -> result() as $fila) {
				$resultado.='<option value="'.$fila->sigla_materia.'">'.$fila->nombre_materia_oficial.'</option>';
			}
		}
		else
			$resultado.='<option value="0">No hay materias</option>';
		echo $resultado;
	}
	public function get_grupo()
	{
		$cod_pensum=$_POST['cod_pensum'];
		$cod_docente=$_POST['cod_docente'];
		$sigla_materia=$_POST['sigla_materia'];
		$gestion=$this->consultas->get_last_gestion()->row()->valor;
		
		$sql="SELECT DISTINCT cod_grupo FROM asignacion_docente INNER JOIN materia ON materia.cod_pensum = asignacion_docente.cod_pensum AND materia.sigla_materia = asignacion_docente.sigla_materia WHERE cod_docente = '$cod_docente' AND gestion = '$gestion' AND asignacion_docente.cod_pensum = '$cod_pensum' AND asignacion_docente.sigla_materia = '$sigla_materia' ORDER BY cod_grupo";
		
		$get_grupos=$this->consultas->consulta_SQL($sql);
		$resultado='';
		if($get_grupos!=null)
		{
			foreach ($get_grupos -> result() as $fila) {
				$resultado.='<option value="'.$fila->cod_grupo.'">'.$fila->cod_grupo.'</option>';
			}
		}
		else
			$resultado.='<option value="0">No hay grupos</option>';
		echo $resultado;
	}
	public function verificar_titulo()
	{
		$titulo=$_POST['titulo'];
		$cod_carrera=$_POST['cod_carrera'];
		$gestion=$this->consultas->get_last_gestion()->row()->valor;
		echo $this->consultas->existe_titulo_material($titulo,$cod_carrera,$gestion);
	}
	public function del_material()
	{
		$id=$_POST['id'];
		
		$where = array(
			'id_material' => $id,
			);
			$this->consultas->delete_table('est_material',$where);
			$this->consultas->delete_table('est_material_grupo',$where);
		echo 'exito';
	}
	public function edit_material($id)
	{
		if(!$this->session->userdata('username'))
		{
			redirect(base_url());
		}
		$usuario=$this->session->userdata('username');		
		$data= array('titulo'=> 'Editar Material Académico', 'header_links' => 'post/new_post_header','script' => 'post/new_post_script');
		$onload='onload=""';
		$this->load->view("head",$data);
		$consulta_carreras=$this->consultas->get_all_carreras();
		$docentes=$this->consultas->get_docentes();
		
		$get_material = $this->consultas->get_edit_material($id);

		$get_grupo_seleccionado=$this->get_poblacion_seleccionada($get_material->row()->id_material,$get_material->row()->carrera,true,$id);		

		$data= array('user'=> $usuario,'onLoad'=>$onload, 'carreras'=>$consulta_carreras,'docentes'=>$docentes,'get_material'=>$get_material,'var_modific'=>$get_grupo_seleccionado, 'id_sel'=>$id);
		$this->load->view("nav", $data);

		$this->load->view("material/nuevo_material");
		$this->load->view("footer");
	}
	public function get_poblacion_sel()
	{
		$tipo_sel=$_POST['tipo_sel'];
		$carrera=$_POST['carrera'];
		$resultado=$this->get_poblacion_seleccionada($tipo_sel,$carrera,false,'0');		
		echo $resultado;
	}
	public function get_poblacion_seleccionada($tipo_sel,$carrera,$modificar,$id)
	{
		// $lista = array();
		// if($modificar)
		// {

		// 	$get_items=$this->consultas->get_avisos_población_item($id);
		// 	foreach ($get_items ->result() as $row)
		// 	{
		// 		array_push($lista,$row->item);
		// 	}
		// }
		// $resultado='';
		// if($tipo_sel=='1')
		// {
		// 	$resultado.='<option value="Todos" selected="selected">Todos</option>';				
		// }
		// if($tipo_sel=='2')
		// {
		// 	$get_grupo=$this->consultas->get_semestres_carrera($carrera);
		// 	if($get_grupo!=null)
		// 	foreach ($get_grupo ->result() as $fila) {
		// 		if($modificar)
		// 		{
		// 			$aux='';
		// 			for ($i=0; $i <count($lista) ; $i++) { 
		// 				if($lista[$i]==$fila->semestre)
		// 					$aux='selected="selected"';
		// 			}
		// 					$resultado.='<option value="'.$fila->semestre.'" '.$aux.'>'.$fila->semestre.'</option>';				
		// 		}
		// 		else
		// 			$resultado.='<option value="'.$fila->semestre.'" >'.$fila->semestre.'</option>';				
		// 	}
		// }
		// if($tipo_sel=='3')
		// {
		// 	$get_grupo=$this->consultas->get_grupos_carrera($carrera);
		// 	if($get_grupo!=null)
		// 	foreach ($get_grupo ->result() as $fila) {
		// 		if($modificar)
		// 		{
		// 			$aux='';
		// 			for ($i=0; $i <count($lista) ; $i++) { 
		// 				if($lista[$i]==$fila->cod_grupo)
		// 					$aux='selected="selected"';
		// 			}
		// 					$resultado.='<option value="'.$fila->cod_grupo.'" '.$aux.'>'.$fila->cod_grupo.'</option>';				
		// 		}
		// 		else
		// 		$resultado.='<option value="'.$fila->cod_grupo.'" >'.$fila->cod_grupo.'</option>';				
		// 	}
		// }
		// return $resultado;
	}
	public function registrar()
	{
		$titulo=$_POST['titulo'];
		$carrera=$_POST['carrera'];
		$select_poblacion=$_POST['select_poblacion'];
		$grupo_sel=$_POST['grupo_sel'];
		$fecha_ini=$_POST['fecha_ini'];
		$fecha_fin=$_POST['fecha_fin'];
		$contenido=$_POST['contenido'];
		$habilitado=$_POST['habilitado'];
		$prioridad=$_POST['prioridad'];
		$contador=0;
		$id=$this->consultas->consulta_SQL("select nextval('aviso_sequence')")->row()->nextval;
		$data = array(
						'id_aviso' =>$id,
						'titulo' =>$titulo,
						'descripcion' =>$contenido,
						'prioridad' =>$prioridad,
						'fecha_ini' =>$fecha_ini,
						'fecha_fin' =>$fecha_fin,
						'habilitado' =>$habilitado,	
						'carrera' =>$carrera,					 
						);			
		$this->consultas->insert_table('est_avisos',$data);

		for ($i=0; $i < count($grupo_sel); $i++) { 
			$data = array(
				'id_aviso' =>$id,
				'id_poblacion' =>$select_poblacion,
				'item' =>$grupo_sel[$i],
				);			
			$this->consultas->insert_table('est_avisos_poblacion',$data);
		}
		echo 'exito';
	}
	public function modificar()
	{
		$titulo=$_POST['titulo'];
		$carrera=$_POST['carrera'];
		$select_poblacion=$_POST['select_poblacion'];
		$grupo_sel=$_POST['grupo_sel'];
		$fecha_ini=$_POST['fecha_ini'];
		$fecha_fin=$_POST['fecha_fin'];
		$contenido=$_POST['contenido'];
		$habilitado=$_POST['habilitado'];
		$id=$_POST['id'];
		$prioridad=$_POST['prioridad'];
		$contador=0;
		$data = array(
						'titulo' =>$titulo,
						'descripcion' =>$contenido,
						'prioridad' =>$prioridad,
						'fecha_ini' =>$fecha_ini,
						'fecha_fin' =>$fecha_fin,
						'habilitado' =>$habilitado,	
						'carrera' =>$carrera,					 
						);
		$where = array(
						'id_aviso' =>$id,											 
						);			
		$this->consultas->update_table('est_avisos',$data,$where);
		$data = array(
				'id_aviso' =>$id,
				'id_poblacion' =>$select_poblacion,
				);
		$this->consultas->delete_table('est_avisos_poblacion',$where);
		for ($i=0; $i < count($grupo_sel); $i++) { 
			$data = array(
				'id_aviso' =>$id,
				'id_poblacion' =>$select_poblacion,
				'item' =>$grupo_sel[$i],
				);			
			$this->consultas->insert_table('est_avisos_poblacion',$data);
		}
		echo 'exito';
	}
		
}
