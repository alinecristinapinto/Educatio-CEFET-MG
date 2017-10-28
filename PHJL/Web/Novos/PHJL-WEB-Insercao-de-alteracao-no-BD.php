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
	define ("IMAGEM", $_FILES['entradaFoto']['tmp_name']);
	define ("TAMANHO", $_FILES['entradaFoto']['size']);
	define ("TIPO", $_FILES['entradaFoto']['type']);
	define ("NOMEIMG", $_FILES['entradaFoto']['name']);
	define ("ERROIMG", $_FILES['entradaFoto']['error']);
	
	$erros = 0;
	
	//constante com o id recebido na primeira pagina
	define ("IDCPF", $_GET["idcpf"]);
	
	//conexao com mysql
	$conn = mysqli_connect (SERVIDOR, USUARIO, SENHA);
	
	//seleciona banco de dados
	$bd_select = mysqli_select_db ($conn, BD);
	
	//verifica se a foto foi inserida, se sim, le e armazena na variavel $conteudo
	if ((TAMANHO != 0) && (ERROIMG == 0)) {
		$fp = fopen(IMAGEM, "rb");
		$conteudo = fread($fp, TAMANHO);
		$conteudo = addslashes($conteudo);
		fclose($fp);
	}
	
	//atualiza os campos do aluno que esta sendo alterado
	if(defined('NOME')){
		$sql = "UPDATE alunos
		SET nome = '" .NOME ."'
		WHERE idCPF = " .IDCPF;
		if (!mysqli_query ($conn, $sql)) {
			$erros++;
		}
		echo "Erro : " . $sql . "<br>" . mysqli_error ($conn);
	}
	if(defined('SEXO')){
		$sql = "UPDATE alunos
		SET sexo = '" .SEXO ."'
		WHERE idCPF = " .IDCPF;
		if (!mysqli_query ($conn, $sql)) {
			$erros++;
		}
		echo "Erro : " . $sql . "<br>" . mysqli_error ($conn);
	}
	if(defined('NASC')){
		$sql = "UPDATE alunos
		SET nascimento = '" .NASC ."'
		WHERE idCPF = " .IDCPF;
		if (!mysqli_query ($conn, $sql)) {
			$erros++;
		}
		echo "Erro : " . $sql . "<br>" . mysqli_error ($conn);
	}
	if(defined('LOGRADOURO')){
		$sql = "UPDATE alunos
		SET logradouro = '" .LOGRADOURO ."'
		WHERE idCPF = " .IDCPF;
		if (!mysqli_query ($conn, $sql)) {
			$erros++;
		}
		echo "Erro : " . $sql . "<br>" . mysqli_error ($conn);
	}
	if(defined('NUMERO')){
		$sql = "UPDATE alunos
		SET numeroLogradouro = '" .NUMERO ."'
		WHERE idCPF = " .IDCPF;
		if (!mysqli_query ($conn, $sql)) {
			$erros++;
		}
		echo "Erro : " . $sql . "<br>" . mysqli_error ($conn);
	}
	if(defined('COMPLEMENTO')){
		$sql = "UPDATE alunos
		SET complemento = '" .COMPLEMENTO ."'
		WHERE idCPF = " .IDCPF;
		if (!mysqli_query ($conn, $sql)) {
			$erros++;
		}
		echo "Erro : " . $sql . "<br>" . mysqli_error ($conn);
	}
	if(defined('BAIRRO')){
		$sql = "UPDATE alunos
		SET bairro = '" .BAIRRO ."'
		WHERE idCPF = " .IDCPF;
		if (!mysqli_query ($conn, $sql)) {
			$erros++;
		}
		echo "Erro : " . $sql . "<br>" . mysqli_error ($conn);
	}
	if(defined('CIDADE')){
		$sql = "UPDATE alunos
		SET cidade = '" .CIDADE ."'
		WHERE idCPF = " .IDCPF;
		if (!mysqli_query ($conn, $sql)) {
			$erros++;
		}
		echo "Erro : " . $sql . "<br>" . mysqli_error ($conn);
	}
	if(defined('CEP')){
		$sql = "UPDATE alunos
		SET CEP = '" .CEP ."'
		WHERE idCPF = " .IDCPF;
		if (!mysqli_query ($conn, $sql)) {
			$erros++;
		}
		echo "Erro : " . $sql . "<br>" . mysqli_error ($conn);
	}
	if(defined('UF')){
		$sql = "UPDATE alunos
		SET UF = '" .UF ."'
		WHERE idCPF = " .IDCPF;
		if (!mysqli_query ($conn, $sql)) {
			$erros++;
		}
		echo "Erro : " . $sql . "<br>" . mysqli_error ($conn);
	}
	if(defined('EMAIL')){
		$sql = "UPDATE alunos
		SET email = '" .EMAIL ."'
		WHERE idCPF = " .IDCPF;
		if (!mysqli_query ($conn, $sql)) {
			$erros++;
		}
		echo "Erro : " . $sql . "<br>" . mysqli_error ($conn);
	}
	if((TAMANHO != 0) && (ERROIMG == 0)){
		$sql = "UPDATE alunos
		SET foto = '" .$conteudo ."'
		WHERE idCPF = " .IDCPF;
		if (!mysqli_query ($conn, $sql)) {
			$erros++;
		}
		echo "Erro : " . $sql . "<br>" . mysqli_error ($conn);
	}
	if(defined('IDTURMA')){
		$sql = "UPDATE alunos
		SET idTurma = '" .IDTURMA ."'
		WHERE idCPF = " .IDCPF;
		if (!mysqli_query ($conn, $sql)) {
			$erros++;
		}
		echo "Erro : " . $sql . "<br>" . mysqli_error ($conn);
	}
	if(defined('CPF')){
		$sql = "UPDATE alunos
		SET idCPF = '" .CPF ."'
		WHERE idCPF = " .IDCPF;
		if (!mysqli_query ($conn, $sql)) {
			$erros++;
		}
		echo "Erro : " . $sql . "<br>" . mysqli_error ($conn);
	}
	
	if ($erros == 0) {
		header('location:PHJL-WEB-Resultado.php?result=alterarSUCESSO');
	} else {
		echo "Erro : " . $sql . "<br>" . mysqli_error ($conn);
		header('location:PHJL-WEB-Resultado.php?result=alterarERRO');
	}
	
?>