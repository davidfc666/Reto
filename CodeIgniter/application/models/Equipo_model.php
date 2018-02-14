<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Equipo_model extends CI_Model{

	/*--------------------CONSTRUCTOR------------------*/

	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	/*--------------------FIN CONSTRUCTOR------------------*/


			public function obtener_equipo_reto($id){
		$query = $this->db->query("SELECT * FROM Equipo WHERE ID_Reto = $id");
		if ($query->num_rows() > 0){
			return $query;
		}else{
			return false;
		}
	}


	/*--------------------FUNCIÓN OBTENER EQUIPOS------------------*/

	//Función que obteniendo el parámetro "ID_Reto" de la función "obtener_equipos" de "Equipo.php" obtiene los equipos.
	public function obtener_equipos($id){

		$sql="SELECT ID_Equipo, COD_Equipo, DESC_Equipo FROM Equipo WHERE ID_Reto = $id";

		$consulta = $this->db->query($sql);

		if ($consulta->num_rows() > 0){
			return $consulta;
		}
		
		else{
			return false;
		}
	}

	/*--------------------FIN FUNCIÓN OBTENER EQUIPOS------------------*/


		public function obtener_equipo_usuarios($id){
		$query = $this->db->query("SELECT Equipo.DESC_Equipo, Usuario.User, Usuario.ID_Usuario FROM Equipo, Equipo_Usuario, Usuario WHERE Equipo.ID_Equipo = Equipo_Usuario.ID_Equipo AND Equipo_Usuario.ID_Usuario = Usuario.ID_Usuario AND Equipo.ID_Equipo = $id");
		if($query->num_rows() > 0){
			return $query;
		}else{
			return false;
		}
	}


	/*--------------------FUNCIÓN NUEVO EQUIPO------------------*/

	//Función que obteniendo el parámetro "datosNuevo" de la función "nuevo_equipo" de "Equipo.php" inserta un nuevo equipo a la base de datos.
	public function nuevo_equipo($datosNuevo){

		$this->db->insert('Equipo',$datosNuevo);

	}

	/*--------------------FIN FUNCIÓN NUEVO EQUIPO------------------*/	


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN BORRAR EQUIPO------------------*/

	//Función que obteniendo el parámetro "idequipoBorrar" de la función "borrar_equipo" de "Equipo.php" borra el equipo de la base de datos.
	public function borrar_equipo($idequipoBorrar){

		$this->db->where('ID_Equipo',$idequipoBorrar);
		$this->db->delete('Equipo');
	}

	/*--------------------FIN FUNCIÓN BORRAR EQUIPO------------------*/	


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN OBTENER EQUIPO------------------*/

	//Función que obteniendo el parámetro "ID_Equipo" de la función "guardar_cambios_equipo" de "Equipo.php" obtiene los datos del equipo seleccionado.
	public function obtener_equipo($datosEditar){

		$sql="SELECT ID_Equipo, COD_Equipo, DESC_Equipo FROM Equipo WHERE ID_Equipo = $datosEditar";

		$consulta = $this->db->query($sql);

		if ($consulta->num_rows() > 0){
			return $consulta;
		}
		
		else{
			return false;
		}
	}

	/*--------------------FIN FUNCIÓN OBTENER EQUIPO------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN GUARDAR CAMBIOS EQUIPO------------------*/

	//Función que obteniendo el parámetro "ID_Equipo", "COD_Equipo" y "DESC_Equipo" de la función "guardar_cambios_equipo" de "Equipo.php" obtiene los datos del equipo seleccionado.
	public function guardar_cambios_equipo($idequipoActualizar,$datosActualizado){

		$this->db->where('ID_Equipo',$idequipoActualizar);
		$this->db->update('Equipo',$datosActualizado);
	}

	/*--------------------FIN FUNCIÓN GUARDAR CAMBIOS EQUIPO------------------*/
}


?>