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
	<title>Alterar Departamento</title>
	<meta charset="utf-8">

	<!-- CSS do Bootstrap -->
	  <link href="../../../Estaticos/Bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	  <link href="../../../Estaticos/Bootstrap/css/bootstrap.css" rel="stylesheet"/>

	  <!-- CSS do grupo -->

	  <!-- Arquivos js -->
	  <script src="../../../Estaticos/Bootstrap/js/popper.js"></script>
	  <script src="../../../Estaticos/Bootstrap/js/jquery-3.2.1.js" type="text/javascript"></script>
	  <script src="../../../Estaticos/Bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

	 
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
<?php require "../../Menu-Rodape-Secundarios/caso-2/gerencia-web-menu-interface-coordenador.php"; ?>
<div class="wrapper">
	<div class="container">
		<div class="col-md-8 ml-auto mr-auto">

			<h1 class="text-center">Alterar Id-Campi do Departamento</h1>

			<form method="POST" action="" class="contact-form">

				<div class="input-group">
					<span class="input-group-addon"><i class="nc-icon nc-bank"></i></span>
					<input type="text" name="Onde" id="txt_consulta" placeholder="Digite o Nome do Departamento que será alterado" class="form-control" required='required'>
				</div>							
				
				<table class="table table-hover" required='required' id="tabela">
					<!-- Pega os dados do banco e coloca no select -->
					<?php $strSQL = $conn->query("SELECT id, nome, idCampi, ativo FROM `Educatio`.`deptos` WHERE idCampi = '".$intIdCampi."'"); ?>	
					<?php while($arrLinha = $strSQL->fetch_assoc()) { ?>
						<?php if ($arrLinha['ativo'] != 'N') {?>	
							<?php echo "<tr value='".$arrLinha['nome']."' onclick('document.getElementById('txt_consulta').value = document.getElementById(this).innerHTML')><th>".$arrLinha['nome']."</th></tr>";?>
					<?php }} ?>
				</table>

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

				<br>

				<div class="input-group">
					<span class="input-group-addon"><i class="nc-icon nc-hat-3"></i></span>
					<select name="idCampi1" class="form-control" required="required">
						<option value="">Selecione o Campus</option>
						<!-- Pega os dados do banco e coloca no select -->
						<?php $strSQL = $conn->query("SELECT nome, id, ativo, cidade FROM `Educatio`.`campi` WHERE id != '".$intIdCampi."'"); ?>	
						<?php while($arrLinha2 = $strSQL->fetch_assoc()) { ?>
						<?php if ($arrLinha2['ativo'] != 'N') {?>	
						<option value="<?php echo $arrLinha2['id']?>"><?php echo $arrLinha2['nome']." - Cidade: ".$arrLinha2['cidade']; ?></option>
						<?php }} ?>
					</select>
				</div>
				
				<div class="row">
					<div class="col-md-4 ml-auto mr-auto">
						<input type="submit" name="Alterar" value="Alterar" class="btn btn-info">
						<button class="btn btn-info" onClick="window.location.href ='../../Entrada/gerencia-web-interface-coordenador.php?acao=alterarDepartamento'">Voltar</button>
					</div>
				</div>	
							
			</form>

		</div>
	</div>
</div>
<?php require "../../Menu-Rodape-Secundarios/caso-1/gerencia-web-rodape-caso-2.php"; ?>
</body>
</html>

<?php
	
	//Recebe os Dados do Form 
	@$intIdCampi1 = $_POST['idCampi1'];
	@$strOnde = $_POST['Onde'];
 	
	if (isset($_POST['Alterar'])) {	
		if (mysqli_num_rows($conn->query("SELECT nome FROM `Educatio`.`deptos` WHERE nome = '".$strOnde."' AND idCampi = '".$intIdCampi1."'")) != 0){
			echo "<script>alert('Um Deparatamento com esse nome já existe neste Campus');</script>";
		}else {
			$strAux1 = "idCampi = '".$intIdCampi1."'";
						
			@$strAux2 = " WHERE nome = '".$strOnde."'";

			//Parametro de SQL
			@$strSQL = "UPDATE `Educatio`.`deptos` SET ".$strAux1.$strAux2;

			//Verifica se o Departamento foi alterado 
			if ($conn->query($strSQL) === TRUE) {
				echo "<script>
					alert('Deparatamento alterado com sucesso');
					window.location.href ='../../Entrada/gerencia-web-interface-coordenador.php?acao=alterarDepartamento';
				</script>";
			} else {
				echo "<script>alert('Erro alterando o Deparatamento: ".$conn->error."');</script>";
			} 
		}
	}
 	
	//Fecha a conexão
	$conn->close();
?>