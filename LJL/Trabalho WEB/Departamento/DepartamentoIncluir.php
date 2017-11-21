<?php
	ini_set('default_charset','UTF-8');
	
	$strNomeServer = "localhost";
	$strNomeUsuario = "root";
	$strSenha = "";
	$strDBnome = "Educatio";

	//Cria conexão
	$conn = new mysqli($strNomeServer, $strNomeUsuario, $strSenha);
	//Verifica conexão
	if ($conn->connect_error) {
   		die("Falha na conexão: " . $conn->connect_error."<br>");
	}

	//Variável para verificar o Campus dos departamentos
	$strCampi = $_GET['strCampi'];
	$strSQL = $conn->query("SELECT id, nome FROM `Educatio`.`campi` WHERE nome ='".$strCampi."'");
	while($arrLinha = $strSQL->fetch_assoc()) {
		$intIdCampi = $arrLinha['id'];
	}
	
?>

<!DOCTYPE html>
<html>
<head>
	<title>Adicionar Depratamento</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
	<!-- CSS do Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet" />
	<link href="css/bootstrap.css" rel="stylesheet"/>

	<!-- CSS do grupo -->
	<link href="css/CSSGrupo.css" rel="stylesheet" />

	<!-- Arquivos js -->
	<script src="js/popper.js"></script>
	<script src="js/jquery-3.2.1.js" type="text/javascript"></script>
	<script src="js/bootstrap.min.js" type="text/javascript"></script>

	<!-- Fontes e icones -->
	<link href="css/nucleo-icons.css" rel="stylesheet">

</head>
<body>

<div class="wrapper">
	<div class="container">
		<div class="col-md-8 ml-auto mr-auto">

			<h1 class="text-center">Adicionar Novo Departamento</h1>
							
			<form action="" method="POST" class="contact-form">
				
				<div class="input-group">
					<span class="input-group-addon"><i class="nc-icon nc-bank"></i></span>				
						<input type="text" name="nome" placeholder="Nome" class="form-control" required='required'>
				</div>

				<div class="row">
					<div class="col-md-4 ml-auto mr-auto">
						<input type="submit" name="Incluir" value="Incluir" class="btn btn-info btn-round">
					</div>
				</div>	

			</form>

		</div>
	</div>
</div>

</body>
</html>

<?php

	//Recebe os Dados do Form
	@$strNome = $_POST['nome'];


	//Verifica se o botão Incluir foi clicado
	if (isset($_POST['Incluir'])) {
		//Verifica se o departamento já existe no BD
		if (mysqli_num_rows($conn->query("SELECT nome FROM `Educatio`.`deptos` WHERE nome= '".$strNome."' AND idCampi = '".$intIdCampi."'")) != 0) {
			echo "<script>alert('Um Deparatamento com esse nome já existe neste Campus')</script>";
		}else {
			//Parametro de SQL  
			$strSQL = "INSERT INTO `Educatio`.`deptos` (idCampi, nome, ativo) VALUES ('".$intIdCampi."', '".$strNome."', 'S')";

			//Verifica se o Departamento foi criado com sucesso
			if ($conn->query($strSQL) === TRUE) {
				echo "<script>alert('Deparatamento criado com sucesso')</script>";
			} else {
				echo "<script>alert('Erro criando o Deparatamento: ".$conn->error."')</script>";
			}
		}	
	}
	
	//Fecha a conexão
	$conn->close();
	
?>