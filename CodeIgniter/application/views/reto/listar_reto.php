
<div class='divfiltro'>
<h1>RETOS</h1>	

	<!--------------------CENTRO-------------------->

	<?php

		//SI HAY CENTROS
		if ($centros){

			//CREA UN SELECT DE CENTROS PONIENDO "SELECCIONA CENTRO" COMO VALOR PRINCIPAL
			echo "<div class='divselect'> CENTRO: <select id='select_centro'>
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


	<!--------------------BOTÓN MOSTRAR-------------------->
	
	
	<button id="botonMostrar" class="boton">Mostrar</button>
	</div>

	<!--------------------FIN BOTÓN MOSTRAR-------------------->


	<!-------------------------------------------------->


	<!--------------------TABLA RETOS-------------------->
 
<div class="tablaoculta"> 
	<table id="tabla_retos" class="tabla_retos">
		<tr>
			<th>Centro</th>
			<th>Reto</th>
			<th>Descripción del reto</th>
			<th>Acciones</th>
		</tr>
	</table>
</div>


	<!--------------------FIN TABLA RETOS-------------------->
	
	


	<!-------------------------------------------------->


	<!--------------------BOTÓN AÑADIR NUEVO-------------------->
	
	
	<div class="divbotones">
		<button id="botonAñadirNuevo" class="boton">Añadir nuevo</button>
		<button id="botonVolverPrincipal" class="boton">Volver</button>
	</div>
	

	<!--------------------FIN BOTÓN AÑADIR NUEVO-------------------->






<!-------------------------------------------------------------------->


<!----------SCRIPT---------->


<script>
	

	/*----------AL CARGAR EL DOCUMENTO----------*/

	$(document).ready(function(){

		//VARIABLE TRAMPA PARA PODER USARLA AL HACER CLICK EN "MOSTRAR".
		var trampaCentro = false;


		/*----------AL CAMBIAR EL SELECT CENTRO----------*/

		//CUANDO SE CAMBIA EL SELECT CENTRO.
		$("#select_centro").change(function(){

			//SE PONE LA TRAMPA "CENTRO" A "TRUE" PORQUE SE LA MODIFICADO SELECT CENTRO.
			trampaCentro = true;
		});

		/*----------FIN AL CAMBIAR EL SELECT CENTRO----------*/


		/*--------------------------------------------------*/


		/*----------AL CLICAR EN EL BOTÓN MOSTRAR----------*/


		//CUANDO SE CLICA EN EL BOTÓN MOSTRAR.
		$("#botonMostrar").click(function(){


    		//SI NO SE HA SELECCIONADO CENTRO.
    		if(trampaCentro == false){

    			//MUESTRA MENSAJE DE ERROR.
    			alert("¡Selecciona un centro!");
    		}


    		//SI SE HAN SELECCIONADO TODOS LOS PARÁMETROS.
    		else{
			

		    	//VACIA LAS FILAS DE LA TABLA DE MODULOS.
		    	$(".contenido").remove();


		    	//LLAMA A LA FUNCIÓN "OBTENER_RETOS" UTILIZANDO JSON.
		    	$.post({url: "<?php echo base_url(); ?>index.php/Reto/obtener_retos",
		        datatype:"json",
		        data:{'ID_Centro':$("#select_centro").val()},
		        success: function(devuelto){
		        $('.tablaoculta').css("display","block");

		        	var array=JSON.parse(devuelto);
		        	for (var i = 0; i < array.length; i++) {


		        		//VARIABLES QUE CONTIENEN LA RUTA DE BORRAR Y EDITAR.
		        		var url_borrar = "Reto/borrar_reto/"+array[i]['ID_Reto'];
		        		var url_editar = "Reto/editar_reto/"+array[i]['ID_Reto'];


		        		//RELLENA LA TABLA CON LOS RETOS.
		            	$('#tabla_retos').append($('<tr class="contenido"><td>'+$("#select_centro option:selected").text()+'</td><td>'+array[i]['COD_Reto']+'</td><td>'+array[i]['DESC_Reto']+'</td><td><a href='+url_editar+'><input type="button" value="Editar"></a><a href='+url_borrar+'><input type="button" value="Borrar"></a></td></tr>'));

		        	}
		    

		    	}});
	    	}

	    });

		/*----------FIN AL CLICAR EN EL BOTÓN MOSTRAR----------*/


		/*--------------------------------------------------*/


		/*----------AL CLICAR EN EL BOTÓN AÑADIR NUEVO----------*/

		//CUANDO SE CLICA EN EL BOTÓN AÑADIR NUEVO.
		$("#botonAñadirNuevo").click(function(){

			//REDIRIGE A LA FUNCIÓN DE "RETO.PHP" "NUEVO_RETO" QUE LLAMA A LA VISTA "NUEVO_RETO.PHP".
			window.location.href = "Reto/nuevo_reto";

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