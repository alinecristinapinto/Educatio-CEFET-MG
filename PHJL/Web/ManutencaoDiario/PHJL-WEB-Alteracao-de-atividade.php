<?php 
	session_start();
	header('content-type: text/html; charset=ISO-8859-1');
	//constantes utilizadas na conexão com o banco de dados
	define ("SERVIDOR", "localhost");
	define ("USUARIO", "root");
	define ("SENHA", "");
	define ("BD", "educatio");
	
	//constantes com os valores enviados no formulario
	define ("IDCONTEUDO", $_SESSION["IDCONTEUDO"]);
	
	define ("IDATIVIDADE", $_REQUEST["idatividade"]);
	define ("ATIVIDADE", $_REQUEST["nomeatividade"]);
	define ("DATA", date_format(new DateTime($_REQUEST["data"]), "d/m/Y"));
	define ("VALOR", $_REQUEST["valor"]);
	
	$erros = 0;
	
	//conexao com mysql
	$conn = mysqli_connect (SERVIDOR, USUARIO, SENHA);
	
	//seleciona o bd
	$bd_select = mysqli_select_db ($conn, BD);
	
	//inserindo os valores recebidos no Banco de Dados em conteudos.
	$sql = "UPDATE atividades
	SET nome = '" .ATIVIDADE ."',
	data = '" .DATA ."',
	valor = '" .VALOR ."'
	WHERE id = " .IDATIVIDADE;
	
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