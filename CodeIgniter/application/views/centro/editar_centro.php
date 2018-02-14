<div>
	


	<!--------------------SECCIÓN FORMULARIO-------------------->
	
		<div class='divfiltro'>
		<h1>EDITAR CENTRO</h1>			
		<?php
    		/*--------------------ARRAY DEL FORMULARIO-------------------*/

			$formularioCentro = array(
				'name' => 'formularioCentro'
			);

			/*--------------------FIN ARRAY DEL FORMULARIO-------------------*/


			/*---------------------------------------------------*/

			/*--------------------ARRAY DEL CÓDIGO DEL CENTRO-------------------*/

			$COD_Centro = array(
				'name' => 'COD_Centro',
				'id' => 'COD_Centro',
				'placeholder' => 'Código del centro',
				'value' => $centro->result()[0]->COD_Centro,
				'maxlength' => 10,
				'size' => 20
			);

			/*--------------------FIN ARRAY DEL CÓDIGO DEL CENTRO-------------------*/


			/*---------------------------------------------------*/

			/*--------------------ARRAY DE LA DESCRIPCIÓN DEL CENTRO-------------------*/

			$DESC_Centro = array(
				'name' => 'DESC_Centro',
				'id' => 'DESC_Centro',
				'placeholder' => 'Descripción del centro',
				'value' => $centro->result()[0]->DESC_Centro,
				'maxlength' => 100,
				'size' => 20
			);

			/*--------------------FIN ARRAY DE LA DESCRIPCIÓN DEL CENTRO-------------------*/
		?>

		<?php echo form_open('Centro/guardar_cambios_centro/'.$centro->result()[0]->ID_Centro,$formularioCentro);?>
		
		<div class='divselect'>
		<?php echo form_label('Código del centro: ','COD_Centro'); ?>
		<?php echo form_input($COD_Centro); ?>
		</div>

		<div class='divselect'>
		<?php echo form_label('Descripción del centro: ','DESC_Centro'); ?>
		<?php echo form_input($DESC_Centro); ?>
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
    		
    		//VUELVE A LA PÁGINA PRINCIPAL DE CENTRO.
    		location.href = "../../";
	    });

		/*----------FIN AL CLICAR EN EL BOTÓN VOLVER----------*/


		/*------------------------------*/


		/*----------PATTERNS----------*/

		$("#COD_Centro").keydown(letras);

		$("#DESC_Centro").keydown(numeros);


		//LETRAS
		function letras(e){

			tecla = e.key;
			patron = /[A-Za-z]/;

			if(patron.test(tecla)){

				alert("¡SÓLO NÚMEROS (EJEMPLO: 000000)!");

				e.preventDefault();
			}

		}

		//NÚMEROS
		function numeros(e){

			tecla = e.key;
			patron = /[0-9]/;

			if(patron.test(tecla)){

				alert("¡SÓLO LETRAS (EJEMPLO: CIFP Centro LHII)!");

				e.preventDefault();
			}
		}

		/*----------FIN PATTERNS----------*/


	});

	/*----------FIN AL CARGAR EL DOCUMENTO----------*/

</script>


<!----------FIN SCRIPT---------->	