<?php 
	session_start();
	header('content-type: text/html; charset=ISO-8859-1');
	//constantes utilizadas na conexão com o banco de dados
	define ("SERVIDOR", "localhost");
	define ("USUARIO", "root");
	define ("SENHA", "usbw");
	define ("BD", "educatio");
	
	
	define ("IDATIVIDADE", $_REQUEST["idatividade"]);
	
	$erros = 0;
	
	//conexao com mysql
	$conn = mysqli_connect (SERVIDOR, USUARIO, SENHA);
	
	//seleciona o bd
	$bd_select = mysqli_select_db ($conn, BD);
	
	//Alterando os ativos para 'N'
	$sql = "UPDATE atividades
	SET ativo = 'N' 
	WHERE id = " .IDATIVIDADE;
	
	if (!mysqli_query ($conn, $sql)) {
		$erros++;
	}
	
	$sql = "UPDATE diarios
	SET ativo = 'N' 
	WHERE idAtividade = " .IDATIVIDADE;
	
	if (!mysqli_query ($conn, $sql)) {
		$erros++;
	}
	
	if ($erros == 0) {
		echo "SUCESSO";
		return;
	} else {
		echo "ERRO";
		return;
	}
?>