<?php
    session_start();
    $intIdCampus = $_SESSION['intIdCampus'];


    if (!isset($_POST['nomeCampus'])){
        $strNomeCampus = $_SESSION['strNomeCampus'];
    } else {
        $strNomeCampus = $_POST['nomeCampus'];
    } 
    if (!isset($_POST['cidadeCampus'])){
        $strCidadeCampus = $_SESSION['strCidadeCampus'];
    } else {
         $strCidadeCampus = $_POST['cidadeCampus'];
    }
    if (!isset($_POST['ufCampus'])){
        $strUFCampus = $_SESSION['strUFCampus'];
    } else {
        $strUFCampus = $_POST['ufCampus'];
    }

    // Conectando com o servidor MySQL
    $link = mysqli_connect("localhost", "root", "usbw");
    if (!$link){
    //     die("Conexao falhou: ".mysqli_connect_error()."<br/>");
    } else {
    //     echo "Conexao efetuada com sucesso!<br/>";
    }
    // Selecionado BD
    $sql = mysqli_select_db($link, 'Educatio');

    //Alterando informações
    $sql = "UPDATE campi SET nome = '$strNomeCampus' WHERE id = $intIdCampus";
    if (mysqli_query($link, $sql)) {
    //     echo "sucesso";
    }else{
    //     echo "erro";
    }

    $sql = "UPDATE campi SET cidade = '$strCidadeCampus' WHERE id = $intIdCampus";
    if (mysqli_query($link, $sql)) {
    //     echo "sucesso";
    }else{
    //     echo "erro";
    }

    $sql = "UPDATE campi SET UF = '$strUFCampus' WHERE id = $intIdCampus";
    if (mysqli_query($link, $sql)) {
    //     echo "sucesso";
    }else{
    //     echo "erro";
    }
?>
<html>
    <head>
        <title>Alterar Campus</title>
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
        <!-- <script src="js/JHJ-web-script-alterar-campus.js" type="text/javascript"></script> -->

        <!-- Fontes e icones -->
        <link href="../../../../Estaticos/Bootstrap/css/nucleo-icons.css" rel="stylesheet">
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

        <script type="text/javascript">
            function voltarParaPaginaAlteracaoCampus(){
                location.href = "../../../Entrada/gerencia-web-interface-coordenador.php?acao=alterarCampus";
            }
        </script>
    </head>
    <body>
        <div class="wrapper">         
            <!-- <div class="section landing-section"> -->
            <?php require "../../../Menu-Rodape-Secundarios/caso-1/gerencia-web-menu-interface-coordenador.php"; ?>
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 ml-auto mr-auto">
                            <h2 class="text-center">ALTERAÇÃO DE CAMPUS</h2>
                            <!-- exibindo novas informações do campus dentro de um painel -->                    
                            <div class='container' style='margin-top: 50px;'>
                                <div class='row'>
                                    <div class='col-md-8 ml-auto mr-auto'>                    
                                        <div class='panel'>
                                            <div class='panel-heading' style='margin-top: 0px;'>
                                                <div class='panel-title'>Campus alterado com sucesso!</div>
                                            </div>  
                                            <div style='padding-top: 20px' class='panel-body' id='padin'>  
                                                <p style="font-weight: bold;">As novas informações do campus são:</p> 
                                                <p><label style="font-weight: bold; margin-bottom: 0;">Nome:</label><?php echo " ".$strNomeCampus ?></p>
                                                <p><label style="font-weight: bold; margin-bottom: 0;">Cidade:</label><?php echo " ".$strCidadeCampus ?></p>
                                                <p><label style="font-weight: bold; margin-bottom: 0;">UF:</label><?php echo " ".$strUFCampus ?></p>
                                                <div class='row'>
                                                    <div class='col-md-4 ml-auto mr-auto'>
                                                        <button style='margin-bottom: 10px; margin-left: 10px;' type='button' class='btn btn-info' onClick='voltarParaPaginaAlteracaoCampus()'>VOLTAR</button>
                                                    </div>
                                                </div>                     
                                            </div>  
                                        </div> <!-- panel -->
                                    </div>
                                </div> <!-- row -->
                            </div> <!-- conteiner -->
                            <!-- fim do painel -->
                        </div>
                    </div>
                </div>
            <!-- </div> -->
            <?php require "../../../Menu-Rodape-Secundarios/caso-1/gerencia-web-rodape-caso-2.php"; ?>
        </div>
    </body>
</html>