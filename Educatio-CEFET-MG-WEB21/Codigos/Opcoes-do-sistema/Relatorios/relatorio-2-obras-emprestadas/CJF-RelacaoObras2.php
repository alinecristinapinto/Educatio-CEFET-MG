<?php

session_start();
ini_set('default_charset','UTF-8');

printf(" 
	<html>
	<head>
	<title>Relação de obras</title>
  	<meta charset='utf-8'>
  	<meta http-equiv='X-UA-Compatible' content='IE=edge'>
  	<meta name='viewport' content='width=device-width, initial-scale=1.0'>
  	<link href='https://fonts.googleapis.com/css?family=Abel|Inconsolata' rel='stylesheet'>

	<!-- CSS do Bootstrap -->
	<link href='../../../../Estaticos/Bootstrap/css/bootstrap.min.css' rel='stylesheet'/>
	<link href='../../../../Estaticos/Bootstrap/css/bootstrap.css' rel='stylesheet'/>

	<!-- CSS do grupo -->
	<link href='../css/CJF-web-estilos.css' rel='stylesheet' type='text/css' >

	<!-- Arquivos js -->
	<script src='../../../../Estaticos/Bootstrap/js/popper.js'></script>
	<script src='../../../../Estaticos/Bootstrap/js/jquery-3.2.1.js' type='text/javascript'></script>
	<script src='../../../../Estaticos/Bootstrap/js/bootstrap.min.js' type='text/javascript'></script>

	<!-- Fontes e icones -->
	<link href='../../../../Estaticos/Bootstrap/css/nucleo-icons.css' rel='stylesheet'>
</head>
<body>

		<div class='container'>
			<div class='row'>
				<div class='col-md-8 ml-auto mr-auto'>
					<h2 class='text-center'>Relação de obras</h2><br>");

//canfere se existe a variavel post enviada de CFJ-RelatorioObras1.php;
if (isset($_POST['data'])) {

	$sqlConexao = mysqli_connect("localhost", "root", "usbw", "educatio");

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

		//caso de errado a pesquisa
		if ($arrayDados == null) {
			printf("<div class='alert alert-info' role='alert'>
 					 Nenhum empréstimo encontrado no sistema! <a href='../../../Entrada/gerencia-web-interface-bibliotecario.php?acao=acessarObrasEmprestadas' class='alert-link'>Tentar novamente</a>. 
							</div>
						</div>
					</div>	
				</div>
			</div>	
		</div>				
				
</body>
</html>");
		exit;
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
			echo utf8_encode("<tr>
			<td>".$valor['id']."</td>
			<td>".$valor['nomeAluno']."</td>
			<td>".$valor['nome']."</td>
			<td>".$valor['dataEmprestimo']."</td>
			<td>".$valor['dataPrevisaoDevolucao']."</td>
			<td>".$valor['multa']."</td>
			</tr>");		
		}
		echo "</table>";

		echo "<form method='post' action='CJF-RelacaoObrasImpressao.php'>
				<input class='btn btn-info btn-round' type='submit' value='Download'>
			</form>";

			$_SESSION['arrayDados'] = $arrayDados;
			$_SESSION['data'] = $_POST['data'];

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

			echo "<form method='post' action='CJF-RelacaoObrasImpressao.php'>
					<input class='btn btn-info btn-round' type='submit' value='Download'>
				</form>";

			$_SESSION['arrayDados'] = $arrayDados;
			$_SESSION['data'] = $dateDataEscolhida;

		} else {
			//caso de errado a pesquisa
			printf("<div class='alert alert-info' role='alert'>
 					 Nenhum empréstimo encontrado nessa data! <a href='../../../Entrada/gerencia-web-interface-bibliotecario.php?acao=acessarObrasEmprestadas' class='alert-link'>Tentar novamente</a>. 
							</div>
						</div>
					</div>	
				</div>
			</div>	
		</div>				
					
</body>
</html>");
		exit;
		}
	}  

} else {
			//caso de errado a pesquisa
			printf("<div class='alert alert-info' role='alert'>
 					 Erro: Falha na pesquisa. <a href='../../../Entrada/gerencia-web-interface-bibliotecario.php?acao=acessarObrasEmprestadas' class='alert-link'>Tentar novamente</a>. 
							</div>
						</div>
					</div>	
				</div>
			</div>	
		</div>				
					
</body>
</html>");
		exit;
		
}

?>

	