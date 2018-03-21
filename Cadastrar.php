<?php

include ("cabecalho.php");

if(isset($_POST["nome_atividade"])){
	
	$nome_atividade = $_POST["nome_atividade"]; 
	$link = $_POST["link"];
	$data = $_POST["data"];


	if(isset($_FILES['arquivo']))
   {
      date_default_timezone_set("Brazil/East"); //Definindo timezone padr?o

      $ext = strtolower(substr($_FILES['arquivo']['name'],-4)); //Pegando extens?o do arquivo
      $arquivo = date("Y.m.d-H.i.s") . $ext; //Definindo um novo nome para o arquivo
      $dir = 'uploads/'; //Diret?rio para uploads

      move_uploaded_file($_FILES['arquivo']['tmp_name'], $dir.$arquivo); //Fazer upload do arquivo
   }
	
	
	if(!file_exists("portifolio.xml")){
		
		$xml = "<?xml version = '1.0' encoding = 'UTF-8'?><portifolio><arquivos><nome_atividade> $nome_atividade </nome_atividade><link> $link </link><data> $data </data><arquivo>$arquivo</arquivo></arquivos></portifolio>";

		file_put_contents("portifolio.xml",$xml);			
		
	}
	else{
		
		$xml= simplexml_load_file("portifolio.xml");
		
			$arquivos = $xml -> addChild ('arquivos');
			
			$arquivos -> addChild('nome_atividade',$nome_atividade);
			
			$arquivos -> addChild('link',$link);
			
			$arquivos -> addChild('data',$data);
			
			$arquivos -> addChild('arquivo',$arquivo);
				

		
		file_put_contents("portifolio.xml",$xml -> asXML());
		
	
  }
  
  echo "Cadastro com sucesso!!!";
  
}
else{

?>
<html>
	<head>
	
		<style>
		
				body{
					background-color: rgb(147,133,188);
				}	
				div{
					text-align: center;
					width: 30%;
					margin: 80px auto;
					height: 300px;
					background-color: #fff;
					font-family: tahoma;
					color: #404040;
					box-shadow: 0px 0px 10px 2px #222;	
				}
				input[type = link]:focus, 
				input[type = text]:focus{
					background-color: #cde5ef;
					width: 250px;
					transition: width 100s;
				}
				
				
				input[type = submit]{
						font-weight: Arial;
						font-size: 12px;
						padding: 6px;
						border-radius: 10px;
						height: 30px;
						cursor: pointer;

				}

		</style>
	
	</head>
	<body>
		<form method = "post" action = "Cadastrar.php" enctype="multipart/form-data">
		<div>
			<label> Nome Atividade </label>
			<input type = "text" name = "nome_atividade" />
			
			<br /><br />
		
			<label> Link </label>
			<input type = "text" name = "link" />
			
			<br /><br />
			
			<label> Data </label>
			<input type = "date" name = "data" />
			
			<br /><br />
			
			<label> Arquivo </label>
			<input type = "file" name = "arquivo"/>
			
			<br /><br />
		
			<input type = "submit"/>
		</div>	
		</form>
	
	</body>

</html>

<?php

}

?>