<?php
    session_start();
    header ('Content-type: text/html; charset=ISO-8859-1');

    //IdCPF do aluno sendo pego por meio de pesquisa
    $intIdCpfAluno = $_GET['cpfAluno'];
    $_SESSION['intCpfAluno'] =  $intIdCpfAluno;

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
<!DOCTYPE html>
<html>
    <head>
        <title>Hist&oacuterico Escolar</title>
        <meta charset='utf-8'>

        <!-- CSS do Bootstrap -->
        <link href="../../../../Estaticos/Bootstrap/css/bootstrap.min.css" rel="stylesheet" />
        <link href="../../../../Estaticos/Bootstrap/css/bootstrap.css" rel="stylesheet"/>

        <!-- CSS do grupo -->
        <link href="JHJ-web-estilos.css" rel="stylesheet" />
        <link href="JHJ-web-estilos-relatorio7-tabela.css" rel="stylesheet" />

        <!-- Arquivos js -->
        <script src="../../../../Estaticos/Bootstrap/js/popper.js"></script>
        <script src="../../../../Estaticos/Bootstrap/js/jquery-3.2.1.js" type="text/javascript"></script>
        <script src="../../../../Estaticos/Bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="JHJ-web-script-relatorio7.js" type="text/javascript"></script>

        <!-- Fontes e icones -->
        <link href="../../../../Estaticos/Bootstrap/css/nucleo-icons.css" rel="stylesheet">   
    </head>
    <body>
        <?php 
            require "../../../Menu-Rodape-Secundarios/caso-1/gerencia-web-menu-interface-coordenador.php";
        ?>
        <h2 class='text-center'>HIST&OacuteRICO ESCOLAR</h2>
    </body>
</html>
<?php
    //Pegando idTurma, nome, sexo e nascimento do aluno
    $query = mysqli_query($link, "SELECT idTurma, nome, sexo, nascimento FROM alunos WHERE idCPF = '$intIdCpfAluno'");
    $alunos = mysqli_fetch_array($query);
    $intIdTurmaAluno = $alunos['idTurma'];  
    $strNomeAluno = $alunos['nome'];
    $strSexoAluno = $alunos['sexo'];
    $strNascimentoAluno = $alunos['nascimento'];

    //Pegando IdCurso do curso do aluno
    $query = mysqli_query($link, "SELECT idCurso FROM turmas WHERE id = $intIdTurmaAluno");
    $turmas = mysqli_fetch_array($query);
    $intIdCursoAluno = $turmas['idCurso'];  

    //Pegando nome e modalidade do curso do aluno
    $query = mysqli_query($link, "SELECT nome, modalidade FROM cursos WHERE id = $intIdCursoAluno");
    $cursos = mysqli_fetch_array($query);
    $strNomeCursoAluno = $cursos['nome'];
    $strModalidadeCursoAluno = $cursos['modalidade']; 

    //criando vetor com os anos 
    $query = mysqli_query($link, "SELECT ano FROM matriculas WHERE idAluno = '$intIdCpfAluno'");
    $intI = 0;
    while($matriculas = mysqli_fetch_array($query)){
        $vetAuxAnoMatriculaAluno[$intI] = $matriculas['ano'];
        $intI++;
    }

    //formatando vetor ano para que não exista repetição do mesmo ano em diferentes posições
    $intI = 0;
    $intJ = 0;
    $intAux = 0;
    for($intI = 0; $intI < count($vetAuxAnoMatriculaAluno); $intI++){
        if ($vetAuxAnoMatriculaAluno[$intI] != $intAux){
            $intAux = $vetAuxAnoMatriculaAluno[$intI];
            $vetAnoMatriculaAluno[$intJ] = $vetAuxAnoMatriculaAluno[$intI];
            $intJ++;
        }
    }

    //criando matriz que associa o ano com as respectivas matriculas [ano][matriculas]
    //criando matriz que associa o ano com as respectivas disciplinas [ano][disciplinas]
    $intI = 0;
    $intJ = 0;
    for ($intI = 0; $intI < count($vetAnoMatriculaAluno); $intI++){
        $query = mysqli_query($link, "SELECT id, idDisciplina FROM matriculas WHERE idAluno = '$intIdCpfAluno' AND ano = $vetAnoMatriculaAluno[$intI]");
        while($matriculas = mysqli_fetch_array($query)){
            $vetIdMatriculaAluno[$intI][$intJ] = $matriculas['id'];
            $vetIdDisciplinaAluno[$intI][$intJ] = $matriculas['idDisciplina'];
            $intJ++;
        } 
    }

    //criando vetor que associa o ano com o idTurma
    $intI = 0;
    $intJ = 0;
    $intK = 0;
    $intZ = 0;
    for ($intI = 0; $intI < count($vetAnoMatriculaAluno); $intI++){ 
        for ($intJ = 0; $intJ < count($vetIdDisciplinaAluno[$intI]); $intJ++){ 
            $vetAux = $vetIdDisciplinaAluno[$intI][$intK];
            $query = mysqli_query($link, "SELECT idTurma FROM disciplinas WHERE id = $vetAux");
            while($disciplinas = mysqli_fetch_array($query)){
                $vetAuxTurma[$intI][$intZ] = $disciplinas['idTurma'];
                $intZ++;
            }
            $intK++; 
        }
    }
    //criando vetor que associa o ano com a respectiva série
    $intI = 0;
    $intJ = 0;
    $intK = 0;
    $intZ = 0;
    for ($intI = 0; $intI < count($vetAnoMatriculaAluno); $intI++){ 
        for ($intJ = 0; $intJ < count($vetAuxTurma[$intI]); $intJ++){ 
            $vetAux = $vetAuxTurma[$intI][$intK];
            $query = mysqli_query($link, "SELECT serie FROM turmas WHERE id = $vetAux");
            while($turmas = mysqli_fetch_array($query)){
                $vetAuxSerie[$intI][$intZ] = $turmas['serie'];
                $intZ++;
            }
            $intK++; 
        }
    }

    //criando duas matrizes matriz, uma que associa o nome da disciplina com o ano e outra que associa a carga horaria da disciplina com o ano
    $intI = 0;
    $intJ = 0;
    $intK = 0;
    $intZ = 0;
    for ($intI = 0; $intI < count($vetAnoMatriculaAluno); $intI++){ 
        for ($intJ = 0; $intJ < count($vetIdDisciplinaAluno[$intI]); $intJ++){ 
            $vetAux = $vetIdDisciplinaAluno[$intI][$intK];
            $query = mysqli_query($link, "SELECT nome, cargaHorariaMin FROM disciplinas WHERE id = $vetAux");
            while($disciplinas = mysqli_fetch_array($query)){
                $vetNomeDisciplinaAluno[$intI][$intZ] = $disciplinas['nome'];
                $vetCargaHorariaDisciplinaAluno[$intI][$intZ] = $disciplinas['cargaHorariaMin'];
                $intZ++;
            }
            $intK++; 
        }
    }

    //pegando notas e faltas e colocando em um vetor (associa com a disciplina pois o indice do vetor corresponde ao indice da disiciplina na matriz $vetIdMatriculaAluno)
    $intI = 0;
    $intJ = 0;
    $intK = 0;
    $intZ = 0;
    $vetFaltasAluno[$intK] = 0;
    $vetTotalAulasAluno[$intK] = 0;
    $vetNotaAluno[$intK] = '0.0';
    for ($intI = 0; $intI < count($vetAnoMatriculaAluno); $intI++){ 
        for ($intJ = 0; $intJ < count($vetIdMatriculaAluno[$intI]); $intJ++){ 
            $vetAux = $vetIdMatriculaAluno[$intI][$intK];
            $query = mysqli_query($link, "SELECT faltas, nota FROM diarios WHERE idMatricula = $vetAux AND ano = $vetAnoMatriculaAluno[$intI]");
            while($diarios = mysqli_fetch_array($query)){
                $vetFaltasAluno[$intK] += $diarios['faltas'];
                $vetTotalAulasAluno[$intK] += 2; //cada linha dois horarios
                $vetNotaAluno[$intK] += $diarios['nota'];
                $intZ++;
            }
            $intK++; 
            $vetFaltasAluno[$intK] = 0;
            $vetTotalAulasAluno[$intK] = 0;
            $vetNotaAluno[$intK] = '0.0';
        }
    }

    //Achando a frequencia em porcentagem
    $intI = 0;
    $intJ = 0;
    $intK = 0;
    for ($intI = 0; $intI < count($vetAnoMatriculaAluno); $intI++){ 
        for ($intJ = 0; $intJ < count($vetIdMatriculaAluno[$intI]); $intJ++){ 
            $vetAux = $vetIdMatriculaAluno[$intI][$intK];
            //$vetPresencasAluno[$intK] = ($vetTotalAulasAluno[$intK] - $vetFaltasAluno[$intK]);
            $vetPorcentagemFrequenciaAluno[$intK] = (($vetFaltasAluno[$intK] * 50 * 100)/($vetCargaHorariaDisciplinaAluno[$intI][$intK] * 60));
            $vetPorcentagemFrequenciaAluno[$intK] = 100 - $vetPorcentagemFrequenciaAluno[$intK];
            $vetPorcentagemFrequenciaAluno[$intK] = round($vetPorcentagemFrequenciaAluno[$intK], 2);
            $intK++;
        }
    }

    //TESTES
    // echo "anos: ";
    // print_r($vetAnoMatriculaAluno);
    // echo "</br> ano => id's das matriculas: ";
    // print_r($vetIdMatriculaAluno); 
    // echo "<br><br>";

    // echo "nomes das disciplinas: ";
    // print_r($vetNomeDisciplinaAluno);
    // echo "</br> c.h. das disciplinas: ";
    // print_r($vetCargaHorariaDisciplinaAluno);
    // echo "</br><br>";

    // echo "notas das disciplinas: ";
    // print_r($vetNotaAluno);
    // echo "<br> faltas por disciplinas: ";
    // print_r($vetFaltasAluno);
    // echo "</br> freq.%: ";
    // print_r($vetPorcentagemFrequenciaAluno);
    // echo "</br>";
?>
<html>
    <body>
        <div style='padding-top: 35px; padding-bottom: 0px;'>
            <div style='margin-left: 120px; float: left;'>
                <h5><label style='color: #164c87; font-weight:bold;'>Nome:</label><?php echo " ".$strNomeAluno ?></h5>
                <h5><label style='color: #164c87; font-weight:bold;'>Curso:</label><?php echo " ".$strNomeCursoAluno ?></h5>
            </div>
            <div style='margin-left: 270px; float: left;'>
                <h5><label style='color: #164c87; font-weight:bold;'>CPF:</label><?php echo " ".$intIdCpfAluno ?></h5>
                <h5><label style='color: #164c87; font-weight:bold;'>Modalidade:</label><?php echo " ".$strModalidadeCursoAluno ?></h5>
            </div>
            <div style='margin-left: 1020px;'>
                <h5><label style='color: #164c87; font-weight:bold;'>Nascimento:</label><?php echo " ".$strNascimentoAluno ?></h5>
                <h5><label style='color: #164c87; font-weight:bold;'>Sexo:</label><?php echo " ".$strSexoAluno ?></h5>     
            </div>
        </div>
    </body>

<!--  TABELA -->
<!--  Deve ser gerada por ano/série -->
<!-- Função strtoupper retorna string com todos os caracteres do alfabeto convertidos para maiúsculas. -->
<?php
   $intI = 0;
   $intJ = 0;
   $intK = 0;
   for ($intI = 0; $intI < count($vetAnoMatriculaAluno); $intI++){
        echo "
        <div class='container' style='margin-top: 30px;'>
            <div class='panel panel-primary'>
                <div class='panel-heading'>
                    <h3 class='panel-title'>".$vetAuxSerie[$intI][$intJ]."a S&EacuteRIE - ".strtoupper($strNomeCursoAluno)."</h3>";
                    $intJ += count($vetAuxSerie[$intI]);
                echo "    
                </div>
                <table class='table'>
                    <thead>
                        <tr>
                            <th style='color: black; font-weight:bold;'>&nbsp;Ano</th>
                            <th style='color: black; font-weight:bold;'>Disciplina</th>
                            <th style='color: black; font-weight:bold;'>Nota</th>
                            <th style='color: black; font-weight:bold;'>C.H.</th>
                            <th style='color: black; font-weight:bold;'>Freq.%</th>
                        </tr>
                    </thead>
                    <tbody>";
                            $intZ = 0;
                            for($intZ = 0; $intZ < count($vetNomeDisciplinaAluno[$intI]); $intZ++){
                                echo "
                                <tr>
                                    <td>&nbsp;".$vetAnoMatriculaAluno[$intI]."</td>
                                    <td>".$vetNomeDisciplinaAluno[$intI][$intK]."</td>";
                                    if(isset($vetNotaAluno[$intK])){
                                        echo "<td>".$vetNotaAluno[$intK]."</td>";
                                    } else {
                                        echo "<td>0.0</td>";
                                    }
                                    echo "
                                    <td>".$vetCargaHorariaDisciplinaAluno[$intI][$intK]."</td>";
                                    if(isset($vetPorcentagemFrequenciaAluno[$intK])){
                                        echo "<td>".$vetPorcentagemFrequenciaAluno[$intK]."<td>";
                                    } else {
                                        echo "<td>0</td>";
                                    }
                                echo "
                                </tr>
                                ";
                                $intK++;
                            }
                    echo "
                    </tbody>
                </table>
            </div>
        </div>
        ";
    }
?>
    <div class='row'>
        <div style='float: left;'>
            <button style='margin-top: 10px; margin-left: 800px;' type='button' class='btn btn-info btn-round' onClick='voltarParaPaginaSelecionarCampi()'>Voltar para o in&iacutecio</button>  
        </div>
        <div style='float: left;''>
            <button style='margin-top: 10px; margin-left: 20px;' type='button' class='btn btn-info btn-round' onClick='irParaPaginaDownloadHistorico()'>Download do Hist&oacuterico em PDF</button>  
        </div>
    </div>
    <br><br>
    <?php require "../../../Menu-Rodape-Secundarios/caso-1/gerencia-web-rodape.php"; ?>
</html>

