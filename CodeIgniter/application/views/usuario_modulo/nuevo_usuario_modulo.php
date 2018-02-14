
<h1 class="datosact">Añadir Usuarios a un Módulo</h1>


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


		//SI HAY CENTROS
		if ($centros){

			//CREA UN SELECT DE CENTROS PONIENDO "SELECCIONA CENTRO" COMO VALOR PRINCIPAL
			echo "<div class='divselect'> Centro: <select id='select_centro'>
				  <option>Selecciona centro</option>";

			//RELLENA EL SELECT CON CENTROS
			foreach ($centros->result() as $centro) {
				echo "<option value='$centro->ID_Centro'>$centro->DESC_Centro</option>";
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


	<h1>Selecciona Usuario</h1>

	
	<!--------------------TIPOS-------------------->

	<?php
		//SI HAY TIPOS DE USUARIOS
		if ($tipos){

			//CREA UN SELECT DE TIPOS DE USUARIOS PONIENDO "SELECCIONA TIPO USUARIO" COMO VALOR PRINCIPAL
			echo "<div class='divselect'> Tipo Usuario: <select id='select_tipo'>
				  <option>Selecciona Tipo Usuario</option>";

			//RELLENA EL SELECT CON TIPOS DE USUARIOS
			foreach ($tipos->result() as $tipo) {
				echo "<option value='$tipo->ID_TUsuario'>$tipo->DESC_TUsuario</option>";
			}

			echo "</select> </div>";			
		}
	?>


	<!--------------------FIN TIPOS-------------------->


	<!-------------------------------------------------->

	
	<!--------------------USUARIO-------------------->

	<div class="divselect"> Usuario:
	<select id="select_usuario">

		<option value="0">Selecciona Usuario</option>

	</select> </div>


	<!--------------------FIN USUARIO-------------------->
	
	


	<!-------------------------------------------------->


	<!--------------------BOTÓN MOSTRAR-------------------->
	
	
	<button id="botonMostrar" class="boton">Mostrar</button>
	</div>

	<!--------------------FIN BOTÓN MOSTRAR-------------------->


	<!-------------------------------------------------->


	<!--------------------TABLA USUARIOS-------------------->
 <article class="tablaResponsive">
	<div class="tablaoculta">
	<table id="tabla_usuarios_modulos_tipo" class="tabla_usuarios_modulos" >
		<tr>
			<th>Curso</th>
			<th>Centro</th>
			<th>Ciclo</th>
			<th>Modulo</th>
			<th>Tipo Usuario</th>
			<th>Usuario</th>
			<th>Nombre</th>
			<th>Apellidos</th>
		</tr>
	</table>
	</div>
</article>

	<!--------------------FIN TABLA USUARIOS-------------------->
	
	



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
		var trampaCentro = false;
		var trampaCiclo = false;
		var trampaModulo = false;
		var	trampaTipo = false;
		var	trampaUsuario = false;


		/*----------AL CAMBIAR EL SELECT CURSO----------*/

		//CUANDO SE CAMBIA EL SELECT CURSO.
		$("#select_curso").change(function(){

			//SE PONE LA TRAMPA "CURSO" A "TRUE" PORQUE SE LA MODIFICADO SELECT CURSO.
			trampaCurso = true;

			//SE PONE LAS TRAMPAS "CENTRO", "CICLO", "MODULO", "TIPO" Y "USUARIO" A FALSE PARA QUE TENGAS QUE VOLVER A SELECCIONARLAS.
			trampaCentro = false;
			trampaCiclo = false;
			trampaModulo = false;
			trampaTipo = false;
			trampaUsuario = false;

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

		/*----------FIN AL CAMBIAR EL SELECT CENTRO----------*/


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


		/*----------AL CAMBIAR EL SELECT TIPO----------*/

		//CUANDO SE CAMBIA EL SELECT TIPO.
		$("#select_tipo").change(function(){

			//SE PONE LA TRAMPA A "TRUE" PORQUE SE LA MODIFICADO SELECT TIPO.
			trampaTipo = true;

			//EL SELECT USUARIO SE VACIA.
	    	$("#select_usuario").empty();


	    	//VACIA LAS FILAS DE LA TABLA DE USUARIOS MODULOS.
	    	$(".contenido").remove();


	    	//PONE COMO VALOR INICIAL EN EL SELECT USUARIO "SELECCIONA USUARIO".
	    	$('#select_usuario').append($('<option>Selecciona Usuario</option>'));


	    	//LLAMA A LA FUNCIÓN "OBTENER_USUARIOS_MODULOS" UTILIZANDO JSON QUE RELLENARÁ EL SELECT USUARIOS.
	    	$.post({url: "<?php echo base_url(); ?>index.php/Usuario_Modulo/obtener_usuarios_tipo",
	        datatype:"json",
	        data:{'ID_Centro':$("#select_centro").val(),'ID_TUsuario':$("#select_tipo").val()},
	        success: function(devuelto){

	        	var array=JSON.parse(devuelto);
	        	for (var i = 0; i < array.length; i++) {
	            	$('#select_usuario').append($('<option>', {

	                	value: array[i]['ID_Usuario'],
	                	text: array[i]['User']

	            	}));

	        	}
	    

	    	}});

		});

		/*----------FIN AL CAMBIAR EL SELECT TIPO----------*/


		/*--------------------------------------------------*/


		/*----------AL CAMBIAR EL SELECT USUARIO----------*/

		//CUANDO SE CAMBIA EL SELECT USUARIO.
		$("#select_usuario").change(function(){

			//SE PONE LA TRAMPA A "TRUE" PORQUE SE LA MODIFICADO SELECT USUARIO.
			trampaUsuario = true;

		});

		/*----------FIN AL CAMBIAR EL SELECT USUARIO----------*/


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


    		//SI NO SE HA SELECCIONADO TIPO DE USUARIO.
    		if(trampaTipo == false){

    			//MUESTRA MENSAJE DE ERROR.
    			alert("¡Selecciona un tipo de usuario!");
    		}


    		//SI NO SE HA SELECCIONADO USUARIO.
    		if(trampaUsuario == false){

    			//MUESTRA MENSAJE DE ERROR.
    			alert("¡Selecciona un usuario!");
    		}


    		//SI SE HAN SELECCIONADO TODOS LOS PARÁMETROS.
    		else{

				//HABILITA EL BOTÓN CREAR.
				$('#botonCrear').prop('disabled',false);


		    	//VACIA LAS FILAS DE LA TABLA DE MODULOS.
		    	$(".contenido").remove();


		    	//LLAMA A LA FUNCIÓN "OBTENER_USUARIOS_MODULOS_TIPO" UTILIZANDO JSON.
		    	$.post({url: "<?php echo base_url(); ?>index.php/Usuario_Modulo/obtener_usuario_id",
		        datatype:"json",
	        	data:{'ID_Usuario':$("#select_usuario").val()},
		        success: function(devuelto){
		        $('.tablaoculta').css("display","block");
		        
		        	var array=JSON.parse(devuelto);
		        	for (var i = 0; i < array.length; i++) {

		        	
		        		//RELLENA LA TABLA CON LOS USUARIOS ASIGNADOS A MÓDULOS.
		            	$('#tabla_usuarios_modulos_tipo').append($('<tr class="contenido"><td>'+$("#select_curso option:selected").text()+'</td><td>'+$("#select_centro option:selected").text()+'</td><td>'+$("#select_ciclo option:selected").text()+'</td><td>'+$("#select_modulo option:selected").text()+'</td><td>'+$("#select_tipo option:selected").text()+'</td><td>'+array[i]['User']+'</td><td>'+array[i]['Nombre']+'</td><td>'+array[i]['Apellidos']+'</td></tr>'));

		        	}
		    

		    	}});

	    	}

	    });

		/*----------FIN AL CLICAR EN EL BOTÓN MOSTRAR----------*/


		/*--------------------------------------------------*/


		/*----------AL CLICAR EN EL BOTÓN VOLVER----------*/


		//CUANDO SE CLICA EN EL BOTÓN VOLVER.
		$("#botonVolver").click(function(){
    		
    		//VUELVE A LA PÁGINA PRINCIPAL DE USUARIO_MODULO.
    		window.location.href = "../Usuario_Modulo";
	    });

		/*----------FIN AL CLICAR EN EL BOTÓN VOLVER----------*/


		/*--------------------------------------------------*/


		/*----------AL CLICAR EN EL BOTÓN CREAR----------*/


		//CUANDO SE CLICA EN EL BOTÓN CREAR.
		$("#botonCrear").click(function(){
    		
    		//LLAMA A LA FUNCIÓN "NUEVO_USUARIO_MODULO" UTILIZANDO JSON.
		    $.post({url: "<?php echo base_url(); ?>index.php/Usuario_Modulo/nuevo_usuario_modulo_crear",
		    datatype:"json",
	        data:{'ID_Usuario':$("#select_usuario").val(),'ID_Modulo':$("#select_modulo").val()},
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