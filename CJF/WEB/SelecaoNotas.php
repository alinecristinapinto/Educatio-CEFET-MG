<?php


if (isset($_POST['aluno'])) {

	$sqlConexao = mysqli_connect("localhost", "root", "", "educatio");

	if (!$sqlConexao) {
		echo "Falha na conexao com o Banco de Dados!";
		exit;
	}

	printf("<!DOCTYPE html>
		<html>
		<head>
			<title>Seleção notas</title>
			<meta charset='utf-8'>
			<link href='CJF-web-estilos.css' rel='stylesheet' type='text/css' >
			<link href='css/bootstrap.css' rel='stylesheet'>
			<link href='gerencia-web-estilos-rodape.css' rel='stylesheet'>
  			<script src='js/jquery.min.js'></script>
 			<script src='js/bootstrap.min.js'></script> 
  			<meta http-equiv='X-UA-Compatible' content='IE=edge'>
  			<meta name='viewport' content='width=device-width, initial-scale=1.0'>
		</head>
		<body>
		<div class='jumbotron'>
  			<h1 class='display-3'>Relação por seleção de aluno</h1>
  			<hr class='my-4'>
		</div>
		<div class='container'>");

	$strAluno = $_POST['aluno'];

	//Pesquisa do ID do aluno por meio do nome na tabela alunos;
	$sqlSql = "SELECT idCPF FROM alunos WHERE nome='$strAluno'";
	$sqlResultado = $sqlConexao->query($sqlSql);
	$genAux = $sqlResultado->fetch_assoc();
	$intIdCPF = $genAux['idCPF'];

	if ($intIdCPF == null) {
		printf("<div class='alert alert-info' role='alert'>
 					 Aluno não encontrado! <a href='SelecaoNotasHtml.php' class='alert-link'>Tentar novamente</a>. 
				</div>
			
				</div>

				<div id='rodape'>
				<div class='container'>
					<div class='row centralizado'>
						<div class='col-md-4'>
							<img src='prom.jpg' class='img-circle'><br>
							<h6><strong>Desenvolvedores</strong></h6>
							<p></span> Alunos da turma de Informática 2A 2017 do CEFET-MG.
							<a href='#'>Clique aqui</a> para saber mais.</p>  
						</div>
					<div class='col-md-4'>
					    <img src='cefetop.png' class='img-circle'><br>
					    <h6><strong>Instituição</strong></h6>
					    <p>Centro Federal de Educação Tecnológica de Minas Gerais. Av. Amazonas 5253 - Nova Suíssa - Belo Horizonte - Brasil.</p>
      		  		</div>
        			<div class='col-md-4'>
            			<img src='bootstrap.png' class='img-circle'><br>
            			<h6>Recursos Utilizados</h6>
            			<p>
					    <a href='https://github.com/NinaCris16/Educatio-CEFET-MG'>GitHub</a><br>
					    <a href='http://getbootstrap.com/'>Bootstrap</a><br>
					    </p>
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

printf("</div>

		<div id='rodape'>
		<div class='container'>
			<div class='row centralizado'>
				<div class='col-md-4'>
					<img src='prom.jpg' class='img-circle'><br>
					<h6><strong>Desenvolvedores</strong></h6>

					<p></span> Alunos da turma de Informática 2A 2017 do CEFET-MG.
					<a href='#'>Clique aqui</a> para saber mais.</p>  
				</div>
				<div class='col-md-4'>
				    <img src='cefetop.png' class='img-circle'><br>
				    <h6><strong>Instituição</strong></h6>
				    <p>Centro Federal de Educação Tecnológica de Minas Gerais. Av. Amazonas 5253 - Nova Suíssa - Belo Horizonte - Brasil.</p>
        			</div>
        			<div class='col-md-4'>
            				<img src='bootstrap.png' class='img-circle'><br>
            				<h6>Recursos Utilizados</h6>
            				<p>
					    <a href='https://github.com/NinaCris16/Educatio-CEFET-MG'>GitHub</a><br>
					    <a href='http://getbootstrap.com/'>Bootstrap</a><br>
					    </p>
        			</div>
			</div>
		</div>
	</div>
</body>	
</html>");
?>

