<div>
	
<!--------------------DATOS ACTUALES-------------------->
	
	<h1 class="datosact">DATOS ACTUALES</h1>	
<article class="tablaResponsive">
		<?php

    		//SI HAY USUARIO
			if ($usuario2){

				//CREA UNA TABLA COM SUS DATOS
				echo "<table class='tabla_usuario_editar'>";

				foreach ($usuario2->result() as $usu) {
					echo "
					<tr>
						<th>Centro</th>
						<th>Tipo de usuario</th>
						<th>Usuario</th>
						<th>Nombre</th>
						<th>Apellidos</th>
						<th>Email</th>
						<th>DNI</th>
					</tr>
					<tr>
						<td value='$usu->ID_Centro'>$usu->DESC_Centro</td>
						<td value='$usu->ID_TUsuario'>$usu->DESC_TUsuario</td>
						<td value='$usu->User'>$usu->User</td>
						<td value='$usu->Nombre'>$usu->Nombre</td>
						<td value='$usu->Apellidos'>$usu->Apellidos</td>
						<td value='$usu->Email'>$usu->Email</td>
						<td value='$usu->Dni'>$usu->Dni</td>
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

		<!--------------------CENTRO Y TIPOS DE USUARIO-------------------->

		<?php

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

			//SI HAY TIPOS DE USUARIO
			if ($tipos){

				//CREA UN SELECT DE TIPOS DE USUARIO PONIENDO "SELECCIONA TIPO DE USUARIO" COMO VALOR PRINCIPAL
				echo "<div class='divselect'> Tipo Usuario: <select id='select_tipo'>
					  <option>Selecciona tipo de usuario</option>";

				//RELLENA EL SELECT CON TIPOS DE USUARIO
				foreach ($tipos->result() as $tipo) {
					echo "<option value='$tipo->ID_TUsuario'>$tipo->DESC_TUsuario</option>";
				}

				echo "</select> </div>";			
			}

		?>	

		<!--------------------FIN CENTRO Y TIPOS DE USUARIO-------------------->
		
		


		<!-------------------------------------------------->



		<!--------------------SECCIÓN FORMULARIO-------------------->

		
				
			<?php
	    		/*--------------------ARRAY DEL FORMULARIO-------------------*/

				$formularioUsuario = array(
					'name' => 'formularioUsuario'
				);

				/*--------------------FIN ARRAY DEL FORMULARIO-------------------*/


				/*---------------------------------------------------*/

				/*--------------------ARRAY DEL USUARIO-------------------*/

				$User = array(
					'name' => 'User',
					'placeholder' => 'Usuario',
					'value' => $usuario2->result()[0]->User,
					'maxlength' => 15,
					'class' => 'User',
					'size' => 20
				);

				/*--------------------FIN ARRAY DEL USUARIO-------------------*/


				/*---------------------------------------------------*/

				/*--------------------ARRAY DEL NOMBRE-------------------*/

				$Nombre = array(
					'name' => 'Nombre',
					'id' => 'Nombre',
					'placeholder' => 'Nombre',
					'value' => $usuario2->result()[0]->Nombre,
					'maxlength' => 50,
					'class' => 'Nombre',
					'size' => 20
				);

				/*--------------------FIN ARRAY DEL NOMBRE-------------------*/


				/*---------------------------------------------------*/

				/*--------------------ARRAY DE LOS APELLIDOS-------------------*/

				$Apellidos = array(
					'name' => 'Apellidos',
					'id' => 'Apellidos',
					'placeholder' => 'Apellidos',
					'value' => $usuario2->result()[0]->Apellidos,
					'maxlength' => 50,
					'class' => 'Apellidos',
					'size' => 20
				);

				/*--------------------FIN ARRAY DE APELLIDOS-------------------*/


				/*---------------------------------------------------*/

				/*--------------------ARRAY DEL EMAIL-------------------*/

				$Email = array(
					'name' => 'Email',
					'id' => 'Email',
					'placeholder' => 'Email',
					'value' => $usuario2->result()[0]->Email,
					'maxlength' => 50,
					'class' => 'Email',
					'size' => 20
				);

				/*--------------------FIN ARRAY DEL EMAIL-------------------*/


				/*---------------------------------------------------*/

				/*--------------------ARRAY DEL DNI-------------------*/

				$Dni = array(
					'name' => 'Dni',
					'id' => 'Dni',
					'placeholder' => 'DNI',
					'value' => $usuario2->result()[0]->Dni,
					'maxlength' => 9,
					'class' => 'Dni',
					'size' => 20
				);

				/*--------------------FIN ARRAY DEL DNI-------------------*/


				/*---------------------------------------------------*/



				/*--------------------TRAMPA PARA INSERTAR A LA BASE DE DATOS EL CENTRO Y TIPO DE USUARIO SELECCIONADO--------------------*/


				/*--------------------ARRAY DEL CENTRO-------------------*/

				$ID_Centro_Formulario = array(
					'name' => 'ID_Centro_Formulario',
					'placeholder' => 'Centro',
					'maxlength' => 20,
					'class' => 'ID_Centro_Formulario',
					'size' => 20,
					'hidden' => true
				);

				/*--------------------FIN ARRAY DEL CENTRO-------------------*/


				/*---------------------------------------------------*/


				/*--------------------ARRAY DEL TIPO DE USUARIO-------------------*/

				$ID_TUsuario_Formulario = array(
					'name' => 'ID_TUsuario_Formulario',
					'placeholder' => 'Tipo de usuario',
					'maxlength' => 20,
					'class' => 'ID_TUsuario_Formulario',
					'size' => 20,
					'hidden' => true
				);

				/*--------------------FIN ARRAY DEL TIPO DE USUARIO-------------------*/

				/*--------------------FIN TRAMPA PARA INSERTAR A LA BASE DE DATOS EL CENTRO Y TIPO DE USUARIO SELECCIONADO--------------------*/
			?>

			<?php echo form_open('Usuario/guardar_cambios_usuario/'.$usuario2->result()[0]->ID_Usuario,$formularioUsuario);?>
			
			<?php echo form_input($ID_Centro_Formulario); ?>

			<?php echo form_input($ID_TUsuario_Formulario); ?>


			<div class='divselect'>
			<?php echo form_label('Usuario: ','User'); ?>
			<?php echo form_input($User); ?>
			</div>


			<div class='divselect'>
			<?php echo form_label('Nombre: ','Nombre'); ?>
			<?php echo form_input($Nombre); ?>
			</div>


			<div class='divselect'>
			<?php echo form_label('Apellidos: ','Apellidos'); ?>
			<?php echo form_input($Apellidos); ?>
			</div>



			<div class='divselect'>
			<?php echo form_label('Email: ','Email'); ?>
			<?php echo form_input($Email); ?>
			</div>



			<div class='divselect'>
			<?php echo form_label('DNI: ','Dni'); ?>
			<?php echo form_input($Dni); ?>
			</div>


		<!--------------------FIN SECCIÓN FORMULARIO-------------------->		
		


		<!-------------------------------------------------->



		<!--------------------BOTÓN MOSTRAR-------------------->
	
	
		<button id="botonMostrar" class="boton">Mostrar</button>
				</div>

		<!--------------------FIN BOTÓN MOSTRAR-------------------->
		
		


		<!-------------------------------------------------->



		<!--------------------TABLA DATOS NUEVOS-------------------->
	<article class="tablaResponsive">
	<div class="tablaoculta">
		<h1 class="datosact"> Confirme los Datos</h1>
		<table id="tabla_usuarios" class="tabla_usuario_editar">
			<tr>
				<th>Centro</th>
				<th>Tipo de usuario</th>
				<th>Usuario</th>
				<th>Nombre</th>
				<th>Apellidos</th>
				<th>Email</th>
				<th>DNI</th>
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

	<!--------------------FIN BOTÓN <-------------------->


</div>



<!-------------------------------------------------------------------->


<!----------SCRIPT---------->


<script>
	

	/*----------AL CARGAR EL DOCUMENTO----------*/

	$(document).ready(function(){


		//VARIABLES TRAMPA PARA PODER USARLA AL HACER CLICK EN "EDITAR".
		var trampaCentro = false;
		var trampaTipo = false;


		/*----------AL CAMBIAR EL SELECT CENTRO----------*/

		//CUANDO SE CAMBIA EL SELECT CENTRO.
		$("#select_centro").change(function(){

			//SE PONE LA TRAMPA "CENTRO" A "TRUE" PORQUE SE LA MODIFICADO SELECT CENTRO.
			trampaCentro = true;

			//SE PONE LA TRAMPA "TIPO" A FALSE PARA QUE TENGAS QUE VOLVER A SELECCIONARLA.
			trampaTipo = false;

			//RELLENA EL INPUT "ID_CENTRO_FORMULARIO" CON EL CENTRO SELECCIONADO.
			$(".ID_Centro_Formulario").val($("#select_centro").val());

		});

		/*----------FIN AL CAMBIAR EL SELECT CURSO----------*/


		/*--------------------------------------------------*/
		

		/*----------AL CAMBIAR EL SELECT TIPO----------*/

		//CUANDO SE CAMBIA EL SELECT TIPO.
		$("#select_tipo").change(function(){

			//SE PONE LA TRAMPA "TIPO" A "TRUE" PORQUE SE LA MODIFICADO SELECT TIPO.
			trampaTipo = true;

			//RELLENA EL INPUT "ID_TUSUARIO_FORMULARIO" CON EL TIPO DE USUARIO SELECCIONADO.
			$(".ID_TUsuario_Formulario").val($("#select_tipo").val());
			
		});

		/*----------FIN AL CAMBIAR EL SELECT TIPO----------*/


		/*--------------------------------------------------*/


		/*----------AL CLICAR EN EL BOTÓN MOSTRAR----------*/


		//CUANDO SE CLICA EN EL BOTÓN MOSTRAR.
		$("#botonMostrar").click(function(trampa){

			//SI NO PONEMOS ESTO, HACE LA FUNCIÓN QUE HACE EL BOTÓN EDITAR.
			trampa.preventDefault();

    		//SI NO SE HA SELECCIONADO CENTRO.
    		if(trampaCentro == false){

    			//MUESTRA MENSAJE DE ERROR.
    			alert("¡Selecciona un centro!");
    		}


    		//SI NO SE HA SELECCIONADO TIPO DE USUARIO.
    		if(trampaTipo == false){

    			//MUESTRA MENSAJE DE ERROR.
    			alert("¡Selecciona un tipo de usuario!");
    		}


    		//SI SE HAN SELECCIONADO TODOS LOS PARÁMETROS.
    		else{


		    	//VACIA LAS FILAS DE LA TABLA DE USUARIOS.
		    	$(".contenido").remove();


		        $('.tablaoculta').css("display","block");


		        //RELLENA LA TABLA CON LOS DATOS CAMBIADOS.
		        $('#tabla_usuarios').append($('<tr class="contenido"><td id="datosCentro">'+$("#select_centro option:selected").text()+'</td><td id="datosTipoUsuario">'+$("#select_tipo option:selected").text()+'</td><td id="datosUsuario">'+$(".User").val()+'</td><td>'+$(".Nombre").val()+'</td><td>'+$(".Apellidos").val()+'</td><td>'+$(".Email").val()+'</td><td>'+$(".Dni").val()+'</td></tr>'));

	    	}


	    });

		/*----------FIN AL CLICAR EN EL BOTÓN MOSTRAR----------*/


		/*--------------------------------------------------*/


		/*----------AL CLICAR EN EL BOTÓN VOLVER----------*/


		//CUANDO SE CLICA EN EL BOTÓN VOLVER.
		$("#botonVolver").click(function(event){

    		event.preventDefault();
    		
    		//VUELVE A LA PÁGINA PRINCIPAL DE USUARIO.
    		window.location.href = "../../Usuario";
	    });

		/*----------FIN AL CLICAR EN EL BOTÓN VOLVER----------*/


		/*--------------------------------------------------*/


		/*----------AL CLICAR EN EL BOTÓN EDITAR----------*/


		//CUANDO SE CLICA EN EL BOTÓN EDITAR.
		$("#botonEditar").click(function(){

    		//LLAMA A LA FUNCIÓN "GUARDAR_CAMBIOS_USUARIO" UTILIZANDO JSON.
		    $.post({url: "<?php echo base_url(); ?>index.php/Usuario/guardar_cambios_usuario/<?php echo $usuario2->result()[0]->ID_Usuario; ?>",
		    datatype:"json",
	        data:{'ID_Centro':$(".ID_Centro_Formulario").val(), 'ID_TUsuario':$(".ID_TUsuario_Formulario").val(), 'User':$(".User").val(), 'Nombre':$(".Nombre").val(), 'Apellidos':$(".Apellidos").val(), 'Email':$(".Email").val(), 'Dni':$(".Dni").val()},
		    success: function(devuelto){

		    	//MUESTRA MENSAJE DE CONFIRMACIÓN.
		    	alert("¡Cambios guardados correctamente!");

		    	//VUELVE A LA PÁGINA PRINCIPAL DE USUARIO.
    			window.location.href = "../../Usuario";

		    }});

	    });

		/*----------FIN AL CLICAR EN EL BOTÓN EDITAR----------*/


		/*------------------------------*/


		/*----------PATTERNS----------*/


		$("#Nombre").keydown(numeros);
		$("#Apellidos").keydown(numeros);
		$("#Email").blur(email);
		$("#Dni").blur(dni);


		//NÚMEROS
		function numeros(e){

			tecla = e.key;
			patron = /[0-9]/;

			if(patron.test(tecla)){

				alert("¡SÓLO LETRAS!");

				e.preventDefault();
			}
		}


		//EMAIL
		function email(){

			patron = /[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/;

			if(!patron.test($("#Email").val())){

				alert("¡EMAIL INCORRECTO (EJEMPLO: ejemplo@ejemplo.com)!");

			}
		}


		//DNI
		function dni(){

			patron = /[0-9]{8}[A-Z]{1}/i;

			if(!patron.test($("#Dni").val())){

				alert("¡DNI INCORRECTO (EJEMPLO: 77777777A)!");
			}
		}

		/*----------FIN PATTERNS----------*/



	});

	/*----------FIN AL CARGAR EL DOCUMENTO----------*/

</script>


<!----------FIN SCRIPT---------->



