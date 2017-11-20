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
	$strCampi = $_GET['strCampi'];
	$strSQL = $conn->query("SELECT id FROM `Educatio`.`campi` WHERE nome ='".$strCampi."'");
	while($arrLinha = $strSQL->fetch_assoc()) {
		$intIdCampi = $arrLinha['id'];
	}
    
?> 
<!DOCTYPE html>
<html>
<head>
	<title>Transferência de Aluno</title>
	<meta charset="utf-8">

	<!-- CSS do Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet" />
	<link href="css/bootstrap.css" rel="stylesheet"/>

	<!-- CSS do grupo -->
 	<link href="css/CSSGrupo.css" rel="stylesheet" />
	 

	<!-- Arquivos js -->
	<script src="js/popper.js"></script>
	<script src="js/jquery-3.2.1.js" type="text/javascript"></script>
	<script src="js/bootstrap.min.js" type="text/javascript"></script>
	<script src="https://code.jquery.com/jquery-3.1.1.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.quicksearch/2.3.1/jquery.quicksearch.js"></script>

	<!-- Fontes e icones -->
	<link href="css/nucleo-icons.css" rel="stylesheet">

</head>

<body>

<div class="wrapper">
	<div class="container">
		<div class="col-md-8 ml-auto mr-auto">

			<h1 class="text-center">Transferência de aAluno</h1>

			<form method="POST" action="" class="contact-form">

				<div class="input-group">
					<span class="input-group-addon"><i class="nc-icon nc-bank"></i></span>
					<input type="text" name="Nome" id="txt_consulta" placeholder="Digite o Nome do Departamento onde está o Aluno" class="form-control" required='required'>
				</div>							
			
				<table class="table table-hover" required='required' id="tabela">
					<!-- Pega os dados do banco e coloca na tabela -->
					<?php $strSQL1 = $conn->query("SELECT id, nome, ativo FROM `Educatio`.`deptos` WHERE idCampi = '".$intIdCampi."'");
					while($arrLinha1 = $strSQL1->fetch_assoc()) {
						if ($arrLinha1['ativo'] != 'N') {	
							echo "<tr value='".$arrLinha1['nome']."' onclick('document.getElementById('txt_consulta').value = document.getElementById(this).innerHTML')><th>".$arrLinha1['nome']."</th></tr>";
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
				
				<div class="row">
					<div class="col-md-4 ml-auto mr-auto">
						<input type="submit" name="Selecionar" value="Selecionar" class="btn btn-info btn-round">
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
		header('Location: TransferenciaVerificacaoCurso.php?strDepto='.$_POST['Nome']);
	}
 	
	//Fecha a conexão
	$conn->close();
?>