<div>
	


	<!--------------------SECCIÓN FORMULARIO-------------------->
	
		<div class='divfiltro'>
		<h1>EDITAR CURSO</h1>	
		
		<?php
    		/*--------------------ARRAY DEL FORMULARIO-------------------*/

			$formularioCurso = array(
				'name' => 'formularioCurso'
			);

			/*--------------------FIN ARRAY DEL FORMULARIO-------------------*/


			/*---------------------------------------------------*/

			/*--------------------ARRAY DE EL CÓDIGO DEL CURSO-------------------*/

			$COD_Curso = array(
				'name' => 'COD_Curso',
				'id' => 'COD_Curso',
				'placeholder' => 'Código del curso',
				'value' => $curso->result()[0]->COD_Curso,
				'maxlength' => 9,
				'size' => 20
			);

			/*--------------------FIN ARRAY DE EL CÓDIGO DEL CURSO-------------------*/
		?>

		<?php echo form_open('Curso/guardar_cambios_curso/'.$curso->result()[0]->ID_Curso,$formularioCurso);?>

		<?php echo form_label('Código del curso: ','COD_Curso'); ?>
		<?php echo form_input($COD_Curso); ?>
		</div>
		
		<?php echo "<div class='divbotones'>" ?>
		<?php echo form_submit('Editar','Editar'); ?>
		<button id="botonVolver" class="boton">Volver</button>
		<?php echo "</div>" ?>
		<?php echo form_close();?>
	

	<!--------------------FIN SECCIÓN FORMULARIO-------------------->
	


</div>



<!-------------------------------------------------------------------->


<!----------SCRIPT---------->


<script>
	

	/*----------AL CARGAR EL DOCUMENTO----------*/

	$(document).ready(function(){


		/*----------AL CLICAR EN EL BOTÓN VOLVER----------*/


		//CUANDO SE CLICA EN EL BOTÓN VOLVER.
		$("#botonVolver").click(function(){
    		
    		//VUELVE A LA PÁGINA PRINCIPAL DE CURSO.
    		window.location.href = "../../Curso";
	    });

		/*----------FIN AL CLICAR EN EL BOTÓN VOLVER----------*/


		/*------------------------------*/


		/*----------PATTERNS----------*/

		$("#COD_Curso").keydown(letras);


		//LETRAS
		function letras(e){

			tecla = e.key;
			patron = /[A-Za-z]/;

			if(patron.test(tecla)){

				alert("¡SÓLO NÚMEROS (EJEMPLO: 000000)!");

				e.preventDefault();
			}

		}

		/*----------FIN PATTERNS----------*/


	});

	/*----------FIN AL CARGAR EL DOCUMENTO----------*/

</script>


<!----------FIN SCRIPT---------->	