<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rubrica extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->helper('url');	
		$this->load->model('Reto_model');
		$this->load->model('Alumno_model');
		$this->load->model('Centro_model');
		$this->load->model('Competencia_model');
		$this->load->library('session');
	}



	public function consultar_rubricas_alumno (){
		$alumno_sesion = $this->session->userdata('id');

		$datos['competencias'] = $this->Competencia_model->obtener_competencias();
		$datos['centro'] =$this->Centro_model->obtener_centro_alumno($alumno_sesion);
		$datos['usuario'] =$this->Alumno_model->obtener_nombre($alumno_sesion);

		$datos['pagina'] = 'Rubrica';
		$this->load->view('header_alumno',$datos);	
		$this->load->view('rubrica/consulta',$datos);
		$this->load->view('footer');
	}



	public function consultar_rubricas_profesor (){
		$alumno_sesion = $this->session->userdata('id');

		$datos['competencias'] = $this->Competencia_model->obtener_competencias();
		$datos['centro'] =$this->Centro_model->obtener_centro_alumno($alumno_sesion);
		$datos['profesor'] =$this->Alumno_model->obtener_nombre($alumno_sesion);

		$datos['pagina'] = 'Rubrica';
		$this->load->view('header_profesor',$datos);	
		$this->load->view('rubrica/consulta',$datos);
		$this->load->view('footer');
	}


}