<div>
	
	<h1 class="datosact">CURSOS</h1>

	<article class="tablaResponsive">
	<!--------------------CURSO-------------------->

	<?php

		//SI HAY CURSOS
		if ($cursos){

			//CREA UNA TABLA DE CURSOS
			echo "<table class='tabla_cursos'>
				  	<tr>
				  		<th>Curso</th>
				  		<th>Acciones</th>
				  	</tr>";

			//RELLENA LA TABLA CON CURSOS
			foreach ($cursos->result() as $curso) {
				echo "<tr>
						<td value='$curso->ID_Curso'>$curso->COD_Curso</td>
						<td>
							<a href='Curso/editar_curso/$curso->ID_Curso'><input type='button' value='Editar'></a>
							<a href='Curso/borrar_curso/$curso->ID_Curso'><input type='button' value='Borrar'></a>
						</td>
					</tr>";
			}

			echo "</table>";			
		}

	?>	
</article>
	<!--------------------FIN CURSO-------------------->
	
	
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

			//REDIRIGE A LA FUNCIÓN DE "CURSO.PHP" "NUEVO_CURSO" QUE LLAMA A LA VISTA "NUEVO_CURSO.PHP".
			window.location.href = "Curso/nuevo_curso";

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