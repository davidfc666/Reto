
	<!--------------------CURSO-------------------->
	<div class='divfiltro'>
	<h1>Añadir Ciclo	</h1>	
	<?php

		//SI HAY CURSOS
		if ($cursos){

			//CREA UN SELECT DE CURSOS PONIENDO "SELECCIONA CURSO" COMO VALOR PRINCIPAL


			echo "<div class='divselect'> Curso: 
			<select id='select_curso'>
				  <option>Selecciona curso</option>";

			//RELLENA EL SELECT CON CURSOS
			foreach ($cursos->result() as $curso) {
				echo "<option value='$curso->ID_Curso'>$curso->COD_Curso</option>";
			}

			echo "</select> </div>";			
		}

	?>	

	<!--------------------FIN CURSO-------------------->
	
	


	<!-------------------------------------------------->
	

	<!--------------------SECCIÓN FORMULARIO-------------------->
	
		
		<?php
    		/*--------------------ARRAY DEL FORMULARIO-------------------*/

			$formularioCiclo = array(
				'name' => 'formularioCiclo'
			);

			/*--------------------FIN ARRAY DEL FORMULARIO-------------------*/


			/*---------------------------------------------------*/


			/*--------------------ARRAY DEL CÓDIGO DEL CICLO-------------------*/

			$COD_Ciclo = array(
				'name' => 'COD_Ciclo',
				'placeholder' => 'Código del ciclo',
				'maxlength' => 10,
				'size' => 20
			);

			/*--------------------FIN ARRAY DEL CÓDIGO DEL CICLO-------------------*/


			/*---------------------------------------------------*/


			/*--------------------ARRAY DE LA DESCRIPCIÓN DEL CICLO-------------------*/

			$DESC_Ciclo = array(
				'name' => 'DESC_Ciclo',
				'placeholder' => 'Descripción del ciclo',
				'maxlength' => 50,
				'size' => 20
			);

			/*--------------------FIN ARRAY DE LA DESCRIPCIÓN DEL CICLO-------------------*/


			/*---------------------------------------------------*/



			/*--------------------TRAMPA PARA INSERTAR A LA BASE DE DATOS EL CURSO Y CENTRO SELECCIONADO--------------------*/


			/*--------------------ARRAY DEL CURSO-------------------*/

			$ID_Curso_Formulario = array(
				'name' => 'ID_Curso_Formulario',
				'placeholder' => 'Curso',
				'maxlength' => 20,
				'class' => 'ID_Curso_Formulario',
				'size' => 20,
				'hidden' => true
			);

			/*--------------------FIN ARRAY DEL CURSO-------------------*/


			/*---------------------------------------------------*/


			/*--------------------ARRAY DEL CENTRO-------------------*/

			$ID_Centro_Formulario = array(
				'name' => 'ID_Centro_Formulario',
				'placeholder' => 'Centro',
				'maxlength' => 20,
				'class' => 'ID_Centro_Formulario',
				'size' => 20,
				'hidden' => true
			);

			/*--------------------FIN ARRAY DEL CENTRO-------------------*/


			/*--------------------FIN TRAMPA PARA INSERTAR A LA BASE DE DATOS EL CURSO Y CENTRO SELECCIONADO--------------------*/
		?>
		
		<?php echo form_open('Ciclo/nuevo_ciclo_admin',$formularioCiclo);?>
		
		<?php echo "<div class='divselect'>" ?>
		<?php echo form_label('Código del ciclo: ','COD_Ciclo'); ?>
		<?php echo form_input($COD_Ciclo); ?>
		<?php echo("</div>"); ?>
		
		<?php echo "<div class='divselect'>" ?>
		<?php echo form_label('Descripción del ciclo: ','DESC_Ciclo'); ?>
		<?php echo form_input($DESC_Ciclo); ?>
		<?php echo("</div>"); ?>
		
		</div>

		<!--------------------TRAMPA PARA INSERTAR A LA BASE DE DATOS EL CURSO Y CENTRO SELECCIONADO-------------------->

		<?php echo form_input($ID_Curso_Formulario); ?>
		<?php echo form_input($ID_Centro_Formulario); ?>

		<!--------------------FIN TRAMPA PARA INSERTAR A LA BASE DE DATOS EL CURSO Y CENTRO SELECCIONADO-------------------->
		

		<div class="divbotones">
		<?php echo form_submit('Crear','Crear'); ?>
		<?php echo form_close();?>
		<button id="botonVolver" class="boton">Volver</button>
		</div>


	<!--------------------FIN SECCIÓN FORMULARIO-------------------->
	


<!----------SCRIPT---------->


<script>
	

	/*----------AL CARGAR EL DOCUMENTO----------*/

	$(document).ready(function(){

		//VARIABLES TRAMPA PARA PODER USARLA AL HACER CLICK EN "MOSTRAR".
		var trampaCurso = false;


		/*----------AL CAMBIAR EL SELECT CURSO----------*/

		//CUANDO SE CAMBIA EL SELECT CURSO.
		$("#select_curso").change(function(){

			//SE PONE LA TRAMPA A "TRUE" PORQUE SE LA MODIFICADO SELECT CURSO.
			trampaCurso = true;
			
	    	//RELLENA EL INPUT CURSO DEL FORMULARIO CON EL VALOR DEL CURSO QUE SE HAYA SELECCIONADO. 
	    	$('.ID_Curso_Formulario').val($("#select_curso").val());


	    	//RELLENA EL INPUT CENTRO DEL FORMULARIO CON EL VALOR DEL CENTRO QUE TIENE EL ADMIN. 
	    	$('.ID_Centro_Formulario').val($("#select_centro").val());

		});

		/*----------FIN AL CAMBIAR EL SELECT CURSO----------*/


		/*--------------------------------------------------*/


		/*----------AL CLICAR EN EL BOTÓN MOSTRAR----------*/


		//CUANDO SE CLICA EN EL BOTÓN MOSTRAR.
		$("#botonMostrar").click(function(){
    		
    		//SI NO SE HA SELECCIONADO CURSO.
    		if(trampaCurso == false){

    			//MUESTRA MENSAJE DE ERROR.
    			alert("¡Selecciona un curso!");
    		}


    		//SI SE HAN SELECCIONADO TODOS LOS PARÁMETROS.
    		else{

    			//MUESTRA EL FORMULARIO.
	        	$('#seccionFormulario').css("display","block");

			}
	    });

		/*----------FIN AL CLICAR EN EL BOTÓN MOSTRAR----------*/


		/*--------------------------------------------------*/


		/*----------AL CLICAR EN EL BOTÓN VOLVER----------*/


		//CUANDO SE CLICA EN EL BOTÓN VOLVER.
		$("#botonVolver").click(function(){
    		
    		//VUELVE A LA PÁGINA PRINCIPAL DE CICLO.
    		window.location.href = "../Ciclo/ciclo_admin";
	    });

		/*----------FIN AL CLICAR EN EL BOTÓN VOLVER----------*/


	});

	/*----------FIN AL CARGAR EL DOCUMENTO----------*/

</script>


<!----------FIN SCRIPT---------->	