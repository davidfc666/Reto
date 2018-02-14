<?php
		if ($miembros){

echo ('<div id="tablaalumnos">
<br><br><br><br>

<table class="tabla_alumno">

	<tr>
		<th>Alumno</th>
		<th>Equipo</th>
		<th>Rol</th>
		<th>Reto</th>
		<th>Acciones</th>
	</tr>');
		foreach ($miembros->result() as $miembro) {

        echo('	<tr>
		<td>'.$miembro->User.'</td>
		<td>'.$id_equipo->result()[0]->DESC_Equipo.'</td>
		<td>'.$miembro->COD_Rol.'</td>
		<td>'.$reto->result()[0]->COD_Reto.'</td>
		<td><button id="'.$miembro->ID_Usuario.'"> Evaluar </button></td>
		</tr>');
    } 


		echo('</table> </div>



			');
	

		echo "<div class='divbotones'> <button class='boton' id='boletin'> Boletín </button> </div>";

		}
		else{
				printf('No hay Miembros');
		}
		
		

 ?>


<script>

$(document).ready(function(){

			

			$('.tabla_alumno').on('click','button',function (){

	
			url = "<?php echo base_url(); ?>index.php/Alumno/evaluserindi/"+$(this).attr("id")+"/<?php echo $reto->result()[0]->ID_Reto ?>";
			location.href=url;


		});



		document.getElementById("boletin").addEventListener("click", function(){

    		url = "<?php echo base_url(); ?>index.php/Alumno/generar";
			location.href=url;
		});





		});

	

</script>

