<!DOCTYPE html>
<html>
<head>
	<title>Relatorio obras descartadas</title>
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
	
	<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />

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
            <div class="section landing-sectionv">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 ml-auto mr-auto">
                        
                            <h2 class="text-center">Relatorio de obras de descartes</h2>
                            
                            <form class="contact-form" action="MAE-Web-RelatorioObrasDescartadas-Aluno2.php" method="POST">
                                <div class="row">
              						<label class="fonteTexto">Insira o nome da obra:</label>
              						<div class="input-group">
              							<span class="input-group-addon">
              								<i class="nc-icon nc-book-bookmark"></i>
    									</span>
              							<input type="text" class="form-control" placeholder="Nome da obra" name="idAcervo" required="required">
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
	</div>
</body>
</html>