<?php  

/*Grupo Felipe, Juliana, Carlos;
Autor Felipe Linhares;
Seleção de Conteudos por etapa/disciplina 2
*/
	session_start();

	$strNomeServer = "localhost";
	$strNomeUsuario = "root";
	$strSenha = "usbw";
	$strDBnome = "Educatio";

	if (isset($_POST['turma'])) {
		$_SESSION['turma'] = $_POST['turma'];
	}
	


	//Cria conexão
	$conn = new mysqli($strNomeServer, $strNomeUsuario, $strSenha);
	//Verifica conexão
	if ($conn->connect_error) {
   		die("Falha na conexão: " . $conn->connect_error."<br>");
	}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Seleção de conteúdos</title>
  	<meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  	<link href="https://fonts.googleapis.com/css?family=Abel|Inconsolata" rel="stylesheet">

	<!-- CSS do Bootstrap -->
	<link href="../../../../Estaticos/Bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="../../../../Estaticos/Bootstrap/css/bootstrap.css" rel="stylesheet"/>

	<!-- CSS do grupo -->
	<link href="CJF-web-estilos.css" rel="stylesheet" type="text/css" >

	<!-- Arquivos js -->
	<script src="../../../../Estaticos/Bootstrap/js/popper.js"></script>
	<script src="../../../../Estaticos/Bootstrap/js/jquery-3.2.1.js" type="text/javascript"></script>
	<script src="https://code.jquery.com/jquery-3.1.1.js"></script>
	<script src="../../../../Estaticos/Bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.quicksearch/2.3.1/jquery.quicksearch.js"></script>

	<!-- Fontes e icones -->
	<link href="../../../../Estaticos/Bootstrap/css/nucleo-icons.css" rel="stylesheet">
</head>
<body>

		<div class="container">
			<div class="row">
				<div class="col-md-8 ml-auto mr-auto">
					<h2 class="text-center">Seleção de conteúdos</h2>
					<form method='post' action='CJF-SelecaoConteudos3.php' class="contact-form">
						<div class="col-md-6">
							<?php
							//informa a turma previamente designada
								echo "<label class='fontetexto'>ID da Turma Escolhida: ".$_SESSION['turma'].".</label>";
							?>
							<label class="fonteTexto">Digite o número da etapa: </label>
							<div class="input-group">
								<!-- Recebe a etapa -->
								<select class="custom-select" name='etapa'>
								<?php
								$strSQL = $conn->query("SELECT idOrdem FROM `Educatio`.`etapas`");
								while($arrLinha = $strSQL->fetch_assoc()) {
									echo "<option value='".$arrLinha['idOrdem']."'>".$arrLinha['idOrdem']."</option>";
								}
								?>
								</select>
							</div>
							<table class='table table-hover' id="tabela">
							<label class="fonteTexto">Digite o nome ou o ID da disciplina: </label>
							<div class="input-group">
								<span class="input-group-addon">
									<i class="nc-icon nc-globe-2"></i>
								</span>
								<!-- Recebe a disciplina -->
								<input type='textarea' class="form-control" name='disciplina' placeholder="Nome da disciplina" required='required' id='txt_consulta'>
							</div>
							<table class='table table-hover' id="tabela">
								<?php
								//Tabela de Pesquisa
								$turma = $_SESSION['turma'];
								$strSQL = $conn->query("SELECT id, nome FROM `Educatio`.`disciplinas` WHERE idTurma='$turma'");
								while($arrLinha = $strSQL->fetch_assoc()) {
									echo "<tr value='".$arrLinha['id']."' onclick('document.getElementById('txt_consulta').value = document.getElementById(this).innerHTML')><th>".$arrLinha['id']."</th><td>".utf8_encode($arrLinha['nome'])."</td></tr>";
								}
								echo "</table>";
								?>

								<!-- Filtro da Tabela -->
								<script>
				 					$('input#txt_consulta').quicksearch('table#tabela tbody tr');
								</script>
								
								<!-- Função de clique na tabela -->
								<script>
									$(document.getElementById("tabela")).ready(function() {
										$('tr').click(function () { 
											document.getElementById("txt_consulta").value = $(this).attr("value");
										});
									});
								</script>

							<input class="btn btn-info btn-round" type='submit' value='Exibir'>
						</div>
					</form>
				</div>
			</div>
		</div>				
				
</body>
</html>