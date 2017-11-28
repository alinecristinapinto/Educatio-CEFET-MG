<!--
Grupo:​ ​ MAE
Data​ ​ de​ ​ modificação:​ ​ 09/10/2017
Autor:​ ​ Allan Barbosa
​ ​ ​ ​ ​ ​ ​ ​ ​Objetivo​ ​ da​ ​ modificação:​ Criação do script da impressão via tela dos relatórios de multas

        Comentário do desenvolvedor: Desculpe pela "gambiarra" usando vários echos, não sei fazer de outra forma ;-;
-->

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Relatório de Multas</title>
    <meta charset="utf-8" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <!-- CSS do Bootstrap -->

    <!-- Arquivos js -->

    <!-- Fontes e icones -->
    <link href="https://fonts.googleapis.com/css?family=Abel|Inconsolata" rel="stylesheet">

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

            <div class="container">
                <div class="row">
                    <div class="col-md-8 ml-auto mr-auto">

                        <center><h2 class="text-center">Relatórios de multas</h2></center>

                        <div class="form-group">
                          <!--Form com input do ID do Aluno -->
                          <form class="contact-form" action="../Opcoes-do-sistema/Relatorios/relatorio-5-multas/MAE-Web-RelatoriosMultas-Bibliotecario-PDF.php" method='post'id="inputIDAluno" >
                              <div class="row">

                               <label class="fonteTexto">Nome do aluno:</label>
                               <div class="input-group">
                                   <span class="input-group-addon">
                                       <i class="nc-icon nc-circle-10"></i>
                                   </span>
                                   <input type="text" class="form-control" placeholder="Se desejado,insira o nome do aluno" name="nomeAlunoPesquisa">
                               </div>

                               <div class="col-md-4 ml-auto mr-auto">
                                <button type="submit" class="btn btn-info btn-round">Download</button>
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
