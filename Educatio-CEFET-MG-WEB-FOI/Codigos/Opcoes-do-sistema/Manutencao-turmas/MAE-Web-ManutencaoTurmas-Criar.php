
<!--
Grupo:​ ​ MAE
Data​ ​ de​ ​ modificação:​ ​ 09/10/2017
Autor:​ ​ Allan Barbosa
​ ​ ​ ​ ​ ​ ​ ​ ​Objetivo​ ​ da​ ​ modificação:​ Criação do script da manutenção de multas,parte de criação
-->

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title>Adicionar Turma</title>

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
      
            <div class="container">
                <div class="row">
                    <div class="col-md-8 ml-auto mr-auto">

                        <h2 class="text-center">Inclusão de Turma</h2>

                        <form class="contact-form" action="../Opcoes-do-sistema/Manutencao-turmas/MAE-Web-ManutencaoTurmas-Criar-BD.php" method="POST">
                            <div class="row">

                                <label class="fonteTexto">ID do curso:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="nc-icon nc-touch-id"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="ID do curso" name="idCurso" required="required">
                                </div>

                                <label class="fonteTexto">Nome da turma:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="nc-icon nc-caps-small"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Nome da turma" name="nome" required="required">
                                </div>

                                <label class="fonteTexto">Série:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="nc-icon nc-hat-3"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="serie da turma" name="serie" required="required">
                                </div>

                                <div class="col-md-4 ml-auto mr-auto">
                                <button type="submit" class="btn btn-info">Adicionar Turma</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        
    </div>
  </body>
</html>
