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
?> 
<!DOCTYPE html>
<html>
<head>
	<title>Alterar Departamento</title>
	<meta charset="utf-8">

</head>

<body>

<div class="wrapper">
	<div class="container">
		<div class="col-md-8 ml-auto mr-auto">

			<h1 class="text-center">Alterar Departamento</h1>

			<form method="POST" action="" class="contact-form">

				<div class="input-group">
					<span class="input-group-addon"><i class="nc-icon nc-bank"></i></span>
					<input type="text" name="Nome" id="txt_consulta" placeholder="Digite o Nome do Departamento que será Alterado" class="form-control" required='required'>
				</div>							
			
				<table class="table table-hover" required='required' id="tabela">
					<!-- Pega os dados do banco e coloca na tabela -->
					<?php $strSQL = $conn->query("SELECT id, nome, ativo, cidade, UF FROM `Educatio`.`campi`");
					while($arrLinha = $strSQL->fetch_assoc()) {
						if ($arrLinha['ativo'] != 'N') {	
							echo "<tr value='".$arrLinha['nome']."' onclick('document.getElementById('txt_consulta').value = document.getElementById(this).innerHTML')><th>".$arrLinha['nome']."</th><td>".$arrLinha['cidade']."</td><td>".$arrLinha['UF']."</td></tr>";
						}
					}?>
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
					<span class="input-group-addon"><i class="nc-icon nc-settings-gear-65"></i></span>
					<select name="Opc" class="form-control" required="required">
						<option value="">Selecione o que Alterar</option>
						<option value="Nome">Nome</option>
						<option value="IdCampi">Id-Campi</option>
					</select>
				</div>
				
				<div class="row">
					<div class="col-md-4 ml-auto mr-auto">
						<input type="submit" name="Selecionar" value="Selecionar" class="btn btn-info">
					</div>
				</div>	
							
			</form>

		</div>
	</div>
</div>

</body>
</html>

<?php
	if (isset($_POST["Selecionar"])){
		if($_POST['Opc'] == "Nome"){
			echo    "<script>
						location.href = '../Opcoes-do-sistema/Manutencao-departamentos/DepartamentoAlterarNome.php?strCampi=".$_POST['Nome']."';
					</script>";
  		}else if ($_POST["Opc"] == "IdCampi"){
  			echo    "<script>
						location.href = '../Opcoes-do-sistema/Manutencao-departamentos/DepartamentoAlterarIdCampi.php?strCampi=".$_POST['Nome']."';
					</script>";
		}
	}
 	
	//Fecha a conexão
	$conn->close();
?>