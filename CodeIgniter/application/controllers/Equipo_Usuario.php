<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Equipo_Usuario extends CI_Controller {

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
		$this->load->model('Equipo_model');
		$this->load->model('Usuario_model');
		$this->load->model('TUsuario_model');
		$this->load->model('Equipo_Usuario_model');
		$this->load->library('session');
	}

	/*--------------------FIN CONSTRUCTOR------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN INDEX------------------*/

	public function index()
	{
		//Lista los cursos.
		$datosEquipoUsuario['cursos'] = $this->Curso_model->obtener_cursos();


		//Lista los centros.
		$datosEquipoUsuario['centros'] = $this->Centro_model->obtener_centros();


		//Selecciona el usuario que se ha logueado.
		$usuario_session = $this->session->userdata('id');
		//$usuario_session = 5;

		//Obtiene el usuario y el centro del usuario que se ha logueado.
		$datosEquipoUsuario['centroUsuario'] = $this->Centro_model->obtener_centro_usuario($usuario_session);

		$datosEquipoUsuario['usuario'] = $this->Usuario_model->obtener_usuario($usuario_session);

		//Carga la cabecera con los datos del usuario logueado.
		$this->load->view('header_superadmin', $datosEquipoUsuario);


		//Carga la vista "listar_equipo_usuario" pasandole los datos (cursos y centros).
		$this->load->view('equipo_usuario/listar_equipo_usuario',$datosEquipoUsuario);


		//Carga el footer.
		$this->load->view('footer');

	}

	/*--------------------FIN FUNCIÓN INDEX------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN EQUIPO USUARIO ADMIN------------------*/

	public function equipo_usuario_admin()
	{
		//Lista los cursos.
		$datosEquipoUsuario['cursos'] = $this->Curso_model->obtener_cursos();


		//Selecciona el usuario que se ha logueado.
		$usuario_session = $this->session->userdata('id');
		//$usuario_session = 5;

		//Obtiene el usuario y el centro del usuario que se ha logueado.
		$datosEquipoUsuario['centroUsuario'] = $this->Centro_model->obtener_centro_usuario($usuario_session);

		$datosEquipoUsuario['usuario'] = $this->Usuario_model->obtener_usuario($usuario_session);

		//Carga la cabecera con los datos del usuario logueado.
		$this->load->view('header_admin', $datosEquipoUsuario);


		//Carga la vista "listar_equipo_usuario" pasandole los datos (cursos y centros).
		$this->load->view('equipo_usuario/listar_equipo_usuario_admin',$datosEquipoUsuario);


		//Carga el footer.
		$this->load->view('footer');

	}

	/*--------------------FIN FUNCIÓN EQUIPO USUARIO ADMIN------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN EQUIPOS USUARIOS------------------*/

	public function obtener_equipos_usuarios()
	{		
		//Función que mediante Ajax pasandole a la función "obtener_equipos_usuarios" de "Equipo_Usuario_model.php" el parámetro "ID_Reto" obtiene los equipos.
	 	$idequipo=$this->input->post('ID_Equipo');
	 	$equipos=$this->Equipo_Usuario_model->obtener_equipos_usuarios($idequipo);
 		echo json_encode($equipos->result());
	}

	/*--------------------FIN FUNCIÓN EQUIPOS USUARIOS------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN EQUIPOS USUARIOS------------------*/

	public function obtener_usuarios_tipo_modulo()
	{		
		//Función que mediante Ajax pasandole a la función "obtener_usuarios_tipo_modulo" de "Equipo_Usuario_model.php" el parámetro "ID_Modulo" e "ID_TUsuario" obtiene los usuarios según el módulo y tipo de usuario que se haya seleccionado.
	 	$idmodulo=$this->input->post('ID_Modulo');
	 	$idtusuario=$this->input->post('ID_TUsuario');
	 	$usuarios=$this->Equipo_Usuario_model->obtener_usuarios_tipo_modulo($idmodulo,$idtusuario);
 		echo json_encode($usuarios->result());
	}

	/*--------------------FIN FUNCIÓN EQUIPOS USUARIOS------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN EQUIPOS USUARIOS USUARIO------------------*/

	public function obtener_equipos_usuarios_usuario()
	{		
		//Función que mediante Ajax pasandole a la función "obtener_equipos_usuarios" de "Equipo_Usuario_model.php" el parámetro "ID_Reto" obtiene los equipos.
	 	$idusuario=$this->input->post('ID_Usuario');
	 	$equipos=$this->Equipo_Usuario_model->obtener_equipos_usuarios_usuario($idusuario);
 		echo json_encode($equipos->result());
	}

	/*--------------------FIN FUNCIÓN EQUIPOS USUARIOS USUARIO------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN NUEVO EQUIPO USUARIO------------------*/

	public function nuevo_equipo_usuario()
	{
		//Lista los cursos.
		$datosEquipoUsuario['cursos'] = $this->Curso_model->obtener_cursos();

		//Lista los centros.
		$datosEquipoUsuario['centros'] = $this->Centro_model->obtener_centros();

		//Lista los tipos de usuario.
		$datosEquipoUsuario['tipos'] = $this->TUsuario_model->obtener_tusuarios();
		
		//Selecciona el usuario que se ha logueado.
		$usuario_session = $this->session->userdata('id');
		//$usuario_session = 5;

		//Obtiene el usuario y el centro del usuario que se ha logueado.
		$datosEquipoUsuario['centroUsuario'] = $this->Centro_model->obtener_centro_usuario($usuario_session);

		$datosEquipoUsuario['usuario'] = $this->Usuario_model->obtener_usuario($usuario_session);

		//Carga la cabecera con los datos del usuario logueado.
		$this->load->view('header_superadmin', $datosEquipoUsuario);

		//Carga la vista "nuevo_usuario_modulo" pasandole los datos (cursos, centros y tipos).
		$this->load->view('equipo_usuario/nuevo_equipo_usuario',$datosEquipoUsuario);

		//Carga el footer.
		$this->load->view('footer');
	}

	/*--------------------FIN FUNCIÓN NUEVO EQUIPO USUARIO------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN NUEVO EQUIPO USUARIO ADMIN------------------*/

	public function nuevo_equipo_usuario_admin()
	{
		//Lista los cursos.
		$datosEquipoUsuario['cursos'] = $this->Curso_model->obtener_cursos();

		//Lista los tipos de usuario.
		$datosEquipoUsuario['tipos'] = $this->TUsuario_model->obtener_tusuarios();
		
		//Selecciona el usuario que se ha logueado.
		$usuario_session = $this->session->userdata('id');
		//$usuario_session = 5;

		//Obtiene el usuario y el centro del usuario que se ha logueado.
		$datosEquipoUsuario['centroUsuario'] = $this->Centro_model->obtener_centro_usuario($usuario_session);

		$datosEquipoUsuario['usuario'] = $this->Usuario_model->obtener_usuario($usuario_session);

		//Carga la cabecera con los datos del usuario logueado.
		$this->load->view('header_admin', $datosEquipoUsuario);

		//Carga la vista "nuevo_usuario_modulo" pasandole los datos (cursos, centros y tipos).
		$this->load->view('equipo_usuario/nuevo_equipo_usuario_admin',$datosEquipoUsuario);

		//Carga el footer.
		$this->load->view('footer');
	}

	/*--------------------FIN FUNCIÓN NUEVO EQUIPO USUARIO ADMIN------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN CREAR EQUIPO USUARIO------------------*/

	public function nuevo_equipo_usuario_crear()
	{		
		//Manda el usuario y equipo seleccionado a nuevo_equipo_usuario.
		$datosCrear = array(
			'ID_Equipo' => $this->input->post('ID_Equipo'),
			'ID_Usuario' => $this->input->post('ID_Usuario'),
			'COD_Rol' => $this->input->post('COD_Rol'),
		);

	 	$this->Equipo_Usuario_model->nuevo_equipo_usuario_crear($datosCrear);

	 	//Redirije a la página principal.
	 	redirect('Equipo_Usuario');
	}

	/*--------------------FIN FUNCIÓN CREAR EQUIPO USUARIO------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN BORRAR EQUIPO USUARIO------------------*/

	public function borrar_equipo_usuario()
	{		
		//Manda el equipo y usuario seleccionado a borrar_equipo_usuario.
	 	$idequipoBorrar=$this->uri->segment(3);
	 	$this->Equipo_Usuario_model->borrar_equipo_usuario($idequipoBorrar);
	 	
	 	//Redirije a la página principal.
	 	redirect('Equipo_Usuario');
	}

	/*--------------------FIN FUNCIÓN BORRAR EQUIPO USUARIO------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN BORRAR EQUIPO USUARIO ADMIN------------------*/

	public function borrar_equipo_usuario_admin()
	{		
		//Manda el equipo y usuario seleccionado a borrar_equipo_usuario.
	 	$idequipoBorrar=$this->uri->segment(3);
	 	$this->Equipo_Usuario_model->borrar_equipo_usuario($idequipoBorrar);
	 	
	 	//Redirije a la página principal.
	 	redirect('Equipo_Usuario/equipo_usuario_admin');
	}

	/*--------------------FIN FUNCIÓN BORRAR EQUIPO USUARIO ADMIN------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN EDITAR EQUIPO USUARIO------------------*/

	public function editar_equipo_usuario()
	{	

		//Obtener los datos del usuaio seleccionado.
		$datosEditar['segmento'] = $this->uri->segment(3);

		//Lista los cursos.
		$datosEditar['cursos'] = $this->Curso_model->obtener_cursos();


		//Módulo seleccionado para que al listar los datos actuales no salgan todos los módulos en los que está el reto del equipo seleccionado.
		$datoModulo = $this->uri->segment(4);


		$datosEditar['usuarioEditar'] = $this->Equipo_Usuario_model->obtener_equipo_usuario($datosEditar['segmento'], $datoModulo);
		
		//Selecciona el usuario que se ha logueado.
		$usuario_session = $this->session->userdata('id');
		//$usuario_session = 5;

		//Obtiene el usuario y el centro del usuario que se ha logueado.
		$datosEditar['centroUsuario'] = $this->Centro_model->obtener_centro_usuario($usuario_session);

		$datosEditar['usuario'] = $this->Usuario_model->obtener_usuario($usuario_session);

		//Carga la cabecera con los datos del usuario logueado.
		$this->load->view('header_superadmin', $datosEditar);

		//Cargar la vista pasandole los datos del usuario seleccionado.
		$this->load->view('equipo_usuario/editar_equipo_usuario', $datosEditar);

		//Carga el footer.
		$this->load->view('footer');
	}

	/*--------------------FIN FUNCIÓN EDITAR EQUIPO USUARIO------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN EDITAR EQUIPO USUARIO ADMIN------------------*/

	public function editar_equipo_usuario_admin()
	{	

		//Obtener los datos del usuaio seleccionado.
		$datosEditar['segmento'] = $this->uri->segment(3);

		//Lista los cursos.
		$datosEditar['cursos'] = $this->Curso_model->obtener_cursos();


		//Módulo seleccionado para que al listar los datos actuales no salgan todos los módulos en los que está el reto del equipo seleccionado.
		$datoModulo = $this->uri->segment(4);


		$datosEditar['usuario'] = $this->Equipo_Usuario_model->obtener_equipo_usuario($datosEditar['segmento'], $datoModulo);
		
		//Selecciona el usuario que se ha logueado.
		$usuario_session = $this->session->userdata('id');
		//$usuario_session = 5;

		//Obtiene el usuario y el centro del usuario que se ha logueado.
		$datosEditar['centroUsuario'] = $this->Centro_model->obtener_centro_usuario($usuario_session);

		$datosEditar['usuario'] = $this->Usuario_model->obtener_usuario($usuario_session);

		//Carga la cabecera con los datos del usuario logueado.
		$this->load->view('header_admin', $datosEditar);

		//Cargar la vista pasandole los datos del usuario seleccionado.
		$this->load->view('equipo_usuario/editar_equipo_usuario_admin', $datosEditar);

		//Carga el footer.
		$this->load->view('footer');
	}

	/*--------------------FIN FUNCIÓN EDITAR EQUIPO USUARIO ADMIN------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN GUARDAR CAMBIOS EQUIPO USUARIO------------------*/

	public function guardar_cambios_equipo_usuario()
	{
		//Array con los datos del usuario actualizado.
		$datoEquipo = $this->input->post('ID_Equipo');
		$datoRol = $this->input->post('COD_Rol');


		//Manda el usuario seleccionado a guardar_cambios_equipo_usuario.
	 	$idusuarioActualizar=$this->uri->segment(3);


	 	$this->Equipo_Usuario_model->guardar_cambios_equipo_usuario($idusuarioActualizar, $datoEquipo, $datoRol);
	 	
	 	//Redirije a la página principal.
	 	redirect('Equipo_Usuario');
	}

	/*--------------------FIN FUNCIÓN GUARDAR CAMBIOS EQUIPO USUARIO------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN GUARDAR CAMBIOS EQUIPO USUARIO ADMIN------------------*/

	public function guardar_cambios_equipo_usuario_admin()
	{
		//Array con los datos del usuario actualizado.
		$datoEquipo = $this->input->post('ID_Equipo');
		$datoRol = $this->input->post('COD_Rol');


		//Manda el usuario seleccionado a guardar_cambios_equipo_usuario.
	 	$idusuarioActualizar=$this->uri->segment(3);


	 	$this->Equipo_Usuario_model->guardar_cambios_equipo_usuario($idusuarioActualizar, $datoEquipo, $datoRol);
	 	
	 	//Redirije a la página principal.
	 	redirect('Equipo_Usuario/equipo_usuario_admin');
	}

	/*--------------------FIN FUNCIÓN GUARDAR CAMBIOS EQUIPO USUARIO ADMIN------------------*/

}