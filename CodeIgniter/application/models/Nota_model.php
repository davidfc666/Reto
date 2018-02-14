<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nota_model extends CI_Model{

	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function obtener_nota_alumno_alumnos($idreto, $iduser, $idcompetencia, $idevaluador){
		$query = $this->db->query("SELECT ID_Nota FROM Notas WHERE ID_Reto = $idreto AND ID_Usuario = $iduser AND ID_Competencia = $idcompetencia AND ID_Evaluador = $idevaluador");
		if ($query->num_rows() > 0){
			return $query->result()[0]->ID_Nota;
		}else{
			return 0;
		}
	}
		

	public function obtener_nota_alumno($idreto, $iduser, $idcompetencia){
		$query = $this->db->query("SELECT ID_Nota FROM Notas WHERE ID_Reto = $idreto AND ID_Usuario = $iduser AND ID_Competencia = $idcompetencia AND ID_Medicion = 3");
		if ($query->num_rows() > 0){
			return $query->result()[0]->ID_Nota;
		}else{
			return 0;
		}
	}

	public function obtener_notas($iduser, $idreto){
		$query = $this->db->query("SELECT * FROM `Notas` WHERE `ID_Usuario` = $iduser AND `ID_Reto` = $idreto");
		if ($query->num_rows() > 0){
			return $query;
		}else{
			return 0;
		}
	}


	public function obtener_evaluadores($iduser, $idreto){
		$query = $this->db->query("SELECT COUNT(DISTINCT(`ID_Evaluador`)) N_Eval FROM `Notas` WHERE `ID_Usuario` = $iduser AND `ID_Reto` = $idreto AND ID_Medicion = 1");
		if ($query->num_rows() > 0){
			return $query;
		}else{
			return 0;
		}
	}


	public function obtener_num_notas($iduser, $idreto){
		$query = $this->db->query("SELECT COUNT(*) N_Notas FROM `Notas` WHERE `ID_Usuario` = $iduser AND `ID_Reto` = $idreto");
		if ($query->num_rows() > 0){
			return $query;
		}else{
			return 0;
		}
	}



	public function agregar_notas_profesor($idreto, $iduser, $idcompetencia, $nota, $evaluador){

		switch ($idcompetencia) {
			case 1:
				$nota = $nota * 0.020;
				break;
			case 2:
				$nota = $nota * 0.010;
				break;
			case 3:
				$nota = $nota * 0.005;
				break;
			case 4:
				$nota = $nota * 0.010;
				break;
			case 5:
				$nota = $nota * 0.005;
				break;
			case 6:
				$nota = $nota * 0.005;
				break;
			case 7:
				$nota = $nota * 0.003;
				break;
			case 8:
				$nota = $nota * 0.002;
				break;
			case 9:
				$nota = $nota * 0.040;
				break;
		}

		$datosBD = array(
			'ID_Reto' => $idreto,
			'ID_Medicion' => 3,
			'ID_Usuario' => $iduser,
			'ID_Competencia' => $idcompetencia,
			'Nota' => $nota,
			'ID_Evaluador' => $evaluador
		);
		$this->db->insert('Notas', $datosBD);
	}



		public function agregar_notas_alumno($idreto, $iduser, $idcompetencia, $nota, $evaluador){

		switch ($idcompetencia) {
			case 1:
				$nota = $nota * 0.015;
				break;
			case 2:
				$nota = $nota * 0.015;
				break;
			case 3:
				$nota = $nota * 0.010;
				break;
			case 4:
				$nota = $nota * 0.020;
				break;
			case 9:
				$nota = $nota * 0.040;
				break;
		}


		$datosBD = array(
			'ID_Reto' => $idreto,
			'ID_Medicion' => 1,
			'ID_Usuario' => $iduser,
			'ID_Competencia' => $idcompetencia,
			'Nota' => $nota,
			'ID_Evaluador' => $evaluador
		);
		$this->db->insert('Notas', $datosBD);
	}

	public function actualizar_nota($ID_Nota, $nota , $idcompetencia ){

		switch ($idcompetencia) {
			case 1:
				$nota = $nota * 0.015;
				break;
			case 2:
				$nota = $nota * 0.015;
				break;
			case 3:
				$nota = $nota * 0.010;
				break;
			case 4:
				$nota = $nota * 0.020;
				break;
			case 9:
				$nota = $nota * 0.040;
				break;
		}



		$datosBD = array(	
			'Nota' => $nota,
		);
		$this->db->where('ID_Nota',$ID_Nota);
		$this->db->update('Notas', $datosBD);
	}	

	public function actualizar_nota_profesor($ID_Nota, $nota, $id_eva, $idcompetencia){

		switch ($idcompetencia) {
			case 1:
				$nota = $nota * 0.020;
				break;
			case 2:
				$nota = $nota * 0.010;
				break;
			case 3:
				$nota = $nota * 0.005;
				break;
			case 4:
				$nota = $nota * 0.010;
				break;
			case 5:
				$nota = $nota * 0.005;
				break;
			case 6:
				$nota = $nota * 0.005;
				break;
			case 7:
				$nota = $nota * 0.003;
				break;
			case 8:
				$nota = $nota * 0.002;
				break;
			case 9:
				$nota = $nota * 0.040;
				break;
		}



		$datosBD = array(	
			'Nota' => $nota,
			'ID_Evaluador' => $id_eva
		);
		$this->db->where('ID_Nota',$ID_Nota);
		$this->db->update('Notas', $datosBD);
	}
}
?>