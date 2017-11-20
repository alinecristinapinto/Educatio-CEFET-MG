<?php
	ini_set('default_charset','UTF-8');

	$strNomeServer = "localhost";
	$strNomeUsuario = "root";
	$strSenha = null;
	$strDBnome = "Educatio";

	//Cria conexão
	$conn = new mysqli($strNomeServer, $strNomeUsuario, $strSenha);
	//Verifica conexão
	if ($conn->connect_error) {
   		die("Falha na conexão: " . $conn->connect_error."<br>");
	}

	//Variável para verificar o Campus dos departamentos
	$intIdCampi = $_GET['intIdCampi'];

	//Função de exclusão de departamento
	function excluirDepartamento($strVar) {

		//Cria conexão
		$conn = new mysqli('localhost', 'root', null);
		//Verifica conexão
		if ($conn->connect_error) {
			die("Falha na conexão: " . $conn->connect_error."<br>");
		}

		//Parâmetro em SQL  		
		@$strSQL = "UPDATE `Educatio`.`deptos` SET ativo = 'N' WHERE nome = '".$strVar."'";
		
		//Verifica se o Departamento foi "excluido"
		 if ($conn->query($strSQL) === TRUE) {
			echo "<script>alert('Deparatamento deletado com sucesso')</script>";
		} else {
			echo "<script>alert('Erro deletando o Departamento: ".$conn->error."')</script>";
		}

	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Excluir Departamento</title>
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

			<h1 class="text-center">Excluir Departamento</h1>

			<form action="" method="POST" class="contact-form">

				<div class="input-group">
					<span class="input-group-addon"><i class="nc-icon nc-bank"></i></span>
					<select name="Opc" class="form-control" required="required">
						<option value="">Selecione o Departamento</option>
						<!-- Pega os dados do banco e coloca no select -->
						<?php $strSQL = $conn->query("SELECT id, nome, idCampi, ativo FROM `Educatio`.`deptos` WHERE idCampi = '".$intIdCampi."'"); ?>	
						<?php while($arrLinha = $strSQL->fetch_assoc()) { ?>
						<?php if ($arrLinha['ativo'] != 'N') {?>	
						<option value="<?php echo $arrLinha['nome']?>"><?php echo "Departamento: ".$arrLinha['nome']?></option>
						<?php }} ?>
					</select>
				</div>

				<div class="row">
					<div class="col-md-4 ml-auto mr-auto">
						<input type="submit" name="Excluir" value="Excluir" class="btn btn-info btn-round">
					</div>
				</div>	

			</form>

		</div>
	</div>
</div>

</body>
</html>
<?php

	//Recebe o Dado do Form
	@$strOpc = $_POST['Opc'];
	
	//Pega o id com departamento escolhido
	$strSQL = $conn->query("SELECT id,ativo FROM `Educatio`.`deptos` WHERE nome ='".$strOpc."'");	
	while($arrLinha2 = $strSQL->fetch_assoc()) {
		if ($arrLinha2['ativo'] != 'N') {
			$intId = $arrLinha2['id'];
		}
	}

	//Verifica se o botão Excluir foi clicado
	if (isset($_POST['Excluir'])) {
		
		//Parâmetro em SQL
		$strSQL = "SELECT nome FROM `Educatio`.`cursos` WHERE idDepto = '".$intId."' AND ativo = 'S'";
		$strSQL1 = "SELECT nome FROM `Educatio`.`funcionario` WHERE idDepto = '".$intId."' AND ativo = 'S'";

		//Verifica se existem funcionarios ou cursos ativos no dpartamento
		if(mysqli_num_rows($conn->query($strSQL)) != 0 || mysqli_num_rows($conn->query($strSQL1)) != 0){
			echo "<script>alert('Não foi possível excluir o Departamento. Existem Cursos ativos nele.);</script>";
		}else{
			excluirDepartamento($strOpc);
		}	
	}
	
	//Fecha a conexão
	$conn->close();

?>