<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Centro_model extends CI_Model{

	/*--------------------CONSTRUCTOR------------------*/

	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	/*--------------------FIN CONSTRUCTOR------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN OBTENER CENTRO USUARIO------------------*/


	public function obtener_centro_usuario($id_usuario){
		$query = "SELECT Centro.ID_Centro, DESC_Centro FROM Centro, Usuario WHERE Usuario.ID_Centro = Centro.ID_Centro AND Usuario.ID_Usuario = $id_usuario";
		$query = $this->db->query($query);
		if ($query->num_rows() > 0){
			return $query;
		}else{
			return false;
		}

	}

	/*--------------------FIN OBTENER CENTRO USUARIO------------------*/


		public function obtener_centro_alumno($id_alumno){
		$query = "SELECT Centro.ID_Centro, DESC_Centro FROM Centro, Usuario WHERE Usuario.ID_Centro = Centro.ID_Centro AND Usuario.ID_Usuario = $id_alumno";
		$query = $this->db->query($query);
		if ($query->num_rows() > 0){
			return $query;
		}else{
			return false;
		}

	}


	/*--------------------FUNCIÓN OBTENER CENTROS------------------*/

	//Función que obtiene los centros.
	public function obtener_centros(){

		$consulta = $this->db->get('Centro');

		if ($consulta->num_rows() > 0){
			return $consulta;
		}
		
		else{
			return false;
		}
	}

	/*--------------------FIN FUNCIÓN OBTENER CENTROS------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN NUEVO CENTRO------------------*/

	//Función que obteniendo el parámetro "datosNuevo" de la función "nuevo_centro" de "Centro.php" inserta un nuevo centro a la base de datos.
	public function nuevo_centro($datosNuevo){

		$this->db->insert('Centro',$datosNuevo);
	}

	/*--------------------FIN FUNCIÓN NUEVO CENTRO------------------*/		


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN BORRAR CENTRO------------------*/

	//Función que obteniendo el parámetro "idcentroBorrar" de la función "borrar_centro" de "Centro.php" borra el centro de la base de datos.
	public function borrar_centro($idcentroBorrar){

		$this->db->where('ID_Centro',$idcentroBorrar);
		$this->db->delete('Centro');
	}

	/*--------------------FIN FUNCIÓN BORRAR CENTRO------------------*/	


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN OBTENER CENTRO------------------*/

	//Función que obteniendo el parámetro "ID_Centro" de la función "guardar_cambios_centro" de "Centro.php" obtiene los datos del centro seleccionado.
	public function obtener_centro($datosEditar){

		$sql="SELECT ID_Centro, COD_Centro, DESC_Centro FROM Centro WHERE ID_Centro = $datosEditar";

		$consulta = $this->db->query($sql);

		if ($consulta->num_rows() > 0){
			return $consulta;
		}
		
		else{
			return false;
		}
	}

	/*--------------------FIN FUNCIÓN OBTENER CENTRO------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN GUARDAR CAMBIOS CENTRO------------------*/

	//Función que obteniendo el parámetro "ID_Centro", "COD_Centro" y "DESC_Centro" de la función "guardar_cambios_centro" de "Centro.php" obtiene los datos del centro seleccionado.
	public function guardar_cambios_centro($idcentroActualizar,$datosActualizado){

		$this->db->where('ID_Centro',$idcentroActualizar);
		$this->db->update('Centro',$datosActualizado);
	}

	/*--------------------FIN FUNCIÓN GUARDAR CAMBIOS CENTRO------------------*/
}


?>