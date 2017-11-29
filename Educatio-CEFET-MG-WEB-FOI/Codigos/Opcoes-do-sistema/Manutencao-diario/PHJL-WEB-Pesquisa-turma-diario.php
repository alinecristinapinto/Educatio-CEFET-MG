<?php
	//header('content-type: text/html; charset=ISO-8859-1');
	//constantes utilizadas na conexão com o banco de dados
	define ("SERVIDOR", "localhost");
	define ("USUARIO", "root");
	define ("SENHA", "usbw");
	define ("BD", "educatio");
	
	//Session com o id do professor a ser inserido no Login do usuario
	//$_SESSION["IDPROF"] = "620589259";
	
	/*
	ids PROF para teste
	925437416
	802602374
	376843913
	383463866
	620589259
	849470835
	427265728
	713027127
	
	*/
	
	//ID do professor
	define ("IDPROF", $usuario['idSIAPE']);
	
	//conexao com o BD
	$conn = mysqli_connect (SERVIDOR, USUARIO, SENHA);
	//Seleciona o BD
	$bd_select = mysqli_select_db ($conn, BD);
	//seleciona a linha em que o idCPF for igual ao CPF recebido
	$sql = "SELECT * FROM profdisciplinas WHERE idProfessor = " .IDPROF;
	$result = mysqli_query($conn,$sql);
	
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
		<meta name="viewport" content="width=device-width" />
	
		<!-- TITULO E LOGO DA PAGINA  -->
		<title> Acessar di&aacute;rio - Professor </title>
		<link rel="shortcut icon" href="../../../Estaticos/Logo/Educatio.png">
		
		<!-- CSS do Bootstrap -->
		<link rel="stylesheet" type="text/css" href="../Opcoes-do-sistema/Manutencao-diario/PHJL-WEB-Estilo-paginas.css">

		<!-- Arquivos js -->
		<script src="../Opcoes-do-sistema/Manutencao-diario/PHJL-WEB-Formulario-de-insercao-de-alunos.js" defer></script>

		<!-- Fontes e icones -->
		<link href="https://fonts.googleapis.com/css?family=Abel|Inconsolata" rel="stylesheet">
		
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
  		<meta name="viewport" content="width=device-width, initial-scale=1.0">

	</head>	
	<!--Chama a funcao com o evento onload para carregar a tabela assim que o body for gerado -->
	<body>
		
		<div class="wrapper">
			<!-- <div class="section landing-section"> -->
				<div class="container">
					<div class="row">
						<div class="col-md-8 ml-auto mr-auto">
							<h2 class="text-center"> Escolher Turma </h2>
							<br>
							<table class="table table-hover">
							<?php 
								$turmasProf = array();
								echo "<thead class = 'fonteTexto'>";
								echo "<tr>";
								echo "<th>Nomes</th>";
								echo "<th>Ano</th>";
								echo "<th>Cursos</th>";
								echo "<th>Modalidades</th>";
								echo "<th>Departamentos</th>";
								echo "<th>Campi</th>";
								echo "</tr>";
								echo "</thead>";
								echo "<tbody style = 'cursor : pointer;' >";
								while($linha = mysqli_fetch_array($result)){
									
									$sql = "SELECT * FROM turmas WHERE id = " .$linha[3] ." AND ativo = 'S'";
									$result2 = mysqli_query($conn, $sql);
									$linhaTurma = mysqli_fetch_array($result2);
									
									$sql = "SELECT * FROM cursos WHERE id = " .$linhaTurma[1] ." AND ativo = 'S'";
									$resultCurso = mysqli_query($conn, $sql);
									$linhaCurso = mysqli_fetch_array($resultCurso);
									
									$sql = "SELECT * FROM deptos WHERE id = " .$linhaCurso[1] ." AND ativo = 'S'";
									$resultDepto = mysqli_query($conn, $sql);
									$linhaDepto = @mysqli_fetch_array($resultDepto);
									
									$sql = "SELECT * FROM campi WHERE id = " .$linhaDepto[1] ." AND ativo = 'S'";
									$resultCampus = mysqli_query($conn, $sql);
									$linhaCampus = @mysqli_fetch_array($resultCampus);
									if((in_array($linhaTurma[0], $turmasProf) == FALSE) && ($linhaTurma[4] == 'S')){
										echo "<tr onclick=\"EnviarID('" .$linhaTurma[0] ."')\" >";
										echo "<td class = 'fonteTexto'>" .$linhaTurma[3] ."</td>";
										echo "<td class = 'fonteTexto'>" .$linhaTurma[2] ."</td>";
										echo "<td class = 'fonteTexto'>" .$linhaCurso[2] ."</td>";
										echo "<td class = 'fonteTexto'>" .$linhaCurso[4] ."</td>";
										echo "<td class = 'fonteTexto'>" .$linhaDepto[2] ."</td>";
										echo "<td class = 'fonteTexto'>" .$linhaCampus[1] ."</td>";
										echo "</tr>";
										array_push($turmasProf, $linhaTurma[0]);

									}
								}
							?>
							</tbody>
							</table>
							<br>
						</div>
					</div>
				</div>
			<!-- </div>	 -->
		</div>
		
		<!-- Função para ir para a próxima página -->
		<script>	
			function EnviarID(ID){
				location.href = "../Opcoes-do-sistema/Manutencao-diario/PHJL-WEB-Escolhe-disciplina-diario.php?idTURMA=" +ID;
			}
		</script>
	</body>
</html>