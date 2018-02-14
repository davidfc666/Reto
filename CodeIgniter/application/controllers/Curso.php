<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Curso extends CI_Controller {

	/*--------------------CONSTRUCTOR------------------*/

	function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->helper('url');			
		$this->load->model('Curso_model');	
		$this->load->model('Centro_model');	
		$this->load->model('Usuario_model');	
		$this->load->library('session');
	}

	/*--------------------FIN CONSTRUCTOR------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN INDEX------------------*/

	public function index()
	{
		//Lista los cursos.
		$datos['cursos'] = $this->Curso_model->obtener_cursos();

		//Selecciona el usuario que se ha logueado.
		$usuario_session = $this->session->userdata('id');
		//$usuario_session = 5;

		//Obtiene el usuario y el centro del usuario que se ha logueado.
		$datos['centroUsuario'] = $this->Centro_model->obtener_centro_usuario($usuario_session);

		$datos['usuario'] = $this->Usuario_model->obtener_usuario($usuario_session);

		$datos['pagina'] = 'Curso';

		//Carga la cabecera con los datos del usuario logueado.
		$this->load->view('header_superadmin', $datos);
		
		//Carga la vista "listar_curso" pasandole los datos (cursos).
		$this->load->view('curso/listar_curso',$datos);

		//Carga el footer.
		$this->load->view('footer');

	}

	/*--------------------FIN FUNCIÓN INDEX------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN NUEVO CURSO------------------*/

	public function nuevo_curso()
	{
		//Lista los cursos.
		$datos['cursos'] = $this->Curso_model->obtener_cursos();

		//Selecciona el usuario que se ha logueado.
		$usuario_session = $this->session->userdata('id');
		//$usuario_session = 5;

		//Obtiene el usuario y el centro del usuario que se ha logueado.
		$datos['centroUsuario'] = $this->Centro_model->obtener_centro_usuario($usuario_session);

		$datos['usuario'] = $this->Usuario_model->obtener_usuario($usuario_session);

		$datos['pagina'] = 'Curso';

		//Carga la cabecera con los datos del usuario logueado.
		$this->load->view('header_superadmin', $datos);

		//Carga la vista "nuevo_curso" pasandole los datos (cursos).
		$this->load->view('curso/nuevo_curso',$datos);

		//Carga el footer.
		$this->load->view('footer');

		//Si se ha mandado el formulario.
		if(isset($_POST['Crear'])){

			//Array con los datos del nuevo curso.
			$datosNuevo = array(
				'COD_Curso' => $this->input->post('COD_Curso'),
			);

			//Manda a "nuevo_curso" de "Curso_model.php" el array "datosNuevo" para añadir un nuevo curso a la base de datos.
			$cursoNuevo = $this->Curso_model->nuevo_curso($datosNuevo);
		}
	}

	/*--------------------FIN FUNCIÓN NUEVO CURSO------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN BORRAR CURSO------------------*/

	public function borrar_curso()
	{		
		//Manda el curso seleccionado a borrar_curso.
	 	$idcursoBorrar=$this->uri->segment(3);
	 	$this->Curso_model->borrar_curso($idcursoBorrar);

	 	//Redirije a la página principal.
	 	redirect('Curso');
	}

	/*--------------------FIN FUNCIÓN BORRAR CURSO------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN EDITAR CURSO------------------*/

	public function editar_curso()
	{
		//Obtener los datos del curso seleccionado.
		$datosEditar['segmento'] = $this->uri->segment(3);
		$datosEditar['curso'] = $this->Curso_model->obtener_curso($datosEditar['segmento']);

		//Selecciona el usuario que se ha logueado.
		$usuario_session = $this->session->userdata('id');
		//$usuario_session = 5;

		//Obtiene el usuario y el centro del usuario que se ha logueado.
		$datos['centroUsuario'] = $this->Centro_model->obtener_centro_usuario($usuario_session);

		$datos['usuario'] = $this->Usuario_model->obtener_usuario($usuario_session);

		$datos['pagina'] = 'Curso';

		//Carga la cabecera con los datos del usuario logueado.
		$this->load->view('header_superadmin', $datos);

		//Cargar la vista pasandole los datos del curso seleccionado.
		$this->load->view('curso/editar_curso', $datosEditar);

		//Carga el footer.
		$this->load->view('footer');
	}

	/*--------------------FIN FUNCIÓN EDITAR CURSO------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN GUARDAR CAMBIOS CURSO------------------*/

	public function guardar_cambios_curso()
	{
		//Array con los datos del curso actualizado.
		$datosActualizado = array(
			'COD_Curso' => $this->input->post('COD_Curso'),
		);


		//Manda el curso seleccionado a borrar_curso.
	 	$idcursoActualizar=$this->uri->segment(3);
	 	$this->Curso_model->guardar_cambios_curso($idcursoActualizar,$datosActualizado);


	 	//Redirije a la página principal.
	 	redirect('Curso');
	}

	/*--------------------FIN FUNCIÓN GUARDAR CAMBIOS CURSO------------------*/

}