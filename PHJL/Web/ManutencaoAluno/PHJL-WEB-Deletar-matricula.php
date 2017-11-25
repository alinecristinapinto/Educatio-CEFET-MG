<?php
	
	//constantes utilizadas na conexão com o banco de dados
	define ("SERVIDOR", "localhost");
	define ("USUARIO", "root");
	define ("SENHA", "");
	define ("BD", "educatio");
	
	//CPF inserido na pagina "PHJL-WEB-Entrada-Formulario-de-alteracao.html"
	define ("CPF", $_GET["valorCPF"]);
	
	$erros = 0;
	
	//conexao com o BD
	$conn = mysqli_connect (SERVIDOR, USUARIO, SENHA);

	//Seleciona o BD
	$bd_select = mysqli_select_db ($conn, BD);

	//seleciona a linha em que o idCPF for igual ao CPF recebido
	$sql = "UPDATE matriculas
	SET ativo = 'N'
	WHERE idAluno = " .CPF;
	
	if (!mysqli_query ($conn, $sql)) {
		$erros++;
	}
	
	if ($erros == 0) {
		header('location:PHJL-WEB-Resultado.php?result=deletarSUCESSO');
		return;
	} else {
		header('location:PHJL-WEB-Resultado.php?result=deletarERRO');
		return;
	}
?>