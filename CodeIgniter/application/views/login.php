<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php
$form = array(
	'name' => 'form_login'
);
$User = array(
	'id' => 'userlogin',
	'name' => 'User',
	'placeholder' => 'Usuario',
	'maxlength' => 15,
	'size' => 20
);
$Password = array(
	'id' => 'passlogin',
	'name' => 'Password',
	'type' => 'password',
	'placeholder' => 'Contraseña',
	'maxlength' => 50,
	'size' => 20
);
$Conectar = array(
	'id' => 'Conectar',
	'name' => 'Conectar',
	'value' => 'Conectar',
	'type' => 'submit',
	'size' => 20
);
?>
<audio id="audio" src="<?php echo base_url(); ?>sonidos/buttonClick.ogg"></audio>
	
<div class="divfiltro">
	<h1>Iniciar Sesión</h1>

	<?php echo form_open(base_url().'index.php/Login/conexion_usuario/',$form);?>
		<div class='divselect'>
			<?php echo form_label('Usuario: ','User'); ?>
			<?php echo form_input($User); ?>
		</div>
		<div class='divselect'>
			<?php echo form_label('Contraseña: ','Password'); ?>
			<?php echo form_input($Password); ?>
		</div>
		<?php echo form_submit($Conectar); ?>
	<?php echo form_close();?>
</div>
<script>
	$(document).ready(function() {
    	$("#Conectar").click(function(){
        	var audio = document.getElementById("audio");
        	audio.play();
    	}); 
	});
</script>