<?php 
	session_start();
	header('content-type: text/html; charset=ISO-8859-1');
	//constantes utilizadas na conexão com o banco de dados
	define ("SERVIDOR", "localhost");
	define ("USUARIO", "root");
	define ("SENHA", "usbw");
	define ("BD", "educatio");
	
	//constantes com os valores enviados no formulario
	define ("IDCONTEUDO", $_SESSION["IDCONTEUDO"]);
	
	$erros = 0;
	
	//conexao com mysql
	$conn = mysqli_connect (SERVIDOR, USUARIO, SENHA);
	
	//seleciona o bd
	$bd_select = mysqli_select_db ($conn, BD);
	
	//muda o ativo para 'N'
	$sql = "UPDATE conteudos
	SET ativo = 'N' 
	WHERE id = " .IDCONTEUDO;
	
	if (!mysqli_query ($conn, $sql)) {
		$erros++;
	}
	
	//muda o ativo dos diarios daquele conteudo para 'N'
	$sql = "UPDATE diarios
	SET ativo = 'N' 
	WHERE idConteudo = " .IDCONTEUDO;
	
	if (!mysqli_query ($conn, $sql)) {
		$erros++;
	}
	
	//muda o ativo das atividades daquele conteudo para 'N'
	$sql = "SELECT * FROM diarios WHERE idConteudo = " .IDCONTEUDO;
	$resultDiario = mysqli_query($conn, $sql);
	while($linhaDiarios = mysqli_fetch_array($resultDiario)){
		$sql = "UPDATE atividades SET ativo = 'N' WHERE id = " .$linhaDiarios[3];
		
		if (!mysqli_query ($conn, $sql)) {
			$erros++;
		}
	}
	
	if ($erros == 0) {
		echo "SUCESSO";
		return;
	} else {
		echo "ERRO";
		return;
	}
?>