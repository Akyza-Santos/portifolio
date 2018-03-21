<!DOCTYPE html>

<?php
	include("cabecalho.php");
?>

<html>
	<body>
		<table border="1">

			<tr>
			
				<th> Atividade </th>
				<th> Data </th>
				<th> Download </th>
			
			</tr>
			
	<?php $xml = simplexml_load_file("portifolio.xml");
		  foreach($xml->arquivos as $portifolio){ ?>
			
			<tr>
			
				<td><a href = "<?= $portifolio->link;?>"><?= $portifolio->nome_atividade;?></a></td>
				<td><?= $portifolio->data; ?></td>
				<td><a href="uploads/<?= $portifolio->arquivo;?>"><?= $portifolio->arquivo;?></a></td>
			
			</tr>
	<?php
		}
	?>


		</table>
	</body>

</html>