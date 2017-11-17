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
	
	$sql = "SELECT * FROM alunos";
	$result = mysqli_query($conn,$sql);
	
	//Pega o valor de q enviado pela URL e armazena na constante VALOR_RECEBIDO.
	//O tipo eh utilizado para saber se o usuario digitou no campo de nome ou de cpf e identificar por onde o aluno sera pesquisado (nome ou cpf)
	//Se tipo nao for setado significa que a tabela devera ser mostrada por completo, logo nao ha necessidade de um tipo pois nao havera pesquisa
	define ("VALOR_RECEBIDO", $_REQUEST["q"]);
	if(isset($_REQUEST["tipo"])){
		define ("TIPO", $_REQUEST["tipo"]);
	}
	
	//valor que sera retornado
	$valorRetornado = "";

	//se VALOR_RECEBIDO == "mostrar", escreve na variavel $valorRetornado alguns elementos de tabela que contem dados dos alunos e esses elementos 
	//serao, posteriormente, inseridos na tabela.
	//OBS .: no futuro planejo retirar este style = 'cursor: pointer;' (que serve para deixar o cursor na forma de mãozinha) e coloca-lo na classe 
	//de css, mas nao estou conseguindo por enquanto
	if(VALOR_RECEBIDO == "mostrar"){
		$valorRetornado = "<thead><tr><th>CPF</th><th>Nome</th></tr></thead><tbody style = 'cursor: pointer;'>";
		while($linha = mysqli_fetch_array($result)){
			if($linha[15] == 'S'){
				$valorRetornado .= "<tr onclick=\"enviaFormulario('" .$linha[0] ."')\"><td>$linha[0]</td><td>$linha[2]</td></tr>";
			}
		}
		$valorRetornado .= "</tbody>";
		//se TIPO == "nome", a pesquisa sera feita com base no nome inserido. 
	}elseif ((VALOR_RECEBIDO !== "") && (TIPO == "nome")) {
		while($linha = mysqli_fetch_array($result)){
			//stripos(string,valor) procura a primeira ocorrencia de 'valor' em 'string' e retorna FALSE se 'valor' nao for encontrado
			if (stripos($linha["2"],VALOR_RECEBIDO) !== FALSE) {
				if($linha[15] == 'S'){
					if ($valorRetornado === "") {
						$valorRetornado = "<thead><tr><th>CPF</th><th>Nome</th></tr></thead><tbody style = 'cursor: pointer;'>";
						$valorRetornado .= "<tr onclick=\"enviaFormulario('" .$linha[0] ."')\"><td>$linha[0]</td><td>$linha[2]</td></tr>";
					} else {
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
				if($linha[15] == 'S'){
					if ($valorRetornado === "") {
						$valorRetornado = "<thead><tr><th>CPF</th><th>Nome</th></tr></thead><tbody style = 'cursor: pointer;'>";
						$valorRetornado .= "<tr onclick=\"enviaFormulario('" .$linha[0] ."')\"><td>$linha[0]</td><td>$linha[2]</td></tr>";
					} else {
						$valorRetornado .= "<tr onclick=\"enviaFormulario('" .$linha[0] ."')\"><td>$linha[0]</td><td>$linha[2]</td></tr>";
					}
				}
			}
		}
		$valorRetornado .= "</tbody>";
	}
	
echo $valorRetornado === "" ? "" : $valorRetornado;
?>