<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_Modulo extends CI_Controller {

	/*--------------------CONSTRUCTOR------------------*/

	function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->helper('url');								
		$this->load->model('Curso_model');					
		$this->load->model('Centro_model');					
		$this->load->model('Modulo_model');			
		$this->load->model('Usuario_model');	
		$this->load->model('TUsuario_model');	
		$this->load->model('Usuario_Modulo_model');
		$this->load->library('session');
	}

	/*--------------------FIN CONSTRUCTOR------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN INDEX------------------*/

	public function index()
	{
		//Lista los cursos.
		$datosUsuarioModulo['cursos'] = $this->Curso_model->obtener_cursos();

		//Lista los centros.
		$datosUsuarioModulo['centros'] = $this->Centro_model->obtener_centros();
		
		//Selecciona el usuario que se ha logueado.
		$usuario_session = $this->session->userdata('id');
		//$usuario_session = 5;

		//Obtiene el usuario y el centro del usuario que se ha logueado.
		$datosUsuarioModulo['centroUsuario'] = $this->Centro_model->obtener_centro_usuario($usuario_session);

		$datosUsuarioModulo['usuario'] = $this->Usuario_model->obtener_usuario($usuario_session);

		//Carga la cabecera con los datos del usuario logueado.
		$this->load->view('header_superadmin', $datosUsuarioModulo);

		//Carga la vista "listar_usuario_modulo" pasandole los datos (cursos y centros).
		$this->load->view('usuario_modulo/listar_usuario_modulo',$datosUsuarioModulo);

		//Carga el footer.
		$this->load->view('footer');

	}

	/*--------------------FIN FUNCIÓN INDEX------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN USUARIO MODULO ADMIN------------------*/

	public function usuario_modulo_admin()
	{
		//Lista los cursos.
		$datosUsuarioModulo['cursos'] = $this->Curso_model->obtener_cursos();
		
		//Selecciona el usuario que se ha logueado.
		$usuario_session = $this->session->userdata('id');
		//$usuario_session = 5;

		//Obtiene el usuario y el centro del usuario que se ha logueado.
		$datosUsuarioModulo['centroUsuario'] = $this->Centro_model->obtener_centro_usuario($usuario_session);

		$datosUsuarioModulo['usuario'] = $this->Usuario_model->obtener_usuario($usuario_session);

		//Carga la cabecera con los datos del usuario logueado.
		$this->load->view('header_admin', $datosUsuarioModulo);

		//Carga la vista "listar_usuario_modulo" pasandole los datos (cursos y centros).
		$this->load->view('usuario_modulo/listar_usuario_modulo_admin',$datosUsuarioModulo);

		//Carga el footer.
		$this->load->view('footer');

	}

	/*--------------------FIN FUNCIÓN USUARIO MODULO ADMIN------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN USUARIOS MÓDULOS------------------*/

	public function obtener_usuarios_modulos()
	{		
		//Función que mediante Ajax pasandole a la función "obtener_usuarios_modulos" de "Usuario_Modulo_model.php" el parámetro "ID_Modulo" obtiene los usuarios asignados al módulo seleccionado.
	 	$idmodulo=$this->input->post('ID_Modulo');
	 	$usuarios=$this->Usuario_Modulo_model->obtener_usuarios_modulos($idmodulo);
 		echo json_encode($usuarios->result());
	}

	/*--------------------FIN FUNCIÓN USUARIOS MÓDULOS------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN USUARIOS TIPO------------------*/

	public function obtener_usuarios_tipo()
	{		
		//Función que mediante Ajax pasandole a la función "obtener_usuarios_tipo" de "Usuario_Modulo_model.php" los parámetros "ID_Centro" e "ID_TUsuario" obtiene los usuarios según el tipo de usuario y el centro seleccionado.
	 	$idcentro=$this->input->post('ID_Centro');
	 	$idtusuario=$this->input->post('ID_TUsuario');
	 	$usuarios=$this->Usuario_Modulo_model->obtener_usuarios_tipo($idcentro, $idtusuario);
 		echo json_encode($usuarios->result());
	}

	/*--------------------FIN FUNCIÓN USUARIOS TIPO------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN USUARIO ID------------------*/

	public function obtener_usuario_id()
	{		
		//Función que mediante Ajax pasandole a la función "obtener_usuario_id" de "Usuario_Modulo_model.php" el parámetro "ID_Usuario" obtiene el usuario según el id de usuario seleccionado.
	 	$idusuario=$this->input->post('ID_Usuario');
	 	$usuarios=$this->Usuario_Modulo_model->obtener_usuario_id($idusuario);
 		echo json_encode($usuarios->result());
	}

	/*--------------------FIN FUNCIÓN USUARIO ID------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN NUEVO USUARIO------------------*/

	public function nuevo_usuario_modulo()
	{
		//Lista los cursos.
		$datosUsuarioModulo['cursos'] = $this->Curso_model->obtener_cursos();

		//Lista los centros.
		$datosUsuarioModulo['centros'] = $this->Centro_model->obtener_centros();

		//Lista los tipos de usuario.
		$datosUsuarioModulo['tipos'] = $this->TUsuario_model->obtener_tusuarios();
		
		//Selecciona el usuario que se ha logueado.
		$usuario_session = $this->session->userdata('id');
		//$usuario_session = 5;

		//Obtiene el usuario y el centro del usuario que se ha logueado.
		$datosUsuarioModulo['centroUsuario'] = $this->Centro_model->obtener_centro_usuario($usuario_session);

		$datosUsuarioModulo['usuario'] = $this->Usuario_model->obtener_usuario($usuario_session);

		//Carga la cabecera con los datos del usuario logueado.
		$this->load->view('header_superadmin', $datosUsuarioModulo);

		//Carga la vista "nuevo_usuario_modulo" pasandole los datos (cursos y centros).
		$this->load->view('usuario_modulo/nuevo_usuario_modulo',$datosUsuarioModulo);

		//Carga el footer.
		$this->load->view('footer');
	}

	/*--------------------FIN FUNCIÓN NUEVO USUARIO------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN NUEVO USUARIO ADMIN------------------*/

	public function nuevo_usuario_modulo_admin()
	{
		//Lista los cursos.
		$datosUsuarioModulo['cursos'] = $this->Curso_model->obtener_cursos();

		//Lista los tipos de usuario.
		$datosUsuarioModulo['tipos'] = $this->TUsuario_model->obtener_tusuarios();
		
		//Selecciona el usuario que se ha logueado.
		$usuario_session = $this->session->userdata('id');
		//$usuario_session = 5;

		//Obtiene el usuario y el centro del usuario que se ha logueado.
		$datosUsuarioModulo['centroUsuario'] = $this->Centro_model->obtener_centro_usuario($usuario_session);

		$datosUsuarioModulo['usuario'] = $this->Usuario_model->obtener_usuario($usuario_session);

		//Carga la cabecera con los datos del usuario logueado.
		$this->load->view('header_admin', $datosUsuarioModulo);

		//Carga la vista "nuevo_usuario_modulo" pasandole los datos (cursos y centros).
		$this->load->view('usuario_modulo/nuevo_usuario_modulo_admin',$datosUsuarioModulo);

		//Carga el footer.
		$this->load->view('footer');
	}

	/*--------------------FIN FUNCIÓN NUEVO USUARIO ADMIN------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN CREAR USUARIO MÓDULO------------------*/

	public function nuevo_usuario_modulo_crear()
	{		
		//Manda el usuario y módulo seleccionado a nuevo_usuario_modulo.
		$datosCrear = array(
			'ID_Modulo' => $this->input->post('ID_Modulo'),
			'ID_Usuario' => $this->input->post('ID_Usuario'),
		);

	 	$this->Usuario_Modulo_model->nuevo_usuario_modulo($datosCrear);

	 	//Redirije a la página principal.
	 	redirect('Usuario_Modulo');
	}

	/*--------------------FIN FUNCIÓN CREAR USUARIO MÓDULO------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN CREAR USUARIO MÓDULO ADMIN------------------*/

	public function nuevo_usuario_modulo_crear_admin()
	{		
		//Manda el usuario y módulo seleccionado a nuevo_usuario_modulo.
		$datosCrear = array(
			'ID_Modulo' => $this->input->post('ID_Modulo'),
			'ID_Usuario' => $this->input->post('ID_Usuario'),
		);

	 	$this->Usuario_Modulo_model->nuevo_usuario_modulo($datosCrear);

	 	//Redirije a la página principal.
	 	redirect('Usuario_Modulo/usuario_modulo_admin');
	}

	/*--------------------FIN FUNCIÓN CREAR USUARIO MÓDULO ADMIN------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN BORRAR USUARIO------------------*/

	public function borrar_usuario_modulo()
	{		
		//Manda el usuario-modulo seleccionado a borrar_usuario_modulo.
	 	$idusuarioBorrar=$this->uri->segment(3);
	 	$this->Usuario_Modulo_model->borrar_usuario_modulo($idusuarioBorrar);

	 	//Redirije a la página principal.
	 	redirect('Usuario_Modulo');
	}

	/*--------------------FIN FUNCIÓN BORRAR USUARIO------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN BORRAR USUARIO MODULO ADMIN------------------*/

	public function borrar_usuario_modulo_admin()
	{		
		//Manda el usuario-modulo seleccionado a borrar_usuario_modulo.
	 	$idusuarioBorrar=$this->uri->segment(3);
	 	$this->Usuario_Modulo_model->borrar_usuario_modulo($idusuarioBorrar);

	 	//Redirije a la página principal.
	 	redirect('Usuario_Modulo/usuario_modulo_admin');
	}

	/*--------------------FIN FUNCIÓN BORRAR USUARIO MODULO ADMIN------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN EDITAR USUARIO------------------*/

	public function editar_usuario_modulo()
	{	

		//Obtener los datos del usuaio seleccionado.
		$datosUsuarioModulo['segmento'] = $this->uri->segment(3);

		//Lista los cursos.
		$datosUsuarioModulo['cursos'] = $this->Curso_model->obtener_cursos();

		$datosUsuarioModulo['usuario2'] = $this->Usuario_Modulo_model->obtener_usuario_modulo($datosUsuarioModulo['segmento']);
		
		//Selecciona el usuario que se ha logueado.
		$usuario_session = $this->session->userdata('id');
		//$usuario_session = 5;

		//Obtiene el usuario y el centro del usuario que se ha logueado.
		$datosUsuarioModulo['centroUsuario'] = $this->Centro_model->obtener_centro_usuario($usuario_session);

		$datosUsuarioModulo['usuario'] = $this->Usuario_model->obtener_usuario($usuario_session);

		//Carga la cabecera con los datos del usuario logueado.
		$this->load->view('header_superadmin', $datosUsuarioModulo);

		//Cargar la vista pasandole los datos del usuario seleccionado.
		$this->load->view('usuario_modulo/editar_usuario_modulo', $datosUsuarioModulo);

		//Carga el footer.
		$this->load->view('footer');
	}

	/*--------------------FIN FUNCIÓN EDITAR USUARIO------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN EDITAR USUARIO MODULO ADMIN------------------*/

	public function editar_usuario_modulo_admin()
	{	

		//Obtener los datos del usuaio seleccionado.
		$datosUsuarioModulo['segmento'] = $this->uri->segment(3);

		//Lista los cursos.
		$datosUsuarioModulo['cursos'] = $this->Curso_model->obtener_cursos();

		$datosUsuarioModulo['usuario2'] = $this->Usuario_Modulo_model->obtener_usuario_modulo($datosUsuarioModulo['segmento']);
		
		//Selecciona el usuario que se ha logueado.
		$usuario_session = $this->session->userdata('id');
		//$usuario_session = 5;

		//Obtiene el usuario y el centro del usuario que se ha logueado.
		$datosUsuarioModulo['centroUsuario'] = $this->Centro_model->obtener_centro_usuario($usuario_session);

		$datosUsuarioModulo['usuario'] = $this->Usuario_model->obtener_usuario($usuario_session);

		//Carga la cabecera con los datos del usuario logueado.
		$this->load->view('header_admin', $datosUsuarioModulo);

		//Cargar la vista pasandole los datos del usuario seleccionado.
		$this->load->view('usuario_modulo/editar_usuario_modulo_admin', $datosUsuarioModulo);

		//Carga el footer.
		$this->load->view('footer');
	}

	/*--------------------FIN FUNCIÓN EDITAR USUARIO MODULO ADMIN------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN GUARDAR CAMBIOS USUARIO------------------*/

	public function guardar_cambios_usuario_modulo()
	{
		//Array con los datos del usuario actualizado.
		$datosActualizado = $this->input->post('ID_Modulo');


		//Manda el usuario seleccionado a guardar_cambios_usuario.
	 	$idusuarioActualizar=$this->uri->segment(3);
	 	$this->Usuario_Modulo_model->guardar_cambios_usuario_modulo($idusuarioActualizar,$datosActualizado);

	 	//Redirije a la página principal.
	 	redirect('Usuario_Modulo');
	}

	/*--------------------FIN FUNCIÓN GUARDAR CAMBIOS USUARIO------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN GUARDAR CAMBIOS USUARIO MODULO ADMIN------------------*/

	public function guardar_cambios_usuario_modulo_admin()
	{
		//Array con los datos del usuario actualizado.
		$datosActualizado = $this->input->post('ID_Modulo');


		//Manda el usuario seleccionado a guardar_cambios_usuario.
	 	$idusuarioActualizar=$this->uri->segment(3);
	 	$this->Usuario_Modulo_model->guardar_cambios_usuario_modulo($idusuarioActualizar,$datosActualizado);

	 	//Redirije a la página principal.
	 	redirect('Usuario_Modulo/usuario_modulo_admin');
	}

	/*--------------------FIN FUNCIÓN GUARDAR CAMBIOS USUARIO MODULO ADMIN------------------*/

}