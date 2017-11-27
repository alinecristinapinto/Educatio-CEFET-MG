<?php
	session_start();
	include("../../../../Estaticos/mpdf60/mpdf.php");
	header ('Content-type: text/html; charset=ISO-8859-1'); 

    // Conectando com o servidor MySQL
    $link = mysqli_connect("localhost", "root", "usbw");
    if (!$link){
    //     die("Conexao falhou: ".mysqli_connect_error()."<br/>");
    } else {
    //     echo "Conexao efetuada com sucesso!<br/>";
    }
    //Selecionado BD
    $sql = mysqli_select_db($link, 'Educatio');
    
    //Pega id do curso que foi selecionado por meio de SESSION
    $intIdCurso = $_SESSION['intIdCurso'];

    //Pega dados do curso que foi selecionado
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
        
        //ORGANIZANDO DADOS PARA EXIBIÇÃO NA TABELA 
        //Ordenando array para os nomes ficarem em ordem alfabetica na tabela
        //OBS: função sort ordena um array. os elementos serão ordenados do menor para o maior ao final da execução dessa função.
        sort($vetNomeProfessores);

        //Crindo vetor que armazena o idSIAPE na mesma posição que está o nome em $vetNomeProfessores
        //Por ex, se Vivas está em $vetNomeProfessores[20], seu idSIAPE estará em $vetAuxIdSiapeProfessores[20]
        $intI = 0;
        for ($intI = 0; $intI < count($vetNomeProfessores); $intI++){
            $query = mysqli_query($link, " SELECT idSIAPE FROM funcionario WHERE nome = '$vetNomeProfessores[$intI]' AND ativo='S' ");
            while($funcionario = mysqli_fetch_array($query)){
                $vetAuxIdSiapeProfessores[$intI] = $funcionario['idSIAPE'];
            }
        }

        //Criando matriz[i][j] que armazena a posicao do idSIAPE do professor em [i] e o id da disciplina em [j]
        $intJ = 0;
        for ($intI = 0; $intI < count($vetAuxIdSiapeProfessores); $intI++){
            $query = mysqli_query($link, " SELECT idDisciplina FROM profdisciplinas WHERE idProfessor = $vetAuxIdSiapeProfessores[$intI] AND ativo='S' ");
            while($profdisciplinas = mysqli_fetch_array($query)){
                $vetAuxIdDisciplinas[$intI][$intJ] = $profdisciplinas['idDisciplina'];
                $intJ++;
            }
        }

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
    
        // TABELA ONDE SERÃO EXIBIDOS OS DADOS DO RELATORIO
        $html = "
        <!DOCTYPE html>
        <html>
            <table class='tabela'>
                <tr>
                	<th id='tituloTabela' colspan='3'><h2>Curso de ".$strNomeCursoSelecionado." - ".$strNomeDeptoCursoSelecionado."</h2></th>
                </tr>
               	<tr>
                    <th id='subtituloTabela'>&nbsp;&nbsp;&nbsp;&nbsp;Nome do Professor</th>
                    <th id='subtituloTabela'>Disciplinas</th>
                    <th id='subtituloTabela'>Horas de trabalho</th>
                </tr>";
                  
                //função array_sum calcula a soma dos elementos de um array
                $intJ = 0;
                for ($intI = 0; $intI < count($vetNomeProfessores); $intI++){
                    $html .= "
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;".$vetNomeProfessores[$intI]."</td>
                            <td>".$vetAuxNomeDisciplinas[$intI][$intJ]."</td>
                            <td>".$vetAuxCargaHorariaDisciplinas[$intI][$intJ]."</td>";
                            $intJ++;
                    $html .= "</tr>";
                    $intQuantidadeDisciplinas = count($vetAuxIdDisciplinas[$intI]);
                    for ($intK = 0; $intK < ($intQuantidadeDisciplinas-1); $intK++){
                        $html .= "
                        <tr>
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;".$vetNomeProfessores[$intI]."</td>
                            <td>".$vetAuxNomeDisciplinas[$intI][$intJ]."</td>
                            <td>".$vetAuxCargaHorariaDisciplinas[$intI][$intJ]."</td>
                        </tr>";
                        $intJ++;
                    }
                }

                $html .= "
     		</table>
        </html>"; 
    } // fim do if que verifica existencia do professor 
    $mpdf = new mPDF('utf-8', 'A4-P'); // P - Retrato (DEFAULT) e L - Paisagem
	$mpdf->SetDisplayMode('fullpage');
	$css = file_get_contents("JHJ-web-estilos-relatorio9-tabela-download.css");
	$html = mb_convert_encoding($html, 'UTF-8', 'ISO-8859-1'); //evita o erro HTML contains invalid UTF-8 character(s) devido a acentuação no BD
	$mpdf->WriteHTML($css,1);
	$mpdf->WriteHTML($html);
	$mpdf->Output();
	$mpdf->charset_in='windows-1252';
	exit;
?>