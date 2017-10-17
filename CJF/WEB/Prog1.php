<?php


if (isset($_POST['aluno'])) {

	$sqlConexao = mysqli_connect("localhost", "root", "", "educatio");

	if (!$sqlConexao) {
		echo "Falha na conexao com o Banco de Dados!";
		exit;
	}

	$strAluno = $_POST['aluno'];

	//Pesquisa do ID do aluno por meio do nome na tabela alunos;
	$sqlSql = "SELECT idCPF FROM alunos WHERE nome='$strAluno'";
	$sqlResultado = $sqlConexao->query($sqlSql);
	$genAux = $sqlResultado->fetch_assoc();
	$intIdCPF = $genAux['idCPF'];

	if ($intIdCPF == null) {
		echo "Aluno não encontrado!";
		exit;
	}

	//Pesquisa do ID-matricula por meio do id-CPF na tabela matriculas;
	$sqlSql = "SELECT id FROM matriculas WHERE idAluno='$intIdCPF'";
	$sqlResultado = $sqlConexao->query($sqlSql);
	$genAux = $sqlResultado->fetch_assoc();
	$intIdmatricula = $genAux['id'];

	//Pesquisa da nota e do id-conteudo por meio do id-matricula na tabela diarios;
	$sqlSql = "SELECT nota,idConteudo FROM diarios WHERE idMatricula='$intIdmatricula'";
	$sqlResultado = $sqlConexao->query($sqlSql);
	$arrayDados = array();
	$intContador = 0;
	while ($genAux = $sqlResultado->fetch_assoc()) {
		$arrayDados[$intContador]['intNota'] = $genAux['nota'];
		$arrayDados[$intContador]['intIdconteudo'] = $genAux['idConteudo'];
		$intContador++;
	}

	//Pesquisa do id-etapa e id-disciplina por meio do id-conteudos na tabela conteudos;
	$intContador = 0;
	foreach ($arrayDados as $valor) {
		$intIdconteudo = $valor['intIdconteudo'];
		$sqlSql = "SELECT idEtapa, idDisciplina FROM conteudos WHERE id='$intIdconteudo'";
		$sqlResultado = $sqlConexao->query($sqlSql);
		$genAux = $sqlResultado->fetch_assoc();
		$arrayDados[$intContador]['intIdetapa'] = $genAux['idEtapa'];
		$arrayDados[$intContador]['intIddisciplina'] = $genAux['idDisciplina'];
		$intContador++;
	}

	//Pesquisa do nome da disciplina por meio do id-disciplina na tabela disciplina;
	$intContador = 0;
	foreach ($arrayDados as $valor) {
		$intIddisciplina = $valor['intIddisciplina'];
		$sqlSql = "SELECT nome FROM Disciplinas WHERE id='$intIddisciplina'";
		$sqlResultado = $sqlConexao->query($sqlSql);
		$genAux = $sqlResultado->fetch_assoc();
		$arrayDados[$intContador]['strNomedisciplina'] = $genAux['nome'];
		$intContador++;
	}
	
	//Coloca os valores úteis em um array;
	$arrayFinal = array();
	foreach ($arrayDados as $valor) {
		$strDisciplina = $valor['strNomedisciplina'];
		$intEtapa = $valor['intIdetapa'];
		$intNota = $valor['intNota'];
		$arrayFinal[$strDisciplina][$intEtapa] = $intNota;
	}

	//Confere quais etapas serão mostradas no boletim;
	$intContador = 0;
	$arrayEtapas = array();
	foreach ($arrayDados as $valor) {
		$arrayEtapas[$intContador] = $valor['intIdetapa'];
		$intContador++;
	}
	$arrayEtapas = array_unique($arrayEtapas);
	sort($arrayEtapas);

	//Cria a tabela/boletim;
	echo "<table border='1'><tr><td>Boletim</td>";
	foreach ($arrayEtapas as $valor) {
		echo "<td>".$valor."</td>";
	}
	echo "</tr>";
	foreach ($arrayFinal as $key => $valor) {
		echo "<tr><td>".$key."</td>";
		for ($intX = 0; $intX < count($arrayEtapas); $intX++) {
			if(array_key_exists($arrayEtapas[$intX], $arrayFinal[$key])) {
				echo "<td>".$arrayFinal[$key][$arrayEtapas[$intX]]."</td>";
			} else {
				echo "<td>NE</td>";
			}
		}
		echo "</tr>";
	}
	echo "</table>";

} else {
	echo "Nome a ser pesquisado nao econtrado!";
}

