<?php header ('Content-type: text/html; charset=ISO-8859-1'); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Hist&oacuterico Escolar</title>
        <meta charset="utf-8">
        
        <!-- CSS do Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet" />
        <link href="css/bootstrap.css" rel="stylesheet"/>

        <!-- CSS do grupo -->
        <link href="css/JHJ-web-estilos.css" rel="stylesheet" />

        <!-- Arquivos js -->
        <script src="js/popper.js"></script>
        <script src="js/jquery-3.2.1.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/JHJ-web-script-relatorio7.js" type="text/javascript"></script>

        <!-- Fontes e icones -->
        <link href="css/nucleo-icons.css" rel="stylesheet">
    </head>
    <body>
    <!-- <div class="section landing-section"> -->
        <div class="container">
            <div class="row">
                <div class="col-md-8 ml-auto mr-auto">
                    <h2 class="text-center">HIST&OacuteRICO ESCOLAR</h2>
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

                        //Pegando id da turma 
                        $strNomeTurma = $_POST['nomeTurma'];
                        $intSerieTurma = $_POST['serieTurma'];
                        $strSQL = $link->query("SELECT id FROM `Educatio`.`turmas` WHERE nome ='$strNomeTurma' AND serie = $intSerieTurma");
                        while($arrLinha = $strSQL->fetch_assoc()) {
                            $intIdTurma = $arrLinha['id'];
                        }
                    ?>
                    <form class="contact-form" action="JHJ-web-relatorio7-historico-6.php" method="POST">
                        <div class="row">
                            <label class="fonteTexto">Aluno que voc&ecirc deseja gerar o hist&oacuterico:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="nc-icon nc-circle-10"></i>
                                </span>
                                <input type="text" class="form-control readonly" name="cpfAluno" id="txt_consulta" placeholder="CPF do Aluno" required='required'>
                            </div>       
               
                            <table class='table table-hover' id="tabela">
                            <!-- Tabela de Pesquisa -->
                            <?php
                                $intAlunoAtivo = 0;
                                if(isset($intIdTurma)){
                                    $strSQL = $link->query("SELECT idCPF, nome, ativo FROM `Educatio`.`alunos` WHERE idTurma = '".$intIdTurma."'");
                                    while($arrLinha = $strSQL->fetch_assoc()) {
                                        if($arrLinha['ativo'] != 'N'){
                                            $intAlunoAtivo++;
                                            echo "
                                            <tr value='".$arrLinha['idCPF']."' onclick('document.getElementById('txt_consulta').value = document.getElementById(this).innerHTML')>
                                                <td style='font-weight: bold;'>".$arrLinha['idCPF']."</td>
                                                <td>".$arrLinha['nome']."</td>
                                            </tr>";
                                        }
                                    }
                                    echo "</table>"; 
                                }
                            ?>
                        </div>  
                        <?php
                            if($intAlunoAtivo == 0){
                                echo "
                                <div class='row' style='margin-left: 50px; margin-top: 10px;'>
                                    <p class='fonteTexto' style='font-weight: bold;'>N&atildeo existe nenhum aluno ativo na turma selecionada. Imposs&iacute;vel continuar.</p>
                                </div>";
                            }
                        ?> 
                        <div class="row" style="margin-bottom: 10px;">
                            <div style="float: left;">
                                <button style="margin-left: 130px;" type="submit" class="btn btn-info btn-round">Selecionar aluno e mostrar hist&Oacuterico</button>
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
    </body>
</html>
