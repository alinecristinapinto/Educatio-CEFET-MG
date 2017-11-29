<?php
	session_start();
	header('content-type: text/html; charset=ISO-8859-1');
	//constantes utilizadas na conexão com o banco de dados
	define ("SERVIDOR", "localhost");
	define ("USUARIO", "root");
	define ("SENHA", "usbw");
	define ("BD", "educatio");
	
	$usuario = $_SESSION['usuario'];

	define ("IDPROF", $usuario['idSIAPE']);
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
		<title> Lan&ccedil;ar Presen&ccedil;a - Professor </title>
		<link rel="shortcut icon" href="imagens/logo.png">
		
		<!-- CSS do Bootstrap -->
		<link href="../../../Estaticos/Bootstrap/css/bootstrap.min.css" rel="stylesheet" />
		<link href="../../../Estaticos/Bootstrap/css/bootstrap.css" rel="stylesheet"/>
		<link rel="stylesheet" type="text/css" href="PHJL-WEB-Estilo-paginas.css">
		
		<!-- Arquivos js -->
		<script src="../../../Estaticos/Bootstrap/js/jquery-3.2.1.js" type="text/javascript"></script>
		<script src="../../../Estaticos/Bootstrap/js/popper.js" type="text/javascript"></script>
		<script src="../../../Estaticos/Bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="PHJL-WEB-Lancar-presenca-diario.js?v=2" defer></script>

		<!-- Fontes e icones -->
		<link href="https://fonts.googleapis.com/css?family=Abel|Inconsolata" rel="stylesheet">
		<link href="../../../Estaticos/Bootstrap/css/nucleo-icons.css" rel="stylesheet">
		
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
  		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	
	<!--Chama a funcao com o evento onload para carregar a tabela assim que o body for gerado -->
	<body>
		
		<div class="wrapper">
			<div class="section landing-section">
				<div class="container">
					<div class="row">
						<div class="col-md-8 ml-auto mr-auto">
							<h2 class="text-center"> LAN&Ccedil;AR PRESEN&Ccedil;A </h2>
							<?php 
								$alunos = array();
								$faltas = array();
							
								echo "<h2 class = 'fonteCabecalho'> Disciplina de " .$linhaDisciplina[2] ."</h2>";
								echo "<h3 class = 'fonteCabecalho'> $linhaConteudo[1]&ordm; Bimestre </h3>";
								echo "<h4 class = 'fonteCabecalho'> $linhaConteudo[3] </h4>";
								echo "<h4 class = 'fonteCabecalho'> Atividade : $linhaAtividade[2] </h4><br>";
								
								echo "<table class = 'table'>";
								echo "<tr><thead class = 'fonteTexto'>";
									echo "<th>Falta(s)</th>";
									echo "<th>Nome</th>";
								echo "</thead></tr>";
								
								while($linhaDiario = mysqli_fetch_array($result)){
									$sql = "SELECT * FROM matriculas WHERE id = " .$linhaDiario[2] ." AND ativo = 'S'";
									$result2 = mysqli_query($conn, $sql);
									$linhaMatricula = mysqli_fetch_array($result2);
									
									$sql = "SELECT * FROM alunos WHERE idCPF = " .$linhaMatricula[1] ." AND ativo = 'S'";
									$result2 = mysqli_query($conn, $sql);
									
									$linhaAluno = mysqli_fetch_array($result2);
									echo "<tr><td class = 'fonteTexto'><div class='col-4'>";
									echo "<input class='form-control' type = 'number' name = '$linhaAluno[0]' id = 'ID$linhaAluno[0]' value = '$linhaDiario[4]' min = '0' max = '2' required>";
									echo "</div></td>";
									echo "<td class = 'fonteTexto'>$linhaAluno[2]</td></tr>";
									
									array_push($alunos, "ID$linhaAluno[0]");
								}
								echo "</table>";
								echo "<input type = 'button' class='btn btn-info btn-round' onclick = 'checaInputs(" .json_encode($alunos) .")' value = 'Salvar'>";
								echo "&nbsp;&nbsp;&nbsp;&nbsp;<input type = 'button' class='btn btn-info btn-round' onclick = 'voltaPagina(\"PHJL-WEB-Mostrar-conteudo\")' value = 'Voltar'>";

							?>
						</div>
					</div>
				</div>
				
				
			</div>	
		</div>
		
		<!-- Modal para ser exibido caso o lançamento de presença ocorra com sucesso -->
		<div class="modal fade" id="alertaSUCESSO" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">                        	
						<h5 class="modal-title text-center">RESULTADO</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						A presen&ccedil;a foi lan&ccedil;ada com sucesso !
					</div>
				</div>
			</div>
		</div>
		
		<!-- Modal para ser exibido caso o lançamento de presença ocorra com falha -->
		<div class="modal fade" id="alertaERRO" tabindex="-1" role="dialog">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">                        	
						<h5 class="modal-title text-center">RESULTADO</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						Erro ao lan&ccedil;ar presen&ccedil;a !
					</div>
				</div>
			</div>
		</div>
	</body>
</html>