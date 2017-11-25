<?php

		$sqlConexao = mysqli_connect("localhost", "root", "", "educatio");
		if (!$sqlConexao) {
			die("Conexão falhou: " . mysqli_connect_error());
		}


		$sqlIdAcervo = "SELECT  MAX(id) FROM acervo";

		$result = mysqli_query($sqlConexao, $sqlIdAcervo);

		$aux = mysqli_fetch_array($result);
		
		$intIdAcervo = $aux[0];

		$charNome = $_POST["nome"];

		$charSobrenome = $_POST["sobrenome"];

		$charOrdem = $_POST["ordem"];

		$qualificacao = $_POST["qualificacao"];

		$sql = "INSERT INTO autores (nome, sobrenome, ordem, qualificacao, ativo)
		VALUES ('$charNome', '$charSobrenome', '$charOrdem', '$qualificacao', 'S')";

		if ($sqlConexao->query($sql) === TRUE) {
		   
		}
	

		//$sqlInsereAutor = "INSERT INTO autores (nome, sobrenome, ordem, qualificacao, ativo) VALUES ('$_POST["nome"]','$_POST["sobrenome"]','$_POST["ordem"]', '$_POST["qualificacao"]','S')";
		
		//$result = mysqli_query($sqlConexao, $sqlInsereAutor);
	

		$sqlIdAutor = "SELECT  MAX(id) FROM autores";

		$result = mysqli_query($sqlConexao, $sqlIdAutor);

		$aux2 = mysqli_fetch_array($result);
		
		$intIdAutor = $aux2[0];

		$sqlInsereAutor2 = "INSERT INTO autoracervo (idAcervo, idAutor, ativo) VALUES ('$intIdAcervo', '$intIdAutor', 'S')";
		
		$result = mysqli_query($sqlConexao, $sqlInsereAutor2);

		echo "<script>location.href='cria_autor.php';</script>";


?>