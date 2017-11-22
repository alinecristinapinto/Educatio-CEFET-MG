<!DOCTYPE html>
<html>
<head>
	
	<!-- CSS do Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet" />
	<link href="css/bootstrap.css" rel="stylesheet"/>

	<!-- CSS do grupo -->
	 <link href="pagina_inicial.css" rel="stylesheet" />

	<!-- Arquivos js -->
	<script src="js/popper.js"></script>
	<script src="js/jquery-3.2.1.js" type="text/javascript"></script>
	<script src="js/bootstrap.min.js" type="text/javascript"></script>

	<!-- Fontes e icones -->
	<link href="css/nucleo-icons.css" rel="stylesheet">
	
	<script type="text/javascript">
		function func1(){
			window.location.href="form_professor.php"
		}
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

				var valor = document.getElementById("entradaDeptoID").value;
				

				if (str.length == 0){
					var xmlhttp = new XMLHttpRequest();
					xmlhttp.onreadystatechange = function() {
						if (this.readyState == 4 && this.status == 200) {
							document.getElementById("tabela").innerHTML = this.responseText;
						}
					};
					xmlhttp.open("GET", "tabela-descarte.php?q=mostrar" + "&depto=" + valor, true);
					xmlhttp.send();
				}
			}''

			function escreveNomes2(str){

				var valor = document.getElementById("entradaDeptoID").value;

				if (str.length == 0){
					var xmlhttp = new XMLHttpRequest();
					xmlhttp.onreadystatechange = function() {
						if (this.readyState == 4 && this.status == 200) {
							document.getElementById("tabela").innerHTML = this.responseText;
						}
					};
					xmlhttp.open("GET", "tabela-descarte.php?q=mostrar" + "&depto=" + valor, true);
					xmlhttp.send();
				}
			}''

			
			//funcao utilizada para fazer uma requisicao a pagina ProcuraAlunos.php, onde serao pesquisados os alunos que possuam 'str' em seu nome/cpf, 
			//e alguns dados desses alunos serao devolvidos e mostrados na tabela
			function mostraAlunos(str, tipo) {

				var valor = document.getElementById("entradaDeptoID").value;

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
					xmlhttp.open("GET", "tabela-descarte.php?q=" + str + "&tipo=" + tipo + "&depto=" + valor, true);
					xmlhttp.send();
				}
			}
function colocaPonto(u){
	if(u == 0){
		var str = document.querySelector("#entradaCPFID").value;
	
		if((str.length == 3) || (str.length == 7)){
		str += ".";
		document.querySelector("#entradaCPFID").value = str;
		}else if(str.length == 11){
		str += "-";
		document.querySelector("#entradaCPFID").value = str;
		}
	}
	if(u == 1){
		var str = document.querySelector("#entradaCEPID").value;
		if(str.length == 5){
		str += "-";
		document.querySelector("#entradaCEPID").value = str;
		}
	}								
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
	xmlhttp.open("GET", "PHJL-WEB-Retorna-valor-dos-selects.php?valor=" + valor + "&id=" +id , true);
	xmlhttp.send();
		
}
			
	</script>

	<title></title>
</head>
<body >

	<div class="wrapper">
		<div class="title" style="text-align: center;">
			<h1><b>Manutenção de Professores</b></h1>
		</div>
			<p id="p1">Crie, edite e exclua professores</p>
		<div class="container">
			<h5>Pesquise Professores</h5>
			<form method = "POST" action = "professor2.php" id="formulario">

			<div class="row">
				<div class="col">
				<select class="form-control" name="entradaCampus" class="form-control" onchange = 'mostrarSelects("campi", this.value)' 
					id = "entradaCampusID" required>
					<option disabled selected value = ""> Selecione um Campus </option>
                    <?php
                    $conn = mysqli_connect("localhost", "root", "", "educatio");
					if (!$conn) {
						die("Conexão falhou: " . mysqli_connect_error());
					}
						$sql = "SELECT * FROM campi";
						$result = mysqli_query($conn, $sql);
						while($linhaCampus = mysqli_fetch_array($result)){
							echo "<option value = " .$linhaCampus[0] .">" .$linhaCampus[1] ."</option>";
						}
					?>
				</select>
				</div>
				<div class="col">
				<select class="form-control" name="entradaDepto" class="form-control" onchange = "escreveNomes('')" 
									id = "entradaDeptoID" required>
									</select>
				</div>
			</div>


				<!-- A funcao Apaga() serve para sempre que um input text for focado, o outro input text apagar, assim prevenindo erros -->
				<section class = "TamanhoDosCampos" id = "DIVentradaNomeID">
					<!-- Input para pesquisar pelo nome do aluno. A funcao escreveNomes() eh chamada sempre que ele for focado para assim enviar o valor "" 
					(nulo) e mostrar a tabela com todos os alunos. A funcao mostraAlunos() eh utilizada para escrever a tabela com os alunos pesquisados -->
					<input type = "text" class = "form-control" name = "entradaNome" id = "entradaNomeID" placeholder = "Digite o nome" 
					onfocus = "Apaga('entradaCPFID') ; escreveNomes(this.value)" onkeyup="mostraAlunos(this.value,'nome')" style="margin-top: 2%;">
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
			<div class="row">
				<div class="col">
					<div class="card">
						<div class="card-body">	
							<h5 class="card-title">Crie um novo Professor</h5>
							<p>Cadastre um novo professor no sistema</p>
							<button type="button" onclick="func1()" id="botaocria" class="btn btn-neutral btn-lg">Criar Professor</button>
						</div>
					</div>
				</div>
				<div class="col">
					<div class="card">
						<div class="card-body">
							<h5 class="card-title">Edite Professores</h5>
							<p>Pesquise os professores existentes e edite suas propriedades como senha, ID siape, departamento ou titulação</p>
						</div>
					</div>
				</div>
				<div class="col">
					<div class="card">
						<div class="card-body">
							<h5 class="card-title">Exclua professores</h5>
							<p>Delete professores que você não quer mais no sistema, use a ferramenta de pesquisa e clique em excluir para deletar um professor</p>
						</div>
					</div>
				</div>	
			</div>
		</div>
	</div>

</body>
</html>