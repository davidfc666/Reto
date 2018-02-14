<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reto_model extends CI_Model{

	/*--------------------CONSTRUCTOR------------------*/

	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	/*--------------------FIN CONSTRUCTOR------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN OBTENER RETOS------------------*/

	public function obtener_retos($centro){

		$sql="SELECT * FROM Reto WHERE ID_Centro = $centro";

		$consulta = $this->db->query($sql);

		if ($consulta->num_rows() > 0){
			return $consulta;
		}
		
		else{
			return false;
		}
	}

	/*--------------------FIN FUNCIÓN OBTENER RETOS------------------*/


	 public function obtener_nombre($id){
   	 $query = $this->db->query("SELECT COD_Reto FROM Reto WHERE ID_Reto = $id");
   	 if($query->num_rows() > 0){
   		 return $query;
   	 }else{
   		 return false;
   	 }
    }


	/*--------------------FUNCIÓN NUEVO RETO------------------*/

	//Función que obteniendo el parámetro "datosNuevo" de la función "nuevo_reto" de "Reto.php" inserta un nuevo reto a la base de datos.
	public function nuevo_reto($datosNuevo){

		$this->db->insert('Reto',$datosNuevo);
	}

	/*--------------------FIN FUNCIÓN NUEVO RETO------------------*/		


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN BORRAR RETO------------------*/

	//Función que obteniendo el parámetro "idretoBorrar" de la función "borrar_reto" de "Reto.php" borra el reto de la base de datos.
	public function borrar_reto($idretoBorrar){

		$this->db->where('ID_Reto',$idretoBorrar);
		$this->db->delete('Reto');
	}

	/*--------------------FIN FUNCIÓN BORRAR RETO------------------*/	


	    public function obtener_retos_datos($idcurso, $idciclo, $idmodulo){
   	 $query = $this->db->query("SELECT Reto.ID_Reto, Reto.COD_Reto, Modulo.COD_Modulo, Ciclo.COD_Ciclo , Curso.COD_Curso FROM Reto, Reto_Modulo, Modulo, Ciclo, Curso WHERE Reto.ID_Reto = Reto_Modulo.ID_Reto AND Reto_Modulo.ID_Modulo = Modulo.ID_Modulo AND Modulo.ID_Ciclo = Ciclo.ID_Ciclo AND Ciclo.ID_Curso = Curso.ID_Curso AND Reto_Modulo.ID_Modulo = $idmodulo AND Ciclo.ID_Ciclo = $idciclo AND Curso.ID_Curso = $idcurso");
   	 if($query->num_rows() > 0){
   		 return $query;
   	 }else{
   		 return false;
   	 }
    }


	/*--------------------FUNCIÓN OBTENER RETO------------------*/

	//Función que obteniendo el parámetro "ID_Reto" de la función "guardar_cambios_reto" de "Reto.php" obtiene los datos del reto seleccionado.
	public function obtener_reto($datosEditar){

		$sql="SELECT * FROM Reto WHERE ID_Reto = $datosEditar";

		$consulta = $this->db->query($sql);

		if ($consulta->num_rows() > 0){
			return $consulta;
		}
		
		else{
			return false;
		}
	}

	/*--------------------FIN FUNCIÓN OBTENER RETO------------------*/


		public function obtener_retos_ajax($idcurso, $idciclo, $usuario_sesion){
		$query = "SELECT DISTINCT(Reto.ID_Reto), Reto.COD_Reto,Ciclo.COD_Ciclo,Curso.COD_Curso FROM Curso, Ciclo, Modulo, Reto_Modulo, Reto, Equipo, Equipo_Usuario WHERE Curso.ID_Curso = $idcurso AND Ciclo.ID_Ciclo = $idciclo AND Equipo_Usuario.ID_Usuario = $usuario_sesion AND Curso.ID_Curso = Ciclo.ID_Curso AND Ciclo.ID_Ciclo = Modulo.ID_Ciclo AND Modulo.ID_Modulo = Reto_Modulo.ID_Modulo AND Reto_Modulo.ID_Reto = Reto.ID_Reto AND Equipo_Usuario.ID_Equipo = Equipo.ID_Equipo AND Equipo.ID_Reto = Reto.ID_Reto";
		$query = $this->db->query($query);
		if ($query->num_rows() > 0){
			return $query;
		}else{
			return false;
		}
	}


	/*--------------------FUNCIÓN GUARDAR CAMBIOS RETO------------------*/

	//Función que obteniendo el parámetro "ID_Reto", "COD_Reto" y "DESC_Reto" de la función "guardar_cambios_reto" de "Reto.php" obtiene los datos del reto seleccionado.
	public function guardar_cambios_reto($idretoActualizar,$datosActualizado){

		$this->db->where('ID_Reto',$idretoActualizar);
		$this->db->update('Reto',$datosActualizado);
	}

	/*--------------------FIN FUNCIÓN GUARDAR CAMBIOS RETO------------------*/

	
}


?>