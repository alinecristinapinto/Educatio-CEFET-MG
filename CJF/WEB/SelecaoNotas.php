<?php

session_start();

if (isset($_POST['aluno'])) {

	$sqlConexao = mysqli_connect("localhost", "root", "", "educatio");

	if (!$sqlConexao) {
		echo "Falha na conexao com o Banco de Dados!";
		exit;
	}

printf(" 
	<html>
	<head>
	<title>Seleção de notas</title>
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
					<h2 class='text-center'>Seleção de notas</h2><br>
						<div class='col-md-6'>");

	$strAluno = $_POST['aluno'];
	$_SESSION['Aluno'] = $strAluno;
	$strano = $_POST['ano'];
	$_SESSION['Ano'] = $strano;


	//Pesquisa do ID do aluno por meio do nome na tabela alunos;
	$sqlSql = "SELECT nome, idCPF FROM alunos WHERE nome='$strAluno'";
	$sqlResultado = $sqlConexao->query($sqlSql);
	$genAux = $sqlResultado->fetch_assoc();
	$intIdCPF = $genAux['idCPF'];
	$strNome = $genAux['nome'];

	//Pesquisa do ID-matricula por meio do id-CPF na tabela matriculas;
	$intContador = 0;
	$arrayMatricula = array();
	$sqlSql = "SELECT id FROM matriculas WHERE idAluno='$intIdCPF'";
	$sqlResultado = $sqlConexao->query($sqlSql);
	while ($genAux = $sqlResultado->fetch_assoc()) {
		$arrayMatricula[$intContador] = $genAux['id'];
		$intContador++;
	}

	if ($arrayMatricula == null) {
		$sqlSql = "SELECT id FROM matriculas WHERE idAluno='$strAluno'";
		$sqlResultado = $sqlConexao->query($sqlSql);
		while ($genAux = $sqlResultado->fetch_assoc()) {
			$arrayMatricula[$intContador] = $genAux['id'];
		}

		$sqlSql = "SELECT nome FROM alunos WHERE idCPF='$strAluno'";
		$sqlResultado = $sqlConexao->query($sqlSql);
		$genAux = $sqlResultado->fetch_assoc();
		$strNome = $genAux['nome'];
		$intIdCPF = $strAluno;
	}
	

	if ($arrayMatricula == null) {
		printf("<div class='alert alert-info' role='alert'>
 					 Aluno(a) não encontrado! <a href='SelecaoNotasHtml.php' class='alert-link'>Tentar novamente</a>. 
							</div>
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


	//Pesquisa da nota e do id-conteudo por meio do id-matricula na tabela diarios;
	$intContador = 0;
	$arrayDados = array();
	foreach ($arrayMatricula as $valor){
		$sqlSql = "SELECT nota,idConteudo,faltas FROM diarios WHERE idMatricula='$valor' AND ano='$strano'";
		$sqlResultado = $sqlConexao->query($sqlSql);
		while ($genAux = $sqlResultado->fetch_assoc()) {
			$arrayDados[$intContador]['intNota'] = $genAux['nota'];
			$arrayDados[$intContador]['intIdconteudo'] = $genAux['idConteudo'];
			$arrayDados[$intContador]['intFaltas'] = $genAux['faltas'];
			$intContador++;
		}
	}



	if ($arrayDados == null) {
	printf("<div class='alert alert-info' role='alert'>
 				 Nenhuma nota encontrada no ano pesquisado! <a href='SelecaoNotasHtml.php' class='alert-link'>Tentar novamente<a>. 
							</div>
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
		if (isset($arrayFinal[$strDisciplina][$intEtapa])) {
			$arrayFinal[$strDisciplina][$intEtapa] += $intNota;
		} else {
			$arrayFinal[$strDisciplina][$intEtapa] = $intNota;
		}
		
	}

	//Coloca os valores da faltas em um array;
	$arrayFaltas = array();
	foreach ($arrayDados as $valor) {
		$strDisciplina = $valor['strNomedisciplina'];
		$intEtapa = $valor['intIdetapa'];
		$intFaltas = $valor['intFaltas'];
		if (isset($arrayFaltas[$strDisciplina][$intEtapa])) {
			$arrayFaltas[$strDisciplina][$intEtapa] += $intFaltas;
		} else {
			$arrayFaltas[$strDisciplina][$intEtapa] = $intFaltas;
		}
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

	$intNotaTotal = 0;
	$intNotaMaxima = 0;
	foreach ($arrayFinal as $key => $valor) {
		for ($intX = 0; $intX < count($arrayEtapas); $intX++) {
			if(array_key_exists($arrayEtapas[$intX], $arrayFinal[$key])) {
				$sqlSql = "SELECT valor FROM etapas WHERE idOrdem='$arrayEtapas[$intX]'";
				$sqlResultado = $sqlConexao->query($sqlSql);
				$genAux = $sqlResultado->fetch_assoc();
				$intNotaMaxima += $genAux['valor'];
				$intNotaTotal += $valor[$arrayEtapas[$intX]];
			}
		}		
	}


	//Dados do aluno
	$intNotaTotal = (100*$intNotaTotal)/$intNotaMaxima;

	printf("<label class='fonteTexto'>");
	echo "Nome do aluno: ".$strNome.".<br>CPF: ".$intIdCPF.".<br>Ano: ".$strano.".<br>Coeficiente de Rendimento: ".number_format($intNotaTotal,2)."%.";
	printf("</label>");
	



	//Cria a tabela/boletim;
	echo "<table class='table table-hover'>
			<tr>
			<th bgcolor = '#C0C0C0' >Etapas</th>";
	foreach ($arrayEtapas as $valor) {
		echo "<th bgcolor = '#C0C0C0' colspan='2'><center>".$valor."</center></th>";
	}
	echo "</tr><tr><th bgcolor = '#C0C0C0' >Matérias</th>";
	foreach ($arrayEtapas as  $valor) {
		echo "<th>Nota</th><th bgcolor = '#DCDCDC'>Faltas</th>";
	}
	echo "</tr>";

	foreach ($arrayFinal as $key => $valor) {
		echo "<tr><th bgcolor = '#C0C0C0' >".$key."</th>";
		for ($intX = 0; $intX < count($arrayEtapas); $intX++) {
			if(array_key_exists($arrayEtapas[$intX], $arrayFinal[$key])) {
				echo "<td>".$arrayFinal[$key][$arrayEtapas[$intX]]."</td>";
				echo "<td bgcolor = '#DCDCDC'>".$arrayFaltas[$key][$arrayEtapas[$intX]]."</td>";
			} else {
				echo "<td>NE</td><td>NE</td>";
			}
		}
		echo "</tr>";
	}
	echo "</table>";

	echo 	"<form method='post' action='SelecaoNotas-Impressao.php'>
				<input class='btn btn-info btn-round' type='submit' value='Download'>
			</form>";

	$_SESSION['arrayDados'] = $arrayFinal;
	$_SESSION['arrayEtapas'] = $arrayEtapas;
	$_SESSION['arrayFaltas'] = $arrayFaltas;
	$_SESSION['rendimento'] = $intNotaTotal;
	$_SESSION['CPF'] = $intIdCPF;


} else {
	echo "Nome a ser pesquisado nao econtrado!";
}

printf("				
					</div>
				</div>
			</div>				
		</div>	
	</div>				
</body>
</html>");
?>

