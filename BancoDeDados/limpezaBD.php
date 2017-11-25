<?php
###############################################################################################
	header("Content-type: text/html; charset=utf-8");
	ini_set('max_execution_time', 0); 
###############################################################################################
	$servername = "localhost";
	$username = "root";
	$password = "usbw";
	$bd = "educatio";
	$con = new mysqli($servername, $username, $password, $bd);
	
	mysqli_set_charset($con, "utf8");
	
	// TESTANDO A CONEXÃO
	if ($con -> connect_error) 
	{
	    die("Conexão falhou: " . $con -> connect_error);
	}
	
	echo "<b>".'Conexão bem sucedida.'."</b><br>";

###############################################################################################
	//APAGA O CONTEÚDO DE TODAS AS TABELAS DO BANCO DE DADOS

    $sql = "SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA LIKE '".$bd."'";
	$rst = $con->query($sql);
	$tables = $rst->fetch_all(MYSQLI_ASSOC);
	foreach($tables as $table)
	{
		$sql = "SELECT * FROM `".$table['TABLE_NAME']."`";
		$rst = $con->query($sql);
		if($rst->num_rows > 0)
	    {
	    	$sql = "TRUNCATE TABLE `".$table['TABLE_NAME']."`";
	        $rst = $con->query($sql);
	    }
	}

###############################################################################################
	echo "<b><h3>".'Dados apagados com sucesso.'."</b></h3>"

	/*
	//Apagando o conteúdo da tabela academicos
	$sqlTable = "TRUNCATE TABLE `academicos`";
 	$rstTable = $con->query($sqlTable);
	echo 'Tabela `academicos` limpa com sucesso'."<br>";

	//Apagando o conteúdo da tabela alunos
 	$sqlTable = "TRUNCATE TABLE `alunos`";
 	$rstTable = $con->query($sqlTable);
	echo 'Tabela `alunos` limpa com sucesso'."<br>";

	//Apagando o conteúdo da tabela atividades
 	$sqlTable = "TRUNCATE TABLE `atividades`";
 	$rstTable = $con->query($sqlTable);
	echo 'Tabela `atividades` limpa com sucesso'."<br>";

	//Apagando o conteúdo da tabela autorAcervo
 	$sqlTable = "TRUNCATE TABLE `autorAcervo`";
 	$rstTable = $con->query($sqlTable);
	echo 'Tabela `autorAcervo` limpa com sucesso'."<br>";

	//Apagando o conteúdo da tabela autores
 	$sqlTable = "TRUNCATE TABLE `autores`";
 	$rstTable = $con->query($sqlTable);
	echo 'Tabela `autores` limpa com sucesso'."<br>";

	//Apagando o conteúdo da tabela campi
 	$sqlTable = "TRUNCATE TABLE `campi`";
 	$rstTable = $con->query($sqlTable);
	echo 'Tabela `campi` limpa com sucesso'."<br>";

	//Apagando o conteúdo da tabela conteudos
 	$sqlTable = "TRUNCATE TABLE `conteudos`";
 	$rstTable = $con->query($sqlTable);
	echo 'Tabela `conteudos` limpa com sucesso'."<br>";

	//Apagando o conteúdo da tabela cursos
 	$sqlTable = "TRUNCATE TABLE `cursos`";
 	$rstTable = $con->query($sqlTable);
	echo 'Tabela `cursos` limpa com sucesso'."<br>";

	//Apagando o conteúdo da tabela deptos
 	$sqlTable = "TRUNCATE TABLE `deptos`";
 	$rstTable = $con->query($sqlTable);
	echo 'Tabela `deptos` limpa com sucesso'."<br>";

	//Apagando o conteúdo da tabela descartes
 	$sqlTable = "TRUNCATE TABLE `descartes`";
 	$rstTable = $con->query($sqlTable);
	echo 'Tabela `descartes` limpa com sucesso'."<br>";

	//Apagando o conteúdo da tabela diarios
 	$sqlTable = "TRUNCATE TABLE `diarios`";
 	$rstTable = $con->query($sqlTable);
	echo 'Tabela `diarios` limpa com sucesso'."<br>";

	//Apagando o conteúdo da tabela disciplinas
 	$sqlTable = "TRUNCATE TABLE `disciplinas`";
 	$rstTable = $con->query($sqlTable);
	echo 'Tabela `disciplinas` limpa com sucesso'."<br>";

	//Apagando o conteúdo da tabela emprestimos
 	$sqlTable = "TRUNCATE TABLE `emprestimos`";
 	$rstTable = $con->query($sqlTable);
	echo 'Tabela `emprestimos` limpa com sucesso'."<br>";

	//Apagando o conteúdo da tabela etapas
 	$sqlTable = "TRUNCATE TABLE `etapas`";
 	$rstTable = $con->query($sqlTable);
	echo 'Tabela `etapas` limpa com sucesso'."<br>";

	//Apagando o conteúdo da tabela funcionario
 	$sqlTable = "TRUNCATE TABLE `funcionario`";
 	$rstTable = $con->query($sqlTable);
	echo 'Tabela `funcionario` limpa com sucesso'."<br>";

	//Apagando o conteúdo da tabela livros
 	$sqlTable = "TRUNCATE TABLE `livros`";
 	$rstTable = $con->query($sqlTable);
	echo 'Tabela `livros` limpa com sucesso'."<br>";

	//Apagando o conteúdo da tabela matriculas
 	$sqlTable = "TRUNCATE TABLE `matriculas`";
 	$rstTable = $con->query($sqlTable);
	echo 'Tabela `matriculas` limpa com sucesso'."<br>";

	//Apagando o conteúdo da tabela midias
 	$sqlTable = "TRUNCATE TABLE `midias`";
 	$rstTable = $con->query($sqlTable);
	echo 'Tabela `midias` limpa com sucesso'."<br>";

	//Apagando o conteúdo da tabela partes
 	$sqlTable = "TRUNCATE TABLE `partes`";
 	$rstTable = $con->query($sqlTable);
	echo 'Tabela `partes` limpa com sucesso'."<br>";

	//Apagando o conteúdo da tabela periodicos
 	$sqlTable = "TRUNCATE TABLE `periodicos`";
 	$rstTable = $con->query($sqlTable);
	echo 'Tabela `periodicos` limpa com sucesso'."<br>";

	//Apagando o conteúdo da tabela profDisciplinas
 	$sqlTable = "TRUNCATE TABLE `profDisciplinas`";
 	$rstTable = $con->query($sqlTable);
	echo 'Tabela `profDisciplinas` limpa com sucesso'."<br>";

	//Apagando o conteúdo da tabela reservas
 	$sqlTable = "TRUNCATE TABLE `reservas`";
 	$rstTable = $con->query($sqlTable);
	echo 'Tabela `reservas` limpa com sucesso'."<br>";

	//Apagando o conteúdo da tabela turmas
 	$sqlTable = "TRUNCATE TABLE `turmas`";
 	$rstTable = $con->query($sqlTable);
	echo 'Tabela `turmas` limpa com sucesso'."<br>";
	*/
?>