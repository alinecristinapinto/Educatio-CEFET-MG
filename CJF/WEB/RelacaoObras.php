<?php


if (isset($_POST['data'])) {

	$sqlConexao = mysqli_connect("localhost", "root", "", "educatio");

	if (!$sqlConexao) {
		echo "Falha na conexao com o Banco de Dados!";
		exit;
	}


	if ($_POST['data'] == null) {

		$arrayDados = array();
		$intContador = 0;

		$sqlSql = "SELECT * FROM emprestimos";
		$sqlResultado = $sqlConexao->query($sqlSql);
		while ($genAux = $sqlResultado->fetch_assoc()) {
			if ($genAux['ativo'] = "S") {
				$arrayDados[$intContador]['id'] = $genAux['id'];
				$arrayDados[$intContador]['idAluno'] = $genAux['idAluno'];
				$arrayDados[$intContador]['idAcervo'] = $genAux['idAcervo'];
				$arrayDados[$intContador]['dataEmprestimo'] = $genAux['dataEmprestimo'];
				$arrayDados[$intContador]['dataPrevisaoDevolucao'] = $genAux['dataPrevisaoDevolucao'];
				$arrayDados[$intContador]['multa'] = $genAux['multa'];
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
		<td>Id do Emprestimo</td>
		<td>Aluno</td>
		<td>Nome</td>
		<td>Data do Emprestimo</td>
		<td>Data da previsao de Entrega</td>
		<td>Multa</td>
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

		$sqlSql = "SELECT * FROM emprestimos WHERE dataprevisaoDevolucao='$dateDataEscolhida'";
		$sqlResultado = $sqlConexao->query($sqlSql);
		while ($genAux = $sqlResultado->fetch_assoc()) {
			if ($genAux['ativo'] = "S") {
				$arrayDados[$intContador]['id'] = $genAux['id'];
				$arrayDados[$intContador]['idAluno'] = $genAux['idAluno'];
				$arrayDados[$intContador]['idAcervo'] = $genAux['idAcervo'];
				$arrayDados[$intContador]['dataEmprestimo'] = $genAux['dataEmprestimo'];
				$arrayDados[$intContador]['dataPrevisaoDevolucao'] = $genAux['dataPrevisaoDevolucao'];
				$arrayDados[$intContador]['multa'] = $genAux['multa'];
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
		<td>Id do Emprestimo</td>
		<td>Aluno</td>
		<td>Nome</td>
		<td>Data do Emprestimo</td>
		<td>Data da previsao de Entrega</td>
		<td>Multa</td>
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

	}

    

} else {
	echo "Não econtramos o que deve ser pesquisado!";
}

	