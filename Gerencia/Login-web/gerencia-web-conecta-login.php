<?php

	include 'gerencia-web-login.php';

	$login = $_POST['CPFUsuario'];
	$senha = $_POST['senha'];
	$opcao = $_POST['opcao'];

	//if($opcao == 'Aluno(a)'){}

	if ( $usuario = Login::logarAluno($login, $senha)) {
 		session_start();
 		$_SESSION['usuario'] = $usuario;	
 		
 	}

?>
