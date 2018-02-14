<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alumno extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->helper('url');	
		$this->load->model('Reto_model');
		$this->load->model('Alumno_model');
		$this->load->model('Curso_model');
		$this->load->model('Centro_model');
		$this->load->model('Usuario_model');
		$this->load->model('Competencia_model');
		$this->load->model('Nota_model');
		$this->load->library('session');
		$this->load->library('email');
		//$this->load->library('html2pdf');
		$this->load->library('Pdf');




	}

	//ok


	public function index(){
		$alumno_sesion = $this->session->userdata('id');



		$datos['cursos'] = $this->Curso_model->obtener_cursos();
		$datos['centro'] =$this->Centro_model->obtener_centro_alumno($alumno_sesion);

		$datos['usuario'] =$this->Alumno_model->obtener_nombre($alumno_sesion);
		//$datos['retos'] = $this->Reto_model->obtener_retos_usu($alumno_sesion);
		
			
		$this->load->view('header_alumno',$datos);		
		$this->load->view('alumno/panel_alumno',$datos);
		$this->load->view('footer');
	}


		public function evaluar_miembro(){
		$alumno_sesion = $this->session->userdata('id');
		$id_reto=$this->uri->segment(4);
		$id_evaluado=$this->uri->segment(3);

		$datos['centro'] = $this->Centro_model->obtener_centro_alumno($alumno_sesion);
		$datos['competencias'] = $this->Competencia_model->obtener_competencias();

		$datos['reto'] = $this->Reto_model->obtener_reto($id_reto);
		
		$id_equipo=$this->Alumno_model->obtener_equipo($alumno_sesion,$id_reto);
		$datos['usuario'] = $this->Alumno_model->obtener_nombre($alumno_sesion);
		$datos['miembros']=$this->Alumno_model->obtener_miembros($id_equipo->result()[0]->ID_Equipo);
		$datos['id_equipo'] = $id_equipo;
		


		$this->load->view('header_alumno',$datos);		
		$this->load->view('alumno/evaluar_miembro',$datos);
		$this->load->view('footer');

	}




    public function generar() {

            /////////////////////////////////////////////////////////////////////////////

            $alumno_sesion = $this->session->userdata('id');
        

            //Obtener nombre del Alumno
            $alumno =$this->Alumno_model->obtener_nombre($alumno_sesion);
            $alumno = $alumno->result()[0]->Nombre  ." ".$alumno->result()[0]->Apellidos;

            //Obtener el ID del Reto
            $id_reto = $this->session->userdata('idreto');

            //Obtener el nombre del Reto
            $reto =$this->Reto_model->obtener_reto($id_reto);
            $reto = $reto->result()[0]->COD_Reto;

            //Obtener notas
            $notas = $this->Nota_model->obtener_notas($alumno_sesion, $id_reto);

            //Contar numero de competencias evaluadas (si no llegan a 14, no seran suficientes para crear el boletin)
            $numnotas = $this->Nota_model->obtener_num_notas($alumno_sesion, $id_reto);
            $numnotas = $numnotas->result()[0]->N_Notas;

            //Saber cuantos alumnos han evaluado
            $numeval = $this->Nota_model->obtener_evaluadores($alumno_sesion, $id_reto);
            $numeval = $numeval->result()[0]->N_Eval; 

            //Dar formato al PDF
            $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('Israel Parra');
            $pdf->SetTitle($alumno.'_'.$reto.'_Boletin.pdf');
            $pdf->SetSubject('Tutorial TCPDF');
            $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
 

            // Este método tiene varias opciones, consulta la documentación para más información.
            $pdf->AddPage();
 
            //fijar efecto de sombra en el texto
            $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));
 
       

            //Varable que sera lo que se acabe imprimiendo en el PDF
			$html = '<!DOCTYPE html>
            <html lang="es">
            <head>
            <meta charset="utf-8">
            <title>Boletin en pdf</title>
            <style type="text/css">
                
                body {
                 color: #4F5155;
                }
         
                h2 {
                 background-color:transparent;
                 text-align: center;
                }

                .vaciogris{
                    color:#cccccc
                }

            </style>
            </head>
            <body>
            ';

    if ($numnotas >= 14){
        $alumnos = 0;
        $notafinal = 0;
        $compañeros = 0;
        $Actitud = 0;
        $Resolucion = 0;
        $Cilma = 0;
        $Seguridad = 0;
        $Vocabulario = 0;
        $Postura = 0;
        $Pronunciación = 0;
        $Elaboración = 0;
        $CompañerosProf = 0;
        $ActitudProf = 0;
        $ResolucionProf = 0;
        $CilmaProf = 0;
        $SeguridadProf = 0;
        $VocabularioProf = 0;
        $PosturaProf = 0;
        $PronunciaciónProf = 0;
        $ElaboraciónProf = 0;
        $CompañerosAlu = 0;
        $ActitudAlu = 0;
        $ResolucionAlu = 0;
        $CilmaAlu =  0 ; 
        $ElaboraciónAlu = 0 ;
        $MultiplicadorProf = 0.70;
        $MultiplicadorAlu = 0.30;

       

        foreach ($notas->result() as $nota) {
        

        //Sumar las notas evaluadas por el profesor
        if ($nota->ID_Medicion == 3) {      
        switch ($nota->ID_Competencia) {
            case 1:
                $CompañerosProf = $nota->Nota + $CompañerosProf ;
                break;
            case 2:
                $ActitudProf =$nota->Nota + $ActitudProf ;
                break;
            case 3:
                $ResolucionProf =  $nota->Nota + $ResolucionProf ;
                break;
            case 4:
                $CilmaProf =  $nota->Nota + $CilmaProf ; 
                break;
            case 5:
                $SeguridadProf =  $nota->Nota + $SeguridadProf ;
                break;
            case 6:
                $VocabularioProf =  $nota->Nota + $VocabularioProf ;
                break;
            case 7:
                $PosturaProf =$nota->Nota + $PosturaProf ;
                break;
            case 8:
                $PronunciaciónProf = $nota->Nota + $PronunciaciónProf ;
                break;
            case 9:
                $ElaboraciónProf = $nota->Nota + $ElaboraciónProf ;
                break;
        }
        }   

        //Sumar las notas evaluadas por los alumnos
        if ($nota->ID_Medicion == 1) {
        switch ($nota->ID_Competencia) {
            case 1:
                $CompañerosAlu = $nota->Nota + $CompañerosAlu ;
                break;
            case 2:
                $ActitudAlu=$nota->Nota + $ActitudAlu ;
                break;
            case 3:
                $ResolucionAlu =  $nota->Nota + $ResolucionAlu ;
                break;
            case 4:
                $CilmaAlu =  $nota->Nota + $CilmaAlu ; 
                break;
            case 9:
                $ElaboraciónAlu = $nota->Nota + $ElaboraciónAlu ;
                break;
        }
        }

       
    } 

    //Dividir la nota total de los alumno entre el numero de alumnos
    $CompañerosAlu = $CompañerosAlu / $numeval;

    //Juntar la nota de los profesores (70%) y la de los alumnos (30%)
    $Compañeros = ($CompañerosAlu * $MultiplicadorAlu + $CompañerosProf * $MultiplicadorProf);

    //Formatearlo para que solo tenga dos decimales
    $Compañeros = round($Compañeros, 2);

    $ActitudAlu = $ActitudAlu / $numeval;
    $Actitud = ($ActitudAlu * $MultiplicadorAlu + $ActitudProf * $MultiplicadorProf);
    $Actitud = round($Actitud , 2);

    $ResolucionAlu = $ResolucionAlu / $numeval;
    $Resolucion = ($ResolucionAlu * $MultiplicadorAlu + $ResolucionProf * $MultiplicadorProf);
    $Resolucion = round($Resolucion, 2);

    $CilmaAlu = $CilmaAlu / $numeval;
    $Cilma = ($CilmaAlu * $MultiplicadorAlu + $CilmaProf * $MultiplicadorProf);
    $Cilma = round($Cilma , 2);

    $Seguridad = round($SeguridadProf * $MultiplicadorProf  , 2);

    $Vocabulario = round($VocabularioProf  * $MultiplicadorProf, 2);

    $Postura = round($PosturaProf * $MultiplicadorProf, 2);

    $Pronunciación = round($PronunciaciónProf * $MultiplicadorProf , 2);

    $ElaboraciónAlu = $ElaboraciónAlu / $numeval;
    $Elaboración = ($ElaboraciónAlu * $MultiplicadorAlu + $ElaboraciónProf * $MultiplicadorProf);
    $Elaboración = round($Elaboración , 2);

    //Sumar todas las notas para obtener una nota final
    $notafinal = $Compañeros + $Actitud + $Cilma + $Seguridad + $Vocabulario + $Postura +      $Pronunciación + $Elaboración + $Resolucion;


        
 
	        $html .= '<h1> '.$alumno.' </h1>

<div id="cajagrande">
    <h1>RETO: '.$reto.' </h1>
    <br>
    <br>
    <br>
    
    <h2>Trabajo en equipo</h2>
    
    <h3>Trabajo con los compañeros <span class="vaciogris"> ------------------------------------------------------- </span>  '.$Compañeros.' / 1.85 </h3>
    <h3>Actitud  <span class="vaciogris"> ------------------------------------------------------------------------------------- </span> '.$Actitud.' / 1.15 </h3>
    <h3>Resolucion de problemas
 <span class="vaciogris"> ----------------------------------------------------------- </span>  '.$Resolucion.' / 0.65 </h3>

    <h3>Clima de trabajo  <span class="vaciogris"> ------------------------------------------------------------------------ </span>'.$Cilma.' / 1.30 </h3>

    <br>
    <br>
    <br>

    <h2>Presentación y comunicación</h2>
    
   <h3>Seguridad <span class="vaciogris"> --------------------------------------------------------------------------------- </span>  '.$Seguridad.' / 0.35 </h3>
    <h3>Vocabulario  <span class="vaciogris"> ------------------------------------------------------------------------------ </span> '.$Vocabulario.' / 0.35 </h3>
    <h3>Postura <span class="vaciogris"> ------------------------------------------------------------------------------------ </span>  '.$Postura.' / 0.21 </h3>
    <h3>Pronunciación y Modulación  <span class="vaciogris"> ------------------------------------------------------ </span> '.$Pronunciación.' / 0.14 </h3>

    <br>
    <br>
    <br>
    <h2>Trabajo individual</h2>
    
    <h3>Elaboración de tareas <span class="vaciogris"> ------------------------------------------------------------------- </span>  '.$Elaboración.' / 4 </h3>
    <br>
    <br>
    <br>
    <h3> TOTAL <span class="vaciogris"> ---------------------------------------------------------------------------------- </span>  '.$notafinal.' / 10 </h3>
   '; 

    
 $html .= '</div>
 </body>
</html>';

}

//Comprobar si han evaluado al menos un profesor y un alumno
if ($numnotas < 14) {
    $html = "<br> <h1> Aun no has sido evaluado </h1>";
}






        ////////////////////////////////////////////////////////////////////////////
      


 
// Imprimimos el texto con writeHTMLCell()
        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
 
// ---------------------------------------------------------
// Cerrar el documento PDF y preparamos la salida
// Este método tiene varias opciones, consulte la documentación para más información.
        $nombre_archivo = utf8_decode($alumno.'_'.$reto.'_Boletin.pdf');
        $pdf->Output($nombre_archivo, 'I');
    }






		public function evaluar(){
		$alumno_sesion = $this->session->userdata('id');
		$id_reto=$this->uri->segment(3);
		$datos['centro'] =$this->Centro_model->obtener_centro_alumno($alumno_sesion);
		/**/
			unset( $_SESSION["idreto"] );  
			$_SESSION["idreto"] = ""; 
			$this->session->set_userdata('idreto', $id_reto);
			/**/


		$datos['reto'] = $this->Reto_model->obtener_reto($id_reto);
		$id_equipo=$this->Alumno_model->obtener_equipo($alumno_sesion,$id_reto);
		$datos['usuario'] = $this->Alumno_model->obtener_nombre($alumno_sesion);
		$datos['miembros']=$this->Alumno_model->obtener_miembros($id_equipo->result()[0]->ID_Equipo);
		$datos['id_equipo'] = $id_equipo;
		


		$this->load->view('header_alumno',$datos);		
		$this->load->view('alumno/evaluar_alumno',$datos);
		$this->load->view('footer');

	}

		//PESTAÑA DE EVALUACION SOBRE EL ALUMNO ESTABLECIDO
	public function evaluserindi(){
		$id = $this->session->userdata('id');
		$lg = $this->Usuario_model->Usuario_alumno($id);
		$datos['usuario'] = $this->Alumno_model->obtener_nombre($id);
		$datos['centro'] =$this->Centro_model->obtener_centro_alumno($id);
		if($lg){
			$datos['competencias'] = $this->Competencia_model->obtener_competencias_alumno();
			$datos['evaluado'] = $this->Usuario_model->obtener_usuario($this->uri->segment(3));
			$datos['evaluador'] = $this->Usuario_model->obtener_nombre($id);
			$this->load->view('header_alumno',$datos);		
			$this->load->view('alumno/evaluar_individual',$datos);
			$this->load->view('footer');
		}else{
			redirect(base_url());
		}
	}

		public function agregar_evaluacion(){
		$id = $this->session->userdata('id');
		$lg = $this->Usuario_model->Usuario_alumno($id);
		if($lg){
			$idreto = $this->session->userdata('idreto');
			$ID_Competencia = $this->input->post('ID_Competencia');
			//$ID_Grupo = $this->input->post('ID_Grupo');
			$Nota = $this->input->post('Nota');
			$ID_User = $this->input->post('ID_User');

			
			$ID_Nota = $this->Nota_model->obtener_nota_alumno_alumnos($idreto, $ID_User, $ID_Competencia,$id);

			

			

			if($ID_Nota > 0){
			//	ACTUALIZA LAS NOTAS
				$this->Nota_model->actualizar_nota($ID_Nota, $Nota,$ID_Competencia);
			}else{
			//	CREA E INSERTA LAS NOTAS DEL ALUMNO
				$this->Nota_model->agregar_notas_alumno($idreto, $ID_User, $ID_Competencia, $Nota, $id);
			}


		}else{
			redirect(base_url());
		}
	}












}