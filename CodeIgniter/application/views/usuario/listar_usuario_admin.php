
<div class='divfiltro'>
<h1>USUARIOS</h1>	

	<!--------------------CENTRO-------------------->

	<?php

		//SI HAY TIPOS DE USUARIOS
		if ($tipos){

			//CREA UN SELECT DE TIPOS DE USUARIOS PONIENDO "SELECCIONA TIPO USUARIO" COMO VALOR PRINCIPAL
			echo "<div class='divselect'> TIPO: 
			<select id='select_tipo'>
				  <option>Selecciona Tipo Usuario</option>";

			//RELLENA EL SELECT CON TIPOS DE USUARIOS
			foreach ($tipos->result() as $tipo) {
				echo "<option value='$tipo->ID_TUsuario'>$tipo->DESC_TUsuario</option>";
			}

			echo "</select> </div>";			
		}

	?>	

	<!--------------------FIN CENTRO-------------------->


	<!-------------------------------------------------->


	<!--------------------BOTÓN MOSTRAR-------------------->
	
	
	<button id="botonMostrar" class="boton">Mostrar</button>
	

	<!--------------------FIN BOTÓN MOSTRAR-------------------->








</div>
<article class="tablaResponsive">
<div class="tablaoculta"> 
<table id="tabla_usuarios" class="tabla_usuarios">
		<tr>
			<th>Tipo Usuario</th>
			<th>Usuario</th>
			<th>Nombre</th>
			<th>Apellidos</th>
			<th>Email</th>
			<th>DNI</th>
			<th>Acciones</th>
		</tr>
	</table>
</div>
</article>


	
	<div class="divbotones">
		<button id="botonAñadirNuevo" class="boton">Añadir nuevo</button>
		<button id="botonVolverPrincipal" class="boton">Volver</button>
	</div>


<!-------------------------------------------------------------------->


<!----------SCRIPT---------->


<script>
	

	/*----------AL CARGAR EL DOCUMENTO----------*/

	$(document).ready(function(){

		//VARIABLE TRAMPA PARA PODER USARLA AL HACER CLICK EN "MOSTRAR".
		var trampaTipo = false;


		/*--------------------------------------------------*/


		/*----------AL CAMBIAR EL SELECT TIPO----------*/

		//CUANDO SE CAMBIA EL SELECT TIPO.
		$("#select_tipo").change(function(){

			//SE PONE LA TRAMPA A "TRUE" PORQUE SE LA MODIFICADO SELECT TIPO.
			trampaTipo = true;	

			//VACIA LAS FILAS DE LA TABLA DE USUARIOS.
	    	$(".contenido").remove();		

		});

		/*----------FIN AL CAMBIAR EL SELECT TIPO----------*/


		/*--------------------------------------------------*/


		/*----------AL CLICAR EN EL BOTÓN MOSTRAR----------*/


		//CUANDO SE CLICA EN EL BOTÓN MOSTRAR.
		$("#botonMostrar").click(function(){

			$('#tablaoculta').css("display","block");


    		//SI NO SE HA SELECCIONADO TIPO.
    		if(trampaTipo == false){

    			//MUESTRA MENSAJE DE ERROR.
    			alert("¡Selecciona un tipo de usuario!");
    		}


    		//SI SE HAN SELECCIONADO TODOS LOS PARÁMETROS.
    		else{

		    	//VACIA LAS FILAS DE LA TABLA DE MODULOS.
		    	$(".contenido").remove();


		    	//LLAMA A LA FUNCIÓN "OBTENER_TUSUARIOS" UTILIZANDO JSON.
		    	$.post({url: "<?php echo base_url(); ?>index.php/Usuario/obtener_usuarios",
		        datatype:"json",
	        	data:{'ID_Centro':$("#select_centro").val(),'ID_TUsuario':$("#select_tipo").val()},
		        success: function(devuelto){
		        $('.tablaoculta').css("display","block");
		        
		        	var array=JSON.parse(devuelto);
		        	for (var i = 0; i < array.length; i++) {

		        	

		        		//VARIABLES QUE CONTIENEN LA RUTA DE BORRAR Y EDITAR.
		        		var url_borrar = "Usuario/borrar_usuario_admin/"+array[i]['ID_Usuario'];
		        		var url_editar = "Usuario/editar_usuario_admin/"+array[i]['ID_Usuario'];


		        		//RELLENA LA TABLA CON LOS USUARIOS.
		            	$('#tabla_usuarios').append($('<tr class="contenido"><td>'+$("#select_tipo option:selected").text()+'</td><td>'+array[i]['User']+'</td><td>'+array[i]['Nombre']+'</td><td>'+array[i]['Apellidos']+'</td><td>'+array[i]['Email']+'</td><td>'+array[i]['Dni']+'</td><td><a href='+url_editar+'><input type="button" value="Editar"></a><a href='+url_borrar+'><input type="button" value="Borrar"></a></td></tr>'));

		        	}
		    

		    	}});
	    	}

	    });

		/*----------FIN AL CLICAR EN EL BOTÓN MOSTRAR----------*/


		/*--------------------------------------------------*/


		/*----------AL CLICAR EN EL BOTÓN AÑADIR NUEVO----------*/

		//CUANDO SE CLICA EN EL BOTÓN AÑADIR NUEVO.
		$("#botonAñadirNuevo").click(function(){

			//REDIRIGE A LA FUNCIÓN DE "USUARIO.PHP" "NUEVO_USUARIO" QUE LLAMA A LA VISTA "NUEVO_USUARIO.PHP".
			window.location.href = "Usuario/nuevo_usuario_admin";

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