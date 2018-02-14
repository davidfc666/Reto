<div id="proferubrica">
	<h1>Rubricas</h1>
	<?php 
	$form = array(
		'name' => 'form'
	);
	?>
	<div id="profetablarubri">
		<!--<?php echo form_open('Curso/actualizar/',$form);?>-->
		<div>
			<?php echo form_label('Curso: ','Curso'); ?>
			<?php
			if ($cursos){
				echo "<select id='select_curso'>";
				echo "<option value='0'>Selecciona Curso</option>";
				foreach ($cursos->result() as $curso) {
					echo "<option value='$curso->ID_Curso'>$curso->COD_Curso</option>";
				}
				echo "</select>";			
			}
			?>
		</div>
		<div>
			<?php echo form_label('Ciclo: ','Ciclo'); ?>
			<select name="" id="select_ciclo">
				<option value="">Selecciona Ciclo</option>
			</select>
		</div>
		<div>
			<?php echo form_label('Modulo: ','Modulo'); ?>
			<select name="" id="select_modulo">
				<option value="">Selecciona Modulo</option>
			</select>
		</div>
		<div>
			<?php echo form_label('Reto: ','Reto'); ?>
			<select name="" id="select_reto">
				<option value="">Selecciona Reto</option>
			</select>
		</div>
		<input id ="Buscar" type="submit" name="Buscar" value="Buscar">
		<!--<?php echo form_close();?>-->
	</div>
	<div>
		<table id="tabla_retos" border="1">

		</table>
	</div>
</div>

<script>
	$(document).ready(function(){
		//Controlador CURSO
		$('#select_curso').change(function(){
			$('#select_ciclo').empty();
			$(".contenido").remove();
			$('#select_modulo').empty();
			$(".contenido").remove();
			$('#select_reto').empty();
			$(".contenido").remove();
			
			$('#select_ciclo').append($('<option>Selecciona Ciclo</option>'));
			$('#select_modulo').append($('<option>Selecciona Modulo</option>'));
			$('#select_reto').append($('<option>Selecciona Reto</option>'));

			$.post({url: "<?php echo base_url(); ?>index.php/Modulo/ciclos_user_json",
	        datatype:"json",
	        data:{
	        	'ID_Curso':$("#select_curso").val(), 
	        	'ID_Usuario':"<?php echo $id = $this->session->userdata('id'); ?>"
	        },
	        success: function(devuelto){

		        var array=JSON.parse(devuelto);
		        for (var i = 0; i < array.length; i++) {
		            $('#select_ciclo').append($('<option>', {
		                value: array[i]['ID_Ciclo'],
		                text: array[i]['DESC_Ciclo']
		            }));
		        }
	    	}});
		});
		//Controlador CICLO
		$('#select_ciclo').change(function(){
			$('#select_modulo').empty();
			$(".contenido").remove();
			$('#select_reto').empty();
			$(".contenido").remove();

			$('#select_modulo').append($('<option>Selecciona Modulo</option>'));
			$('#select_reto').append($('<option>Selecciona Reto</option>'));

			$.post({url: "<?php echo base_url(); ?>index.php/Modulo/modulos_json",
	        datatype:"json",
	        data:{
	        	'ID_Ciclo':$("#select_ciclo").val()
	        },
	        success: function(devuelto){

		        var array=JSON.parse(devuelto);
		        for (var i = 0; i < array.length; i++) {
		            $('#select_modulo').append($('<option>', {
		                value: array[i]['ID_Modulo'],
		                text: array[i]['DESC_Modulo']
		            }));
		        }
	    	}});
		});
		//Controlador MODULO
		$('#select_modulo').change(function(){
			$('#select_reto').empty();
			$(".contenido").remove();

			$('#select_reto').append($('<option>Selecciona Reto</option>'));

			$.post({url: "<?php echo base_url(); ?>index.php/Reto/retos_json",
			datatype:"json",
			data:{
				'ID_Modulo':$("#select_modulo").val()
			},
			success: function(devuelto){
				var array=JSON.parse(devuelto);
				for (var i = 0; i < array.length; i++) {
					$('#select_reto').append($('<option>', {
						value: array[i]['ID_Reto'],
						text: array[i]['COD_Reto']
					}));
				}
			}});
		});
		//GENERADOR TABLA
		document.getElementById("Buscar").addEventListener("click", function(){
			$('#tabla_retos').empty();
			$(".contenido").remove();
			$('#tabla_retos').append($('<tr><td>CURSO</td><td>CICLO</td><td>MODULO</td><td>RETO</td><td>RUBRICA</td></tr>'));
			$.post({url: "<?php echo base_url(); ?>index.php/...",
			datatype:"json",
			data:{

			},
			success: function(devuelto){
				var array=JSON.parse(devuelto);
				for(var i = 0; i < array.length; i++){
					$('#tabla_retos').append($());
				}
			}
			});
		});

		document.getElementById("Buscar").addEventListener("click", function(){
			

			$.post({url: "<?php echo base_url(); ?>index.php/Reto/inforetos_json",
			datatype:"json",
			data:{
				'ID_Curso':$("#select_curso").val(),
	        	'ID_Ciclo':$("#select_ciclo").val(),
	        	'ID_Modulo':$("#select_modulo").val()
			},
			success: function(devuelto){
				var array=JSON.parse(devuelto);
				for(var i = 0; i < array.length; i++){
	        		$('#tabla_retos').append($('<tr class="contenido">						<td>'+array[i]['COD_Curso']+'</td>								<td>'+array[i]['COD_Ciclo']+'</td>								<td>'+array[i]['COD_Modulo']+'</td>								<td>'+array[i]['COD_Reto']+'</td>								<td><input onclick="location.href=\'<?php echo base_url(); ?>index.php/Profesor/evaluar/'+array[i]['ID_Reto']+'\'" type="button" value="EVALUAR" name="'+array[i]['ID_Reto']+'"></td></tr>'));
	        	}
			}});

		});

	});
</script>