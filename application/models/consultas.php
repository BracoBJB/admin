<?php  if(! defined('BASEPATH')) exit('No direct script access allowd');
/**
* 
*/
class Consultas extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function login_est($username,$password)
	{
		$sql="SELECT CONCAT(nombres,' ', ap_paterno,' ', ap_materno) as name FROM estudiante INNER JOIN  doc_presentados ON  doc_presentados.cod_ceta =  estudiante.cod_ceta WHERE estudiante.cod_ceta = $username AND numero_doc = '$password' AND nombre_doc = 'Carnet de identidad'";
		$q=$this->db->query($sql);
		if(is_null($q))
			return '';
		else
			return $q->row()->name;			
	}
	public function login_admin($username,$password)
	{
		$this->db->select('activo');
		$this->db->where('id_usuario',$username);//nombre del campo
		$this->db->where('pass',$password);
		$q=$this->db->get('usuario');//nombre de la tabla
		if($q->num_rows()>0)
		{
			$fila=$q->row();				
			if($fila->activo=='t')
			{
				$q=$this->db->query("SELECT nom_rol FROM asignacion_usuario WHERE id_usuario='".$username."'");	
				if($q->num_rows()>0)
				{
					$fila=$q->row();				
					return $fila->nom_rol;
				}
				else
				{
					return 'no_rol';
				}
			}
			else
				return 'false';	
		} 
		else
		{
			return null;
		}
	}
	public function consulta_SQL($sql)
	{
		$consulta=$this->db->query($sql);
		if($consulta->num_rows()>0)
		{
			return $consulta;
		}
		else
		{
			return null;
		}		
		
	}
	
	public function name_user($id_usuario)
	{	
		$sql="SELECT ap_paterno||' '||ap_materno||' '||nombre as name FROM usuario WHERE id_usuario = '".$id_usuario."'";
		$q=$this->db->query($sql);
		if(is_null($q))
			return '';
		else
			return $q->row()->name;
		// echo $sql;
		echo $q;
	}

	public function get_lista_avisos()
	{
		$sql="SELECT id_aviso, titulo, descripcion, fecha_ini, fecha_fin, habilitado, carrera, est_prioridad.nombre FROM est_avisos INNER JOIN est_prioridad ON est_prioridad.id_prioridad = est_avisos.prioridad ORDER BY est_avisos.fecha_ini DESC";
		$consulta=$this->db->query($sql);
		if($consulta->num_rows()>0)
		{
			return $consulta;
		}
		else
		{
			return null;
		}
	}
	public function get_edit_avisos($id)
	{
		$sql="SELECT est_avisos.id_aviso,titulo,descripcion,fecha_ini,fecha_fin,habilitado, carrera, item, id_poblacion, prioridad FROM est_avisos INNER JOIN est_avisos_poblacion ON est_avisos_poblacion.id_aviso = est_avisos.id_aviso WHERE est_avisos.id_aviso =  $id";
		$consulta=$this->db->query($sql);
		if($consulta->num_rows()>0)
		{
			return $consulta;
		}
		else
		{
			return null;
		}
	}
	public function get_avisos_población_item($id)
	{
		$sql="SELECT item FROM est_avisos_poblacion WHERE id_aviso = $id";
		$consulta=$this->db->query($sql);
		if($consulta->num_rows()>0)
		{
			return $consulta;
		}
		else
		{
			return null;
		}
	}

	public function get_aviso_poblacion($id_aviso)
	{
		$sql="SELECT item FROM est_avisos_poblacion WHERE id_aviso = $id_aviso";
		$consulta=$this->db->query($sql);
		if($consulta->num_rows()>0)
		{
			return $consulta;
		}
		else
		{
			return null;
		}
	}

	public function get_poblacion()
	{
		$sql="SELECT nombre, id_poblacion FROM est_poblacion ORDER BY id_poblacion ASC";
		$consulta=$this->db->query($sql);
		if($consulta->num_rows()>0)
		{
			return $consulta;
		}
		else
		{
			return null;
		}
	}

	public function get_all_carreras()
	{
		$consulta=$this->db->query("SELECT cod_carrera, nombre_carrera FROM carrera ORDER BY orden ASC ");
		if($consulta->num_rows()>0)
		{
			return $consulta;
		}
		else
		{
			return null;
		}		
		
	}

	public function get_docentes($todos = FALSE) {

		$this->db->select("CONCAT(nombre,' ', apellido_p,' ', apellido_m) as name,cod_docente");
		$this->db->order_by("nombre,apellido_p,apellido_m");
		if(!$todos) {
			$this->db->where('activo',TRUE);
		}
		$consulta = $this->db->get('docente');

		if($consulta->num_rows()>0)
		{
			return $consulta;
		}
		else
		{
			return null;
		}
	}

	public function get_semestres_carrera($carrera)
	{
		$consulta=$this->db->query("SELECT DISTINCT semestre FROM semestre INNER JOIN pensum ON pensum.cod_pensum = semestre.cod_pensum WHERE cod_carrera = '$carrera' ORDER BY semestre ASC");
		if($consulta->num_rows()>0)
		{
			return $consulta;
		}
		else
		{
			return null;
		}		
		
	}

	public function get_grupos_carrera($carrera)
	{
		$consulta=$this->db->query("SELECT cod_grupo FROM grupo INNER JOIN pensum ON pensum.cod_pensum = grupo.cod_pensum WHERE cod_carrera='$carrera' AND gestion in (SELECT gestion FROM gestion ORDER BY fecha_inicio DESC LIMIT 1) ORDER BY orden_turno ASC, semestre ASC, cod_grupo ASC ");
		if($consulta->num_rows()>0)
		{
			return $consulta;
		}
		else
		{
			return null;
		}		
		
	}
	public function get_prioridad()
	{
		$consulta=$this->db->query("SELECT id_prioridad, nombre FROM est_prioridad ORDER BY id_prioridad ASC");
		if($consulta->num_rows()>0)
		{
			return $consulta;
		}
		else
		{
			return null;
		}		
		
	}
	function update_table($tabla,$data,$where)
	{
		$this->db->where($where);
		$this->db->update($tabla,$data);
		// if($this->db->update($tabla,$data))
		if($this->db->affected_rows()>0)
			{return true;}
		else
			{return false;}
	}

	function delete_table($tabla,$where)
	{	
		$this->db->where($where);
		$this->db->delete($tabla);

		if($this->db->affected_rows()>0)
			{return true;}
		else
			{return false;}
	}

	function insert_table($tabla,$data)
	{
		if($this->db->insert($tabla,$data))
			{return true;}
		else
			{
				return false;
		}
	}

	public function existe_titulo($titulo,$carrera) {
		$where = array(
			'titulo' => $titulo,
			'carrera' => $carrera,
			);
		$this->db->select('titulo')->where($where);
		$consulta = $this->db->get('est_avisos');

		return $consulta->num_rows();
	}
	public function exist_enlace($enlace,$id_post = FALSE) {
		$this->db->select('enlace')->where('enlace',$enlace);
		if($id_post) {
			$this->db->where("id_post != $id_post");
		}
		$consulta = $this->db->get('est_post');

		return $consulta->num_rows() > 0;
	}
	//Inserta un array asociativo en la bd
	public function insertArray($table,$data_array) {
		$this->db->insert($table, $data_array);
	}

	public function get_list_post() {
		$this->db->select('ep.id_post,ep.titulo,ep.tema,epa.autor,ep.carrera,epp.poblacion,ep.contenido,ep.descripcion,ep.fecha,ep.activo,ep.permite_comentario');
		$this->db->from('est_post as ep');
		$this->db->join("(
			select pa.id_post,string_agg(d.nombre, ', ') as autor
			from est_post_autor as pa
			inner join (
				select CONCAT(nombre || ' ' || apellido_p || ' ' || apellido_m) as nombre,cod_docente from docente 
			) as d on pa.cod_docente = d.cod_docente
			group by pa.id_post
		) as epa",'ep.id_post = epa.id_post');
		$this->db->join("(
			select pp.id_post,string_agg(pp.item, ', ') as poblacion
			from est_post_poblacion as pp
			group by pp.id_post
		) as epp",'ep.id_post = epp.id_post');
		$this->db->order_by("ep.fecha", "desc");
		$query = $this->db->get();

		if($query->num_rows()>0)
		{
			return $query->result();
		}
		else
		{
			return null;
		}	
	}
	public function get_post($id_post) {
		$this->db->select('ep.id_post,ep.titulo,ep.tema,ep.carrera,ep.contenido,ep.descripcion,ep.fecha,ep.activo,ep.permite_comentario');
		$this->db->from('est_post as ep');
		$this->db->where('ep.id_post',$id_post);
		$query = $this->db->get();
		return $query->row();
	}
	public function get_post_autor($id_post) {
		$this->db->select('cod_docente');
		$this->db->where('id_post',$id_post);
		$query = $this->db->get('est_post_autor');
		return $query->result();
	}

	public function get_post_poblacion($id_post) {
		$this->db->select("id_poblacion,string_agg(item, ',') as poblacion_seleccionada");
		$this->db->where('id_post',$id_post);
		$this->db->group_by('id_poblacion');
		$query = $this->db->get('est_post_poblacion');
		return $query->row();
	}

	public function get_id_poblacion($nombre_poblacion) {
		$this->db->select('id_poblacion')->where('nombre',$nombre_poblacion);
		$consulta = $this->db->get('est_poblacion');

		return $consulta->row()->id_poblacion;
	}

	public function get_poblacion_type($carrera,$id_poblacion) {
		if($id_poblacion == '3') {
			$this->db->select('g.cod_grupo as item');
			$this->db->from('grupo as g');
			$this->db->join('pensum as p','p.cod_pensum = g.cod_pensum');
			$this->db->where('p.cod_carrera',$carrera);
			$this->db->where('g.gestion IN (SELECT gestion FROM gestion ORDER BY fecha_inicio DESC LIMIT 1)', NULL, FALSE);
			$this->db->order_by('g.orden_turno', 'ASC');
			$this->db->order_by('g.semestre', 'ASC');	
			$this->db->order_by('g.cod_grupo', 'ASC');	
			$consulta = $this->db->get();
			return $consulta->num_rows()>0?$consulta:null;
		} else if($id_poblacion == '2') {
			$this->db->select('DISTINCT(s.semestre) as item');
			$this->db->from('semestre as s');
			$this->db->join('pensum as p','p.cod_pensum = s.cod_pensum');
			$this->db->where('p.cod_carrera',$carrera);
			$this->db->order_by('s.semestre', 'ASC');
			$consulta = $this->db->get();
			return $consulta->num_rows()>0?$consulta:null;
		} else {
			return null;
		}
	}

	public function get_items_post($id_post,$id_poblacion) {
		$this->db->select("item");
		$this->db->where('id_post',$id_post);
		$this->db->where('id_poblacion',$id_poblacion);
		$query = $this->db->get('est_post_poblacion');
		return $query->result();
	}

	public function get_comentarios($tipo) {
		$sql = "select epc.id_comentario,ep.titulo,e.nombre,epc.contenido,epc.fecha,COALESCE(epc.id_respuesta,0) as es_respuesta,epc.verificado
		from est_post_comentario as epc
		inner join est_post as ep on ep.id_post = epc.id_post
		inner join (
			select CONCAT(nombres,' ',ap_paterno,' ',ap_materno) as nombre,cod_ceta
			from estudiante
		) as e on e.cod_ceta = epc.cod_ceta ";


		if($tipo == '1') {
			$sql.='where epc.verificado = FALSE';
		} else {
			if($tipo == '2') {
				$sql.='where epc.verificado = TRUE';
			}
		}

		$consulta=$this->db->query($sql);
		return $consulta->result();
	}

	public function get_comentarios_sp($type,$start,$length,$search) {

		$full_query_count ="select count(1) as counted from (
			%s
		) as tmp 
		%s";

		$query_records_pag ="select * from (
			%s
		) as tmp 
		%s";

		$query_search = '';
		if(!is_null($search) && !empty($search)) {
			$query_search = " where id_comentario LIKE '%{$search}%' or
			titulo LIKE '%{$search}%' or
			nombre LIKE '%{$search}%' or
			contenido LIKE '%{$search}%' or
			fecha LIKE '%{$search}%' or
			es_respuesta like '%{$search}%' or
			verificado like '%{$search}%' or
			denuncia like '%{$search}%' ";
		}


		$sql = "select CAST(epc.id_comentario AS text),ep.titulo,e.nombre,e.cod_ceta,epc.contenido,CAST(epc.fecha AS text)
		, case when epc.id_respuesta is null then 'No' else cast(epc.id_respuesta as text) end as es_respuesta
		, case when epc.verificado then 'Aprobado' else 'Pendiente' end as verificado
		, case when epc.denuncia then 'Si' else 'No' end as denuncia
		from est_post_comentario as epc
		inner join est_post as ep on ep.id_post = epc.id_post
		inner join (
			select CONCAT(nombres,' ',ap_paterno,' ',ap_materno) as nombre,cod_ceta
			from estudiante
		) as e on e.cod_ceta = epc.cod_ceta ";

		if($type == '1') {
			$sql.=' where epc.verificado = FALSE ';
		} else {
			if($type == '2') {
				$sql.=' where epc.verificado = TRUE ';
			}
		}
		
		$consulta_count = $this->db->query(sprintf($full_query_count,$sql,$query_search));
		$query_num_record = $consulta_count->row()->counted;

		if(isset($colum_order) and isset($col_dir)) {
			$query_search.=" order by {$colum_order} {$col_dir}";
		}

		if($length != '-1') {
			
			$query_search.=" limit $length OFFSET $start ";
		}

		$consulta=$this->db->query(sprintf($query_records_pag,$sql,$query_search));
		$retornar = array(
			'numDataTotal' => $query_num_record,
			'datos' => $consulta
		);

		return $retornar;
	}
}

?>