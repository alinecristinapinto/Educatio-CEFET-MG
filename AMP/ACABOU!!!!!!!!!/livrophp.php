<?php 

//Cria classe livro que tem todas as funções de criação, alteração e exclusão de livros e acervo

class Livro{

	//Função que cria um livro com todos os parametros necessarios

	function criaLivro($charISBN, $intEdicao, $charAtivo, $intIdCampi, $charNome, $charTipo, $charLocal, $charAno, $charEditora, $charPaginas){

		//Abre a conexão com o banco de dados

		$sqlConexao = mysqli_connect("localhost", "root", "", "educatio");
		if (!$sqlConexao) {
			die("Conexão falhou: " . mysqli_connect_error());
		}

		$sqlIdAcervo = "SELECT  MAX(id) FROM acervo";

		$result = mysqli_query($sqlConexao, $sqlIdAcervo);

		$aux = mysqli_fetch_array($result);

		if (mysqli_query($sqlConexao, $sqlIdAcervo)) {
		}
		

		$intIdAcervo = $aux[0]+1;


		$sqlInserelivro = "INSERT INTO livros (idAcervo, ISBN, edicao, ativo) VALUES ('$intIdAcervo','$charISBN','$intEdicao','$charAtivo')";
		if ($result = mysqli_query($sqlConexao, $sqlInserelivro)) {
	
		}else{
			echo "Erro: " . $sqlInserelivro . "<br>" . $sqlConexao->error;
		}

		//Insere dados na tabela acervo

		$sqlInserelivro = "INSERT INTO acervo (idCampi, nome, tipo, local, ano, editora, paginas, ativo) 
		VALUES ('$intIdCampi', '$charNome', '$charTipo', '$charLocal', '$charAno', '$charEditora', '$charPaginas', '$charAtivo')";
		
		$result = mysqli_query($sqlConexao, $sqlInserelivro);
			
		
		
	}	
		
}




$aaa = new Livro;

$aaa -> criaLivro($_POST["ISBN"],$_POST["edicao"],'S',$_POST["idCampi"],$_POST["nome"],'livro',$_POST["local"],$_POST["ano"],$_POST["editora"],$_POST["paginas"]);

	
	
	//$sqlInserelivro = "INSERT INTO acervo (idCampi, nome, tipo, local, ano, editora, paginas, ativo)  VALUES ($_POST["idCampi"], $_POST["nome"], 'livro', $_POST["local"], $_POST["ano"], $_POST["editora"], $_POST["paginas"], 'S')";
		
		
		//$sqlConexao = mysqli_connect("localhost", "root", "", "educatio");
	//	if (!$sqlConexao) {
	//		die("Conexão falhou: " . mysqli_connect_error());
	//	}


	//	$result = mysqli_query($sqlConexao, $sqlInserelivro);
			

    echo "<script>location.href='cria_autor.php';</script>";

 ?>	