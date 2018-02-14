<div>
	

	<!--------------------CURSO-------------------->

<div class='divfiltro'>

<h1>CICLOS</h1>	
	<?php

		//SI HAY CURSOS
		if ($cursos){

			//CREA UN SELECT DE CURSOS PONIENDO "SELECCIONA CURSO" COMO VALOR PRINCIPAL

			echo "<div class='divselect'> CURSO: 
			<select id='select_curso'>
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

	<div class='divselect'> CENTRO:
	<select id="select_centro">

		<option value="0">Selecciona Centro</option>

	</select> </div>


	<!--------------------FIN CENTRO-------------------->	
	


	<!-------------------------------------------------->


	<!--------------------BOTÓN MOSTRAR-------------------->
	
	<button id="botonMostrar" class="boton">Mostrar</button>


	</div>

	
	

	<!--------------------FIN BOTÓN MOSTRAR-------------------->


	<!-------------------------------------------------->


	<!--------------------TABLA CICLOS-------------------->
 

<article class="tablaResponsive">
<div class="tablaoculta"> 
	<table id="tabla_ciclos" class="tabla_ciclos">
		<tr>
			<th>Curso</th>
			<th>Centro</th>
			<th>Ciclo</th>
			<th>Acciones</th>
		</tr>
	</table>
</div>
</article>


	<!--------------------FIN TABLA CICLOS-------------------->
	
	


	<!-------------------------------------------------->


	<!--------------------BOTÓN AÑADIR NUEVO-------------------->
	
	<div class="divbotones">
		<button id="botonAñadirNuevo" class="boton">Añadir nuevo</button>
		<button id="botonVolverPrincipal" class="boton">Volver</button>
	</div>
	
	<!--------------------FIN BOTÓN AÑADIR NUEVO-------------------->


</div>



<!-------------------------------------------------------------------->


<!----------SCRIPT---------->


<script>
	

	/*----------AL CARGAR EL DOCUMENTO----------*/

	$(document).ready(function(){

		//VARIABLES TRAMPA PARA PODER USARLA AL HACER CLICK EN "MOSTRAR".
		var trampaCurso = false;
		var trampaCentro = false;


		/*----------AL CAMBIAR EL SELECT CURSO----------*/

		//CUANDO SE CAMBIA EL SELECT CURSO.
		$("#select_curso").change(function(){

			//SE PONE LA TRAMPA "CURSO" A "TRUE" PORQUE SE LA MODIFICADO SELECT CURSO.
			trampaCurso = true;

			//SE PONEN LA TRAMPA "CENTRO" A FALSE PARA QUE TENGAS QUE VOLVER A SELECCIONARLAS.
		 	trampaCentro = false;

			//EL SELECT CENTRO SE VACIA.
	    	$("#select_centro").empty();


	    	//VACIA LAS FILAS DE LA TABLA DE MODULOS.
	    	$(".contenido").remove();


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
			
		});

		/*----------FIN AL CAMBIAR EL SELECT CENTRO----------*/


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


    		//SI SE HAN SELECCIONADO TODOS LOS PARÁMETROS.
    		else{


		    	//VACIA LAS FILAS DE LA TABLA DE CICLOS.
		    	$(".contenido").remove();

		    	//LLAMA A LA FUNCIÓN "OBTENER_CICLOS" UTILIZANDO JSON QUE RELLENARÁ EL SELECT CENTRO.
		    	$.post({url: "<?php echo base_url(); ?>index.php/Ciclo/obtener_ciclos",
		        datatype:"json",
		        data:{'ID_Curso':$("#select_curso").val(), 'ID_Centro':$("#select_centro").val()},
		        success: function(devuelto){

		        $('.tablaoculta').css("display","block");

		        	var array=JSON.parse(devuelto);
		        	for (var i = 0; i < array.length; i++) {


		        		//VARIABLES QUE CONTIENEN LA RUTA DE BORRAR Y EDITAR.
		        		var url_borrar = "Ciclo/borrar_ciclo/"+array[i]['ID_Ciclo'];
		        		var url_editar = "Ciclo/editar_ciclo/"+array[i]['ID_Ciclo'];

		        		//RELLENA LA TABLA CON LOS CICLOS.
		            	$('#tabla_ciclos').append($('<tr class="contenido"><td>'+$("#select_curso option:selected").text()+'</td><td>'+$("#select_centro option:selected").text()+'</td><td>'+array[i]['COD_Ciclo']+'</td><td><a href='+url_editar+'><input type="button" value="Editar"></a><a href='+url_borrar+'><input type="button" value="Borrar"></a></td></tr>'));

		        	}
		    

		    	}});
	    	}

	    });

		/*----------FIN AL CLICAR EN EL BOTÓN MOSTRAR----------*/


		/*--------------------------------------------------*/


		/*----------AL CLICAR EN EL BOTÓN AÑADIR NUEVO----------*/

		//CUANDO SE CLICA EN EL BOTÓN AÑADIR NUEVO.
		$("#botonAñadirNuevo").click(function(){

			//REDIRIGE A LA FUNCIÓN DE "CICLO.PHP" "NUEVO_CICLO" QUE LLAMA A LA VISTA "NUEVO_CICLO.PHP".
			window.location.href = "Ciclo/nuevo_ciclo";

	    });

		/*----------FIN AL CLICAR EN EL BOTÓN AÑADIR NUEVO----------*/


		/*--------------------------------------------------*/


		/*----------AL CLICAR EN EL BOTÓN VOLVER PRINCIPAL----------*/

		//CUANDO SE CLICA EN EL BOTÓN AÑADIR NUEVO.
		$("#botonVolverPrincipal").click(function(){

			//REDIRIGE A LA FUNCIÓN DE "CENTRO.PHP" "NUEVO_CENTRO" QUE LLAMA A LA VISTA "NUEVO_CENTRO.PHP".
			window.location.href = "Login/Administrador";

	    });

		/*----------FIN AL CLICAR EN EL BOTÓN VOLVER PRINCIPAL----------*/



	});

	/*----------FIN AL CARGAR EL DOCUMENTO----------*/

</script>


<!----------FIN SCRIPT---------->