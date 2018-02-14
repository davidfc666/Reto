<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alumno_model extends CI_Model{

	function __construct(){
		parent::__construct();
		$this->load->database();
	}

		public function obtener_nombre($id){
		$query = "SELECT * FROM Usuario WHERE ID_Usuario = ".$id;
		$query = $this->db->query($query);
		if ($query->num_rows() > 0){
			return $query;
		}else{
			return false;
		}
	}	


		public function obtener_equipo($idusu,$idreto){
		$query = "SELECT * FROM Equipo, Equipo_Usuario WHERE Equipo_Usuario.ID_Usuario = $idusu AND Equipo_Usuario.ID_Equipo = Equipo.ID_Equipo AND Equipo.ID_Reto = $idreto ";
		$query = $this->db->query($query);
		if ($query->num_rows() > 0){
			return $query;
		}else{
			return false;
		}
	}


		public function obtener_miembros($idequipo){
		$query = "SELECT * FROM Usuario, Equipo_Usuario WHERE  Equipo_Usuario.ID_Equipo = $idequipo AND Equipo_Usuario.ID_Usuario = Usuario.ID_Usuario";
		$query = $this->db->query($query);
		if ($query->num_rows() > 0){
			return $query;
		}else{
			return false;
		}
	}





	
}


?>