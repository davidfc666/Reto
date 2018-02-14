<h1 class="datosact">Añadir Equipo</h1>	


<div class='divfiltro'>
<h1>Selecciona Reto</h1>

	<!--------------------CURSO-------------------->

	<?php

		//SI HAY CURSOS
		if ($cursos){

			//CREA UN SELECT DE CURSOS PONIENDO "SELECCIONA CURSO" COMO VALOR PRINCIPAL
			echo "<div class='divselect'> Curso: <select id='select_curso'>
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
	
	
	<!-------------------------------------------------->

	
	<!--------------------MÓDULO-------------------->

	<div class='divselect'> Modulo:
	<select id="select_modulo">

		<option value="0">Selecciona Módulo</option>

	</select> </div>


	<!--------------------FIN MÓDULO-------------------->
	
	


	<!-------------------------------------------------->
	


	
	<!--------------------RETO-------------------->

	<div class='divselect'> Reto:
	<select id="select_reto">

		<option value="0">Selecciona Reto</option>

	</select> </div>


	<!--------------------FIN RETO-------------------->	

	<h1>Datos Equipo</h1>

	<!--------------------SECCIÓN FORMULARIO-------------------->
	
		
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
				'maxlength' => 10,
				'size' => 20
			);

			/*--------------------FIN ARRAY DEL CÓDIGO DEL EQUIPO-------------------*/


			/*---------------------------------------------------*/


			/*--------------------ARRAY DE LA DESCRIPCIÓN DEL EQUIPO-------------------*/

			$DESC_Equipo = array(
				'name' => 'DESC_Equipo',
				'placeholder' => 'Descripción del equipo',
				'maxlength' => 50,
				'size' => 20
			);

			/*--------------------FIN ARRAY DE LA DESCRIPCIÓN DEL EQUIPO-------------------*/


			/*---------------------------------------------------*/



			/*--------------------TRAMPA PARA INSERTAR A LA BASE DE DATOS EL RETO SELECCIONADO--------------------*/

			/*--------------------ARRAY DEL RETO-------------------*/

			$ID_Reto_Formulario = array(
				'name' => 'ID_Reto_Formulario',
				'placeholder' => 'ID_Reto',
				'maxlength' => 20,
				'class' => 'ID_Reto_Formulario',
				'size' => 20,
				'hidden' => true
			);

			/*--------------------FIN ARRAY DEL RETO-------------------*/			


			/*--------------------FIN TRAMPA PARA INSERTAR A LA BASE DE DATOS EL RETO SELECCIONADO--------------------*/
		?>

		<?php echo form_open('Equipo/nuevo_equipo',$formularioEquipo);?>
		
		<div class="divselect">
		<?php echo form_label('Código del equipo: ','COD_Equipo'); ?>
		<?php echo form_input($COD_Equipo); ?>
		</div>


		<div class="divselect">
		<?php echo form_label('Descripción del equipo: ','DESC_Equipo'); ?>
		<?php echo form_input($DESC_Equipo); ?>
		</div>

		</div>
		<!--------------------TRAMPA PARA INSERTAR A LA BASE DE DATOS EL RETO SELECCIONADO-------------------->

		<?php echo form_input($ID_Reto_Formulario); ?>

		<!--------------------FIN TRAMPA PARA INSERTAR A LA BASE DE DATOS EL RETO SELECCIONADO-------------------->
		
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
		var trampaModulo = false;


		/*----------AL CAMBIAR EL SELECT CURSO----------*/

		//CUANDO SE CAMBIA EL SELECT CURSO.
		$("#select_curso").change(function(){

			//SE PONE LA TRAMPA "CURSO" A "TRUE" PORQUE SE LA MODIFICADO SELECT CURSO.
			trampaCurso = true;

			//SE PONEN LAS TRAMPAS "CENTRO", "CICLO" y "MODULO" A FALSE PARA QUE TENGAS QUE VOLVER A SELECCIONARLAS.
		 	trampaCentro = false;
		 	trampaCiclo = false;
		    trampaModulo = false;

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

			//EL SELECT MODULO SE VACIA.
	    	$("#select_modulo").empty();


	    	//PONE COMO VALOR INICIAL EN EL SELECT MODULO "SELECCIONA MODULO".
	    	$('#select_modulo').append($('<option>Selecciona Módulo</option>'));


	    	//LLAMA A LA FUNCIÓN "OBTENER_MODULOS" UTILIZANDO JSON QUE RELLENARÁ EL SELECT CENTRO.
	    	$.post({url: "<?php echo base_url(); ?>index.php/Modulo/obtener_modulos",
	        datatype:"json",
	        data:{'ID_Ciclo':$("#select_ciclo").val()},
	        success: function(devuelto){

	        	var array=JSON.parse(devuelto);
	        	for (var i = 0; i < array.length; i++) {
	            	$('#select_modulo').append($('<option>', {

	                	value: array[i]['ID_Modulo'],
	                	text: array[i]['COD_Modulo']

	            	}));

	        	}
	    

	    	}});

		});

		/*----------FIN AL CAMBIAR EL SELECT CICLO----------*/


		/*--------------------------------------------------*/


		/*----------AL CAMBIAR EL SELECT MODULO----------*/

		//CUANDO SE CAMBIA EL SELECT MODULO.
		$("#select_modulo").change(function(){

			//SE PONE LA TRAMPA A "TRUE" PORQUE SE LA MODIFICADO SELECT MODULO.
			trampaModulo = true;


			//EL SELECT RETO SE VACIA.
	    	$("#select_reto").empty();


	    	//VACIA LAS FILAS DE LA TABLA DE EQUIPOS.
	    	$(".contenido").remove();


	    	//PONE COMO VALOR INICIAL EN EL SELECT RETO "SELECCIONA RETO".
	    	$('#select_reto').append($('<option>Selecciona Reto</option>'));


	    	//LLAMA A LA FUNCIÓN "OBTENER_RETOS" UTILIZANDO JSON QUE RELLENARÁ EL SELECT MODULO.
	    	$.post({url: "<?php echo base_url(); ?>index.php/Reto_Modulo/obtener_retos_modulos",
	        datatype:"json",
	        data:{'ID_Modulo':$("#select_modulo").val()},
	        success: function(devuelto){

	        	var array=JSON.parse(devuelto);
	        	for (var i = 0; i < array.length; i++) {
	            	$('#select_reto').append($('<option>', {

	                	value: array[i]['ID_Reto'],
	                	text: array[i]['COD_Reto']

	            	}));

	        	}
	    

	    	}});

		});

		/*----------FIN AL CAMBIAR EL SELECT MODULO----------*/


		/*--------------------------------------------------*/


		/*----------AL CAMBIAR EL SELECT RETO----------*/

		//CUANDO SE CAMBIA EL SELECT RETO.
		$("#select_reto").change(function(){

			//SE PONE LA TRAMPA A "TRUE" PORQUE SE LA MODIFICADO SELECT RETO.
			trampaReto = true;


	    	//RELLENA EL INPUT RETO DEL FORMULARIO CON EL VALOR DEL RETO QUE SE HAYA SELECCIONADO. 
	    	$('.ID_Reto_Formulario').val($("#select_reto").val());			

		});

		/*----------FIN AL CAMBIAR EL SELECT RETO----------*/


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


    		//SI NO SE HA SELECCIONADO MÓDULO.
    		if(trampaModulo == false){

    			//MUESTRA MENSAJE DE ERROR.
    			alert("¡Selecciona un módulo!");
    		}


    		//SI NO SE HA SELECCIONADO RETO.
    		if(trampaReto == false){

    			//MUESTRA MENSAJE DE ERROR.
    			alert("¡Selecciona un reto!");
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
    		
    		//VUELVE A LA PÁGINA PRINCIPAL DE EQUIPO.
    		window.location.href = "../Equipo";
	    });

		/*----------FIN AL CLICAR EN EL BOTÓN VOLVER----------*/



	});

	/*----------FIN AL CARGAR EL DOCUMENTO----------*/

</script>


<!----------FIN SCRIPT---------->	