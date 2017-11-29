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
	<title>Incluir Departamento</title>
	<meta charset="utf-8">
	
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

<div class="wrapper">
	<div class="container">
		<div class="col-md-8 ml-auto mr-auto">

			<h1 class="text-center">Incluir Departamento</h1>

			<form method="POST" action="" class="contact-form">

				<div class="input-group">
					<span class="input-group-addon"><i class="nc-icon nc-single-02"></i></span>	
						<input type="text" name="Nome" id="txt_consulta" placeholder="Digite o CPF ou o Nome do Aluno" class="form-control" required='required'>
				</div>

				<table class='table table-hover' id="tabela">
				<?php
				//Tabela de Pesquisa
				$strSQL = $conn->query("SELECT id, nome, ativo, cidade, UF FROM `Educatio`.`campi`");
				while($arrLinha = $strSQL->fetch_assoc()) {
					if ($arrLinha['ativo'] != 'N') {
						echo "<tr value='".$arrLinha['nome']."' onclick('document.getElementById('txt_consulta').value = document.getElementById(this).innerHTML')><th>".$arrLinha['nome']."</th><td>".$arrLinha['cidade']."</td><td>".$arrLinha['UF']."</td></tr>";
					}
				}
				echo "</table>";
				?>

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
		echo "<script>
				location.href = '../Opcoes-do-sistema/Manutencao-departamentos/DepartamentoIncluir.php?strCampi=".$_POST['Nome']."';
			</script>";
	  	//header('Location: ../Departamento/DepartamentoIncluir.php?strCampi='.$_POST['Nome']);
	}
 	
	//Fecha a conexão
	$conn->close();
?>