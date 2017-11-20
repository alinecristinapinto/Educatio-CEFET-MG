<!DOCTYPE html>

<?php

	header('content-type: text/html; charset=ISO-8859-1');
    //ini_set('default_charset','UTF-8');
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

	//seleciona a linha em que o idCPF for igual ao CPF recebidos


 
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
		<title> Di&aacute;rio de aluno </title>
		
		<!-- palavra=Diário &aacute; está sendo utilizado pois o ISO entra em conflito com o utf-8 e o acento não funciona -->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link rel="shortcut icon" href="imagens/logo.png">
		
		<!-- CSS do Bootstrap -->
		<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
		<meta name="viewport" content="width=device-width" />
		<link rel="stylesheet" type="text/css" href="PHJL-WEB-Estilo-paginas.css">

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

	</head>
	
	<body>
	    <div class="wrapper"> 
	        <div class="section landing-section">
	            <div class="container">
	                <div class="row">
	                    <div class="col-md-8 ml-auto mr-auto">

							<h1 class="text-center">DADOS DO ALUNO</h1>

							<form method = "POST" action = "PHJL-WEB-Pesquisa-Diario-aluno.php?idcpf=<?php echo CPF; ?>" id="formulario" enctype="multipart/form-data" >

								<div class="row">
									<label class = "fonteTexto"> Nome: </label>
									 
									<?php 
										echo "$linha[2]";  
									?>		
								</div>
									
								<div class = "row">
									<label class="fonteTexto"> CPF: </label>
									<?php
						      			echo "$linha[0]";
									?>	
								</div>
									
								<div class = "row">
										<label class = "fonteTexto"> Turma: </label>
										
										<?php 
										   	echo "$linhaTurma[3]";
										?>
								</div>

				                
				                <div class = "row">
										<?php 
									    while ($linhaDisciplina = mysqli_fetch_array($resultDisciplina)){
									    
									    	echo "<br>";

                                            $sql = "SELECT * FROM profdisciplinas WHERE idDisciplina = ".$linhaDisciplina[0];

											$resultProfessor = mysqli_query($conn,$sql);
											
											$linhaProfessor = mysqli_fetch_array($resultProfessor);

											$sql = "SELECT * FROM funcionario WHERE idSIAPE = ".$linhaProfessor[1];

											$resultFuncionarios = mysqli_query($conn,$sql);
											
											$linhaFuncionarios = mysqli_fetch_array($resultFuncionarios);

                                            echo "Disciplina de $linhaDisciplina[2], $linhaFuncionarios[2]: <br> <br>";
											    	
											$sql = "SELECT * FROM conteudos WHERE idDisciplina =".$linhaDisciplina[0];
											        
											$resultConteudo = mysqli_query($conn,$sql);
                                            
					                        while ($linhaConteudo = mysqli_fetch_array($resultConteudo)) {

					                        	echo "$linhaConteudo[3]:<br><br>";

												$sql = "SELECT * FROM matriculas WHERE idAluno = $linha[0] && idDisciplina =".$linhaDisciplina[0];
											        
											    $resultMatriculas = mysqli_query($conn,$sql);

											    while ($linhaMatricula = mysqli_fetch_array($resultMatriculas)) {
													$sql = "SELECT * FROM diarios WHERE idConteudo = $linhaConteudo[0] && idMatricula = $linhaMatricula[0]";
														        
												    $resultdiarios = mysqli_query($conn,$sql);
			                                                
				                                    while ($linhadiarios = mysqli_fetch_array($resultdiarios)){ 
						                            
							                            $sql = "SELECT * FROM atividades WHERE id =".$linhadiarios[3];
													        
													    $resultAtividade = mysqli_query($conn,$sql);

													    while ($linhaAtividade = mysqli_fetch_array($resultAtividade)) {
				                         
												        	echo "Atividade:  $linhaAtividade[2]; Nota: $linhadiarios[5]<br>";
												        }
											      //  echo "<br>";
												    }
                                                echo "<br>"; 
						                        }
					                        }
					                    //echo "<br>";
									    }
										?>
										</div>
					  			</div>
							</form>
						</div>
					</div>
				</div>
			</div>	
		</div>
	</body>
</html>