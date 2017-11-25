<?php 
    session_start();
    header ('Content-type: text/html; charset=ISO-8859-1'); 
    $select = $_POST['selectCursoParaAcessarProfessores'];
    foreach($select as $_valor){
        $intIdCurso = $_valor; 
        $_SESSION['intIdCurso'] =  $intIdCurso;   
    }
    // Conectando com o servidor MySQL
    $link = mysqli_connect("localhost", "root", "");
    if (!$link){
    //     die("Conexao falhou: ".mysqli_connect_error()."<br/>");
    } else {
    //     echo "Conexao efetuada com sucesso!<br/>";
    }
    //Selecionado BD
    $sql = mysqli_select_db($link, 'Educatio');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Acessar professores</title>
        <meta charset="utf-8">

        <!-- CSS do Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet" />
        <link href="css/bootstrap.css" rel="stylesheet"/>

        <!-- CSS do grupo -->
        <link href="css/JHJ-web-estilos.css" rel="stylesheet" />
        <link href="css/JHJ-web-estilos-relatorio9-tabela.css" rel="stylesheet" />
        <link href="css/JHJ-web-estilos-relatorio9-tabela-filtros.css" rel="stylesheet" />

        <!-- Arquivos js -->
        <script src="js/popper.js"></script>
        <script src="js/jquery-3.2.1.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/JHJ-web-script.js" type="text/javascript"></script>
        <script src="js/JHJ-web-script-relatorio9-tabela.js" type="text/javascript"></script>

        <!-- Fontes e icones -->
        <link href="css/nucleo-icons.css" rel="stylesheet">   
    </head>
    <body>
        <h2 class="text-center">ACESSAR PROFESSORES</h2>
        <?php
            //Pega dados do curso que foi selecionado por meio do id
            $query = mysqli_query($link, "SELECT idDepto, nome FROM cursos WHERE id = $intIdCurso");
            $curso = mysqli_fetch_array($query);
            $intIdDeptoCursoSelecionado = $curso['idDepto'];  
            $strNomeCursoSelecionado = $curso['nome'];
            //Pegar nome do departamento
            $query = mysqli_query($link, "SELECT nome FROM deptos WHERE id = $intIdDeptoCursoSelecionado");
            $depto = mysqli_fetch_array($query);
            $strNomeDeptoCursoSelecionado = $depto['nome'];
            //Seleciona id's das turmas do curso por meio id do curso recebido pelo select
            $intExisteTurma = 0;
            $intJ = 0;
            $query = mysqli_query($link, "SELECT id FROM turmas WHERE idCurso = $intIdCurso AND ativo = 'S'");
            while($turmas = mysqli_fetch_array($query)){
                $vetIdTurmas[$intJ] = $turmas['id'];
                $intExisteTurma = 1;
                $intJ++;
            }
            //Seleciona dados das disciplinas por meio dos id's das turmas
            $intExisteDisciplina = 0;
            if ($intExisteTurma == 1){
                $intJ = 0;
                for ($intK = 0; $intK < count($vetIdTurmas); $intK++){
                    $query = mysqli_query($link, " SELECT id, nome, cargaHorariaMin FROM disciplinas WHERE idTurma = $vetIdTurmas[$intK] AND ativo='S' ");
                    while($disciplinas = mysqli_fetch_array($query)){
                        $vetIdDisciplinas[$intJ] = $disciplinas['id'];
                        $vetNomeDisciplinas[$intJ] = $disciplinas['nome'];
                        $vetCargaHorariaMinDisciplinas[$intJ] = $disciplinas['cargaHorariaMin'];
                        $intExisteDisciplina = 1;
                        $intJ++;
                    }
                }
            } else {
                header ('Content-type: text/html; charset=UTF-8'); 
                echo "
                <div class='container' style='margin-top: 50px;'>
                    <div class='row'>
                        <div class='col-md-8 ml-auto mr-auto'>                    
                            <div class='panel'>
                                <div class='panel-heading' style='margin-top: 0px;'>
                                    <div class='panel-title'>Curso de ".$strNomeCursoSelecionado." - ".$strNomeDeptoCursoSelecionado."</div>
                                </div>  
                                <div style='padding-top:20px' class='panel-body' id = 'padin'>  
                                    <p style = 'font-weight:bold'>O relatório não pode ser exibido!</p>   
                                    <p>Não existe nenhuma turma no curso selecionado</p>";
                        }
            //seleciona id's dos professores em profdisciplinas por meio dos id's das disciplinas
            $intExisteProfessor = 0;
            if ($intExisteDisciplina == 1){
                $intJ = 0;
                $intAux = 0;
                for ($intK = 0; $intK < count($vetIdDisciplinas); $intK++){
                    $query = mysqli_query($link, " SELECT idProfessor FROM profdisciplinas WHERE idDisciplina = $vetIdDisciplinas[$intK] AND ativo='S' ");
                    while($profdisciplinas = mysqli_fetch_array($query)){
                        //OBS: se o professor der aula para mais de uma disciplina, seu id se repetirá no vetor, tratando isso aqui:
                        $intFlagRepeticao = 0;
                        $vetAuxVerificaRepeticao[$intAux] = $profdisciplinas['idProfessor'];
                        for ($intY = 0; $intY < $intAux; $intY++){
                            if ($vetAuxVerificaRepeticao[$intY] == $profdisciplinas['idProfessor']){
                                $intFlagRepeticao++;
                            }
                        }
                        if ($intFlagRepeticao == 0){
                            $vetIdProfDisciplinas[$intJ] = $profdisciplinas['idProfessor'];
                            $intExisteProfessor = 1;
                            $intJ++;
                        }
                        $intAux++;
                    } //fim do while
                }
           // print_r($vetIdProfDisciplinas);
            } if ($intExisteDisciplina == 0 && $intExisteTurma == 0) {
                echo "<p>Não existe nenhuma disciplina no curso selecionado</p>";
            } if ($intExisteDisciplina == 0 && $intExisteTurma == 1) {
                header ('Content-type: text/html; charset=UTF-8'); 
                echo "
                <div class='container' style='margin-top: 50px;'>
                    <div class='row'>
                        <div class='col-md-8 ml-auto mr-auto'>                    
                            <div class='panel'>
                                <div class='panel-heading' style='margin-top: 0px;'>
                                    <div class='panel-title'>Curso de ".$strNomeCursoSelecionado." - ".$strNomeDeptoCursoSelecionado."</div>
                                </div>  
                                <div style='padding-top:20px' class='panel-body' id = 'padin'>  
                                    <p style = 'font-weight:bold'>O relatório não pode ser exibido!</p>    
                                    <p>Não existe nenhuma disciplina no curso selecionado</p>";
            }
            if($intExisteProfessor == 1){
                //seleciona idSIAPE de todos os professores ativos em fucionario para comparar com id de profdisciplinas
                $query = mysqli_query($link, "SELECT idSIAPE FROM funcionario WHERE hierarquia = 'Professor' OR hierarquia = 'Coordenador' AND ativo = 'S' ");
                $intI = 0;
                $vetIdSiapeProfessores[$intI] = 0;
                while($funcionario = mysqli_fetch_array($query)){
                    $vetIdSiapeProfessores[$intI] = $funcionario['idSIAPE'];
                    $intI++;
                }

                //grava nome dos professores que tiverem o idSIAPE no vetor de idProfessores em um vetor de nomes
                $intI = 0;
                $intJ = 0;
                $intK = 0;
                for ($intI = 0; $intI < count($vetIdSiapeProfessores); $intI++){
                    for($intJ = (count($vetIdProfDisciplinas)-1); $intJ >= 0; $intJ--){
                        if ($vetIdSiapeProfessores[$intI] == $vetIdProfDisciplinas[$intJ]){
                            $query = mysqli_query($link, " SELECT nome FROM funcionario WHERE idSIAPE = $vetIdSiapeProfessores[$intI] AND ativo='S' ");
                            while($funcionario = mysqli_fetch_array($query)){
                                $vetNomeProfessores[$intK] = $funcionario['nome'];
                                $intK++;
                            }   

                        }
                    }
                } 
                // echo "TESTE <br>";
                // echo "Nome do curso selecionado: ";
                // print_r($strNomeCursoSelecionado);
                // echo "<br> Departamento do curso: ";
                // print_r($strNomeDeptoCursoSelecionado);
                // echo "<br> Id's das turmas do curso (não peguei nome porque não uso no relatório): ";
                // print_r($vetIdTurmas);
                // echo "<br> Id's das disciplinas do curso:  ";
                // print_r($vetIdDisciplinas);
                // echo "<br> Nomes das disciplinas do curso: ";
                // print_r($vetNomeDisciplinas);
                // echo "<br> Carga Horaria Min das disciplinas do curso: ";
                // print_r($vetCargaHorariaMinDisciplinas);
                // echo "<br> Id's dos professores em profdisciplinas: ";
                // print_r($vetIdProfDisciplinas);
                // echo "<br> Id's SIAPE de TODOS os professores: ";
                // print_r($vetIdSiapeProfessores);
                // echo "<br> Nomes dos professores APENAS DO CURSO SELECIONADO (obtidos com a comparação entre o idProfessor e o idSIAPE, que são a mesma coisa: ";
                // print_r($vetNomeProfessores);
                // echo "FIM DO TESTE <br><br>";

                //ORGANIZANDO DADOS PARA EXIBIÇÃO NA TABELA 
                //Ordenando array para os nomes ficarem em ordem alfabetica na tabela
                //OBS: função sort ordena um array. os elementos serão ordenados do menor para o maior ao final da execução dessa função.
                sort($vetNomeProfessores);
                // print_r($vetNomeProfessores);
                // echo "<br>";

                //Crindo vetor que armazena o idSIAPE na mesma posição que está o nome em $vetNomeProfessores
                //Por ex, se Vivas está em $vetNomeProfessores[20], seu idSIAPE estará em $vetAuxIdSiapeProfessores[20]
                $intI = 0;
                for ($intI = 0; $intI < count($vetNomeProfessores); $intI++){
                    $query = mysqli_query($link, " SELECT idSIAPE FROM funcionario WHERE nome = '$vetNomeProfessores[$intI]' AND ativo='S' ");
                    while($funcionario = mysqli_fetch_array($query)){
                        $vetAuxIdSiapeProfessores[$intI] = $funcionario['idSIAPE'];
                    }
                }
                // print_r($vetAuxIdSiapeProfessores);
                // echo "<br>";

                //Criando matriz[i][j] que armazena a posicao do idSIAPE do professor em [i] e o id da disciplina em [j]
                $intJ = 0;
                for ($intI = 0; $intI < count($vetAuxIdSiapeProfessores); $intI++){
                    $query = mysqli_query($link, " SELECT idDisciplina FROM profdisciplinas WHERE idProfessor = $vetAuxIdSiapeProfessores[$intI] AND ativo='S' ");
                    while($profdisciplinas = mysqli_fetch_array($query)){
                        $vetAuxIdDisciplinas[$intI][$intJ] = $profdisciplinas['idDisciplina'];
                        $intJ++;
                    }
                }
                // print_r($vetAuxIdDisciplinas);
                // echo "<br>";
                // echo count($vetAuxIdDisciplinas[0]);
                // echo "<br>";

                //criando vetor auxiliar com o id da disciplina para fazer a query abaixo (que pega o nome da disciplina)
                $intK = 0;
                $intAux = 0;
                for ($intI = 0; $intI < count($vetAuxIdSiapeProfessores); $intI++){
                    $intQuantidadeDisciplinas = count($vetAuxIdDisciplinas[$intI]);
                    $intAux = $intK;
                    for($intJ = $intAux; $intJ < ($intQuantidadeDisciplinas+$intAux); $intJ++){
                        $vetAux[$intK] = $vetAuxIdDisciplinas[$intI][$intJ];
                        $intK++;
                    }
                }
                // print_r($vetAux);
                // echo "<br>";

                //Criando matrizes[i][j] que armazenam a posicao do idSIAPE do professor em [i] e o nome/cargaHoraria da disciplina em [j]
                $intK = 0;
                for ($intI = 0; $intI < count($vetAuxIdSiapeProfessores); $intI++){
                    $intQuantidadeDisciplinas = count($vetAuxIdDisciplinas[$intI])+$intK;
                    for ($intJ = $intK; $intJ < count($vetAux); $intJ++){
                        $query = mysqli_query($link, " SELECT nome, cargaHorariaMin FROM disciplinas WHERE id = $vetAux[$intJ] AND ativo='S' ");
                        while(($disciplinas = mysqli_fetch_array($query)) && ($intK < $intQuantidadeDisciplinas)){
                            $vetAuxNomeDisciplinas[$intI][$intK] = $disciplinas['nome'];
                            $vetAuxCargaHorariaDisciplinas[$intI][$intK] = $disciplinas['cargaHorariaMin'];
                            $intK++;
                        }
                    }
                } 
                // print_r($vetAuxNomeDisciplinas);
                // echo "<br>";
                //print_r($vetAuxCargaHorariaDisciplinas);

                // TABELA ONDE SERÃO EXIBIDOS OS DADOS DO RELATORIO
                echo "
                <div class='container' style='margin-top: 30px;'>
                    <div class='panel panel-primary filterable'>
                        <div class='panel-heading'>
                            <h3 class='panel-title'>Curso de ".$strNomeCursoSelecionado." - ".$strNomeDeptoCursoSelecionado."</h3>
                            <div class='pull-right'>
                                <button style='margin-left: 1000px; margin-top: -10px; color: white;' class='btn btn-default btn-xs btn-filter btn-link'><span class='glyphicon glyphicon-filter'></span> Filtrar</button>
                            </div>
                        </div>
                        <table class='table'>
                            <thead>
                                <tr class='filters'>
                                    <th><input style='font-weight:bold' type='text' class='form-control' placeholder='Nome do professor' disabled></th>
                                    <th><input style='font-weight:bold' type='text' class='form-control' placeholder='Disciplinas' disabled></th>
                                    <th><input style='font-weight:bold' type='text' class='form-control' placeholder='Horas de trabalho' disabled></th>
                                </tr>
                            </thead>
                            <tbody>";
                              
                                //função array_sum calcula a soma dos elementos de um array
                                $intJ = 0;
                                for ($intI = 0; $intI < count($vetNomeProfessores); $intI++){
                                    echo "
                                        <tr>
                                            <td>".$vetNomeProfessores[$intI]."</td>
                                            <td>".$vetAuxNomeDisciplinas[$intI][$intJ]."</td>
                                            <td>".$vetAuxCargaHorariaDisciplinas[$intI][$intJ]."</td>";
                                            $intJ++;
                                    echo "</tr>";
                                    $intQuantidadeDisciplinas = count($vetAuxIdDisciplinas[$intI]);
                                    for ($intK = 0; $intK < ($intQuantidadeDisciplinas-1); $intK++){
                                        echo "
                                        <tr>
                                            <td>".$vetNomeProfessores[$intI]."</td>
                                            <td>".$vetAuxNomeDisciplinas[$intI][$intJ]."</td>
                                            <td>".$vetAuxCargaHorariaDisciplinas[$intI][$intJ]."</td>
                                        </tr>";
                                        $intJ++;
                                    }
                                }

                            echo "
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class='row'>
                    <div style='float: left;' class='col-md-4 ml-auto mr-auto'>
                        <button style='margin-top: 10px; margin-left: 750px;' type='button' class='btn btn-info btn-round' onClick='voltarParaPaginaAcessarProfessoresSelecionarCurso()'>Voltar</button>  
                    </div>
                    <div style='float: left;' class='col-md-4 ml-auto mr-auto'>
                        <button style='margin-top: 10px; margin-left: 150px;' type='button' class='btn btn-info btn-round' onClick='irParaPaginaDownloadRealtorioAcessarProfessores()'>Download do Relat&oacuterio em PDF</button>  
                    </div>
                </div>";
            } // fim do if que verifica existencia do professor 
            if ($intExisteProfessor == 0 && $intExisteDisciplina == 0) {
                echo "<p>Não existe nenhum professor associado a disciplina no curso selecionado<p>";
            }
            if ($intExisteProfessor == 0 && $intExisteDisciplina == 1) {
                header ('Content-type: text/html; charset=UTF-8'); 
                echo "
                <div class='container' style='margin-top: 50px;'>
                    <div class='row'>
                        <div class='col-md-8 ml-auto mr-auto'>                    
                            <div class='panel'>
                                <div class='panel-heading' style='margin-top: 0px;'>
                                    <div class='panel-title'>Curso de ".$strNomeCursoSelecionado." - ".$strNomeDeptoCursoSelecionado."</div>
                                </div>  
                                <div style='padding-top:20px' class='panel-body' id = 'padin'>  
                                    <p style='font-weight:bold'>O relatório não pode ser exibido!</p>   
                                    <p>Não existe nenhum professor associado a disciplina no curso selecionado</p>";

            }
            if ($intExisteTurma == 0 || $intExisteDisciplina == 0 || $intExisteProfessor == 0){ 
                echo "      
                                    <div class='row'>
                                        <div class='col-md-4 ml-auto mr-auto'>
                                            <button style='margin-bottom: 10px; margin-left: 50px;' type='button' class='btn btn-info btn-round' value='Voltar' onClick='voltarParaPaginaAcessarProfessoresSelecionarCurso()'>Voltar</button>
                                        </div>
                                    </div>                     
                                </div>  
                            </div> <!-- panel -->
                        </div>
                    </div> <!-- row -->
                </div> <!-- conteiner -->";
            }
        ?>
    </body>
</html>