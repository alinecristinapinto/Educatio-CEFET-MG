<?php


//Seta as strings de acordo com seus respectivos inputs
$StringNovoIdCurso = $_POST["NovoIdCurso"];
$StringNovoNomeTurma = $_POST["NovoNome"];
$StringNovaSerie = $_POST["NovaSerie"];

$StringIdCurso = $_POST["idCurso"];
$StringNomeTurma = $_POST["nome"];
$StringSerie = $_POST["serie"];


// Cria conexão
$conn = new mysqli("localhost", "root", "","educatio");
// Checa conexão
if ($conn->connect_error) {
    die("Conecção falhou: " . $conn->connect_error);
}

          $sqlSELECT = "SELECT `id` FROM `turmas` WHERE idCurso = '$StringIdCurso' AND nome = '$StringNomeTurma' AND serie = '$StringSerie'";
          $resultadoSELECT = $conn->query($sqlSELECT);

          while($linha = $resultadoSELECT->fetch_array() ) {

            //atualiza na tabela as variaveis do input
            $sqlUPDATE = "UPDATE `turmas` SET `idCurso` = '$StringNovoIdCurso', `nome` = '$StringNovoNomeTurma', `serie` = '$StringNovaSerie' WHERE `id` = ". $linha["id"];
            $resultadoUPDATE = $conn->query($sqlUPDATE);


            //Verifica se o Departamento foi criado com sucesso e redireciona para o menu inical
            if ($conn->query($sqlUPDATE) === TRUE) {

              echo "<script>alert('Turma editada com sucesso!')</script>";
              echo "<script>window.location.href = 'http://localhost/MAE/ManutencaoTurmas/MAE-Web-ManutencaoTurmas.html';</script>";

            }
            else{
              echo "<script>alert('Erro ao editar Turma: ".$conn->error." ')</script>";
              //echo "<script>window.location.href = 'http://localhost/MAE/ManutencaoTurmas/MAE-Web-ManutencaoTurmas-SelecionarTurma-Editar.php';</script>";
            }
          }




?>
