<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Equipo_Usuario_model extends CI_Model{

	/*--------------------CONSTRUCTOR------------------*/

	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	/*--------------------FIN CONSTRUCTOR------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN OBTENER EQUIPOS USUARIOS------------------*/

	//Función que obteniendo el parámetro "ID_Equipo" de la función "obtener_equipos_usuarios" de "Equipo_Usuario.php" obtiene los usuarios asignados al equipo seleccionado.
	public function obtener_equipos_usuarios($idequipo){

		$sql="SELECT * FROM Equipo e, Usuario u, TUsuario tu, Equipo_Usuario eu WHERE u.ID_Usuario = eu.ID_Usuario AND u.ID_TUsuario = tu.ID_TUsuario AND e.ID_Equipo = $idequipo AND eu.ID_Equipo = $idequipo";

		$consulta = $this->db->query($sql);

		if ($consulta->num_rows() > 0){
			return $consulta;
		}
		
		else{
			return false;
		}
	}

	/*--------------------FIN FUNCIÓN OBTENER EQUIPOS USUARIOS------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN OBTENER USUARIOS TIPO MODULO------------------*/

	//Función que obteniendo los parámetros "ID_Modulo" e "ID_TUsuario" de la función "obtener_usuarios_tipo_modulo" de "Usuario_Modulo.php" obtiene los usuarios ségún el tipo de usuario y el módulo seleccionado.
	public function obtener_usuarios_tipo_modulo($idmodulo, $idtipo){

		$sql="SELECT * FROM Centro ce, Ciclo ci, Curso cu, Modulo mo, Usuario u, Usuario_Modulo um WHERE ce.ID_Centro = u.ID_Centro AND ce.ID_Centro = ci.ID_Centro AND ci.ID_Ciclo = mo.ID_Ciclo AND cu.ID_Curso = ci.ID_Curso AND mo.ID_Modulo = um.ID_Modulo AND u.ID_Usuario = um.ID_Usuario AND u.ID_TUsuario = $idtipo AND mo.ID_Modulo = $idmodulo";

		$consulta = $this->db->query($sql);

		if ($consulta->num_rows() > 0){
			return $consulta;
		}
		
		else{
			return false;
		}
	}

	/*--------------------FIN FUNCIÓN OBTENER USUARIOS TIPO------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN OBTENER EQUIPOS USUARIOS USUARIO------------------*/

	//Función que obteniendo el parámetro "ID_Usuario" de la función "obtener_equipos_usuarios" de "Equipo_Usuario.php" obtiene los usuarios asignados al equipo seleccionado.
	public function obtener_equipos_usuarios_usuario($idusuario){

		$sql="SELECT * FROM Usuario u, TUsuario tu WHERE u.ID_Usuario = $idusuario AND u.ID_TUsuario = tu.ID_TUsuario";

		$consulta = $this->db->query($sql);

		if ($consulta->num_rows() > 0){
			return $consulta;
		}
		
		else{
			return false;
		}
	}

	/*--------------------FIN FUNCIÓN OBTENER EQUIPOS USUARIOS USUARIO------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN NUEVO EQUIPO USUARIO CREAR------------------*/

	//Función que obteniendo el parámetro "Usuario" de la función "nuevo_equipo_usuario_crear" de "Equipo_Usuario.php" inserta una nueva relación usuario-equipo a la base de datos.
	public function nuevo_equipo_usuario_crear($datosCrear){

		$this->db->insert('Equipo_Usuario',$datosCrear);

	}

	/*--------------------FIN FUNCIÓN NUEVO EQUIPO USUARIO CREAR------------------*/	


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN BORRAR EQUIPO USUARIO------------------*/

	//Función que obteniendo el parámetro "idusuarioBorrar" de la función "borrar_equipo_usuario" de "Equipo_Usuario.php" borra el equipo-usuario de la base de datos.
	public function borrar_equipo_usuario($idusuarioBorrar){

		$this->db->where('ID_Equipo_Alumno',$idusuarioBorrar);
		$this->db->delete('Equipo_Usuario');
	}

	/*--------------------FIN FUNCIÓN BORRAR EQUIPO USUARIO------------------*/	


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN OBTENER EQUIPO USUARIO------------------*/

	//Función que obteniendo el parámetro "ID_Equipo_Alumno" de la función "guardar_cambios_equipo_usuario" de "Equipo_Usuario.php" obtiene los datos del usuario seleccionado.
	public function obtener_equipo_usuario($datosEditar, $datoModulo){

		$sql="SELECT * FROM Usuario u, TUsuario tu, Usuario_Modulo um, Modulo m, Curso cu, Centro ce, Ciclo ci, Reto r, Reto_Modulo rm, Equipo e, Equipo_Usuario eu WHERE u.ID_Usuario = um.ID_Usuario AND u.ID_TUsuario = tu.ID_TUsuario AND m.ID_Modulo = um.ID_Modulo AND cu.ID_Curso = ci.ID_Curso AND ce.ID_Centro = ci.ID_Centro AND ci.ID_Ciclo = m.ID_Ciclo AND e.ID_Equipo = eu.ID_Equipo AND r.ID_Reto = rm.ID_Reto AND m.ID_Modulo = rm.ID_Modulo AND u.ID_Usuario = eu.ID_Usuario AND r.ID_Reto = e.ID_Reto AND eu.ID_Equipo_Alumno = $datosEditar AND m.ID_Modulo = $datoModulo";


		$consulta = $this->db->query($sql);

		if ($consulta->num_rows() > 0){
			return $consulta;
		}
		
		else{
			return false;
		}
	}

	/*--------------------FIN FUNCIÓN OBTENER EQUIPO USUARIO------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN GUARDAR CAMBIOS EQUIPO USUARIO------------------*/

	//Función que obteniendo el parámetro de la función "guardar_cambios_equipo_usuario" de "Equipo_Usuario.php" obtiene los datos del equipo-usuario seleccionado.
	public function guardar_cambios_equipo_usuario($idusuarioActualizar, $datoEquipo, $datoRol){

		$sql="UPDATE Equipo_Usuario SET ID_Equipo = $datoEquipo, COD_Rol = '".$datoRol."' WHERE ID_Equipo_Alumno = $idusuarioActualizar";

		$consulta = $this->db->query($sql);
	}

	/*--------------------FIN FUNCIÓN GUARDAR CAMBIOS EQUIPO USUARIO------------------*/
}


?>