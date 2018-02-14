<div>

	<h1 class="datosact">TIPOS DE USUARIO</h1>
<article class="tablaResponsive">
	<!--------------------TIPO DE USUARIO-------------------->

	<?php

		//SI HAY TIPOS DE USUARIOS
		if ($tipos){

			//CREA UNA TABLA DE TIPOS DE USUARIOS
			echo "<table id='tabla_tipos' class='tabla_tipos'>
				  	<tr>
				  		<th>Tipo de usuario</th>
				  		<th>Acciones</th>
				  	</tr>";

			//RELLENA LA TABLA CON TIPOS DE USUARIOS
			foreach ($tipos->result() as $tipo) {
				echo "<tr>
						<td value='$tipo->ID_TUsuario'>$tipo->DESC_TUsuario</td>
						<td>
							<a href='TUsuario/editar_tusuario/$tipo->ID_TUsuario'><input type='button' value='Editar'></a>
							<a href='TUsuario/borrar_tusuario/$tipo->ID_TUsuario'><input type='button' value='Borrar'></a>
						</td>
					</tr>";
			}

			echo "</table>";			
		}

	?>	
</article>
	<!--------------------FIN TIPO DE USUARIO-------------------->
	
	

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



		/*----------AL CLICAR EN EL BOTÓN AÑADIR NUEVO----------*/

		//CUANDO SE CLICA EN EL BOTÓN AÑADIR NUEVO.
		$("#botonAñadirNuevo").click(function(){

			//REDIRIGE A LA FUNCIÓN DE "TUSUARIO.PHP" "NUEVO_TUSUARIO" QUE LLAMA A LA VISTA "NUEVO_TUSUARIO.PHP".
			window.location.href = "TUsuario/nuevo_tusuario";

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
