<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {

	/*--------------------CONSTRUCTOR------------------*/

	function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->helper('url');						
		$this->load->model('Centro_model');			
		$this->load->model('Usuario_model');	
		$this->load->model('TUsuario_model');
		$this->load->library('session');
		$this->load->library('email');
	}

	/*--------------------FIN CONSTRUCTOR------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN INDEX------------------*/

	public function index()
	{
		//Lista los centros.
		$datosUsuario['centros'] = $this->Centro_model->obtener_centros();

		//Lista los tipos de usuario.
		$datosUsuario['tipos'] = $this->TUsuario_model->obtener_tusuarios();
		
		//Selecciona el usuario que se ha logueado.
		$usuario_session = $this->session->userdata('id');
		//$usuario_session = 5;

		//Obtiene el usuario y el centro del usuario que se ha logueado.
		$datosUsuario['centroUsuario'] = $this->Centro_model->obtener_centro_usuario($usuario_session);

		$datosUsuario['usuario'] = $this->Usuario_model->obtener_usuario($usuario_session);

		$datosUsuario['pagina'] = 'Usuario';

		//Carga la cabecera con los datos del usuario logueado.
		$this->load->view('header_superadmin', $datosUsuario);

		//Carga la vista "listar_usuario" pasandole los datos (centros y tipos de usuarios).
		$this->load->view('usuario/listar_usuario',$datosUsuario);

		//Carga el footer.
		$this->load->view('footer');

	}

	/*--------------------FIN FUNCIÓN INDEX------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN USUARIO ADMIN------------------*/

	public function usuario_admin()
	{

		//Lista los tipos de usuario.
		$datosUsuario['tipos'] = $this->TUsuario_model->obtener_tusuarios();
		
		//Selecciona el usuario que se ha logueado.
		$usuario_session = $this->session->userdata('id');
		//$usuario_session = 5;

		//Obtiene el usuario y el centro del usuario que se ha logueado.
		$datosUsuario['centroUsuario'] = $this->Centro_model->obtener_centro_usuario($usuario_session);

		$datosUsuario['usuario'] = $this->Usuario_model->obtener_usuario($usuario_session);

		$datosUsuario['pagina'] = 'Usuario';

		//Carga la cabecera con los datos del usuario logueado.
		$this->load->view('header_admin', $datosUsuario);

		//Carga la vista "listar_usuario" pasandole los datos (centros y tipos de usuarios).
		$this->load->view('usuario/listar_usuario_admin',$datosUsuario);

		//Carga el footer.
		$this->load->view('footer');

	}

	/*--------------------FIN FUNCIÓN USUARIO ADMIN------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN USUARIOS------------------*/

	public function obtener_usuarios()
	{		
		//Función que mediante Ajax pasandole a la función "obtener_usuarios" de "Usuario_model.php" los parámetros "ID_Centro" y "ID_TUsuario" obtiene los usuarios.
	 	$idcentro=$this->input->post('ID_Centro');
	 	$idtusuario=$this->input->post('ID_TUsuario');
	 	$usuarios=$this->Usuario_model->obtener_usuarios($idcentro, $idtusuario);
 		echo json_encode($usuarios->result());
	}

	/*--------------------FIN FUNCIÓN USUARIOS------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN NUEVO USUARIO------------------*/

	public function nuevo_usuario()
	{
		//Lista los centros.
		$datosUsuario['centros'] = $this->Centro_model->obtener_centros();

		//Lista los tipos de usuario.
		$datosUsuario['tipos'] = $this->TUsuario_model->obtener_tusuarios();
		
		//Selecciona el usuario que se ha logueado.
		$usuario_session = $this->session->userdata('id');
		//$usuario_session = 5;

		//Obtiene el usuario y el centro del usuario que se ha logueado.
		$datosUsuario['centroUsuario'] = $this->Centro_model->obtener_centro_usuario($usuario_session);

		$datosUsuario['usuario'] = $this->Usuario_model->obtener_usuario($usuario_session);

		$datosUsuario['pagina'] = 'Usuario';

		//Carga la cabecera con los datos del usuario logueado.
		$this->load->view('header_superadmin', $datosUsuario);

		//Carga la vista "nuevo_usuario" pasandole los datos (centros y tipos de usuarios).
		$this->load->view('usuario/nuevo_usuario',$datosUsuario);

		//Carga el footer.
		$this->load->view('footer');

		//Si se ha mandado el formulario.
		if(isset($_POST['Crear'])){

			//Array con los datos del nuevo usuario.
			$datosNuevo = array(
				'ID_Centro' => $this->input->post('ID_Centro_Formulario'),
				'ID_TUsuario' => $this->input->post('ID_TUsuario_Formulario'),
				'User' => $this->input->post('User'),
				'Password' => $this->input->post('Dni'),
				'Nombre' => $this->input->post('Nombre'),
				'Apellidos' => $this->input->post('Apellidos'),
				'Email' => $this->input->post('Email'),
				'Dni' => $this->input->post('Dni'),
			);

			//Manda a "nuevo_usuario" de "Usuario_model.php" el array "datosNuevo" para añadir un nuevo usuario a la base de datos.
			$usuarioNuevo = $this->Usuario_model->nuevo_usuario($datosNuevo);


		}
	}

	/*--------------------FIN FUNCIÓN NUEVO USUARIO------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN NUEVO USUARIO ADMIN------------------*/

	public function nuevo_usuario_admin()
	{

		//Lista los tipos de usuario.
		$datosUsuario['tipos'] = $this->TUsuario_model->obtener_tusuarios();
		
		//Selecciona el usuario que se ha logueado.
		$usuario_session = $this->session->userdata('id');
		//$usuario_session = 5;

		//Obtiene el usuario y el centro del usuario que se ha logueado.
		$datosUsuario['centroUsuario'] = $this->Centro_model->obtener_centro_usuario($usuario_session);

		$datosUsuario['usuario'] = $this->Usuario_model->obtener_usuario($usuario_session);

		$datosUsuario['pagina'] = 'Usuario';

		//Carga la cabecera con los datos del usuario logueado.
		$this->load->view('header_admin', $datosUsuario);

		//Carga la vista "nuevo_usuario" pasandole los datos (centros y tipos de usuarios).
		$this->load->view('usuario/nuevo_usuario_admin',$datosUsuario);

		//Carga el footer.
		$this->load->view('footer');

		//Si se ha mandado el formulario.
		if(isset($_POST['Crear'])){

			//Array con los datos del nuevo usuario.
			$datosNuevo = array(
				'ID_Centro' => $this->input->post('ID_Centro_Formulario'),
				'ID_TUsuario' => $this->input->post('ID_TUsuario_Formulario'),
				'User' => $this->input->post('User'),
				'Nombre' => $this->input->post('Nombre'),
				'Apellidos' => $this->input->post('Apellidos'),
				'Email' => $this->input->post('Email'),
				'Dni' => $this->input->post('Dni'),
			);

			//Manda a "nuevo_usuario" de "Usuario_model.php" el array "datosNuevo" para añadir un nuevo usuario a la base de datos.
			$usuarioNuevo = $this->Usuario_model->nuevo_usuario($datosNuevo);


		}
	}

	/*--------------------FIN FUNCIÓN NUEVO USUARIO ADMIN------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN BORRAR USUARIO------------------*/

	public function borrar_usuario()
	{		
		//Manda el usuario seleccionado a borrar_usuario.
	 	$idusuarioBorrar=$this->uri->segment(3);
	 	$this->Usuario_model->borrar_usuario($idusuarioBorrar);

	 	//Redirije a la página principal.
	 	redirect('Usuario');
	}

	/*--------------------FIN FUNCIÓN BORRAR USUARIO------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN BORRAR USUARIO ADMIN------------------*/

	public function borrar_usuario_admin()
	{		
		//Manda el usuario seleccionado a borrar_usuario.
	 	$idusuarioBorrar=$this->uri->segment(3);
	 	$this->Usuario_model->borrar_usuario($idusuarioBorrar);

	 	//Redirije a la página principal.
	 	redirect('Usuario/usuario_admin');
	}

	/*--------------------FIN FUNCIÓN BORRAR USUARIO ADMIN------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN EDITAR USUARIO------------------*/

	public function editar_usuario()
	{
		//Obtener los datos del usuaio seleccionado.
		$datosUsuario['segmento'] = $this->uri->segment(3);

		//Lista los centros.
		$datosUsuario['centros'] = $this->Centro_model->obtener_centros();	

		//Lista los tipos de usuario.
		$datosUsuario['tipos'] = $this->TUsuario_model->obtener_tusuarios();

		$datosUsuario['usuario2'] = $this->Usuario_model->obtener_usuario($datosUsuario['segmento']);
		
		//Selecciona el usuario que se ha logueado.
		$usuario_session = $this->session->userdata('id');
		//$usuario_session = 5;

		//Obtiene el usuario y el centro del usuario que se ha logueado.
		$datosUsuario['centroUsuario'] = $this->Centro_model->obtener_centro_usuario($usuario_session);

		$datosUsuario['usuario'] = $this->Usuario_model->obtener_usuario($usuario_session);

		$datosUsuario['pagina'] = 'Usuario';

		//Carga la cabecera con los datos del usuario logueado.
		$this->load->view('header_superadmin', $datosUsuario);

		//Cargar la vista pasandole los datos del usuario seleccionado.
		$this->load->view('usuario/editar_usuario', $datosUsuario);

		//Carga el footer.
		$this->load->view('footer');
	}

	/*--------------------FIN FUNCIÓN EDITAR USUARIO------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN EDITAR USUARIO ADMIN------------------*/

	public function editar_usuario_admin()
	{
		//Obtener los datos del usuaio seleccionado.
		$datosUsuario['segmento'] = $this->uri->segment(3);

		//Lista los centros.
		$datosUsuario['centros'] = $this->Centro_model->obtener_centros();	

		//Lista los tipos de usuario.
		$datosUsuario['tipos'] = $this->TUsuario_model->obtener_tusuarios();

		$datosUsuario['usuario2'] = $this->Usuario_model->obtener_usuario($datosUsuario['segmento']);
		
		//Selecciona el usuario que se ha logueado.
		$usuario_session = $this->session->userdata('id');
		//$usuario_session = 5;

		//Obtiene el usuario y el centro del usuario que se ha logueado.
		$datosUsuario['centroUsuario'] = $this->Centro_model->obtener_centro_usuario($usuario_session);

		$datosUsuario['usuario'] = $this->Usuario_model->obtener_usuario($usuario_session);

		$datosUsuario['pagina'] = 'Usuario';

		//Carga la cabecera con los datos del usuario logueado.
		$this->load->view('header_admin', $datosUsuario);

		//Cargar la vista pasandole los datos del usuario seleccionado.
		$this->load->view('usuario/editar_usuario_admin', $datosUsuario);

		//Carga el footer.
		$this->load->view('footer');
	}

	/*--------------------FIN FUNCIÓN EDITAR USUARIO ADMIN------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN GUARDAR CAMBIOS USUARIO------------------*/

	public function guardar_cambios_usuario()
	{
		//Array con los datos del usuario actualizado.
		$datosActualizado = array(
			'ID_Centro' => $this->input->post('ID_Centro_Formulario'),
			'ID_TUsuario' => $this->input->post('ID_TUsuario_Formulario'),
			'User' => $this->input->post('User'),
			'Nombre' => $this->input->post('Nombre'),
			'Apellidos' => $this->input->post('Apellidos'),
			'Email' => $this->input->post('Email'),
			'Dni' => $this->input->post('Dni'),
		);


		//Manda el usuario seleccionado a guardar_cambios_usuario.
	 	$idusuarioActualizar=$this->uri->segment(3);
	 	$this->Usuario_model->guardar_cambios_usuario($idusuarioActualizar,$datosActualizado);


	 	//Redirije a la página principal.
	 	redirect('Usuario');
	}

	/*--------------------FIN FUNCIÓN GUARDAR CAMBIOS USUARIO------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN GUARDAR CAMBIOS USUARIO ADMIN------------------*/

	public function guardar_cambios_usuario_admin()
	{
		//Array con los datos del usuario actualizado.
		$datosActualizado = array(
			'ID_Centro' => $this->input->post('ID_Centro_Formulario'),
			'ID_TUsuario' => $this->input->post('ID_TUsuario_Formulario'),
			'User' => $this->input->post('User'),
			'Nombre' => $this->input->post('Nombre'),
			'Apellidos' => $this->input->post('Apellidos'),
			'Email' => $this->input->post('Email'),
			'Dni' => $this->input->post('Dni'),
		);


		//Manda el usuario seleccionado a guardar_cambios_usuario.
	 	$idusuarioActualizar=$this->uri->segment(3);
	 	$this->Usuario_model->guardar_cambios_usuario($idusuarioActualizar,$datosActualizado);


	 	//Redirije a la página principal.
	 	redirect('Usuario/usuario_admin');
	}

	/*--------------------FIN FUNCIÓN GUARDAR CAMBIOS USUARIO ADMIN------------------*/

}