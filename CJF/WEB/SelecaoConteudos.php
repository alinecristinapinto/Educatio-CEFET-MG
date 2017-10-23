<?php

$sqlConexao = mysqli_connect("localhost", "root", "", "educatio");

if (!$sqlConexao) {
    echo "Erro: Falha ao conectar-se com o banco de dados MySQL.";
    exit;
}

echo "Sucesso: Sucesso ao conectar-se com a base de dados MySQL.<br>";

$strDisciplinapesquisada = $_POST['disciplina'];
$intEtapapesquisada = $_POST['etapa'];

//Pesquisa o id-disciplinas por meio do nome da disciplina;
$sqlSql = "SELECT id FROM disciplinas WHERE nome='$strDisciplinapesquisada'";
$sqlResultado = $sqlConexao->query($sqlSql);
$genAux = $sqlResultado->fetch_assoc();
$intIddisciplina = $genAux["id"];

//Pesquisa o conteúdo* por  meio dos id-etapas e o id-disciplinas;
$sqlSql = "SELECT conteudo FROM conteudos WHERE idDisciplina='$intIddisciplina' AND idEtapa='$intEtapapesquisada'";
$sqlResultado = $sqlConexao->query($sqlSql);
$genAux = $sqlResultado->fetch_assoc();


$strConteudo = $genAux['conteudo'];

echo "O conteudo da a disciplina ".$strDisciplinapesquisada." na etapa ".$intEtapapesquisada." e: ".$strConteudo.".";
?>