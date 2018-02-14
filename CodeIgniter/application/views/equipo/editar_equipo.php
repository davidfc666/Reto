<div>
	


	<!--------------------SECCIÓN FORMULARIO-------------------->
	
		<div class='divfiltro'>
		<h1>EDITAR EQUIPO</h1>
		
		<?php
    		/*--------------------ARRAY DEL FORMULARIO-------------------*/

			$formularioEquipo = array(
				'name' => 'formularioEquipo'
			);

			/*--------------------FIN ARRAY DEL FORMULARIO-------------------*/


			/*---------------------------------------------------*/


			/*--------------------ARRAY DEL CÓDIGO DEL EQUIPO-------------------*/

			$COD_Equipo = array(
				'name' => 'COD_Equipo',
				'placeholder' => 'Código del equipo',
				'value' => $equipo->result()[0]->COD_Equipo,
				'maxlength' => 10,
				'size' => 20
			);

			/*--------------------FIN ARRAY DEL CÓDIGO DEL EQUIPO-------------------*/


			/*---------------------------------------------------*/


			/*--------------------ARRAY DE LA DESCRIPCIÓN DEL EQUIPO-------------------*/

			$DESC_Equipo = array(
				'name' => 'DESC_Equipo',
				'placeholder' => 'Descripción del equipo',
				'value' => $equipo->result()[0]->DESC_Equipo,
				'maxlength' => 50,
				'size' => 20
			);

			/*--------------------FIN ARRAY DE LA DESCRIPCIÓN DEL EQUIPO-------------------*/
		?>

		<?php echo form_open('Equipo/guardar_cambios_equipo/'.$equipo->result()[0]->ID_Equipo,$formularioEquipo);?>

		<div class='divselect'>
		<?php echo form_label('Código del equipo: ','COD_Equipo'); ?>
		<?php echo form_input($COD_Equipo); ?>
		</div>

		<div class='divselect'>
		<?php echo form_label('Descripción del equipo: ','DESC_Equipo'); ?>
		<?php echo form_input($DESC_Equipo); ?>
		</div>
		</div>
	
		<?php echo "<div class='divbotones'>" ?>
		<?php echo form_submit('Editar','Editar'); ?>
		<button id="botonVolver" class="boton">Volver</button>
		<?php echo "</div>" ?>
		<?php echo form_close();?>

	</div>

	<!--------------------FIN SECCIÓN FORMULARIO-------------------->



</div>




<!----------SCRIPT---------->


<script>

	/*----------AL CARGAR EL DOCUMENTO----------*/

	$(document).ready(function(){


		/*----------AL CLICAR EN EL BOTÓN VOLVER----------*/


		//CUANDO SE CLICA EN EL BOTÓN VOLVER.
		$("#botonVolver").click(function(){
    		
    		//VUELVE A LA PÁGINA PRINCIPAL DE EQUIPO.
    		window.location.href = "../../Equipo";
	    });

		/*----------FIN AL CLICAR EN EL BOTÓN VOLVER----------*/


	});

	/*----------FIN AL CARGAR EL DOCUMENTO----------*/

</script>


<!----------FIN SCRIPT---------->	