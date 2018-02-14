<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Reto_Modulo_model extends CI_Model{

	/*--------------------CONSTRUCTOR------------------*/

	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	/*--------------------FIN CONSTRUCTOR------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN OBTENER RETOS MODULOS------------------*/

	//Función que obteniendo el parámetro "ID_Modulo" de la función "obtener_retos_modulos" de "Reto_Modulo.php" obtiene los retos asignados al módulo seleccionado.
	public function obtener_retos_modulos($idmodulo){

		$sql="SELECT * FROM Reto r, Modulo m, Reto_Modulo rm WHERE r.ID_Reto = rm.ID_Reto AND m.ID_Modulo = rm.ID_Modulo AND rm.ID_Modulo = $idmodulo";

		$consulta = $this->db->query($sql);

		if ($consulta->num_rows() > 0){
			return $consulta;
		}
		
		else{
			return false;
		}
	}

	/*--------------------FIN FUNCIÓN OBTENER RETOS MODULOS------------------*/	


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN OBTENER ID_UADMIN DEL MODULO EN EL QUE SE CREA EL NUEVO RETO------------------*/

	//Función que obtiene el ID del usuario administrador del módulo en el que se crea el nuevo reto.
	public function obtener_id_uadmin($datosModulo){

		$consulta = "SELECT * FROM Usuario_Modulo um, Usuario u, Modulo m WHERE um.ID_Usuario=u.ID_Usuario AND m.ID_Modulo = um.ID_Modulo AND u.ID_TUsuario = '2' AND m.ID_Modulo = $datosModulo";
		$consulta = $this->db->query($consulta);

		if ($consulta->num_rows() > 0){

			return $consulta;
		}

		else{
			return false;
		}

		
	}

	/*--------------------FIN FUNCIÓN OBTENER ID_UADMIN DEL MODULO EN EL QUE SE CREA EL NUEVO RETO------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN OBTENER DATOS DEL RETO SELECCIONADO------------------*/

	//Función que obtiene los datos del reto seleccionado.
	public function obtener_reto_id($datosReto){

		$consulta = "SELECT * FROM Reto WHERE ID_Reto = $datosReto";
		$consulta = $this->db->query($consulta);

		if ($consulta->num_rows() > 0){

			return $consulta;
		}

		else{
			return false;
		}

		
	}

	/*--------------------FIN FUNCIÓN OBTENER DATOS DEL RETO SELECCIONADO------------------*/
	


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN NUEVO RETO MÓDULO------------------*/

	//Función que obteniendo el parámetro "datosReto" y "datosModulo" de la función "nuevo_reto_modulo" de "Reto_Modulo.php" inserta una nueva relación reto-módulo a la base de datos.
	public function nuevo_reto_modulo($datosCrear){

		$this->db->insert('Reto_Modulo',$datosCrear);

	}

	/*--------------------FIN FUNCIÓN NUEVO RETO MÓDULO------------------*/	


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN BORRAR RETO MÓDULO------------------*/

	//Función que obteniendo el parámetro "idretoBorrar" de la función "borrar_reto_modulo" de "Reto_Modulo.php" borra el reto-modulo de la base de datos.
	public function borrar_reto_modulo($idretoBorrar){

		$this->db->where('ID_Reto_modulo',$idretoBorrar);
		$this->db->delete('Reto_Modulo');
	}

	/*--------------------FIN FUNCIÓN BORRAR RETO MÓDULO------------------*/	


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN OBTENER RETO MÓDULO------------------*/

	//Función que obteniendo el parámetro "ID_Reto" de la función "guardar_cambios_reto_modulo" de "Reto_Modulo.php" obtiene los datos del reto seleccionado.
	public function obtener_reto_modulo($datosEditar){

		$sql="SELECT * FROM Reto r, Modulo m, Reto_Modulo rm, Curso cu, Centro ce, Ciclo ci WHERE r.ID_Reto = rm.ID_Reto AND m.ID_Modulo = rm.ID_Modulo AND cu.ID_Curso = ci.ID_Curso AND ce.ID_Centro = ci.ID_Centro AND ci.ID_Ciclo = m.ID_Ciclo AND rm.ID_Reto_modulo = $datosEditar";

		$consulta = $this->db->query($sql);

		if ($consulta->num_rows() > 0){
			return $consulta;
		}
		
		else{
			return false;
		}
	}

	/*--------------------FIN FUNCIÓN OBTENER RETO MÓDULO------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN GUARDAR CAMBIOS RETO MÓDULO------------------*/

	//Función que obteniendo el parámetro de la función "guardar_cambios_reto_modulo" de "Reto_Modulo.php" obtiene los datos del reto-modulo seleccionado.
	public function guardar_cambios_reto_modulo($idretoActualizar,$datosModulo, $datosAdmin){

		$sql="UPDATE Reto_Modulo SET ID_Modulo = $datosModulo, ID_UAdmin = $datosAdmin WHERE ID_Reto_modulo = $idretoActualizar";

		$consulta = $this->db->query($sql);
	}

	/*--------------------FIN FUNCIÓN GUARDAR CAMBIOS RETO MÓDULO------------------*/
}


?>