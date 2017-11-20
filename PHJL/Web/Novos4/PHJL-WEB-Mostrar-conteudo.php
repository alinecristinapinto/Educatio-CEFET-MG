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
	
	if(isset($_GET["conteudo"])){
		$_SESSION["IDCONTEUDO"] = $_GET["conteudo"];
		define ("IDCONTEUDO", $_SESSION["IDCONTEUDO"]);
	}else{
		define ("IDCONTEUDO", $_SESSION["IDCONTEUDO"]);
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
	
	$_SESSION["IDPROFDISCIPLINAS"] = $linhaProf[0];
	
	$sql = "SELECT * FROM conteudos WHERE id = " .IDCONTEUDO;
	$result = mysqli_query($conn, $sql);
	$linhaConteudo = mysqli_fetch_array($result);
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
		<link rel="stylesheet" type="text/css" href="PHJL-WEB-Estilo-paginas.css">
		
		<!-- Arquivos js -->
		<script src="js/jquery-3.2.1.js" type="text/javascript"></script>
		<script src="js/bootstrap.min.js" type="text/javascript"></script>
		<script src="PHJL-WEB-Funcoes-mostrar-conteudo.js" defer></script>

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
						<div class="col-md-8 ml-auto mr-auto">
							<h2 class="text-center">ACESSAR DIÁRIO</h2>
							<?php 
								$atividades = array();
							
								echo "<h2> DISCIPLINA DE " .$linhaDisciplina[2] ."</h2>";
								echo "<h3> $linhaConteudo[1]º Bimestre </h3>";
								echo "<h4> CONTEÚDO : $linhaConteudo[3] </h4>";
								
								$sql = "SELECT * FROM diarios WHERE idConteudo = $linhaConteudo[0]";
								$result = mysqli_query($conn, $sql);
								echo "<div id = 'DIVatividadesID'>";
								while($linhaDiario = mysqli_fetch_array($result)){
									if(in_array($linhaDiario[3], $atividades) == FALSE){
										$sql = "SELECT * FROM atividades WHERE id = $linhaDiario[3]";
										$result2 = mysqli_query($conn, $sql);
										$linhaAtividade = mysqli_fetch_array($result2);
										
										//echo "<span id = 'Atividade" .$linhaAtividade[0] ."ID' onclick = 'mostraAtividade(" .$linhaConteudo[0] .")'>" .$linhaConteudo[3] ."</span></br>";
										echo "<span id = 'Atividade" .$linhaAtividade[0] ."ID' >" .$linhaAtividade[2] ."&emsp;<a href='PHJL-WEB-Lancar-presenca-diario.php?idatividade=$linhaAtividade[0]' > + Presença </a></span></br>";
										/*
										echo "$linhaAtividade[2]&emsp;";
										echo "<a href='PHJL-WEB-Lancar-presenca-diario.php?idatividade=$linhaAtividade[0]' > + Presença </a> <br>";
										*/
										array_push($atividades, $linhaDiario[3]);
									}
								}
								echo "<span style = 'cursor : pointer;' id = 'novaAtividadeID' onclick = 'insereAtividade(this.id)'> + Adicionar Atividade </span></div>";
								
							?>
						</div>
					</div>
				</div>
			</div>	
		</div>
		
		
		<script>
			function insereAtividade(id){
				document.querySelector("#" +id).innerHTML = "<input type = 'text' name = 'entradaAtividade' id = 'entradaAtividadeID'> <input type = 'date' name = 'entradaDataAtividade' id = 'entradaDataAtividadeID'> <input type='number' name = 'entradaValorAtividade' id = 'entradaValorAtividadeID' step='0.01' min = '0'> <button id = 'botaoAdicionaID' class='btn btn-info btn-round' onclick = 'adicionaAtividadeBD(entradaAtividadeID, entradaDataAtividadeID, entradaValorAtividadeID)'> Adicionar </button>";
				document.querySelector("#" +id).onclick = null;
			}
			
			function adicionaAtividadeBD(id, dataid, valorid){
				var nomeAtividade = id.value;
				var idNovaAtividade = "novaAtividadeID";
				var valorData = dataid.value;
				var valorValor = valorid.value;
				
				$("#entradaAtividadeID").remove();
				$("#entradaDataAtividadeID").remove();
				$("#entradaValorAtividadeID").remove();
				$("#botaoAdicionaID").remove();
				$("#novaAtividadeID").remove();
				
				if (nomeAtividade.length != 0) {
					var xmlhttp = new XMLHttpRequest();
					xmlhttp.onreadystatechange = function() {
						if (this.readyState == 4 && this.status == 200) {
							document.querySelector("#DIVatividadesID").innerHTML += this.responseText;
						}
					};
					xmlhttp.open("GET", "PHJL-WEB-Insercao-de-atividade-no-BD.php?+atividade=" +nomeAtividade +"&data=" +valorData +"&valor=" +valorValor, true);
					xmlhttp.send();
				}

			}
		</script>
		
	</body>



</html>