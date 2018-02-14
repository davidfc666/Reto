<h1 class="datosact">Añadir Retos a un Módulo</h1>


<div class='divfiltro'>
<h1>Selecciona Modulo</h1>

	<!--------------------CENTRO-------------------->

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

	<!--------------------FIN CENTRO-------------------->


	<!-------------------------------------------------->
	


	
	<!--------------------CICLO-------------------->


	<div class='divselect'> Ciclo:
	<select id="select_ciclo">

		<option value="0">Selecciona Ciclo</option>

	</select> </div>

	<!--------------------FIN CICLO-------------------->
	
	


	<!-------------------------------------------------->
	


	
	<!--------------------MODULO-------------------->


	<div class='divselect'> Modulo:
	<select id="select_modulo">

		<option value="0">Selecciona Módulo</option>

	</select> </div>



	<!--------------------FIN MODULO-------------------->	
	
	


	<h1>Selecciona Reto</h1>

	
	<!--------------------RETO-------------------->


	<div class='divselect'> Reto:
	<select id="select_reto">

		<option value="0">Selecciona Reto</option>

	</select> </div>



	<!--------------------FIN RETO-------------------->	



	<!--------------------BOTÓN MOSTRAR-------------------->
	
	
	<button id="botonMostrar" class="boton">Mostrar</button>
	

	<!--------------------FIN BOTÓN MOSTRAR-------------------->
	
	


	<!-------------------------------------------------->


	<!--------------------TRAMPA ADMINISTRADOR (ID_UADMIN) DEL MÓDULO SELECCIONADO-------------------->
	
	
	<input type="hidden" id="ID_UAdmin"></input>
	

	<!--------------------FIN TRAMPA ADMINISTRADOR (ID_UADMIN) DEL MÓDULO SELECCIONADO-------------------->


</div>


	<!--------------------TABLA RETOS-------------------->
 <article class="tablaResponsive">
	<div class="tablaoculta">
	<table id="tabla_retos_modulos" class="tabla_retos_modulos">
		<tr>
			<th>Curso</th>
			<th>Ciclo</th>
			<th>Modulo</th>
			<th>Reto</th>
			<th>Descripción del reto</th>
		</tr>
	</table>
	</div>
</article>
	<!--------------------FIN TABLA RETOS-------------------->
	
	

	<!--------------------BOTÓN -------------------->
	
	<div class="divbotones">
	<button id="botonCrear" class="boton">Crear</button>
	<button id="botonVolver" class="boton">Volver</button>
	</div>

	<!--------------------FIN BOTÓN -------------------->



<!----------SCRIPT---------->


<script>
	

	/*----------AL CARGAR EL DOCUMENTO----------*/

	$(document).ready(function(){

		//DESABILITA EL BOTÓN CREAR.
		$('#botonCrear').prop('disabled',true);


		//VARIABLES TRAMPA PARA PODER USARLA AL HACER CLICK EN "MOSTRAR".
		var trampaCurso = false;
		var trampaCiclo = false;
		var trampaModulo = false;
		var	trampaReto = false;


		/*----------AL CAMBIAR EL SELECT CURSO----------*/

		//CUANDO SE CAMBIA EL SELECT CURSO.
		$("#select_curso").change(function(){

			//SE PONE LA TRAMPA "CURSO" A "TRUE" PORQUE SE LA MODIFICADO SELECT CURSO.
			trampaCurso = true;

			//SE PONE LAS TRAMPAS "CICLO", "MODULO" Y "RETO" A FALSE PARA QUE TENGAS QUE VOLVER A SELECCIONARLAS.
			trampaCiclo = false;
			trampaModulo = false;
			trampaReto = false;


			//EL SELECT CICLO SE VACIA.
	    	$("#select_ciclo").empty();


	    	//VACIA LAS FILAS DE LA TABLA DE MODULOS.
	    	$(".contenido").remove();


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

		/*----------FIN AL CAMBIAR EL SELECT CURSO----------*/


		/*--------------------------------------------------*/


		/*----------AL CAMBIAR EL SELECT CICLO----------*/


		//CUANDO SE CAMBIA EL SELECT CICLO.
		$("#select_ciclo").change(function(){

			//SE PONE LA TRAMPA A "TRUE" PORQUE SE LA MODIFICADO SELECT CICLO.
			trampaCiclo = true;

			//EL SELECT MODULO SE VACIA.
	    	$("#select_modulo").empty();


	    	//VACIA LAS FILAS DE LA TABLA DE MODULOS.
	    	$(".contenido").remove();


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

			
	    	//LLAMA A LA FUNCIÓN "OBTENER_ID_UADMIN UTILIZANDO JSON.
	    	$.post({url: "<?php echo base_url(); ?>index.php/Reto_Modulo/obtener_id_uadmin",
	        datatype:"json",
	        data:{'ID_Modulo':$("#select_modulo").val()},
	        success: function(devuelto){

	        	var array=JSON.parse(devuelto);
	        	for (var i = 0; i < array.length; i++) {

	            	$('#ID_UAdmin').val(array[i]['ID_Usuario']);	

	            	

	        	}
	    

	    	}});


	    	//LLAMA A LA FUNCIÓN "OBTENER_RETOS" UTILIZANDO JSON QUE RELLENARÁ EL SELECT RETOS.
	    	$.post({url: "<?php echo base_url(); ?>index.php/Reto/obtener_retos",
	        datatype:"json",
	        data:{'ID_Centro':$("#select_centro").val()},
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

				//HABILITA EL BOTÓN CREAR.
				$('#botonCrear').prop('disabled',false);


		    	//VACIA LAS FILAS DE LA TABLA DE MODULOS.
		    	$(".contenido").remove();


		    	//LLAMA A LA FUNCIÓN "OBTENER_RETO_ID" UTILIZANDO JSON.
		    	$.post({url: "<?php echo base_url(); ?>index.php/Reto_Modulo/obtener_reto_id",
		        datatype:"json",
	        	data:{'ID_Reto':$("#select_reto").val()},
		        success: function(devuelto){
		        $('.tablaoculta').css("display","block");
		        
		        	var array=JSON.parse(devuelto);
		        	for (var i = 0; i < array.length; i++) {

		        	
		        		//RELLENA LA TABLA CON LOS RETOS ASIGNADOS A MÓDULOS.
		            	$('#tabla_retos_modulos').append($('<tr class="contenido"><td>'+$("#select_curso option:selected").text()+'</td><td>'+$("#select_ciclo option:selected").text()+'</td><td>'+$("#select_modulo option:selected").text()+'</td><td>'+$("#select_reto option:selected").text()+'</td><td>'+array[i]['DESC_Reto']+'</td></tr>'));

		        	}
		    

		    	}});

	    	}

	    });

		/*----------FIN AL CLICAR EN EL BOTÓN MOSTRAR----------*/


		/*--------------------------------------------------*/


		/*----------AL CLICAR EN EL BOTÓN VOLVER----------*/


		//CUANDO SE CLICA EN EL BOTÓN VOLVER.
		$("#botonVolver").click(function(){
    		
    		//VUELVE A LA PÁGINA PRINCIPAL DE RETO_MODULO.
    		window.location.href = "../Reto_Modulo/reto_modulo_admin";
	    });

		/*----------FIN AL CLICAR EN EL BOTÓN VOLVER----------*/


		/*--------------------------------------------------*/


		/*----------AL CLICAR EN EL BOTÓN CREAR----------*/


		//CUANDO SE CLICA EN EL BOTÓN CREAR.
		$("#botonCrear").click(function(){

    		//LLAMA A LA FUNCIÓN "NUEVO_RETO_MODULO" UTILIZANDO JSON.
		    $.post({url: "<?php echo base_url(); ?>index.php/Reto_Modulo/nuevo_reto_modulo_crear_admin",
		    datatype:"json",
	        data:{'ID_Reto':$("#select_reto").val(),'ID_Modulo':$("#select_modulo").val(), 'ID_UAdmin':$("#ID_UAdmin").val()},
		    success: function(devuelto){

		    	//MUESTRA MENSAJE DE CONFIRMACIÓN.
		    	alert("¡Relación creada correctamente!");

		    	//RECARGA LA PÁGINA.
		    	location.reload();

		    }});

	    });

		/*----------FIN AL CLICAR EN EL BOTÓN CREAR----------*/



	});

	/*----------FIN AL CARGAR EL DOCUMENTO----------*/

</script>


<!----------FIN SCRIPT---------->