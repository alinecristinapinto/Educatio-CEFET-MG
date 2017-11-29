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

    //IdCPF do aluno sendo pego por meio de SESSION
    $intIdCpfAluno = $_SESSION['intCpfAluno'];

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

// TABELA
// Deve ser gerada por ano/série 
// Função strtoupper retorna string com todos os caracteres do alfabeto convertidos para maiúscula

$html = "
<html>
    <div>
        <div id='cabecalho1'>
            <h3>Nome: ".$strNomeAluno."</h3>
            <h3>Curso: ".$strNomeCursoAluno."</h3>
        </div>
        <div id='cabecalho2'>
            <h3>CPF: ".$intIdCpfAluno."</h3>
            <h3>Modalidade: ".$strModalidadeCursoAluno."</h3>
        </div>
        <div id='cabecalho3'>
            <h3>Nascimento: ".$strNascimentoAluno."</h3>
            <h3>Sexo: ".$strSexoAluno."</h3>     
        </div>";

   $intI = 0;
   $intJ = 0;
   $intK = 0;
   for ($intI = 0; $intI < count($vetAnoMatriculaAluno); $intI++){
        $html .= "
        	<table class='tabela'>
        		 <tr>
            		<th id='tituloTabela' colspan='5'><h2>".$vetAuxSerie[$intI][$intJ]."a S&Eacute;RIE - ".strtoupper($strNomeCursoAluno)."</h2></th>
            	</tr>";
                $intJ += count($vetAuxSerie[$intI]);

                $html .= " 
                <tr>
                    <th id='subtituloTabela'>&nbsp;&nbsp;&nbsp;&nbsp;Ano</th>
                    <th id='subtituloTabela'>Disciplina</th>
                    <th id='subtituloTabela'>Nota</th>
                    <th id='subtituloTabela'>C.H.</th>
                    <th id='subtituloTabela'>Freq.%</th>
                </tr>";
                   
                $intZ = 0;
                for($intZ = 0; $intZ < count($vetNomeDisciplinaAluno[$intI]); $intZ++){
                    $html .= " 
                    <tr>
                        <td>&nbsp;&nbsp;&nbsp;&nbsp;".$vetAnoMatriculaAluno[$intI]."</td>
                        <td>".$vetNomeDisciplinaAluno[$intI][$intK]."</td>";
                        if(isset($vetNotaAluno[$intK])){
                            $html .= "<td>".$vetNotaAluno[$intK]."</td>";
                        } else {
                            $html .= "<td>0.0</td>";
                        }
                        $html .= "
                        <td>".$vetCargaHorariaDisciplinaAluno[$intI][$intK]."</td>";
                        if(isset($vetPorcentagemFrequenciaAluno[$intK])){
                            $html .= "<td>".$vetPorcentagemFrequenciaAluno[$intK]."<td>";
                        } else {
                            $html .= "<td>0</td>";
                        }
                    $html .= " 
                    </tr>
                    ";
                    $intK++;
                }
        		$html .= "
    		</table>
    		<div id='espacamentoTabelas'>
    		</div>";
   	}
   	$html .= "
   	</body>
</html>";

    $mpdf = new mPDF('utf-8', 'A4-P'); // P - Retrato (DEFAULT) e L - Paisagem
	$mpdf->SetDisplayMode('fullpage');
	$css = file_get_contents("JHJ-web-estilos-relatorio7-tabela-download.css");
	$html = mb_convert_encoding($html, 'UTF-8', 'ISO-8859-1'); //evita o erro HTML contains invalid UTF-8 character(s) devido a acentuação no BD
	$mpdf->WriteHTML($css,1);
	$mpdf->WriteHTML($html);
	$mpdf->Output();
	$mpdf->charset_in='windows-1252';
	exit;
?>