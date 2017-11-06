<?php

$sqlConexao = mysqli_connect("localhost", "root", "", "educatio");

if (!$sqlConexao) {
    echo "Erro: Falha ao conectar-se com o banco de dados MySQL.";
    exit;
}


printf(" 
	<html>
	<head>
	<title>Seleção de conteúdos</title>
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
					<h2 class='text-center'>Seleção de conteúdos</h2><br>");

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

echo "<b>".$strDisciplinapesquisada." ".$intEtapapesquisada."° etapa</b><br></br>";
echo $strConteudo;	

printf("		</div>
			</div>
		</div>				
	</div>					
</body>
</html>");
?>

