<?php

//constantes utilizadas na conexão com o banco de dados
	define ("SERVIDOR", "localhost");
	define ("USUARIO", "root");
	define ("SENHA", "");
	define ("BD", "educatio");
	
	//conexao com o BD
	$conn = mysqli_connect (SERVIDOR, USUARIO, SENHA);

	//Seleciona o BD
	$bd_select = mysqli_select_db ($conn, BD);
	
	//String que será retornada ao client-side que conterá options que serão inseridos em selects
	$valorRetorno = "";
	
	define ("VALOR_RECEBIDO", $_REQUEST["valor"]);
	if(isset($_REQUEST["id"])){
		define ("ID", $_REQUEST["id"]);
	}
	
	if(VALOR_RECEBIDO == "campi"){
		$sql = "SELECT * FROM deptos WHERE idCampi = " .ID;
		$result = mysqli_query($conn, $sql);
		
		$valorRetorno = "<option disabled selected value = ''> Selecione um Departamento </option>";
		while($linha = mysqli_fetch_array($result)){
			$valorRetorno .= "<option value = " .$linha[0] .">" .$linha[2] ."</option>";
		}
	}elseif(VALOR_RECEBIDO == "deptos"){
		$sql = "SELECT * FROM cursos WHERE idDepto = " .ID;
		$result = mysqli_query($conn, $sql);
		
		$valorRetorno = "<option disabled selected value = ''> Selecione um Curso </option>";
		while($linha = mysqli_fetch_array($result)){
			$valorRetorno .= "<option value = " .$linha[0] .">" .$linha[2] ."</option>";
		}
	}elseif(VALOR_RECEBIDO == "cursos"){
		$sql = "SELECT * FROM turmas WHERE idCurso = " .ID;
		$result = mysqli_query($conn, $sql);
		
		$valorRetorno = "<option disabled selected value = ''> Selecione uma Turma </option>";
		while($linha = mysqli_fetch_array($result)){
			//Irá mostrar ao usuário apenas turmas ativas e do 1º ano
			if(($linha[4] == 'S') && ($linha[2] == 1)){
				//o substr_replace irá retornar a string de, por exemplo, MEI A --> MEI 1A
				$valorRetorno .= "<option value = " .$linha[0] .">" .substr_replace($linha[3],$linha[2],strlen($linha[3]) - 1,0) ."</option>";
			}
		}
	}
	
	echo $valorRetorno;
?>