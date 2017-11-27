<?php  

/*Grupo Felipe, Juliana, Carlos;
Autor Felipe Linhares;
Seleção de notas por aluno/ano 1
*/

	ini_set('default_charset','UTF-8');

	$strNomeServer = "localhost";
	$strNomeUsuario = "root";
	$strSenha = "usbw";
	$strDBnome = "Educatio";

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
	<title>Seleção de notas</title>
  	<meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  	<link href="https://fonts.googleapis.com/css?family=Abel|Inconsolata" rel="stylesheet">

	<!-- CSS do Bootstrap -->

	<!-- CSS do grupo -->
	<link href="../Opcoes-do-sistema/Relatorios/relatorio-10-notas-alunos/CJF-web-estilos.css" rel="stylesheet" type="text/css" >

	<!-- Arquivos js -->
	<script src="https://code.jquery.com/jquery-3.1.1.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.quicksearch/2.3.1/jquery.quicksearch.js"></script>

	<!-- Fontes e icones -->
</head>
<body>
	<!-- <div class="section landing-section"> -->
		<div class="container">
			<div class="row">
				<div class="col-md-8 ml-auto mr-auto">
					<h2 class="text-center">Seleção de notas</h2>	
					<form method='post' action='../Opcoes-do-sistema/Relatorios/relatorio-10-notas-alunos/CJF-SelecaoNotas2.php' class="contact-form">	
						<div class="col-md-6">
							<label class="fonteTexto">Digite o nome ou o CPF do Aluno COMPLETO: </label>
							<div class="input-group">
								<span class="input-group-addon"><i class="nc-icon nc-single-02"></i></span>
								<!-- Recebe o nome/cpf -->
								<input type="text" name="aluno" id="txt_consulta" placeholder="CPF ou Nome do Aluno" class="form-control" required='required'>
							</div>	
							<table class='table table-hover' id="tabela">
								<?php
								//Tabela de Pesquisa
								$strSQL = $conn->query("SELECT idCPF, nome FROM `Educatio`.`alunos`");
								while($arrLinha = $strSQL->fetch_assoc()) {
									echo "<tr value='".$arrLinha['idCPF']."' onclick('document.getElementById('txt_consulta').value = document.getElementById(this).innerHTML')><th>".$arrLinha['idCPF']."</th><td>".utf8_encode($arrLinha['nome'])."</td></tr>";
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
							<label class="fonteTexto">Digite o ano: </label>
							<div class="input-group">
								<span class="input-group-addon">
									<i class="nc-icon nc-single-02"></i>
								</span>
								<!-- recebe o ano -->
								<input type="text" class="form-control" name='ano' placeholder="Ano" required='required'>
							</div>
							<input class="btn btn-info btn-round" type='submit' value='Exibir'>
							<br>
						</div>
					</form>
				</div>	
			</div>	
		</div>	
	<!-- </div>	 -->
</body>
</html>