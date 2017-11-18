<!DOCTYPE html>

<?php

	//constantes utilizadas na conexão com o banco de dados
	define ("SERVIDOR", "localhost");
	define ("USUARIO", "root");
	define ("SENHA", "");
	define ("BD", "educatio");
	
	//CPF inserido na pagina "PHJL-WEB-Entrada-Formulario-de-alteracao.html"
	define ("CPF", $_POST["valorCPF"]);
	
	//conexao com o BD
	$conn = mysqli_connect (SERVIDOR, USUARIO, SENHA);

	//Seleciona o BD
	$bd_select = mysqli_select_db ($conn, BD);

	//seleciona a linha em que o idCPF for igual ao CPF recebido
	$sql = "SELECT * FROM alunos WHERE idCPF = " .CPF;
	$result = mysqli_query($conn,$sql);

	//seleciona a linha em que o idCPF for igual ao CPF recebido


 
	//verifica se o ID inserido existe. Se nao, retorna para a pagina anterior
	if(!mysqli_num_rows($result) > 0){

	   //Id nao encontrado
	   header('Aluno.php');
	}

	$linha = mysqli_fetch_array($result);

	$sql = "SELECT * FROM turmas WHERE id = ".$linha[1];

	$resultTurma = mysqli_query($conn,$sql);
	
	$linhaTurma = mysqli_fetch_array($resultTurma);

	$sql = "SELECT * FROM disciplinas WHERE idTurma = ".$linhaTurma[1];

	$resultDisciplina = mysqli_query($conn,$sql);

    //$sql = "SELECT * FROM conteudo WHERE idDisciplina= ".$linhaTurma[1];//."AND";

	//verifica se o ativo do aluno é N, se sim volta para a pagina anterior
	
	if($linha[15] == 'N'){
		header('Aluno.php');
	}
?>

<html>
	<head>
<meta charset="utf-8" />
<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
<meta name="viewport" content="width=device-width" />
<!-- TITULO E LOGO DA PAGINA  -->
<title> Alteração de aluno </title>
<link rel="shortcut icon" href="imagens/logo.png">
<!-- CSS do Bootstrap -->
<meta charset="utf-8" />
<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
<meta name="viewport" content="width=device-width" />
<!--<link rel="stylesheet" type="text/css" href="PHJL-WEB-Formulario-de-insercao-de-aluno.css">-->

<link href="css/bootstrap.min.css" rel="stylesheet" />
<link href="css/bootstrap.css" rel="stylesheet"/>
<link href="Rodape-Web/gerencia-web-estilos-rodape.css" rel="stylesheet">

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
	<body>
	    <div class="wrapper"> 
	        <div class="section landing-section">
	            <div class="container">
	                <div class="row">
	                    <div class="col-md-8 ml-auto mr-auto">

							<h1 class="text-center">DADOS DO ALUNO</h1>

							<form method = "POST" action = "PHJL-WEB-Insercao-de-alteracao-no-BD.php?idcpf=<?php echo CPF; ?>" id="formulario" enctype="multipart/form-data" >

								<div class="row"> Nome:
									 
									<?php 
										echo "$linha[2]";  
									?>		
								</div>
									
								<div class = "row"> CPF:
									<?php
						      			echo "$linha[0]";
									?>	
								</div>
									
								<div class = "row"> Turma:
										
										<?php 
										   	echo "$linhaTurma[3]";
										?>
								</div>
				                
				                <div class = "row">
										<?php 
									    while ($linhaDisciplina = mysqli_fetch_array($resultDisciplina)){
											    	
											echo "<br>Disciplina de $linhaDisciplina[2]: <br> ";
											    	
											$sql = "SELECT * FROM conteudos WHERE idDisciplina =".$linhaDisciplina[0];
											        
											$resultConteudo = mysqli_query($conn,$sql);
                                            
					                        while ($linhaConteudo = mysqli_fetch_array($resultConteudo)) {
					                            echo "$linhaConteudo[3]<br>"; 
					                        }
					                        echo "<br>";
									    }
										?>
					  			</div>
							</form>
						</div>
					</div>
				</div>
			</div>	
		</div>
	</body>
</html>