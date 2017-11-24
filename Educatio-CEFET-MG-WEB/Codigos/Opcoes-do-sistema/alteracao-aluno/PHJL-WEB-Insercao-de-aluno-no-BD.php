<?php 
	header('content-type: text/html; charset=ISO-8859-1');
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
	
	//Aqui a função str_replace é utilizada para filtrar o CPF e enviar para o BD apenas números, sem pontos nem traços.
	//O str_replace mais interno irá retirar os pontos e o str_replace mais externo irá retirar os traços que sobrarem.
	define ("CPF", str_replace ("-" , "" , str_replace("." , "" , $_POST["entradaCPF"])));
	define ("LOGRADOURO", $_POST["entradaLogradouro"]);
	define ("NUMERO", $_POST["entradaNumero"]);
	define ("COMPLEMENTO", $_POST["entradaComplemento"]);
	define ("BAIRRO", $_POST["entradaBairro"]);
	define ("CIDADE", $_POST["entradaCidade"]);
	
	//O mesmo do CPF porém retira apenas traços
	define ("CEP", str_replace("-" , "" ,$_POST["entradaCEP"]));
	define ("UF", $_POST["entradaUF"]);
	define ("EMAIL", $_POST["entradaEmail"]);
	define ("IDTURMA", $_POST["entradaTurma"]);
	define ("IMAGEM", $_FILES['entradaFoto']['tmp_name']);
	define ("TAMANHO", $_FILES['entradaFoto']['size']);
	define ("TIPO", $_FILES['entradaFoto']['type']);
	define ("NOMEIMG", $_FILES['entradaFoto']['name']);
	
	//Variável utilizada para controle de erros
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
	."', '" .CEP ."', '" .UF ."', '" .EMAIL ."', '$conteudo', 'd41d8cd98f00b204e9800998ecf8427e', 'N')";
	
	if (!mysqli_query ($conn, $sql)) {
		$erros++;
	}
	

	//se houver erro ao inserir aluno redireciona à pagina de erro e se nao, redireciona à pagina de criação de matricula, 
	//enviando pela url alguns dados que serão utilizados para criá-la
	if ($erros == 0) {
		header('location:PHJL-WEB-Insercao-matricula-no-BD.php?cpf=' .CPF .'&turma=' .IDTURMA);
		return;
	} else {
		header('location:PHJL-WEB-Resultado.php?result=inserirERRO');
		return;
	}
?>