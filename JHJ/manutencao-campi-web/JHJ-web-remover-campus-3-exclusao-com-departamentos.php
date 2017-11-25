<?php
    session_start();
    //pega id do campus que sera excluido
    $intIdCampus = $_SESSION['intIdCampus'];
    // Conectando com o servidor MySQL
    $link = mysqli_connect("localhost", "root", "");
    if (!$link){
    //     die("Conexao falhou: ".mysqli_connect_error()."<br/>");
    } else {
    //     echo "Conexao efetuada com sucesso!<br/>";
    }
    // Selecionado BD
    $sql = mysqli_select_db($link, 'Educatio');
?>
<html>
    <head>
        <title>Remover Campus</title>
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
        <script src="js/JHJ-web-script-remover-campus.js" type="text/javascript"></script>

        <!-- Fontes e icones -->
        <link href="css/nucleo-icons.css" rel="stylesheet">
    </head>
    <body>
        <div class="wrapper">         
            <div class="section landing-section">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 ml-auto mr-auto">
                            <h2 class="text-center">EXCLUSÃO DE CAMPUS</h2>
                            <?php
                                //Seleciona os dados do campus com id recebido pelo select
                                $query = mysqli_query($link, " SELECT nome, cidade, UF, ativo FROM campi WHERE id = $intIdCampus ");
                                while($campus = mysqli_fetch_array($query)) { 
                                    $strNomeCampus = $campus['nome'];
                                    $strCidadeCampus = $campus['cidade'];
                                    $strUFCampus = $campus['UF'];
                                    $strAtivoCampus = $campus['ativo']; 
                                }
                                
                                //Tornando campus inativo ("excluindo")
                                //IMPORTANTE !!! CHAMAR FUNÇÕES DE OUTROS GRUPOS PARA EXCLUIR (.. CURSOS, DEPARTAMENTOS)
                                $sql = "UPDATE campi SET ativo = 'N' WHERE id = $intIdCampus";
                                if (mysqli_query($link, $sql)) {
                                //     echo "sucesso";
                                }else{
                                //     echo "erro";
                                }
                            ?>
                            <!-- exibindo informações do campus que foi removido dentro de um painel -->                            
                            <div class='container' style='margin-top: 50px;'>
                                <div class='row'>
                                    <div class='col-md-8 ml-auto mr-auto'>                    
                                        <div class='panel'>
                                            <div class='panel-heading' style='margin-top: 0px;'>
                                                <div class='panel-title'>Campus removido com sucesso!</div>
                                            </div>  
                                            <div style='padding-top: 20px' class='panel-body' id='padin'>  
                                                <p style="font-weight: bold;">As informações do campus excluído são:</p> 
                                                <p><label style="font-weight: bold; margin-bottom: 0;">Nome:</label><?php echo " ".$strNomeCampus ?></p>
                                                <p><label style="font-weight: bold; margin-bottom: 0;">Cidade:</label><?php echo " ".$strCidadeCampus ?></p>
                                                <p><label style="font-weight: bold; margin-bottom: 0;">UF:</label><?php echo " ".$strUFCampus ?></p>
                                                <div class='row'>
                                                    <div class='col-md-4 ml-auto mr-auto'>
                                                        <button style='margin-bottom: 10px; margin-left: 10px;' type='button' class='btn btn-info btn-round' onClick='voltarParaPaginaExclusaoCampus()'>VOLTAR</button>
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
            </div>
        </div>
    </body>
</html>