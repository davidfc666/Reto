<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reto extends CI_Controller {

	/*--------------------CONSTRUCTOR------------------*/

	function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->helper('url');			
		$this->load->model('Reto_model');
		$this->load->model('Centro_model');	
		$this->load->model('Usuario_model');
		$this->load->library('session');	
	}

	/*--------------------FIN CONSTRUCTOR------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN INDEX------------------*/

	public function index()
	{

		//Lista los centros.
		$datos['centros'] = $this->Centro_model->obtener_centros();


		//Selecciona el usuario que se ha logueado.
		$usuario_session = $this->session->userdata('id');
		//$usuario_session = 5;

		//Obtiene el usuario y el centro del usuario que se ha logueado.
		$datos['centroUsuario'] = $this->Centro_model->obtener_centro_usuario($usuario_session);

		$datos['usuario'] = $this->Usuario_model->obtener_usuario($usuario_session);

		$datos['pagina'] = 'Reto';

		//Carga la cabecera con los datos del usuario logueado.
		$this->load->view('header_superadmin', $datos);

		//Carga la vista "listar_reto" pasandole los datos (retos).
		$this->load->view('reto/listar_reto',$datos);

		//Carga el footer.
		$this->load->view('footer');

	}

	/*--------------------FIN FUNCIÓN INDEX------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN RETO ADMIN------------------*/

	public function reto_admin()
	{

		//Selecciona el usuario que se ha logueado.
		$usuario_session = $this->session->userdata('id');
		//$usuario_session = 5;

		//Obtiene el usuario y el centro del usuario que se ha logueado.
		$datos['centroUsuario'] = $this->Centro_model->obtener_centro_usuario($usuario_session);

		$datos['usuario'] = $this->Usuario_model->obtener_usuario($usuario_session);

		$centroid = $datos['centroUsuario']->result()[0]->ID_Centro;

		//Lista los retos de ese centro.
		$datos['retos'] = $this->Reto_model->obtener_retos($centroid);

		$datos['pagina'] = 'Reto';

		//Carga la cabecera con los datos del usuario logueado.
		$this->load->view('header_admin', $datos);

		//Carga la vista "listar_reto" pasandole los datos (retos).
		$this->load->view('reto/listar_reto_admin',$datos);

		//Carga el footer.
		$this->load->view('footer');

	}

	/*--------------------FIN FUNCIÓN RETO ADMIN------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN RETOS------------------*/

	public function obtener_retos()
	{		
		//Función que mediante Ajax pasandole a la función "obtener_modulos" de "Modulo_model.php" el parámetro "ID_Ciclo" obtiene los módulos.
	 	$idcentro=$this->input->post('ID_Centro');
	 	$retos=$this->Reto_model->obtener_retos($idcentro);
 		echo json_encode($retos->result());
	}

	/*--------------------FIN FUNCIÓN RETOS------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN NUEVO RETO------------------*/

	public function nuevo_reto()
	{
		//Lista los centros.
		$datos['centros'] = $this->Centro_model->obtener_centros();


		//Selecciona el usuario que se ha logueado.
		$usuario_session = $this->session->userdata('id');
		//$usuario_session = 5;

		//Obtiene el usuario y el centro del usuario que se ha logueado.
		$datos['centroUsuario'] = $this->Centro_model->obtener_centro_usuario($usuario_session);

		$datos['usuario'] = $this->Usuario_model->obtener_usuario($usuario_session);

		$datos['pagina'] = 'Reto';

		//Carga la cabecera con los datos del usuario logueado.
		$this->load->view('header_superadmin', $datos);

		//Carga la vista "nuevo_reto" pasandole los datos (retos).
		$this->load->view('reto/nuevo_reto',$datos);

		//Carga el footer.
		$this->load->view('footer');

		//Si se ha mandado el formulario.
		if(isset($_POST['Crear'])){

			//Array con los datos del nuevo reto.
			$datosNuevo = array(
				'COD_Reto' => $this->input->post('COD_Reto'),
				'DESC_Reto' => $this->input->post('DESC_Reto'),
				'ID_Centro' => $this->input->post('ID_Centro_Formulario'),
			);

			//Manda a "nuevo_reto" de "Reto_model.php" el array "datosNuevo" para añadir un nuevo reto a la base de datos.
			$retoNuevo = $this->Reto_model->nuevo_reto($datosNuevo);
		}
	}

	/*--------------------FIN FUNCIÓN NUEVO RETO------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN NUEVO RETO ADMIN------------------*/

	public function nuevo_reto_admin()
	{


		//Selecciona el usuario que se ha logueado.
		$usuario_session = $this->session->userdata('id');
		//$usuario_session = 5;

		//Obtiene el usuario y el centro del usuario que se ha logueado.
		$datos['centroUsuario'] = $this->Centro_model->obtener_centro_usuario($usuario_session);

		$datos['usuario'] = $this->Usuario_model->obtener_usuario($usuario_session);

		$datos['pagina'] = 'Reto';

		//Carga la cabecera con los datos del usuario logueado.
		$this->load->view('header_admin', $datos);

		//Carga la vista "nuevo_reto" pasandole los datos (retos).
		$this->load->view('reto/nuevo_reto_admin',$datos);

		//Carga el footer.
		$this->load->view('footer');

		//Si se ha mandado el formulario.
		if(isset($_POST['Crear'])){

			//Array con los datos del nuevo reto.
			$datosNuevo = array(
				'COD_Reto' => $this->input->post('COD_Reto'),
				'DESC_Reto' => $this->input->post('DESC_Reto'),
				'ID_Centro' => $this->input->post('ID_Centro_Formulario'),
			);

			//Manda a "nuevo_reto" de "Reto_model.php" el array "datosNuevo" para añadir un nuevo reto a la base de datos.
			$retoNuevo = $this->Reto_model->nuevo_reto($datosNuevo);
		}
	}

	/*--------------------FIN FUNCIÓN NUEVO RETO ADMIN------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN BORRAR RETO------------------*/

	public function borrar_reto()
	{		
		//Manda el reto seleccionado a borrar_reto.
	 	$idretoBorrar=$this->uri->segment(3);
	 	$this->Reto_model->borrar_reto($idretoBorrar);

	 	//Redirije a la página principal.
	 	redirect('Reto');
	}

	/*--------------------FIN FUNCIÓN BORRAR RETO------------------*/


		    public function inforetos_json()
    {
   	 $idcurso=$this->input->post('ID_Curso');
   	 $idciclo=$this->input->post('ID_Ciclo');
   	 $idmodulo=$this->input->post('ID_Modulo');
   	 $retos=$this->Reto_model->obtener_retos_datos($idcurso,$idciclo,$idmodulo);
   	 echo json_encode($retos->result());
    }


	/*--------------------FUNCIÓN BORRAR RETO ADMIN------------------*/

	public function borrar_reto_admin()
	{		
		//Manda el reto seleccionado a borrar_reto.
	 	$idretoBorrar=$this->uri->segment(3);
	 	$this->Reto_model->borrar_reto($idretoBorrar);

	 	//Redirije a la página principal.
	 	redirect('Reto/reto_admin');
	}

	/*--------------------FIN FUNCIÓN BORRAR RETO ADMIN------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN EDITAR RETO------------------*/

	public function editar_reto()
	{
		//Obtener los datos del reto seleccionado.
		$datos['segmento'] = $this->uri->segment(3);
		$datos['reto'] = $this->Reto_model->obtener_reto($datos['segmento']);


		//Selecciona el usuario que se ha logueado.
		$usuario_session = $this->session->userdata('id');
		//$usuario_session = 5;

		//Obtiene el usuario y el centro del usuario que se ha logueado.
		$datos['centroUsuario'] = $this->Centro_model->obtener_centro_usuario($usuario_session);

		$datos['usuario'] = $this->Usuario_model->obtener_usuario($usuario_session);

		$datos['pagina'] = 'Reto';

		//Carga la cabecera con los datos del usuario logueado.
		$this->load->view('header_superadmin', $datos);

		//Cargar la vista pasandole los datos del reto seleccionado.
		$this->load->view('reto/editar_reto', $datos);

		//Carga el footer.
		$this->load->view('footer');
	}

	/*--------------------FIN FUNCIÓN EDITAR RETO------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN EDITAR RETO ADMIN------------------*/

	public function editar_reto_admin()
	{
		//Obtener los datos del reto seleccionado.
		$datos['segmento'] = $this->uri->segment(3);
		$datos['reto'] = $this->Reto_model->obtener_reto($datos['segmento']);


		//Selecciona el usuario que se ha logueado.
		$usuario_session = $this->session->userdata('id');
		//$usuario_session = 5;

		//Obtiene el usuario y el centro del usuario que se ha logueado.
		$datos['centroUsuario'] = $this->Centro_model->obtener_centro_usuario($usuario_session);

		$datos['usuario'] = $this->Usuario_model->obtener_usuario($usuario_session);

		$datos['pagina'] = 'Reto';

		//Carga la cabecera con los datos del usuario logueado.
		$this->load->view('header_admin', $datos);

		//Cargar la vista pasandole los datos del reto seleccionado.
		$this->load->view('reto/editar_reto_admin', $datos);

		//Carga el footer.
		$this->load->view('footer');
	}

	/*--------------------FIN FUNCIÓN EDITAR RETO ADMIN------------------*/


		
		public function obtener_retos_ajax(){
		$usuario_sesion = $this->session->userdata('id');
		

		$idcurso=$this->input->post('ID_Curso');
		$idciclo=$this->input->post('ID_Ciclo');
	 	$ciclos=$this->Reto_model->obtener_retos_ajax($idcurso,$idciclo,$usuario_sesion);
 		echo json_encode($ciclos->result());


 		//echo ("IDCURSO: ".$idcurso."   IDCICLO: ".$idciclo);
	}



	/*--------------------FUNCIÓN GUARDAR CAMBIOS RETO------------------*/

	public function guardar_cambios_reto()
	{
		//Array con los datos del reto actualizado.
		$datosActualizado = array(
			'COD_Reto' => $this->input->post('COD_Reto'),
			'DESC_Reto' => $this->input->post('DESC_Reto'),
		);


		//Manda el reto seleccionado a borrar_reto.
	 	$idretoActualizar=$this->uri->segment(3);
	 	$this->Reto_model->guardar_cambios_reto($idretoActualizar,$datosActualizado);


	 	//Redirije a la página principal.
	 	redirect('Reto');
	}

	/*--------------------FIN FUNCIÓN GUARDAR CAMBIOS RETO------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN GUARDAR CAMBIOS RETO ADMIN------------------*/

	public function guardar_cambios_reto_admin()
	{
		//Array con los datos del reto actualizado.
		$datosActualizado = array(
			'COD_Reto' => $this->input->post('COD_Reto'),
			'DESC_Reto' => $this->input->post('DESC_Reto'),
		);


		//Manda el reto seleccionado a borrar_reto.
	 	$idretoActualizar=$this->uri->segment(3);
	 	$this->Reto_model->guardar_cambios_reto($idretoActualizar,$datosActualizado);


	 	//Redirije a la página principal.
	 	redirect('Reto/reto_admin');
	}

	/*--------------------FIN FUNCIÓN GUARDAR CAMBIOS RETO ADMIN------------------*/

}