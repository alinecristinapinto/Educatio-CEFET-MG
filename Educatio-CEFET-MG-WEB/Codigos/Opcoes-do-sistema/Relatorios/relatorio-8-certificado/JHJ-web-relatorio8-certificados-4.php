<?php
    session_start();

	include("../../../../Estaticos/mpdf60/mpdf.php");

	 $usuario = $_SESSION['usuario'];

  	echo "<script> 
          if(window.sessionStorage.getItem('logado') == 'N') 
            location.href = '../../../Login/gerencia-web-login.html'; 
        </script>";

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

	//IdCPF do aluno sera pego por meio de SESSION 
	//inf, mei, graduacao
	$intIdCpfAluno = 70264415400;
	// $intIdCpfAluno = 89594318180;
	// $intIdCpfAluno = 86312366243;

	//Pegando idTurma e nome do aluno
	$query = mysqli_query($link, "SELECT idTurma, nome FROM alunos WHERE idCPF = '$intIdCpfAluno'");
	$alunos = mysqli_fetch_array($query);
	$intIdTurmaAluno = $alunos['idTurma'];  
	$strNomeAluno = $alunos['nome'];

	//Pegando IdCurso do curso do aluno
	$query = mysqli_query($link, "SELECT idCurso FROM turmas WHERE id = $intIdTurmaAluno");
	$turmas = mysqli_fetch_array($query);
	$intIdCursoAluno = $turmas['idCurso'];  

	//Pegando nome e modalidade do curso do aluno
	$query = mysqli_query($link, "SELECT idDepto, nome, modalidade FROM cursos WHERE id = $intIdCursoAluno");
	$cursos = mysqli_fetch_array($query);
	$intIdDeptoCursoAluno = $cursos['idDepto'];
	$strNomeCursoAluno = $cursos['nome'];
	$strModalidadeCursoAluno = $cursos['modalidade']; 

	//Pegando nome do coordenador do curso do aluno
	$query = mysqli_query($link, "SELECT nome FROM funcionario WHERE idDepto = $intIdDeptoCursoAluno AND hierarquia = 'Coordenador'");
	$funcionario = mysqli_fetch_array($query);
	$strCoordenadorCursoAluno = $funcionario['nome'];

	//Pegando anos em que o aluno esteve matriculado 
	$query = mysqli_query($link, "SELECT ano FROM matriculas WHERE idAluno = '$intIdCpfAluno'");
    $intI = 0;
    while($matriculas = mysqli_fetch_array($query)){
        $vetAnosMatriculadoAluno[$intI] = $matriculas['ano'];
        $intI++;
    }

	echo "
		<!DOCTYPE html>
		<html>
			<head>
				<title>Certificado</title>
				<!-- CSS do grupo -->
				<link href='JHJ-web-estilos-relatorio8-certificados.css' rel='stylesheet'/> 
			</head>
		</html>";

	if(strcmp($strModalidadeCursoAluno, 'Técnico Integrado') == 1 && strcmp($strModalidadeCursoAluno, 'Graduação') == 1) { 
		$html = "
			<div id='certificado'>
				<h1>Certificado de Conclusao</h1>
				<p id='textoConteudo'>Certifico que <b>".$strNomeAluno."</b></p>
				<p id='textoConteudo'>concluiu com sucesso o</p>
				<p id='textoConteudo'><b>".$strModalidadeCursoAluno." em ".$strNomeCursoAluno."</b></p>
				<p id='textoConteudo'>realizado de ".min($vetAnosMatriculadoAluno)." a ".max($vetAnosMatriculadoAluno)."</p>
				<div id='assinatura'>
					<hr></hr>
					<p id='textoAssinatura'>".$strCoordenadorCursoAluno.", coordenador(a) do curso</p>
				</div>
			</div>";
	}

	if(strcmp($strModalidadeCursoAluno, 'Graduação') == 1 && strcmp($strModalidadeCursoAluno, 'Técnico Integrado') == -1) { 
		$html = "
			<div id='certificado'>
				<h1>Certificado de Conclusao</h1>
				<p id='textoConteudo'>Certifico que <b>".$strNomeAluno."</b></p>
				<p id='textoConteudo'>concluiu com sucesso a</p>
				<p id='textoConteudo'><b>".$strModalidadeCursoAluno." em ".$strNomeCursoAluno."</b></p>
				<p id='textoConteudo'>realizada de ".min($vetAnosMatriculadoAluno)." a ".max($vetAnosMatriculadoAluno)."</p>
				<div id='assinatura'>
					<hr></hr>
					<p id='textoAssinatura'>".$strCoordenadorCursoAluno.", coordenador(a) do curso</p>
				</div>
			</div>";
	}
		
	$mpdf = new mPDF('utf-8', 'A4-L'); // P - Retrato (DEFAULT) e L - Paisagem
	$mpdf->SetDisplayMode('fullpage');
	$css = file_get_contents("JHJ-web-estilos-relatorio8-certificados-download.css");
	$html = mb_convert_encoding($html, 'UTF-8', 'ISO-8859-1'); //evita o erro HTML contains invalid UTF-8 character(s) devido a acentuação no BD
	$mpdf->WriteHTML($css,1);
	$mpdf->WriteHTML($html);
	$mpdf->Output();
	$mpdf->charset_in='windows-1252';
	exit;
?>