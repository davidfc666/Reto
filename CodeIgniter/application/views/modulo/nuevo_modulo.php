<div>
	

	<!--------------------CURSO-------------------->

	<?php

		//SI HAY CURSOS
		if ($cursos){

			//CREA UN SELECT DE CURSOS PONIENDO "SELECCIONA CURSO" COMO VALOR PRINCIPAL
			echo ("<div class='divfiltro'>");
			echo("<h1>Añadir Modulo</h1>");

			echo "<div class='divselect'> Centro: ";
			echo "<select id='select_curso'>
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




	<!--------------------CENTRO-------------------->

	<div class='divselect'> Centro:
	<select id="select_centro">

		<option value="0">Selecciona Centro</option>

	</select> </div>


	<!--------------------FIN CENTRO-------------------->
	


	
	<!-------------------------------------------------->
	


	
	<!--------------------CICLO-------------------->


	<div class='divselect'> Ciclo:
	<select id="select_ciclo">

		<option value="0">Selecciona Ciclo</option>

	</select> </div>

	<!--------------------FIN CICLO-------------------->
	



	<!--------------------SECCIÓN FORMULARIO-------------------->
	
		
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
				'maxlength' => 10,
				'size' => 20
			);

			/*--------------------FIN ARRAY DEL CÓDIGO DEL MÓDULO-------------------*/


			/*---------------------------------------------------*/


			/*--------------------ARRAY DE LA DESCRIPCIÓN DEL MÓDULO-------------------*/

			$DESC_Modulo = array(
				'name' => 'DESC_Modulo',
				'placeholder' => 'Descripción del módulo',
				'maxlength' => 100,
				'size' => 20
			);

			/*--------------------FIN ARRAY DE LA DESCRIPCIÓN DEL MÓDULO-------------------*/


			/*---------------------------------------------------*/



			/*--------------------TRAMPA PARA INSERTAR A LA BASE DE DATOS EL CICLO SELECCIONADO--------------------*/


			/*--------------------ARRAY DEL CICLO-------------------*/

			$ID_Ciclo_Formulario = array(
				'name' => 'ID_Ciclo_Formulario',
				'placeholder' => 'Ciclo',
				'maxlength' => 20,
				'class' => 'ID_Ciclo_Formulario',
				'size' => 20,
				'hidden' => true
			);

			/*--------------------FIN ARRAY DEL CICLO-------------------*/


			/*--------------------FIN TRAMPA PARA INSERTAR A LA BASE DE DATOS EL CICLO SELECCIONADO--------------------*/
		?>

		<?php echo form_open('Modulo/nuevo_modulo',$formularioModulo);?>
		

		<?php echo "<div class='divselect'>" ?>	
		<?php echo form_label('Código del módulo: ','COD_Modulo'); ?>
		<?php echo form_input($COD_Modulo); ?>
		<?php echo("</div>"); ?>
	
		<?php echo "<div class='divselect'>" ?>	
		<?php echo form_label('Descripción del módulo: ','DESC_Modulo'); ?>
		<?php echo form_input($DESC_Modulo); ?>
		<?php echo("</div>"); ?>
	</div>


		<!--------------------TRAMPA PARA INSERTAR A LA BASE DE DATOS EL CICLO SELECCIONADO-------------------->

		<?php echo form_input($ID_Ciclo_Formulario); ?>

		<!--------------------FIN TRAMPA PARA INSERTAR A LA BASE DE DATOS EL CICLO SELECCIONADO-------------------->

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
		var trampaCurso = false;
		var trampaCentro = false;
		var trampaCiclo = false;


		/*----------AL CAMBIAR EL SELECT CURSO----------*/

		//CUANDO SE CAMBIA EL SELECT CURSO.
		$("#select_curso").change(function(){

			//SE PONE LA TRAMPA A "TRUE" PORQUE SE LA MODIFICADO SELECT CURSO.
			trampaCurso = true;

			//SE PONEN LAS TRAMPAS "CENTRO" Y "CICLO" A FALSE PARA QUE TENGAS QUE VOLVER A SELECCIONARLOS.
		 	trampaCentro = false;
		 	trampaCiclo = false;

			//EL SELECT CENTRO SE VACIA.
	    	$("#select_centro").empty();


	    	//PONE COMO VALOR INICIAL EN EL SELECT CICLO "SELECCIONA CENTRO".
	    	$('#select_centro').append($('<option>Selecciona Centro</option>'));


	    	//LLAMA A LA FUNCIÓN "OBTENER_CENTROS" UTILIZANDO JSON QUE RELLENARÁ EL SELECT CURSO.
	    	$.post({url: "<?php echo base_url(); ?>index.php/Centro/obtener_centros",
	        datatype:"json",
	        data:{'ID_Curso':$("#select_curso").val()},
	        success: function(devuelto){
	        	var array=JSON.parse(devuelto);
	        	for (var i = 0; i < array.length; i++) {

	            	$('#select_centro').append($('<option>', {

	                	value: array[i]['ID_Centro'],
	                	text: array[i]['DESC_Centro']

	            	}));
	        	}
	    

	    	}});

		});

		/*----------FIN AL CAMBIAR EL SELECT CURSO----------*/


		/*--------------------------------------------------*/


		/*----------AL CAMBIAR EL SELECT CENTRO----------*/


		//CUANDO SE CAMBIA EL SELECT CENTRO.
		$("#select_centro").change(function(){

			//SE PONE LA TRAMPA A "TRUE" PORQUE SE LA MODIFICADO SELECT CENTRO.
			trampaCentro = true;


			//EL SELECT CICLO SE VACIA.
	    	$("#select_ciclo").empty();



	    	//PONE COMO VALOR INICIAL EN EL SELECT CICLO "SELECCIONA CICLO".
	    	$('#select_ciclo').append($('<option>Selecciona Ciclo</option>'));


	    	//LLAMA A LA FUNCIÓN "OBTENER_CICLOS" UTILIZANDO JSON QUE RELLENARÁ EL SELECT CENTRO.
	    	$.post({url: "<?php echo base_url(); ?>index.php/Ciclo/obtener_ciclos",
	        datatype:"json",
	        data:{'ID_Curso':$("#select_curso").val(), 'ID_Centro':$("#select_centro").val()},
	        success: function(devuelto){

	        	var array=JSON.parse(devuelto);
	        	for (var i = 0; i < array.length; i++) {
	            	$('#select_ciclo').append($('<option>', {

	                	value: array[i]['ID_Ciclo'],
	                	text: array[i]['COD_Ciclo']

	            	}));

	        	}
	    

	    	}});


		});

		/*----------FIN AL CAMBIAR EL SELECT CENTRO----------*/


		/*--------------------------------------------------*/


		/*----------AL CAMBIAR EL SELECT CICLO----------*/


		//CUANDO SE CAMBIA EL SELECT CICLO.
		$("#select_ciclo").change(function(){

			//SE PONE LA TRAMPA A "TRUE" PORQUE SE LA MODIFICADO SELECT CICLO.
			trampaCiclo = true;


	    	//RELLENA EL INPUT CICLO DEL FORMULARIO CON EL VALOR DEL CICLO QUE SE HAYA SELECCIONADO. 
	    	$('.ID_Ciclo_Formulario').val($("#select_ciclo").val());

		});

		/*----------FIN AL CAMBIAR EL SELECT CICLO----------*/


		/*--------------------------------------------------*/


		/*----------AL CLICAR EN EL BOTÓN MOSTRAR----------*/


		//CUANDO SE CLICA EN EL BOTÓN MOSTRAR.
		$("#botonMostrar").click(function(){
    		
    		//SI NO SE HA SELECCIONADO CURSO.
    		if(trampaCurso == false){

    			//MUESTRA MENSAJE DE ERROR.
    			alert("¡Selecciona un curso!");
    		}


    		//SI NO SE HA SELECCIONADO CENTRO.
    		if(trampaCentro == false){

    			//MUESTRA MENSAJE DE ERROR.
    			alert("¡Selecciona un centro!");
    		}


    		//SI NO SE HA SELECCIONADO CICLO.
    		if(trampaCiclo == false){

    			//MUESTRA MENSAJE DE ERROR.
    			alert("¡Selecciona un ciclo!");
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
    		
    		//VUELVE A LA PÁGINA PRINCIPAL DE MÓDULO.
    		window.location.href = "../Modulo";
	    });

		/*----------FIN AL CLICAR EN EL BOTÓN VOLVER----------*/


	});

	/*----------FIN AL CARGAR EL DOCUMENTO----------*/

</script>


<!----------FIN SCRIPT---------->	