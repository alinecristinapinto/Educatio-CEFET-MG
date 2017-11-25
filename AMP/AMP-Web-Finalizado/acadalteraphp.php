<?php
class Livro{
function deletaLivroISBN($charISBN){

		//Abre a conexão com o banco de dados

		$sqlConexao = mysqli_connect("localhost", "root", "", "educatio");
		if (!$sqlConexao) {
			die("Conexão falhou: " . mysqli_connect_error());
		}

		//Deleta o livro

		$deletandoAcervo = "UPDATE acervo SET ativo = 'N' WHERE nome = '$charISBN'";
		if (mysqli_query($sqlConexao, $deletandoAcervo)) {
		
		}

		$sql = "SELECT id FROM acervo WHERE nome = '$charISBN' ";
		
		$result = mysqli_query($sqlConexao, $sql);

		$aux = mysqli_fetch_array($result);			

		$intIdAcervo = $aux[0];


		$sqlDeletando = "UPDATE academicos SET ativo = 'N' WHERE idAcervo = '$intIdAcervo'";
		if (mysqli_query($sqlConexao, $sqlDeletando)) {
			
		}		
	

	}

}

$a = new Livro;
session_start();


$a -> deletaLivroISBN($_SESSION['nome']);


echo "<script>location.href='pagina_inicial_manutencaoacervo.html';</script>";





?>