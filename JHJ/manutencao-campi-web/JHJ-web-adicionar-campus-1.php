<!DOCTYPE html>
<html>
    <head>
        <title>Adicionar Campus</title>
        <meta charset="utf-8">

        <!-- CSS do Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet" />
        <link href="css/bootstrap.css" rel="stylesheet"/>

        <!-- CSS do grupo -->
        <link href="css/JHJ-web-estilos.css" rel="stylesheet"/>

        <!-- Arquivos js -->
        <script src="js/popper.js"></script>
        <script src="js/jquery-3.2.1.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>

        <!-- Fontes e icones -->
        <link href="css/nucleo-icons.css" rel="stylesheet">
    </head>
    <body>
        <div class="wrapper">         
            <div class="section landing-section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 ml-auto mr-auto">
                        	<h2 class="text-center">INCLUSÃO DE CAMPUS</h2>
                            <form class="contact-form" action="JHJ-web-adicionar-campus-2-inclusao-efetuada.php" method="POST">
                    		    <div class="col-md-6">
                          			<label class="fonteTexto">INSERIR NOME:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="nc-icon nc-check-2"></i>
                                        </span>
                                        <input type="text" class="form-control" name="nomeCampus" placeholder="Nome do Campus" required="required">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="fonteTexto">INSERIR CIDADE:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="nc-icon nc-pin-3"></i>
                                        </span>
                                        <input type="text" class="form-control" name="cidadeCampus" placeholder="Nome da Cidade" required="required">
                                    </div>
                                </div>
                                <div class="col-md-6">
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
                                        <button type="submit" class="btn btn-info btn-round">INCLUIR CAMPUS</button>
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