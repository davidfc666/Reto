<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Modulo_model extends CI_Model{

	/*--------------------CONSTRUCTOR------------------*/

	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	/*--------------------FIN CONSTRUCTOR------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN OBTENER MODULOS------------------*/

	//Función que obteniendo el parámetro "ID_Ciclo" de la función "obtener_modulos" de "Modulo.php" obtiene los módulos.
	public function obtener_modulos($id){

		$sql="SELECT ID_Modulo, COD_Modulo, DESC_Modulo FROM Modulo WHERE ID_Ciclo = (SELECT ID_Ciclo FROM Ciclo WHERE ID_Ciclo = $id)";

		$consulta = $this->db->query($sql);

		if ($consulta->num_rows() > 0){
			return $consulta;
		}
		
		else{
			return false;
		}
	}

	/*--------------------FIN FUNCIÓN OBTENER MODULOS------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN NUEVO MODULO------------------*/

	//Función que obteniendo el parámetro "datosNuevo" de la función "nuevo_modulo" de "Modulo.php" inserta un nuevo módulo a la base de datos.
	public function nuevo_modulo($datosNuevo){

		$this->db->insert('Modulo',$datosNuevo);
	}

	/*--------------------FIN FUNCIÓN NUEVO MODULO------------------*/		


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN BORRAR MODULO------------------*/

	//Función que obteniendo el parámetro "idmoduloBorrar" de la función "borrar_modulo" de "Modulo.php" borra el módulo de la base de datos.
	public function borrar_modulo($idmoduloBorrar){

		$this->db->where('ID_Modulo',$idmoduloBorrar);
		$this->db->delete('Modulo');
	}

	/*--------------------FIN FUNCIÓN BORRAR MODULO------------------*/	


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN OBTENER MODULO------------------*/

	//Función que obteniendo el parámetro "ID_Modulo" de la función "guardar_cambios_modulo" de "Modulo.php" obtiene los datos del módulo seleccionado.
	public function obtener_modulo($datosEditar){

		$sql="SELECT ID_Modulo, COD_Modulo, DESC_Modulo FROM Modulo WHERE ID_Modulo = $datosEditar";

		$consulta = $this->db->query($sql);

		if ($consulta->num_rows() > 0){
			return $consulta;
		}
		
		else{
			return false;
		}
	}

	/*--------------------FIN FUNCIÓN OBTENER MODULOS------------------*/


		 public function obtener_ciclos($id){
   	 $this->db->where('ID_Curso',$id);
   	 $query = $this->db->get('Ciclo');
   	 if ($query->num_rows() > 0){
   		 return $query;
   	 }else{
   		 return false;
   	 }
    }

     public function obtener_ciclos_user($id, $iduser){
   	 $query = $this->db->query("SELECT * FROM Ciclo WHERE ID_Curso = $id AND ID_Centro = (SELECT ID_Centro FROM Usuario WHERE ID_Usuario = $iduser)");
   	 if($query->num_rows() > 0){
   		 return $query;
   	 }else{
   		 return false;
   	 }
    }



	/*--------------------FIN FUNCIÓN OBTENER CICLOS------------------*/



	/*--------------------FUNCIÓN GUARDAR CAMBIOS MODULO------------------*/

	//Función que obteniendo el parámetro "ID_Modulo", "COD_Modulo" y "DESC_Modulo" de la función "guardar_cambios_modulo" de "Modulo.php" obtiene los datos del módulo seleccionado.
	public function guardar_cambios_modulo($idmoduloActualizar,$datosActualizado){

		$this->db->where('ID_Modulo',$idmoduloActualizar);
		$this->db->update('Modulo',$datosActualizado);
	}

	/*--------------------FIN FUNCIÓN GUARDAR CAMBIOS MODULOS------------------*/
}


?>