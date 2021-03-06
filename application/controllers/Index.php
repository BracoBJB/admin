<?php



class Index extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('Fechas');
	}

	public function index()
	{
		// $this->session->sess_destroy();

		$n_user=(isset($_POST['n_user'])) ? $_POST['n_user'] : ((isset($_GET['n_user'])) ? $_GET['n_user'] : '');
		if($this->session->userdata('username'))
		{
			$tipo=$this->session->userdata('tipo');
			redirect('main');
		}
			
		$this->form_validation->set_rules('n_user', 'Usuario','required|min_length[4]');
		if($this->form_validation->run()== true)
		{		
			if(isset($_POST['contrasenia']))
			{			

				$tipo_usuario=$this->consultas->login_admin($_POST['n_user'],md5($_POST['contrasenia']));
				if(!is_null($tipo_usuario))
				{
					if($tipo_usuario=='false') //si se encuentra deshabilitado
					{
						$data = array('n_user' => $n_user,'habilitado'=>'false');
						$this->load->view('index',$data); 
					}
					else //si esta habilitado
					{
						$usuario=$this->consultas->name_user($_POST['n_user']);

						$this->session->set_userdata('usernamefull',$usuario);				
						$this->session->set_userdata('username',$_POST['n_user']);				
						$this->session->set_userdata('tipo',$tipo_usuario);				
						redirect('main');
					}					

				}else
				{		
					$data = array('n_user' => $n_user,'habilitado'=>'');
					$this->load->view('index',$data); 	
				}
			}
		}
		else
		{
			$data = array('n_user' => $n_user,'habilitado'=>'validado');
			$this->load->view('index',$data); 	
		}
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('index');
	}
}
?>