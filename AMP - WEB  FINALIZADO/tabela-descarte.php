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

	define ("valor", $_REQUEST["depto"]);

	$valor = valor;

	$sql = "SELECT * FROM funcionario WHERE idDepto = '$valor' AND hierarquia = 'professor' AND ativo = 'S'" ;	
	$result = mysqli_query($conn,$sql);

	define ("VALOR_RECEBIDO", $_REQUEST["q"]);
	if(isset($_REQUEST["tipo"])){
		define ("TIPO", $_REQUEST["tipo"]);
	}
	



	$valorRetornado = "";


	if(VALOR_RECEBIDO == "mostrar"){
	$valorRetornado = "<thead><tr><th>Siape</th><th>Depto</th><th>Nome</th><th>Titulacao</th></tr></thead><tbody style = 'cursor: pointer;'>";
		
//percorre tabela decarte e coloca os valores em array
			while($row = $result->fetch_assoc()){
				$idAcervo=$row["idSIAPE"];
				$nomeacervo=$row["nome"];
				$tipoacervo=$row["idDepto"];
				$localacervo=$row["titulacao"];				
				$valorRetornado .= "<tr><td>".$idAcervo."</td><td>".$tipoacervo."</td><td>".$nomeacervo."</td><td>".$localacervo."</td></tr>";
			}
			
		$valorRetornado .="</tbody></table>";
		
		//se TIPO == "nome", a pesquisa sera feita com base no nome inserido. 
	}elseif ((VALOR_RECEBIDO !== "") && (TIPO == "nome")) {
		while($linha = mysqli_fetch_array($result)){
			//stripos(string,valor) procura a primeira ocorrencia de 'valor' em 'string' e retorna FALSE se 'valor' nao for encontrado
			if (stripos($linha["2"],VALOR_RECEBIDO) !== FALSE) {
				if ($valorRetornado === "") {
					$valorRetornado = "<thead><tr><th>Siape</th><th>Depto</th><th>Nome</th><th>Titulacao</th</tr></thead><tbody style = 'cursor: pointer;'>";
					$valorRetornado .= "<tr onclick=\"enviaFormulario('" .$linha[2] ."')\"><td>$linha[0]</td><td>$linha[1]</td><td>$linha[2]</td><td>$linha[3]</td></tr>";
				} else {
					$valorRetornado .= "<tr onclick=\"enviaFormulario('" .$linha[2] ."')\"><td>$linha[0]</td><td>$linha[1]</td><td>$linha[2]</td><td>$linha[3]</td></tr>";
				}
			}
		}
		$valorRetornado .= "</tbody>";
		//se TIPO == "cpf", a pesquisa sera feita com base no CPF inserido. 
	}
	
echo $valorRetornado === "" ? "" : $valorRetornado;
?>