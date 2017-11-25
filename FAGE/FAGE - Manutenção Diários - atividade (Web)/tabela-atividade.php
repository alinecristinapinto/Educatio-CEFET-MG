<?php

//constantes utilizadas na conexão com o banco de dados
define ( "SERVIDOR", "localhost" );
define ( "USUARIO", "root" );
define ( "SENHA", "" );
define ( "BD", "educatio" );

	//conexao com o BD
$conn = mysqli_connect ( SERVIDOR, USUARIO, SENHA );

	//Seleciona o BD
$bd_select = mysqli_select_db ( $conn, BD );
$idSIAPE = 9543746; //$_SESSION['usuario']->idSIAPE;
$sql = "SELECT id FROM profdisciplinas WHERE idProfessor = $idSIAPE";
$profdisciplina = mysqli_query( $conn,$sql );

$sql = "SELECT * FROM atividades";
$result = mysqli_query( $conn,$sql );

	//Pega o valor de q enviado pela URL e armazena na constante VALOR_RECEBIDO.
	//O tipo eh utilizado para saber se o usuario digitou no campo de nome ou de cpf e identificar por onde o aluno sera pesquisado (nome ou cpf)
	//Se tipo nao for setado significa que a tabela devera ser mostrada por completo, logo nao ha necessidade de um tipo pois nao havera pesquisa
define ( "VALOR_RECEBIDO", $_REQUEST["q"] );
if( isset( $_REQUEST["tipo"] ) ){
	define ( "TIPO", $_REQUEST["tipo"] );
}

	//valor que sera retornado
$valorRetornado = "";

	//se VALOR_RECEBIDO == "mostrar", escreve na variavel $valorRetornado alguns elementos de tabela que contem dados dos alunos e esses elementos 
	//serao, posteriormente, inseridos na tabela.
	//OBS .: no futuro planejo retirar este style = 'cursor: pointer;' (que serve para deixar o cursor na forma de mãozinha) e coloca-lo na classe 
	//de css, mas nao estou conseguindo por enquanto
if ( VALOR_RECEBIDO == "mostrar" ){
	$valorRetornado = "<thead><tr><th> idAtividade </th><th> disciplina </th><th> turma </th><th> nome </th><th> data </th><th> valor </th></tr></thead><tbody style = 'cursor: pointer;'>";

//percorre tabela decarte e coloca os valores em array
	while ( $profdis = $profdisciplina->fetch_assoc() ) {
		while ( $row = $result->fetch_assoc() ) {
			$id = $row["idProfDisciplina"];
			$idconfere = $profdis["id"];
			if( $id == $idconfere ){
				$idAtividade = $row["id"];
				$nome = $row["nome"];
				$data = $row["data"];
				$valor = $row["valor"];
				$idprof = $row["idProfDisciplina"];
				$sql = "SELECT * FROM profdisciplinas";
				$idProfDisciplina = mysqli_query($conn,$sql);
				while ( $idprofdis = $idProfDisciplina->fetch_assoc() ){
					$idDisciplina = $idprofdis["idDisciplina"];
					$idTurma = $idprofdis["idTurma"];
					$sql = "SELECT * FROM disciplinas";
					$disciplinas = mysqli_query($conn,$sql);
					$nomedisciplina = 0;
					$nometurma = 0;
					while ( $dis = $disciplinas->fetch_assoc() ) {
						$nomedisciplina = $dis["nome"];
					}
					$sql = "SELECT * FROM turmas";
					$turmas = mysqli_query($conn,$sql);
					while ( $tur = $turmas->fetch_assoc() ) {
						$nometurma = $tur["nome"];
					}
				}
				$ativo = $row["ativo"];
				if( $ativo!='N' ){
				$valorRetornado .= "<tr onclick = \"enviaFormulario('" .$idAtividade."')\" ><td>".$idAtividade."</td><td>".$nomedisciplina."</td><td>".$nometurma."</td><td>".$nome."</td><td>".$data."</td><td>".$valor."</td></tr>";
				}
		    }
	    }
	}

	$valorRetornado .="</tbody></table>";

		//se TIPO == "nome", a pesquisa sera feita com base no nome inserido. 
}elseif ( ( VALOR_RECEBIDO !== "" ) && ( TIPO == "nome" ) ) {
	while ( $linha = mysqli_fetch_array($result) ){
			//stripos(string,valor) procura a primeira ocorrencia de 'valor' em 'string' e retorna FALSE se 'valor' nao for encontrado
		if ( stripos ( $linha["2"],VALOR_RECEBIDO ) !== FALSE ) {
			if ( $valorRetornado === "" ) {
				$valorRetornado ="<thead><tr><th> idAtividade </th><th> disciplina </th><th> turma </th><th> nome </th><th> data </th><th> valor </th></tr></thead><tbody style = 'cursor: pointer;'>";
				$sql = "SELECT * FROM profdisciplinas WHERE id = $linha[1]";
				$idProfDisciplina = mysqli_query($conn,$sql);
				$nomedisciplina = 0;
				$nometurma = 0;
				while ( $idprofdis = $idProfDisciplina->fetch_assoc() ){
					$idDisciplina = $idprofdis["idDisciplina"];
					$idTurma = $idprofdis["idTurma"];
					$sql = "SELECT * FROM disciplinas";
					$disciplinas = mysqli_query($conn,$sql);
					while ( $dis = $disciplinas->fetch_assoc() ) {
						$nomedisciplina = $dis["nome"];
					}
					$sql = "SELECT * FROM turmas";
					$turmas = mysqli_query($conn,$sql);
					while ( $tur = $turmas->fetch_assoc() ) {
						$nometurma = $tur["nome"];
					}
				}
				if( $linha[5]!='N' ){
				$valorRetornado .= "<tr onclick=\"enviaFormulario('" .$linha[0]."')\"><td>$linha[0]</td><td>$nomedisciplina</td><td>$nometurma</td><td>$linha[2]</td><td>$linha[3]</td><td>$linha[4]</td></tr>";
				}
			} else {
				if( $linha[5]!='N' ){
				$valorRetornado .= "<tr onclick=\"enviaFormulario('" .$linha[0]."')\"><td>$linha[0]</td><td>$nomedisciplina</td><td>$nometurma</td><td>$linha[2]</td><td>$linha[3]</td><td>$linha[4]</td></tr>";
				}
			}
		}
	}
	$valorRetornado .= "</tbody>";
		//se TIPO == "cpf", a pesquisa sera feita com base no CPF inserido. 
}

echo $valorRetornado === "" ? "" : $valorRetornado;
?>