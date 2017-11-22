<!DOCTYPE html>
<html>
<head>
  <title>Educatio - CEFET-MG </title>
  <meta charset="utf-8">
  <!-- CSS do Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/bootstrap.css" rel="stylesheet"/>

    <!-- Arquivos js -->
    <script src="js/jquery-3.2.1.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>

    <!-- Fontes e icones -->
    <link href="https://fonts.googleapis.com/css?family=Abel|Inconsolata" rel="stylesheet">
    <link href="css/nucleo-icons.css" rel="stylesheet">

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

        <div class="section landing-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 ml-auto mr-auto">

                        <h2 class="text-center">Gerenciamento de Disciplinas</h2>
                        <br><br>

                        <div class="row">
                                <div class="col-md-4 ml-auto mr-auto">
                                <button type="button" class="btn btn-info" onclick="window.location.href='BLT-Web-ADCDisciplinas.html'">Adicionar</button>
                                </div>
                        </div>
                        <br>

                        <div class="row">
                                <div class="col-md-4 ml-auto mr-auto">
                                <button type="button" class="btn btn-info" onclick="window.location.href='BLT-Web-RMVDisciplinas.php'">Remover</button>
                                </div>
                        </div>
                        <br>

                        <div class="row">
                                <div class="col-md-4 ml-auto mr-auto">
                                <button type="button" class="btn btn-info" onclick="window.location.href='BLT-Web-EDTDisciplinas.php'">Editar</button>
                                </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

  </div>

</body>
</html>