<?php 
	session_start();
	//constantes utilizadas na conexão com o banco de dados
	define ("SERVIDOR", "localhost");
	define ("USUARIO", "root");
	define ("SENHA", "");
	define ("BD", "educatio");
	
	//constantes com os valores enviados no formulario
	define ("IDDISCIPLINA", $_SESSION["IDDISCIPLINA"]);
	
	define ("CONTEUDO", $_REQUEST["conteudo"]);
	define ("IDETAPA", $_REQUEST["etapa"]);
	define ("DATA", date_format(new DateTime($_REQUEST["data"]), "d/m/Y"));
	
	$erros = 0;
	
	//conexao com mysql
	$conn = mysqli_connect (SERVIDOR, USUARIO, SENHA);
	
	//seleciona o bd
	$bd_select = mysqli_select_db ($conn, BD);
	
	//inserindo os valores recebidos no Banco de Dados em conteudos.
	$sql = "INSERT INTO conteudos
	(idEtapa, idDisciplina, conteudo, datas, ativo)
	VALUES 
	('" .IDETAPA ."', '" .IDDISCIPLINA ."', '" .CONTEUDO ."', '" .DATA ."', 'S')";
	
	if (!mysqli_query ($conn, $sql)) {
		$erros++;
	}
	
	$sql = "SELECT * FROM conteudos WHERE id=(SELECT MAX(id) FROM conteudos)";
	$result = mysqli_query($conn, $sql);
	$linhaConteudo = mysqli_fetch_array($result);
	
	if ($erros == 0) {
		echo "<span id = 'Conteudo" .$linhaConteudo[0] ."Bim" .$linhaConteudo[1] ."ID' onclick = 'mostraConteudo(" .$linhaConteudo[0] .")'>" .CONTEUDO ."</span> <br> <span style = 'cursor : pointer;' id = 'novoConteudoBim" .IDETAPA ."' onclick = 'insereConteudo(this.id, " .IDETAPA .", " .IDDISCIPLINA .")'> + Adicionar Conteúdo </span>";
		return;
	} else {
		echo "FAIL";
		return;
	}
?>