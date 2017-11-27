<?php

/*Grupo Felipe, Juliana, Carlos;
Autor Felipe Linhares;
Seleção de Conteudos por etapa/disciplina 3
*/

session_start();

$sqlConexao = mysqli_connect("localhost", "root", "usbw", "educatio");

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
	<link href='../../../../Estaticos/Bootstrap/css/bootstrap.min.css' rel='stylesheet'/>
	<link href='../../../../Estaticos/Bootstrap/css/bootstrap.css' rel='stylesheet'/>

	<!-- CSS do grupo -->
	<link href='CJF-web-estilos.css' rel='stylesheet' type='text/css' >

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
					<h2 class='text-center'>Seleção de conteúdos</h2><br>");

//recebe os valores;
$strDisciplinapesquisada = $_POST['disciplina'];
$intEtapapesquisada = $_POST['etapa'];

//Pesquisa o id-disciplina e o nome por meio do nome da disciplina;
$sqlSql = "SELECT id FROM disciplinas WHERE nome='$strDisciplinapesquisada'";
$sqlResultado = $sqlConexao->query($sqlSql);
$genAux = $sqlResultado->fetch_assoc();
$intIddisciplina = $genAux["id"];
$strDisciplina = $strDisciplinapesquisada;

//caso não obtenha resultado, pesquisa pelo id da disciplina;
if ($intIddisciplina == null) {
	$intIddisciplina = $strDisciplinapesquisada;
	$sqlSql = "SELECT nome FROM disciplinas WHERE id='$strDisciplinapesquisada'";
	$sqlResultado = $sqlConexao->query($sqlSql);
	$genAux = $sqlResultado->fetch_assoc();
	$strDisciplina = $genAux['nome'];
}

//Pesquisa o conteúdo por  meio dos id-etapas e o id-disciplinas;
$intContador = 0;
$arrayConteudo = array();
$sqlSql = "SELECT conteudo FROM conteudos WHERE idDisciplina='$intIddisciplina' AND idEtapa='$intEtapapesquisada'";
$sqlResultado = $sqlConexao->query($sqlSql);
while($genAux = $sqlResultado->fetch_assoc()) {
	$arrayConteudo[$intContador] = $genAux['conteudo'];
	$intContador++;
}


if ($arrayConteudo == null) {
	printf("<div class='alert alert-info' role='alert'>
 				Nenhum Conteúdo Encontrado!. 
					</div>
						<br><form method='post' action='../../../Entrada/gerencia-web-interface-coordenador.php?acao=acessarConteudos'>
								<input class='btn btn-info btn-round' type='submit' value='Outra turma!'>
							</form>
							<form method='post' action='CJF-SelecaoConteudos2.php'>
								<input class='btn btn-info btn-round' type='submit' value='Outra etapa/disciplina!'>
							</form>
						</div>
					</div>	
				</div>
			</div>	
		</div>				
					
</body>
</html>");
		exit;

} else {
	//exibe o resultado da pesquisa
	printf("<label class='fonteTexto'>");
	echo "<b>".utf8_encode($strDisciplina)." ".utf8_encode($intEtapapesquisada)."° etapa</b><br></br>";
	foreach ($arrayConteudo as $valor) {
		echo utf8_encode($valor)."<br>";	
	}

	//cria botoes para facilitar a "re-pesquisa"
	echo "<br></br><form method='post' action='../../../Entrada/gerencia-web-interface-coordenador.php?acao=acessarConteudos'>
		<input class='btn btn-info btn-round' type='submit' value='Outra turma!'>
		</form>";
	echo "<form method='post' action='CJF-SelecaoConteudos2.php'>
		<input class='btn btn-info btn-round' type='submit' value='Outra etapa/disciplina!'>
		</form>";
	printf("</label>");
}

printf("		</div>
			</div>
		</div>				
				
</body>
</html>");
?>

