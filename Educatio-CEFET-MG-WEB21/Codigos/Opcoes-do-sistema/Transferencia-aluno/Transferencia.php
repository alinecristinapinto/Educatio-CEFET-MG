<?php  

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

	//Variável para verificar o Campus dos departamentos
	$strTurma = $_GET['strTurma'];
	$strSQL = $conn->query("SELECT id, nome FROM `Educatio`.`turmas` WHERE nome ='".$strTurma."'");
	while($arrLinha = $strSQL->fetch_assoc()) {
		$intIdTurma = $arrLinha['id'];
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Transferência de Aluno</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
	<!-- CSS do Bootstrap -->
  	<link href="../../../Estaticos/Bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  	<link href="../../../Estaticos/Bootstrap/css/bootstrap.css" rel="stylesheet"/>

    <!-- CSS do grupo -->
  	<link href="CSSGrupo.css" rel="stylesheet" />

  	<!-- Arquivos js -->
  	<script src="../../../Estaticos/Bootstrap/js/popper.js"></script>
  	<script src="../../../Estaticos/Bootstrap/js/jquery-3.2.1.js" type="text/javascript"></script>
  	<script src="../../../Estaticos/Bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

  	<!-- js do grupo -->
 	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.quicksearch/2.3.1/jquery.quicksearch.js"></script>

  	<!-- Fontes e icones -->
  	<link href="../../../Estaticos/Bootstrap/css/nucleo-icons.css" rel="stylesheet">
  	<link href="https://fonts.googleapis.com/css?family=Abel|Inconsolata" rel="stylesheet">

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
<body>

<div class="wrapper">
	<div class="container">
		<div class="col-md-8 ml-auto mr-auto">

			<h1 class="text-center">Transferência de Aluno</h1>

			<form method="POST" action="" class="contact-form">
								
				<div class="input-group">
					<span class="input-group-addon"><i class="nc-icon nc-single-02"></i></span>	
						<input type="text" name="aluno" id="txt_consulta" placeholder="Digite o CPF ou o Nome do Aluno" class="form-control" required='required'>
				</div>

				<table class='table table-hover' id="tabela">
				<?php
				//Tabela de Pesquisa
				$strSQL = $conn->query("SELECT idCPF, nome, ativo FROM `Educatio`.`alunos` WHERE idTurma = '".$intIdTurma."'");
				while($arrLinha = $strSQL->fetch_assoc()) {
					if($arrLinha['ativo'] != 'N'){
						echo "<tr value='".$arrLinha['nome']."' onclick('document.getElementById('txt_consulta').value = document.getElementById(this).innerHTML')><th>".$arrLinha['idCPF']."</th><td>".$arrLinha['nome']."</td></tr>";
					}
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

				<div class="row">
					<div class="col-md-4 ml-auto mr-auto">
						<input type="submit" name="Transferir" value="Transferir" class="btn btn-info btn-round">
					</div>
				</div>	
							
			</form>	
		</div>
	</div>
</div>

</body>
</html>

<?php

	//Verifica se o botão Transferir foi clicado
	if (isset($_POST['Transferir'])) {

		$strAluno = $_POST['aluno'];

		//Verifica se existe algum aluno com o CPF digitado
		if (@mysqli_num_rows($conn->query("SELECT idCPF FROM `Educatio`.`alunos` WHERE idCPF = '".$strAluno."'")) != 0) {
			//Parametro em SQL
			@$sql = "UPDATE `Educatio`.`alunos` SET ativo = 'N' WHERE idCPF = '".$strAluno."'";

			//Verifica se o Departamento foi "excluido"
			if ($conn->query($sql) === TRUE) {
				echo "<script>alert('Aluno tranferido com sucesso');</script>";
				header("location: JHJ-web-relatorio7-historico-6.php?cpfAluno=".$strAluno);
			} else {
				echo "<script>alert('Erro transferindo o Aluno');</script>";
			} 		
		} else if (@mysqli_num_rows($conn->query("SELECT nome FROM `Educatio`.`alunos` WHERE nome = '".$strAluno."'")) != 0){
	  		//Parametro em SQL
	  		@$sql = "UPDATE `Educatio`.`alunos` SET ativo = 'N' WHERE nome = '".$strAluno."'";

			//Verifica se o Departamento foi "excluido"
			if ($conn->query($sql) === TRUE) {
				echo "<script>alert('Aluno tranferido com sucesso');</script>";
				$strSQL1 = $conn->query("SELECT idCPF FROM `Educatio`.`alunos` WHERE nome = '".$strAluno."'");
				while($arrLinha1 = $strSQL1->fetch_assoc()) {
					$strAlunoCpf = $arrLinha1['idCPF'];
				}
				echo "<script>
					location.href = '../Relatorios/relatorio-7-historico/JHJ-web-relatorio7-historico-6.php?cpfAluno=".$strAlunoCpf."';
				</script>";
				//header("location: JHJ-web-relatorio7-historico-6.php?cpfAluno=".$strAlunoCpf);
			} else {
				echo "<script>alert('Erro transferindo o Aluno');</script>";
			} 		
		} else {
			echo "<script>alert('Não foi Encontrado Nenhum Aluno Relacionado a essa Informação.');</script>";
		}
	}
	
	//Fecha a conexão
	$conn->close();

?>
