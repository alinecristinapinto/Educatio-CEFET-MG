<!DOCTYPE html>
<html>
<head>
	<title>Transferencia de Aluno</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body style="background-color: #000080">

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script>
		function formatar(src, mask) {	
  			var i = src.value.length;
  			var saida = mask.substring(0,1);
  			var texto = mask.substring(i)
			if (texto.substring(0,1) != saida) {
                src.value += texto.substring(0,1);
  			}
		}
	</script>

	<div class="container">
		<div class="col-md-6" >
			<h1 align="center" style="color: white">Transferencia de Aluno</h1>
			<form method="POST" action="">
				<div class="input-group">
					<div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
	   				<input type="text" class="form-control input-lg" name="CPF" onkeypress="formatar(this,'000.000.000-00')" placeholder="Digite o CPF do aluno"></input><br>
	   			</div>
	   			<br>
				<input type="submit" class="btn btn-lg btn-primary btn-block" name="Transfererir" value="Transfererir" style="border-color: white; background-color: #000080; color: white">
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
	$dbname = "Educatio";

	//recebe o CPF do Form
	@$cpf = $_POST['CPF'];

	//Cria conexão
	$conn = new mysqli($servername, $username, $password);
	//Verifica conexão
	if ($conn->connect_error) {
   		die("Falha na conexão: " . $conn->connect_error."<br>");
	}	

	//Verifica se o botão Transferir foi clicado
	if (isset($_POST['Transfererir'])) {
		//Verificar se o  CPF está valido  
		if (isset($_POST['CPF'])) {
			if (preg_match("/^[0-9]{3}\.[0-9]{3}\.[0-9]{3}-[0-9]{2}$/", $cpf)){
	  			echo "CPF valido.<br>";
			} else {
	  			echo "CPF invalido.<br>";
			}
		}

		//Tirar os "." e "-" do CPF e junta as partes para pesquisar no DB
		$prt1 = substr($cpf, 0, 3);
		$prt2 = substr($cpf, 4, 3);
		$prt3 = substr($cpf, 8, 3);
		$prt4 = substr($cpf, 12);
		$cpf = $prt1.$prt2.$prt3.$prt4;

		//Parametro em SQL
		@$sql = "UPDATE `Educatio`.`alunos` SET ativo = 'N' WHERE idCPF = '".$cpf."'";

		//Verifica se o Departamento foi "excluido"
	 	if ($conn->query($sql) === TRUE) {
		    echo "<script>alert('Aluno tranferido com sucesso')</script>";
		} else {
		    echo "<script>alert('Erro transferindo Aluno: ".$conn->error."')</script>";
		} 
	}
	
	//Fecha a conexão
	$conn->close();

?>