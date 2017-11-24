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
	
	define ("CONTEUDO", $_REQUEST["conteudo"]);
	define ("IDETAPA", $_REQUEST["idetapa"]);
	define ("DATA", date_format(new DateTime($_REQUEST["data"]), "d/m/Y"));
	
	
	$erros = 0;
	
	//conexao com mysql
	$conn = mysqli_connect (SERVIDOR, USUARIO, SENHA);
	
	//seleciona o bd
	$bd_select = mysqli_select_db ($conn, BD);
	
	//inserindo os valores recebidos no Banco de Dados em conteudos.
	$sql = "UPDATE conteudos
	SET conteudo = '" .CONTEUDO ."',
	idEtapa = '" .IDETAPA ."',
	datas = '" .DATA ."' 
	WHERE id = " .IDCONTEUDO;
	
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