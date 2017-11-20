
<!--
Grupo:​ ​ MAE
Data​ ​ de​ ​ modificação:​ ​ 09/10/2017
Autor:​ ​ Allan Barbosa
​ ​ ​ ​ ​ ​ ​ ​ ​Objetivo​ ​ da​ ​ modificação:​ Criação do script da manutenção de multas,parte de edição
-->

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Editar Curso</title>
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
          <h2 class="text-center">Edição de Turmas</h2>

          <!--select com os nomes das turma -->
            <form class="contact-form" action="MAE-Web-ManutencaoTurmas-Editar.php" method="post" >

              <div class="form-group">
                <label for="select" class="fonteTexto">Selecione uma turma para edição:</label>
                <?php
                  $conn = new mysqli("localhost", "root", "","educatio");
                  $query = $conn->query(" SELECT * FROM `turmas` WHERE ativo='S' ORDER BY idCurso ASC,nome ASC");

                  //Cria o select dinamico pelo BD
                  echo " <select class='form-control' id='select' name='select[]'> ";
                  while($linha = $query->fetch_array() ) {
                    echo " <option value = '".$linha["id"]."'> ".$linha["nome"]." ".$linha["serie"]."° série - ID do curso: ".$linha["idCurso"]."</option> ";
                  }
                  echo "</select>";
                ?>
              </div>

              <div class="col-md-4 ml-auto mr-auto">
                  <button type="submit" id="botaoExcluirCurso" class="btn btn-info btn-round">Editar turma</button>
              </div>

              </div>
            </form>
       </div>
      </div>
     </div>
    </div>
   </div>
  </body>
</html>
