<?php

printf(" 
	<html>
	<head>
	<title>Relação de reservas</title>
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
					<h2 class='text-center'>Relação de reservas</h2><br>
						<div class='col-md-6'>");

if (isset($_POST['data'])) {

	$sqlConexao = mysqli_connect("localhost", "root", "", "educatio");

	if (!$sqlConexao) {
		echo "Falha na conexao com o Banco de Dados!";
		exit;
	}


	if ($_POST['data'] == null) {

		$arrayDados = array();
		$intContador = 0;

		$sqlSql = "SELECT * FROM reservas";
		$sqlResultado = $sqlConexao->query($sqlSql);
		while ($genAux = $sqlResultado->fetch_assoc()) {
			if ($genAux['ativo'] = "S") {
				$arrayDados[$intContador]['id'] = $genAux['id'];
				$arrayDados[$intContador]['idAluno'] = $genAux['idAluno'];
				$arrayDados[$intContador]['idAcervo'] = $genAux['idAcervo'];
				$arrayDados[$intContador]['dataReserva'] = $genAux['dataReserva'];
				$arrayDados[$intContador]['tempoEspera'] = $genAux['tempoEspera'];
				$arrayDados[$intContador]['emprestou'] = $genAux['emprestou'];
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

		echo "<table border='1'>
		<tr>
		<td>Id da Reserva</td>
		<td>Aluno</td>
		<td>Nome</td>
		<td>Data da Reserva</td>
		<td>Tempo de Espera</td>
		<td>Emprestou</td>
		</tr>";
		foreach ($arrayDados as $valor) {
			echo "<tr>
			<td>".$valor['id']."</td>
			<td>".$valor['nomeAluno']."</td>
			<td>".$valor['nome']."</td>
			<td>".$valor['dataReserva']."</td>
			<td>".$valor['tempoEspera']."</td>
			<td>".$valor['emprestou']."</td>
			</tr>";		
		}
		echo "</table>";

	} else {

		$dateReserva = $_POST['data'];
		$arrayDados = array();
		$intContador = 0;

		$sqlSql = "SELECT * FROM reservas WHERE dataReserva='$dateReserva'";
		$sqlResultado = $sqlConexao->query($sqlSql);
		while ($genAux = $sqlResultado->fetch_assoc()) {
			if ($genAux['ativo'] = "S") {
				$arrayDados[$intContador]['id'] = $genAux['id'];
				$arrayDados[$intContador]['idAluno'] = $genAux['idAluno'];
				$arrayDados[$intContador]['idAcervo'] = $genAux['idAcervo'];
				$arrayDados[$intContador]['dataReserva'] = $genAux['dataReserva'];
				$arrayDados[$intContador]['tempoEspera'] = $genAux['tempoEspera'];
				$arrayDados[$intContador]['emprestou'] = $genAux['emprestou'];
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

		echo "<table border='1'>
		<tr>
		<td>Id da Reserva</td>
		<td>Aluno</td>
		<td>Nome</td>
		<td>Data da Reserva</td>
		<td>Tempo de Espera</td>
		<td>Emprestou</td>
		</tr>";
		foreach ($arrayDados as $valor) {
			echo "<tr>
			<td>".$valor['id']."</td>
			<td>".$valor['nomeAluno']."</td>
			<td>".$valor['nome']."</td>
			<td>".$valor['dataReserva']."</td>
			<td>".$valor['tempoEspera']."</td>
			<td>".$valor['emprestou']."</td>
			</tr>";		
		}
		echo "</table>";

	}

    

} else {
	echo "Não econtramos o que deve ser pesquisado!";
}
printf("				</div>
					</div>
				</div>
			</div>				
		</div>					
</body>
</html>");
?>	