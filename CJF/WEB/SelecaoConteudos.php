<?php

$sqlConexao = mysqli_connect("localhost", "root", "", "educatio");

if (!$sqlConexao) {
    echo "Erro: Falha ao conectar-se com o banco de dados MySQL.";
    exit;
}

printf("<!DOCTYPE html>
		<html>
		<head>
			<title>Seleção conteúdos</title>
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
  			<h1 class='display-3'>Relação de conteúdos por disciplina</h1>
  			<hr class='my-4'>
		</div>
			<div class='container'>
    			<h4><b>");

$strDisciplinapesquisada = $_POST['disciplina'];
$intEtapapesquisada = $_POST['etapa'];

//Pesquisa o id-disciplinas por meio do nome da disciplina;
$sqlSql = "SELECT id FROM disciplinas WHERE nome='$strDisciplinapesquisada'";
$sqlResultado = $sqlConexao->query($sqlSql);
$genAux = $sqlResultado->fetch_assoc();
$intIddisciplina = $genAux["id"];

//Pesquisa o conteúdo* por  meio dos id-etapas e o id-disciplinas;
$sqlSql = "SELECT conteudo FROM conteudos WHERE idDisciplina='$intIddisciplina' AND idEtapa='$intEtapapesquisada'";
$sqlResultado = $sqlConexao->query($sqlSql);
$genAux = $sqlResultado->fetch_assoc();


$strConteudo = $genAux['conteudo'];

echo $strDisciplinapesquisada." ".$intEtapapesquisada."° etapa";

printf("</b></h4>");

	echo $strConteudo;	
	// Não está mostrando o conteúdo sei lá porquê aaa ;-;
printf("</div>
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
?>

