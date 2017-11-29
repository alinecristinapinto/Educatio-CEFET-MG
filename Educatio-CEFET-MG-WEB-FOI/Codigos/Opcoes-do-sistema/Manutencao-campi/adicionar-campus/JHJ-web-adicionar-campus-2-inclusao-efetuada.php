<!DOCTYPE html>
<html>
    <head>
        <title>Adicionar Campus</title>
        <meta charset="utf-8">

        <!-- CSS do Bootstrap -->
        <link href="../../../../Estaticos/Bootstrap/css/bootstrap.min.css" rel="stylesheet" />
        <link href="../../../../Estaticos/Bootstrap/css/bootstrap.css" rel="stylesheet"/>

        <!-- CSS do grupo -->
        <link href="../JHJ-web-estilos.css" rel="stylesheet"/>
        <link href="../JHJ-web-estilos-painel.css" rel="stylesheet"/>

        <!-- Arquivos js -->
        <script src="../../../../Estaticos/Bootstrap/js/popper.js"></script>
        <script src="../../../../Estaticos/Bootstrap/js/jquery-3.2.1.js" type="text/javascript"></script>
        <script src="../../../../Estaticos/Bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- <script src="../JHJ-web-script-adicionar-campus.js" type="text/javascript"></script> -->

        <!-- Fontes e icones -->
        <link href="../../../../Estaticos/Bootstrap/css/nucleo-icons.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Abel|Inconsolata" rel="stylesheet">

        <script type="text/javascript">
            function voltarParaPaginaInsercaoCampus(){
                location.href = "../../../Entrada/gerencia-web-interface-coordenador.php?acao=adicionarCampus";
            }
        </script>

    </head>
    <body>
        <?php 
        session_start();
        require "../../../Menu-Rodape-Secundarios/caso-1/gerencia-web-menu-interface-coordenador.php"; ?>
        <div class="wrapper">         
            <!-- <div class="section landing-section"> -->
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 ml-auto mr-auto">
                            <h2 class="text-center">INCLUSAO DE CAMPUS</h2>
                            <?php
                                $strNomeCampus = $_POST["nomeCampus"];
                                $strCidadeCampus = $_POST["cidadeCampus"];
                                $strUFCampus = $_POST["ufCampus"];

                                // Conectando com o servidor MySQL
                                $link = mysqli_connect("localhost", "root", "usbw");
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
                                                <p style="font-weight: bold;">As informacoes do novo campus sao:</p> 
                                                <p><label style="font-weight: bold; margin-bottom: 0;">Nome:</label><?php echo " ".$strNomeCampus ?></p>
                                                <p><label style="font-weight: bold; margin-bottom: 0;">Cidade:</label><?php echo " ".$strCidadeCampus ?></p>
                                                <p><label style="font-weight: bold; margin-bottom: 0;">UF:</label><?php echo " ".$strUFCampus ?></p>
                                                <div class='row'>
                                                    <div class='col-md-4 ml-auto mr-auto'>
                                                        <button style='margin-bottom: 10px; margin-left: 10px;' type='button' class='btn btn-info' onClick='voltarParaPaginaInsercaoCampus()'>VOLTAR</button>
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
            <!-- </div> -->
            <?php require "../../../Menu-Rodape-Secundarios/caso-1/gerencia-web-rodape-caso-2.php"; ?>
        </div>
    </body>
</html>