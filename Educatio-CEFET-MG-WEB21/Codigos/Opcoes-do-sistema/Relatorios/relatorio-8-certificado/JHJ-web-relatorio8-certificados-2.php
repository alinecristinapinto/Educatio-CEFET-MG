<?php
	function verificaConclusaoDeCurso() {
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

		//PRIMEIRAMENTE VERIFICA SE O ALUNO É DO TECNICO OU DA GRADUAÇÃO
					
		//Pegando idTurma
		$query = mysqli_query($link, "SELECT idTurma FROM alunos WHERE idCPF = '$intIdCpfAluno'");
		$alunos = mysqli_fetch_array($query);
		$intIdTurmaAluno = $alunos['idTurma'];  

		//Pegando IdCurso do curso do aluno
		$query = mysqli_query($link, "SELECT idCurso FROM turmas WHERE id = $intIdTurmaAluno");
		$turmas = mysqli_fetch_array($query);
		$intIdCursoAluno = $turmas['idCurso'];  

		//Pegando modalidade do curso do aluno
		$query = mysqli_query($link, "SELECT modalidade FROM cursos WHERE id = $intIdCursoAluno");
		$cursos = mysqli_fetch_array($query);
		$strModalidadeCursoAluno = $cursos['modalidade']; 

		if(strcmp($strModalidadeCursoAluno, 'Técnico Integrado') == 1 && strcmp($strModalidadeCursoAluno, 'Graduação') == 1){
			//ALUNO É DO TECNICO
			//VERIFICA SE ESTA NO 3º ANO

			//Pegando serie da turma do aluno
			$query = mysqli_query($link, "SELECT serie FROM turmas WHERE id = $intIdTurmaAluno");
			$turmas = mysqli_fetch_array($query);
			$intSerieTurmaAluno = $turmas['serie'];

			if($intSerieTurmaAluno != 3){
				return false;

			}else if($intSerieTurmaAluno == 3){
				//VERIFICA SE O ALUNO ESTA COM 60 OU MAIS EM TODAS AS DISCIPLINAS

				//pegando anos em que o aluno esteve matriculado 
				$query = mysqli_query($link, "SELECT ano FROM matriculas WHERE idAluno = '$intIdCpfAluno'");
		        $intI = 0;
		        while($matriculas = mysqli_fetch_array($query)){
		            $vetAnosMatriculadoAluno[$intI] = $matriculas['ano'];
		            $intI++;
		        }
		        $intAnoAluno = max($vetAnosMatriculadoAluno);

				//criando vetor com o id de todas as disciplinas por meio da matricula (usando idAluno e ano) 
				$query = mysqli_query($link, "SELECT idDisciplina FROM matriculas WHERE idAluno = '$intIdCpfAluno' and ano = $intAnoAluno");
		        $intI = 0;
		        while($matriculas = mysqli_fetch_array($query)){
		            $vetIdDisciplinaAluno[$intI] = $matriculas['idDisciplina'];
		            $intI++;
		        }

		        //criando uma matriz que asssocia o id da disciplina com os ids dos seus conteudos por meio do vetor $vetIdDisciplinaAluno
		        $intI = 0;
		        $intJ = 0;
		        for ($intI = 0; $intI < count($vetIdDisciplinaAluno); $intI++){
			        $query = mysqli_query($link, "SELECT id FROM conteudos WHERE idDisciplina = $vetIdDisciplinaAluno[$intI]");
			        while($conteudos = mysqli_fetch_array($query)){
			            $vetIdConteudoAluno[$intI][$intJ] = $conteudos['id'];
			            $intJ++;
			        }
			    }

			    //criando um vetor com os IdsMatricula do aluno
			    $intI = 0;
				$query = mysqli_query($link, "SELECT id FROM matriculas WHERE idAluno = '$intIdCpfAluno' AND ano = $intAnoAluno");
				while($matriculas = mysqli_fetch_array($query)){
					$vetIdMatriculaAluno[$intI] = $matriculas['id'];
					$intI++;
				}  

			    //zerando matriz que sera usada no prox select
			    $intI = 0;
		        $intJ = 0;
		        $intK = 0;
		        for ($intI = 0; $intI < count($vetIdDisciplinaAluno); $intI++){
		        	if(isset($vetIdConteudoAluno[$intI])){
			        	for($intJ = 0; $intJ < count($vetIdConteudoAluno[$intI]); $intJ++){
			        		$vetNotaConteudoAluno[$intI][$intK] = 0;
					        $intK++;
					    }
					}
				}
				
			   	//preenchendo matriz que associa o id da disciplina com as notas dos seus conteudos por por meio da matriz $vetIdConteudoAluno
			   	$intI = 0;
		        $intJ = 0;
		        $intK = 0;
		        $intZ = 0;
		        for ($intI = 0; $intI < count($vetIdDisciplinaAluno); $intI++){
		        	if(isset($vetIdConteudoAluno[$intI])){
			        	for($intJ = 0; $intJ < count($vetIdConteudoAluno[$intI]); $intJ++){
			        		$vetAux = $vetIdConteudoAluno[$intI][$intK];

			        		for($intZ = 0; $intZ < count($vetIdMatriculaAluno); $intZ++){ //loop necessario para pegar a nota independente do id da matricula
						        $query = mysqli_query($link, "SELECT nota FROM diarios WHERE idConteudo = $vetAux AND idMatricula = $vetIdMatriculaAluno[$intZ] AND ano = $intAnoAluno");
						        while($diarios = mysqli_fetch_array($query)){
						            $vetNotaConteudoAluno[$intI][$intK] += $diarios['nota'];
						        }
						    }

						    $intK++; //necessario devido ao formato da matriz, o indice K em [I][K] é continuo  
					    }
					}
				}

				//somando as notas dos conteudos de cada uma das materias para obter a nota total por meio do vetor $vetNotaConteudoAluno
				$intI = 0;
				for ($intI = 0; $intI < count($vetIdDisciplinaAluno); $intI++){
					if(isset($vetNotaConteudoAluno[$intI])){
						$vetNotaTotalAluno[$intI] = array_sum($vetNotaConteudoAluno[$intI]);
					}
				}

				//TESTES
				// echo $intAnoAluno."<br> matriculas: ";
				// print_r($vetIdMatriculaAluno);
				// echo "<br> disciplinas: ";
				// print_r($vetIdDisciplinaAluno);  
				// echo "<br> conteudo: ";
				// print_r($vetIdConteudoAluno);
				// echo "<br> nota por conteudo: ";
				// print_r($vetNotaConteudoAluno);
				// echo "<br> nota total por disciplina: ";
				// print_r($vetNotaTotalAluno);
				// echo "<br><br>";

				$intI = 0;
				$flagNotaInsuficiente = 0;
				$intI = 0;
				for ($intI = 0; $intI < count($vetIdDisciplinaAluno); $intI++){
					if(isset($vetNotaTotalAluno[$intI])){
						if($vetNotaTotalAluno[$intI] < 60){
							$flagNotaInsuficiente++;
						}
					}
				}

				if($flagNotaInsuficiente != 0){
					//ALUNO NAO ESTA COM MAIS DE 60 EM TODAS AS DISCIPLINAS
					return false;
				} else if($flagNotaInsuficiente == 0){
					//ALUNO ESTA COM MAIS DE 60 EM TODAS AS DISCIPLINAS
					//VERIFICA A FREQUENCIA 

					$intI = 0;
					$intFaltaTotalAluno = 0;
					$intQuantidadeTotalAulas = 0;
	        		for($intI = 0; $intI < count($vetIdMatriculaAluno); $intI++){ //loop necessario para pegar as faltas independente do id da matricula
				        $query = mysqli_query($link, "SELECT faltas FROM diarios WHERE idMatricula = $vetIdMatriculaAluno[$intI] AND ano = $intAnoAluno");
				        while($diarios = mysqli_fetch_array($query)){
				            $intFaltaTotalAluno += $diarios['faltas'];
				            $intQuantidadeTotalAulas++;
				        }
				    }
				    //Multiplica por dois pois são dois horários
				    $intQuantidadeTotalAulas = $intQuantidadeTotalAulas * 2;
				    $intFrequenciaAluno = $intFaltaTotalAluno / $intQuantidadeTotalAulas;

				    //TESTES
					// echo $intFaltaTotalAluno."<br>";
				 	// echo $intQuantidadeTotalAulas."<br>";
				 	// echo $intFrequenciaAluno."<br>";
				    
				    if($intFrequenciaAluno > 0.25){
				    	//bomba por falta global, faltou mais que 0.25
				    	return false;
				    } if($intFrequenciaAluno <= 0.25){
				    	//frequencia global ok, faltou 0.25 ou menos
				    	//verifica se as matriculas do ano estão desativadas para ter certeza que passou de ano

				    	$intI = 0;
						$intMatriculasAtivadas = 0;
		        		for($intI = 0; $intI < count($vetIdMatriculaAluno); $intI++){ //loop necessario para pegar as faltas independente do id da matricula
					        $query = mysqli_query($link, "SELECT ativo FROM matriculas WHERE id = $vetIdMatriculaAluno[$intI]");
					        while($matriculas = mysqli_fetch_array($query)){
					        	if($matriculas['ativo'] == 'S'){
					        		$intMatriculasAtivadas++;
					        	}
					        }
					    }
					    if($intMatriculasAtivadas != 0){
					    	return false;
					    } else if ($intMatriculasAtivadas == 0){
					    	return true;
					    }
				    } 

				}
			}

		} else if (strcmp($strModalidadeCursoAluno, 'Graduação') == 1 && strcmp($strModalidadeCursoAluno, 'Técnico Integrado') == -1) {
			//ALUNO É DA GRADUAÇÃO
			//VERIFICA SE ESTA NO 10º PERIODO 

			//Pegando serie da turma do aluno
			$query = mysqli_query($link, "SELECT serie FROM turmas WHERE id = $intIdTurmaAluno");
			$turmas = mysqli_fetch_array($query);
			$intSerieTurmaAluno = $turmas['serie'];

			if($intSerieTurmaAluno != 10){
				return false;
				
			} else if($intSerieTurmaAluno == 10){
				//VERIFICA SE O ALUNO ESTA COM 70 OU MAIS EM TODAS AS DISCIPLINAS

				//pegando anos em que o aluno esteve matriculado 
				$query = mysqli_query($link, "SELECT ano FROM matriculas WHERE idAluno = '$intIdCpfAluno'");
		        $intI = 0;
		        while($matriculas = mysqli_fetch_array($query)){
		            $vetAnosMatriculadoAluno[$intI] = $matriculas['ano'];
		            $intI++;
		        }
		        $intAnoAluno = max($vetAnosMatriculadoAluno);

				//criando vetor com o id de todas as disciplinas por meio da matricula (usando idAluno e ano) - usando matricula ao invés de turma para tratar casos da graduação, onde existe dependência 
				$query = mysqli_query($link, "SELECT idDisciplina FROM matriculas WHERE idAluno = '$intIdCpfAluno' and ano = $intAnoAluno");
		        $intI = 0;
		        while($matriculas = mysqli_fetch_array($query)){
		            $vetIdDisciplinaAluno[$intI] = $matriculas['idDisciplina'];
		            $intI++;
		        }

		        //criando uma matriz que asssocia o id da disciplina com os ids dos seus conteudos por meio do vetor $vetIdDisciplinaAluno 
		        $intI = 0;
		        $intJ = 0;
		        for ($intI = 0; $intI < count($vetIdDisciplinaAluno); $intI++){
			        $query = mysqli_query($link, "SELECT id FROM conteudos WHERE idDisciplina = $vetIdDisciplinaAluno[$intI]");
			        while($conteudos = mysqli_fetch_array($query)){
			            $vetIdConteudoAluno[$intI][$intJ] = $conteudos['id'];
			            $intJ++;
			        }
			    }

			    //criando um vetor com os IdsMatricula do aluno
			    $intI = 0;
				$query = mysqli_query($link, "SELECT id FROM matriculas WHERE idAluno = '$intIdCpfAluno' AND ano = $intAnoAluno");
				while($matriculas = mysqli_fetch_array($query)){
					$vetIdMatriculaAluno[$intI] = $matriculas['id'];
					$intI++;
				}  

			    //zerando matriz que sera usada no prox select
			    $intI = 0;
		        $intJ = 0;
		        $intK = 0;
		        for ($intI = 0; $intI < count($vetIdDisciplinaAluno); $intI++){
		        	if(isset($vetIdConteudoAluno[$intI])){
			        	for($intJ = 0; $intJ < count($vetIdConteudoAluno[$intI]); $intJ++){
			        		$vetNotaConteudoAluno[$intI][$intK] = 0;
					        $intK++;
					    }
					}
				}
				
			   	//preenchendo matriz que associa o id da disciplina com as notas dos seus conteudos por por meio da matriz $vetIdConteudoAluno
			   	$intI = 0;
		        $intJ = 0;
		        $intK = 0;
		        $intZ = 0;
		        for ($intI = 0; $intI < count($vetIdDisciplinaAluno); $intI++){
		        	if(isset($vetIdConteudoAluno[$intI])){
			        	for($intJ = 0; $intJ < count($vetIdConteudoAluno[$intI]); $intJ++){
			        		$vetAux = $vetIdConteudoAluno[$intI][$intK];

			        		for($intZ = 0; $intZ < count($vetIdMatriculaAluno); $intZ++){ //loop necessario para pegar a nota independente do id da matricula
						        $query = mysqli_query($link, "SELECT nota FROM diarios WHERE idConteudo = $vetAux AND idMatricula = $vetIdMatriculaAluno[$intZ] AND ano = $intAnoAluno");
						        while($diarios = mysqli_fetch_array($query)){
						            $vetNotaConteudoAluno[$intI][$intK] += $diarios['nota'];
						        }
						    }

						    $intK++; //necessario devido ao formato da matriz, o indice K em [I][K] é continuo  
					    }
					}
				}

				//somando as notas dos conteudos de cada uma das materias para obter a nota total por meio do vetor $vetNotaConteudoAluno
				$intI = 0;
				for ($intI = 0; $intI < count($vetIdDisciplinaAluno); $intI++){
					if(isset($vetNotaConteudoAluno[$intI])){
						$vetNotaTotalAluno[$intI] = array_sum($vetNotaConteudoAluno[$intI]);
					}
				}

				//TESTES
				// echo $intAnoAluno."<br> matriculas: ";
				// print_r($vetIdMatriculaAluno);
				// echo "<br> disciplinas: ";
				// print_r($vetIdDisciplinaAluno);  
				// echo "<br> conteudo: ";
				// print_r($vetIdConteudoAluno);
				// echo "<br> nota por conteudo: ";
				// print_r($vetNotaConteudoAluno);
				// echo "<br> nota total por disciplina: ";
				// print_r($vetNotaTotalAluno);
				// echo "<br><br>";

				$intI = 0;
				$flagNotaInsuficiente = 0;
				$intI = 0;
				for ($intI = 0; $intI < count($vetIdDisciplinaAluno); $intI++){
					if(isset($vetNotaTotalAluno[$intI])){
						if($vetNotaTotalAluno[$intI] < 70){
							$flagNotaInsuficiente++;
						}
					}
				}

				if($flagNotaInsuficiente != 0){
					//ALUNO NAO ESTA COM MAIS DE 70 EM TODAS AS DISCIPLINAS
					return false;
				} else if($flagNotaInsuficiente == 0){
					//ALUNO ESTA COM MAIS DE 70 EM TODAS AS DISCIPLINAS
					//VERIFICA A FREQUENCIA 

					$intI = 0;
					$intFaltaTotalAluno = 0;
					$intQuantidadeTotalAulas = 0;
	        		for($intI = 0; $intI < count($vetIdMatriculaAluno); $intI++){ //loop necessario para pegar as faltas independente do id da matricula
				        $query = mysqli_query($link, "SELECT faltas FROM diarios WHERE idMatricula = $vetIdMatriculaAluno[$intI] AND ano = $intAnoAluno");
				        while($diarios = mysqli_fetch_array($query)){
				            $intFaltaTotalAluno += $diarios['faltas'];
				            $intQuantidadeTotalAulas++;
				        }
				    }
				    //Multiplica por dois pois são dois horários
				    $intQuantidadeTotalAulas = $intQuantidadeTotalAulas * 2;
				    $intFrequenciaAluno = $intFaltaTotalAluno / $intQuantidadeTotalAulas;

				    //TESTES
					// echo $intFaltaTotalAluno."<br>";
				 	// echo $intQuantidadeTotalAulas."<br>";
				 	// echo $intFrequenciaAluno."<br>";
				    
				    if($intFrequenciaAluno > 0.25){
				    	//bomba por falta global, faltou mais que 0.25
				    	return false;
				    } if($intFrequenciaAluno <= 0.25){
				    	//frequencia global ok, faltou 0.25 ou menos
				    	//verifica se as matriculas do ano estão desativadas para ter certeza que passou de ano

				    	$intI = 0;
						$intMatriculasAtivadas = 0;
		        		for($intI = 0; $intI < count($vetIdMatriculaAluno); $intI++){ //loop necessario para pegar as faltas independente do id da matricula
					        $query = mysqli_query($link, "SELECT ativo FROM matriculas WHERE id = $vetIdMatriculaAluno[$intI]");
					        while($matriculas = mysqli_fetch_array($query)){
					        	if($matriculas['ativo'] == 'S'){
					        		$intMatriculasAtivadas++;
					        	}
					        }
					    }
					    if($intMatriculasAtivadas != 0){
					    	return false;
					    } else if ($intMatriculasAtivadas == 0){
					    	return true;
					    }
				    }

				}

			}  

		}
	} //fim da função
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
	    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	    <meta name="viewport" content="width=device-width" />

	</head>
	<body>
		<?php	
		    //LINHA PARA TESTE
		    //echo "<script>location.href = '../Opcoes-do-sistema/relatorio-8-certificado/JHJ-web-relatorio8-certificados-3.php?';</script>";

			if(verificaConclusaoDeCurso()){
		?>
			<!-- <p style="margin-top: 5px; margin-left: 5px; color: black;">O certificado está sendo gerado...</p> -->
			<script language="javascript" type="text/javascript"> 
				function irParaPaginaCertificado(){
					location.href = "../Opcoes-do-sistema/Relatorios/relatorio-8-certificado/JHJ-web-relatorio8-certificados-3.php?";
				}
				irParaPaginaCertificado(); 
			</script>
		<?php 
			} else if(!verificaConclusaoDeCurso()){
		?>    
			<script type="text/javascript">
				$(document).ready(function() {
		    		$('#alertaMostrarNaTela').modal('show');
				});
				function voltarParaPaginaInicial(){
					location.href = "gerencia-web-interface-aluno-academico.php?acao=default";
				}
			</script>
			<div class="modal fade" id="alertaMostrarNaTela" tabindex="-1" role="dialog">
		    <div class="modal-dialog" role="document">
		        <div class="modal-content">
		            <div class="modal-header">
		                <h5 class="modal-title text-center">O certificado não pode ser mostrado!</h5>
		                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		                    <span aria-hidden="true">&times;</span>
		                </button>
		            </div>
		            <div class="modal-body"><center>Você ainda não concluiu o seu curso.</center></div>
		            <div class="modal-footer">
		                <div>
		                    <button type="button" class="btn btn-success btn-link" data-dismiss="modal" onclick="voltarParaPaginaInicial()">Entendi</button></a>
		                </div>
		            </div>
		        </div>
		    </div>
			</div>
		<?php
			}
		?>
	</body>
</html>