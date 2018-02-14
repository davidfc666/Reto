<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_Modulo_model extends CI_Model{

	/*--------------------CONSTRUCTOR------------------*/

	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	/*--------------------FIN CONSTRUCTOR------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN OBTENER USUARIOS MODULOS------------------*/

	//Función que obteniendo el parámetro "ID_Modulo" de la función "obtener_usuarios_modulos" de "Usuario_Modulo.php" obtiene los usuarios asignados al módulo seleccionado.
	public function obtener_usuarios_modulos($idmodulo){

		$sql="SELECT * FROM Usuario u, Usuario_Modulo um, TUsuario t WHERE t.ID_TUsuario = u.ID_TUsuario AND u.ID_Usuario = um.ID_Usuario AND um.ID_Modulo = $idmodulo";

		$consulta = $this->db->query($sql);

		if ($consulta->num_rows() > 0){
			return $consulta;
		}
		
		else{
			return false;
		}
	}

	/*--------------------FIN FUNCIÓN OBTENER USUARIOS MODULOS------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN OBTENER USUARIOS TIPO------------------*/

	//Función que obteniendo los parámetros "ID_Centro" e "ID_TUsuario" de la función "obtener_usuarios_tipo" de "Usuario_Modulo.php" obtiene los usuarios  ségún el tipo de usuario y el centro seleccionado.
	public function obtener_usuarios_tipo($idcentro, $idtipo){

		$sql="SELECT * FROM Usuario WHERE ID_TUsuario = $idtipo AND ID_Centro = $idcentro";

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


	/*--------------------FUNCIÓN OBTENER USUARIO ID------------------*/

	//Función que obteniendo el parámetro "ID_Usuario" de la función "obtener_usuarios_id" de "Usuario_Modulo.php" obtiene el usuario ségún el id usuario seleccionado.
	public function obtener_usuario_id($idusuario){

		$sql="SELECT * FROM Usuario WHERE ID_Usuario = $idusuario";

		$consulta = $this->db->query($sql);

		if ($consulta->num_rows() > 0){
			return $consulta;
		}
		
		else{
			return false;
		}
	}

	/*--------------------FIN FUNCIÓN OBTENER USUARIO ID------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN NUEVO USUARIO MÓDULO------------------*/

	//Función que obteniendo el parámetro "datosUsuario" y "datosModulo" de la función "nuevo_usuario_modulo" de "Usuario_Modulo.php" inserta una nueva relación usuario-módulo a la base de datos.
	public function nuevo_usuario_modulo($datosCrear){

		$this->db->insert('Usuario_Modulo',$datosCrear);

	}

	/*--------------------FIN FUNCIÓN NUEVO USUARIO MÓDULO------------------*/	


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN BORRAR USUARIO MÓDULO------------------*/

	//Función que obteniendo el parámetro "idusuarioBorrar" de la función "borrar_usuario_modulo" de "Usuario_Modulo.php" borra el usuario-modulo de la base de datos.
	public function borrar_usuario_modulo($idusuarioBorrar){

		$this->db->where('ID_Usuario_Modulo',$idusuarioBorrar);
		$this->db->delete('Usuario_Modulo');
	}

	/*--------------------FIN FUNCIÓN BORRAR USUARIO MÓDULO------------------*/	


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN OBTENER USUARIO MÓDULO------------------*/

	//Función que obteniendo el parámetro "ID_Usuario" de la función "guardar_cambios_usuario_modulo" de "Usuario_Modulo.php" obtiene los datos del usuario seleccionado.
	public function obtener_usuario_modulo($datosEditar){

		$sql="SELECT * FROM Usuario u, TUsuario tu, Usuario_Modulo um, Modulo m, Curso cu, Centro ce, Ciclo ci WHERE u.ID_Usuario = um.ID_Usuario AND u.ID_TUsuario = tu.ID_TUsuario AND m.ID_Modulo = um.ID_Modulo AND cu.ID_Curso = ci.ID_Curso AND ce.ID_Centro = ci.ID_Centro AND ci.ID_Ciclo = m.ID_Ciclo AND um.ID_Usuario_Modulo = $datosEditar";

		$consulta = $this->db->query($sql);

		if ($consulta->num_rows() > 0){
			return $consulta;
		}
		
		else{
			return false;
		}
	}

	/*--------------------FIN FUNCIÓN OBTENER USUARIO MÓDULO------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN GUARDAR CAMBIOS USUARIO MÓDULO------------------*/

	//Función que obteniendo el parámetro de la función "guardar_cambios_usuario_modulo" de "Usuario_Modulo.php" obtiene los datos del usuario-modulo seleccionado.
	public function guardar_cambios_usuario_modulo($idusuarioActualizar,$datosActualizado){

		$sql="UPDATE Usuario_Modulo SET ID_Modulo = $datosActualizado WHERE ID_Usuario_Modulo = $idusuarioActualizar";

		$consulta = $this->db->query($sql);
	}

	/*--------------------FIN FUNCIÓN GUARDAR CAMBIOS USUARIO MÓDULO------------------*/
}


?>