<?php
header('content-type: text/html; charset=ISO-8859-1');

//constantes utilizadas na conexão com o banco de dados
	define ("SERVIDOR", "localhost");
	define ("USUARIO", "root");
	define ("SENHA", "");
	define ("BD", "educatio");
	
	//conexao com o BD
	$conn = mysqli_connect (SERVIDOR, USUARIO, SENHA);

	//Seleciona o BD
	$bd_select = mysqli_select_db ($conn, BD);
	
	$sql = "SELECT * FROM alunos";
	$result = mysqli_query($conn,$sql);
	
	//Pega o valor de q enviado pela URL e armazena na constante VALOR_RECEBIDO.
	//O tipo eh utilizado para saber se o usuario digitou no campo de nome ou de cpf e identificar por onde o aluno sera pesquisado (nome ou cpf)
	//Se tipo nao for setado significa que a tabela devera ser mostrada por completo, logo nao ha necessidade de um tipo pois nao havera pesquisa
	define ("VALOR_RECEBIDO", $_REQUEST["q"]);
	define ("TIPO", $_REQUEST["tipo"]);
	define ("VALOR_FILTRO", $_REQUEST["valorfiltro"]);
	define ("TIPO_FILTRO", $_REQUEST["tipofiltro"]);
	
	//valor que sera retornado
	$valorRetornado = "";
	
	if(VALOR_RECEBIDO == ""){
		$valorRetornado = "<thead><tr><th>CPF</th><th>Nome</th></tr></thead><tbody style = 'cursor: pointer;'>";
		
		while($linha = mysqli_fetch_array($result)){
			if($linha[15] == 'S'){
				
				$sql = "SELECT * FROM turmas WHERE id = " .$linha[1];
				$resultTurma = mysqli_query($conn,$sql);
				$linhaTurmas = mysqli_fetch_array($resultTurma);
				
				$sql = "SELECT * FROM cursos WHERE id = " .$linhaTurmas[1];
				$resultCurso = mysqli_query($conn,$sql);
				$linhaCursos = mysqli_fetch_array($resultCurso);
				
				$sql = "SELECT * FROM deptos WHERE id = " .$linhaCursos[1];
				$resultDepto = mysqli_query($conn,$sql);
				$linhaDeptos = mysqli_fetch_array($resultDepto);
				
				if((TIPO_FILTRO == "turmas" && ($linha[1] == VALOR_FILTRO || VALOR_FILTRO == "0")) || (TIPO_FILTRO == "cursos" && 
				   ($linhaTurmas[1] == VALOR_FILTRO || VALOR_FILTRO == "0")) || (TIPO_FILTRO == "deptos" && ($linhaCursos[1] == VALOR_FILTRO || 
				   VALOR_FILTRO == "0")) || (TIPO_FILTRO == "campi" && ($linhaDeptos[1] == VALOR_FILTRO || VALOR_FILTRO == "0")) || (TIPO_FILTRO == "0")){
					$valorRetornado .= "<tr onclick=\"enviaFormulario('" .$linha[0] ."')\"><td>$linha[0]</td><td>$linha[2]</td></tr>";
				}
			}
		}
		$valorRetornado .= "</tbody>";
	}elseif ((VALOR_RECEBIDO !== "") && (TIPO == "nome")) {
		while($linha = mysqli_fetch_array($result)){
			//stripos(string,valor) procura a primeira ocorrencia de 'valor' em 'string' e retorna FALSE se 'valor' nao for encontrado
			if (stripos($linha["2"],VALOR_RECEBIDO) !== FALSE) {
				if((TIPO_FILTRO == "turmas" && ($linha[1] == VALOR_FILTRO || VALOR_FILTRO == "0")) || (TIPO_FILTRO == "cursos" && 
				   ($linhaTurmas[1] == VALOR_FILTRO || VALOR_FILTRO == "0")) || (TIPO_FILTRO == "deptos" && ($linhaCursos[1] == VALOR_FILTRO || 
				   VALOR_FILTRO == "0")) || (TIPO_FILTRO == "campi" && ($linhaDeptos[1] == VALOR_FILTRO || VALOR_FILTRO == "0")) || (TIPO_FILTRO == "0")){
					if (($valorRetornado === "") && ($linha[15] == 'S')) {
						$valorRetornado = "<thead><tr><th>CPF</th><th>Nome</th></tr></thead><tbody style = 'cursor: pointer;'>";
						$valorRetornado .= "<tr onclick=\"enviaFormulario('" .$linha[0] ."')\"><td>$linha[0]</td><td>$linha[2]</td></tr>";
					} elseif($linha[15] == 'S'){
						$valorRetornado .= "<tr onclick=\"enviaFormulario('" .$linha[0] ."')\"><td>$linha[0]</td><td>$linha[2]</td></tr>";
					}
				}
			}
		}
		$valorRetornado .= "</tbody>";
		//se TIPO == "cpf", a pesquisa sera feita com base no CPF inserido. 
	}elseif ((VALOR_RECEBIDO !== "") && (TIPO == "cpf")){
		$len = strlen(VALOR_RECEBIDO);
		while($linha = mysqli_fetch_array($result)){
			if (stristr(VALOR_RECEBIDO, substr($linha["0"], 0, $len)) !== FALSE) {
				if((TIPO_FILTRO == "turmas" && ($linha[1] == VALOR_FILTRO || VALOR_FILTRO == "0")) || (TIPO_FILTRO == "cursos" && 
				   ($linhaTurmas[1] == VALOR_FILTRO || VALOR_FILTRO == "0")) || (TIPO_FILTRO == "deptos" && ($linhaCursos[1] == VALOR_FILTRO || 
				   VALOR_FILTRO == "0")) || (TIPO_FILTRO == "campi" && ($linhaDeptos[1] == VALOR_FILTRO || VALOR_FILTRO == "0")) || (TIPO_FILTRO == "0")){
					if (($valorRetornado === "") && ($linha[15] == 'S')) {
						$valorRetornado = "<thead><tr><th>CPF</th><th>Nome</th></tr></thead><tbody style = 'cursor: pointer;'>";
						$valorRetornado .= "<tr onclick=\"enviaFormulario('" .$linha[0] ."')\"><td>$linha[0]</td><td>$linha[2]</td></tr>";
					} elseif($linha[15] == 'S') {
						$valorRetornado .= "<tr onclick=\"enviaFormulario('" .$linha[0] ."')\"><td>$linha[0]</td><td>$linha[2]</td></tr>";
					}
				}
			}
		}
		$valorRetornado .= "</tbody>";
	}
	
echo $valorRetornado === "" ? "" : $valorRetornado;
?>