
<!DOCTYPE html>
<html lang='pt-br'>
  <head>
      <title>Remover Curso</title>
      <meta charset="utf-8" />
      <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
      <meta name="viewport" content="width=device-width" />

      <!-- CSS do Bootstrap -->
      <link href="css/bootstrap.min.css" rel="stylesheet" />
      <link href="css/bootstrap.css" rel="stylesheet"/>

      <!-- Arquivos js -->
      <script src="js/jquery-3.2.1.js" type="text/javascript"></script>
      <script src="js/bootstrap.min.js" type="text/javascript"></script>

      <!-- Fontes e icones -->
      <link href="https://fonts.googleapis.com/css?family=Abel|Inconsolata" rel="stylesheet">
      <link href="css/nucleo-icons.css" rel="stylesheet">

      <script type="text/javascript" src="js/MAE-web-script.js"></script>

      <style type="text/css">
      .text-center{
         font-family: 'Abel', sans-serif;
         color: #d8ac29;
      }
      .fonteTexto{
         font-family: 'Inconsolata', monospace;
         font-size: 16px;
      }
      .btn-info {
        background-color: #162e87;
        border-color: #162e87;
        color: #FFFFFF;
        opacity: 1;
        filter: alpha(opacity=100);
      }
      .btn-info:hover, .btn-info:focus, .btn-info:active, .btn-info.active, .show > .btn-info.dropdown-toggle {
        background-color: #11277a;
        color: #FFFFFF;
        border-color: #11277a;
      }
      </style>
  </head>
  <body>
    <div class="wrapper">
      <div class="section landing-sectionv">
       <div class="container">
         <div class="row">
           <div class="col-md-8 ml-auto mr-auto">

        <h2 class="text-center">Exclusão de Turma</h2>
        <center><div class='.col-xs-9'>
          <?php
              // Verifica se usuário escolheu algum nome
              if(isset($_POST["select"]))
              {
                foreach($_POST["select"] as $id)
                {
                  //seta a variavel "$id" (id da turma) com o input do select
                }

                // Cria conexão
                $conn = new mysqli("localhost", "root", "","educatio");
                // Checa conexão
                if ($conn->connect_error) {
                    die("Conecção falhou: " . $conn->connect_error);
                }

                $sql = "SELECT IdTurma FROM disciplinas WHERE idTurma = $id ";
                $resultadoDisciplinas = $conn->query($sql);

                if ($resultadoDisciplinas->num_rows!=0){
                  $sql = "SELECT * FROM turmas WHERE id = $id ";
                  $resultadoTurma = $conn->query($sql);

                  while($row = $resultadoTurma->fetch_assoc()) {
                        //echo dos valores do id do Aluno e multas
                    echo " <table class='table table-bordered'>
                                <caption>Turma deletada</caption>
                                <tr>
                                  <td>
                                    <b>ID do  Curso</b>: ".$row["idCurso"]." <br>
                                    <b>Nome da turma</b>: ".$row["nome"]." <br>
                                    <b>Série</b>: ".$row["serie"]." <br>
                                  </td>
                                </tr>
                              </table>
                             ";
                      }

                  echo "<script>alert('Existe disciplinas atreladas a turma')</script>";
                  echo "<script>window.location.href = 'http://localhost/MAE/ManutencaoTurmas/MAE-Web-ManutencaoTurmas.html';</script>";
                }

                else{
                  $sql = "SELECT * FROM turmas WHERE id = $id ";
                  $resultadoTurma = $conn->query($sql);

                  while($row = $resultadoTurma->fetch_assoc()) {
                        //echo dos valores do id do Aluno e multas
                    echo " <table class='table table-bordered'>
                                <caption>Turma deletada</caption>
                                <tr>
                                  <td>
                                    <b>ID do  Curso</b>: ".$row["idCurso"]." <br>
                                    <b>Nome da turma</b>: ".$row["nome"]." <br>
                                    <b>Série</b>: ".$row["serie"]." <br>
                                  </td>
                                </tr>
                              </table>
                             ";
                      }
                      $sql = "UPDATE `turmas` SET `ativo` = 'N' WHERE `id` = $id";
                      $resultadoUPDATE = $conn->query($sql);

                      echo "<script>alert('Turma excluida com sucesso!')</script>";
                      echo "<script>window.location.href = 'http://localhost/MAE/ManutencaoTurmas/MAE-Web-ManutencaoTurmas.html';</script>";
                }
              }
          ?>

        </div>
       </div>
      </div>
     </div>
    </div>
  </body>
</html>
