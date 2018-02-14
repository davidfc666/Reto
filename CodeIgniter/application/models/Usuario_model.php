<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends CI_Model{

	/*--------------------CONSTRUCTOR------------------*/

	function __construct(){
		parent::__construct();
		$this->load->database();
	}

	/*--------------------FIN CONSTRUCTOR------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN OBTENER USUARIOS------------------*/

	//Función que obteniendo el parámetro "ID_Centro" de la función "obtener_usuarios" de "Usuario.php" obtiene los usuarios.
	public function obtener_usuarios($idCentro, $idTipoUsuario){

		$sql="SELECT * FROM Usuario u, Centro ce, TUsuario tu WHERE u.ID_TUsuario = tu.ID_TUsuario AND u.ID_Centro = ce.ID_Centro AND u.ID_Centro = $idCentro AND u.ID_TUsuario = $idTipoUsuario";

		$consulta = $this->db->query($sql);

		if ($consulta->num_rows() > 0){
			return $consulta;
		}
		
		else{
			return false;
		}
	}


		public function obtener_nombre($id){
		$query = "SELECT User FROM Usuario WHERE ID_Usuario = '".$id."'";
		$query = $this->db->query($query);
		if ($query->num_rows() > 0){
			return $query;
		}else{
			return false;
		}
	}

	/*--------------------FIN FUNCIÓN OBTENER USUARIOS------------------*/


			public function login_usuario($filtro){
		$query = "SELECT ID_Usuario, DESC_TUsuario FROM Usuario, TUsuario WHERE User = '". $filtro['User']."' AND Password = '". $filtro['Password']."' AND Usuario.ID_TUsuario = TUsuario.ID_TUsuario;";
		$query = $this->db->query($query);
		if($query->num_rows() > 0){
			return $query;
		}else{
			return false;
		}
	}


		public function Usuario_profesor($id){
		if($id){
			$query = "SELECT * FROM Usuario WHERE ID_Usuario = $id AND ID_TUsuario = (SELECT ID_TUsuario FROM TUsuario WHERE DESC_TUsuario = 'Profesor')";
			$query = $this->db->query($query);
			if($query->num_rows() > 0){
				return $query;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}


		public function Usuario_alumno($id){
		if($id){
			$query = "SELECT * FROM Usuario WHERE ID_Usuario = $id AND ID_TUsuario = (SELECT ID_TUsuario FROM TUsuario WHERE DESC_TUsuario = 'Alumno')";
			$query = $this->db->query($query);
			if($query->num_rows() > 0){
				return $query;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}


	/*--------------------FUNCIÓN NUEVO USUARIO------------------*/

	//Función que obteniendo el parámetro "datosNuevo" de la función "nuevo_usuario" de "Usuario.php" inserta un nuevo usuario a la base de datos.
	public function nuevo_usuario($datosNuevo){

		$sql="INSERT INTO Usuario VALUES (NULL,'".$datosNuevo['ID_Centro']."', '".$datosNuevo['ID_TUsuario']."', '".$datosNuevo['User']."', '".$datosNuevo['Password']."', '".$datosNuevo['Nombre']."', '".$datosNuevo['Apellidos']."', '".$datosNuevo['Email']."', '".$datosNuevo['Dni']."')";

		$consulta = $this->db->query($sql);

					// Configuracion para mandar el Email
			$configGmail = array(
			 'protocol' => 'smtp',
			 'smtp_host' => 'ssl://smtp.gmail.com',
			 'smtp_port' => 465,
			 'smtp_user' => 'Grupo2TXFinal@gmail.com',
			 'smtp_pass' => '123456789Aa',
			 'mailtype' => 'html',
			 'charset' => 'utf-8',
			 'newline' => "\r\n"
			);  

			//Usamos la libreria de email

			 $this->email->initialize($configGmail);
			 
			 $this->email->from('Grupo2TXFinal');
			 $this->email->to($this->input->post('Email'));
			 $this->email->subject('Gestion de Retos');
			 $this->email->message('<h1> Bienvenido  '.$this->input->post("User").'</h1> <br>
			 	<h3> Su contraseña es su DNI   -> '.$this->input->post("Dni").' </h3> <br>
			 	<a href="10.9.53.112/'.$datosNuevo['ID_TUsuario'].'">Manual</a> <br>
			 	Para iniciar sesión clique aquí <a href="'.base_url().'index.php">Login</a>');
			 $this->email->send();
	}


	/*--------------------FIN FUNCIÓN NUEVO USUARIO------------------*/	


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN BORRAR USUARIO------------------*/

	//Función que obteniendo el parámetro "idusuarioBorrar" de la función "borrar_usuario" de "Usuario.php" borra el usuario de la base de datos.
	public function borrar_usuario($idusuarioBorrar){

		$this->db->where('ID_Usuario',$idusuarioBorrar);
		$this->db->delete('Usuario');
	}

	/*--------------------FIN FUNCIÓN BORRAR USUARIO------------------*/	


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN OBTENER USUARIO------------------*/

	//Función que obteniendo el parámetro "ID_Usuario" de la función "guardar_cambios_usuario" de "Usuario.php" obtiene los datos del usuario seleccionado.
	public function obtener_usuario($datosEditar){

		$sql="SELECT * FROM Usuario u, Centro ce, TUsuario tu WHERE u.ID_TUsuario = tu.ID_TUsuario AND u.ID_Centro = ce.ID_Centro AND u.ID_Usuario = $datosEditar";

		$consulta = $this->db->query($sql);

		if ($consulta->num_rows() > 0){
			return $consulta;
		}
		
		else{
			return false;
		}
	}

	/*--------------------FIN FUNCIÓN OBTENER USUARIO------------------*/


	/*-------------------------------------------------------*/


	/*--------------------FUNCIÓN GUARDAR CAMBIOS USUARIO------------------*/

	//Función que obteniendo el parámetro de la función "guardar_cambios_usuario" de "Usuario.php" obtiene los datos del usuario seleccionado.
	public function guardar_cambios_usuario($idusuarioActualizar,$datosActualizado){

		$this->db->where('ID_Usuario',$idusuarioActualizar);
		$this->db->update('Usuario',$datosActualizado);
	}

	/*--------------------FIN FUNCIÓN GUARDAR CAMBIOS USUARIO------------------*/
}


?>