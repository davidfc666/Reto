<div>
	


	<!--------------------SECCIÓN FORMULARIO-------------------->
	
		<div class="divfiltro">
		<h1>Editar Modulo</h1>
		
		<?php
    		/*--------------------ARRAY DEL FORMULARIO-------------------*/

			$formularioModulo = array(
				'name' => 'formularioModulo'
			);

			/*--------------------FIN ARRAY DEL FORMULARIO-------------------*/


			/*---------------------------------------------------*/


			/*--------------------ARRAY DEL CÓDIGO DEL MÓDULO-------------------*/

			$COD_Modulo = array(
				'name' => 'COD_Modulo',
				'placeholder' => 'Código del módulo',
				'value' => $modulo->result()[0]->COD_Modulo,
				'maxlength' => 10,
				'size' => 20
			);

			/*--------------------FIN ARRAY DEL CÓDIGO DEL MÓDULO-------------------*/


			/*---------------------------------------------------*/


			/*--------------------ARRAY DE LA DESCRIPCIÓN DEL MÓDULO-------------------*/

			$DESC_Modulo = array(
				'name' => 'DESC_Modulo',
				'placeholder' => 'Descripción del módulo',
				'value' => $modulo->result()[0]->DESC_Modulo,
				'maxlength' => 100,
				'size' => 20
			);

			/*--------------------FIN ARRAY DE LA DESCRIPCIÓN DEL MÓDULO-------------------*/
		?>

		<?php echo form_open('Modulo/guardar_cambios_modulo_admin/'.$modulo->result()[0]->ID_Modulo,$formularioModulo);?>


		<?php echo "<div class='divselect'>" ?>	
		<?php echo form_label('Código del módulo: ','COD_Modulo'); ?>
		<?php echo form_input($COD_Modulo); ?>
		<?php echo("</div>"); ?>

		<?php echo "<div class='divselect'>" ?>	
		<?php echo form_label('Descripción del módulo: ','DESC_Modulo'); ?>
		<?php echo form_input($DESC_Modulo); ?>
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
    		
    		//VUELVE A LA PÁGINA PRINCIPAL DE MÓDULO.
    		window.location.href = "../../Modulo/modulo_admin";
	    });

		/*----------FIN AL CLICAR EN EL BOTÓN VOLVER----------*/


	});

	/*----------FIN AL CARGAR EL DOCUMENTO----------*/

</script>


<!----------FIN SCRIPT---------->	