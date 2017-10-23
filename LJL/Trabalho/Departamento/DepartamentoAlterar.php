<?php
header('charset=utf-8');

	$servername = "localhost";
	$username = "root";
	$password = null;
	$dbname = "Educatio";

	//Cria conexão
	$conn = new mysqli($servername, $username, $password);
	//Verifica conexão
	if ($conn->connect_error) {
   		die("Falha na conexão: " . $conn->connect_error."<br>");
	}
?> 
<!DOCTYPE html>
<html>
<head>
	<title>Alterar Departamento</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

</head>
<body style="background-color: #000080">

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>

	<div class="container">
		<div class="col-md-6" >
		<h1 align="center" style="color: white">Alterar Departamento</h1>
		<form method="POST" action="">	
			<div class="form-group">
				<div class="input-group">
					<div class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></div>
						<select name="Onde" class="form-control">
							<option>Selecione o Campus</option>
							<?php $sql = $conn->query("SELECT id, nome, idCampi FROM `Educatio`.`deptos`"); ?>	
							<?php while($linha = $sql->fetch_assoc()) { ?>
				 			<option value="<?php echo $linha['nome']?>"><?php echo "Departamento: ".$linha['nome']." - Campus: ".$linha['idCampi'] ?></option>
				 			<?php } ?>
						</select>
					</div>
					<br>
					<div class="input-group">
						<div class="input-group-addon"><span class="glyphicon glyphicon-tasks"></span></div>
							<select name="Opc" class="form-control">
								<option>O que Alterar</option>
								<option>Nome</option>
								<option>Id-Campi</option>
						</select>
					</div>
					<br>
					<input type="text" name="dado" placeholder="Digite o nome/ID-Campi a ser alterado" class="form-control input-lg"><br>
					<input type="submit" name="Alterar" value="Alterar" class="btn btn-lg btn-primary btn-block" style="border-color: white; background-color: #000080; color: white">
			</div>
		</form>
		</div>
	</div>
</body>
</html>

<?php
	
	//Recebe os Dados do Form 
	@$Opc = $_POST['Opc'];
	@$Onde = $_POST['Onde'];
	@$dado = $_POST['dado'];
 	
	if (isset($_POST['Alterar'])) {	
	  	//ALterar o Nome ou Id-campi
		if($Opc == "Nome"){
			$aux1 = "nome = '".$dado."' ";
		}else if($Opc == "Id-Campi"){
			$aux1 = "idCampi = ".$dado;
		}
				
		@$aux2 = " WHERE nome = '".$Onde."'";

		//Parametro de SQL
		@$sql = "UPDATE `Educatio`.`deptos` SET ".$aux1.$aux2;

		//Verifica se o Departamento foi alterado 
		if ($conn->query($sql) === TRUE) {
	    	echo "<script>alert('Deparatamento alterado com sucesso')</script>";
		} else {
	    	echo "<script>alert('Erro alterando o Deparatamento: ".$conn->error."')</script>";
		} 
	}
 	

	//Fecha a conexão
	$conn->close();
?>