<!DOCTYPE html>
<html>
<head>
</head>
<body>

<<?php 
	
function CreateBook($idAcervo, $ISBN, $edicao, $ativo){
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

CreateBook(1, 'teste', 5, '1');

function DeleteBook($ISBN)
	$sql = "UPDATE livros SET $ativo ='0' WHERE ISBN = $ISBN";
	if (mysqli_query($link, $sql)) {
		echo "Livro deletado!<br>";
	}else{
	echo "Erro ao deletar o livro: " . mysqli_error($link);
}
 ?>

</body>
</html>