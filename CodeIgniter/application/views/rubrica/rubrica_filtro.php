<?php 

		if ($rubricas){
echo ("<div class='divfiltro'>");
echo("<h1>RUBRICAS</h1> ");
   echo('<div class="divselect"> MEDICION:  <select name="COD_Medicion_select">');
		foreach ($rubricas->result() as $rubrica) {

        echo("<option value=".$rubrica->COD_Medicion.">".$rubrica->COD_Medicion."</option>" );
    } 
    echo('</select> </div>');
	   echo('<div class="divselect">GRUPO COMPETENCIA:  <select name="DESC_Grupo_Competencia_select">');
		foreach ($rubricas->result() as $rubrica) {

        echo("<option value=".$rubrica->DESC_Grupo_Competencia.">".$rubrica->DESC_Grupo_Competencia."</option>" );
    }	
    echo('</select> </div>');
    echo('  <button id="botonMostrar">Mostrar</button> </div>');

		} 
		else{
				printf('No hay Retos');
		}
		 ?>


<article class="tablaResponsive">
<?php
		if ($rubricas){

echo ('<div id="tablaretos">

<table id="tablarubricas">

	<tr>
		<th>Competencia</th>
		<th>Mal</th>
		<th>Regular</th>
		<th>Bien</th>
		<th>Excelente</th>
	</tr>');
		foreach ($rubricas->result() as $rubrica) {

        echo('	<tr>
		<td>'.$rubrica->DESC_Competencia.'</td>
		<td>'.$rubrica->Mal.'</td>
		<td>'.$rubrica->Regular.'</td>
		<td>'.$rubrica->Bien.'</td>
		<td>'.$rubrica->Excelente.'</td>
		</tr>');
    } 


echo('</table> </div>');
		}
		else{
				printf('No hay Retos');
		}
		

 ?>
</article>

 <script>

	document.getElementById("mostrar").addEventListener("click", mostrarRetos);

	function mostrarRetos(){
		document.getElementById("tablaretos").style.display = "block";
	}


		$('#tablaeval').on('click','button',function (){
			url = "evaluar/"+($(this).attr("id")); 
			location.href=url;


		});

</script>

