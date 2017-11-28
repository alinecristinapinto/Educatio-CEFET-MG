<?php header ('Content-type: text/html; charset=ISO-8859-1'); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Hist&oacuterico Escolar</title>
        <meta charset="utf-8">
        
        <!-- CSS do Bootstrap -->
        <link href="../../../../Estaticos/Bootstrap/css/bootstrap.min.css" rel="stylesheet" />
        <link href="../../../../Estaticos/Bootstrap/css/bootstrap.css" rel="stylesheet"/>

        <!-- CSS do grupo -->
        <link href="JHJ-web-estilos.css" rel="stylesheet" />

        <!-- Arquivos js -->
        <script src="../../../../Estaticos/Bootstrap/js/popper.js"></script>
        <script src="../../../../Estaticos/Bootstrap/js/jquery-3.2.1.js" type="text/javascript"></script>
        <script src="../../../../Estaticos/Bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="JHJ-web-script-relatorio7.js" type="text/javascript"></script>

        <!-- Fontes e icones -->
        <link href="../../../../Estaticos/Bootstrap/css/nucleo-icons.css" rel="stylesheet">
    </head>
    <body>
    <!-- <div class="section landing-section"> -->
        <?php 
            require "../../../Menu-Rodape-Secundarios/caso-1/gerencia-web-menu-interface-coordenador.php";
        ?>
        <div class="container">
            <div class="row">
                <div class="col-md-8 ml-auto mr-auto">
                    <h2 class="text-center">HIST&OacuteRICO ESCOLAR</h2>
                    <?php
                        // Conectando com o servidor MySQL
                        $link = mysqli_connect("localhost", "root", "usbw");
                        if (!$link){
                        //     die("Conexao falhou: ".mysqli_connect_error()."<br/>");
                        } else {
                        //     echo "Conexao efetuada com sucesso!<br/>";
                        }
                        //Selecionado BD
                        $sql = mysqli_select_db($link, 'Educatio');

                        //Pegando id do departamento
                        $strNomeDepto = $_POST['nomeDepto'];
                        $strSQL = $link->query("SELECT id FROM `Educatio`.`deptos` WHERE nome ='".$strNomeDepto."'");
                        while($arrLinha = $strSQL->fetch_assoc()) {
                            $intIdDepto = $arrLinha['id'];
                        }
                    ?>
                    <form class="contact-form" action="JHJ-web-relatorio7-historico-4.php" method="POST">
                        <div class="row">
                            <label class="fonteTexto">Curso que o aluno estuda:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="nc-icon nc-book-bookmark"></i>
                                </span>
                                <input type="text" class="form-control readonly" name="nomeCurso" id="txt_consulta" placeholder="Nome do Curso" required='required'>
                            </div>                         

                            <table class="table table-hover" required='required' id="tabela">
                                <!-- Pega os dados do banco e coloca na tabela -->
                                <?php 
                                    $intCursoAtivo = 0;
                                    $strSQL = $link->query("SELECT id, nome, ativo FROM `Educatio`.`cursos` WHERE idDepto = '".$intIdDepto."'");
                                    while($arrLinha = $strSQL->fetch_assoc()) {
                                        if ($arrLinha['ativo'] == 'S') {    
                                            $intCursoAtivo++;
                                            echo "
                                            <tr value='".$arrLinha['nome']."' onclick('document.getElementById('txt_consulta').value = document.getElementById(this).innerHTML')>
                                                <td style='font-weight: bold;'>".$arrLinha['nome']."</td>
                                            </tr>";
                                        }
                                    }
                                ?>
                            </table>
                        </div>  
                        <?php
                            if($intCursoAtivo == 0){
                                echo "
                                <div class='row'>
                                    <p class='fonteTexto' style='font-weight: bold;'>N&atildeo existe nenhum curso ativo no departamento selecionado. Imposs&iacute;vel continuar.</p>
                                </div>";
                            }
                        ?>
                        <div class="row" style="margin-bottom: 10px;">
                            <div style="float: left;">
                                <button style="margin-left: 220px;" type="submit" class="btn btn-info btn-round">Selecionar curso</button>
                            </div>
                            <div style="float: left;">
                                <button style="margin-left: 10px;" type="button" class="btn btn-info btn-round" onClick="voltarParaPaginaSelecionarCampi()">Voltar para o in&iacutecio</button>
                            </div>
                        </div>  

                        <!-- Faz com que required e readonly funcionem juntos -->
                        <script>
                            $(".readonly").keydown(function(e){
                                e.preventDefault();
                            });
                        </script>

                        <!-- Filtro da Tabela -->
                        <script>
                            $('input#txt_consulta').quicksearch('table#tabela tbody tr');
                        </script>
                    
                        <!-- Função de clique na tabela -->
                        <script>
                            $(document.getElementById("tabela")).ready(function() {
                                $('tr').click(function () { 
                                    document.getElementById("txt_consulta").value = $(this).attr("value");
                                });
                            });
                        </script>
                    </form>
                </div>
            </div>
        </div>
        <?php require "../../../Menu-Rodape-Secundarios/caso-1/gerencia-web-rodape.php"; ?>
    </body>
</html>