<?php
	
	include 'gerencia-web-login.php';
	session_start();

	if (isset($_POST['CPFUsuario']) && isset($_POST['senha']) && isset($_POST['opcao'])) {
    	$login = $_POST['CPFUsuario'];
		$senha = md5($_POST['senha']); //colocar md5
		$opcao = $_POST['opcao'];

		if($opcao == 'Aluno(a)')
		{

		if ( $usuario = Login::logarAluno($login, $senha))
		{
	 		
	 		$_SESSION['usuario'] = $usuario;

	 		echo "
				<script> 
					location.href = '../Entrada/gerencia-web-escolha-sistema-aluno.php';
				</script>";		 
	 	}
	
	} 

	else if ($opcao == 'Professor(a)')
	{
	
		if ( $usuario = Login::logarFuncionario($login, $senha, 'Professor'))
		{
	 	
	 		$_SESSION['usuario'] = $usuario;
	 		echo "
				<script> 
					location.href = '../Entrada/gerencia-web-perfil-professor.php';
				</script>";	
	 	
	 	} 
	
	}
	
	else if ($opcao == 'Bibliotecário(a)')
	{
	
		if ( $usuario = Login::logarFuncionario($login, $senha, 'Bibliotecario'))
		{
	 	
	 		$_SESSION['usuario'] = $usuario;
	 		echo "
				<script> 
					location.href = '../Entrada/gerencia-web-perfil-bibliotecario.php';
				</script>";		
	 	
	 	} 
	
	} 
	
	else if ($opcao == 'Coordenador(a)')
	{
		
		if ( $usuario = Login::logarFuncionario($login, $senha, 'Coordenador'))
		{
	 		
	 		$_SESSION['usuario'] = $usuario;
	 		echo "
				<script> 
					location.href = '../Entrada/gerencia-web-perfil-coordenador.php';
				</script>";	
	 	
	 	} 
	
	}




	}  else {
		exit;
	}	


	

?>
