<?php

printf(" 
	<html>
	<head>
	<title>Relação de obras</title>
  	<meta charset='utf-8'>
  	<meta http-equiv='X-UA-Compatible' content='IE=edge'>
  	<meta name='viewport' content='width=device-width, initial-scale=1.0'>
  	<link href='https://fonts.googleapis.com/css?family=Abel|Inconsolata' rel='stylesheet'>

	<!-- CSS do Bootstrap -->
	<link href='css/bootstrap.min.css' rel='stylesheet'/>
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
					<h2 class='text-center'>Relação de obras</h2><br>");

if (isset($_POST['data'])) {

	$sqlConexao = mysqli_connect("localhost", "root", "", "educatio");

	if (!$sqlConexao) {
		echo "Falha na conexao com o Banco de Dados!";
		exit;
	}


	if ($_POST['data'] == null) {

		$arrayDados = array();
		$intContador = 0;

		$sqlSql = "SELECT * FROM emprestimos ORDER BY id";
		$sqlResultado = $sqlConexao->query($sqlSql);
		while ($genAux = $sqlResultado->fetch_assoc()) {
			if ($genAux['ativo'] = "S") {
				$arrayDados[$intContador]['id'] = $genAux['id'];
				$arrayDados[$intContador]['idAluno'] = $genAux['idAluno'];
				$arrayDados[$intContador]['idAcervo'] = $genAux['idAcervo'];
				$arrayDados[$intContador]['dataEmprestimo'] = $genAux['dataEmprestimo'];
				$arrayDados[$intContador]['dataPrevisaoDevolucao'] = $genAux['dataPrevisaoDevolucao'];
				$arrayDados[$intContador]['multa'] = $genAux['multa'];
				$intContador++;
			}
		}
		
		$intContador = 0;

		foreach ($arrayDados as $valor) {
			$intIdaluno = $valor['idAluno'];
			$sqlSql = "SELECT nome FROM alunos WHERE idCPF='$intIdaluno'";
			$sqlResultado = $sqlConexao->query($sqlSql);
			$genAux = $sqlResultado->fetch_assoc();
			$arrayDados[$intContador]['nomeAluno'] = $genAux['nome'];

			$intIdacervo = $valor['idAcervo'];
			$sqlSql = "SELECT nome FROM acervo WHERE id='$intIdacervo'";
			$sqlResultado = $sqlConexao->query($sqlSql);
			$genAux = $sqlResultado->fetch_assoc();
			$arrayDados[$intContador]['nome'] = $genAux['nome'];

			$intContador++;
		}

		echo "<table class='table table-hover'>
		<tr>
		<th>Id do Emprestimo</th>
		<th>Aluno</th>
		<th>Nome</th>
		<th>Data do Emprestimo</th>
		<th>Data da previsao de Entrega</th>
		<th>Multa</th>
		</tr>";
		foreach ($arrayDados as $valor) {
			echo "<tr>
			<td>".$valor['id']."</td>
			<td>".$valor['nomeAluno']."</td>
			<td>".$valor['nome']."</td>
			<td>".$valor['dataEmprestimo']."</td>
			<td>".$valor['dataPrevisaoDevolucao']."</td>
			<td>".$valor['multa']."</td>
			</tr>";		
		}
		echo "</table>";

	} else {

		$dateDataEscolhida = $_POST['data'];
		$arrayDados = array();
		$intContador = 0;

		$sqlSql = "SELECT * FROM emprestimos WHERE dataEmprestimo='$dateDataEscolhida' ORDER BY id";
		$sqlResultado = $sqlConexao->query($sqlSql);
		while ($genAux = $sqlResultado->fetch_assoc()) {
			if ($genAux['ativo'] = "S") {
				$arrayDados[$intContador]['id'] = $genAux['id'];
				$arrayDados[$intContador]['idAluno'] = $genAux['idAluno'];
				$arrayDados[$intContador]['idAcervo'] = $genAux['idAcervo'];
				$arrayDados[$intContador]['dataEmprestimo'] = $genAux['dataEmprestimo'];
				$arrayDados[$intContador]['dataPrevisaoDevolucao'] = $genAux['dataPrevisaoDevolucao'];
				$arrayDados[$intContador]['multa'] = $genAux['multa'];
				$intContador++;
			}
		}

		$intContador = 0;

		foreach ($arrayDados as $valor) {
			$intIdaluno = $valor['idAluno'];
			$sqlSql = "SELECT nome FROM alunos WHERE idCPF='$intIdaluno'";
			$sqlResultado = $sqlConexao->query($sqlSql);
			$genAux = $sqlResultado->fetch_assoc();
			$arrayDados[$intContador]['nomeAluno'] = $genAux['nome'];

			$intIdacervo = $valor['idAcervo'];
			$sqlSql = "SELECT nome FROM acervo WHERE id='$intIdacervo'";
			$sqlResultado = $sqlConexao->query($sqlSql);
			$genAux = $sqlResultado->fetch_assoc();
			$arrayDados[$intContador]['nome'] = $genAux['nome'];

			$intContador++;
		}

		if ($arrayDados != null) {
			echo "<table class='table table-hover'>
			<tr>
			<th>Id do Emprestimo</th>
			<th>Aluno</th>
			<th>Nome</th>
			<th>Data do Emprestimo</th>
			<th>Data da previsao de Entrega</th>
			<th>Multa</th>
			</tr>";
			foreach ($arrayDados as $valor) {
				echo "<tr>
				<td>".$valor['id']."</td>
				<td>".$valor['nomeAluno']."</td>
				<td>".$valor['nome']."</td>
				<td>".$valor['dataEmprestimo']."</td>
				<td>".$valor['dataPrevisaoDevolucao']."</td>
				<td>".$valor['multa']."</td>
				</tr>";		
			}
			echo "</table>";
		} else {
			echo "Não achamos nada nesta data!";
		}
	}
		

    

} else {
	echo "Não econtramos o que deve ser pesquisado!";

	printf("				
						</div>
					</div>
				</div>				
			</div>					
	</body>
	</html>");	
}

?>

	