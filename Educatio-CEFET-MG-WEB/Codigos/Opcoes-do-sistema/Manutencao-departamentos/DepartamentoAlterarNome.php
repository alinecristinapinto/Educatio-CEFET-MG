<?php
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

	  <!-- Arquivos js -->
	  <script src="../../../Estaticos/Bootstrap/js/popper.js"></script>
	  <script src="../../../Estaticos/Bootstrap/js/jquery-3.2.1.js" type="text/javascript"></script>
	  <script src="../../../Estaticos/Bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

	 
	  <!-- Fontes e icones -->
	  <link href="../../../Estaticos/Bootstrap/css/nucleo-icons.css" rel="stylesheet">

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

<div class="wrapper">
	<div class="container">
		<div class="col-md-8 ml-auto mr-auto">

			<h1 class="text-center">Alterar Nome do Departamento</h1>

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
							<?php echo "<tr value='".$arrLinha['nome']."' onclick('document.getElementById('txt_consulta').value = document.getElementById(this).innerHTML')><th>".$arrLinha['nome']."</th>";?>
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
					<span class="input-group-addon"><i class="nc-icon nc-check-2"></i></span>
						<input type="text" name="nome" class="form-control" placeholder="Digite o Nome a ser alterado" required='required'>
				</div>
				
				<div class="row">
					<div class="col-md-4 ml-auto mr-auto">
						<input type="submit" name="Alterar" value="Alterar" class="btn btn-info btn-round">
					</div>
				</div>	
							
			</form>

		</div>
	</div>
	<?php require "../../Menu-Rodape/gerencia-web-rodape-caso-2.php"; ?>
</div>

</body>
</html>

<?php
	//Recebe os Dados do Form 
	@$strNome = $_POST['nome'];
	@$strOnde = $_POST['Onde'];

	echo $intIdCampi;
	
	if (isset($_POST['Alterar'])) {	
		
		@$strAux1 = "nome = '".$strNome."'";
		@$strAux2 = " WHERE nome = '".$strOnde."'";

		//Verifica se já existe um departamento com esse nome 
		if (mysqli_num_rows($conn->query("SELECT nome FROM `Educatio`.`deptos` WHERE nome= '".$strNome."' AND idCampi = '".$intIdCampi."'")) != 0){
			echo "<script>alert('Um Deparatamento com esse nome já existe neste Campus');</script>";
		}else {
			//Parametro de SQL
			@$strSQL = "UPDATE `Educatio`.`deptos` SET ".$strAux1.$strAux2;

			//Verifica se o Departamento foi alterado 
			if ($conn->query($strSQL) == TRUE) {
					echo "<script>alert('Deparatamento alterado com sucesso');</script>";
			} else {
				echo "<script>alert('Erro alterando o Deparatamento: '".$conn->error."');</script>";
			} 
		}
	}

	//Fecha a conexão
	$conn->close();
?>