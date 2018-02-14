<?php 
$form = array(
	'name' => 'form_centro'
);
?>

	<h1 class="datosact">Evaluando a <?php foreach ($alumno->result() as $a) { echo $a->User;} ?></h1>

	<div>
		
		<table id="tabla_evaluar">
			<tr>
				<th  id="columnagrande">A VALORAR</th>
				<th>PUNTUACIÓN</th>
			</tr>
			<?php 
			if($competencias){
				foreach ($competencias->result() as $compe) {
					echo "<tr>
						<td class='descripcion'>$compe->DESC_Competencia</td>
						<td><select id='select_competencia$compe->ID_Competencia'>";
						?>
						<option value="<?php echo $compe->ID_Competencia ?>-25">Mal</option>
						<option value="<?php echo $compe->ID_Competencia ?>-50">Regular</option>
						<option value="<?php echo $compe->ID_Competencia ?>-75">Bueno</option>
						<option value="<?php echo $compe->ID_Competencia ?>-100">Excelente</option>
						<?php
						echo "</select>";
				}
			}
			?>
		</table>
		<div class="divbotones">


			<button class="boton" id ="Enviar" >ENVIAR </button>

			<button class="boton" id ="Restablecer" >RESTABLECER </button>
			
			<button class="boton" id ="Volver" >VOLVER </button>
		</div>
		
	</div>

<script>
	$(document).ready(function(){

		document.getElementById("Restablecer").addEventListener("click",function(){

			location.reload();


		});

		document.getElementById("Volver").addEventListener("click",function(){

			url = "<?php echo base_url() ?>index.php/Profesor/evaluar/<?php echo $this->session->userdata('idreto') ?>"; 
			location.href=url;

		});

		document.getElementById("Enviar").addEventListener("click",function(){
			
			for(var i=1; i < 10; i++){
				var select1 = $("#select_competencia"+i).val().split("-");
				
				$.post({url: "<?php echo base_url(); ?>index.php/Profesor/agregar_evaluacion",
				datatype:"json",
				data:{
					'ID_Competencia':select1[0],
					'Nota':select1[1],
					'ID_User':<?php foreach ($alumno->result() as $a) { echo $a->ID_Usuario;} ?>,
				}});
			}

			alert("Notas añadidas!");
			url = "<?php echo base_url(); ?>index.php/Profesor/evaluar/"+<?php echo $this->session->userdata('idreto'); ?>; 
			location.href=url;

		});
	});
</script>