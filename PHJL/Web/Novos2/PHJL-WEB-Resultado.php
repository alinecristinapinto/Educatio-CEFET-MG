<!DOCTYPE html>
<?php
	
	define ("RESULTADO", $_GET["result"]);
	
?>
<html>
	<head>
		<meta charset="utf-8" />
		<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
		<meta name="viewport" content="width=device-width" />
	
		<!-- TITULO E LOGO DA PAGINA  -->
		<title> Resultado </title>
		<link rel="shortcut icon" href="imagens/logo.png">
		
		<!-- CSS do Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet" />
		<link href="css/bootstrap.css" rel="stylesheet"/>
		<link href="Rodape-Web/gerencia-web-estilos-rodape.css" rel="stylesheet">
		<!--<link rel="stylesheet" type="text/css" href="PHJL-WEB-Formulario-de-insercao-de-aluno.css">-->

		<!-- Arquivos js -->
		<script src="js/jquery-3.2.1.js" type="text/javascript"></script>
		<script src="js/bootstrap.min.js" type="text/javascript"></script>
		<script src="PHJL-WEB-Formulario-de-insercao-de-alunos.js" defer></script>

		<!-- Fontes e icones -->
		<link href="https://fonts.googleapis.com/css?family=Abel|Inconsolata" rel="stylesheet">
		<link href="css/nucleo-icons.css" rel="stylesheet">
		
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
  		<meta name="viewport" content="width=device-width, initial-scale=1.0">

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

        <div class="section landing-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 ml-auto mr-auto">

                        <h2 class="text-center"> RESULTADO </h2>
						
						<h2 class="text-center">
						<?php
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
						?>
						</h2>
					</div>
				</div>
			</div>
		</div>
		</div>
	</body>
</html>