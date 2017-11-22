<!DOCTYPE html>
<html>
	<head>

		<meta charset = "UTF-8">

		<!-- TITULO DA PAGINA -->
		<title> Alteração de dados</title>		
		<link rel="shortcut icon" href="imagens/logo.png">

		<!-- STYLES -->
		<link ​ href = "css/bootstrap.css"​ ​ rel = "stylesheet">
		<link ​ href = "PHJL-WEB-Estilo-pesquisa-aluno.css"​ ​ rel = "stylesheet">

		<!-- SCRIPTS -->
		<script src="js/jquery.min.js" defer></script>
		<script src="js-tabela.js" defer></script>
		<script src="js/bootstrap.min.js" defer></script>
		<link href="css/bootstrap.min.css" rel="stylesheet" />
	<link href="css/bootstrap.css" rel="stylesheet"/>

	<!-- CSS do grupo -->
	 <link href="" rel="stylesheet" />

	<!-- Arquivos js -->
	<script src="js/popper.js"></script>
	<script src="js/jquery-3.2.1.js" type="text/javascript"></script>
	<script src="js/bootstrap.min.js" type="text/javascript"></script>

	<!-- Fontes e icones -->
	<link href="css/nucleo-icons.css" rel="stylesheet">
	<div class="container">

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

    <script type="text/javascript">
    	function enviaFormulario(valor){
				document.querySelector("#valorCPFID").value = valor;
				document.querySelector("#formulario").submit();
			}
			
			//funcao utilizada para apagar um input
			function Apaga(id){
				document.querySelector("#" +id).value = "";
			}
			
			//funcao utilizada para fazer uma requisicao a pagina ProcuraAlunos.php, esta que devolvera alguns dados de TODOS os alunos e estes dados 
			//serao mostrados na tabela
			function escreveNomes(str){
				if (str.length == 0){
					var xmlhttp = new XMLHttpRequest();
					xmlhttp.onreadystatechange = function() {
						if (this.readyState == 4 && this.status == 200) {
							document.getElementById("tabela").innerHTML = this.responseText;
						}
					};
					xmlhttp.open("GET", "tabelainteligentehtml.php", true);
					xmlhttp.send();
				}
			}''
			
			//funcao utilizada para fazer uma requisicao a pagina ProcuraAlunos.php, onde serao pesquisados os alunos que possuam 'str' em seu nome/cpf, 
			//e alguns dados desses alunos serao devolvidos e mostrados na tabela
			function mostraAlunos(str, tipo) {
				str = str.toString();
				if (str.length == 0) { 
					escreveNomes(str);
					return;
				} else {
					var xmlhttp = new XMLHttpRequest();
					xmlhttp.onreadystatechange = function() {
						if (this.readyState == 4 && this.status == 200) {
							document.getElementById("tabela").innerHTML = this.responseText;
						}
					};
					xmlhttp.open("GET", "tabelainteligentehtml.php" + str + "&tipo=" + tipo, true);
					xmlhttp.send();
				}
			}
    </script>

	</head>
	
	<!--Chama a funcao com o evento onload para carregar a tabela assim que o body for gerado -->
	<body onload = "escreveNomes('')">
		
		<div class="TamanhoDoFormulario">
			
			<div class="TituloDaPagina">
				<h1> ALTERAÇÃO DO ALUNO</h1>
			</div>
			
			<form method = "POST" action = "PHJL-WEB-Formulario-de-alteracao-de-aluno.php" id="formulario">
				
				<!-- A funcao Apaga() serve para sempre que um input text for focado, o outro input text apagar, assim prevenindo erros -->
				<section class = "TamanhoDosCampos" id = "DIVentradaNomeID">
					<!-- Input para pesquisar pelo nome do aluno. A funcao escreveNomes() eh chamada sempre que ele for focado para assim enviar o valor "" 
					(nulo) e mostrar a tabela com todos os alunos. A funcao mostraAlunos() eh utilizada para escrever a tabela com os alunos pesquisados -->
					<span> Pesquisar por nome</span>
					<input type = "text" class = "form-control" name = "entradaNome" id = "entradaNomeID" placeholder = "Digite o nome" 
					onfocus = "Apaga('entradaCPFID') ; escreveNomes(this.value)" onkeyup="mostraAlunos(this.value,'nome')">
					<p>
				</section>
				
				<!-- Input para pesquisar pelo CPF do aluno -->
				
				
				<!-- Input do tipo hidden utilizado para armazenar o numero de CPF do aluno em que o usuario clicar, e entao ser enviado para a pagina 
				de alteracao -->
				<div class = "TamanhoDosCampos">
					<input type = "hidden" class = "form-control" name = "valorCPF" id = "valorCPFID" >
				</div>
			</form>
			
			<!-- tabela com os alunos -->
			<div class = "TamanhoDosCampos">
				<table id="tabela" class = "table table-hover"></table>
			</div>	
			
		</div>
		
	</body>

</html>