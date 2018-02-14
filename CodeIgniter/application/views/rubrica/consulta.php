<article class="tablaResponsive">
<?php
echo ('<div>

<table id="tablarubricas">

	<tr>
		<th>Competencia</th>
		<th>Mal</th>
		<th>Regular</th>
		<th>Bien</th>
		<th>Excelente</th>
		<th>Grupo</th>
	</tr>');
		foreach ($competencias->result() as $competencia) {

        echo('	<tr>
		<td>'.$competencia->DESC_Competencia.'</td>
		<td>'.$competencia->Mal.'</td>
		<td>'.$competencia->Regular.'</td>
		<td>'.$competencia->Bien.'</td>
		<td>'.$competencia->Excelente.'</td>
		<td>'.$competencia->DESC_Grupo_Competencia.'</td>
		</tr>');
    } 


echo('</table> </div>');

?>
</article>