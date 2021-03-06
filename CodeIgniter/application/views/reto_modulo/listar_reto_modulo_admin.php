
<div class='divfiltro'>
<h1>Retos de un Módulo</h1>

	<!--------------------CENTRO-------------------->

	<?php

		//SI HAY CURSOS
		if ($cursos){

			//CREA UN SELECT DE CURSOS PONIENDO "SELECCIONA CURSO" COMO VALOR PRINCIPAL
			echo "<div class='divselect'> CURSO: <select id='select_curso'>
				  <option>Selecciona curso</option>";

			//RELLENA EL SELECT CON CURSOS
			foreach ($cursos->result() as $curso) {
				echo "<option value='$curso->ID_Curso'>$curso->COD_Curso</option>";
			}

			echo "</select> </div>" ;			
		}

	?>	

	<!--------------------FIN CENTRO-------------------->


	<!-------------------------------------------------->
	


	
	<!--------------------CICLO-------------------->

	<div class='divselect'> CICLO:
	<select id="select_ciclo">

		<option value="0">Selecciona Ciclo</option>

	</select> </div>


	<!--------------------FIN CICLO-------------------->
	
	


	<!-------------------------------------------------->
	


	
	<!--------------------MODULO-------------------->

	<div class='divselect'> MODULO:
	<select id="select_modulo">

		<option value="0">Selecciona Módulo</option>

	</select> </div>


	<!--------------------FIN MODULO-------------------->
	



	<!--------------------BOTÓN MOSTRAR-------------------->
	
	
	<button id="botonMostrar" class="boton">Mostrar</button>
	</div>

	<!--------------------FIN BOTÓN MOSTRAR-------------------->




	<!--------------------TABLA RETOS MÓDULOS-------------------->
 <article class="tablaResponsive">
<div class="tablaoculta">
	<table id="tabla_retos_modulos" class="tabla_retos_modulos">
		<tr>
			<th>Curso</th>
			<th>Ciclo</th>
			<th>Modulo</th>
			<th>Reto</th>
			<th>Descripción del reto</th>
			<th>Acciones</th>
		</tr>
	</table>
</div>
</article>
	<!--------------------FIN TABLA RETOS MÓDULOS-------------------->
	


	<!--------------------BOTÓN AÑADIR NUEVO-------------------->
	
	<div class="divbotones">
		<button id="botonAñadirNuevo" class="boton">Añadir nuevo</button>
		<button id="botonVolverPrincipal" class="boton">Volver</button>
	</div>




<!-------------------------------------------------------------------->


<!----------SCRIPT---------->


<script>
	

	/*----------AL CARGAR EL DOCUMENTO----------*/

	$(document).ready(function(){

		//VARIABLES TRAMPA PARA PODER USARLA AL HACER CLICK EN "MOSTRAR".
		var trampaCurso = false;
		var trampaCiclo = false;
		var trampaModulo = false;


		/*----------AL CAMBIAR EL SELECT CURSO----------*/

		//CUANDO SE CAMBIA EL SELECT CURSO.
		$("#select_curso").change(function(){

			//SE PONE LA TRAMPA "CURSO" A "TRUE" PORQUE SE LA MODIFICADO SELECT CURSO.
			trampaCurso = true;

			//SE PONE LAS TRAMPAS "CICLO" Y "MODULO" A FALSE PARA QUE TENGAS QUE VOLVER A SELECCIONARLAS.
			trampaCiclo = false;
			trampaModulo = false;

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

		});

		/*----------FIN AL CAMBIAR EL SELECT MODULO----------*/


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


    		//SI SE HAN SELECCIONADO TODOS LOS PARÁMETROS.
    		else{


		    	//VACIA LAS FILAS DE LA TABLA DE MODULOS.
		    	$(".contenido").remove();


		    	//LLAMA A LA FUNCIÓN "OBTENER_RETOS_MODULOS" UTILIZANDO JSON.
		    	$.post({url: "<?php echo base_url(); ?>index.php/Reto_Modulo/obtener_retos_modulos",
		        datatype:"json",
	        	data:{'ID_Modulo':$("#select_modulo").val()},
		        success: function(devuelto){
		        $('.tablaoculta').css("display","block");
		        
		        	var array=JSON.parse(devuelto);
		        	for (var i = 0; i < array.length; i++) {

		        	

		        		//VARIABLES QUE CONTIENEN LA RUTA DE BORRAR Y EDITAR.
		        		var url_borrar = "Reto_Modulo/borrar_reto_modulo_admin/"+array[i]['ID_Reto_modulo'];
		        		var url_editar = "Reto_Modulo/editar_reto_modulo_admin/"+array[i]['ID_Reto_modulo'];


		        		//RELLENA LA TABLA CON LOS RETOS ASIGNADOS A MÓDULOS.
		            	$('#tabla_retos_modulos').append($('<tr class="contenido"><td id="datosCurso">'+$("#select_curso option:selected").text()+'</td><td id="datosCiclo">'+$("#select_ciclo option:selected").text()+'</td><td id="datosModulo">'+$("#select_modulo option:selected").text()+'</td><td id="datosTipoUsuario">'+array[i]['COD_Reto']+'</td><td id="datosUsuario">'+array[i]['DESC_Reto']+'</td><td><a href='+url_editar+'><input type="button" value="Editar"></input></a><a href='+url_borrar+'><input type="button" value="Borrar"></input></a></td></tr>'));


		        	}


		    	}});
	    	}

	    });

		/*----------FIN AL CLICAR EN EL BOTÓN MOSTRAR----------*/


		/*--------------------------------------------------*/


		/*----------AL CLICAR EN EL BOTÓN AÑADIR NUEVO----------*/

		//CUANDO SE CLICA EN EL BOTÓN AÑADIR NUEVO.
		$("#botonAñadirNuevo").click(function(){

			//REDIRIGE A LA FUNCIÓN DE "RETO_MODULO.PHP" "NUEVO_RETO_MODULO" QUE LLAMA A LA VISTA "NUEVO_RETO_MODULO.PHP".
			window.location.href = "Reto_Modulo/nuevo_reto_modulo_admin";

	    });

		/*----------FIN AL CLICAR EN EL BOTÓN AÑADIR NUEVO----------*/


		/*--------------------------------------------------*/


		/*----------AL CLICAR EN EL BOTÓN VOLVER PRINCIPAL----------*/

		//CUANDO SE CLICA EN EL BOTÓN AÑADIR NUEVO.
		$("#botonVolverPrincipal").click(function(){

			//REDIRIGE A LA FUNCIÓN DE "CENTRO.PHP" "NUEVO_CENTRO" QUE LLAMA A LA VISTA "NUEVO_CENTRO.PHP".
			window.location.href = "Login/Admin_Centro";

	    });

		/*----------FIN AL CLICAR EN EL BOTÓN VOLVER PRINCIPAL----------*/



	});

	/*----------FIN AL CARGAR EL DOCUMENTO----------*/

</script>


<!----------FIN SCRIPT---------->