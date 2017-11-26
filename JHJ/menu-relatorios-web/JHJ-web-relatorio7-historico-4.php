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

                        //Pegando id do curso
                        $strNomeCurso = $_POST['nomeCurso'];
                        $strSQL = $link->query("SELECT id FROM `Educatio`.`cursos` WHERE nome ='".$strNomeCurso."'");
                        while($arrLinha = $strSQL->fetch_assoc()) {
                            $intIdCurso = $arrLinha['id'];
                        }
                    ?>
                    <form class="contact-form" action="JHJ-web-relatorio7-historico-5.php" method="POST">
                        <div class="row">
                            <div div class="col-md-6" style="float: left;">
                                <label class="fonteTexto">Nome da turma onde o aluno estuda:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="nc-icon nc-check-2"></i>
                                    </span>
                                    <input type="text" class="form-control readonly" name="nomeTurma" id="txt_consulta1" placeholder="Nome da Turma" required='required'>
                                </div>       
                                <table class="table table-hover" required='required' id="tabela1">
                                    <!-- Pega os dados do banco e coloca na tabela -->
                                    <?php 
                                        $intI = 0;
                                        $intTurmaAtiva = 0;
                                        if(isset($intIdCurso)){
                                            $strSQL = $link->query("SELECT id, nome, ativo, serie FROM `Educatio`.`turmas` WHERE idCurso = '".$intIdCurso."'");
                                            while($arrLinha = $strSQL->fetch_assoc()) {
                                                if ($arrLinha['ativo'] == 'S') {    
                                                    $intTurmaAtiva++;
                                                    $vetNomeTurma[$intI] = $arrLinha['nome'];
                                                    $intI++;
                                                    
                                                }
                                            }
                                        }
                                        if($intTurmaAtiva == 0){
                                            echo "<br><p class='fonteTexto' style='text-align: center; font-weight: bold;'>N&atildeo existe nenhuma turma ativa no curso selecionado. Imposs&iacute;vel continuar.</p>";
                                        } else {
                                            //ordena array do menor para o maior 
                                            sort($vetNomeTurma);

                                            //salva todos os valores em um vetor auxiliar 
                                            for($intI = 0; $intI < count($vetNomeTurma); $intI++){
                                                $vetAuxNome[$intI] = $vetNomeTurma[$intI];
                                            }

                                            //remove valores repetidos do array
                                            $vetNomeTurma = array_unique($vetNomeTurma);

                                            for($intI = 0; $intI < count($vetAuxNome); $intI++){ //count é feito com vetAuxSerie pq array_unique mantem as chaves
                                                if(isset($vetNomeTurma[$intI])){
                                                    echo "
                                                    <tr>
                                                        <td style='font-weight: bold;' value='".$vetNomeTurma[$intI]."' onclick('document.getElementById('txt_consulta1').value = document.getElementById(this).innerHTML')>".$vetNomeTurma[$intI]."</td>
                                                    </tr>";
                                                }
                                            }
                                        }
                                    ?>
                                </table>      
                            </div>   

                            <div class="col-md-6" style="float: left;">
                                <label class="fonteTexto">S&eacuterie da turma onde o aluno estuda:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="nc-icon nc-check-2"></i>
                                    </span>
                                    <input type="text" class="form-control readonly" name="serieTurma" id="txt_consulta2" placeholder="S&eacute;rie da turma" required='required'>
                                </div>     
                                <table class="table table-hover" required='required' id="tabela2">
                                    <!-- Pega os dados do banco e coloca na tabela -->
                                    <?php 
                                        $intI = 0;
                                        $intTurmaAtiva = 0;
                                        if(isset($intIdCurso)){
                                            $strSQL = $link->query("SELECT id, nome, ativo, serie FROM `Educatio`.`turmas` WHERE idCurso = '".$intIdCurso."'");
                                            while($arrLinha = $strSQL->fetch_assoc()) {
                                                if ($arrLinha['ativo'] != 'N') {    
                                                    $intTurmaAtiva++;
                                                    $vetSerieTurma[$intI] = $arrLinha['serie'];
                                                    $intI++;
                                                }
                                                
                                            }
                                        }
                                        if($intTurmaAtiva == 0){
                                            echo "<br><p class='fonteTexto' style='text-align: center; font-weight: bold;'>N&atildeo existe nenhuma turma ativa no curso selecionado. Imposs&iacute;vel continuar.</p>";
                                        } else {
                                            //ordena array do menor para o maior 
                                            sort($vetSerieTurma);

                                            //salva todos os valores em um vetor auxiliar 
                                            for($intI = 0; $intI < count($vetSerieTurma); $intI++){
                                                $vetAuxSerie[$intI] = $vetSerieTurma[$intI];
                                            }

                                            //remove valores repetidos do array
                                            $vetSerieTurma = array_unique($vetSerieTurma, SORT_REGULAR);

                                            for($intI = 0; $intI < count($vetAuxSerie); $intI++){ //count é feito com vetAuxSerie pq array_unique mantem as chaves
                                                if(isset($vetSerieTurma[$intI])){
                                                    echo "
                                                    <tr>
                                                        <th style='font-weight: bold;' id='tr2' value='".$vetSerieTurma[$intI]."' onclick('document.getElementById('txt_consulta2').value = document.getElementById(this).innerHTML')>".$vetSerieTurma[$intI]."o ano</th>
                                                    </tr>";
                                                }
                                            }
                                        }
                                    ?>
                                </table>
                            </div>     
                        </div> 
                        <div class="row" style="margin-bottom: 10px; position: absolute;">
                             <div style="float: left;">
                                <button style="margin-left: 190px;" type="submit" class="btn btn-info btn-round">Selecionar turma</button>
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
                            $(document.getElementById("tabela1")).ready(function() {
                                $('td').click(function () { 
                                    document.getElementById("txt_consulta1").value = $(this).attr("value");
                                });
                            });
                            $(document.getElementById("tabela2")).ready(function() {
                                $('th').click(function () { 
                                    document.getElementById("txt_consulta2").value = $(this).attr("value");
                                });
                            });
                        </script>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>