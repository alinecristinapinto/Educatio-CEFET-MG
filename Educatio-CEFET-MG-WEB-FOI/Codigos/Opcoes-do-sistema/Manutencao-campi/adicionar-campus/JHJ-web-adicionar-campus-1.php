<!DOCTYPE html>
<html>
    <head>
        <title>Adicionar Campus</title>
        <meta charset="utf-8">

        <!-- CSS do Bootstrap -->

        <!-- CSS do grupo -->
        <link href="../Opcoes-do-sistema/Manutencao-campi/JHJ-web-estilos.css" rel="stylesheet"/>
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
        </style>
    </head>
    <body>
        <div class="wrapper">         
            <!-- <div class="section landing-section"> -->
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 ml-auto mr-auto">
                        	<h2 class="text-center">INCLUSAO DE CAMPUS</h2>
                            <form class="contact-form" action="../Opcoes-do-sistema/Manutencao-campi/adicionar-campus/JHJ-web-adicionar-campus-2-inclusao-efetuada.php" method="POST">
                    		    <div class="row">
                          			<label class="fonteTexto">INSERIR NOME:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="nc-icon nc-check-2"></i>
                                        </span>
                                        <input type="text" class="form-control" name="nomeCampus" placeholder="Nome do Campus" required="required">
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="fonteTexto">INSERIR CIDADE:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="nc-icon nc-pin-3"></i>
                                        </span>
                                        <input type="text" class="form-control" name="cidadeCampus" placeholder="Nome da Cidade" required="required">
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="fonteTexto">INSERIR UF:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="nc-icon nc-world-2"></i>
                                        </span>
                                        <input type="text" class="form-control" name="ufCampus" placeholder="UF" required="required">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 ml-auto mr-auto">
                                        <button type="submit" class="btn btn-info">INCLUIR CAMPUS</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <!-- </div> -->
        </div>              
    </body>
</html>