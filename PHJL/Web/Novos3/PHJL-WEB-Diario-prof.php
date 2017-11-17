

<?php
	session_start();
	//constantes utilizadas na conexão com o banco de dados
	define ("SERVIDOR", "localhost");
	define ("USUARIO", "root");
	define ("SENHA", "");
	define ("BD", "educatio");
	
	if(isset($_POST["idDISCIPLINA"])){
		$_SESSION["IDDISCIPLINA"] = $_POST["idDISCIPLINA"];
	}
	define ("IDPROF", $_SESSION["IDPROF"]);
	define ("IDTURMA", $_SESSION["IDTURMA"]);
	define ("IDDISCIPLINA", $_SESSION["IDDISCIPLINA"]);
	
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
	<body>
		
		<div class="wrapper">
			<div class="section landing-section">
				<div class="container">
					<div class="row">
						<div class="col-md-8 ml-auto mr-auto" id = "pf">
							<h2 class="text-center">ACESSAR DIÁRIO</h2>
							<?php 
								echo "<h2> DISCIPLINA DE " .$linhaDisciplina[2] ."</h2>";
								
								for($numeroBim = 1; $numeroBim <= 4; $numeroBim++){
									$sql = "SELECT * FROM conteudos WHERE idDisciplina = " .$linhaDisciplina[0] ." AND idEtapa = " .$numeroBim;
									$result = mysqli_query($conn, $sql);
									
									echo "<div id = 'DIVbim" .$numeroBim ."ID'>";
									echo "<h3> Conteúdos do " .$numeroBim ."º Bimestre </h3>";
									while($linhaConteudo = mysqli_fetch_array($result)){
										echo "<span id = 'Conteudo" .$linhaConteudo[0] ."Bim" .$linhaConteudo[1] ."ID' onclick = 'mostraConteudo(" .$linhaConteudo[0] .")'>" .$linhaConteudo[3] ."</span></br>";
									}
									echo "<span style = 'cursor : pointer;' id = 'novoConteudoBim" .$numeroBim ."' onclick = 'insereConteudo(this.id, " .$numeroBim .", )'> + Adicionar Conteúdo </span>";
									echo "</div>";
								}
							?>
						</div>
					</div>
				</div>
			</div>	
		</div>
			
		<footer>
		<div id="rodape">
			<div class="container">
				<div class="row centralizado">
					<div class="col-md-4">
						<img src="Rodape-Web/prom.jpg" class="img-circle"><br>
						<h6><strong>Desenvolvedores</strong></h6>
						
						<p></span> Alunos da turma de Informática 2A 2017 do CEFET-MG.
						<a href="#">Clique aqui</a> para saber mais.</p>  
					</div>
					<div class="col-md-4">
				    	<img src="Rodape-Web/cefetop.png" class="img-circle"><br>
				    	<h6><strong>Instituição</strong></h6>
				    	<p>Centro Federal de Educação Tecnológica de Minas Gerais. Av. Amazonas 5253 -Nova                   Suíssa - Belo Horizonte - Brasil.</p>
        			</div>
        			<div class="col-md-4">
            			<img src="Rodape-Web/bootstrap.png" class="img-circle"><br>
            			<h6>Recursos Utilizados</h6>
            			<p>
					   	<a href="https://github.com/NinaCris16/Educatio-CEFET-MG">GitHub</a><br>
					   	<a href="http://getbootstrap.com/">Bootstrap</a><br>
					   	</p>
        			</div>
				</div>
			</div>
		</div>
	</footer>
	
	
		<script>
			
			function insereConteudo(id, numeroBim){
			document.querySelector("#" +id).innerHTML = "<input type = 'text' name = 'entradaConteudo" +numeroBim +"' id = 'entradaConteudo" +numeroBim +"ID'> <input type = 'date' name = 'entradaDataConteudo" +numeroBim +"' id = 'entradaDataConteudo" +numeroBim +"ID'> <button id = 'botaoAdicionaID' class='btn btn-info btn-round' onclick = 'adicionaConteudoBD(entradaConteudo" +numeroBim +"ID, " +numeroBim +", entradaDataConteudo" +numeroBim +"ID)'> Adicionar </button>";
				document.querySelector("#" +id).onclick = null;
			}
			
			function adicionaConteudoBD(id, numeroBim, dataid){
				var nomeConteudo = id.value;
				var idNovoConteudo = "novoConteudoBim" +numeroBim;
				var valorData = dataid.value;
				$("#entradaConteudo" +numeroBim +"ID").remove();
				$("#botaoAdicionaID").remove();
				$("#" +idNovoConteudo).remove();
				
				if (nomeConteudo.length != 0) {
					var xmlhttp = new XMLHttpRequest();
					xmlhttp.onreadystatechange = function() {
						if (this.readyState == 4 && this.status == 200) {
							document.querySelector("#DIVbim" +numeroBim +"ID").innerHTML += this.responseText;
						}
					};
					xmlhttp.open("GET", "PHJL-WEB-Insercao-de-conteudo-no-BD.php?conteudo=" +nomeConteudo +"&etapa=" +numeroBim +"&data=" +valorData, true);
					xmlhttp.send();
				}

			}
			
			function mostraConteudo(conteudo){
				location.href = "PHJL-WEB-Mostrar-conteudo?conteudo=" +conteudo;
			}
		</script>
	</body>
</html>