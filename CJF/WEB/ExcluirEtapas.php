<?php

printf("<!DOCTYPE html>
<html>
<head>
	<title>Manutenção de Etapas - Exclusão</title>
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

if (isset($_POST['etapa'])) {

	$sqlConexao = mysqli_connect("localhost", "root", "", "educatio");
	if (!$sqlConexao) {
		echo "Falha na conexao com o Banco de Dados!";
		exit;
	}

	$intId = $_POST['etapa'];

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

	if ($intContador == 0) {
		echo "Etapa inexistente!";
		exit;
	}

	$sqlSql = "UPDATE etapas SET ativo='N' WHERE idOrdem='".$intId."'";
	

	$resultado = $sqlConexao->query($sqlSql);
	if ($resultado) {
			echo"Exclusão efetuada com sucesso!";
	} else {
		echo"Erro ao excluir etapa!";
	}
} else {

	echo "Variavel nao encontrada!";
}
printf("		</h>		
				</div>
			</div>
		</div>				
	</div>
</body>
</html>");
?>
