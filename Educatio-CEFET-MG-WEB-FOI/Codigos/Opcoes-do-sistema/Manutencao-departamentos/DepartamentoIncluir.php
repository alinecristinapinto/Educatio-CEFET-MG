<?php
	session_start(); 
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
	  <link href="../../../Estaticos/Bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	  <link href="../../../Estaticos/Bootstrap/css/bootstrap.css" rel="stylesheet"/>

	  <!-- Arquivos js -->
	  <script src="../../../Estaticos/Bootstrap/js/popper.js"></script>
	  <script src="../../../Estaticos/Bootstrap/js/jquery-3.2.1.js" type="text/javascript"></script>
	  <script src="../../../Estaticos/Bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

	  <!-- Fontes e icones -->
	  <link href="../../../Estaticos/Bootstrap/css/nucleo-icons.css" rel="stylesheet">
	  <link href="https://fonts.googleapis.com/css?family=Abel|Inconsolata" rel="stylesheet">

	  <?php require "../../Menu-Rodape-Secundarios/caso-2/gerencia-web-menu-interface-coordenador.php"; ?>

	  <style type="text/css">
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

	    .text-center{
	       font-family: 'Abel', sans-serif;
	       color: #d8ac29;
	    }
	  </style>


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
						<input type="submit" name="Incluir" value="Incluir" class="btn btn-info">
						<button class="btn btn-info" onClick="window.location.href ='../../Entrada/gerencia-web-interface-coordenador.php?acao=adicionarDepartamento'">Voltar</button>
					</div>
				</div>	

			</form>

		</div>
	</div>
	<?php require "../../Menu-Rodape-Secundarios/caso-1/gerencia-web-rodape-caso-2.php"; ?>
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
				echo "<script>alert('Departamento criado com sucesso')</script>";
			} else {
				echo "<script>alert('Erro criando o Departamento: ".$conn->error."')</script>";
			}
		}	
	}
	
	//Fecha a conexão
	$conn->close();
	
?>