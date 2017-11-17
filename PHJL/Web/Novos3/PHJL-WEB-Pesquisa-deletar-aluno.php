<!DOCTYPE html>
<html>
	<head>

		<meta charset="utf-8" />
		<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
		<meta name="viewport" content="width=device-width" />
	
		<!-- TITULO E LOGO DA PAGINA  -->
		<title> Pesquisar por um aluno - Deleção</title>
		<link rel="shortcut icon" href="imagens/logo.png">
		
		<!-- CSS do Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet" />
		<link href="css/bootstrap.css" rel="stylesheet"/>
		<link href="Rodape-Web/gerencia-web-estilos-rodape.css" rel="stylesheet">
		<!--<link rel="stylesheet" type="text/css" href="PHJL-WEB-Formulario-de-insercao-de-aluno.css">-->

		<!-- Arquivos js -->
		<script src="js/jquery-3.2.1.js" type="text/javascript"></script>
		<script src="js/bootstrap.min.js" type="text/javascript"></script>
		<script src="PHJL-WEB-Funcoes-pesquisa-aluno.js" defer></script>

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
							<h2 class="text-center">DELEÇÃO DE ALUNO</h2>
							
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
	</body>

</html>

