<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modulo extends CI_Controller {

	/*--------------------CONSTRUCTOR------------------*/

	function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->helper('url');			
		$this->load->model('Curso_model');				
		$this->load->model('Centro_model');			
		$this->load->model('Ciclo_model');
		$this->load->model('Modulo_model');
		$this->load->model('Usuario_model');
		$this->load->library('session');
	}

	/*--------------------FIN CONSTRUCTOR------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN INDEX------------------*/

	public function index()
	{
		//Lista los cursos.
		$datosModulo['cursos'] = $this->Curso_model->obtener_cursos();

		//Lista los centros.
		$datosModulo['centros'] = $this->Centro_model->obtener_centros();

		//Selecciona el usuario que se ha logueado.
		$usuario_session = $this->session->userdata('id');
		//$usuario_session = 5;

		//Obtiene el usuario y el centro del usuario que se ha logueado.
		$datosModulo['centroUsuario'] = $this->Centro_model->obtener_centro_usuario($usuario_session);

		$datosModulo['usuario'] = $this->Usuario_model->obtener_usuario($usuario_session);

		$datosModulo['pagina'] = 'Modulo';

		//Carga la cabecera con los datos del usuario logueado.
		$this->load->view('header_superadmin', $datosModulo);

		//Carga la vista "listar_modulo" pasandole los datos (cursos y centros).
		$this->load->view('modulo/listar_modulo',$datosModulo);

		//Carga el footer.
		$this->load->view('footer');

	}

	/*--------------------FIN FUNCIÓN INDEX------------------*/


	
	  public function ciclos_json()
     {   	 
         $idcurso=$this->input->post('ID_Curso');
         $ciclos=$this->Modulo_model->obtener_ciclos($idcurso);
		 echo json_encode($ciclos->result());
     }


        public function ciclos_user_json()
     {
         $idcurso=$this->input->post('ID_Curso');
         $iduser=$this->input->post('ID_Usuario');
         $ciclos=$this->Modulo_model->obtener_ciclos_user($idcurso, $iduser);
         echo json_encode($ciclos->result());
     }




          public function modulos_json()
     {   	 
         $idciclo=$this->input->post('ID_Ciclo');
         $modulos=$this->Modulo_model->obtener_modulos($idciclo);
		 echo json_encode($modulos->result());
     }


	/*--------------------FUNCIÓN MODULO ADMIN------------------*/

	public function modulo_admin()
	{
		//Lista los cursos.
		$datosModulo['cursos'] = $this->Curso_model->obtener_cursos();

		//Selecciona el usuario que se ha logueado.
		$usuario_session = $this->session->userdata('id');
		//$usuario_session = 5;

		//Obtiene el usuario y el centro del usuario que se ha logueado.
		$datosModulo['centroUsuario'] = $this->Centro_model->obtener_centro_usuario($usuario_session);

		$datosModulo['usuario'] = $this->Usuario_model->obtener_usuario($usuario_session);

		$datosModulo['pagina'] = 'Modulo';

		//Carga la cabecera con los datos del usuario logueado.
		$this->load->view('header_admin', $datosModulo);

		//Carga la vista "listar_modulo" pasandole los datos (cursos y centros).
		$this->load->view('modulo/listar_modulo_admin',$datosModulo);

		//Carga el footer.
		$this->load->view('footer');

	}

	/*--------------------FIN FUNCIÓN MODULO ADMIN------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN MODULOS------------------*/

	public function obtener_modulos()
	{		
		//Función que mediante Ajax pasandole a la función "obtener_modulos" de "Modulo_model.php" el parámetro "ID_Ciclo" obtiene los módulos.
	 	$idciclo=$this->input->post('ID_Ciclo');
	 	$modulos=$this->Modulo_model->obtener_modulos($idciclo);
 		echo json_encode($modulos->result());
	}

	/*--------------------FIN FUNCIÓN MODULOS------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN NUEVO MODULO------------------*/

	public function nuevo_modulo()
	{
		//Lista los cursos.
		$datosModulo['cursos'] = $this->Curso_model->obtener_cursos();

		//Lista los centros.
		$datosModulo['centros'] = $this->Centro_model->obtener_centros();

		//Selecciona el usuario que se ha logueado.
		$usuario_session = $this->session->userdata('id');
		//$usuario_session = 5;

		//Obtiene el usuario y el centro del usuario que se ha logueado.
		$datosModulo['centroUsuario'] = $this->Centro_model->obtener_centro_usuario($usuario_session);

		$datosModulo['usuario'] = $this->Usuario_model->obtener_usuario($usuario_session);

		$datosModulo['pagina'] = 'Modulo';

		//Carga la cabecera con los datos del usuario logueado.
		$this->load->view('header_superadmin', $datosModulo);

		//Carga la vista "listar_modulo" pasandole los datos (cursos t centros).
		$this->load->view('modulo/nuevo_modulo',$datosModulo);

		//Carga el footer.
		$this->load->view('footer');

		//Si se ha mandado el formulario.
		if(isset($_POST['Crear'])){

			//Array con los datos del nuevo módulo.
			$datosNuevo = array(
				'ID_Ciclo' => $this->input->post('ID_Ciclo_Formulario'),
				'COD_Modulo' => $this->input->post('COD_Modulo'),
				'DESC_Modulo' => $this->input->post('DESC_Modulo'),
			);

			//Manda a "nuevo_modulo" de "Modulo_model.php" el array "datosNuevo" para añadir un nuevo módulo a la base de datos.
			$moduloNuevo = $this->Modulo_model->nuevo_modulo($datosNuevo);
		}
	}

	/*--------------------FIN FUNCIÓN NUEVO MODULO------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN NUEVO MODULO ADMIN------------------*/

	public function nuevo_modulo_admin()
	{
		//Lista los cursos.
		$datosModulo['cursos'] = $this->Curso_model->obtener_cursos();

		//Selecciona el usuario que se ha logueado.
		$usuario_session = $this->session->userdata('id');
		//$usuario_session = 5;

		//Obtiene el usuario y el centro del usuario que se ha logueado.
		$datosModulo['centroUsuario'] = $this->Centro_model->obtener_centro_usuario($usuario_session);

		$datosModulo['usuario'] = $this->Usuario_model->obtener_usuario($usuario_session);

		$datosModulo['pagina'] = 'Modulo';

		//Carga la cabecera con los datos del usuario logueado.
		$this->load->view('header_admin', $datosModulo);

		//Carga la vista "listar_modulo" pasandole los datos (cursos t centros).
		$this->load->view('modulo/nuevo_modulo_admin',$datosModulo);

		//Carga el footer.
		$this->load->view('footer');

		//Si se ha mandado el formulario.
		if(isset($_POST['Crear'])){

			//Array con los datos del nuevo módulo.
			$datosNuevo = array(
				'ID_Ciclo' => $this->input->post('ID_Ciclo_Formulario'),
				'COD_Modulo' => $this->input->post('COD_Modulo'),
				'DESC_Modulo' => $this->input->post('DESC_Modulo'),
			);

			//Manda a "nuevo_modulo" de "Modulo_model.php" el array "datosNuevo" para añadir un nuevo módulo a la base de datos.
			$moduloNuevo = $this->Modulo_model->nuevo_modulo($datosNuevo);
		}
	}

	/*--------------------FIN FUNCIÓN NUEVO MODULO ADMIN------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN BORRAR MODULO------------------*/

	public function borrar_modulo()
	{		
		//Manda el módulo seleccionado a borrar_modulo.
	 	$idmoduloBorrar=$this->uri->segment(3);
	 	$this->Modulo_model->borrar_modulo($idmoduloBorrar);

	 	//Redirije a la página principal.
	 	redirect('Modulo');
	}

	/*--------------------FIN FUNCIÓN BORRAR MODULO------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN BORRAR MODULO ADMIN------------------*/

	public function borrar_modulo_admin()
	{		
		//Manda el módulo seleccionado a borrar_modulo.
	 	$idmoduloBorrar=$this->uri->segment(3);
	 	$this->Modulo_model->borrar_modulo($idmoduloBorrar);

	 	//Redirije a la página principal.
	 	redirect('Modulo/modulo_admin');
	}

	/*--------------------FIN FUNCIÓN BORRAR MODULO ADMIN------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN EDITAR MODULO------------------*/

	public function editar_modulo()
	{
		//Obtener los datos del módulo seleccionado.
		$datosModulo['segmento'] = $this->uri->segment(3);
		$datosModulo['modulo'] = $this->Modulo_model->obtener_modulo($datosModulo['segmento']);

		//Selecciona el usuario que se ha logueado.
		$usuario_session = $this->session->userdata('id');
		//$usuario_session = 5;

		//Obtiene el usuario y el centro del usuario que se ha logueado.
		$datosModulo['centroUsuario'] = $this->Centro_model->obtener_centro_usuario($usuario_session);

		$datosModulo['usuario'] = $this->Usuario_model->obtener_usuario($usuario_session);

		$datosModulo['pagina'] = 'Modulo';

		//Carga la cabecera con los datos del usuario logueado.
		$this->load->view('header_superadmin', $datosModulo);

		//Cargar la vista pasandole los datos del módulo seleccionado.
		$this->load->view('modulo/editar_modulo', $datosModulo);

		//Carga el footer.
		$this->load->view('footer');
	}

	/*--------------------FIN FUNCIÓN EDITAR MODULO------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN EDITAR MODULO ADMIN------------------*/

	public function editar_modulo_admin()
	{
		//Obtener los datos del módulo seleccionado.
		$datosModulo['segmento'] = $this->uri->segment(3);
		$datosModulo['modulo'] = $this->Modulo_model->obtener_modulo($datosModulo['segmento']);

		//Selecciona el usuario que se ha logueado.
		$usuario_session = $this->session->userdata('id');
		//$usuario_session = 5;

		//Obtiene el usuario y el centro del usuario que se ha logueado.
		$datosModulo['centroUsuario'] = $this->Centro_model->obtener_centro_usuario($usuario_session);

		$datosModulo['usuario'] = $this->Usuario_model->obtener_usuario($usuario_session);

		$datosModulo['pagina'] = 'Modulo';

		//Carga la cabecera con los datos del usuario logueado.
		$this->load->view('header_admin', $datosModulo);

		//Cargar la vista pasandole los datos del módulo seleccionado.
		$this->load->view('modulo/editar_modulo_admin', $datosModulo);

		//Carga el footer.
		$this->load->view('footer');
	}

	/*--------------------FIN FUNCIÓN EDITAR MODULO ADMIN------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN GUARDAR CAMBIOS MODULO------------------*/

	public function guardar_cambios_modulo()
	{
		//Array con los datos del módulo actualizado.
		$datosActualizado = array(
			'COD_Modulo' => $this->input->post('COD_Modulo'),
			'DESC_Modulo' => $this->input->post('DESC_Modulo'),
		);


		//Manda el módulo seleccionado a borrar_modulo.
	 	$idmoduloActualizar=$this->uri->segment(3);
	 	$this->Modulo_model->guardar_cambios_modulo($idmoduloActualizar,$datosActualizado);


	 	//Redirije a la página principal.
	 	redirect('Modulo');
	}

	/*--------------------FIN FUNCIÓN GUARDAR CAMBIOS MODULO------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN GUARDAR CAMBIOS MODULO ADMIN------------------*/

	public function guardar_cambios_modulo_admin()
	{
		//Array con los datos del módulo actualizado.
		$datosActualizado = array(
			'COD_Modulo' => $this->input->post('COD_Modulo'),
			'DESC_Modulo' => $this->input->post('DESC_Modulo'),
		);


		//Manda el módulo seleccionado a borrar_modulo.
	 	$idmoduloActualizar=$this->uri->segment(3);
	 	$this->Modulo_model->guardar_cambios_modulo($idmoduloActualizar,$datosActualizado);


	 	//Redirije a la página principal.
	 	redirect('Modulo/modulo_admin');
	}

	/*--------------------FIN FUNCIÓN GUARDAR CAMBIOS MODULO ADMIN------------------*/

}