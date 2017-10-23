<?php 
	
function CriaLivro($idAcervo, $ISBN, $edicao, $ativo){
	$link = mysqli_connect("localhost", "root", "usbw", "educatio");
	if (!$link) {
		die("Conexão falhou: " . mysqli_connect_error());
	}
	$sql = "INSERT INTO livros (idAcervo, ISBN, edicao, ativo) VALUES ($idAcervo,$ISBN, $edicao, $ativo)";
	if ($result = mysqli_query($link, $sql)) {
		echo "Novo registro criado.<br>";
	}else{
		echo "Erro: " . $sql . "<br>" . $link->error;
	}
}

CriaLivro(1, 'teste', 5, 'S');

function DeletaLivro($ISBN){
	$link = mysqli_connect("localhost", "root", "usbw", "educatio");
	if (!$link) {
		die("Conexão falhou: " . mysqli_connect_error());
	}
	$sql = "UPDATE livros SET $ativo ='N' WHERE ISBN = $ISBN";
	if (mysqli_query($link, $sql)) {
		echo "Livro deletado!<br>";
	}else{
	echo "Erro ao deletar o livro: " . mysqli_error($link);
	}
}


 ?>	