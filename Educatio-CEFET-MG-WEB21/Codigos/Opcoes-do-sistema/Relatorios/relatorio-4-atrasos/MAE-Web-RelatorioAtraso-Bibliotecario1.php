<!--
Grupo: MAE
  Data de modificação: 20/11/2017
  Autor: Emanuela Amorim
    Objetivo da modificação: fazer filtragem
-->
<!DOCTYPE html>
<html lang="pt-br">
  <head>
  <TITLE>Relatorio de atrasos</TITLE>
    <meta charset="utf-8" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <!-- CSS do Bootstrap -->

    <!-- Arquivos js -->

    <!-- Fontes e icones -->
    <link href="https://fonts.googleapis.com/css?family=Abel|Inconsolata" rel="stylesheet">

    <!-- Deve estar em CSS externo, mas como é apenas um exemplo declaramos aqui -->

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
                        
                            <h2 class="text-center">Relatorio de atrasos</h2>
                            
                            <form class="contact-form" action="../Opcoes-do-sistema/Relatorios/relatorio-4-atrasos/MAE-Web-RelatorioAtraso-Bibliotecario2.php" method="POST">
                                <div class="row">
              									<label class="fonteTexto">Pesquise pelo nome do aluno:</label>
              									<div class="input-group">
              										<span class="input-group-addon">
              											<i class="nc-icon nc-circle-10"></i>
              										</span>
              										<input type="text" class="form-control" placeholder="Nome do aluno" name="nomeAlunoPesquisa">
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
  </body>
</html>