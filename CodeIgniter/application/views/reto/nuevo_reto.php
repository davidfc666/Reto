<div class="divfiltro">
	
	<h1>Añadir Reto</h1>

	<!--------------------CURSO-------------------->

	<?php

		//SI HAY CENTROS
		if ($centros){

			//CREA UN SELECT DE CENTROS PONIENDO "SELECCIONA CENTRO" COMO VALOR PRINCIPAL
			echo "<div class='divselect'> CENTRO: <select id='select_centro'>
				  <option>Selecciona centro</option>";

			//RELLENA EL SELECT CON CENTROS
			foreach ($centros->result() as $centro) {
				echo "<option value='$centro->ID_Centro'>$centro->DESC_Centro</option>";
			}

			echo "</select> </div>";			
		}

	?>	

	<!--------------------FIN CURSO-------------------->
	
	


	<!-------------------------------------------------->
	



	<!--------------------SECCIÓN FORMULARIO-------------------->
	
		
		<?php
    		/*--------------------ARRAY DEL FORMULARIO-------------------*/

			$formularioReto = array(
				'name' => 'formularioReto'
			);

			/*--------------------FIN ARRAY DEL FORMULARIO-------------------*/


			/*---------------------------------------------------*/


			/*--------------------ARRAY DEL CÓDIGO DEL RETO-------------------*/

			$COD_Reto = array(
				'name' => 'COD_Reto',
				'placeholder' => 'Código del reto',
				'maxlength' => 10,
				'size' => 20
			);

			/*--------------------FIN ARRAY DEL CÓDIGO DEL RETO-------------------*/


			/*---------------------------------------------------*/


			/*--------------------ARRAY DE LA DESCRIPCIÓN DEL RETO-------------------*/

			$DESC_Reto = array(
				'name' => 'DESC_Reto',
				'placeholder' => 'Descripción del reto',
				'maxlength' => 50,
				'size' => 20
			);

			/*--------------------FIN ARRAY DE LA DESCRIPCIÓN DEL RETO-------------------*/


			/*---------------------------------------------------*/



			/*--------------------TRAMPA PARA INSERTAR A LA BASE DE DATOS EL CENTRO SELECCIONADO--------------------*/


			/*--------------------ARRAY DEL CENTRO-------------------*/

			$ID_Centro_Formulario = array(
				'name' => 'ID_Centro_Formulario',
				'placeholder' => 'Curso',
				'maxlength' => 20,
				'class' => 'ID_Centro_Formulario',
				'size' => 20,
				'hidden' => true
			);

			/*--------------------FIN ARRAY DEL CENTRO-------------------*/


			/*--------------------FIN TRAMPA PARA INSERTAR A LA BASE DE DATOS EL CENTRO SELECCIONADO--------------------*/
		?>

		<?php echo form_open('Reto/nuevo_reto',$formularioReto);?>
		

		<?php echo "<div class='divselect'>" ?>	
		<?php echo form_label('Código del reto: ','COD_Reto'); ?>
		<?php echo form_input($COD_Reto); ?>
		<?php echo("</div>"); ?>
	
		<?php echo "<div class='divselect'>" ?>	
		<?php echo form_label('Descripción del reto: ','DESC_Reto'); ?>
		<?php echo form_input($DESC_Reto); ?>
		<?php echo("</div>"); ?>
	</div>


		<!--------------------TRAMPA PARA INSERTAR A LA BASE DE DATOS EL CENTRO SELECCIONADO-------------------->

		<?php echo form_input($ID_Centro_Formulario); ?>

		<!--------------------FIN TRAMPA PARA INSERTAR A LA BASE DE DATOS EL CENTRO SELECCIONADO-------------------->

		<div class="divbotones">
		<?php echo form_submit('Crear','Crear'); ?>
		<?php echo form_close();?>
		<button id="botonVolver" class="boton">Volver</button>
		</div>

	

	<!--------------------FIN SECCIÓN FORMULARIO-------------------->
	






<!-------------------------------------------------------------------->


<!----------SCRIPT---------->


<script>
	

	/*----------AL CARGAR EL DOCUMENTO----------*/

	$(document).ready(function(){

		//VARIABLES TRAMPA PARA PODER USARLA AL HACER CLICK EN "MOSTRAR".
		var trampaCentro = false;


		/*----------AL CAMBIAR EL SELECT CENTRO----------*/


		//CUANDO SE CAMBIA EL SELECT CENTRO.
		$("#select_centro").change(function(){

			//SE PONE LA TRAMPA A "TRUE" PORQUE SE LA MODIFICADO SELECT CENTRO.
			trampaCentro = true;

			$(".ID_Centro_Formulario").val($("#select_centro").val());

		});

		/*----------FIN AL CAMBIAR EL SELECT CENTRO----------*/


		/*--------------------------------------------------*/


		/*----------AL CLICAR EN EL BOTÓN MOSTRAR----------*/


		//CUANDO SE CLICA EN EL BOTÓN MOSTRAR.
		$("#botonMostrar").click(function(){


    		//SI NO SE HA SELECCIONADO CENTRO.
    		if(trampaCentro == false){

    			//MUESTRA MENSAJE DE ERROR.
    			alert("¡Selecciona un centro!");
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
    		
    		//VUELVE A LA PÁGINA PRINCIPAL DE RETO.
    		window.location.href = "../Reto";
	    });

		/*----------FIN AL CLICAR EN EL BOTÓN VOLVER----------*/


	});

	/*----------FIN AL CARGAR EL DOCUMENTO----------*/

</script>


<!----------FIN SCRIPT---------->	