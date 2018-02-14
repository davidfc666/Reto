<?php 

echo ("<div class='divfiltro'>");
echo("<h1>RETOS</h1>");		
if ($cursos){

			//CREA UN SELECT DE CURSOS PONIENDO "SELECCIONA CURSO" COMO VALOR PRINCIPAL
			echo "<div class='divselect'> CURSO: <select id='select_curso'>
				  <option>Selecciona curso</option>";

			//RELLENA EL SELECT CON CURSOS
			foreach ($cursos->result() as $curso) {
				echo "<option value='$curso->ID_Curso'>$curso->COD_Curso</option>";
			}

			echo "</select> </div>";			
		}
		 ?>

		<div class='divselect'> CICLO: <select id="select_ciclo">

		<option value="0">Selecciona Ciclo</option>

	</select> </div>

 <button id="botonMostrar" class="boton">Mostrar</button> 
</div>


<?php

echo ('<div class="tablaoculta">

<table id="tabla_retos">

	<tr>
		<th>Curso</th>
		<th>Ciclo</th>
		<th>Reto</th>
		<th>Acciones</th>
	</tr>');

echo('</table> </div>');

 ?>
</div>

<script>

$(document).ready(function(){


			$('#tabla_retos').on('click','button',function (){
			url = "<?php echo base_url()?>index.php/Alumno/evaluar/"+($(this).attr("id")); 
			location.href=url;


		});





	


	//VARIABLES TRAMPA PARA PODER USARLA AL HACER CLICK EN "MOSTRAR".
	var trampaCurso = false;
	var trampaCiclo = false;

	/*----------AL CAMBIAR EL SELECT CURSO----------*/

		//CUANDO SE CAMBIA EL SELECT CURSO.
		$("#select_curso").change(function(){


			//SE PONE LA TRAMPA "CURSO" A "TRUE" PORQUE SE LA MODIFICADO SELECT CURSO.
			trampaCurso = true;

			//SE PONEN LAS TRAMPAS "CICLO" A FALSE PARA QUE TENGAS QUE VOLVER A SELECCIONARLAS.
		 	trampaCiclo = false;

			//EL SELECT CICLO SE VACIA.
	    	$("#select_ciclo").empty();


	    	//VACIA LAS FILAS DE LA TABLA DE RETOS.
	    	$(".contenido").remove();


	    	//PONE COMO VALOR INICIAL EN EL SELECT CICLO "SELECCIONA CENTRO".
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


		//CUANDO SE CAMBIA EL SELECT CICLO.
		$("#select_ciclo").change(function(){

			//SE PONE LA TRAMPA A "TRUE" PORQUE SE LA MODIFICADO SELECT CICLO.
			trampaCiclo = true;

		});


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


    		//SI SE HAN SELECCIONADO TODOS LOS PARÁMETROS.
    		else{
			

		    	//VACIA LAS FILAS DE LA TABLA DE MODULOS.
		    	$(".contenido").remove();


		    	//LLAMA A LA FUNCIÓN "OBTENER_MODULOS¡" UTILIZANDO JSON QUE RELLENARÁ EL SELECT CICLO.

		    	$.post({url: "<?php echo base_url(); ?>index.php/Reto/obtener_retos_ajax",
		        datatype:"json",
		        data:{'ID_Curso':$("#select_curso").val(),
		    		  'ID_Ciclo':$("#select_ciclo").val()},
		        success: function(devuelto){
		        $('.tablaoculta').css("display","block");

		        	var array=JSON.parse(devuelto);
		        	for (var i = 0; i < array.length; i++) {


		        		//RELLENA LA TABLA CON LOS MÓDULOS.
		            	$('#tabla_retos').append($('<tr class="contenido"><td>'+array[i]['COD_Curso']+'</td><td>'+array[i]['COD_Ciclo']+'</td><td>'+array[i]['COD_Reto']+'</td><td><button id="'+array[i]['ID_Reto']+'"> Evaluar </button></td></tr>'));

		        	}
		    

		    	}});
	    	}

	    });

		/*----------FIN AL CLICAR EN EL BOTÓN MOSTRAR----------*/


		/*--------------------------------------------------*/




		});

	

</script>

