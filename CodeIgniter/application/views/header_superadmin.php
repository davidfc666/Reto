 <html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Super Administrador</title>
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
	
	<ul id="listaLogoSuperAdmin">
		<a id="logo" href="<?php echo base_url()?>index.php/Login/Administrador"><li><img src="<?php echo base_url(); ?>/imagenes/logo.png" alt="INICIO" title="INICIO"></li></a>
	</ul>				


	<img src="<?php echo base_url(); ?>/imagenes/menumovil.png" id="menutablet">
	<img src="<?php echo base_url(); ?>/imagenes/menumovil.png" id="menumovil">

	<ul id="listaheaderSuperAdmin">
	<li id="Centro"><a href="<?php echo base_url()?>index.php/Centro"> Centros </a></li>
	<li id="Curso"><a href="<?php echo base_url()?>index.php/Curso"> Cursos </a></li>
	<li id="Ciclo"><a href="<?php echo base_url()?>index.php/Ciclo"> Ciclos </a></li>
	<li id="Modulo"><a href="<?php echo base_url()?>index.php/Modulo"> Modulos </a></li>
	<li id="Reto"><a href="<?php echo base_url()?>index.php/Reto"> Retos </a></li>
	<li id="Equipo"><a href="<?php echo base_url()?>index.php/Equipo"> Equipos </a></li>
	<li id="Usuario"><a href="<?php echo base_url()?>index.php/Usuario"> Usuarios </a></li>
	</ul>

	<h1>Hola
	<?php foreach ($usuario->result() as $usu) {echo $usu->User; 	} ?>  
	</h1>
	<button id="cerrar">	
		<img id="btncerrar" src="<?php echo base_url(); ?>/imagenes/btnapagar.png" alt="CERRAR SESIÓN" title="CERRAR SESIÓN">
	</button>
	
</nav>

<script>

	$(document).ready(function(){

		var clicado = false;

		document.getElementById("btncerrar").addEventListener("click",function(){
	
			url = "<?php echo base_url() ?>"; 
			location.href=url;
		
		});



		document.getElementById("menutablet").addEventListener("click", function(){

			if(clicado == false){

				$("#listaheaderSuperAdmin").show("1000");
				$("footer").css("opacity", "0.30");
				$("div").css("opacity", "0.30");
				$("table").css("opacity", "0.30");

				clicado = true;

			}		


			else if(clicado == true){

				$("#listaheaderSuperAdmin").hide("1000");
				$("footer").css("opacity", "1");
				$("div").css("opacity", "1");
				$("table").css("opacity", "1");


				clicado = false;

			}

		});




		document.getElementById("menumovil").addEventListener("click", function(){

			if(clicado == false){

				$("#listaheaderSuperAdmin").show("1000");
				$("footer").css("opacity", "0.30");
				$("div").css("opacity", "0.30");
				$("table").css("opacity", "0.30");

				clicado = true;

			}		


			else if(clicado == true){

				$("#listaheaderSuperAdmin").hide("1000");
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

		case 'Centro':
			
			echo "<script>
				$('#Centro').css('background','#6f9199');
			</script>";

		break;
		
		case 'Curso':
			
			echo "<script>
				$('#Curso').css('background','#6f9199');
			</script>";

		break;
		
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