

<?php
	session_start();
	//constantes utilizadas na conexão com o banco de dados
	define ("SERVIDOR", "localhost");
	define ("USUARIO", "root");
	define ("SENHA", "");
	define ("BD", "educatio");
	
	if(isset($_POST["idTURMA"])){
		$_SESSION["IDTURMA"] = $_POST["idTURMA"];
	}
	
	define ("IDPROF", $_SESSION["IDPROF"]);
	define ("IDTURMA", $_SESSION["IDTURMA"]);
	
	//conexao com o BD
	$conn = mysqli_connect (SERVIDOR, USUARIO, SENHA);
	//Seleciona o BD
	$bd_select = mysqli_select_db ($conn, BD);
	//seleciona a linha em que o idCPF for igual ao CPF recebido
	$sql = "SELECT * FROM profdisciplinas WHERE idProfessor = " .IDPROF;
	$result = mysqli_query($conn,$sql);
	
	$linha = mysqli_fetch_array($result);
	$sql = "SELECT * FROM turmas WHERE id = " .$linha[3];
	$result = mysqli_query($conn,$sql);
	
	$linhaTurma = mysqli_fetch_array($result);
	$sql = "SELECT * FROM disciplinas WHERE idTurma = " .$linhaTurma[0];
	$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
		<meta name="viewport" content="width=device-width" />
	
		<!-- TITULO E LOGO DA PAGINA  -->
		<title> Acessar diário - Professor </title>
		<link rel="shortcut icon" href="imagens/logo.png">
		
		<!-- CSS do Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet" />
		<link href="css/bootstrap.css" rel="stylesheet"/>
		<link href="Rodape-Web/gerencia-web-estilos-rodape.css" rel="stylesheet">
		<!--<link rel="stylesheet" type="text/css" href="PHJL-WEB-Formulario-de-insercao-de-aluno.css">-->

		<!-- Arquivos js -->
		<script src="js/jquery-3.2.1.js" type="text/javascript"></script>
		<script src="js/bootstrap.min.js" type="text/javascript"></script>
		<script src="PHJL-WEB-Formulario-de-insercao-de-alunos.js" defer></script>
		<!-- Função para ir para a próxima página -->
		<script>	
			function EnviarID(ID){
				location.href = "PHJL-WEB-Diario-prof.php?ID=" +ID;
			}
		</script>

		<!-- Fontes e icones -->
		<link href="https://fonts.googleapis.com/css?family=Abel|Inconsolata" rel="stylesheet">
		<link href="css/nucleo-icons.css" rel="stylesheet">
		
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
  		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<style type="text/css">
			.text-center{
			   font-family: 'Abel', sans-serif;
			   color: #d8ac29;
			}
			.fonteTexto{
			   font-family: 'Inconsolata', monospace;
			   font-size: 16px;
			}
			.btn-info {
			  background-color: #162e87;
			  border-color: #162e87;
			  color: #FFFFFF;
			  opacity: 1;
			  filter: alpha(opacity=100);
			}
			.btn-info:hover, .btn-info:focus, .btn-info:active, .btn-info.active, .show > .btn-info.dropdown-toggle {
			  background-color: #11277a;
			  color: #FFFFFF;
			  border-color: #11277a;
			}
		</style>
	</head>
	
	<!--Chama a funcao com o evento onload para carregar a tabela assim que o body for gerado -->
	<body onload = "escreveNomes('')">
		
		<div class="wrapper">
			<div class="section landing-section">
				<div class="container">
					<div class="row">
						<div class="col-md-8 ml-auto mr-auto">
							<h2 class="text-center">ACESSAR DIÁRIO</h2>
							<table class="table table-hover">
							<?php
							    echo "<thead>";
                                echo "<tr>";
								echo "<th>Nomes</th>";
								echo "<th>ID disciplina</th>";
								echo "</tr>";
								echo "</thead>";
								echo "<tbody>";

								while($linhaDisciplina = mysqli_fetch_array($result)){
      								echo "<tr onclick=\"EnviarID('" .$linhaDisciplina[0] ."')\">";
									echo "<td>" .$linhaDisciplina[2] ."</td>";
									echo "<td>" .$linhaDisciplina[0] ."</td>";
                                    echo "</tr>";
								}
								echo "</tbody>";
							?>
							</table>
							<br>
						</div>
					</div>
				</div>
			</div>	
		</div>
	</body>
</html>