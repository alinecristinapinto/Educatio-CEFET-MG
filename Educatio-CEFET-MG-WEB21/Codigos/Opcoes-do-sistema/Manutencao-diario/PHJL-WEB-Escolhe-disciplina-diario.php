

<?php
	session_start();
	header('content-type: text/html; charset=ISO-8859-1');
	//constantes utilizadas na conexão com o banco de dados
	define ("SERVIDOR", "localhost");
	define ("USUARIO", "root");
	define ("SENHA", "usbw");
	define ("BD", "educatio");
	
	if(isset($_GET["idTURMA"])){
		$_SESSION["IDTURMA"] = $_GET["idTURMA"];
	}
	
	$usuario = $_SESSION['usuario'];

	define ("IDPROF", $usuario['idSIAPE']);
	define ("IDTURMA", $_SESSION["IDTURMA"]);
	
	//conexao com o BD
	$conn = mysqli_connect (SERVIDOR, USUARIO, SENHA);
	//Seleciona o BD
	$bd_select = mysqli_select_db ($conn, BD);
	//seleciona a linha em que o idCPF for igual ao CPF recebido
	$sql = "SELECT * FROM profdisciplinas WHERE idProfessor = " .IDPROF;
	$resultProf = mysqli_query($conn,$sql);
	$linhaProf = mysqli_fetch_array($resultProf);
	
	$sql = "SELECT * FROM turmas WHERE id = " .$linhaProf[3];
	$resultTurma = mysqli_query($conn,$sql);
	
	$linhaTurma = mysqli_fetch_array($resultTurma);
	$sql = "SELECT * FROM disciplinas WHERE idTurma = " .$linhaTurma[0] ." AND id = " .$linhaProf[2] ." AND ativo = 'S'";
	$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
		<meta name="viewport" content="width=device-width" />
	
		<!-- TITULO E LOGO DA PAGINA  -->
		<title> Acessar di&aacute;rio - Professor </title>
		<link rel="shortcut icon" href="imagens/logo.png">
		
		<!-- CSS do Bootstrap -->
		<link href="../../../Estaticos/Bootstrap/css/bootstrap.min.css" rel="stylesheet" />
		<link href="../../../Estaticos/Bootstrap/css/bootstrap.css" rel="stylesheet"/>
		<link rel="stylesheet" type="text/css" href="PHJL-WEB-Estilo-paginas.css">

		<!-- Arquivos js -->
		<script src="../../../Estaticos/Bootstrap/js/jquery-3.2.1.js" type="text/javascript"></script>
		<script src="../../../Estaticos/Bootstrap/js/popper.js" type="text/javascript"></script>
		<script src="../../../Estaticos/Bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="PHJL-WEB-Formulario-de-insercao-de-alunos.js" defer></script>

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
							<h2 class="text-center">ACESSAR DI&Aacute;RIO</h2>
							<br>
							<table class="table table-hover">
							<?php
							    echo "<thead class = 'fonteTexto'>";
                                echo "<tr>";
								echo "<th>ID disciplina</th>";
								echo "<th>Nomes</th>";
								echo "</tr>";
								echo "</thead>";
								echo "<tbody style = 'cursor : pointer;'>";

								while($linhaDisciplina = mysqli_fetch_array($result)){
      								echo "<tr onclick=\"EnviarID('" .$linhaDisciplina[0] ."')\">";
									echo "<td class = 'fonteTexto'>" .$linhaDisciplina[0] ."</td>";
									echo "<td class = 'fonteTexto'>" .$linhaDisciplina[2] ."</td>";
                                    echo "</tr>";
								}
								echo "</tbody>";
							?>
							</table>
							<br>
							<input type = 'button' class='btn btn-info btn-round' onclick = "voltaPagina('../../Entrada/gerencia-web-interface-professor.php?acao=acessarDiarios')" value = 'Voltar'>
						</div>
					</div>
				</div>
			</div>	
		</div>
		
		<!-- Função para ir para a próxima página e voltar à pagina anterior-->
		<script>	
			function EnviarID(ID){
				location.href = "PHJL-WEB-Diario-prof.php?idDISCIPLINA=" +ID;
			}
			
			function voltaPagina(pagina){
				document.location.href= pagina;
			}
		</script>
	</body>
</html>