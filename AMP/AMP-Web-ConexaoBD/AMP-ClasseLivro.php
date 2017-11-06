<?php 

//Cria classe livro que tem todas as funções de criação, alteração e exclusão de livros e acervo

class Livro{

	//Função que cria um livro com todos os parametros necessarios

	function criaLivro($charISBN, $intEdicao, $charAtivo, $intIdCampi, $charNome, $charTipo, $charLocal, $charAno, $charEditora, $charPaginas){

		//Abre a conexão com o banco de dados

		$sqlConexao = mysqli_connect("localhost", "root", "usbw", "educatio");
		if (!$sqlConexao) {
			die("Conexão falhou: " . mysqli_connect_error());
		}

		$sqlIdAcervo = "SELECT  MAX(id) FROM acervo";

		$result = mysqli_query($sqlConexao, $sqlIdAcervo);

		$aux = mysqli_fetch_array($result);

		if (mysqli_query($sqlConexao, $sqlIdAcervo)) {
			echo "$aux[0] !<br>";
		}
		else{
			echo "Erro ao selecionar o acervo: " . mysqli_error($sqlConexao);
		}

		$intIdAcervo = $aux[0]+1;

		//Insere dados na tabela livro 

		$sqlInserelivro = "INSERT INTO livros (idAcervo, ISBN, edicao, ativo) VALUES ('$intIdAcervo','$charISBN','$intEdicao','$charAtivo')";
		if ($result = mysqli_query($sqlConexao, $sqlInserelivro)) {
			echo "Novo registro criado.<br>";
		}else{
			echo "Erro: " . $sqlInserelivro . "<br>" . $sqlConexao->error;
		}

		//Insere dados na tabela acervo

		$sqlInserelivro = "INSERT INTO acervo (idCampi, nome, tipo, local, ano, editora, paginas, ativo) 
		VALUES ('$intIdCampi', '$charNome', '$charTipo', '$charLocal', '$charAno', '$charEditora', '$charPaginas', '$charAtivo')";
		if ($result = mysqli_query($sqlConexao, $sqlInserelivro)) {
			echo "Novo registro criado.<br>";
		}
		else{
			echo "Erro: " . $sqlInserelivro . "<br>" . $sqlConexao->error;
		}
	}

	//Função que deleta o livro e o acervo pelo ISBN

	function deletaLivroISBN($charISBN){

		//Abre a conexão com o banco de dados

		$sqlConexao = mysqli_connect("localhost", "root", "usbw", "educatio");
		if (!$sqlConexao) {
			die("Conexão falhou: " . mysqli_connect_error());
		}

		//Deleta o livro

		$sqlDeletando = "UPDATE livros SET ativo = 'N' WHERE ISBN = '$charISBN'";
		if (mysqli_query($sqlConexao, $sqlDeletando)) {
			echo "Livro deletado!<br>";
		}
		else{
			echo "Erro ao deletar o livro: " . mysqli_error($sqlConexao);
		}

		//Seleciona o ID do acervo

		$sqlIdAcervo = "SELECT idAcervo FROM livros WHERE ISBN = '$charISBN'";


		if (mysqli_query($sqlConexao, $sqlIdAcervo)) {
			echo "Acervo selecionado!<br>";
		}
		else{
			echo "Erro ao selecionar o acervo: " . mysqli_error($sqlConexao);
		}

		//Deleta o acervo

		$deletandoAcervo = "UPDATE acervo SET ativo = 'N' WHERE id = '$sqlIdAcervo'";
		if (mysqli_query($sqlConexao, $deletandoAcervo)) {
			echo "Acervo deletado!<br>";
		}
		else{
			echo "Erro ao deletar o acervo: " . mysqli_error($sqlConexao);
		}

	}

	//Função que altera o  livro e o acervo

	function alteraLivroAcervo($intIdAcervo, $charNovoISBN, $charNovoEdicao, $intNovoIdCampi, $charNovoNome, $charNovoTipo, $charNovoLocal, $charNovoAno, $charNovoEditora, $charNovoPaginas){

		//Abre conexão com o banco de dados

		$sqlConexao = mysqli_connect("localhost", "root", "usbw", "educatio");
				if (!$sqlConexao) {
					die("Conexão falhou: " . mysqli_connect_error());
				}


		$sqlAlterandoISBN = "UPDATE livros SET ISBN = '$charNovoISBN' WHERE idAcervo = '$intIdAcervo'";
				if (mysqli_query($sqlConexao, $sqlAlterandoISBN)) {
					echo "ISBN alterado!<br>";
				}
				else{
					echo "Erro ao alterar o ISBN: " . mysqli_error($sqlConexao);
				}	


		$sqlAlterandoEdicao = "UPDATE livros SET edicao = '$charNovoEdicao' WHERE idAcervo = '$intIdAcervo'";
				if (mysqli_query($sqlConexao, $sqlAlterandoEdicao)) {
					echo "Edição alterada!<br>";
				}
				else{
					echo "Erro ao alterar a Edição: " . mysqli_error($sqlConexao);
				}		


		$sqlAlterandoIdCampi = "UPDATE acervo SET idCampi = '$intNovoIdCampi' WHERE id = '$intIdAcervo'";
				if (mysqli_query($sqlConexao, $sqlAlterandoIdCampi)) {
					echo "idAcervo alterado!<br>";
				}
				else{
					echo "Erro ao alterar o idAcervo: " . mysqli_error($sqlConexao);
				}		


		$sqlAlterandoNome = "UPDATE acervo SET nome = '$charNovoNome' WHERE id = '$intIdAcervo'";
				if (mysqli_query($sqlConexao, $sqlAlterandoNome)) {
					echo "nome alterado!<br>";
				}
				else{
					echo "Erro ao alterar o nome: " . mysqli_error($sqlConexao);
				}


		$sqlAlterandoTipo = "UPDATE acervo SET tipo = '$charNovoTipo' WHERE id = '$intIdAcervo'";
				if (mysqli_query($sqlConexao, $sqlAlterandoTipo)) {
					echo "Tipo alterado!<br>";
				}
				else{
					echo "Erro ao alterar o Tipo: " . mysqli_error($sqlConexao);
				}


		$sqlAlterandoLocal = "UPDATE acervo SET local = '$charNovoLocal' WHERE id = '$intIdAcervo'";
				if (mysqli_query($sqlConexao, $sqlAlterandoLocal)) {
					echo "Local alterado!<br>";
				}
				else{
					echo "Erro ao alterar o Local: " . mysqli_error($sqlConexao);
				}						


		$sqlAlterandoAno = "UPDATE acervo SET ano = '$charNovoAno' WHERE id = '$intIdAcervo'";
				if (mysqli_query($sqlConexao, $sqlAlterandoAno)) {
					echo "Ano alterado!<br>";
				}
				else{
					echo "Erro ao alterar o Ano: " . mysqli_error($sqlConexao);
				}	
				

		$sqlAlterandoEditora = "UPDATE acervo SET editora = '$charNovoEditora' WHERE id = '$intIdAcervo'";
				if (mysqli_query($sqlConexao, $sqlAlterandoEditora)) {
					echo "Editora alterada!<br>";
				}
				else{
					echo "Erro ao alterar a Editora: " . mysqli_error($sqlConexao);
				}		


		$sqlAlterandoPaginas = "UPDATE acervo SET paginas = '$charNovoPaginas' WHERE id = '$intIdAcervo'";
				if (mysqli_query($sqlConexao, $sqlAlterandoPaginas)) {
					echo "Paginas alteradas!<br>";
				}
				else{
					echo "Erro ao alterar as Paginas: " . mysqli_error($sqlConexao);	
				}
	}			
}

$livrinho = new livro;

$livrinho -> criaLivro(1,1,1,1,1,1,1,1,1,1);


 ?>	