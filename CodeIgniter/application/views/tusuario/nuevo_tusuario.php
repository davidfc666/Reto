<div>
	


	<!--------------------SECCIÓN FORMULARIO-------------------->
	
	<div class="divfiltro">
	<h1>Añadir Tipo de Usuario</h1>	
		
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
				'maxlength' => 50,
				'size' => 20
			);

			/*--------------------FIN ARRAY DE LA DESCRIPCIÓN DEL TIPO DE USUARIO-------------------*/
		?>

		<?php echo form_open('TUsuario/nuevo_tusuario',$formularioTUsuario);?>
		
		<div class='divselect'>
		<?php echo form_label('Descripción del tipo de usuario: ','DESC_TUsuario'); ?>
		<?php echo form_input($DESC_TUsuario); ?>
		</div>
		</div>

		<?php echo "<div class='divbotones'>" ?>
		<?php echo form_submit('Crear','Crear'); ?>
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
    		window.location.href = "../TUsuario";
	    });

		/*----------FIN AL CLICAR EN EL BOTÓN VOLVER----------*/


	});

	/*----------FIN AL CARGAR EL DOCUMENTO----------*/

</script>


<!----------FIN SCRIPT---------->	