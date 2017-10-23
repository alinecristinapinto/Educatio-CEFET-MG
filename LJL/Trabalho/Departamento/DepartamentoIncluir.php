<!DOCTYPE html>
<html>
<head>
	<title>Adicionar Depratamento</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body style="background-color: #000080">

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>

	<div class="container">
		<div class="col-md-6" align="center">
			<h1 align="center" style="color: white">Adicionar Novo Departamento</h1>
			<form action="" method="POST">
				<div class="form-group">
					<div class="input-group">
						<div class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></div>
						<input type="text" name="nome" placeholder="Nome" class="form-control input-lg"><br>
					</div>
					<br>
					<div class="input-group">
						<div class="input-group-addon"><span class="glyphicon glyphicon-education"></span></div>
						<input type="text" name="Idcampi" placeholder="ID-Campi" class="form-control input-lg"><br><br>
					</div>
					<br>
					<input type="submit" name="Incluir" value="Incluir" class="btn btn-lg btn-primary btn-block" style="border-color: white; background-color: #000080; color: white;">
				</div>
			</form>
		</div>
	</div>
</body>
</html>

<?php
header('charset=utf-8');

	$servername = "localhost";
	$username = "root";
	$password = null;
	$dbname = "educatio";
	
	//Recebe os Dados do Form
	@$Idcampi = $_POST['Idcampi'];
	@$nome = $_POST['nome'];

	$Id = 1;

	//Cria conexão
	$conn = new mysqli($servername, $username, $password);
	//Verifica conexão
	if ($conn->connect_error) {
   		die("Falha na conexão: " . $conn->connect_error."<br>");
	}

	//Verifica se o botão Incluir foi clicado
	if (isset($_POST['Incluir'])) {
		//Parametro de SQL  
		$sql = "INSERT INTO `Educatio`.`deptos` (idCampi, nome, ativo) VALUES ('".$Idcampi."', '".$nome."', 'S')";

		//Verifica se o Departamento foi criado com sucesso
		if ($conn->query($sql) === TRUE) {
    		echo "<script>alert('Deparatamento criado com sucesso')</script>";
		} else {
    		echo "<script>alert('Erro criando o Deparatamento: ".$conn->error."')</script>";
		}
	}
	
	//Fecha a conexão
	$conn->close();
?>