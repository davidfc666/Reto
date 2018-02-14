<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->library('encryption');
		$this->load->library('session');
		$this->load->model('Reto_model');
		$this->load->model('Alumno_model');
		$this->load->model('Curso_model');
		$this->load->model('Centro_model');
		$this->load->model('Usuario_model');
		$this->load->model('Competencia_model');
		$this->load->model('Nota_model');
		$this->load->library("form_validation");
	}

	public function index()
	{
		$this->session->sess_destroy();
		$this->load->view('header');
		$this->load->view('login');
		$this->load->view('footer');
	}
	public function conexion_usuario(){
		//Comprobar que estan los campos validados
		//Nuevo
        $this->form_validation->set_rules('User', 'User', 'required');
        $this->form_validation->set_rules('Password', 'Password', 'required');
        if ($this->form_validation->run() === FALSE) 
        {
           	$_SESSION['mensaje'] = "introduce todos los datos.";
			redirect(base_url() . "index.php/Login/error");
        }
        //
		$datos = array(
			'User' => $this->input->post('User'),
			'Password' => $this->input->post('Password'),
		);
		$datos['usuario'] = $this->Usuario_model->login_usuario($datos);
		if($datos['usuario']){
			$this->session->set_userdata('id', $datos['usuario']->result()[0]->ID_Usuario);
			redirect(base_url() . "index.php/Login/" . $datos['usuario']->result()[0]->DESC_TUsuario);
		}else{
			$_SESSION['mensaje'] = "login incorrecto.";
			redirect(base_url() . "index.php/Login/error");
		}
	}
	public function error(){
		$mensaje=null;
        if(isset($_SESSION['mensaje'])){
            $mensaje=$_SESSION['mensaje'];
            unset($_SESSION['mensaje']);
        }
        $datos['mensaje']=$mensaje;
		$this->load->view('header');
		$this->load->view('login');
		$this->load->view('errors/errorconexion.php', $datos);
		$this->load->view('footer');
	}


	public function Admin_Centro(){	

		//Selecciona el usuario que se ha logueado.
		$usuario_session = $this->session->userdata('id');
		//$usuario_session = 5;

		//Obtiene el usuario y el centro del usuario que se ha logueado.
		$datosAdmin['centroUsuario'] = $this->Centro_model->obtener_centro_usuario($usuario_session);

		$datosAdmin['usuario'] = $this->Usuario_model->obtener_usuario($usuario_session);

		//Carga la cabecera con los datos del usuario logueado.
		$this->load->view('header_admin', $datosAdmin);
		$this->load->view('panel_admin', $datosAdmin);
		$this->load->view('footer');
	}

	public function Administrador(){
		
		//Selecciona el usuario que se ha logueado.
		$usuario_session = $this->session->userdata('id');
		//$usuario_session = 5;

		//Obtiene el usuario y el centro del usuario que se ha logueado.
		$datosAdmin['centroUsuario'] = $this->Centro_model->obtener_centro_usuario($usuario_session);

		$datosAdmin['usuario'] = $this->Usuario_model->obtener_usuario($usuario_session);

		//Carga la cabecera con los datos del usuario logueado.
		$this->load->view('header_superadmin', $datosAdmin);
		$this->load->view('panel_superadmin', $datosAdmin);
		$this->load->view('footer');
	}

	public function Alumno(){
		$alumno_sesion = $this->session->userdata('id');



		$datos['cursos'] = $this->Curso_model->obtener_cursos();
		$datos['centro'] =$this->Centro_model->obtener_centro_alumno($alumno_sesion);

		$datos['usuario'] =$this->Alumno_model->obtener_nombre($alumno_sesion);
		//$datos['retos'] = $this->Reto_model->obtener_retos_usu($alumno_sesion);
		
			
		$this->load->view('header_alumno',$datos);		
		$this->load->view('alumno/panel_alumno',$datos);
		$this->load->view('footer');
	}

	public function Profesor(){
		$id = $this->session->userdata('id');
		$lg = $this->Usuario_model->Usuario_profesor($id);
		if($lg){
			$datos['profesor'] = $this->Usuario_model->obtener_nombre($id);
			$datos['cursos'] = $this->Curso_model->obtener_cursos();
			$datos['centro'] =$this->Centro_model->obtener_centro_alumno($id);
			$this->load->view('header_profesor',$datos);
			$this->load->view('profesor/retos_profesor',$datos);
			$this->load->view('footer');
		}else{
			redirect(base_url());
		}
	}
}