<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TUsuario_model extends CI_Model{

	/*--------------------CONSTRUCTOR------------------*/

	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	/*--------------------FIN CONSTRUCTOR------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN OBTENER TIPOS DE USUARIOS------------------*/

	public function obtener_tusuarios(){

		$consulta = $this->db->get('TUsuario');

		if ($consulta->num_rows() > 0){
			return $consulta;
		}
		else{
			return false;
		}
	}

	/*--------------------FIN FUNCIÓN OBTENER TIPOS DE USUARIOS------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN NUEVO TIPO DE USUARIO------------------*/

	//Función que obteniendo el parámetro "datosNuevo" de la función "nuevo_tusuario" de "TUsuario.php" inserta un nuevo tipo de usuario a la base de datos.
	public function nuevo_tusuario($datosNuevo){

		$this->db->insert('TUsuario',$datosNuevo);
	}

	/*--------------------FIN FUNCIÓN NUEVO TIPO DE USUARIO------------------*/		


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN BORRAR TIPO DE USUARIO------------------*/

	//Función que obteniendo el parámetro "idtusuarioBorrar" de la función "borrar_tusuario" de "TUsuario.php" borra el tipo de usuario de la base de datos.
	public function borrar_tusuario($idtusuarioBorrar){

		$this->db->where('ID_TUsuario',$idtusuarioBorrar);
		$this->db->delete('TUsuario');
	}

	/*--------------------FIN FUNCIÓN BORRAR TIPO DE USUARIO------------------*/	


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN OBTENER TIPO DE USUARIO------------------*/

	//Función que obteniendo el parámetro "ID_TUsuario" de la función "guardar_cambios_tusuario" de "TUsuario.php" obtiene los datos del tipo de usuario seleccionado.
	public function obtener_tusuario($datosEditar){

		$sql="SELECT ID_TUsuario, DESC_TUsuario FROM TUsuario WHERE ID_TUsuario = $datosEditar";

		$consulta = $this->db->query($sql);

		if ($consulta->num_rows() > 0){
			return $consulta;
		}
		
		else{
			return false;
		}
	}

	/*--------------------FIN FUNCIÓN OBTENER TIPO DE USUARIO------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN GUARDAR CAMBIOS TIPO DE USUARIO------------------*/

	//Función que obteniendo el parámetro "ID_TUsuario" y "DESC_TUsuario" de la función "guardar_cambios_tusuario" de "TUsuario.php" obtiene los datos del tipo de usuario seleccionado.
	public function guardar_cambios_tusuario($idtusuarioActualizar,$datosActualizado){

		$this->db->where('ID_TUsuario',$idtusuarioActualizar);
		$this->db->update('TUsuario',$datosActualizado);
	}

	/*--------------------FIN FUNCIÓN GUARDAR CAMBIOS TIPO DE USUARIO------------------*/

	
}


?>