<?php 
	session_start();
	//constantes utilizadas na conexão com o banco de dados
	define ("SERVIDOR", "localhost");
	define ("USUARIO", "root");
	define ("SENHA", "");
	define ("BD", "educatio");
	
	//constantes com os valores enviados no formulario
	define ("IDDISCIPLINA", $_SESSION["IDDISCIPLINA"]);
	define ("IDPROFDISCIPLINAS", $_SESSION["IDPROFDISCIPLINAS"]);
	define ("IDCONTEUDO", $_SESSION["IDCONTEUDO"]);
	
	define ("ATIVIDADE", $_REQUEST["atividade"]);
	define ("DATA", date_format(new DateTime($_REQUEST["data"]), "d/m/Y"));
	define ("VALOR", $_REQUEST["valor"]);
	
	$erros = 0;
	
	//conexao com mysql
	$conn = mysqli_connect (SERVIDOR, USUARIO, SENHA);
	
	//seleciona o bd
	$bd_select = mysqli_select_db ($conn, BD);
	
	//inserindo os valores recebidos no Banco de Dados em conteudos.
	$sql = "INSERT INTO atividades
	(idProfDisciplina, nome, data, valor, ativo)
	VALUES 
	('" .IDPROFDISCIPLINAS ."', '" .ATIVIDADE ."', '" .DATA ."', '" .VALOR ."', 'S')";
	
	if (!mysqli_query ($conn, $sql)) {
		$erros++;
	}
	
	$sql = "SELECT * FROM atividades WHERE id=(SELECT MAX(id) FROM atividades)";
	$result = mysqli_query($conn, $sql);
	$linhaAtividade = mysqli_fetch_array($result);
	
	$sql = "SELECT * FROM alunos";
	$result = mysqli_query($conn, $sql);
	
	while($linhaAlunos = mysqli_fetch_array($result)){
		//aqui pesquisarei a matricula do aluno 
		
		$sql = "INSERT INTO diarios
		(idConteudo, idMatricula, idAtividade, faltas, nota, ano, ativo)
		VALUES
		('" .IDCONTEUDO ."', '" .IDMATRICULA ."', '" .$linhaAtividade[0] ."', '0', '0.00', '" .date("Y") ."')";
	}
	
	if ($erros == 0) {
		echo "<span id = 'Atividade" .$linhaAtividade[0] ."ID' >" .ATIVIDADE ."&emsp;<a href='PHJL-WEB-Lancar-presenca-diario.php?idatividade=$linhaAtividade[0]' > + Presença </a></span> <br> <span style = 'cursor : pointer;' id = 'novaAtividadeID' onclick = 'insereAtividade(this.id)'> + Adicionar Atividade </span>";
		return;
	} else {
		echo "FAIL";
		return;
	}
?>