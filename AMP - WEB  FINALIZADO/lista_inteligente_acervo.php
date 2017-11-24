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
	
	$sql = "SELECT * FROM acervo WHERE ativo = 'S'";
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
	$valorRetornado = "<thead><tr><th>id</th><th>Nome</th><th>tipo</th><th>Local</th><th>editora</th><th>ano</th></tr></thead><tbody style = 'cursor: pointer;'>";
		
//percorre tabela decarte e coloca os valores em array
			while($row = $result->fetch_assoc()){
				$idAcervo=$row["id"];
				$nomeacervo=$row["nome"];
				$tipoacervo=$row["tipo"];
				$localacervo=$row["local"];
				$editora=$row["editora"];
				$ano=$row["ano"];
				$valorRetornado .= "<tr><td>".$idAcervo."</td><td>".$nomeacervo."</td><td>".$tipoacervo."</td><td>".$localacervo."</td><td>".$editora."</td><td>".$ano."</td></tr>";
			}
			
		$valorRetornado .="</tbody></table>";
		
		//se TIPO == "nome", a pesquisa sera feita com base no nome inserido. 
	}elseif ((VALOR_RECEBIDO !== "") && (TIPO == "nome")) {
		while($linha = mysqli_fetch_array($result)){
			//stripos(string,valor) procura a primeira ocorrencia de 'valor' em 'string' e retorna FALSE se 'valor' nao for encontrado
			if (stripos($linha["2"],VALOR_RECEBIDO) !== FALSE) {
				if ($valorRetornado === "") {
					$valorRetornado = "<thead><tr><th>id</th><th>Nome</th><th>tipo</th><th>Local</th><th>editora</th><th>ano</th></tr></thead><tbody style = 'cursor: pointer;'>";
					$valorRetornado .= "<tr onclick=\"enviaFormulario('" .$linha[0] ."','" .$linha[3] ."')\"><td>$linha[0]</td><td>$linha[2]</td><td>$linha[3]</td><td>$linha[4]</td><td>$linha[6]</td><td>$linha[5]</td></tr>";
				} else {
					$valorRetornado .= "<tr onclick=\"enviaFormulario('" .$linha[0] ."','" .$linha[3] ."')\"><td>$linha[0]</td><td>$linha[2]</td><td>$linha[3]</td><td>$linha[4]</td><td>$linha[6]</td><td>$linha[5]</td></tr>";
				}
			}
		}
		$valorRetornado .= "</tbody>";
		//se TIPO == "cpf", a pesquisa sera feita com base no CPF inserido. 
	}
	
echo $valorRetornado === "" ? "" : $valorRetornado;
?>