<!DOCTYPE html>
<html>
<head>
	<title>Departamentos</title>
</head>
<body>

	<h1>Configurações de Departamento</h1>

	<form method="POST" action="DepartamentoMain.php">

		<input type="submit" name="alterar" value="Alterar Departamento"><br><br>
		<input type="submit" name="excluir" value="Excluir Departamento"><br><br>
		<input type="submit" name="incluir" value="Incluir Departamento"><br><br>
	
	</form>	

</body>
</html>



<?php

	if (isset($_POST["alterar"])){
  		
		header('Location: DepartamentoAlterar.php');

	}else if (isset($_POST["excluir"])){

		header('Location: DepartamentoExcluir.php');

	}else if (isset($_POST["incluir"])){

		header('Location: DepartamentoIncluir.php');

	}

?>