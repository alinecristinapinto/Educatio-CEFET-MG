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
        <link href="css/JHJ-web-estilos-painel.css" rel="stylesheet"/>

        <!-- Arquivos js -->
        <script src="js/popper.js"></script>
        <script src="js/jquery-3.2.1.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/JHJ-web-script-adicionar-campus.js" type="text/javascript"></script>

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
                            <?php
                                $strNomeCampus = $_POST["nomeCampus"];
                                $strCidadeCampus = $_POST["cidadeCampus"];
                                $strUFCampus = $_POST["ufCampus"];

                                // Conectando com o servidor MySQL
                                $link = mysqli_connect("localhost", "root", "");
                                if (!$link){
                                //     die("Conexao falhou: ".mysqli_connect_error()."<br/>");
                                } else {
                                //     echo "Conexao efetuada com sucesso!<br/>";
                                }
                                //Selecionado BD
                                $sql = mysqli_select_db($link, 'Educatio');

                                //Inserindo dados na tabela campi
                                $sql = "INSERT INTO campi (nome, cidade, UF, ativo) VALUES ('$strNomeCampus', '$strCidadeCampus', '$strUFCampus', 'S')";
                                if (mysqli_query($link, $sql)) {
                                //     echo "Campus adicionado com sucesso!";
                                }else{
                                //     echo "Erro ao adicionar campus: ".$sql."<br/>".$link->error."<br/>";
                                }
                            ?>                   
                            <!-- exibindo informações do novo campus adicionado -->
                            <div class='container' style='margin-top: 50px;'>
                                <div class='row'>
                                    <div class='col-md-8 ml-auto mr-auto'>                    
                                        <div class='panel'>
                                            <div class='panel-heading' style='margin-top: 0px;'>
                                                <div class='panel-title'>Campus adicionado com sucesso!</div>
                                            </div>  
                                            <div style='padding-top: 20px' class='panel-body' id='padin'>  
                                                <p style="font-weight: bold;">As informações do novo campus são:</p> 
                                                <p><label style="font-weight: bold; margin-bottom: 0;">Nome:</label><?php echo " ".$strNomeCampus ?></p>
                                                <p><label style="font-weight: bold; margin-bottom: 0;">Cidade:</label><?php echo " ".$strCidadeCampus ?></p>
                                                <p><label style="font-weight: bold; margin-bottom: 0;">UF:</label><?php echo " ".$strUFCampus ?></p>
                                                <div class='row'>
                                                    <div class='col-md-4 ml-auto mr-auto'>
                                                        <button style='margin-bottom: 10px; margin-left: 10px;' type='button' class='btn btn-info btn-round' onClick='voltarParaPaginaInsercaoCampus()'>VOLTAR</button>
                                                    </div>
                                                </div>                     
                                            </div>  
                                        </div> <!-- panel -->
                                    </div>
                                </div> <!-- row -->
                            </div> <!-- conteiner -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>