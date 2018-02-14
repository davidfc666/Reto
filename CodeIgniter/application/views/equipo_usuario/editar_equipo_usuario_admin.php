<div>
	
<!--------------------DATOS ACTUALES-------------------->
	
<h1 class="datosact">DATOS ACTUALES</h1>	

	<article class="tablaResponsive">
		<?php

    		//SI HAY USUARIO
			if ($usuario){

				//CREA UNA TABLA COM SUS DATOS
				echo "<table class='tabla_equipos_usuarios'>";

				foreach ($usuario->result() as $usu) {
					echo "
					<tr>
						<th>Curso</th>
						<th>Ciclo</th>
						<th>Reto</th>
						<th>Grupo</th>
						<th>Tipo de usuario</th>
						<th>Rol</th>
						<th>Usuario</th>
						<th>Nombre</th>
						<th>Apellidos</th>
					</tr>
					<tr>
						<td value='$usu->ID_Curso'>$usu->COD_Curso</td>
						<td value='$usu->ID_Ciclo'>$usu->COD_Ciclo</td>
						<td value='$usu->ID_Reto'>$usu->COD_Reto</td>
						<td value='$usu->ID_Equipo'>$usu->COD_Equipo</td>
						<td value='$usu->ID_TUsuario'>$usu->DESC_TUsuario</td>
						<td value='$usu->COD_Rol'>$usu->COD_Rol</td>
						<td value='$usu->User'>$usu->User</td>
						<td value='$usu->Nombre'>$usu->Nombre</td>
						<td value='$usu->Apellidos'>$usu->Apellidos</td>
					</tr>";
				}

				echo "</table>";			
			}

		?>
</article>
	</div>

	<!--------------------FIN DATOS ACTUALES-------------------->



	<!-------------------------------------------------------------------->


	
	<!--------------------DATOS NUEVOS-------------------->
	
	<div class="divfiltronuevo">
		
		<h1>DATOS NUEVOS</h1>


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
		


		
		<!--------------------CICLO-------------------->

		<div class="divselect"> Ciclo:
		<select id="select_ciclo">

			<option value="0">Selecciona Ciclo</option>

		</select> </div>


		<!--------------------FIN CICLO-------------------->
		
		


		<!-------------------------------------------------->
		


		
		<!--------------------MODULO-------------------->

		<div class="divselect"> Modulo:
		<select id="select_modulo">

			<option value="0">Selecciona Módulo</option>

		</select> </div>


		<!--------------------FIN MODULO-------------------->


		<!-------------------------------------------------->
		


		
		<!--------------------RETO-------------------->

		<div class="divselect"> Reto:
		<select id="select_reto">

			<option value="0">Selecciona Reto</option>

		</select> </div>


		<!--------------------FIN RETO-------------------->
		
		


		<!-------------------------------------------------->
		


		
		<!--------------------EQUIPO-------------------->

		<div class="divselect"> Equipo:
		<select id="select_equipo">

			<option value="0">Selecciona Equipo</option>

		</select> </div>


		<!--------------------FIN EQUIPO-------------------->
		
		


		<!-------------------------------------------------->
		


		
		<!--------------------ROL-------------------->

		<div class="divselect"> Rol:
		<select id="select_rol">

			<option value="0">Selecciona Rol</option>

		</select> </div>


		<!--------------------FIN ROL-------------------->
		
		


		<!-------------------------------------------------->



		<!--------------------BOTÓN MOSTRAR-------------------->
	
	
		<button id="botonMostrar" class="boton">Mostrar</button>
		</div>

		<!--------------------FIN BOTÓN MOSTRAR-------------------->
		
		


		<!-------------------------------------------------->



		<!--------------------TABLA DATOS NUEVOS-------------------->
	
	<article class="tablaResponsive">
		<div class="tablaoculta">
		<table id="tabla_equipos_usuarios" class="tabla_equipos_usuarios">
			<tr>
				<th>Curso</th>
				<th>Ciclo</th>
				<th>Reto</th>
				<th>Grupo</th>
				<th>Tipo de usuario</th>
				<th>Rol</th>
				<th>Usuario</th>
				<th>Nombre</th>
				<th>Apellidos</th>
			</tr>
		</table>
		</div>
</article>
		<!--------------------FIN TABLA DATOS NUEVOS-------------------->



	<!--------------------FIN DATOS NUEVOS-------------------->

	<!--------------------BOTÓN -------------------->
	
	
	<div class="divbotones">
	<button id="botonEditar" class="boton">Editar</button>
	<button id="botonVolver" class="boton">Volver</button>
	</div>

	<!--------------------FIN BOTÓN -------------------->


</div>



<!----------SCRIPT---------->


<script>
	

	/*----------AL CARGAR EL DOCUMENTO----------*/

	$(document).ready(function(){


		//VARIABLES TRAMPA PARA PODER USARLA AL HACER CLICK EN "EDITAR".
		var trampaCurso = false;
		var trampaCiclo = false;
		var trampaModulo = false;
		var trampaReto = false;
		var trampaEquipo = false;
		var trampaRol = false;


		/*----------AL CAMBIAR EL SELECT CURSO----------*/

		//CUANDO SE CAMBIA EL SELECT CURSO.
		$("#select_curso").change(function(){

			//SE PONE LA TRAMPA "CURSO" A "TRUE" PORQUE SE LA MODIFICADO SELECT CURSO.
			trampaCurso = true;

			//SE PONE LAS TRAMPAS "CICLO", "MODULO", "RETO", "EQUIPO" Y "ROL" A FALSE PARA QUE TENGAS QUE VOLVER A SELECCIONARLAS.
			trampaCiclo = false;
			trampaModulo = false;
			trampaReto = false;
			trampaEquipo = false;
			trampaRol = false;

			//EL SELECT CICLO SE VACIA.
	    	$("#select_ciclo").empty();


	    	//VACIA LAS FILAS DE LA TABLA DE MODULOS.
	    	$(".contenido").remove();


	    	//PONE COMO VALOR INICIAL EN EL SELECT CICLO "SELECCIONA CICLO".
	    	$('#select_ciclo').append($('<option>Selecciona Ciclo</option>'));


	    	//LLAMA A LA FUNCIÓN "OBTENER_CICLOS" UTILIZANDO JSON QUE RELLENARÁ EL SELECT CENTRO.
	    	$.post({url: "<?php echo base_url(); ?>index.php/Ciclo/obtener_ciclos",
	        datatype:"json",
	        data:{'ID_Curso':$("#select_curso").val(),
	        	  'ID_Centro':"<?php echo $usuario->result()[0]->ID_Centro; ?>"},
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

			//EL SELECT ROL SE VACIA.
	    	$("#select_rol").empty();

			//PONE COMO VALOR INICIAL EN EL SELECT ROL "SELECCIONA ROL".
	    	$('#select_rol').append($('<option>Selecciona Rol</option><option value="Coordinador/ra">Coordinador/ra</option><option value="Responsable comunicación">Responsable comunicación</option><option value="Responsable material">Responsable material</option><option value="Secretario/a">Secretario/a</option>'));	
			

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


    		//SI NO SE HA SELECCIONADO ROL.
    		if(trampaRol == false){

    			//MUESTRA MENSAJE DE ERROR.
    			alert("¡Selecciona un rol!");
    		}


    		//SI SE HAN SELECCIONADO TODOS LOS PARÁMETROS.
    		else{


		    	//VACIA LAS FILAS DE LA TABLA DE MODULOS.
		    	$(".contenido").remove();

		        $('.tablaoculta').css("display","block");


		        //RELLENA LA TABLA CON LOS USUARIOS ASIGNADOS A MÓDULOS.
		        $('#tabla_equipos_usuarios').append($('<tr class="contenido"><td id="datosCurso">'+$("#select_curso option:selected").text()+'</td><td id="datosCiclo">'+$("#select_ciclo option:selected").text()+'</td><td id="datosReto">'+$("#select_reto option:selected").text()+'</td><td id="datosEquipo">'+$("#select_equipo option:selected").text()+'</td><td id="datosTipoUsuario">'+"<?php echo $usuario->result()[0]->DESC_TUsuario; ?>"+'</td><td id="datosROl">'+$("#select_rol option:selected").text()+'</td><td id="datosUsuario">'+"<?php echo $usuario->result()[0]->User; ?>"+'</td><td>'+"<?php echo $usuario->result()[0]->Nombre; ?>"+'</td><td>'+"<?php echo $usuario->result()[0]->Apellidos; ?>"+'</td></tr>'));

	    	}

	    });

		/*----------FIN AL CLICAR EN EL BOTÓN MOSTRAR----------*/


		/*--------------------------------------------------*/


		/*----------AL CLICAR EN EL BOTÓN VOLVER----------*/


		//CUANDO SE CLICA EN EL BOTÓN VOLVER.
		$("#botonVolver").click(function(){
    	
    		//VUELVE A LA PÁGINA PRINCIPAL DE EQUIPO_USUARIO.
    		location.href = "../../equipo_usuario_admin";
	    });

		/*----------FIN AL CLICAR EN EL BOTÓN VOLVER----------*/


		/*--------------------------------------------------*/


		/*----------AL CLICAR EN EL BOTÓN EDITAR----------*/


		//CUANDO SE CLICA EN EL BOTÓN EDITAR.
		$("#botonEditar").click(function(){
			alert("ow");
    		//LLAMA A LA FUNCIÓN "guardar_cambios_equipo_usuario" UTILIZANDO JSON.
		    $.post({url: "<?php echo base_url(); ?>index.php/Equipo_Usuario/guardar_cambios_equipo_usuario/<?php echo $usuario->result()[0]->ID_Equipo_Alumno; ?>",
		    datatype:"json",
	        data:{'ID_Equipo':$("#select_equipo").val(),'COD_Rol':$("#select_rol").val()},
		    success: function(devuelto){

		    	//MUESTRA MENSAJE DE CONFIRMACIÓN.
		    	alert("¡Relación editada correctamente!");

		    	//VUELVE A LA PÁGINA PRINCIPAL DE EQUIPO_USUARIO.
    			window.location.href = "../Equipo_Usuario/equipo_usuario_admin";

		    }});

	    });

		/*----------FIN AL CLICAR EN EL BOTÓN EDITAR----------*/



	});

	/*----------FIN AL CARGAR EL DOCUMENTO----------*/

</script>


<!----------FIN SCRIPT---------->