<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">

		<!-- TITULO E LOGO DA PAGINA  -->
		<title>Deletar aluno</title>
		<link rel="shortcut icon" href="imagens/logo.png">
		
		<!-- STYLES -->
		<link ​ href = "css/bootstrap.css"​ ​ rel = "stylesheet">
		<link ​ href = "PHJL-WEB-Estilo-pesquisa-aluno.css"​ ​ rel = "stylesheet">

		<!-- SCRIPTS -->
		<script src="js/jquery.min.js" defer></script>
		<script src="PHJL-WEB-Funcoes-pesquisa-aluno.js" defer></script>
		<script src="js/bootstrap.min.js" defer></script>

	</head>
	
	<body onload = "escreveNomes('')">
		
		<div class="TamanhoDoFormulario">
			
			<div class="TituloDaPagina">
				<h1> DELETAR UM ALUNO</h1>
			</div>
			
			<form method = "POST" action = "PHJL-WEB-Deletar-alunos.php" id="formulario">
				
				<section class = "TamanhoDosCampos" id = "DIVentradaNomeID">
					<span>Pesquisar por nome</span>
					<input type = "text" class = "form-control" name = "entradaNome" id = "entradaNomeID" placeholder = "Digite o nome" 
					onfocus = "Apaga('entradaCPFID') ; escreveNomes(this.value)" onkeyup="showHint(this.value,'nome')">
					<p>
				</section>
				
				<section class = "TamanhoDosCampos" id = "DIVentradaCPFID">
					<span> Pesquisar por CPF</span>
					<input type = "text" class = "form-control" name = "entradaCPF" id = "entradaCPFID" placeholder = "Apenas numeros" 
					onfocus = "Apaga('entradaNomeID') ; escreveNomes(this.value)" onkeyup="showHint(this.value,'cpf')">
				</section>
				
				<div class = "TamanhoDosCampos">
					<input type = "hidden" class = "form-control" name = "valorCPF" id = "valorCPFID" >
				</div>
			</form>
			
			<div class = "TamanhoDosCampos">
				<table id="tabela" class = "table table-hover"></table>
			</div>	
			
		</div>
		
		
	</body>

</html>