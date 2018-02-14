<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ciclo_model extends CI_Model{

/*--------------------CONSTRUCTOR------------------*/

	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	/*--------------------FIN CONSTRUCTOR------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN OBTENER CICLOS------------------*/

	//Función que obteniendo el parámetro "ID_Curso" e "ID_Centro" de la función "obtener_ciclos" de "Ciclo.php" obtiene los ciclos.
	public function obtener_ciclos($idcurso,$idcentro){

		$sql="SELECT ID_Ciclo, COD_Ciclo FROM Ciclo WHERE ID_Curso = (SELECT ID_Curso FROM Curso WHERE ID_Curso = $idcurso) AND ID_Centro = (SELECT ID_Centro FROM Centro WHERE ID_Centro = $idcentro)";

		$consulta = $this->db->query($sql);

		if ($consulta->num_rows() > 0){
			return $consulta;
		}
		
		else{
			return false;
		}
	}

	/*--------------------FIN FUNCIÓN OBTENER CICLOS------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN NUEVO CICLO------------------*/

	//Función que obteniendo el parámetro "datosNuevo" de la función "nuevo_ciclo" de "Ciclo.php" inserta un nuevo ciclo a la base de datos.
	public function nuevo_ciclo($datosNuevo){

		$this->db->insert('Ciclo',$datosNuevo);
	}

	/*--------------------FIN FUNCIÓN NUEVO CICLO------------------*/		


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN BORRAR CICLO------------------*/

	//Función que obteniendo el parámetro "idcicloBorrar" de la función "borrar_ciclo" de "Ciclo.php" borra el ciclo de la base de datos.
	public function borrar_ciclo($idcicloBorrar){

		$this->db->where('ID_Ciclo',$idcicloBorrar);
		$this->db->delete('Ciclo');
	}

	/*--------------------FIN FUNCIÓN BORRAR CICLO------------------*/	


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN OBTENER CICLO------------------*/

	//Función que obteniendo el parámetro "ID_Ciclo" de la función "guardar_cambios_ciclo" de "Ciclo.php" obtiene los datos del ciclo seleccionado.
	public function obtener_ciclo($datosEditar){

		$sql="SELECT ID_Ciclo, COD_Ciclo, DESC_Ciclo FROM Ciclo WHERE ID_Ciclo = $datosEditar";

		$consulta = $this->db->query($sql);

		if ($consulta->num_rows() > 0){
			return $consulta;
		}
		
		else{
			return false;
		}
	}

	/*--------------------FIN FUNCIÓN OBTENER CICLO------------------*/


		public function obtener_ciclos_ajax($idcurso,$desccentro){

		$sql="SELECT ID_Ciclo, COD_Ciclo FROM Ciclo WHERE ID_Curso = (SELECT ID_Curso FROM Curso WHERE ID_Curso = $idcurso) AND ID_Centro = (SELECT ID_Centro FROM Centro WHERE DESC_Centro = '$desccentro')";

		$consulta = $this->db->query($sql);

		if ($consulta->num_rows() > 0){
			return $consulta;
		}
		
		else{
			return false;
		}
	}



	/*--------------------FUNCIÓN GUARDAR CAMBIOS CICLO------------------*/

	//Función que obteniendo el parámetro "ID_Ciclo", "COD_Ciclo" y "DESC_Ciclo" de la función "guardar_cambios_ciclo" de "Ciclo.php" obtiene los datos del ciclo seleccionado.
	public function guardar_cambios_ciclo($idcicloActualizar,$datosActualizado){

		$this->db->where('ID_Ciclo',$idcicloActualizar);
		$this->db->update('Ciclo',$datosActualizado);
	}

	/*--------------------FIN FUNCIÓN GUARDAR CAMBIOS CICLO------------------*/
}


?>