
<!DOCTYPE html>
<html lang='pt-br'>
<head>
    <title>Editar Curso</title>
    <meta charset="utf-8" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

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
    <?php 
      session_start();
      require "../../Menu-Rodape-Secundarios/caso-2/gerencia-web-menu-interface-coordenador.php"; ?>
    <div class="wrapper">
      <!-- <div class="section landing-section"> -->
       <div class="container">
         <div class="row">
           <div class="col-md-8 ml-auto mr-auto">
           <h2 class="text-center">Edição de Turmas</h2>

            <!--Div container -->
            <div class='container'>

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

                        //Seleciona do BD o ID da turma com as suas multas correspondentes
                        $sql = "SELECT * FROM turmas WHERE id = $id ";
                        $result = $conn->query($sql);



                        while($linha = $result->fetch_assoc()) {
                         
                          $_SESSION['nome'] = $linha["nome"];
                          $_SESSION['idCurso'] = $linha["idCurso"];
                          $_SESSION['serie'] = $linha["serie"];

                              //echo dos valores do id do Aluno e multas
                          echo " <table class='table table-bordered'>
                                      <label class='fonteTexto'>Turma escolhida</label>
                                      <tr>
                                        <td>
                                          <b>ID do  Curso</b>: ".$linha["idCurso"]." <br>
                                          <b>Nome da turma</b>: ".$linha["nome"]." <br>
                                          <b>Série</b>: ".$linha["serie"]." <br>
                                        </td>
                                      </tr>
                                    </table>
                                   ";
                            }
                      }
                  ?>
                </div></center>

                <!--Form para criação da turma -->
                  <form class="contact-form" action='MAE-Web-ManutencaoTurmas-Editar-BD.php' method='post' >

                    <label class="fonteTexto">Novo ID do curso:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="nc-icon nc-touch-id"></i>
                        </span>
                        <input type="text" class="form-control" placeholder="ID do curso" name="NovoIdCurso"  value='<?php  echo $_SESSION['idCurso']; ?>'>
                    </div>

                    <label class="fonteTexto">Novo nome da turma:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="nc-icon nc-caps-small"></i>
                        </span>
                        <input type="text" class="form-control" placeholder="Nome do Curso" name="NovoNome" value='<?php  echo $_SESSION['nome']; ?>'>
                    </div>

                    <label class="fonteTexto">Nova série:</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="nc-icon nc-hat-3"></i>
                        </span>
                        <input type="text" class="form-control" placeholder="Horas Totais" name="NovaSerie"  value='<?php  echo $_SESSION['serie']; ?>'>
                    </div>

                    <!--Passa o nome e antigo do Curso-->
                    <input type='hidden' name='idCurso' value='<?php  echo $_SESSION['idCurso']; ?>'/>
                    <input type='hidden' name='nome' value='<?php  echo $_SESSION['nome']; ?>'/>
                    <input type='hidden' name='serie' value='<?php  echo $_SESSION['serie']; ?>'/>

                  <div class="row">
                    <div class="col-md-4 ml-auto mr-auto">
                      <input type="submit" class="btn btn-info" value="Editar Turma">
                      <button class="btn btn-info" onClick="window.location.href ='../../Entrada/gerencia-web-interface-coordenador.php?acao=alterarTurma'">Voltar</button>
                    </div>
                  </div>

                  </form>
              </div>

       <!-- </div> -->
      </div>
     </div>
    </div>
    <br><br>
    <?php require "../../Menu-Rodape-Secundarios/caso-2/gerencia-web-rodape.php";  ?>
   </div>
  </body>
</html>
