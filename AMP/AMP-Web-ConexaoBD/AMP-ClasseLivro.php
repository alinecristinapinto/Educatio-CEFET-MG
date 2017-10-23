<?php 

//Cria classe livro que tem todas as funções de criação, alteração e exclusão de livros e acervo

class Livro{
	public $intIdAcervo; 
	public $charISBN;
	public $intEdicao;
	public $charAtivo;
	public $intIdCampi;
	public $charNome;
	public $charTipo;
	public $charLocal;
	public $charAno;
	public $charEditora;
	public $charPaginas;

	//Função que cria um livro com todos os parametros necessarios

	function criaLivro($intIdAcervo, $charISBN, $intEdicao, $charAtivo, $intIdCampi, $charNome, $charTipo, $charLocal, $charAno, $charEditora, $charPaginas){

		//Abre a conexão com o banco de dados

		$sqlConexao = mysqli_connect("localhost", "root", "usbw", "educatio");
		if (!$sqlConexao) {
			die("Conexão falhou: " . mysqli_connect_error());
		}

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

		//Abre a cibexão com o banco de dados

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

	//Função que altera o ISBN do livro

	function alteraISBN($charISBN, $charNovoISBN){

		//Abre conexão com banco de dados

		$sqlConexao = mysqli_connect("localhost", "root", "usbw", "educatio");
		if (!$sqlConexao) {
			die("Conexão falhou: " . mysqli_connect_error());
		}

		$sqlAlterando = "UPDATE livros SET ISBN = '$charNovoISBN' WHERE ISBN = '$charISBN'";
		if (mysqli_query($sqlConexao, $sqlAlterando)) {
			echo "ISBN alterado!<br>";
		}
		else{
			echo "Erro ao alterar o ISBN: " . mysqli_error($sqlConexao);
		}
	}

	//Função que altera o idAcervo do livro

	function alteraidAcervo($charISBN, $charNovoIdAcervo){

		//Abre conexão com o banco de dados

		$sqlConexao = mysqli_connect("localhost", "root", "usbw", "educatio");
		if (!$sqlConexao) {
			die("Conexão falhou: " . mysqli_connect_error());
		}

		$sqlAlterando = "UPDATE livros SET idAcervo = '$charNovoIdAcervo' WHERE ISBN = '$charISBN'";
		if (mysqli_query($sqlConexao, $sqlAlterando)) {
			echo "idAcervo alterado!<br>";
		}
		else{
			echo "Erro ao alterar o idAcervo: " . mysqli_error($sqlConexao);
		}
	}

	//Função que altera a Edição do livro

	function alteraEdicao($charISBN, $charNovoEdicao){

		//Abre conexão com o banco de dados

		$sqlConexao = mysqli_connect("localhost", "root", "usbw", "educatio");
		if (!$sqlConexao) {
			die("Conexão falhou: " . mysqli_connect_error());
		}
		
		$sqlAlterando = "UPDATE livros SET edicao = '$charNovoEdicao' WHERE ISBN = '$charISBN'";
		if (mysqli_query($sqlConexao, $sqlAlterando)) {
			echo "Edição alterada!<br>";
		}
		else{
			echo "Erro ao alterar a Edição: " . mysqli_error($sqlConexao);
		}
	}

	//Função que altera o IdCampi do Acervo

	function alteraidCampi($intId, $intNovoIdCampi){

		//Abre conexão com o banco de dados

		$sqlConexao = mysqli_connect("localhost", "root", "usbw", "educatio");
		if (!$sqlConexao) {
			die("Conexão falhou: " . mysqli_connect_error());
		}
		
		$sqlAlterando = "UPDATE acervo SET idCampi = '$intNovoIdCampi' WHERE id = '$intId'";
		if (mysqli_query($sqlConexao, $sqlAlterando)) {
			echo "idAcervo alterado!<br>";
		}
		else{
			echo "Erro ao alterar o idAcervo: " . mysqli_error($sqlConexao);
		}
	}

	//Função que altera o nome do Acervo

	function alteraNome($intId, $charNovoNome){

		//Abre conexão com o banco de dados

		$sqlConexao = mysqli_connect("localhost", "root", "usbw", "educatio");
		if (!$sqlConexao) {
			die("Conexão falhou: " . mysqli_connect_error());
		}
		
		$sqlAlterando = "UPDATE acervo SET nome = '$charNovoNome' WHERE id = '$intId'";
		if (mysqli_query($sqlConexao, $sqlAlterando)) {
			echo "nome alterado!<br>";
		}
		else{
			echo "Erro ao alterar o nome: " . mysqli_error($sqlConexao);
		}
	}

	//Função que altera o Tipo do Acervo

	function alteraTipo($intId, $charNovoTipo){

		//Abre conexão com o banco de dados

		$sqlConexao = mysqli_connect("localhost", "root", "usbw", "educatio");
		if (!$sqlConexao) {
			die("Conexão falhou: " . mysqli_connect_error());
		}
		
		$sqlAlterando = "UPDATE acervo SET tipo = '$charNovoTipo' WHERE id = '$intId'";
		if (mysqli_query($sqlConexao, $sqlAlterando)) {
			echo "Tipo alterado!<br>";
		}
		else{
			echo "Erro ao alterar o Tipo: " . mysqli_error($sqlConexao);
		}
	}

	//Função que altera o Local do Acervo

	function alteraLocal($intId, $charNovoLocal){

		//Abre conexão com o banco de dados

		$sqlConexao = mysqli_connect("localhost", "root", "usbw", "educatio");
		if (!$sqlConexao) {
			die("Conexão falhou: " . mysqli_connect_error());
		}
		
		$sqlAlterando = "UPDATE acervo SET local = '$charNovoLocal' WHERE id = '$intId'";
		if (mysqli_query($sqlConexao, $sqlAlterando)) {
			echo "Local alterado!<br>";
		}
		else{
			echo "Erro ao alterar o Local: " . mysqli_error($sqlConexao);
		}
	}

	//Função que altera o Ano do Acervo

	function alteraAno($intId, $charNovoAno){

		//Abre conexão com o banco de dados

		$sqlConexao = mysqli_connect("localhost", "root", "usbw", "educatio");
		if (!$sqlConexao) {
			die("Conexão falhou: " . mysqli_connect_error());
		}
		
		$sqlAlterando = "UPDATE acervo SET ano = '$charNovoAno' WHERE id = '$intId'";
		if (mysqli_query($sqlConexao, $sqlAlterando)) {
			echo "Ano alterado!<br>";
		}
		else{
			echo "Erro ao alterar o Ano: " . mysqli_error($sqlConexao);
		}
	}

	//Função que altera a Editora do Acervo

	function alteraEditora($intId, $charNovoEditora){

		//Abre conexão com o banco de dados

		$sqlConexao = mysqli_connect("localhost", "root", "usbw", "educatio");
		if (!$sqlConexao) {
			die("Conexão falhou: " . mysqli_connect_error());
		}
		
		$sqlAlterando = "UPDATE acervo SET editora = '$charNovoEditora' WHERE id = '$intId'";
		if (mysqli_query($sqlConexao, $sqlAlterando)) {
			echo "Editora alterada!<br>";
		}
		else{
			echo "Erro ao alterar a Editora: " . mysqli_error($sqlConexao);
		}
	}

	//Função que altera as Paginas do Acervo

	function alteraPaginas($intId, $charNovoPaginas){

		//Abre conexão com o banco de dados

		$sqlConexao = mysqli_connect("localhost", "root", "usbw", "educatio");
		if (!$sqlConexao) {
			die("Conexão falhou: " . mysqli_connect_error());
		}
		
		$sqlAlterando = "UPDATE acervo SET paginas = '$charNovoPaginas' WHERE id = '$intId'";
		if (mysqli_query($sqlConexao, $sqlAlterando)) {
			echo "Paginas alteradas!<br>";
		}
		else{
			echo "Erro ao alterar as Paginas: " . mysqli_error($sqlConexao);
		}
	}

}

$livro1 = new livro;

$livro1 -> crialivro(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1);

//$livro1 -> alteraEditora(1, 5555);	

 ?>	