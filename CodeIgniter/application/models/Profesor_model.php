<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profesor_model extends CI_Model{

	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	public function obtener_usuarios(){
		$query = "SELECT ID_Usuario, DESC_Centro, DESC_TUsuario, User, Nombre, Apellidos, Email, Dni FROM Usuario, Centro, TUsuario WHERE Usuario.ID_Centro=Centro.ID_Centro AND Usuario.ID_TUsuario=TUsuario.ID_TUsuario";
		$query = $this->db->query($query);
		if ($query->num_rows() > 0){
			return $query;
		}else{
			return false;
		}
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

	public function obtener_retos($id){
		$query = $this->db->query("SELECT * FROM Reto WHERE ID_Reto = (SELECT ID_Reto FROM Reto_Modulo WHERE ID_Modulo = $id)");
		if($query->num_rows() > 0){
			return $query;
		}else{
			return false;
		}
	}

	
}


?>