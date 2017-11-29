
<!DOCTYPE html>
<html lang='pt-br'>
  <head>
      <title>Remover Curso</title>
      <meta charset="utf-8" />
      <!-- CSS do Bootstrap -->
      <link href="../../../Estaticos/Bootstrap/css/bootstrap.min.css" rel="stylesheet" />
      <link href="../../../Estaticos/Bootstrap/css/bootstrap.css" rel="stylesheet"/>

      <!-- CSS do grupo -->

      <!-- Arquivos js -->
      <script src="../../../Estaticos/Bootstrap/js/popper.js"></script>
      <script src="../../../Estaticos/Bootstrap/js/jquery-3.2.1.js" type="text/javascript"></script>
      <script src="../../../Estaticos/Bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

      <!-- Fontes e icones -->
      <link href="../../../Estaticos/Bootstrap/css/nucleo-icons.css" rel="stylesheet">
       <link href="https://fonts.googleapis.com/css?family=Abel|Inconsolata" rel="stylesheet">

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
      <?php 
      session_start();
      require "../../Menu-Rodape-Secundarios/caso-2/gerencia-web-menu-interface-coordenador.php";
      ?>

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
                $conn = new mysqli("localhost", "root", "usbw","educatio");
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
                                <caption>Turma não deletada</caption>
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
                 // echo "<script>window.location.href = '../../Entrada/gerencia-web-interface-coordenador.php?acao=removerTurma';</script>";
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
                     // echo "<script>window.location.href = '../../Entrada/gerencia-web-interface-coordenador.php?acao=removerTurma';</script>";
                }

                echo "<div class='row'>
                  <div class='col-md-4 ml-auto mr-auto'>
                    <button class='btn btn-info' onClick=\"window.location.href ='../../Entrada/gerencia-web-interface-coordenador.php?acao=removerTurma';\">Voltar</button>
                  </div>
                </div>  ";
              }

          ?>

        </div>
       </div>
      </div>
      <br><br>
     
    </div>
     <?php require "../../Menu-Rodape-Secundarios/caso-2/gerencia-web-rodape-caso-2.php";  ?>
  </body>
</html>
