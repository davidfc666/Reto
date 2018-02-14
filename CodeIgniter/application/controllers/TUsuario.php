<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TUsuario extends CI_Controller {

	/*--------------------CONSTRUCTOR------------------*/

	function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->helper('url');			
		$this->load->model('TUsuario_model');
		$this->load->model('Centro_model');
		$this->load->model('Usuario_model');
		$this->load->library('session');	
	}

	/*--------------------FIN CONSTRUCTOR------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN INDEX------------------*/

	public function index()
	{
		//Lista los tipos de usuarios.
		$datos['tipos'] = $this->TUsuario_model->obtener_tusuarios();

		//Selecciona el usuario que se ha logueado.
		$usuario_session = $this->session->userdata('id');
		//$usuario_session = 5;

		//Obtiene el usuario y el centro del usuario que se ha logueado.
		$datos['centroUsuario'] = $this->Centro_model->obtener_centro_usuario($usuario_session);

		$datos['usuario'] = $this->Usuario_model->obtener_usuario($usuario_session);

		//Carga la cabecera con los datos del usuario logueado.
		$this->load->view('header_superadmin', $datos);

		//Carga la vista "listar_tusuario" pasandole los datos (tipos).
		$this->load->view('tusuario/listar_tusuario',$datos);

		//Carga el footer.
		$this->load->view('footer');

	}

	/*--------------------FIN FUNCIÓN INDEX------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN NUEVO TIPO USUARIO------------------*/

	public function nuevo_tusuario()
	{
		//Lista los tipos de usuarios.
		$datos['tipos'] = $this->TUsuario_model->obtener_tusuarios();

		//Selecciona el usuario que se ha logueado.
		$usuario_session = $this->session->userdata('id');
		//$usuario_session = 5;

		//Obtiene el usuario y el centro del usuario que se ha logueado.
		$datos['centroUsuario'] = $this->Centro_model->obtener_centro_usuario($usuario_session);

		$datos['usuario'] = $this->Usuario_model->obtener_usuario($usuario_session);

		//Carga la cabecera con los datos del usuario logueado.
		$this->load->view('header_superadmin', $datos);

		//Carga la vista "nuevo_tusuario" pasandole los datos (tipos).
		$this->load->view('tusuario/nuevo_tusuario',$datos);

		//Carga el footer.
		$this->load->view('footer');

		//Si se ha mandado el formulario.
		if(isset($_POST['Crear'])){

			//Array con los datos del nuevo tipo de usuario.
			$datosNuevo = array(
				'DESC_TUsuario' => $this->input->post('DESC_TUsuario'),
			);

			//Manda a "nuevo_tusuario" de "TUsuario_model.php" el array "datosNuevo" para añadir un nuevo tipo de usuario a la base de datos.
			$tusuarioNuevo = $this->TUsuario_model->nuevo_tusuario($datosNuevo);
		}
	}

	/*--------------------FIN FUNCIÓN NUEVO TIPO USUARIO------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN BORRAR TIPO USUARIO------------------*/

	public function borrar_tusuario()
	{		
		//Manda el tipo de usuario seleccionado a borrar_tusuario.
	 	$idtusuarioBorrar=$this->uri->segment(3);
	 	$this->TUsuario_model->borrar_tusuario($idtusuarioBorrar);

	 	//Redirije a la página principal.
	 	redirect('TUsuario');
	}

	/*--------------------FIN FUNCIÓN BORRAR TIPO USUARIO------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN EDITAR TIPO USUARIO------------------*/

	public function editar_tusuario()
	{
		//Obtener los datos del tipo de usuario seleccionado.
		$datosEditar['segmento'] = $this->uri->segment(3);
		$datosEditar['tipo'] = $this->TUsuario_model->obtener_tusuario($datosEditar['segmento']);

		//Selecciona el usuario que se ha logueado.
		$usuario_session = $this->session->userdata('id');
		//$usuario_session = 5;

		//Obtiene el usuario y el centro del usuario que se ha logueado.
		$datos['centroUsuario'] = $this->Centro_model->obtener_centro_usuario($usuario_session);

		$datos['usuario'] = $this->Usuario_model->obtener_usuario($usuario_session);

		//Carga la cabecera con los datos del usuario logueado.
		$this->load->view('header_superadmin', $datos);

		//Cargar la vista pasandole los datos del tipo de usuario seleccionado.
		$this->load->view('tusuario/editar_tusuario', $datosEditar);

		//Carga el footer.
		$this->load->view('footer');
	}

	/*--------------------FIN FUNCIÓN EDITAR TIPO USUARIO------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN GUARDAR CAMBIOS TIPO USUARIO------------------*/

	public function guardar_cambios_tusuario()
	{
		//Array con los datos del tipo de usuario actualizado.
		$datosActualizado = array(
			'DESC_TUsuario' => $this->input->post('DESC_TUsuario'),
		);


		//Manda el tipo de usuario seleccionado a guardar_cambios_tusuario.
	 	$idtusuarioActualizar=$this->uri->segment(3);
	 	$this->TUsuario_model->guardar_cambios_tusuario($idtusuarioActualizar,$datosActualizado);


	 	//Redirije a la página principal.
	 	redirect('TUsuario');
	}

	/*--------------------FIN FUNCIÓN GUARDAR CAMBIOS TIPO USUARIO------------------*/

}