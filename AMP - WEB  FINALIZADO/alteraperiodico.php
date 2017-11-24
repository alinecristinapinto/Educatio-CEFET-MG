<?php 

//Cria classe livro que tem todas as funções de criação, alteração e exclusão de livros e acervo

class Livro{
	//Função que altera o  livro e o acervo

	function alteraLivroAcervo($intIdAcervo, $charNovoISBN, $charNovoEdicao, $intNovoIdCampi, $charNovoNome, $charNovoTipo, $charNovoLocal, $charNovoAno, $charNovoEditora, $charNovoPaginas, $subtipo, $periodicidade, $mes, $volume){

		//Abre conexão com o banco de dados

		$sqlConexao = mysqli_connect("localhost", "root", "", "educatio");
				if (!$sqlConexao) {
					die("Conexão falhou: " . mysqli_connect_error());
				}


		$sqlAlterandoISBN = "UPDATE periodicos SET ISSN = '$charNovoISBN' WHERE idAcervo = '$intIdAcervo'";
				if (mysqli_query($sqlConexao, $sqlAlterandoISBN)) {
					
				}
				else{
					echo "Erro ao alterar o ISBN: " . mysqli_error($sqlConexao);
				}	


		$sqlAlterandoEdicao = "UPDATE periodicos SET volume = '$volume' WHERE idAcervo = '$intIdAcervo'";
				if (mysqli_query($sqlConexao, $sqlAlterandoEdicao)) {
					
				}
				else{
					echo "Erro ao alterar a Edição: " . mysqli_error($sqlConexao);
				}	

	   $sqlAlterandoEdicao = "UPDATE periodicos SET mes = '$mes' WHERE idAcervo = '$intIdAcervo'";
				if (mysqli_query($sqlConexao, $sqlAlterandoEdicao)) {
					
				}
				else{
					echo "Erro ao alterar a Edição: " . mysqli_error($sqlConexao);
				}		
		$sqlAlterandoEdicao = "UPDATE periodicos SET periodicidade = '$periodicidade' WHERE idAcervo = '$intIdAcervo'";
				if (mysqli_query($sqlConexao, $sqlAlterandoEdicao)) {
					
				}
				else{
					echo "Erro ao alterar a Edição: " . mysqli_error($sqlConexao);
				}	

    	$sqlAlterandoEdicao = "UPDATE periodicos SET subtipo = '$subtipo' WHERE idAcervo = '$intIdAcervo'";
				if (mysqli_query($sqlConexao, $sqlAlterandoEdicao)) {
					
				}
				else{
					echo "Erro ao alterar a Edição: " . mysqli_error($sqlConexao);
				}						


		$sqlAlterandoIdCampi = "UPDATE acervo SET idCampi = '$intNovoIdCampi' WHERE id = '$intIdAcervo'";
				if (mysqli_query($sqlConexao, $sqlAlterandoIdCampi)) {
					
				}
				else{
					echo "Erro ao alterar o idAcervo: " . mysqli_error($sqlConexao);
				}		


		$sqlAlterandoNome = "UPDATE acervo SET nome = '$charNovoNome' WHERE id = '$intIdAcervo'";
				if (mysqli_query($sqlConexao, $sqlAlterandoNome)) {
					
				}
				else{
					echo "Erro ao alterar o nome: " . mysqli_error($sqlConexao);
				}


		$sqlAlterandoTipo = "UPDATE acervo SET tipo = '$charNovoTipo' WHERE id = '$intIdAcervo'";
				if (mysqli_query($sqlConexao, $sqlAlterandoTipo)) {
					
				}
				else{
					echo "Erro ao alterar o Tipo: " . mysqli_error($sqlConexao);
				}


		$sqlAlterandoLocal = "UPDATE acervo SET local = '$charNovoLocal' WHERE id = '$intIdAcervo'";
				if (mysqli_query($sqlConexao, $sqlAlterandoLocal)) {
					
				}
				else{
					echo "Erro ao alterar o Local: " . mysqli_error($sqlConexao);
				}						


		$sqlAlterandoAno = "UPDATE acervo SET ano = '$charNovoAno' WHERE id = '$intIdAcervo'";
				if (mysqli_query($sqlConexao, $sqlAlterandoAno)) {
					
				}
				else{
					echo "Erro ao alterar o Ano: " . mysqli_error($sqlConexao);
				}	
				

		$sqlAlterandoEditora = "UPDATE acervo SET editora = '$charNovoEditora' WHERE id = '$intIdAcervo'";
				if (mysqli_query($sqlConexao, $sqlAlterandoEditora)) {
					
				}
				else{
					echo "Erro ao alterar a Editora: " . mysqli_error($sqlConexao);
				}		


		$sqlAlterandoPaginas = "UPDATE acervo SET paginas = '$charNovoPaginas' WHERE id = '$intIdAcervo'";
				if (mysqli_query($sqlConexao, $sqlAlterandoPaginas)) {
					
				}
				else{
					echo "Erro ao alterar as Paginas: " . mysqli_error($sqlConexao);	
				}
	}			
}



	$sqlConexao = mysqli_connect("localhost", "root", "", "educatio");			

session_start();


$a = new Livro;

$nome = $_SESSION['nome'];
	
	$sql = "SELECT id FROM acervo WHERE nome = '$nome' AND ativo = 'S'";
		
		$result = mysqli_query($sqlConexao, $sql);

		$aux = mysqli_fetch_array($result);			

		$intIdAcervo = $aux[0];			

	

$a -> alteraLivroAcervo($intIdAcervo,$_POST['ISSN'],'',$_POST['idCampi'],$_POST['nome'],'periodico',$_POST['local'],$_POST['ano'],$_POST['editora'],$_POST['paginas'],$_POST['subtipo'],$_POST['periodicidade'],$_POST['mes'],$_POST['volume']);

echo "<script>location.href='pagina_inicial_manutencaoacervo.html';</script>";

		
?>

