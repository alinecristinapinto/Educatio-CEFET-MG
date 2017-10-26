<?php 

	//constantes utilizadas na conexão com o banco de dados
	define ("SERVIDOR", "localhost");
	define ("USUARIO", "root");
	define ("SENHA", "");
	define ("BD", "educatio");
	
	//constantes com os valores enviados no formulario
	define ("NOME", $_POST["entradaNome"]);
	define ("SEXO", $_POST["entradaSexo"]);
	define ("NASC", $_POST["entradaNascimento"]);
	define ("CPF", $_POST["entradaCPF"]);
	define ("LOGRADOURO", $_POST["entradaLogradouro"]);
	define ("NUMERO", $_POST["entradaNumero"]);
	define ("COMPLEMENTO", $_POST["entradaComplemento"]);
	define ("BAIRRO", $_POST["entradaBairro"]);
	define ("CIDADE", $_POST["entradaCidade"]);
	define ("CEP", $_POST["entradaCEP"]);
	define ("UF", $_POST["entradaUF"]);
	define ("EMAIL", $_POST["entradaEmail"]);
	define ("IDTURMA", $_POST["entradaTurma"]);
	define("IMAGEM", $_FILES['entradaFoto']['tmp_name']);
	define("TAMANHO", $_FILES['entradaFoto']['size']);
	define("TIPO", $_FILES['entradaFoto']['type']);
	define("NOMEIMG", $_FILES['entradaFoto']['name']);
	
	$erros = 0;
	
	//conexao com mysql
	$conn = mysqli_connect (SERVIDOR, USUARIO, SENHA);
	
	//seleciona o bd
	$bd_select = mysqli_select_db ($conn, BD);
	
	if ( IMAGEM != "none" ) {
		$fp = fopen(IMAGEM, "rb");
		$conteudo = fread($fp, TAMANHO);
		$conteudo = addslashes($conteudo);
		fclose($fp);
		
	} else {
		print "Não foi possível carregar a imagem.";
	}
	
	//inserindo os valores recebidos pelo formulario no Banco de Dados em alunos.
	$sql = "INSERT INTO alunos
	(idCPF, idTurma, nome, sexo, nascimento, logradouro, numeroLogradouro, complemento, bairro, cidade, CEP, UF, email, foto, senha, ativo)
	VALUES 
	('" .CPF ."', '" .IDTURMA ."', '" .NOME ."', '" .SEXO ."', '" .NASC ."', '" .LOGRADOURO 
	."', '" .NUMERO ."', '" .COMPLEMENTO ."', '" .BAIRRO ."', '" .CIDADE 
	."', '" .CEP ."', '" .UF ."', '" .EMAIL ."', '$conteudo', '', 'N')";
	
	//se houver erro ao inserir aluno redireciona à pagina de erro
	if (!mysqli_query ($conn, $sql)) {
		$erros++;
	}
	
	//inserindo os valores recebidos pelo formulario no Banco de Dados em matriculas.
	$sql = "INSERT INTO matriculas
	(idAluno, idDisciplina, ano, ativo)
	VALUES 
	('" .CPF ."', '0', '" .date("Y") ."', 'N')";
	
	if (!mysqli_query ($conn, $sql)) {
		$erros++;
	}

	//se houver erro ao inserir aluno redireciona à pagina de erro e se nao, redireciona à pagina de sucesso
	if ($erros == 0) {
		header('location:PHJL-WEB-Resultado.php?result=inserirSUCESSO');
	} else {
		header('location:PHJL-WEB-Resultado.php?result=inserirERRO');
	}

?>