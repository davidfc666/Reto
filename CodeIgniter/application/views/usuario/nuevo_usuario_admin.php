<div class="divfiltro">
	
	<h1>Añadir Usuario</h1>

	<!--------------------CURSO-------------------->

	<?php

		//SI HAY TIPOS DE USUARIOS
		if ($tipos){

			//CREA UN SELECT DE TIPOS DE USUARIOS PONIENDO "SELECCIONA TIPO USUARIO" COMO VALOR PRINCIPAL
			echo "<div class='divselect'> Tipo Usuario: ";
			echo "<select id='select_tipo'>;
				  <option>Selecciona Tipo Usuario</option>";

			//RELLENA EL SELECT CON TIPOS DE USUARIOS
			foreach ($tipos->result() as $tipo) {
				echo "<option value='$tipo->ID_TUsuario'>$tipo->DESC_TUsuario</option>";
			}

			echo "</select> </div>";			
		}

	?>	

	<!--------------------FIN CURSO-------------------->
	
	


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
				'maxlength' => 10,
				'size' => 20
			);

			/*--------------------FIN ARRAY DEL USUARIO-------------------*/


			/*---------------------------------------------------*/


			/*--------------------ARRAY DEL NOMBRE-------------------*/

			$Nombre = array(
				'name' => 'Nombre',
				'id' => 'Nombre',
				'placeholder' => 'Nombre',
				'maxlength' => 10,
				'size' => 20
			);

			/*--------------------FIN ARRAY DEL NOMBRE-------------------*/


			/*---------------------------------------------------*/


			/*--------------------ARRAY DE LOS APELLIDOS-------------------*/

			$Apellidos = array(
				'name' => 'Apellidos',
				'id' => 'Apellidos',
				'placeholder' => 'Apellidos',
				'maxlength' => 20,
				'size' => 20
			);

			/*--------------------FIN ARRAY DE LOS APELLIDOS-------------------*/


			/*---------------------------------------------------*/


			/*--------------------ARRAY DEL EMAIL-------------------*/

			$Email = array(
				'name' => 'Email',
				'id' => 'Email',
				'placeholder' => 'Email',
				'maxlength' => 10,
				'size' => 20
			);

			/*--------------------FIN ARRAY DEL EMAIL-------------------*/


			/*---------------------------------------------------*/


			/*--------------------ARRAY DEL DNI-------------------*/

			$Dni = array(
				'name' => 'Dni',
				'id' => 'Dni',
				'placeholder' => 'Dni',
				'maxlength' => 20,
				'size' => 20
			);

			/*--------------------FIN ARRAY DEL DNI-------------------*/


			/*---------------------------------------------------*/



			/*--------------------TRAMPA PARA INSERTAR A LA BASE DE DATOS EL CENTRO Y TIPO DE USUARIO SELECCIONADO--------------------*/


			/*--------------------ARRAY DEL ID DEL CENTRO-------------------*/

			$ID_Centro_Formulario = array(
				'name' => 'ID_Centro_Formulario',
				'class' => 'ID_Centro_Formulario',
				'placeholder' => 'ID del centro',
				'maxlength' => 10,
				'size' => 20,
				'hidden' => true
			);

			/*--------------------FIN ARRAY DEL ID DEL CENTRO-------------------*/


			/*---------------------------------------------------*/


			/*--------------------ARRAY DEL ID DEL TIPO DE USUARIO-------------------*/

			$ID_TUsuario_Formulario = array(
				'name' => 'ID_TUsuario_Formulario',
				'class' => 'ID_TUsuario_Formulario',
				'placeholder' => 'ID del tipo de usuario',
				'maxlength' => 20,
				'size' => 20,
				'hidden' => true
			);

			/*--------------------FIN ARRAY DEL ID DEL TIPO DE USUARIO-------------------*/


			/*--------------------FIN TRAMPA PARA INSERTAR A LA BASE DE DATOS EL CENTRO Y TIPO DE USUARIO SELECCIONADO--------------------*/
		?>

		<?php echo form_open('Usuario/nuevo_usuario_admin',$formularioUsuario);?>

		

		<?php echo "<div class='divselect'>" ?>	
		<?php echo form_label('Usuario: ','User'); ?>
		<?php echo form_input($User); ?>
		<?php echo("</div>"); ?>

		<?php echo "<div class='divselect'>" ?>	
		<?php echo form_label('Nombre: ','Nombre'); ?>
		<?php echo form_input($Nombre); ?>
		<?php echo("</div>"); ?>

		<?php echo "<div class='divselect'>" ?>
		<?php echo form_label('Apellidos: ','Apellidos'); ?>
		<?php echo form_input($Apellidos); ?>
		<?php echo("</div>"); ?>

		<?php echo "<div class='divselect'>" ?>
		<?php echo form_label('Email: ','Email'); ?>
		<?php echo form_input($Email); ?>
		<?php echo("</div>"); ?>

		<?php echo "<div class='divselect'>" ?>
		<?php echo form_label('DNI: ','Dni'); ?>
		<?php echo form_input($Dni); ?>
		<?php echo("</div>"); ?>
		<?php echo("</div>"); ?>
		

		<!--------------------TRAMPA PARA INSERTAR A LA BASE DE DATOS EL CENTRO Y TIPO DE USUARIO SELECCIONADO-------------------->

		<?php echo form_input($ID_Centro_Formulario); ?>

		<?php echo form_input($ID_TUsuario_Formulario); ?>

		<!--------------------FIN TRAMPA PARA INSERTAR A LA BASE DE DATOS EL CENTRO Y TIPO DE USUARIO SELECCIONADO-------------------->
		
		<div class="divbotones">
		<?php echo form_submit('Crear','Crear'); ?>
		<?php echo form_close();?>
		<button id="botonVolver" class="boton">Volver</button>
		</div>

	

	<!--------------------FIN SECCIÓN FORMULARIO-------------------->
	


</div>



<!-------------------------------------------------------------------->


<!----------SCRIPT---------->


<script>
	

	/*----------AL CARGAR EL DOCUMENTO----------*/

	$(document).ready(function(){

		//VARIABLE TRAMPA PARA PODER USARLA AL HACER CLICK EN "MOSTRAR".
		var trampaTipo = false;

	    //RELLENA EL INPUT CENTRO DEL FORMULARIO CON EL VALOR DEL CENTRO QUE SE HAYA SELECCIONADO. 
	    $('.ID_Centro_Formulario').val($("#select_centro").val());


		/*--------------------------------------------------*/


		/*----------AL CAMBIAR EL SELECT TIPO----------*/

		//CUANDO SE CAMBIA EL SELECT TIPO.
		$("#select_tipo").change(function(){

			//SE PONE LA TRAMPA A "TRUE" PORQUE SE LA MODIFICADO SELECT TIPO.
			trampaTipo = true;	


			//RELLENA EL INPUT TIPO DEL FORMULARIO CON EL VALOR DEL TIPO QUE SE HAYA SELECCIONADO. 
	    	$('.ID_TUsuario_Formulario').val($("#select_tipo").val());		

		});

		/*----------FIN AL CAMBIAR EL SELECT TIPO----------*/


		/*--------------------------------------------------*/


		/*----------AL CLICAR EN EL BOTÓN MOSTRAR----------*/


		//CUANDO SE CLICA EN EL BOTÓN MOSTRAR.
		$("#botonMostrar").click(function(){
    		

    		//SI NO SE HA SELECCIONADO TIPO DE USUARIO.
    		if(trampaTipo == false){

    			//MUESTRA MENSAJE DE ERROR.
    			alert("¡Selecciona un tipo de usuario!");
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
    		
    		//VUELVE A LA PÁGINA PRINCIPAL DE USUARIO.
    		url = ("<?php echo base_url() ?>index.php/Usuario/usuario_admin")
    		location.href = url;
	    });

		/*----------FIN AL CLICAR EN EL BOTÓN VOLVER----------*/


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