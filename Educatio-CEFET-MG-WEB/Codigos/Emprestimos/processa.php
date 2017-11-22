<?php
include('conecta.php');

$campo = "%{$_POST['IDAcervo']}%";

$sql = $mysqli->prepare('SELECT idAluno, idAcervo, dataEmprestimo FROM emprestimos WHERE idAcervo LIKE ? AND ativo= "S"');
$sql->bind_param("s", $campo);
$sql->execute();
$sql->bind_result($idAl, $idAc, $data);
$sql->store_result();

echo 	"<div class=\"TabelaExclusao\">";
echo 	"<ul class=\"list-group\">";
$total = $sql->affected_rows;
if($total!=0){
while($sql->fetch()){
	echo "<li id=\"minhaclasse\" class=\"list-group-item align-items-center\" >ID Aluno: $idAl | ID Acervo: $idAc | Data empréstimo: $data</li>";
	}
}else{
	echo "<h1 id=\"meuid\" style=\"text-align: center\">Valor não encontrado!</h1>";
}

echo 	"</ul>
        </div>";

?>