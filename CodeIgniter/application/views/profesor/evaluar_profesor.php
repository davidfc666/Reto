<div class="divfiltro">
	<h1>Evaluación </h1>

		<?php
			$form = array(
			'name' => 'form_centro'
		);
		?>
		<div class='divselect'>
		<?php echo form_label('Grupo: ','ID_Grupo'); ?>
		<?php
			echo "<select id='select_equipo'>";
			if ($equipos){
				echo "<option value='0'>Selecciona Equipo</option>";
				foreach ($equipos->result() as $equipo) {
					echo "<option value='$equipo->ID_Equipo'>$equipo->COD_Equipo</option>";
				}		
			}else{
				echo "<option value='0'>Sin equipos</option>";
			}
			echo "</select>";	
			?>
		</div>
		<input id ="Buscar" type="submit" name="Buscar" value="Buscar">
</div>


		<table id="tabla_grupo">

		</table>
<script>
	$(document).ready(function(){
		//GENERADOR TABLA
		document.getElementById("Buscar").addEventListener("click", function(){
			$('#tabla_grupo').empty();
			$(".contenido").remove();
			$('#tabla_grupo').append($('<tr><th>GRUPO</th><th>ALUMNO</th><th>ACCIONES</th></tr>'));

			$.post({url: "<?php echo base_url(); ?>index.php/Equipo/equipo_usuarios_json",
			datatype:"json",
			data:{
				'ID_Equipo':$("#select_equipo").val(), 
			},
			success: function(devuelto){
				var array=JSON.parse(devuelto);
				for(var i = 0; i < array.length; i++){
	        		$('#tabla_grupo').append($('<tr class="contenido">					<td>'+array[i]['DESC_Equipo']+'</td>							<td>'+array[i]['User']+'</td>									<td><input onclick="location.href=\'<?php echo base_url(); ?>index.php/Profesor/evaluserindi/'+array[i]['ID_Usuario']+'\'" type="button" value="EVALUAR" name="'+array[i]['ID_Reto']+'"></td></tr>'));
	        	}
			}});

		});
	});
</script>