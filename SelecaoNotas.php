<?php


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

	//Pesquisa do ID do aluno por meio do nome na tabela alunos;
	$sqlSql = "SELECT idCPF FROM alunos WHERE nome='$strAluno'";
	$sqlResultado = $sqlConexao->query($sqlSql);
	$genAux = $sqlResultado->fetch_assoc();
	$intIdCPF = $genAux['idCPF'];

	if ($intIdCPF == null) {
		printf("<div class='alert alert-info' role='alert'>
 					 Aluno(a) não encontrado! <a href='SelecaoNotasHtml.php' class='alert-link'>Tentar novamente</a>. 
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
	echo "<table border='1'><tr><td>Notas</td>";
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

printf("				</div>
					</div>
				</div>
			</div>				
		</div>					
</body>
</html>");
?>

