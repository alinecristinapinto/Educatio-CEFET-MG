<?php
	
	//constantes utilizadas na conexão com o banco de dados
	define ("SERVIDOR", "localhost");
	define ("USUARIO", "root");
	define ("SENHA", "");
	define ("BD", "educatio");
	
	//constantes com os valores enviados no formulario
	define ("NOME", $_POST["entradaNome"]);
	define ("SEXO", $_POST["entradaSexo"]);
	//Formata a data do padrão Y-d-m para o padrão d/m/Y
	define ("NASC", date_format(new DateTime($_POST["entradaNascimento"]), "d/m/Y"));
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
	
	//variavel para controle de erros. Se $erros for maior que zero, ocorreu algum erro ao alterar o aluno, 
	//logo retorna para uma página de erro e não altera o Banco de Dados
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
	}elseif((ERROIMG != 0) && (ERROIMG != 4)){
		$erros++;
	}
	
	$sql = "SELECT * FROM alunos WHERE idCPF = " .IDCPF;
	$result = mysqli_query($conn,$sql);
	$linha = mysqli_fetch_array($result);
	
	
	
	//atualiza os campos do aluno que esta sendo alterado
	if((defined('IDTURMA')) && IDTURMA != $linha[1]){
		//deletando do Banco de Dados as matriculas antigas do aluno
		$sql = "DELETE FROM matriculas
		WHERE idAluno = " .IDCPF;

		if (!mysqli_query ($conn, $sql)) {
			$erros++;
			echo "Erro : " . $sql . "<br>" . mysqli_error ($conn);
		}
		
		//atualiza a turma do aluno
		$sql = "UPDATE alunos
		SET idTurma = '" .IDTURMA ."'
		WHERE idCPF = " .IDCPF;
		if (!mysqli_query ($conn, $sql)) {
			$erros++;
			echo "Erro : " . $sql . "<br>" . mysqli_error ($conn);
		}
		
		//insere as matriculas novas no BD
		$sql = "SELECT * FROM disciplinas WHERE idTurma = " .IDTURMA;
		$result = mysqli_query($conn,$sql);
		while($linhaDisciplina = mysqli_fetch_array($result)){
			$sql = "INSERT INTO matriculas
			(idAluno, idDisciplina, ano, ativo)
			VALUES 
			('" .CPF ."', '" .$linhaDisciplina[0] ."', '" .date("Y") ."', 'S')";
			
			if (!mysqli_query ($conn, $sql)) {
				$erros++;
				echo "Erro : " . $sql . "<br>" . mysqli_error ($conn);
			}
		}
	}
	if(defined('NOME') && NOME != $linha[2]){
		$sql = "UPDATE alunos
		SET nome = '" .NOME ."'
		WHERE idCPF = " .IDCPF;
		if (!mysqli_query ($conn, $sql)) {
			$erros++;
		echo "Erro : " . $sql . "<br>" . mysqli_error ($conn);
		}
	}
	if(defined('SEXO') && SEXO != $linha[3]){
		$sql = "UPDATE alunos
		SET sexo = '" .SEXO ."'
		WHERE idCPF = " .IDCPF;
		if (!mysqli_query ($conn, $sql)) {
			$erros++;
			echo "Erro : " . $sql . "<br>" . mysqli_error ($conn);
		}
	}
	if(defined('NASC') && NASC != $linha[4]){
		$sql = "UPDATE alunos
		SET nascimento = '" .NASC ."'
		WHERE idCPF = " .IDCPF;
		if (!mysqli_query ($conn, $sql)) {
			$erros++;
			echo "Erro : " . $sql . "<br>" . mysqli_error ($conn);
		}
	}
	if(defined('LOGRADOURO') && LOGRADOURO != $linha[5]){
		$sql = "UPDATE alunos
		SET logradouro = '" .LOGRADOURO ."'
		WHERE idCPF = " .IDCPF;
		if (!mysqli_query ($conn, $sql)) {
			$erros++;
			echo "Erro : " . $sql . "<br>" . mysqli_error ($conn);
		}
		
	}
	if(defined('NUMERO') && NUMERO != $linha[6]){
		$sql = "UPDATE alunos
		SET numeroLogradouro = '" .NUMERO ."'
		WHERE idCPF = " .IDCPF;
		if (!mysqli_query ($conn, $sql)) {
			$erros++;
			echo "Erro : " . $sql . "<br>" . mysqli_error ($conn);
		}
		
	}
	if(defined('COMPLEMENTO') && COMPLEMENTO != $linha[7]){
		$sql = "UPDATE alunos
		SET complemento = '" .COMPLEMENTO ."'
		WHERE idCPF = " .IDCPF;
		if (!mysqli_query ($conn, $sql)) {
			$erros++;
			echo "Erro : " . $sql . "<br>" . mysqli_error ($conn);
		}
	}
	if(defined('BAIRRO') && BAIRRO != $linha[8]){
		$sql = "UPDATE alunos
		SET bairro = '" .BAIRRO ."'
		WHERE idCPF = " .IDCPF;
		if (!mysqli_query ($conn, $sql)) {
			$erros++;
			echo "Erro : " . $sql . "<br>" . mysqli_error ($conn);
		}
	}
	if(defined('CIDADE') && CIDADE != $linha[9]){
		$sql = "UPDATE alunos
		SET cidade = '" .CIDADE ."'
		WHERE idCPF = " .IDCPF;
		if (!mysqli_query ($conn, $sql)) {
			$erros++;
			echo "Erro : " . $sql . "<br>" . mysqli_error ($conn);
		}
	}
	if(defined('CEP') && CEP != $linha[10]){
		$sql = "UPDATE alunos
		SET CEP = '" .CEP ."'
		WHERE idCPF = " .IDCPF;
		if (!mysqli_query ($conn, $sql)) {
			$erros++;
			echo "Erro : " . $sql . "<br>" . mysqli_error ($conn);
		}
	}
	if(defined('UF') && UF != $linha[11]){
		$sql = "UPDATE alunos
		SET UF = '" .UF ."'
		WHERE idCPF = " .IDCPF;
		if (!mysqli_query ($conn, $sql)) {
			$erros++;
			echo "Erro : " . $sql . "<br>" . mysqli_error ($conn);
		}
	}
	if(defined('EMAIL') && EMAIL != $linha[12]){
		$sql = "UPDATE alunos
		SET email = '" .EMAIL ."'
		WHERE idCPF = " .IDCPF;
		if (!mysqli_query ($conn, $sql)) {
			$erros++;
			echo "Erro : " . $sql . "<br>" . mysqli_error ($conn);
		}
	}
	if((TAMANHO != 0) && (ERROIMG == 0)){
		$sql = "UPDATE alunos
		SET foto = '" .$conteudo ."'
		WHERE idCPF = " .IDCPF;
		if (!mysqli_query ($conn, $sql)) {
			$erros++;
			echo "Erro : " . $sql . "<br>" . mysqli_error ($conn);
		}
	}
	if(defined('CPF') && CPF != $linha[0]){
		//Antes de alterar o CPF no BD, iremos alterar o CPF de cada uma das matrículas com que o aluno estava vinculado
		$sql = "UPDATE matriculas
		SET idAluno = '" .CPF ."'
		WHERE idAluno = " .IDCPF;
		if (!mysqli_query ($conn, $sql)) {
			$erros++;
			echo "Erro : " . $sql . "<br>" . mysqli_error ($conn);
		}
		
		//Agora o CPF é alterado
		$sql = "UPDATE alunos
		SET idCPF = '" .CPF ."'
		WHERE idCPF = " .IDCPF;
		if (!mysqli_query ($conn, $sql)) {
			$erros++;
			echo "Erro : " . $sql . "<br>" . mysqli_error ($conn);
		}
		
	}
	
	if ($erros == 0) {
		header('location:PHJL-WEB-Resultado.php?result=alterarSUCESSO');
		return;
	} else {
		header('location:PHJL-WEB-Resultado.php?result=alterarERRO');
		return;
	}
	
?>