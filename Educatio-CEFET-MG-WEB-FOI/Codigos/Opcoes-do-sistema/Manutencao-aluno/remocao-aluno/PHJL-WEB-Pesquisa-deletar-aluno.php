<!DOCTYPE html>
<?php 
	//header('content-type: text/html; charset=ISO-8859-1');

	//constantes utilizadas na conexão com o banco de dados
	define ("SERVIDOR", "localhost");
	define ("USUARIO", "root");
	define ("SENHA", "usbw");
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
		<link rel="stylesheet" type="text/css" href="../Opcoes-do-sistema/Manutencao-aluno/remocao-aluno/PHJL-WEB-Estilo-paginas.css">

		<!-- Arquivos js -->
		<!-- <script src="PHJL-WEB-Funcoes-pesquisa-aluno.js?v=1" defer></script> -->

		<!-- Fontes e icones -->
		<link href="https://fonts.googleapis.com/css?family=Abel|Inconsolata" rel="stylesheet">
		
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
  		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<base target="_parent">

		<script type="text/javascript">
			var valorFiltro = "";
			var tipoFiltro = "0";
			var tipoInput = "";
			
			function enviaFormulario(valor){
				document.querySelector("#valorCPFID").value = valor;
				document.querySelector("#formulario").submit();
			}
			
			//funcao utilizada para apagar um input
			function Apaga(id){
				document.querySelector("#" +id).value = "";
			}
			
			//funcao utilizada para fazer uma requisicao a pagina ProcuraAlunos.php, onde serao pesquisados os alunos que possuam 'str' em seu nome/cpf, 
			//e alguns dados desses alunos serao devolvidos e mostrados na tabela
			function mostraAlunos() {
				str = document.querySelector("#entradaNomeID").value + document.querySelector("#entradaCPFID").value;
				if(document.querySelector("#entradaNomeID"))
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						document.querySelector("#tabela").innerHTML = this.responseText;
					}
				};
				xmlhttp.open("GET", "../Opcoes-do-sistema/Manutencao-aluno/remocao-aluno/PHJL-WEB-Procura-alunos.php?q=" + str + "&tipo=" + tipoInput + "&valorfiltro=" + valorFiltro + "&tipofiltro=" + tipoFiltro, true);
				xmlhttp.send();
			}
			
			function mudaFiltro(tipo, valor){
				valorFiltro = valor;
				tipoFiltro = tipo;
			}
			
			function mudaTipoInput(tipo){
				tipoInput = tipo;
			}
			
			
		
			//Função para esconder os selects de : Departamento, Curso e Turma
			function escondeSelects(){
				document.querySelector("#entradaDeptoDIVID").style.display = "none";
				
				document.querySelector("#entradaCursoDIVID").style.display = "none";
				
				document.querySelector("#entradaTurmaDIVID").style.display = "none";
			}

			function mostrarSelects(valor, id){
				if(valor == "campi"){
					//Apaga os valores que estavam anteriormente no select de Departamento
					var tamanho = document.querySelector("#entradaDeptoID").options.length;
					for (var i = 0; i <= tamanho; i++) {
						document.querySelector("#entradaDeptoID").remove(0);
					}
					
					//Chama a função que pega os Departamentos do Campus selecionado e insere no select de Departamento
					retornaValores("#entradaDeptoID", valor, id);
					
					//Mostra o select de Departamento
					document.querySelector("#entradaDeptoDIVID").style.display = "block";
				
					//Esconde o select de Curso
					document.querySelector("#entradaCursoDIVID").style.display = "none";
					
					//Esconde o select de Turma
					document.querySelector("#entradaTurmaDIVID").style.display = "none";
				}else if(valor == "deptos"){
					//Aqui faço o mesmo que fiz acima, porém substituindo o select de Cursos.
					//Irá mostrar o select de Curso e esconder o de Turma.
					var tamanho = document.querySelector("#entradaCursoID").options.length;
					for (var i = 0; i <= tamanho; i++) {
						document.querySelector("#entradaCursoID").remove(0);
					}
					
					retornaValores("#entradaCursoID", valor, id);
					
					document.querySelector("#entradaCursoDIVID").style.display = "block";
				
					document.querySelector("#entradaTurmaDIVID").style.display = "none";
				}else if(valor == "cursos"){
					//Segue o mesmo padrão dos anteriores
					var tamanho = document.querySelector("#entradaTurmaID").options.length;
					for (var i = 0; i <= tamanho; i++) {
						document.querySelector("#entradaTurmaID").remove(0);
					}
					
					retornaValores("#entradaTurmaID", valor, id);
					
					document.querySelector("#entradaTurmaDIVID").style.display = "block";
				}
			}

			//Função para pedir o return de uma pagina PHP ( PHJL-WEB-Retorna-valor-dos-selects.php ) e inserí-lo no "inputid" relacionado.
			function retornaValores(inputid, valor, id){
				
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						document.querySelector(inputid).innerHTML = this.responseText;
					}
				};
				xmlhttp.open("GET", "../Opcoes-do-sistema/Manutencao-aluno/remocao-aluno/PHJL-WEB-Retorna-valor-dos-selects-alteracao.php?valor=" + valor + "&id=" +id , true);
				xmlhttp.send();
					
			}
		</script>
	</head>
	
	<!--Chama a funcao com o evento onload para carregar a tabela assim que o body for gerado -->
	<body onload = "mostraAlunos() ; escondeSelects()">
		
		<div class="wrapper">
			<!-- <div class="section landing-section"> -->
				<div class="container">
					<div class="row">
						<div class="col-md-8 ml-auto mr-auto">
							<h2 class="text-center">REMO&Ccedil;&Atilde;O DE ALUNO</h2>
							
							<form class="contact-form" method = "POST" action = "../Opcoes-do-sistema/Manutencao-aluno/remocao-aluno/PHJL-WEB-Deletar-alunos.php" id="formulario">
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
			<!-- </div>	 -->
		</div>
	</body>

</html>