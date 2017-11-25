<!DOCTYPE html>
<?php 
	header('content-type: text/html; charset=ISO-8859-1');

	//constantes utilizadas na conexão com o banco de dados
	define ("SERVIDOR", "localhost");
	define ("USUARIO", "root");
	define ("SENHA", "");
	define ("BD", "educatio");
	
	//conexao com o BD
	$conn = mysqli_connect (SERVIDOR, USUARIO, SENHA);
	
	//Seleciona o BD
	$bd_select = mysqli_select_db ($conn, BD);
?>
<html>
	<head>

		<meta charset="utf-8" />
		<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
		<meta name="viewport" content="width=device-width" />
	
		<!-- TITULO E LOGO DA PAGINA  -->
		<title> Pesquisar por um aluno - Altera&ccedil;&atilde;o</title>
		<link rel="shortcut icon" href="imagens/logo.png">
		
		<!-- CSS do Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet" />
		<link href="css/bootstrap.css" rel="stylesheet"/>
		<link href="Rodape-Web/gerencia-web-estilos-rodape.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="PHJL-WEB-Estilo-paginas.css">
		<!-- Arquivos js -->
		<script src="js/jquery-3.2.1.js" type="text/javascript"></script>
		<script src="js/bootstrap.min.js" type="text/javascript"></script>
		<script src="PHJL-WEB-Funcoes-pesquisa-aluno.js?v=1" defer></script>

		<!-- Fontes e icones -->
		<link href="https://fonts.googleapis.com/css?family=Abel|Inconsolata" rel="stylesheet">
		<link href="css/nucleo-icons.css" rel="stylesheet">
		
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
  		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<base target="_parent">
	</head>
	
	<!--Chama a funcao com o evento onload para carregar a tabela assim que o body for gerado -->
	<body onload = "mostraAlunos() ; escondeSelects()">
		
		<div class="wrapper">
			<div class="section landing-section">
				<div class="container">
					<div class="row">
						<div class="col-md-8 ml-auto mr-auto">
							<h2 class="text-center">ALTERA&Ccedil;&Atilde;O DE ALUNO</h2>
							
							<form class="contact-form" method = "POST" action = "PHJL-WEB-Deletar-alunos.php" id="formulario">
								<div class = "row">
									<label class = "fonteTexto">Selecione o Campus do aluno</label>
									<div class = "input-group">
										<span class="input-group-addon">
											<i class="nc-icon nc-image"></i>
										</span>
										<select class="form-control" name="entradaCampus" class="form-control" onchange = "mostrarSelects('campi', this.value) ; mudaFiltro('campi', this.value) ; mostraAlunos()" 
										id = "entradaCampusID">
											<option selected value = "0"> Selecione um Campus </option>
											<?php
												$sql = "SELECT * FROM campi";
												$result = mysqli_query($conn, $sql);
												while($linhaCampus = mysqli_fetch_array($result)){
													echo "<option value = " .$linhaCampus[0] .">" .$linhaCampus[1] ."</option>";
												}
											?>
										</select>
									</div>
								</div>
								
								<div class="row" id = "entradaDeptoDIVID">
									<label class="fonteTexto">Departamento</label>
									<div class="input-group">
										<span class="input-group-addon">
											<i class="nc-icon nc-image"></i>
										</span>
										<select class="form-control" name="entradaDepto" class="form-control" onchange = "mostrarSelects('deptos', this.value) ; mudaFiltro('deptos', this.value) ; mostraAlunos()"
										id = "entradaDeptoID">
										</select>
									</div>
								</div> 
								
								<div class="row" id = "entradaCursoDIVID">
									<label class="fonteTexto">Curso</label>
									<div class="input-group">
										<span class="input-group-addon">
											<i class="nc-icon nc-image"></i>
										</span>
										<select class="form-control" name="entradaCurso" class="form-control" onchange = "mostrarSelects('cursos', this.value) ; mudaFiltro('cursos', this.value) ; mostraAlunos()" 
										id = "entradaCursoID">
										</select>
									</div>
								</div> 
								
								<div class="row" id = "entradaTurmaDIVID">
									<label class="fonteTexto">Turma</label>
									<div class="input-group">
										<span class="input-group-addon">
											<i class="nc-icon nc-image"></i>
										</span>
										<select class="form-control" name="entradaTurma" class="form-control" onchange = "mudaFiltro('turmas', this.value) ; mostraAlunos()" 
										id = "entradaTurmaID">
										</select>
									</div>
								</div> 
								
								
								<div class="row">
									<label class="fonteTexto">Pesquisar por nome</label>
									<div class="input-group">
										<span class="input-group-addon">
											<i class="nc-icon nc-circle-10"></i>
										</span>
										<input type="text" class="form-control" placeholder="Digite o nome" name = "entradaNome" id = "entradaNomeID"
										onfocus = "Apaga('entradaCPFID') ; mudaTipoInput('nome') ; mostraAlunos()" onkeyup="mostraAlunos()">
									</div>
								</div>
								
								<div class="row">
									<label class="fonteTexto">Pesquisar por CPF</label>
									<div class="input-group">
										<span class="input-group-addon">
											<i class="nc-icon nc-circle-10"></i>
										</span>
										<input type="text" class="form-control" placeholder="Digite o cpf" name = "entradaCPF" id = "entradaCPFID"
										onfocus = "Apaga('entradaNomeID') ; mudaTipoInput('cpf') ; mostraAlunos()" onkeyup="mostraAlunos()">
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