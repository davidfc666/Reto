<div>
	


	<!--------------------SECCIÓN FORMULARIO-------------------->
	
		<div class="divfiltro">
		<h1>Editar Reto</h1>
		
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
				'value' => $reto->result()[0]->COD_Reto,
				'maxlength' => 10,
				'size' => 20
			);

			/*--------------------FIN ARRAY DEL CÓDIGO DEL RETO-------------------*/


			/*---------------------------------------------------*/


			/*--------------------ARRAY DE LA DESCRIPCIÓN DEL RETO-------------------*/

			$DESC_Reto = array(
				'name' => 'DESC_Reto',
				'placeholder' => 'Descripción del reto',
				'value' => $reto->result()[0]->DESC_Reto,
				'maxlength' => 50,
				'size' => 20
			);

			/*--------------------FIN ARRAY DE LA DESCRIPCIÓN DEL RETO-------------------*/
		?>

		<?php echo form_open('Reto/guardar_cambios_reto/'.$reto->result()[0]->ID_Reto,$formularioReto);?>


		<?php echo "<div class='divselect'>" ?>	
		<?php echo form_label('Código del reto: ','COD_Reto'); ?>
		<?php echo form_input($COD_Reto); ?>
		<?php echo("</div>"); ?>

		<?php echo "<div class='divselect'>" ?>	
		<?php echo form_label('Descripción del reto: ','DESC_Reto'); ?>
		<?php echo form_input($DESC_Reto); ?>
		<?php echo("</div>"); ?>
		</div>
	
		<?php echo "<div class='divbotones'>" ?>
		<?php echo form_submit('Editar','Editar'); ?>
		<button id="botonVolver" class="boton">Volver</button>
		<?php echo("</div>"); ?>
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
    		
    		//VUELVE A LA PÁGINA PRINCIPAL DE RETO.
    		window.location.href = "../../Reto";
	    });

		/*----------FIN AL CLICAR EN EL BOTÓN VOLVER----------*/


	});

	/*----------FIN AL CARGAR EL DOCUMENTO----------*/

</script>


<!----------FIN SCRIPT---------->	