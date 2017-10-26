<?php
	//constantes utilizadas na conexão com o banco de dados
	define ("SERVIDOR", "localhost");
	define ("USUARIO", "root");
	define ("SENHA", "");
	define ("BD", "educatio");
	
	//CPF inserido na pagina "PHJL-WEB-Entrada-Formulario-de-alteracao.html"
	define ("CPF", $_POST["valorCPF"]);
	
	$erros = 0;
	
	//conexao com o BD
	$conn = mysqli_connect (SERVIDOR, USUARIO, SENHA);

	//Seleciona o BD
	$bd_select = mysqli_select_db ($conn, BD);

	//seleciona a linha em que o idCPF for igual ao CPF recebido
	$sql = "SELECT * FROM alunos WHERE idCPF = " .CPF;
	$result = mysqli_query($conn,$sql);
	

	//verifica se o ID inserido existe. Se nao, retorna para a pagina anterior
	if(!mysqli_num_rows($result) > 0){
	   //Id nao encontrado
	   header('location:PHJL-WEB-Pesquisa-deletar-aluno.php');
	   return;
	}
	
	$linha = mysqli_fetch_array($result);
	
	//verifica se o ativo do aluno é N, se sim volta para a pagina anterior
	if($linha[15] == 'N'){
		header('location:PHJL-WEB-Pesquisa-deletar-aluno.php');
		return;
	}
	
	$sql = "UPDATE alunos
    SET ativo = 'N'
    WHERE idCPF = " .CPF;
	
	//se houver erro ao inserir a alteracao do aluno redireciona à pagina de erro
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