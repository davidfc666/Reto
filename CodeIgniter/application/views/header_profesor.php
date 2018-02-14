<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Profesor</title>
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
	
	<ul id="listaLogoProfesor">
		<a id="logo" href="<?php echo base_url()?>index.php/Login/Profesor"><li><img src="<?php echo base_url(); ?>/imagenes/logo.png" alt="INICIO" title="INICIO"></li></a>
	</ul>				


	<img src="<?php echo base_url(); ?>/imagenes/menumovil.png" id="menutabletProfesor">
	<img src="<?php echo base_url(); ?>/imagenes/menumovil.png" id="menumovilProfesor">

	<ul id="listaheaderProfesor">
	<li id="Reto"><a href="<?php echo base_url()?>index.php/Profesor"> Retos </a></li>
	<li id="Rubrica"><a href="<?php echo base_url()?>index.php/Rubrica/consultar_rubricas_profesor"> Rubricas </a></li>
	</ul>

	<h1>Hola
	<?php foreach ($profesor->result() as $usu) {echo $usu->User; 	} ?>  
	</h1>
	<button id="cerrar">	
		<img id="btncerrar" src="<?php echo base_url(); ?>/imagenes/btnapagar.png" alt="CERRAR SESIÓN" title="CERRAR SESIÓN">
	</button>
	<input type="hidden" value="<?php echo ($centro->result()[0]->ID_Centro); ?>" id="select_centro">
	
</nav>

<script>

	$(document).ready(function(){

		var clicado = false;

		document.getElementById("btncerrar").addEventListener("click",function(){
	
			url = "<?php echo base_url() ?>"; 
			location.href=url;
		
		});



		document.getElementById("menutabletProfesor").addEventListener("click", function(){

			if(clicado == false){

				$("#listaheaderProfesor").show("1000");
				$("footer").css("opacity", "0.30");
				$("div").css("opacity", "0.30");
				$("table").css("opacity", "0.30");

				clicado = true;

			}		


			else if(clicado == true){

				$("#listaheaderProfesor").hide("1000");
				$("footer").css("opacity", "1");
				$("div").css("opacity", "1");
				$("table").css("opacity", "1");


				clicado = false;

			}

		});




		document.getElementById("menumovilProfesor").addEventListener("click", function(){

			if(clicado == false){

				$("#listaheaderProfesor").show("1000");
				$("footer").css("opacity", "0.30");
				$("div").css("opacity", "0.30");
				$("table").css("opacity", "0.30");

				clicado = true;

			}		


			else if(clicado == true){

				$("#listaheaderProfesor").hide("1000");
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
				
				
		case 'Reto':
			
			echo "<script>
				$('#Reto').css('background','#6f9199');
			</script>";

		break;
		
		case 'Rubrica':
			
			echo "<script>
				$('#Rubrica').css('background','#6f9199');
			</script>";

		break;
		
	}
}

?>

	

</header>