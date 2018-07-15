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
	public function get_caja($username)
	{
		//$this->db->pg_select(connection, table_name, assoc_array)
		$this->db->select('monto,estado_caja');
		$this->db->where('usuario_asignado',$username);//nombre del campo
		$this->db->where('fecha',date('Y-m-d'));
		$q=$this->db->get('caja');//nombre de la tabla
		if($q->num_rows()>0)
		{
			$fila=$q->row();	
			return $fila->monto.'/'.$fila->estado_caja;			
		} 
		else
		{
			return null;
		}
	}
	public function abrir_caja($usuario)
	{
		$fecha=date('Y-m-d');
		$where = array(
			'usuario_asignado' =>$usuario, 
			'fecha' =>$fecha,
		);
		$hora_apertura=date('H:i:s');
		$data = array(	
			'hora_apertura' =>$hora_apertura,
			'estado_caja' =>'abierta',
		);
		if($this->config_model->update_table('caja',$data,$where))
				{ echo 'exito';}
			else
				{echo 'No se actualizaron los datos de la Dosificación!!!';}	
		
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
		$sql="SELECT id_aviso, titulo, descripcion, url_imagen, fecha_ini, fecha_fin, activo FROM est_avisos ORDER BY id_aviso";
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
				// $error = $this->db->error();					  
				// print_r($error);					  
				return false;
		}
	}

	public function exist_titulo($titulo) {
		$this->db->select('titulo')->where('titulo',$titulo);
		$consulta = $this->db->get('entrada');

		return $consulta->num_rows() > 0;
	}
	public function exist_enlace($enlace) {
		$this->db->select('enlace')->where('enlace',$enlace);
		$consulta = $this->db->get('entrada');

		return $consulta->num_rows() > 0;
	}
	//Inserta un array asociativo en la bd
	public function insertArray($table,$data_array) {
		$this->db->insert($table, $data_array);
	}

	public function get_list_post() {
		$this->db->order_by("fecha", "desc");
		$query = $this->db->get('entrada'); 

		return $query->result();
	}
}

?>