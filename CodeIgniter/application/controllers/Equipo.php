<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Equipo extends CI_Controller {

	/*--------------------CONSTRUCTOR------------------*/

	function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->helper('url');			
		$this->load->model('Curso_model');				
		$this->load->model('Centro_model');			
		$this->load->model('Ciclo_model');
		$this->load->model('Modulo_model');
		$this->load->model('Reto_Modulo_model');	
		$this->load->model('Usuario_model');
		$this->load->model('Equipo_model');
		$this->load->library('session');
	}

	/*--------------------FIN CONSTRUCTOR------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN INDEX------------------*/

	public function index()
	{
		//Lista los cursos.
		$datosCurso['cursos'] = $this->Curso_model->obtener_cursos();

		//Selecciona el usuario que se ha logueado.
		$usuario_session = $this->session->userdata('id');
		//$usuario_session = 5;

		//Obtiene el usuario y el centro del usuario que se ha logueado.
		$datosCurso['centroUsuario'] = $this->Centro_model->obtener_centro_usuario($usuario_session);

		$datosCurso['usuario'] = $this->Usuario_model->obtener_usuario($usuario_session);

		$datosCurso['pagina'] = 'Equipo';

		//Carga la cabecera con los datos del usuario logueado.
		$this->load->view('header_superadmin', $datosCurso);

		//Carga la vista "listar_equipo" pasandole los datos (cursos).
		$this->load->view('equipo/listar_equipo',$datosCurso);

		//Carga el footer.
		$this->load->view('footer');

	}

	/*--------------------FIN FUNCIÓN INDEX------------------*/


		public function equipo_usuarios_json(){
		$id=$this->input->post('ID_Equipo');
		$equipouser=$this->Equipo_model->obtener_equipo_usuarios($id);

		echo json_encode($equipouser->result());
	}


	/*--------------------FUNCIÓN EQUIPO_ADMIN------------------*/

	public function equipo_admin()
	{
		//Lista los cursos.
		$datosCurso['cursos'] = $this->Curso_model->obtener_cursos();

		//Selecciona el usuario que se ha logueado.
		$usuario_session = $this->session->userdata('id');
		//$usuario_session = 5;

		//Obtiene el usuario y el centro del usuario que se ha logueado.
		$datosCurso['centroUsuario'] = $this->Centro_model->obtener_centro_usuario($usuario_session);

		$datosCurso['usuario'] = $this->Usuario_model->obtener_usuario($usuario_session);

		$datosCurso['pagina'] = 'Equipo';

		//Carga la cabecera con los datos del usuario logueado.
		$this->load->view('header_admin', $datosCurso);

		//Carga la vista "listar_equipo" pasandole los datos (cursos).
		$this->load->view('equipo/listar_equipo_admin',$datosCurso);

		//Carga el footer.
		$this->load->view('footer');

	}

	/*--------------------FIN FUNCIÓN EQUIPO_ADMIN------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN EQUIPOS------------------*/

	public function obtener_equipos()
	{		
		//Función que mediante Ajax pasandole a la función "obtener_equipos" de "Equipo_model.php" el parámetro "ID_Reto" obtiene los equipos.
	 	$idreto=$this->input->post('ID_Reto');
	 	$equipos=$this->Equipo_model->obtener_equipos($idreto);
 		echo json_encode($equipos->result());
	}

	/*--------------------FIN FUNCIÓN EQUIPOS------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN NUEVO EQUIPO------------------*/

	public function nuevo_equipo()
	{
		//Lista los cursos.
		$datosEquipo['cursos'] = $this->Curso_model->obtener_cursos();

		//Selecciona el usuario que se ha logueado.
		$usuario_session = $this->session->userdata('id');
		//$usuario_session = 5;

		//Obtiene el usuario y el centro del usuario que se ha logueado.
		$datosEquipo['centroUsuario'] = $this->Centro_model->obtener_centro_usuario($usuario_session);

		$datosEquipo['usuario'] = $this->Usuario_model->obtener_usuario($usuario_session);

		$datosEquipo['pagina'] = 'Equipo';

		//Carga la cabecera con los datos del usuario logueado.
		$this->load->view('header_superadmin', $datosEquipo);

		//Carga la vista "nuevo_equipo" pasandole los datos (cursos).
		$this->load->view('equipo/nuevo_equipo',$datosEquipo);

		//Carga el footer.
		$this->load->view('footer');

		//Si se ha mandado el formulario.
		if(isset($_POST['Crear'])){

			//Array con los datos del nuevo equipo.
			$datosNuevo = array(
				'ID_Reto' => $this->input->post('ID_Reto_Formulario'),
				'COD_Equipo' => $this->input->post('COD_Equipo'),
				'DESC_Equipo' => $this->input->post('DESC_Equipo'),
			);

			//Manda a "nuevo_equipo" de "Equipo_model.php" el array "datosNuevo" para añadir un nuevo equipo a la base de datos.
			$equipoNuevo = $this->Equipo_model->nuevo_equipo($datosNuevo);


		}
	}

	/*--------------------FIN FUNCIÓN NUEVO EQUIPO------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN NUEVO EQUIPO ADMIN------------------*/

	public function nuevo_equipo_admin()
	{
		//Lista los cursos.
		$datosEquipo['cursos'] = $this->Curso_model->obtener_cursos();

		//Selecciona el usuario que se ha logueado.
		$usuario_session = $this->session->userdata('id');
		//$usuario_session = 5;

		//Obtiene el usuario y el centro del usuario que se ha logueado.
		$datosEquipo['centroUsuario'] = $this->Centro_model->obtener_centro_usuario($usuario_session);

		$datosEquipo['usuario'] = $this->Usuario_model->obtener_usuario($usuario_session);

		$datosEquipo['pagina'] = 'Equipo';

		//Carga la cabecera con los datos del usuario logueado.
		$this->load->view('header_admin', $datosEquipo);

		//Carga la vista "nuevo_equipo" pasandole los datos (cursos).
		$this->load->view('equipo/nuevo_equipo_admin',$datosEquipo);

		//Carga el footer.
		$this->load->view('footer');

		//Si se ha mandado el formulario.
		if(isset($_POST['Crear'])){

			//Array con los datos del nuevo equipo.
			$datosNuevo = array(
				'ID_Reto' => $this->input->post('ID_Reto_Formulario'),
				'COD_Equipo' => $this->input->post('COD_Equipo'),
				'DESC_Equipo' => $this->input->post('DESC_Equipo'),
			);

			//Manda a "nuevo_equipo" de "Equipo_model.php" el array "datosNuevo" para añadir un nuevo equipo a la base de datos.
			$equipoNuevo = $this->Equipo_model->nuevo_equipo($datosNuevo);


		}
	}

	/*--------------------FIN FUNCIÓN NUEVO EQUIPO ADMIN------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN BORRAR EQUIPO------------------*/

	public function borrar_equipo()
	{		
		//Manda el equipo seleccionado a borrar_equipo.
	 	$idequipoBorrar=$this->uri->segment(3);
	 	$this->Equipo_model->borrar_equipo($idequipoBorrar);

	 	//Redirije a la página principal.
	 	redirect('Equipo');
	}

	/*--------------------FIN FUNCIÓN BORRAR EQUIPO------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN BORRAR EQUIPO ADMIN------------------*/

	public function borrar_equipo_admin()
	{		
		//Manda el equipo seleccionado a borrar_equipo.
	 	$idequipoBorrar=$this->uri->segment(3);
	 	$this->Equipo_model->borrar_equipo($idequipoBorrar);

	 	//Redirije a la página principal.
	 	redirect('Equipo/equipo_admin');
	}

	/*--------------------FIN FUNCIÓN BORRAR EQUIPO ADMIN------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN EDITAR EQUIPO------------------*/

	public function editar_equipo()
	{
		//Obtener los datos del equipo seleccionado.
		$datosEditar['segmento'] = $this->uri->segment(3);
		$datosEditar['equipo'] = $this->Equipo_model->obtener_equipo($datosEditar['segmento']);
		
		//Selecciona el usuario que se ha logueado.
		$usuario_session = $this->session->userdata('id');
		//$usuario_session = 5;

		//Obtiene el usuario y el centro del usuario que se ha logueado.
		$datosEquipo['centroUsuario'] = $this->Centro_model->obtener_centro_usuario($usuario_session);

		$datosEquipo['usuario'] = $this->Usuario_model->obtener_usuario($usuario_session);

		$datosEquipo['pagina'] = 'Equipo';

		//Carga la cabecera con los datos del usuario logueado.
		$this->load->view('header_superadmin', $datosEquipo);

		//Cargar la vista pasandole los datos del equipo seleccionado.
		$this->load->view('equipo/editar_equipo', $datosEditar);

		//Carga el footer.
		$this->load->view('footer');
	}

	/*--------------------FIN FUNCIÓN EDITAR EQUIPO------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN EDITAR EQUIPO ADMIN------------------*/

	public function editar_equipo_admin()
	{
		//Obtener los datos del equipo seleccionado.
		$datosEditar['segmento'] = $this->uri->segment(3);
		$datosEditar['equipo'] = $this->Equipo_model->obtener_equipo($datosEditar['segmento']);
		
		//Selecciona el usuario que se ha logueado.
		$usuario_session = $this->session->userdata('id');
		//$usuario_session = 5;

		//Obtiene el usuario y el centro del usuario que se ha logueado.
		$datosEquipo['centroUsuario'] = $this->Centro_model->obtener_centro_usuario($usuario_session);

		$datosEquipo['usuario'] = $this->Usuario_model->obtener_usuario($usuario_session);

		$datosEquipo['pagina'] = 'Equipo';

		//Carga la cabecera con los datos del usuario logueado.
		$this->load->view('header_admin', $datosEquipo);

		//Cargar la vista pasandole los datos del equipo seleccionado.
		$this->load->view('equipo/editar_equipo_admin', $datosEditar);

		//Carga el footer.
		$this->load->view('footer');
	}

	/*--------------------FIN FUNCIÓN EDITAR EQUIPO ADMIN------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN GUARDAR CAMBIOS EQUIPO------------------*/

	public function guardar_cambios_equipo()
	{
		//Array con los datos del reto actualizado.
		$datosActualizado = array(
			'COD_Equipo' => $this->input->post('COD_Equipo'),
			'DESC_Equipo' => $this->input->post('DESC_Equipo'),
		);


		//Manda el equipo seleccionado a guardar_cambios_equipo.
	 	$idequipoActualizar=$this->uri->segment(3);
	 	$this->Equipo_model->guardar_cambios_equipo($idequipoActualizar,$datosActualizado);


	 	//Redirije a la página principal.
	 	redirect('Equipo');
	}

	/*--------------------FIN FUNCIÓN GUARDAR CAMBIOS EQUIPO------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN GUARDAR CAMBIOS EQUIPO ADMIN------------------*/

	public function guardar_cambios_equipo_admin()
	{
		//Array con los datos del reto actualizado.
		$datosActualizado = array(
			'COD_Equipo' => $this->input->post('COD_Equipo'),
			'DESC_Equipo' => $this->input->post('DESC_Equipo'),
		);


		//Manda el equipo seleccionado a guardar_cambios_equipo.
	 	$idequipoActualizar=$this->uri->segment(3);
	 	$this->Equipo_model->guardar_cambios_equipo($idequipoActualizar,$datosActualizado);


	 	//Redirije a la página principal.
	 	redirect('Equipo/equipo_admin');
	}

	/*--------------------FIN FUNCIÓN GUARDAR CAMBIOS EQUIPO ADMIN------------------*/

}