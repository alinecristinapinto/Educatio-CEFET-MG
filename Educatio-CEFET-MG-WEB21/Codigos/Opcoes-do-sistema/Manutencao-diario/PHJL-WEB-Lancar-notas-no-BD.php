<?php
	session_start();
	//constantes utilizadas na conexão com o banco de dados
	define ("SERVIDOR", "localhost");
	define ("USUARIO", "root");
	define ("SENHA", "usbw");
	define ("BD", "educatio");
	
	$usuario = $_SESSION['usuario'];

	define ("IDPROF", $usuario['idSIAPE']);
	define ("IDTURMA", $_SESSION["IDTURMA"]);
	define ("IDDISCIPLINA", $_SESSION["IDDISCIPLINA"]);
	define ("IDCONTEUDO", $_SESSION["IDCONTEUDO"]);
	define ("IDATIVIDADE", $_SESSION["IDATIVIDADE"]);
	
	$erros = 0;
	
	//conexao com o BD
	$conn = mysqli_connect (SERVIDOR, USUARIO, SENHA);

	//Seleciona o BD
	$bd_select = mysqli_select_db ($conn, BD);
	
	$sql = "SELECT * FROM alunos WHERE idTurma = " .IDTURMA;
	$resultAlunos = mysqli_query($conn, $sql);
	
	while($linhaAlunos = mysqli_fetch_array($resultAlunos)){
		$sql = "SELECT * FROM matriculas WHERE idAluno = " .$linhaAlunos[0] ." AND idDisciplina = " .IDDISCIPLINA;
		$resultMatricula = mysqli_query($conn, $sql);
		$linhaMatriculas = mysqli_fetch_array($resultMatricula);
		
		$sql = "UPDATE diarios
		SET nota = '" .$_REQUEST["ID$linhaMatriculas[1]"] ."'
		WHERE idMatricula = " .$linhaMatriculas[0] ." AND idAtividade = " .IDATIVIDADE;
		
		if(!mysqli_query($conn, $sql)){
			$erros++;
			echo "Erro : " .mysqli_error($conn) ." idmatricula = " .$linhaMatriculas[0] ." idAtividade = " .IDATIVIDADE ." nota = " .$_REQUEST["ID$linhaAlunos[0]"];
		}
	}

	if($erros == 0){
		echo "SUCESSO";
	} else {
		echo "ERRO";
	}
?>