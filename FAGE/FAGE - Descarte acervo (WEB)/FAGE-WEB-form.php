<!DOCTYPE html>
<html>
<head>
	
	
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	

	<!-- TITULO DA PAGINA -->
	<title> Alteração de dados</title>		
	<link rel="shortcut icon" href="imagens/logo.png">

	<!-- STYLES -->
	<link ​ href = "css/bootstrap.css"​ ​ rel = "stylesheet">
	

	<!-- SCRIPTS -->
	<script src="js/jquery.min.js" defer></script>
	<script src="FAGE-WEB-jstabela.js" defer></script>
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

</head>

<!--Chama a funcao com o evento onload para carregar a tabela assim que o body for gerado -->
<body onload = "escreveNomes('')">

	<div class="TamanhoDoFormulario">

		<div class="TituloDaPagina">
			<h1 class='text-center'>Descarte</h1>
		</div>

		<form method = "POST" action = "FAGE-WEB-Descarte.php" id="formulario">

			<!-- A funcao Apaga() serve para sempre que um input text for focado, o outro input text apagar, assim prevenindo erros -->
			<section class = "TamanhoDosCampos" id = "DIVentradaNomeID">
					<!-- Input para pesquisar pelo nome do aluno. A funcao escreveNomes() eh chamada sempre que ele for focado para assim enviar o valor "" 
						(nulo) e mostrar a tabela com todos os alunos. A funcao mostraAlunos() eh utilizada para escrever a tabela com os alunos pesquisados -->
						


						<div class='row'>
							<label class='fonteTexto'>Motivo</label>
							<div class='input-group'>
								<span class='input-group-addon'>
									<i class='nc-icon nc-alert-circle-i'></i>
								</span>
								<input type='text' name='mot' class='form-control' placeholder='motivo' required='required'>
							</div>
						</div>
						


					</section>
					<div class='row'>
						<label class='fonteTexto'>Nome do acervo</label>
						<div class='input-group'>
							<span class='input-group-addon'>
								<i class='nc-icon nc-book-bookmark'></i>
							</span>
							<input type = "text" class = "form-control"  id = "entradaNomeID" placeholder = "Digite o nome" 
							onfocus = "Apaga('entradaCPFID') ; escreveNomes(this.value)" onkeyup="mostraAlunos(this.value,'nome')">
						</div>
					</div>
					<!-- Input para pesquisar pelo CPF do aluno -->


				<!-- Input do tipo hidden utilizado para armazenar o id do acervo do aluno em que o usuario clicar, e entao ser enviado para a pagina 
					de alteracao -->
					<div class = "TamanhoDosCampos">
						<input type = "hidden" class = "form-control" name = "num" id = "valorCPFID" >

					</div>
					<br>
					<DIV class='row'>Selecione o Acervo que deseja deletar</DIV>
					<br>
					<!-- tabela com os alunos -->
					<div class = "TamanhoDosCampos">
						<table id="tabela" class = "table table-hover"></table>
					</div>	
					<br>
					<div class='row'>   
						<div class='col-md-4 ml-auto mr-auto'>
							<button class='btn btn-info btn-round' type="submit" name="fim" data-toggle='modal' data-target='#alerta'>Confirmar</button> 
						</div>
						<div class='col-md-4 ml-auto mr-auto'>
							<button class='btn btn-info btn-round' type="reset" name="d">redefinir</button>
						</div>
						<div class='col-md-4 ml-auto mr-auto'>
							<button class='btn btn-info btn-round' type="button" value="Voltar" onClick="history.go(-1)">voltar</button> 
						</div>
						
					</div>
				</div>
			</form>

		</div>

	</body>

	</html>