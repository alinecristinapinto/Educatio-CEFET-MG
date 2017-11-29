<?php
    session_start();
    $select = $_POST['selectParaExcluirCampus'];
    foreach($select as $_valor){
        //pega id do campus que sera excluido
        $intIdCampus = $_valor;
        $_SESSION['intIdCampus'] =  $intIdCampus;
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
?>
<html>
    <head>
        <title>Remover Campus</title>
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
        <!-- <script src="../JHJ-web-script-remover-campus.js" type="text/javascript"></script> -->

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
            function voltarParaPaginaExclusaoCampus(){
                location.href = "../../../Entrada/gerencia-web-interface-coordenador.php?acao=removerCampus";
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
                            <h2 class="text-center">EXCLUSAO DE CAMPUS</h2>
                            <?php
                                //Verificando se existem departamentos ligados com o campus selecionado
                                if ($result = mysqli_query($link, " SELECT id FROM deptos WHERE idCampi = $intIdCampus AND ativo = 'S' ")) {
                                    //total de departamentos do campus selecionado
                                    $intTotalDeptosCampusSelecionado = mysqli_num_rows($result);
                                    mysqli_free_result($result);
                                } else {
                                    // echo "erro";
                                }

                                if($intTotalDeptosCampusSelecionado > 0) {
                                    if ($result = mysqli_query($link, "SELECT id FROM deptos")) {
                                        //total de linhas da tabela deptos
                                        $intTotalLinhasTabelaDeptos = mysqli_num_rows($result);
                                        mysqli_free_result($result);
                                    } else {
                                        // echo "erro";
                                    }
                                    //Verifica linha por linha na tabela e salva o nome dos departamentos em um vetor
                                    $intJ = 0;
                                    for ($intI = 1; $intI <= $intTotalLinhasTabelaDeptos; $intI++){
                                        if ($query = mysqli_query($link, " SELECT nome FROM deptos WHERE id = $intI AND idCampi = $intIdCampus AND ativo = 'S' ")) {
                                            $departamento = mysqli_fetch_array($query);
                                            if($departamento['nome'] != null){
                                                $strVetorNomesDeptos[$intJ] = $departamento['nome']; 
                                                $intJ++;
                                            }
                                        }
                                    }
                                } else if($intTotalDeptosCampusSelecionado == 0) {
                                    //Seleciona os dados do campus com id recebido pelo select
                                    $query = mysqli_query($link, " SELECT nome, cidade, UF, ativo FROM campi WHERE id = $intIdCampus ");
                                    while($campus = mysqli_fetch_array($query)) { 
                                        $strNomeCampus = $campus['nome'];
                                        $strCidadeCampus = $campus['cidade'];
                                        $strUFCampus = $campus['UF'];
                                        $strAtivoCampus = $campus['ativo']; 
                                    }
                                    //Tornando campus inativo ("excluindo")
                                    $sql = "UPDATE campi SET ativo = 'N' WHERE id = $intIdCampus";
                                    if (mysqli_query($link, $sql)) {
                                    //     echo "sucesso";
                                    }else{
                                    //     echo "erro";
                                    }
                                }
                            ?>

                            <!-- exibindo informações dentro de um painel -->
                            <?php
                                if($intTotalDeptosCampusSelecionado > 0) {
                                echo "
                                <div class='container' style='margin-top: 50px;'>
                                    <div class='row'>
                                        <div class='col-md-8 ml-auto mr-auto'>                    
                                            <div class='panel'>
                                                <div class='panel-heading' style='margin-top: 0px;'>
                                                    <div class='panel-title'>O campus selecionado está interligado com ".$intTotalDeptosCampusSelecionado." departamento(s) e não pode ser removido!</div>
                                                </div>  
                                                <div style='padding-top: 20px' class='panel-body' id='padin'>  
                                                    <p style='font-weight: bold;'>Nome(s) do(s) departamento(s):</p>"; 
                                                    foreach ($strVetorNomesDeptos as $valor) {
                                                        echo $valor."<br>";
                                                    }
                                                    echo "<br>";
                                                    echo "
                                                    <p><label style='font-weight: bold; margin-bottom: 0;'>*</label>Para excluir um campus é necessário anteriormente remover os departamentos que estão interligados a ele.</p>
                                                    <div class='row'>
                                                        <div style='float: left;' class='col-md-4 ml-auto mr-auto'>
                                                            <button style='margin-bottom: 10px; margin-left: 10px;' type='button' class='btn btn-info' onClick='voltarParaPaginaExclusaoCampus()'>VOLTAR</button>
                                                        </div>
                                                    </div>                   
                                                </div>  
                                            </div> <!-- panel -->
                                        </div>
                                    </div> <!-- row -->
                                </div> <!-- conteiner -->";

                                } else if($intTotalDeptosCampusSelecionado == 0) {
                                    echo "
                                    <div class='container' style='margin-top: 50px;'>
                                        <div class='row'>
                                            <div class='col-md-8 ml-auto mr-auto'>                    
                                                <div class='panel'>
                                                    <div class='panel-heading' style='margin-top: 0px;'>
                                                        <div class='panel-title'>Campus removido com sucesso!*</div>
                                                    </div>  
                                                    <div style='padding-top: 20px' class='panel-body' id='padin'>  
                                                        <p style='font-weight: bold;'>As informações do campus excluído são:</p> 
                                                        <p><label style='font-weight: bold; margin-bottom: 0;'>Nome:</label> ".$strNomeCampus."</p>
                                                        <p><label style='font-weight: bold; margin-bottom: 0;'>Cidade:</label> ".$strCidadeCampus."</p>
                                                        <p><label style='font-weight: bold; margin-bottom: 0;'>UF:</label> ".$strUFCampus."</p>
                                                        <p><label style='font-weight: bold; margin-bottom: 0;'>*</label>O campus  não estava interligado com nenhum departamento.</p>
                                                        <div class='row'>
                                                            <div class='col-md-4 ml-auto mr-auto'>
                                                                <button style='margin-bottom: 10px; margin-left: 10px;' type='button' class='btn btn-info' onClick='voltarParaPaginaExclusaoCampus()'>VOLTAR</button>
                                                            </div>
                                                        </div>                     
                                                    </div>  
                                                </div> <!-- panel -->
                                            </div>
                                        </div> <!-- row -->
                                    </div> <!-- conteiner -->";
                                }
                            ?>
                        </div>
                    </div>
                </div>
            <!-- </div> -->
        </div>
        <?php require "../../../Menu-Rodape-Secundarios/caso-1/gerencia-web-rodape-caso-2.php"; ?>
    </body>
</html>