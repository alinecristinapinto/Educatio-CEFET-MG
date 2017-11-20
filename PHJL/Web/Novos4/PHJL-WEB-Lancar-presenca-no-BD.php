<?php
	session_start();
	//constantes utilizadas na conexão com o banco de dados
	define ("SERVIDOR", "localhost");
	define ("USUARIO", "root");
	define ("SENHA", "");
	define ("BD", "educatio");
	
	define ("IDPROF", $_SESSION["IDPROF"]);
	define ("IDTURMA", $_SESSION["IDTURMA"]);
	define ("IDDISCIPLINA", $_SESSION["IDDISCIPLINA"]);
	define ("IDCONTEUDO", $_SESSION["IDCONTEUDO"]);
	
	if(isset($_GET["idatividade"])){
		$_SESSION["IDATIVIDADE"] = $_POST["idatividade"];
		define ("IDATIVIDADE", $_SESSION["IDATIVIDADE"]);
	}
	
	//conexao com o BD
	$conn = mysqli_connect (SERVIDOR, USUARIO, SENHA);

	//Seleciona o BD
	$bd_select = mysqli_select_db ($conn, BD);
	
	define ("NUMEROALUNOS", $_POST["numeroAlunos"]);
	
	$sql = "UPDATE diarios SET faltas = 1 WHERE idAtividade = " .$_SESSION["IDATIVIDADE"];
	$result = mysqli_query($conn, $sql);
	
	for($i = 0; $i < NUMEROALUNOS; $i++){
		if(isset($_POST["Aluno$i"])){
			$sql = "SELECT * FROM matriculas WHERE idAluno = " .$_POST["Aluno$i"];
			$result = mysqli_query($conn, $sql);
			$linhaMatricula = mysqli_fetch_array($result);
			$sql = "UPDATE diarios SET faltas = 0 WHERE idMatricula = " .$linhaMatricula[0] ." AND idAtividade = " .$_SESSION["IDATIVIDADE"];
			$result = mysqli_query($conn, $sql);
		}
	}
	
	header('Location:PHJL-WEB-Mostrar-conteudo.php');
?>