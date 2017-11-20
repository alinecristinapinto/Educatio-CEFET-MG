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

		<link href="css/bootstrap.min.css" rel="stylesheet" />
        <link href="css/bootstrap.css" rel="stylesheet"/>
        <link href="Rodape-Web/gerencia-web-estilos-rodape.css" rel="stylesheet">

		<!-- SCRIPTS -->
		<script src="js/jquery.min.js" defer></script>
		<script src="PHJL-WEB-Funcoes-pesquisa-aluno.js" defer></script>
		<script src="js/bootstrap.min.js" defer></script>

	</head>
	
	<!--Chama a funcao com o evento onload para carregar a tabela assim que o body for gerado -->
	<body onload = "escreveNomes('')">
		
		<div class="TamanhoDoFormulario">
			
			<div class="TituloDaPagina">
				<h1> DIÁRIO DO ALUNO</h1>
			</div>
			
			<form method = "POST" action = "PHJL-WEB-Diario-aluno.php" id="formulario">
				
				<!-- Input para pesquisar pelo CPF do aluno -->
				<section class = "TamanhoDosCampos" id = "DIVentradaCPFID">
					<span> Pesquisar por CPF</span>
					<input type = "text" class = "form-control" name = "entradaCPF" id = "entradaCPFID" placeholder = "Apenas numeros" 
					onfocus = "Apaga('entradaNomeID') ; escreveNomes(this.value)" onkeyup="mostraAlunos(this.value,'cpf')">
				</section>
				
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