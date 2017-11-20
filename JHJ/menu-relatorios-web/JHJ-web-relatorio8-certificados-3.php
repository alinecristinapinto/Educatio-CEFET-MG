<?php
	session_start();
    //pega opção do botão (mostrar na tela ou fazer download)
    $strOpcaoEscolhida = $_SESSION['opcaoEscolhida'];
    
	switch ($strOpcaoEscolhida) {
		case 'mostrarNaTela':
			header ('Content-type: text/html; charset=ISO-8859-1');
		    // Conectando com o servidor MySQL
			$link = mysqli_connect("localhost", "root", "");
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
	    				<link href='css/JHJ-web-estilos-relatorio8-certificados.css' rel='stylesheet'/> 
					</head>
					<body>
						<div id='certificado'>
							<h1>Certificado de Conclus&atildeo</h1>
							<p>Certifico que <b>".$strNomeAluno."</b></p>";
							if(strcmp($strModalidadeCursoAluno, 'Técnico Integrado') == 1 && strcmp($strModalidadeCursoAluno, 'Graduação') == 1) { 
								echo "
								<p>concluiu com sucesso o</p>
								<p><b>".$strModalidadeCursoAluno." em ".$strNomeCursoAluno."</b></p>
								<p>realizado de ".min($vetAnosMatriculadoAluno)." a ".max($vetAnosMatriculadoAluno)."</p>";
							}
							if(strcmp($strModalidadeCursoAluno, 'Graduação') == 1 && strcmp($strModalidadeCursoAluno, 'Técnico Integrado') == -1) { 
								echo "
								<p>concluiu com sucesso a</p>
								<p><b>".$strModalidadeCursoAluno." em ".$strNomeCursoAluno."</b></p>
								<p>realizada de ".min($vetAnosMatriculadoAluno)." a ".max($vetAnosMatriculadoAluno)."</p>";
							}
							echo"
							<hr></hr>
							<p style='font-size: 25px; margin-top:10px;'>".$strCoordenadorCursoAluno.", coordenador(a) do curso</p>
						</div>
					</body>
				</html>
			";
		break;
		case 'fazerDownload':
			header("Location:JHJ-web-relatorio8-certificados-4.php");
		break;
	} // fim do switch
?>