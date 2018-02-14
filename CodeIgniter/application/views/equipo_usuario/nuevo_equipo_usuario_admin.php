<h1 class="datosact">Añadir Usuarios a un Equipo</h1>


<div class='divfiltro'>
<h1>Selecciona Equipo</h1>

	<!--------------------CURSO Y CENTRO-------------------->

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

	<!--------------------FIN CURSO Y CENTRO-------------------->
	


	
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
	
	


	<!-------------------------------------------------->
	


	
	<!--------------------RETO-------------------->

	<div class='divselect'> Reto:
	<select id="select_reto">

		<option value="0">Selecciona Reto</option>

	</select> </div>


	<!--------------------FIN RETO-------------------->	
	
	


	<!-------------------------------------------------->
	


	
	<!--------------------EQUIPO-------------------->

	<div class='divselect'> Euipo:
	<select id="select_equipo">

		<option value="0">Selecciona Equipo</option>

	</select> </div>


	<!--------------------FIN EQUIPO-------------------->	


	<!-------------------------------------------------->

	
	<!--------------------TIPOS-------------------->

	<?php
		//SI HAY TIPOS DE USUARIOS
		if ($tipos){

			//CREA UN SELECT DE TIPOS DE USUARIOS PONIENDO "SELECCIONA TIPO USUARIO" COMO VALOR PRINCIPAL

			echo "<h1> Selecciona Usuario </h1>";


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

	<div class='divselect'> Usuario:
	<select id="select_usuario">

		<option value="0">Selecciona Usuario</option>

	</select> </div>


	<!--------------------FIN USUARIO-------------------->
	
	


	<!-------------------------------------------------->
	


	
	<!--------------------ROL-------------------->

	<div class='divselect'> Rol:
	<select id="select_rol">

		<option value="0">Selecciona Rol</option>

	</select> </div>


	<!--------------------FIN ROL-------------------->
	


	<!-------------------------------------------------->


	<!--------------------BOTÓN MOSTRAR-------------------->
	
	
	<button id="botonMostrar" class="boton">Mostrar</button>
	</div>

	<!--------------------FIN BOTÓN MOSTRAR-------------------->



	<!--------------------TABLA EQUIPOS USUARIOS-------------------->
 
	<article class="tablaResponsive">
<div class="tablaoculta">
	<h1 id="datosact">Confirme los Datos</h1>
	<table id="tabla_equipos_usuarios" class="tabla_equipos_usuarios">
		<tr>
			<th>Curso</th>
			<th>Ciclo</th>
			<th>Modulo</th>
			<th>Reto</th>
			<th>Equipo</th>
			<th>Tipo de usuario</th>
			<th>Rol de usuario</th>
			<th>Usuario</th>
			<th>Nombre</th>
			<th>Apellidos</th>
		</tr>
	</table>
	</div>
</article>

	<!--------------------FIN TABLA EQUIPOS USUARIOS-------------------->
	
	


	<div class="divbotones">
	<button id="botonCrear" class="boton">Crear</button>
	<button id="botonVolver" class="boton">Volver</button>
	</div>






<!-------------------------------------------------------------------->


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
		var trampaReto = false;
		var trampaEquipo = false;
		var trampaUsuario = false;
		var trampaRol = false;

		/*----------AL CAMBIAR EL SELECT CURSO----------*/

		//CUANDO SE CAMBIA EL SELECT CURSO.
		$("#select_curso").change(function(){

			//SE PONE LA TRAMPA "CURSO" A "TRUE" PORQUE SE LA MODIFICADO SELECT CURSO.
			trampaCurso = true;

			//SE PONEN LAS TRAMPAS "CICLO", "MODULO" Y "RETO" A FALSE PARA QUE TENGAS QUE VOLVER A SELECCIONARLAS.
		 	trampaCiclo = false;
		    trampaModulo = false;
		    trampaReto = false;
		    trampaEquipo = false;
		 	trampaUsuario = false;
			trampaRol = false;

			//EL SELECT CICLO SE VACIA.
	    	$("#select_ciclo").empty();


	    	//VACIA LAS FILAS DE LA TABLA DE EQUIPOS.
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


	    	//VACIA LAS FILAS DE LA TABLA DE EQUIPOS.
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


			//EL SELECT EQUIPO SE VACIA.
	    	$("#select_equipo").empty();


	    	//VACIA LAS FILAS DE LA TABLA DE EQUIPOS.
	    	$(".contenido").remove();


	    	//PONE COMO VALOR INICIAL EN EL SELECT EQUIPO "SELECCIONA EQUIPO".
	    	$('#select_equipo').append($('<option>Selecciona Equipo</option>'));


	    	//LLAMA A LA FUNCIÓN "OBTENER_EQUIPOS" UTILIZANDO JSON QUE RELLENARÁ EL SELECT EQUIPO.
	    	$.post({url: "<?php echo base_url(); ?>index.php/Equipo/obtener_equipos",
	        datatype:"json",
	        data:{'ID_Reto':$("#select_reto").val()},
	        success: function(devuelto){

	        	var array=JSON.parse(devuelto);
	        	for (var i = 0; i < array.length; i++) {
	            	$('#select_equipo').append($('<option>', {

	                	value: array[i]['ID_Equipo'],
	                	text: array[i]['COD_Equipo']

	            	}));

	        	}
	    

	    	}});		

		});

		/*----------FIN AL CAMBIAR EL SELECT RETO----------*/


		/*--------------------------------------------------*/


		/*----------AL CAMBIAR EL SELECT EQUIPO----------*/

		//CUANDO SE CAMBIA EL SELECT EQUIPO.
		$("#select_equipo").change(function(){

			//SE PONE LA TRAMPA A "TRUE" PORQUE SE LA MODIFICADO SELECT EQUIPO.
			trampaEquipo = true;

		});

		/*----------FIN AL CAMBIAR EL SELECT EQUIPO----------*/


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
	    	$.post({url: "<?php echo base_url(); ?>index.php/Equipo_Usuario/obtener_usuarios_tipo_modulo",
	        datatype:"json",
	        data:{'ID_Modulo':$("#select_modulo").val(),'ID_TUsuario':$("#select_tipo").val()},
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

			//EL SELECT ROL SE VACIA.
	    	$("#select_rol").empty();


	    	//VACIA LAS FILAS DE LA TABLA DE EQUIPOS.
	    	$(".contenido").remove();


	    	//PONE COMO VALOR INICIAL EN EL SELECT ROL "SELECCIONA ROL".
	    	$('#select_rol').append($('<option>Selecciona Rol</option><option>Coordinador/ra</option><option>Responsable comunicación</option><option>Responsable material</option><option>Secretario/a</option>'));	
			

		});

		/*----------FIN AL CAMBIAR EL SELECT EQUIPO----------*/


		/*--------------------------------------------------*/


		/*----------AL CAMBIAR EL SELECT ROL----------*/

		//CUANDO SE CAMBIA EL SELECT ROL.
		$("#select_rol").change(function(){

			//SE PONE LA TRAMPA A "TRUE" PORQUE SE LA MODIFICADO SELECT ROL.
			trampaRol = true;
			

		});

		/*----------FIN AL CAMBIAR EL SELECT ROL----------*/


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


    		//SI NO SE HA SELECCIONADO EQUIPO.
    		if(trampaEquipo == false){

    			//MUESTRA MENSAJE DE ERROR.
    			alert("¡Selecciona un equipo!");
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


    		//SI NO SE HA SELECCIONADO ROL.
    		if(trampaRol == false){

    			//MUESTRA MENSAJE DE ERROR.
    			alert("¡Selecciona un rol!");
    		}


    	8	//SI SE HAN SELECCIONADO TODOS LOS PARÁMETROS.
    		else{

				//HABILITA EL BOTÓN CREAR.
				$('#botonCrear').prop('disabled',false);


		    	//VACIA LAS FILAS DE LA TABLA DE EQUIPOS.
		    	$(".contenido").remove();


		    	//LLAMA A LA FUNCIÓN "OBTENER_EQUIPOS_USUARIOS_USUARIO" UTILIZANDO JSON.
		    	$.post({url: "<?php echo base_url(); ?>index.php/Equipo_Usuario/obtener_equipos_usuarios_usuario",
		        datatype:"json",
		        data:{'ID_Usuario':$("#select_usuario").val()},
		        success: function(devuelto){
		        $('.tablaoculta').css("display","block");
		        
		        	var array=JSON.parse(devuelto);
		        	for (var i = 0; i < array.length; i++) {
		        	

		        		//VARIABLES QUE CONTIENEN LA RUTA DE BORRAR Y EDITAR.
		        		
		        		var url_editar = "Equipo_Usuario/editar_equipo_usuario/"+array[i]['ID_Equipo_Alumno'];
		        		

		        		//RELLENA LA TABLA CON LOS EQUIPOS.
		            	$('#tabla_equipos_usuarios').append($('<tr class="contenido"><td>'+$("#select_curso option:selected").text()+'</td><td>'+$("#select_ciclo option:selected").text()+'</td><td>'+$("#select_modulo option:selected").text()+'</td><td>'+$("#select_reto option:selected").text()+'</td><td>'+$("#select_equipo option:selected").text()+'</td><td>'+array[i]['DESC_TUsuario']+'</td><td>'+$("#select_rol option:selected").text()+'</td><td>'+$("#select_usuario option:selected").text()+'</td><td>'+array[i]['Nombre']+'</td><td>'+array[i]['Apellidos']+'</td></tr>'));

		        	}
		    

		    	}});
	    	}

	    });

		/*----------FIN AL CLICAR EN EL BOTÓN MOSTRAR----------*/


		/*--------------------------------------------------*/


		/*----------AL CLICAR EN EL BOTÓN VOLVER----------*/


		//CUANDO SE CLICA EN EL BOTÓN VOLVER.
		$("#botonVolver").click(function(){
    		
    		//VUELVE A LA PÁGINA PRINCIPAL DE EQUIPO_USUARIO.
    		window.location.href = "../Equipo_Usuario/equipo_usuario_admin";
	    });

		/*----------FIN AL CLICAR EN EL BOTÓN VOLVER----------*/


		/*--------------------------------------------------*/


		/*----------AL CLICAR EN EL BOTÓN CREAR----------*/


		//CUANDO SE CLICA EN EL BOTÓN CREAR.
		$("#botonCrear").click(function(){
    		
    		//LLAMA A LA FUNCIÓN "NUEVO_EQUIPO_USUARIO" UTILIZANDO JSON.
		    $.post({url: "<?php echo base_url(); ?>index.php/Equipo_Usuario/nuevo_equipo_usuario_crear",
		    datatype:"json",
	        data:{'ID_Usuario':$("#select_usuario").val(),'ID_Equipo':$("#select_equipo").val(),'COD_Rol':$("#select_rol").val()},
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