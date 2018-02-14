<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reto_Modulo extends CI_Controller {

	/*--------------------CONSTRUCTOR------------------*/

	function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->helper('url');								
		$this->load->model('Curso_model');					
		$this->load->model('Centro_model');					
		$this->load->model('Modulo_model');					
		$this->load->model('Usuario_model');		
		$this->load->model('Reto_model');	
		$this->load->model('Reto_Modulo_model');
		$this->load->library('session');
	}

	/*--------------------FIN CONSTRUCTOR------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN INDEX------------------*/

	public function index()
	{
		//Lista los cursos.
		$datosRetoModulo['cursos'] = $this->Curso_model->obtener_cursos();

		//Lista los centros.
		$datosRetoModulo['centros'] = $this->Centro_model->obtener_centros();

		//Selecciona el usuario que se ha logueado.
		$usuario_session = $this->session->userdata('id');
		//$usuario_session = 5;

		//Obtiene el usuario y el centro del usuario que se ha logueado.
		$datosRetoModulo['centroUsuario'] = $this->Centro_model->obtener_centro_usuario($usuario_session);

		$datosRetoModulo['usuario'] = $this->Usuario_model->obtener_usuario($usuario_session);

		//Carga la cabecera con los datos del usuario logueado.
		$this->load->view('header_superadmin', $datosRetoModulo);

		//Carga la vista "listar_reto_modulo" pasandole los datos (cursos y centros).
		$this->load->view('reto_modulo/listar_reto_modulo',$datosRetoModulo);

		//Carga el footer.
		$this->load->view('footer');

	}

	/*--------------------FIN FUNCIÓN INDEX------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN RETO MODULO ADMIN------------------*/

	public function reto_modulo_admin()
	{
		//Lista los cursos.
		$datosRetoModulo['cursos'] = $this->Curso_model->obtener_cursos();

		//Selecciona el usuario que se ha logueado.
		$usuario_session = $this->session->userdata('id');
		//$usuario_session = 5;

		//Obtiene el usuario y el centro del usuario que se ha logueado.
		$datosRetoModulo['centroUsuario'] = $this->Centro_model->obtener_centro_usuario($usuario_session);

		$datosRetoModulo['usuario'] = $this->Usuario_model->obtener_usuario($usuario_session);

		//Carga la cabecera con los datos del usuario logueado.
		$this->load->view('header_admin', $datosRetoModulo);

		//Carga la vista "listar_reto_modulo" pasandole los datos (cursos y centros).
		$this->load->view('reto_modulo/listar_reto_modulo_admin',$datosRetoModulo);

		//Carga el footer.
		$this->load->view('footer');

	}

	/*--------------------FIN FUNCIÓN RETO MODULO ADMIN------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN RETOS MÓDULOS------------------*/

	public function obtener_retos_modulos()
	{		
		//Función que mediante Ajax pasandole a la función "obtener_retos_modulos" de "Reto_Modulo_model.php" el parámetro "ID_Modulo" obtiene los retos asignados al módulo seleccionado.
	 	$idmodulo=$this->input->post('ID_Modulo');
	 	$retos=$this->Reto_Modulo_model->obtener_retos_modulos($idmodulo);
 		echo json_encode($retos->result());
	}

	/*--------------------FIN FUNCIÓN RETOS MÓDULOS------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN OBTENER ADMINISTRADOR DEL MÓDULO SELECCIONADO------------------*/

	public function obtener_id_uadmin()
	{
		//Manda a "obtener_id_uadmin" de "Reto_Modulo_model.php" la variable "$datoModulo" para obtener el administrador del módulo seleccionado.
	 	$idmodulo=$this->input->post('ID_Modulo');
	 	$retos=$this->Reto_Modulo_model->obtener_id_uadmin($idmodulo);
 		echo json_encode($retos->result());
	}

	/*---------------------FIN FUNCIÓN OBTENER ADMINISTRADOR DEL MÓDULO SELECCIONADO----------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN OBTENER LOS DATOS DEL RETO SELECCIONADO------------------*/

	public function obtener_reto_id()
	{		
		//Función que mediante Ajax pasandole a la función "obtener_reto_id" de "Reto_Modulo_model.php" el parámetro "ID_Reto" obtiene los datos del reto seleccionado.
	 	$idreto=$this->input->post('ID_Reto');
	 	$retos=$this->Reto_Modulo_model->obtener_reto_id($idreto);
 		echo json_encode($retos->result());
	}

	/*--------------------FIN FUNCIÓN OBTENER LOS DATOS DEL RETO SELECCIONADO------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN NUEVO RETO MÓDULO------------------*/

	public function nuevo_reto_modulo()
	{
		//Lista los cursos.
		$datosRetoModulo['cursos'] = $this->Curso_model->obtener_cursos();

		//Lista los centros.
		$datosRetoModulo['centros'] = $this->Centro_model->obtener_centros();

		//Selecciona el usuario que se ha logueado.
		$usuario_session = $this->session->userdata('id');
		//$usuario_session = 5;

		//Obtiene el usuario y el centro del usuario que se ha logueado.
		$datosRetoModulo['centroUsuario'] = $this->Centro_model->obtener_centro_usuario($usuario_session);

		$datosRetoModulo['usuario'] = $this->Usuario_model->obtener_usuario($usuario_session);

		//Carga la cabecera con los datos del usuario logueado.
		$this->load->view('header_superadmin', $datosRetoModulo);

		//Carga la vista "nuevo_reto_modulo" pasandole los datos (cursos, centros y retos).
		$this->load->view('reto_modulo/nuevo_reto_modulo',$datosRetoModulo);

		//Carga el footer.
		$this->load->view('footer');
	}

	/*--------------------FIN FUNCIÓN NUEVO RETO MÓDULO------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN NUEVO RETO MÓDULO ADMIN------------------*/

	public function nuevo_reto_modulo_admin()
	{
		//Lista los cursos.
		$datosRetoModulo['cursos'] = $this->Curso_model->obtener_cursos();

		//Lista los centros.
		$datosRetoModulo['centros'] = $this->Centro_model->obtener_centros();

		//Selecciona el usuario que se ha logueado.
		$usuario_session = $this->session->userdata('id');
		//$usuario_session = 5;

		//Obtiene el usuario y el centro del usuario que se ha logueado.
		$datosRetoModulo['centroUsuario'] = $this->Centro_model->obtener_centro_usuario($usuario_session);

		$datosRetoModulo['usuario'] = $this->Usuario_model->obtener_usuario($usuario_session);

		//Carga la cabecera con los datos del usuario logueado.
		$this->load->view('header_admin', $datosRetoModulo);

		//Carga la vista "nuevo_reto_modulo" pasandole los datos (cursos, centros y retos).
		$this->load->view('reto_modulo/nuevo_reto_modulo_admin',$datosRetoModulo);

		//Carga el footer.
		$this->load->view('footer');
	}

	/*--------------------FIN FUNCIÓN NUEVO RETO MÓDULO ADMIN------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN CREAR RETO MÓDULO------------------*/

	public function nuevo_reto_modulo_crear()
	{		
		//Manda el reto y módulo seleccionado a nuevo_reto_modulo.
		$datosCrear = array(
			'ID_Reto' => $this->input->post('ID_Reto'),
			'ID_Modulo' => $this->input->post('ID_Modulo'),
			'ID_UAdmin' => $this->input->post('ID_UAdmin'),
		);

	 	$this->Reto_Modulo_model->nuevo_reto_modulo($datosCrear);

	 	//Redirije a la página principal.
	 	redirect('Reto_Modulo');
	}

	/*--------------------FIN FUNCIÓN CREAR RETO MÓDULO------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN CREAR RETO MÓDULO ADMIN------------------*/

	public function nuevo_reto_modulo_crear_admin()
	{		
		//Manda el reto y módulo seleccionado a nuevo_reto_modulo.
		$datosCrear = array(
			'ID_Reto' => $this->input->post('ID_Reto'),
			'ID_Modulo' => $this->input->post('ID_Modulo'),
			'ID_UAdmin' => $this->input->post('ID_UAdmin'),
		);

	 	$this->Reto_Modulo_model->nuevo_reto_modulo($datosCrear);

	 	//Redirije a la página principal.
	 	redirect('Reto_Modulo/reto_modulo_admin');
	}

	/*--------------------FIN FUNCIÓN CREAR RETO MÓDULO ADMIN------------------*/

	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN BORRAR RETO MODULO------------------*/

	public function borrar_reto_modulo()
	{		
		//Manda el reto-modulo seleccionado a borrar_reto_modulo.
	 	$idretoBorrar=$this->uri->segment(3);
	 	$this->Reto_Modulo_model->borrar_reto_modulo($idretoBorrar);

	 	//Redirije a la página principal.
	 	redirect('Reto_Modulo');
	}

	/*--------------------FIN FUNCIÓN BORRAR RETO MODULO------------------*/

	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN BORRAR RETO MODULO ADMIN------------------*/

	public function borrar_reto_modulo_admin()
	{		
		//Manda el reto-modulo seleccionado a borrar_reto_modulo.
	 	$idretoBorrar=$this->uri->segment(3);
	 	$this->Reto_Modulo_model->borrar_reto_modulo($idretoBorrar);

	 	//Redirije a la página principal.
	 	redirect('Reto_Modulo/reto_modulo_admin');
	}

	/*--------------------FIN FUNCIÓN BORRAR RETO MODULO ADMIN------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN EDITAR RETO MÓDULO------------------*/

	public function editar_reto_modulo()
	{	

		//Obtener los datos del reto seleccionado.
		$datosRetoModulo['segmento'] = $this->uri->segment(3);

		//Lista los cursos.
		$datosRetoModulo['cursos'] = $this->Curso_model->obtener_cursos();

		//Lista los centros.
		$datosRetoModulo['centros'] = $this->Centro_model->obtener_centros();

		$datosRetoModulo['reto'] = $this->Reto_Modulo_model->obtener_reto_modulo($datosRetoModulo['segmento']);

		//Selecciona el usuario que se ha logueado.
		$usuario_session = $this->session->userdata('id');
		//$usuario_session = 5;

		//Obtiene el usuario y el centro del usuario que se ha logueado.
		$datosRetoModulo['centroUsuario'] = $this->Centro_model->obtener_centro_usuario($usuario_session);

		$datosRetoModulo['usuario'] = $this->Usuario_model->obtener_usuario($usuario_session);

		//Carga la cabecera con los datos del usuario logueado.
		$this->load->view('header_superadmin', $datosRetoModulo);

		//Cargar la vista pasandole los datos del reto seleccionado.
		$this->load->view('reto_modulo/editar_reto_modulo', $datosRetoModulo);

		//Carga el footer.
		$this->load->view('footer');
	}

	/*--------------------FIN FUNCIÓN EDITAR RETO MÓDULO------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN EDITAR RETO MÓDULO ADMIN------------------*/

	public function editar_reto_modulo_admin()
	{	

		//Obtener los datos del reto seleccionado.
		$datosRetoModulo['segmento'] = $this->uri->segment(3);

		//Lista los cursos.
		$datosRetoModulo['cursos'] = $this->Curso_model->obtener_cursos();

		//Lista los centros.
		$datosRetoModulo['centros'] = $this->Centro_model->obtener_centros();

		$datosRetoModulo['reto'] = $this->Reto_Modulo_model->obtener_reto_modulo($datosRetoModulo['segmento']);

		//Selecciona el usuario que se ha logueado.
		$usuario_session = $this->session->userdata('id');
		//$usuario_session = 5;

		//Obtiene el usuario y el centro del usuario que se ha logueado.
		$datosRetoModulo['centroUsuario'] = $this->Centro_model->obtener_centro_usuario($usuario_session);

		$datosRetoModulo['usuario'] = $this->Usuario_model->obtener_usuario($usuario_session);

		//Carga la cabecera con los datos del usuario logueado.
		$this->load->view('header_admin', $datosRetoModulo);

		//Cargar la vista pasandole los datos del reto seleccionado.
		$this->load->view('reto_modulo/editar_reto_modulo_admin', $datosRetoModulo);

		//Carga el footer.
		$this->load->view('footer');
	}

	/*--------------------FIN FUNCIÓN EDITAR RETO MÓDULO ADMIN------------------*/ 


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN GUARDAR CAMBIOS RETO MÓDULO------------------*/

	public function guardar_cambios_reto_modulo()
	{
		//Array con los datos del reto actualizado.
		$datosModulo = $this->input->post('ID_Modulo');
		$datosAdmin = $this->input->post('ID_UAdmin');


		//Manda el reto seleccionado a guardar_cambios_reto_modulo.
	 	$idretoActualizar=$this->uri->segment(3);
	 	$this->Reto_Modulo_model->guardar_cambios_reto_modulo($idretoActualizar,$datosModulo, $datosAdmin);

	 	//Redirije a la página principal.
	 	redirect('Reto_Modulo');
	}

	/*--------------------FIN FUNCIÓN GUARDAR CAMBIOS RETO MÓDULO------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN GUARDAR CAMBIOS RETO MÓDULO ADMIN------------------*/

	public function guardar_cambios_reto_modulo_admin()
	{
		//Array con los datos del reto actualizado.
		$datosModulo = $this->input->post('ID_Modulo');
		$datosAdmin = $this->input->post('ID_UAdmin');


		//Manda el reto seleccionado a guardar_cambios_reto_modulo.
	 	$idretoActualizar=$this->uri->segment(3);
	 	$this->Reto_Modulo_model->guardar_cambios_reto_modulo($idretoActualizar,$datosModulo, $datosAdmin);

	 	//Redirije a la página principal.
	 	redirect('Reto_Modulo/reto_modulo_admin');
	}

	/*--------------------FIN FUNCIÓN GUARDAR CAMBIOS RETO MÓDULO ADMIN------------------*/

}