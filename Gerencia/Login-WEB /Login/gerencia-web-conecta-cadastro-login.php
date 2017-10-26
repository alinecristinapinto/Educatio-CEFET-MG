<?php 

	include "gerencia-web-cadastro-login.php";

	$login = $_POST['idsuario'];
	$senha = md5($_POST['senha']); 
	$confirmaSenha = md5($_POST['confirmaSenha']); 
	$opcao = $_POST['opcao'];

	if($opcao == 'Aluno(a)')
	{
		if(Cadastra::CadastrarAluno($login, $senha, $confirmaSenha)){}
	} 

	else if ($opcao == 'Professor(a)')
	{
		if(Cadastra::CadastrarProfessor($login, $senha, $confirmaSenha)){}			
	}
		
	else if ($opcao == 'Bibliotecário(a)')
	{
		if(Cadastra::CadastrarBibliotecario($login, $senha, $confirmaSenha)){}			
	} 
		
	else if ($opcao == 'Coordenador(a)')
	{
		if(Cadastra::CadastrarCoordenador($login, $senha, $confirmaSenha)){}				
	}

?>
