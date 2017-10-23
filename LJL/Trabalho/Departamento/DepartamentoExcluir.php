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
	<title>Excluir Departamento</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body style="background-color: #000080">

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>

	<div class="container">
		<div class="col-md-6" >
			<h1 align="center" style="color: white">Excluir Departamento</h1>
			<form action="" method="POST">
				<div class="input-group">
					<div class="input-group-addon"><span class="glyphicon glyphicon-briefcase"></span></div>
					<select name="Opc" class="form-control">
						<option>----Selecione o Campus----</option>
						<!-- Pega os dados do banco e coloca no select -->
						<?php $sql = $conn->query("SELECT id, nome, idCampi, ativo FROM `Educatio`.`deptos`"); ?>	
						<?php while($linha = $sql->fetch_assoc()) { ?>
		 				<option value="<?php echo $linha['nome']?>"><?php echo "Departamento: ".$linha['nome']." - Campus: ".$linha['idCampi']." - Ativo: ".$linha['ativo']  ?></option>
		 				<?php } ?>
					</select>
				</div>
				<br>
				<input type="submit" name="Excluir" value="Excluir" class="btn btn-lg btn-primary btn-block" style="border-color: white; background-color: #000080; color: white">
			</form>
		</div>
	</div>
</body>
</html>
<?php

	//Recebe os Dados do Form
	@$Opc = $_POST['Opc'];

	//Verifica se o botão Excluir foi clicado
	if (isset($_POST['Excluir'])) {

		//Parametro em SQL  		
		@$sql = "UPDATE `Educatio`.`deptos` SET ativo = 'N' WHERE nome = '".$Opc."'";

		//Verifica se o Departamento foi "excluido"
 		if ($conn->query($sql) === TRUE) {
	    	echo "<script>alert('Deparatamento deletado com sucesso')</script>";
		} else {
	    	echo "<script>alert('Erro deletando o Departamento: ".$conn->error."')</script>";
		} 
	}
	
	//Fecha a conexão
	$conn->close();

?>