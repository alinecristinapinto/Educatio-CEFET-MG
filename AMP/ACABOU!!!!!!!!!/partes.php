<?php

		$sqlConexao = mysqli_connect("localhost", "root", "", "educatio");
		if (!$sqlConexao) {
			die("Conexão falhou: " . mysqli_connect_error());
		}


		$sqlIdAcervo = "SELECT  MAX(id) FROM periodicos";

		$result = mysqli_query($sqlConexao, $sqlIdAcervo);

		$aux = mysqli_fetch_array($result);
		
		$intIdAcervo = $aux[0];

		$titulo = $_POST["titulo"];

		$inicial = $_POST["inicial"];

		$final = $_POST["final"];

		$chaves = $_POST["chaves"];

		$sql = "INSERT INTO partes (idPeriodico, titulo, pagInicio, pagFinal, palavrasChave, ativo)
		VALUES ('$intIdAcervo', '$titulo', '$inicial', '$final', '$chaves', 'S')";

		if ($sqlConexao->query($sql) === TRUE) {
		   
		}	


		echo "<script>location.href='criapartes.php';</script>";


?>