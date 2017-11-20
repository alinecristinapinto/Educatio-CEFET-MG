<?php  

	ini_set('default_charset','UTF-8');

	$strNomeServer = "localhost";
	$strNomeUsuario = "root";
	$strSenha = null;
	$strDBnome = "Educatio";

	//recebe o CPF do Form
	@$intCPF = $_POST['CPF'];

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
	<title>Transferência de Aluno</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
	<!-- CSS do Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet" />
	<link href="css/bootstrap.css" rel="stylesheet"/>

	<!-- CSS do grupo -->
	<link href="css/CSSGrupo.css" rel="stylesheet" />

	<!-- Arquivos js -->
	<script src="js/popper.js"></script>
	<script src="js/jquery-3.2.1.js" type="text/javascript"></script>
	<script src="https://code.jquery.com/jquery-3.1.1.js"></script>
	<script src="js/bootstrap.min.js" type="text/javascript"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.quicksearch/2.3.1/jquery.quicksearch.js"></script>

	<!-- Fontes e icones -->
	<link href="css/nucleo-icons.css" rel="stylesheet">

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
				$strSQL = $conn->query("SELECT idCPF, nome FROM `Educatio`.`alunos`");
				while($arrLinha = $strSQL->fetch_assoc()) {
					echo "<tr value='".$arrLinha['idCPF']."' onclick('document.getElementById('txt_consulta').value = document.getElementById(this).innerHTML')><th>".$arrLinha['idCPF']."</th><td>".$arrLinha['nome']."</td></tr>";
				}
				echo "</table>";
				?>

				<script>
 					$('input#txt_consulta').quicksearch('table#tabela tbody tr');
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
			} else {
				echo "<script>alert('Erro transferindo Aluno: ".$conn->error."');</script>";
			} 		
		} else if (@mysqli_num_rows($conn->query("SELECT nome FROM `Educatio`.`alunos` WHERE nome = '".$strAluno."'")) != 0){
	  		//Parametro em SQL
	  		@$sql = "UPDATE `Educatio`.`alunos` SET ativo = 'N' WHERE nome = '".$strAluno."'";

			//Verifica se o Departamento foi "excluido"
			if ($conn->query($sql) === TRUE) {
				echo "<script>alert('Aluno tranferido com sucesso');</script>";
			} else {
				echo "<script>alert('Erro transferindo Aluno: ".$conn->error."');</script>";
			} 		
		} else {
			echo "<script>alert('Não foi Encontrado Nenhum Aluno Relacionado a essa Informação.');</script>";
		}
	}
	
	//Fecha a conexão
	$conn->close();

?>
