<!DOCTYPE html>
<html>
<head>

	<!-- CSS do Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet" />
	<link href="css/bootstrap.css" rel="stylesheet"/>

	<!-- CSS do grupo -->
	 <link href="formularios.css" rel="stylesheet" />

	<!-- Arquivos js -->
	<script src="js/popper.js"></script>
	<script src="js/jquery-3.2.1.js" type="text/javascript"></script>
	<script src="js/bootstrap.min.js" type="text/javascript"></script>

	<!-- Fontes e icones -->
	<link href="css/nucleo-icons.css" rel="stylesheet">
	

	<title></title>

	<script type="text/javascript">
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
</head>
<body>
 
<!-- 
2644B2
6989FF	
4F75FF 
d8ac29
-->


<div class="wrapper">
	<div class="title" style="text-align: center;">
		<h1><b>Manutenção de Professor</b></h1>
	</div>
		<p id="p1">Crie professores</p>

	<div class="container">
		<div class="head">
             <h2 class="text-center">Professor</h2>
        </div>
		<form class="contact-form" method="post" action="professor.php" enctype="multipart/form-data">
			<div class="container">
				<div class="row">
					<div class="col ml-auto mr-auto">
	       			<div class="col-md-12">
	         			<label class="fonteTexto">Nome:</label>
								<div class="input-group">
									<span class="input-group-addon">
										<i class="nc-icon nc-circle-10"></i>
									</span>
									<input type="text" class="form-control" placeholder="Nome do professor" required='required' name="nome" id="nome">
								</div>
				      </div>
					</div>
					<div class="col ml-auto mr-auto">
       			<div class="col-md-12">
         			<label class="fonteTexto">ID Siape:</label>
							<div class="input-group">
								<span class="input-group-addon">
									<i class="nc-icon nc-credit-card"></i>
								</span>
								<input type="text" name="siape" class="form-control" placeholder="ID Siape do professor" required='required' id="siape">
							</div>
			      </div>
					</div>	
				</div>

				<div class="row">
					<div class="col ml-auto mr-auto">
	       			<div class="col-md-12">
	         			<label class="fonteTexto">ID Campi:</label>
								<div class="input-group">
									<span class="input-group-addon">
										<i class="nc-icon nc-bookmark-2"></i>
									</span>
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
				      </div>
					</div>
					<div class="col ml-auto mr-auto">
       			<div class="col-md-12">
         			<label class="fonteTexto">Titulação:</label>
							<div class="input-group">
								<span class="input-group-addon">
									<i class="nc-icon nc-hat-3"></i>
								</span>
								 <select class="form-control" name="titulacao" class="form-control" 
								 required>
									<option disabled selected value = ""> Selecione a titulacao </option>
									<option>Graduação</option>
									<option>Mestrado</option>
									<option>Doutorado</option>
									<option>Pos Doutorado</option>                             
								</select>
							</div>
			      </div>
					</div>	
				</div>

				<div class="row">
					<div class="col ml-auto mr-auto">
	       			<div class="col-md-12">
	         			<label class="fonteTexto">Depto:</label>
								<div class="input-group">
									<span class="input-group-addon">
										<i class="nc-icon nc-lock-circle-open"></i>
									</span>
							  <select class="form-control" name="entradaDepto" class="form-control" onchange = '' onchange = 'mostrarSelects("deptos", this.value)' 
									id = "entradaDeptoID" required>
									</select>
								</div>
				      </div>
					</div>
					<div class="col ml-auto mr-auto">
       			<div class="col-md-12">
         			<label class="fonteTexto">Foto:</label>	
                        <input type="file" id="foto" name="foto" class="form-control" placeholder="Editora do livro" required='required'>
			      </div>
					</div>	
				</div>

				<div class="btn-group" role="group" aria-label="...">					
					<button type="submit" class="btn btn-neutral">Adicionar Professor</button>
				</div>
			</div>	
		</form>	
	</div>


</div>

</body>
</html>