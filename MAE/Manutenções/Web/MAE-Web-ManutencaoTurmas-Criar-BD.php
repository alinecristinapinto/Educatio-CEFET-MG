<?php
  /*
  Grupo:​ ​ MAE
	Data​ ​ de​ ​ modificação:​ ​ 09/10/2017
	Autor:​ ​ Allan Barbosa
​ ​ ​ ​ ​ ​ ​ ​ ​Objetivo​ ​ da​ ​ modificação:​ Criação do script para a inserção dos valores do input na tabela de Turmas no BD

        Comentário do desenvolvedor: Desculpe pela "gambiarra" usando vários echos, não sei fazer de outra forma ;-;
  */

//Seta as strings de acordo com seus respectivos inputs
//$StringIdTurma = $_POST["idTurma"];
$StringIdCurso = $_POST["idCurso"];
$StringNomeTurma = $_POST["nome"];
$StringSerie = $_POST["serie"];

// Cria conexão
$conn = new mysqli("localhost", "root", "","educatio");
// Checa conexão
if ($conn->connect_error) {
    die("Conecção falhou: " . $conn->connect_error);
}

//insere na tabela as variaveis do input
$sql = "INSERT  INTO `turmas` (`idCurso`,`serie`,`nome`, `ativo`)
        VALUES ('$StringIdCurso', '$StringSerie', '$StringNomeTurma', 'S')";

//Verifica se o Departamento foi criado com sucesso e redireciona para o menu inical
if ($conn->query($sql) === TRUE) {
  echo "<script>alert('Turma criado com sucesso!')</script>";
  echo "<script>window.location.href = 'http://localhost/MAE/ManutencaoTurmas/MAE-Web-ManutencaoTurmas.html';</script>";

}
else{
  echo "<script>alert('Erro ao criar Turma: ".$conn->error." ')</script>";
  echo "<script>window.location.href = 'http://localhost/MAE/ManutencaoTurmas/MAE-Web-ManutencaoTurmas-Criar.php';</script>";
}

//fecha conexão
$conn->close();

?>
