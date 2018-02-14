<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Centro extends CI_Controller {

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
		$datos['centros'] = $this->Centro_model->obtener_centros();

		//Selecciona el usuario que se ha logueado.
		$usuario_session = $this->session->userdata('id');
		//$usuario_session = 5;

		//Obtiene el usuario y el centro del usuario que se ha logueado.
		$datos['centroUsuario'] = $this->Centro_model->obtener_centro_usuario($usuario_session);

		$datos['usuario'] = $this->Usuario_model->obtener_usuario($usuario_session);

		$datos['pagina'] = 'Centro';

		//Carga la cabecera con los datos del usuario logueado.
		$this->load->view('header_superadmin', $datos);

		//Carga la vista "listar_centro" pasandole los datos (centros).
		$this->load->view('centro/listar_centro',$datos);

		//Carga el footer.
		$this->load->view('footer');

	}

	/*--------------------FIN FUNCIÓN INDEX------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN CENTROS------------------*/
	
	public function obtener_centros()
	{	
		//Función que mediante Ajax obtiene los centros.
	 	$centros=$this->Centro_model->obtener_centros();
 		echo json_encode($centros->result());
	}

	/*--------------------FIN FUNCIÓN CENTROS------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN NUEVO CENTRO------------------*/

	public function nuevo_centro()
	{
		//Lista los cursos.
		$datos['cursos'] = $this->Curso_model->obtener_cursos();

		//Selecciona el usuario que se ha logueado.
		$usuario_session = $this->session->userdata('id');
		//$usuario_session = 5;

		//Obtiene el usuario y el centro del usuario que se ha logueado.
		$datos['centroUsuario'] = $this->Centro_model->obtener_centro_usuario($usuario_session);

		$datos['usuario'] = $this->Usuario_model->obtener_usuario($usuario_session);

		$datos['pagina'] = 'Centro';

		//Carga la cabecera con los datos del usuario logueado.
		$this->load->view('header_superadmin', $datos);

		//Carga la vista "nuevo_centro" pasandole los datos (cursos).
		$this->load->view('centro/nuevo_centro',$datos);

		//Carga el footer.
		$this->load->view('footer');

		//Si se ha mandado el formulario.
		if(isset($_POST['Crear'])){

			//Array con los datos del nuevo centro.
			$datosNuevo = array(
				'COD_Centro' => $this->input->post('COD_Centro'),
				'DESC_Centro' => $this->input->post('DESC_Centro'),
			);

			//Manda a "nuevo_centro" de "Centro_model.php" el array "datosNuevo" para añadir un nuevo centro a la base de datos.
			$centroNuevo = $this->Centro_model->nuevo_centro($datosNuevo);

			//Muestra mensaje de confirmación.
			$this->session->set_flashdata('mensajeCrear','¡Centro creado correctamente!');


	    	//Recarga la página.

		}
	}

	/*--------------------FIN FUNCIÓN NUEVO CENTRO------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN BORRAR CENTRO------------------*/

	public function borrar_centro()
	{		
		//Manda el centro seleccionado a borrar_centro.
	 	$idcentroBorrar=$this->uri->segment(3);
	 	$this->Centro_model->borrar_centro($idcentroBorrar);

	 	//Redirije a la página principal.
	 	redirect('Centro');
	}

	/*--------------------FIN FUNCIÓN BORRAR CENTRO------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN EDITAR CENTRO------------------*/

	public function editar_centro()
	{
		//Obtener los datos del centro seleccionado.
		$datosEditar['segmento'] = $this->uri->segment(3);
		$datosEditar['centro'] = $this->Centro_model->obtener_centro($datosEditar['segmento']);

		//Selecciona el usuario que se ha logueado.
		$usuario_session = $this->session->userdata('id');
		//$usuario_session = 5;

		//Obtiene el usuario y el centro del usuario que se ha logueado.
		$datos['centroUsuario'] = $this->Centro_model->obtener_centro_usuario($usuario_session);

		$datos['usuario'] = $this->Usuario_model->obtener_usuario($usuario_session);

		$datos['pagina'] = 'Centro';

		//Carga la cabecera con los datos del usuario logueado.
		$this->load->view('header_superadmin', $datos);

		//Cargar la vista pasandole los datos del centro seleccionado.
		$this->load->view('centro/editar_centro', $datosEditar);

		//Carga el footer.
		$this->load->view('footer');
	}

	/*--------------------FIN FUNCIÓN EDITAR CENTRO------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN GUARDAR CAMBIOS CENTRO------------------*/

	public function guardar_cambios_centro()
	{
		//Array con los datos del centro actualizado.
		$datosActualizado = array(
			'COD_Centro' => $this->input->post('COD_Centro'),
			'DESC_Centro' => $this->input->post('DESC_Centro'),
		);


		//Manda el centro seleccionado a guardar_cambios_centro.
	 	$idcentroActualizar=$this->uri->segment(3);
	 	$this->Centro_model->guardar_cambios_centro($idcentroActualizar,$datosActualizado);


	 	//Redirije a la página principal.
	 	redirect('Centro');
	}

	/*--------------------FIN FUNCIÓN GUARDAR CAMBIOS CENTRO------------------*/

}