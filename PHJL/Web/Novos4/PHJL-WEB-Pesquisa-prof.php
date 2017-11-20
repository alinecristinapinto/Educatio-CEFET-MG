<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
		<meta name="viewport" content="width=device-width" />
	
		<!-- TITULO E LOGO DA PAGINA  -->
		<title> Acessar diário - Professor </title>
		<link rel="shortcut icon" href="imagens/logo.png">
		
		<!-- CSS do Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet" />
		<link href="css/bootstrap.css" rel="stylesheet"/>
		<link href="Rodape-Web/gerencia-web-estilos-rodape.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="PHJL-WEB-Estilo-paginas.css">
		
		<!-- Arquivos js -->
		<script src="js/jquery-3.2.1.js" type="text/javascript"></script>
		<script src="js/bootstrap.min.js" type="text/javascript"></script>
		<script src="PHJL-WEB-Formulario-de-insercao-de-alunos.js" defer></script>

		<!-- Fontes e icones -->
		<link href="https://fonts.googleapis.com/css?family=Abel|Inconsolata" rel="stylesheet">
		<link href="css/nucleo-icons.css" rel="stylesheet">
		
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
  		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	
	<!--Chama a funcao com o evento onload para carregar a tabela assim que o body for gerado -->
	<body onload = "escreveNomes('')">
		
		<div class="wrapper">
			<div class="section landing-section">
				<div class="container">
					<div class="row">
						<div class="col-md-8 ml-auto mr-auto">
							<h2 class="text-center">pesquisa prof</h2>
							<?php 
								//constantes utilizadas na conexão com o banco de dados
								define ("SERVIDOR", "localhost");
								define ("USUARIO", "root");
								define ("SENHA", "");
								define ("BD", "educatio");
								
								//conexao com o BD
								$conn = mysqli_connect (SERVIDOR, USUARIO, SENHA);

								//Seleciona o BD
								$bd_select = mysqli_select_db ($conn, BD);
								
								$sql = "SELECT * FROM Profdisciplinas";
								$result = mysqli_query($conn, $sql);
								while($linha = mysqli_fetch_array($result)){
									echo "idProfessor : " .$linha[1] ."<br><br>";
								}
							?>
							<form class="contact-form" method = "POST" action = "PHJL-WEB-Pesquisa-turma-diario.php" id="formulario">
								<input type="text" name = "idPROF">
								<button type = "submit"> Enviar </button>
							</form>
							
						</div>
					</div>
				</div>
			</div>	
		</div>
	</body>
</html>