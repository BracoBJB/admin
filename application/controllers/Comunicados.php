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
		$data= array('titulo'=> 'Bienvenido');
			$onload='onload="get_lista()"';

		$this->load->view("head",$data);
		$data= array('user'=> $usuario,'onLoad'=>$onload);
		$this->load->view("nav", $data);

		$this->load->view("comunicados/lista_comunicados");
		$this->load->view("footer");
	}	
	public function get_lista()
	{
		$resultado='';
		$get_lista=$this->consultas->get_lista_avisos();
		if($get_lista!=null)
			foreach ($get_lista ->result() as $fila) {
				$get_poblacion=$this->consultas->get_aviso_poblacion($fila->id_aviso);
				$poblacion='';
				if($get_poblacion!=null)
					foreach ($get_poblacion ->result() as $row) {
					$poblacion.=$row->item.'<br>';
					}
					$estado='true';
				if($fila->activo=='f')
					$estado='false';
				$resultado.='<tr id="'.$fila->id_aviso.'">
		                        <td>'.$fila->id_aviso.'</td>
		                        <td>'.$fila->titulo.'</td>
		                        <td>'.$fila->fecha_ini.'</td>
		                        <td>'.$fila->fecha_fin.'</td>
								<td>'.$fila->descripcion.'</td>
								<td>'.$fila->url_imagen.'</td>
								<td>'.$poblacion.'</td>

								<td><label class="switch switch-text switch-primary switch-pill"><input type="checkbox" class="switch-input" checked="'.$estado.'"> <span data-on="Si" data-off="No" class="switch-label"></span> <span class="switch-handle"></span></label></td>
								<td><button class="btn btn-success btn-sm"  onclick=\'edit_comunicado('.$fila->id_aviso.');\'><span class="fa fa-pencil"></span></button>
									<button class="btn btn-danger btn-sm"  onclick=\'del_comunicado('.$fila->id_aviso.');\' ><i class="fa fa-times"></i></button></td>
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
		$data= array('titulo'=> 'Nuevo Comunicado', 'header_links' => 'new_post_header','script' => 'new_post_script');
		$onload='onload=""';
		$this->load->view("head",$data);
		$get_poblacion = $this->consultas->get_poblacion();
		$consulta_carreras=$this->consultas->get_all_carreras();


		$data= array('user'=> $usuario,'onLoad'=>$onload, 'tipo_poblacion'=>$get_poblacion, 'carreras'=>$consulta_carreras);
		$this->load->view("nav", $data);

		$this->load->view("comunicados/nuevos_comunicados");
		$this->load->view("footer");
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
	public function registrar()
	{
		$titulo=$_POST['titulo'];
		$carrera=$_POST['carrera'];
		$select_poblacion=$_POST['select_poblacion'];
		$grupo_sel=$_POST['grupo_sel'];
		$fecha_ini=$_POST['fecha_ini'];
		$fecha_fin=$_POST['fecha_fin'];
		$contenido=$_POST['contenido'];
		$activo=$_POST['activo'];
		$contador=0;
		$id=$this->consultas->consulta_SQL("select nextval('id_avisos_seq')")->row()->nextval;
		$data = array(
						'id_aviso' =>$id,
						'titulo' =>$titulo,
						'descripcion' =>$contenido,
						'url_imagen' =>'none',
						'fecha_ini' =>$fecha_ini,
						'fecha_fin' =>$fecha_fin,
						'activo' =>$activo,						 
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
	}
	public function del_comunicado()
	{
		$id=$_POST['id'];
		
		$where = array(
			'id_aviso' => $id,
			);
			$this->consultas->delete_table('est_avisos',$where);
			$this->consultas->delete_table('est_avisos_poblacion',$where);
	}
	public function edit_comunicado($id)
	{
		if(!$this->session->userdata('username'))
		{
			redirect(base_url());
		}
		$usuario=$this->session->userdata('username');		
		$data= array('titulo'=> 'Nuevo Comunicado', 'header_links' => 'new_post_header','script' => 'new_post_script');
		$onload='onload=""';
		$this->load->view("head",$data);
		$get_poblacion = $this->consultas->get_poblacion();
		$consulta_carreras=$this->consultas->get_all_carreras();


		$data= array('user'=> $usuario,'onLoad'=>$onload, 'tipo_poblacion'=>$get_poblacion, 'carreras'=>$consulta_carreras);
		$this->load->view("nav", $data);

		$this->load->view("comunicados/nuevos_comunicados");
		$this->load->view("footer");
	}	
}
