<?php //header ('Content-type: text/html; charset=ISO-8859-1'); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Hist&oacuterico Escolar</title>
        <meta charset="utf-8">
        
        <!-- CSS do Bootstrap -->

        <!-- CSS do grupo -->
        <link href="../Opcoes-do-sistema/Relatorios/relatorio-7-historico/JHJ-web-estilos.css" rel="stylesheet" />

        <!-- Arquivos js -->

        <!-- Fontes e icones -->
    </head>
    <body>
    <!-- <div class="section landing-section"> -->
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
                    ?>
                    <form class="contact-form" action="../Opcoes-do-sistema/Relatorios/relatorio-7-historico/JHJ-web-relatorio7-historico-2.php" method="POST">
                        <div class="row">
                            <label class="fonteTexto">Campi onde o aluno estuda:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="nc-icon nc-bank"></i>
                                </span>
                                <input class="form-control readonly" type="text" name="nomeCampus" id="txt_consulta" placeholder="Nome do Campus" required >
                            </div>                           
    
                            <table class="table table-hover" id="tabela">
                                <!-- Pega os dados do banco e coloca na tabela -->
                                <?php 
                                    $intCampusAtivo = 0;
                                    $strSQL = $link->query("SELECT id, nome, ativo, cidade, UF FROM `Educatio`.`campi`");
                                    while($arrLinha = $strSQL->fetch_assoc()) {
                                        if ($arrLinha['ativo'] == 'S') {    
                                            $intCampusAtivo++;
                                            echo "
                                            <tr value='".$arrLinha['nome']."' onclick('document.getElementById('txt_consulta').value = document.getElementById(this).innerHTML')>
                                                <td style='font-weight: bold;'>".$arrLinha['nome']."</td>
                                                <td>".$arrLinha['cidade']."</td>
                                                <td>".$arrLinha['UF']."</td>
                                            </tr>";
                                        }
                                        
                                    }
                                    
                                ?>
                            </table>
                        </div>
                        <?php
                            if($intCampusAtivo == 0){
                                echo "
                                <div class='row'>
                                    <p class='fonteTexto' style='font-weight: bold;'>N&atildeo existe nenhum campus ativo. Imposs&iacute;vel continuar.</p>
                                </div>";
                            }
                        ?>
                        <div class="row" style="margin-bottom: 10px;">
                            <div class="col-md-4 ml-auto mr-auto">
                                <button type="submit" class="btn btn-info btn-round">Selecionar campus</button>
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
    </body>
</html>