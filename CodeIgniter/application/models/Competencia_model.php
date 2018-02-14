<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Competencia_model extends CI_Model{

	function __construct(){
		parent::__construct();
		$this->load->database();
	}



function obtener_competencias(){
   	 $sql = "SELECT DISTINCT(GrupoCompetencia.DESC_Grupo_Competencia),Competencia.DESC_Competencia, Competencia.Mal, Competencia.Regular, Competencia.Bien, Competencia.Excelente FROM GrupoCompetencia, Competencia, Medicion_GrupoCompetencia_Competencia WHERE Medicion_GrupoCompetencia_Competencia.ID_Competencia = Competencia.ID_Competencia AND Medicion_GrupoCompetencia_Competencia.ID_GrupoCompetencia = GrupoCompetencia.ID_Grupo_Competencia";
   	 $consulta = $this->db->query($sql);
   	 if($consulta->num_rows() > 0){
   		 return $consulta;
   	 }else{
   		 return false;
   	 }
    }


function obtener_competencias_profesor(){
   	 $sql = "SELECT * FROM Competencia, Medicion_GrupoCompetencia_Competencia WHERE Competencia.ID_Competencia = Medicion_GrupoCompetencia_Competencia.ID_Competencia AND Medicion_GrupoCompetencia_Competencia.ID_Medicion = 3";
   	 $consulta = $this->db->query($sql);
   	 if($consulta->num_rows() > 0){
   		 return $consulta;
   	 }else{
   		 return false;
   	 }
    }


    function obtener_competencias_alumno(){
   	 $sql = "SELECT * FROM Competencia, Medicion_GrupoCompetencia_Competencia WHERE Competencia.ID_Competencia = Medicion_GrupoCompetencia_Competencia.ID_Competencia AND Medicion_GrupoCompetencia_Competencia.ID_Medicion = 1";
   	 $consulta = $this->db->query($sql);
   	 if($consulta->num_rows() > 0){
   		 return $consulta;
   	 }else{
   		 return false;
   	 }
    }




	
}


?>