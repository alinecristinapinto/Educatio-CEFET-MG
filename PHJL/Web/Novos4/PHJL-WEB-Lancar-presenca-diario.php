<?php
	session_start();
	//constantes utilizadas na conexão com o banco de dados
	define ("SERVIDOR", "localhost");
	define ("USUARIO", "root");
	define ("SENHA", "");
	define ("BD", "educatio");
	
	define ("IDPROF", $_SESSION["IDPROF"]);
	define ("IDTURMA", $_SESSION["IDTURMA"]);
	define ("IDDISCIPLINA", $_SESSION["IDDISCIPLINA"]);
	define ("IDCONTEUDO", $_SESSION["IDCONTEUDO"]);
	
	if(isset($_GET["idatividade"])){
		$_SESSION["IDATIVIDADE"] = $_GET["idatividade"];
		define ("IDATIVIDADE", $_SESSION["IDATIVIDADE"]);
	}
	
	//conexao com o BD
	$conn = mysqli_connect (SERVIDOR, USUARIO, SENHA);

	//Seleciona o BD
	$bd_select = mysqli_select_db ($conn, BD);

	//seleciona a linha em que o idCPF for igual ao CPF recebido
	$sql = "SELECT * FROM profdisciplinas WHERE idProfessor = " .IDPROF;
	$result = mysqli_query($conn,$sql);
	$linhaProf = mysqli_fetch_array($result);
	
	$sql = "SELECT * FROM turmas WHERE id = " .IDTURMA;
	$result = mysqli_query($conn,$sql);
	$linhaTurma = mysqli_fetch_array($result);
	
	$sql = "SELECT * FROM disciplinas WHERE id = " .IDDISCIPLINA;
	$result = mysqli_query($conn, $sql);
	$linhaDisciplina = mysqli_fetch_array($result);
	
	$sql = "SELECT * FROM conteudos WHERE id = " .IDCONTEUDO;
	$result = mysqli_query($conn, $sql);
	$linhaConteudo = mysqli_fetch_array($result);
	
	$sql = "SELECT * FROM atividades WHERE id = " .IDATIVIDADE;
	$result = mysqli_query($conn, $sql);
	$linhaAtividade = mysqli_fetch_array($result);
	
	$sql = "SELECT * FROM diarios WHERE idAtividade = " .IDATIVIDADE;
	$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
		<meta name="viewport" content="width=device-width" />
	
		<!-- TITULO E LOGO DA PAGINA  -->
		<title> Lançar Presença - Professor </title>
		<link rel="shortcut icon" href="imagens/logo.png">
		
		<!-- CSS do Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet" />
		<link href="css/bootstrap.css" rel="stylesheet"/>
		<link href="Rodape-Web/gerencia-web-estilos-rodape.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="PHJL-WEB-Estilo-paginas.css">
		
		<!-- Arquivos js -->
		<script src="js/jquery-3.2.1.js" type="text/javascript"></script>
		<script src="js/bootstrap.min.js" type="text/javascript"></script>
		<script src="PHJL-WEB-Formulario-de-insercao-de-alunos.js" defer></script>

		<!-- Fontes e icones -->
		<link href="https://fonts.googleapis.com/css?family=Abel|Inconsolata" rel="stylesheet">
		<link href="css/nucleo-icons.css" rel="stylesheet">
		
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
  		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	
	<!--Chama a funcao com o evento onload para carregar a tabela assim que o body for gerado -->
	<body>
		
		<div class="wrapper">
			<div class="section landing-section">
				<div class="container">
					<div class="row">
						<div class="col-md-8 ml-auto mr-auto" id = "pf">
							<h2 class="text-center"> LANÇAR PRESENÇA </h2>
							<?php 
								$atividades = array();
							
								echo "<h2> DISCIPLINA DE " .$linhaDisciplina[2] ."</h2>";
								echo "<h3> $linhaConteudo[1]º Bimestre </h3>";
								echo "<h4> CONTEÚDO : $linhaConteudo[3] </h4>";
								echo "<h5> ATIVIDADE : $linhaAtividade[2] </h5>";
								
								echo "<form class = 'contact-form' action = 'PHJL-WEB-Lancar-presenca-no-BD.php' method = 'POST'>";
								
								$numeroAlunos = 0;
								
								while($linhaDiario = mysqli_fetch_array($result)){
									$sql = "SELECT * FROM matriculas WHERE id = " .$linhaDiario[2];
									$result2 = mysqli_query($conn, $sql);
									$linhaMatricula = mysqli_fetch_array($result2);
									
									$sql = "SELECT * FROM alunos WHERE idCPF = " .$linhaMatricula[1];
									$result2 = mysqli_query($conn, $sql);
									
									$linhaAluno = mysqli_fetch_array($result2);
									echo "<div class='checkbox'>";
									echo "<label class = 'form-check-label'>";
									echo "<input class='form-check-input' type = 'checkbox' name = 'Aluno$numeroAlunos' value = '$linhaAluno[0]'>";
									echo "$linhaAluno[2]<br>";
									echo "</label>";
									echo "</div>";
									$numeroAlunos++;
								}
								echo "<input type = 'hidden' value = '$numeroAlunos' name = 'numeroAlunos'>";
								echo "<input type = 'submit' class='btn btn-info btn-round' value = 'Salvar'></form>";
								
							?>
						</div>
					</div>
				</div>
			</div>	
		</div>
	</body>
</html>