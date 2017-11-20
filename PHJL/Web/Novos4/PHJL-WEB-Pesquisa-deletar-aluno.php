<!DOCTYPE html>
<?php 
	header('content-type: text/html; charset=ISO-8859-1');

?>
<html>
	<head>

		<meta charset="utf-8" />
		<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
		<meta name="viewport" content="width=device-width" />
	
		<!-- TITULO E LOGO DA PAGINA  -->
		<title> Pesquisar por um aluno - Deletar</title>
		<link rel="shortcut icon" href="imagens/logo.png">
		
		<!-- CSS do Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet" />
		<link href="css/bootstrap.css" rel="stylesheet"/>
		<link href="Rodape-Web/gerencia-web-estilos-rodape.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="PHJL-WEB-Estilo-paginas.css">
		
		<!-- Arquivos js -->
		<script src="js/jquery-3.2.1.js" type="text/javascript"></script>
		<script src="js/bootstrap.min.js" type="text/javascript"></script>
		<script src="PHJL-WEB-Funcoes-pesquisa-aluno.js" defer></script>

		<!-- Fontes e icones -->
		<link href="https://fonts.googleapis.com/css?family=Abel|Inconsolata" rel="stylesheet">
		<link href="css/nucleo-icons.css" rel="stylesheet">
		
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
  		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<base target="_parent">
	</head>
	
	<!--Chama a funcao com o evento onload para carregar a tabela assim que o body for gerado -->
	<body onload = "escreveNomes('')">
		
		<div class="wrapper">
			<div class="section landing-section">
				<div class="container">
					<div class="row">
						<div class="col-md-8 ml-auto mr-auto">
							<h2 class="text-center">DELETAR ALUNO</h2>
							
							<form class="contact-form" method = "POST" action = "PHJL-WEB-Deletar-alunos.php" id="formulario">
								<div class="row">
									<label class="fonteTexto">Pesquisar por nome</label>
									<div class="input-group">
										<span class="input-group-addon">
											<i class="nc-icon nc-circle-10"></i>
										</span>
										<input type="text" class="form-control" placeholder="Digite o nome" name = "entradaNome" id = "entradaNomeID"
										onfocus = "Apaga('entradaCPFID') ; escreveNomes(this.value)" onkeyup="mostraAlunos(this.value,'nome')">
									</div>
								</div>
								
								<div class="row">
									<label class="fonteTexto">Pesquisar por CPF</label>
									<div class="input-group">
										<span class="input-group-addon">
											<i class="nc-icon nc-circle-10"></i>
										</span>
										<input type="text" class="form-control" placeholder="Digite o cpf" name = "entradaCPF" id = "entradaCPFID"
										onfocus = "Apaga('entradaNomeID') ; escreveNomes(this.value)" onkeyup="mostraAlunos(this.value,'cpf')">
									</div>
								</div>
								
								<div class="row">
									<div class="input-group">
										<input type = "hidden" class = "form-control" name = "valorCPF" id = "valorCPFID" >
									</div>
								</div>
							</form>
							
							<div class = "row">
								<table id="tabela" class = "table table-hover"></table>
							</div>
						</div>
					</div>
				</div>
			</div>	
		</div>
	</body>

</html>

