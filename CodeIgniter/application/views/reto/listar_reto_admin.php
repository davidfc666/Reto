<div>
	

	<!--------------------RETO-------------------->

	<?php

		//SI HAY RETOS
		if ($retos){

			//CREA UNA TABLA DE RETOS
			echo "<table id='tabla_retos' class='tabla_retos'>
				  	<tr>
				  		<th>Reto</th>
				  		<th>Descripción del reto</th>
				  		<th>Acciones</th>
				  	</tr>";

			//RELLENA LA TABLA CON RETOS
			foreach ($retos->result() as $reto) {
				echo "<tr>
						<td value='$reto->ID_Reto'>$reto->COD_Reto</td>
						<td value='$reto->DESC_Reto'>$reto->DESC_Reto</td>
						<td>
							<a href='Reto/editar_reto_admin/$reto->ID_Reto'><input type='button' value='Editar'></a>
							<a href='Reto/borrar_reto_admin/$reto->ID_Reto'><input type='button' value='Borrar'></a>
						</td>
					</tr>";
			}

			echo "</table>";			
		}

	?>	

	<!--------------------FIN RETO-------------------->
	
	


	
	
	<div class="divbotones">
		<button id="botonAñadirNuevo" class="boton">Añadir nuevo</button>
		<button id="botonVolverPrincipal" class="boton">Volver</button>
	</div>




</div>



<!-------------------------------------------------------------------->


<!----------SCRIPT---------->


<script>
	

	/*----------AL CARGAR EL DOCUMENTO----------*/

	$(document).ready(function(){		



		/*----------AL CLICAR EN EL BOTÓN AÑADIR NUEVO----------*/

		//CUANDO SE CLICA EN EL BOTÓN AÑADIR NUEVO.
		$("#botonAñadirNuevo").click(function(){

			//REDIRIGE A LA FUNCIÓN DE "CENTRO.PHP" "NUEVO_CENTRO" QUE LLAMA A LA VISTA "NUEVO_CENTRO.PHP".
			window.location.href = "Reto/nuevo_reto_admin";

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