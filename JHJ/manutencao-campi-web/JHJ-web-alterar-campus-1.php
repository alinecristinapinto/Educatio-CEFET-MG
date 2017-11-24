<!DOCTYPE html>
<html>
    <head>
        <title>Alterar Campus</title>
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
                            <h2 class="text-center">ALTERAÇÃO DE CAMPUS</h2>
                            <?php
                                // Conectando com o servidor MySQL
                                $link = mysqli_connect("localhost", "root", "");
                                if (!$link){
                                //     die("Conexao falhou: ".mysqli_connect_error()."<br/>");
                                } else {
                                //     echo "Conexao efetuada com sucesso!<br/>";
                                }
                                //Selecionado BD
                                $sql = mysqli_select_db($link, 'Educatio');
                                //Seleciona os dados dos campus ativos
                                $query = mysqli_query($link, " SELECT id, nome, cidade, UF FROM campi WHERE ativo='S' ");
                            ?>
                            <form class="contact-form" action="JHJ-web-alterar-campus-2-selecao-alteracoes.php" method="POST">
                                <div class="col-md-6">
                                    <label class="fonteTexto">Selecione um campus para alterar:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="nc-icon nc-settings"></i>
                                        </span>
                                        <select class="form-control" required="required" name="selectParaAlterarCampus[]">
                                            <option value="">Nenhum campus selecionado</option>
                                            <!-- Usando os dados do BD para fazer o select com os campus ativos -->
                                            <?php while($campus = mysqli_fetch_array($query)) { ?>
                                            <option name="selectParaAlterarCampus[]" value="<?php echo $campus['id'] ?>">
                                            <?php echo $campus['nome']." - ".$campus['cidade']."-".$campus['UF'] ?></option><?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 ml-auto mr-auto">
                                        <button type="submit" class="btn btn-info btn-round">ALTERAR CAMPUS</button>
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