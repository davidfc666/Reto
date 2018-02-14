<div>
	


	<!--------------------SECCIÓN FORMULARIO-------------------->
	
		<div class='divfiltro'>
		<h1>EDITAR TIPO DE USUARIO</h1>
		
		<?php
    		/*--------------------ARRAY DEL FORMULARIO-------------------*/

			$formularioTUsuario = array(
				'name' => 'formularioTUsuario'
			);

			/*--------------------FIN ARRAY DEL FORMULARIO-------------------*/


			/*---------------------------------------------------*/

			/*--------------------ARRAY DE LA DESCRIPCIÓN DEL TIPO DE USUARIO-------------------*/

			$DESC_TUsuario = array(
				'name' => 'DESC_TUsuario',
				'placeholder' => 'Descripción del tipo de usuario',
				'value' => $tipo->result()[0]->DESC_TUsuario,
				'maxlength' => 50,
				'size' => 20
			);

			/*--------------------FIN ARRAY DE LA DESCRIPCIÓN DEL TIPO DE USUARIO-------------------*/
		?>

		<?php echo form_open('TUsuario/guardar_cambios_tusuario/'.$tipo->result()[0]->ID_TUsuario,$formularioTUsuario);?>
		
		<div class='divselect'>
		<?php echo form_label('Descripción del tipo de usuario: ','DESC_TUsuario'); ?>
		<?php echo form_input($DESC_TUsuario); ?>
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



<!-------------------------------------------------------------------->


<!----------SCRIPT---------->


<script>
	

	/*----------AL CARGAR EL DOCUMENTO----------*/

	$(document).ready(function(){


		/*----------AL CLICAR EN EL BOTÓN VOLVER----------*/


		//CUANDO SE CLICA EN EL BOTÓN VOLVER.
		$("#botonVolver").click(function(){
    		
    		//VUELVE A LA PÁGINA PRINCIPAL DE TIPO DE USUARIO.
    		window.location.href = "../../TUsuario";
	    });

		/*----------FIN AL CLICAR EN EL BOTÓN VOLVER----------*/


	});

	/*----------FIN AL CARGAR EL DOCUMENTO----------*/

</script>


<!----------FIN SCRIPT---------->	