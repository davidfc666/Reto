<div>
	
	<div class = "divfiltro">

	<h1>Añadir Reto</h1>

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

		<?php echo form_open('Reto/nuevo_reto_admin',$formularioReto);?>
		

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

		//PONE EL CENTRO DEL ADMIN EN LA TRAMPA.
		$(".ID_Centro_Formulario").val($("#select_centro").val());

    	//MUESTRA EL FORMULARIO.
	    $('#seccionFormulario').css("display","block");


		/*--------------------------------------------------*/


		/*----------AL CLICAR EN EL BOTÓN VOLVER----------*/


		//CUANDO SE CLICA EN EL BOTÓN VOLVER.
		$("#botonVolver").click(function(){
    		
    		//VUELVE A LA PÁGINA PRINCIPAL DE RETO.
    		window.location.href = "../Reto/reto_admin";
	    });

		/*----------FIN AL CLICAR EN EL BOTÓN VOLVER----------*/


	});

	/*----------FIN AL CARGAR EL DOCUMENTO----------*/

</script>


<!----------FIN SCRIPT---------->	