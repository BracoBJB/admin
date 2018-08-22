<?php
class Comunicados extends CI_Controller
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
		$data= array('titulo'=> 'Lista de Comunicados');
			$onload='onload=""';

		$this->load->view("head",$data);
		$data= array('user'=> $usuario,'onLoad'=>$onload);
		$this->load->view("nav", $data);

		$this->load->view("comunicados/lista_comunicados");
		$this->load->view("footer");
	}	
	// public function get_lista2()
	// {
	// 	$resultado='';
	// 	$get_lista=$this->consultas->get_lista_avisos();
	// 	if($get_lista!=null)
	// 		foreach ($get_lista ->result() as $fila) {
	// 			$get_poblacion=$this->consultas->get_aviso_poblacion($fila->id_aviso);
	// 			$poblacion='';
	// 			if($get_poblacion!=null)
	// 				foreach ($get_poblacion ->result() as $row) {
	// 				$poblacion.=$row->item.'<br>';
	// 				}
	// 				$estado='checked';
	// 			if($fila->habilitado=='f')
	// 				$estado='';
	// 			$fecha_nueva= explode("-", $fila->fecha_ini);
 //                $fecha_ini=$fecha_nueva[2].'/'.$fecha_nueva[1].'/'.$fecha_nueva[0];
 //                $fecha_nueva= explode("-", $fila->fecha_fin);
 //                $fecha_fin=$fecha_nueva[2].'/'.$fecha_nueva[1].'/'.$fecha_nueva[0];
	// 			$resultado.='<tr id="'.$fila->id_aviso.'">
	// 	                        <td>'.$fila->id_aviso.'</td>
	// 	                        <td>'.$fila->titulo.'</td>
	// 	                        <td>'.$fecha_ini.'</td>
	// 	                        <td>'.$fecha_fin.'</td>
	// 							<td>'.$fila->descripcion.'</td>								
	// 							<td>'.$poblacion.'</td>
	// 							<td>'.$fila->carrera.'</td>
	// 							<td>'.$fila->nombre.'</td>
	// 							<td><label class="switch switch-3d switch-info"><input type="checkbox" class="switch-input" id="habilitado" '.$estado.' disabled><span class="switch-label"></span><span class="switch-handle"></span></label></td>
	// 							<td nowrap><button class="btn btn-success btn-sm"  onclick=\'edit_comunicado('.$fila->id_aviso.');\'><span class="fa fa-pencil"></span></button>
	// 								<button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalMensajes" onclick=\'seguro_del('.$fila->id_aviso.',"'.$fila->titulo.'");\' ><i class="fa fa-times"></i></button></td>
	// 						</tr>';
	// 		}
	// 	echo $resultado;
	// }
	public function get_lista()
	{
		$get_lista=$this->consultas->get_lista_avisos();
		echo json_encode($get_lista);
	}
	public function nuevo()
	{
		if(!$this->session->userdata('username'))
		{
			redirect(base_url());
		}
		$usuario=$this->session->userdata('username');		
		$data= array('titulo'=> 'Nuevo Comunicado', 'header_links' => 'post/new_post_header','script' => 'post/new_post_script');
		$onload='onload=""';
		$this->load->view("head",$data);
		$get_poblacion = $this->consultas->get_poblacion();
		$consulta_carreras=$this->consultas->get_all_carreras();
		$get_prioridad=$this->consultas->get_prioridad();


		$data= array('user'=> $usuario,'onLoad'=>$onload, 'tipo_poblacion'=>$get_poblacion, 'carreras'=>$consulta_carreras,'prioridad'=>$get_prioridad);
		$this->load->view("nav", $data);

		$this->load->view("comunicados/nuevos_comunicados");
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
		$lista = array();
		if($modificar)
		{

			$get_items=$this->consultas->get_avisos_población_item($id);
			foreach ($get_items ->result() as $row)
			{
				array_push($lista,$row->item);
			}
		}
		$resultado='';
		if($tipo_sel=='1')
		{
			$resultado.='<option value="Todos" selected="selected">Todos</option>';				
		}
		if($tipo_sel=='2')
		{
			$get_grupo=$this->consultas->get_semestres_carrera($carrera);
			if($get_grupo!=null)
			foreach ($get_grupo ->result() as $fila) {
				if($modificar)
				{
					$aux='';
					for ($i=0; $i <count($lista) ; $i++) { 
						if($lista[$i]==$fila->semestre)
							$aux='selected="selected"';
					}
							$resultado.='<option value="'.$fila->semestre.'" '.$aux.'>'.$fila->semestre.'</option>';				
				}
				else
					$resultado.='<option value="'.$fila->semestre.'" >'.$fila->semestre.'</option>';				
			}
		}
		if($tipo_sel=='3')
		{
			$get_grupo=$this->consultas->get_grupos_carrera($carrera);
			if($get_grupo!=null)
			foreach ($get_grupo ->result() as $fila) {
				if($modificar)
				{
					$aux='';
					for ($i=0; $i <count($lista) ; $i++) { 
						if($lista[$i]==$fila->cod_grupo)
							$aux='selected="selected"';
					}
							$resultado.='<option value="'.$fila->cod_grupo.'" '.$aux.'>'.$fila->cod_grupo.'</option>';				
				}
				else
				$resultado.='<option value="'.$fila->cod_grupo.'" >'.$fila->cod_grupo.'</option>';				
			}
		}
		return $resultado;
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
	public function del_comunicado()
	{
		$id=$_POST['id'];
		
		$where = array(
			'id_aviso' => $id,
			);
			$this->consultas->delete_table('est_avisos',$where);
			$this->consultas->delete_table('est_avisos_poblacion',$where);
		echo 'exito';
	}
	public function edit_comunicado($id)
	{
		if(!$this->session->userdata('username'))
		{
			redirect(base_url());
		}
		$usuario=$this->session->userdata('username');		
		$data= array('titulo'=> 'Editar Comunicado', 'header_links' => 'post/new_post_header','script' => 'post/new_post_script');
		$onload='onload="get_detalle_seleccion()"';
		$this->load->view("head",$data);
		$get_poblacion = $this->consultas->get_poblacion();
		$consulta_carreras=$this->consultas->get_all_carreras();
		$get_prioridad=$this->consultas->get_prioridad();
		$get_aviso = $this->consultas->get_edit_avisos($id);

		$get_grupo_seleccionado=$this->get_poblacion_seleccionada($get_aviso->row()->id_poblacion,$get_aviso->row()->carrera,true,$id);		

		$data= array('user'=> $usuario,'onLoad'=>$onload, 'tipo_poblacion'=>$get_poblacion, 'carreras'=>$consulta_carreras,'prioridad'=>$get_prioridad,'get_aviso'=>$get_aviso,'var_modific'=>$get_grupo_seleccionado, 'id_sel'=>$id);
		$this->load->view("nav", $data);

		$this->load->view("comunicados/nuevos_comunicados");
		$this->load->view("footer");
	}
	public function verificar_titulo()
	{
		$titulo=$_POST['titulo'];
		$cod_carrera=$_POST['cod_carrera'];
		echo $this->consultas->existe_titulo($titulo,$cod_carrera);
	}	
}
