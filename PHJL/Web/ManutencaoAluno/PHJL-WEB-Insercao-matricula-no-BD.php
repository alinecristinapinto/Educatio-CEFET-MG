<?php
	header('content-type: text/html; charset=ISO-8859-1');
	//constantes utilizadas na conexão com o banco de dados
	define ("SERVIDOR", "localhost");
	define ("USUARIO", "root");
	define ("SENHA", "");
	define ("BD", "educatio");
	
	//constantes com os valores enviados no formulario
	define ("CPF", $_GET["cpf"]);
	define ("IDTURMA", $_GET["turma"]);
	
	//conexao com o BD
	$conn = mysqli_connect (SERVIDOR, USUARIO, SENHA);
	
	//Seleciona o BD
	$bd_select = mysqli_select_db ($conn, BD);
	
	//seleciona a linha em que o idCPF for igual ao CPF recebido
	$sql = "SELECT * FROM disciplinas WHERE idTurma = " .IDTURMA;
	$result = mysqli_query($conn,$sql);
	while($linha = mysqli_fetch_array($result)){
		$sql = "INSERT INTO matriculas
		(idAluno, idDisciplina, ano, ativo)
		VALUES 
		('" .CPF ."', '" .$linha[0] ."', '" .date("Y") ."', 'S')";
		if (!mysqli_query ($conn, $sql)) {
			$erros++;
		}
	}
	
	if ($erros == 0) {
		header('location:PHJL-WEB-Resultado.php?result=inserirSUCESSO');
		return;
	} else {
		echo "Erro : " . $sql . "<br>" . mysqli_error ($conn);
		header('location:PHJL-WEB-Resultado.php?result=inserirERRO');
		return;
	}
?>