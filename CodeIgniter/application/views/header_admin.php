<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Administrador</title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/estilo.css" media="only screen and (min-width: 1030px)" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/tablet.css" media="only screen and (min-width: 600px) and (max-width:1029px)" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/movil.css" media="only screen and (max-width: 599px)" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<header>

<nav>
	<ul id="listaLogoAdmin">	
		<a id="logo" href="<?php echo base_url()?>index.php/Login/Admin_Centro"><li><img src="<?php echo base_url(); ?>/imagenes/logo.png" alt="INICIO" title="INICIO"></li></a>
	</ul>				


	<img src="<?php echo base_url(); ?>/imagenes/menumovil.png" id="menutabletAdmin">
	<img src="<?php echo base_url(); ?>/imagenes/menumovil.png" id="menumovilAdmin">

	<ul id="listaheaderAdmin">
	<li id="Ciclo"><a href="<?php echo base_url()?>index.php/Ciclo/ciclo_admin"> Ciclos </a></li>
	<li id="Modulo"><a href="<?php echo base_url()?>index.php/Modulo/modulo_admin"> Modulos </a></li>
	<li id="Reto"><a href="<?php echo base_url()?>index.php/Reto/reto_admin"> Retos </a></li>
	<li id="Equipo"><a href="<?php echo base_url()?>index.php/Equipo/equipo_admin"> Equipos </a></li>
	<li id="Usuario"><a href="<?php echo base_url()?>index.php/Usuario/usuario_admin"> Usuarios </a></li>
	</ul>

	<h1>Hola
	<?php foreach ($usuario->result() as $usu) {echo $usu->User; 	} ?>  
	</h1>
	<button id="cerrar">	
		<img id="btncerrar" src="<?php echo base_url(); ?>/imagenes/btnapagar.png" alt="CERRAR SESIÓN" title="CERRAR SESIÓN">
	</button>
	
	<input type="hidden" value="<?php echo ($centroUsuario->result()[0]->ID_Centro); ?>" id="select_centro">
</nav>

<script>

	$(document).ready(function(){

		var clicado = false;

		document.getElementById("btncerrar").addEventListener("click",function(){
	
			url = "<?php echo base_url() ?>"; 
			location.href=url;
		
		});



		document.getElementById("menutabletAdmin").addEventListener("click", function(){

			if(clicado == false){

				$("#listaheaderAdmin").show("1000");
				$("footer").css("opacity", "0.30");
				$("div").css("opacity", "0.30");
				$("table").css("opacity", "0.30");

				clicado = true;

			}		


			else if(clicado == true){

				$("#listaheaderAdmin").hide("1000");
				$("footer").css("opacity", "1");
				$("div").css("opacity", "1");
				$("table").css("opacity", "1");


				clicado = false;

			}

		});




		document.getElementById("menumovilAdmin").addEventListener("click", function(){

			if(clicado == false){

				$("#listaheaderAdmin").show("1000");
				$("footer").css("opacity", "0.30");
				$("div").css("opacity", "0.30");
				$("table").css("opacity", "0.30");

				clicado = true;

			}		


			else if(clicado == true){

				$("#listaheaderAdmin").hide("1000");
				$("footer").css("opacity", "1");
				$("div").css("opacity", "1");
				$("table").css("opacity", "1");


				clicado = false;

			}

		});


	});

</script>

<?php

if (isset($pagina)){
			
	switch ($pagina) {
				
		case 'Ciclo':
			
			echo "<script>
				$('#Ciclo').css('background','#6f9199');
			</script>";

		break;

		case 'Modulo':
			
			echo "<script>
				$('#Modulo').css('background','#6f9199');
			</script>";

		break;
		
		case 'Reto':
			
			echo "<script>
				$('#Reto').css('background','#6f9199');
			</script>";

		break;
		
		case 'Equipo':
			
			echo "<script>
				$('#Equipo').css('background','#6f9199');
			</script>";

		break;
		
		case 'Usuario':
			
			echo "<script>
				$('#Usuario').css('background','#6f9199');
			</script>";

		break;
	}
}

?>
	

</header>