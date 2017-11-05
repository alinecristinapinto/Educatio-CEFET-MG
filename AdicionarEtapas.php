<?php

printf("<!DOCTYPE html>
<html>
<head>
	<title>Manutenção de Etapas - Inclusão</title>
  	<meta charset='utf-8'>
  	<meta http-equiv='X-UA-Compatible' content='IE=edge'>
  	<meta name='viewport' content='width=device-width, initial-scale=1.0'>
  	<link href='https://fonts.googleapis.com/css?family=Abel|Inconsolata' rel='stylesheet'>

	<!-- CSS do Bootstrap -->
	<link href='css/bootstrap.min.css' rel='stylesheet' />
	<link href='css/bootstrap.css' rel='stylesheet'/>

	<!-- CSS do grupo -->
	<link href='CJF-web-estilos.css' rel='stylesheet' type='text/css' >

	<!-- Arquivos js -->
	<script src='js/popper.js'></script>
	<script src='js/jquery-3.2.1.js' type='text/javascript'></script>
	<script src='js/bootstrap.min.js' type='text/javascript'></script>

	<!-- Fontes e icones -->
	<link href='css/nucleo-icons.css' rel='stylesheet'>	
</head>
<body>
	<div class='section landing-section'>
		<div class='container'>
			<div class='row'>
				<div class='col-md-8 ml-auto mr-auto'>
					<h2 class='text-center'>");

if (isset($_POST['valor'])) {
	if (isset($_POST['etapa'])) {


		$sqlConexao = mysqli_connect("localhost", "root", "", "educatio");

		if (!$sqlConexao) {
			echo "Falha na conexao com o Banco de Dados!";
			exit;
		}

		$intId = $_POST['etapa'];
		$intValor = $_POST['valor'];

		$sqlSql = "SELECT idOrdem FROM etapas WHERE ativo='S'";
		$sqlResultado = $sqlConexao->query($sqlSql);
		$arrayDados = array();
		$intContador = 0;
		while ($genAux = $sqlResultado->fetch_assoc()) {
			if ($intId == $genAux['idOrdem']) {
				$intContador++;
				break;
			}
		}

		if ($intContador != 0) {
			echo "Etapa Já existente!";
			exit;
		}

		$sqlSql = "SELECT idOrdem FROM etapas WHERE ativo='N'";
		$sqlResultado = $sqlConexao->query($sqlSql);
		$arrayDados = array();
		$intContador = 0;
		while ($genAux = $sqlResultado->fetch_assoc()) {
			if ($intId == $genAux['idOrdem']) {
				$sqlSql = "UPDATE etapas SET ativo='S',valor='".$intValor."' WHERE idOrdem='".$intId."'";
				$resultado = $sqlConexao->query($sqlSql);
				if ($resultado) {
					echo"Etapa criada com sucesso!";
				} else {
					echo"Erro ao criar etapa!";
				}
				$intContador++;
			}
		}

		if ($intContador == 0) {
			$sqlSql = "INSERT INTO etapas (idOrdem, valor, ativo) VALUES ('".$intId."', '".$intValor."', 'S')";
			$resultado = $sqlConexao->query($sqlSql);
			if ($resultado) {
				echo"Etapa criada com sucesso!";
			} else {
				echo"Erro ao criar etapa!";
			}
		}
		
	} else {
		echo "Variável nao encontrada!";
	}
} else {

	echo "Variável não encontrada!";
}
printf("		</h>		
				</div>
			</div>
		</div>				
	</div>
</body>
</html>");
?>

