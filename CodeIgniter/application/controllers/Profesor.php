<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profesor extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->model('Centro_model');
		$this->load->model('Usuario_model');
		$this->load->model('Curso_model');
		$this->load->model('Modulo_model');
		$this->load->model('Reto_model');
		$this->load->model('Equipo_model');
		$this->load->model('Competencia_model');
		$this->load->model('Nota_model');
		$this->load->library('session');
	}

	public function index(){
		$id = $this->session->userdata('id');
		$lg = $this->Usuario_model->Usuario_profesor($id);
		if($lg){
			$datos['profesor'] = $this->Usuario_model->obtener_nombre($id);
			$datos['centro'] =$this->Centro_model->obtener_centro_alumno($id);
			$datos['cursos'] = $this->Curso_model->obtener_cursos();
			$this->load->view('header_profesor',$datos);
			$this->load->view('profesor/retos_profesor',$datos);
			$this->load->view('footer');
		}else{
			redirect(base_url());
		}
	}

	public function rubricas(){
		$id = $this->session->userdata('id');
		$lg = $this->Usuario_model->Usuario_profesor($id);
		if($lg){
			$datos['profesor'] = $this->Usuario_model->obtener_nombre($id);
			$datos['centro'] =$this->Centro_model->obtener_centro_alumno($id);
			$datos['cursos'] = $this->Curso_model->obtener_cursos();
			$this->load->view('header_profesor',$datos);
			$this->load->view('profesor/rubricas_profesor',$datos);
			$this->load->view('footer');
		}else{
			redirect(base_url());
		}
	}

	public function evaluar(){
		$id = $this->session->userdata('id');
		$lg = $this->Usuario_model->Usuario_profesor($id);
		if($lg){
			$idreto = $this->uri->segment(3);
			$datos['profesor'] = $this->Usuario_model->obtener_nombre($id);
			$datos['centro'] =$this->Centro_model->obtener_centro_alumno($id);
			$datos['equipos'] = $this->Equipo_model->obtener_equipo_reto($idreto);
			$datos['ID_Reto'] = $idreto;
			/**/
			unset( $_SESSION["idreto"] );  
			$_SESSION["idreto"] = ""; 
			$this->session->set_userdata('idreto', $idreto);
			/**/
			$datos['COD_Reto'] = $this->Reto_model->obtener_nombre($idreto);
			$this->load->view('header_profesor',$datos);		
			$this->load->view('profesor/evaluar_profesor',$datos);
			$this->load->view('footer');
		}else{
			redirect(base_url());
		}
	}

	public function evaluaruser(){
		$id = $this->session->userdata('id');
		$lg = $this->Usuario_model->Usuario_profesor($id);
		if($lg){
			$iduser = $this->uri->segment(3);
			$datos['profesor'] = $this->Usuario_model->obtener_nombre($id);
			$datos['centro'] =$this->Centro_model->obtener_centro_alumno($id);
			$this->load->view('header_profesor',$datos);		
			$this->load->view('profesor/evaluar_user',$datos);
			$this->load->view('footer');
		}else{
			redirect(base_url());
		}
	}
	//PESTAÑA DE EVALUACION SOBRE EL ALUMNO ESTABLECIDO
	public function evaluserindi(){
		$idreto = $this->session->userdata('idreto');
		$id = $this->session->userdata('id');
		$lg = $this->Usuario_model->Usuario_profesor($id);
		if($lg){
			$datos['competencias'] = $this->Competencia_model->obtener_competencias_profesor();
			$datos['alumno'] = $this->Usuario_model->obtener_usuario($this->uri->segment(3));
			$datos['profesor'] = $this->Usuario_model->obtener_nombre($id);
			$datos['centro'] =$this->Centro_model->obtener_centro_alumno($id);
			$this->load->view('header_profesor',$datos);		
			$this->load->view('profesor/evaluar_individual',$datos);
			$this->load->view('footer');
		}else{
			redirect(base_url());
		}
	}

		public function agregar_evaluacion(){
		$id = $this->session->userdata('id');
		$lg = $this->Usuario_model->Usuario_profesor($id);
		if($lg){
			$idreto = $this->session->userdata('idreto');
			$ID_Competencia = $this->input->post('ID_Competencia');
			//$ID_Grupo = $this->input->post('ID_Grupo');
			$Nota = $this->input->post('Nota');
			$ID_User = $this->input->post('ID_User');

			
			$ID_Nota = $this->Nota_model->obtener_nota_alumno($idreto, $ID_User, $ID_Competencia);


			

			if($ID_Nota > 0){
				//ACTUALIZA LAS NOTAS
				$this->Nota_model->actualizar_nota_profesor($ID_Nota, $Nota, $id, $ID_Competencia);
			}else{
				//CREA E INSERTA LAS NOTAS DEL ALUMNO
				$this->Nota_model->agregar_notas_profesor($idreto, $ID_User, $ID_Competencia, $Nota, $id);
			}


		}else{
			redirect(base_url());
		}
	}

}