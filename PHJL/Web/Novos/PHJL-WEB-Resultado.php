<!DOCTYPE html>
<?php
	
	define ("RESULTADO", $_GET["result"]);
	
?>
<html>
	<head>
		<meta charset = "UTF-8">

		<!-- TITULO DA PAGINA -->
		<title> Resultado</title>		
		
		<!-- STYLES -->
		<link ​ href = "css/bootstrap.css"​ ​ rel = "stylesheet">
		<link ​ href = "PHJL-WEB-Formulario-de-insercao-de-aluno.css"​ ​ rel = "stylesheet">
	</head>
	
	<body>
	
		<div class= "TamanhoDoFormulario">
			<div class="TituloDaPagina">
			<h1> RESULTADO</h1>
			</div>
			
			<div class = "TamanhoDosCampos" id = "DIVentradaCPFID">
				<span class="input-group-addon"><span></span><?php 
				if(RESULTADO == "inserirSUCESSO"){
					echo "Aluno inserido com sucesso !";
				}elseif(RESULTADO == "inserirERRO"){
					echo "Erro ao inserir aluno !";
				}elseif(RESULTADO == "alterarSUCESSO"){ 
					echo "Aluno alterado com sucesso !";
				}elseif(RESULTADO == "alterarERRO"){
					echo "Erro ao alterar o aluno !";
				}elseif(RESULTADO == "deletarSUCESSO"){
					echo "Aluno deletado com sucesso !";
				}elseif(RESULTADO == "deletarERRO"){
					echo "Erro ao deletar aluno !";
				}
				?></span>
			</div>
			
		</div>
	</body>
</html>