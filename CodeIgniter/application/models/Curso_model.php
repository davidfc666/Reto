<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Curso_model extends CI_Model{

	/*--------------------CONSTRUCTOR------------------*/

	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	/*--------------------FIN CONSTRUCTOR------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN OBTENER CURSOS------------------*/

	public function obtener_cursos(){

		$consulta = $this->db->get('Curso');

		if ($consulta->num_rows() > 0){
			return $consulta;
		}
		else{
			return false;
		}
	}

	/*--------------------FIN FUNCIÓN OBTENER CURSOS------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN NUEVO CURSO------------------*/

	//Función que obteniendo el parámetro "datosNuevo" de la función "nuevo_curso" de "Curso.php" inserta un nuevo curso a la base de datos.
	public function nuevo_curso($datosNuevo){

		$this->db->insert('Curso',$datosNuevo);
	}

	/*--------------------FIN FUNCIÓN NUEVO CURSO------------------*/		


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN BORRAR CURSO------------------*/

	//Función que obteniendo el parámetro "idcursoBorrar" de la función "borrar_curso" de "Curso.php" borra el curso de la base de datos.
	public function borrar_curso($idcursoBorrar){

		$this->db->where('ID_Curso',$idcursoBorrar);
		$this->db->delete('Curso');
	}

	/*--------------------FIN FUNCIÓN BORRAR CURSO------------------*/	


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN OBTENER CURSO------------------*/

	//Función que obteniendo el parámetro "ID_Curso" de la función "guardar_cambios_curso" de "Curso.php" obtiene los datos del curso seleccionado.
	public function obtener_curso($datosEditar){

		$sql="SELECT ID_Curso, COD_Curso FROM Curso WHERE ID_Curso = $datosEditar";

		$consulta = $this->db->query($sql);

		if ($consulta->num_rows() > 0){
			return $consulta;
		}
		
		else{
			return false;
		}
	}

	/*--------------------FIN FUNCIÓN OBTENER CURSO------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN GUARDAR CAMBIOS CURSO------------------*/

	//Función que obteniendo el parámetro "ID_Curso" y "COD_Curso" de la función "guardar_cambios_curso" de "Curso.php" obtiene los datos del cursp seleccionado.
	public function guardar_cambios_curso($idcursoActualizar,$datosActualizado){

		$this->db->where('ID_Curso',$idcursoActualizar);
		$this->db->update('Curso',$datosActualizado);
	}

	/*--------------------FIN FUNCIÓN GUARDAR CAMBIOS CURSO------------------*/

	
}


?>