<!DOCTYPE html>

<!-- CSS do Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet" />
<link href="css/bootstrap.css" rel="stylesheet"/>

<!-- CSS do grupo -->
 <link href="" rel="stylesheet" />

<!-- Arquivos js -->
<script src="js/popper.js"></script>
<script src="js/jquery-3.2.1.js" type="text/javascript"></script>
<script src="js/bootstrap.min.js" type="text/javascript"></script>

<!-- Fontes e icones -->
<link href="css/nucleo-icons.css" rel="stylesheet">

<style type="text/css">
  .text-center{
       font-family: 'Abel', sans-serif;
       color: #d8ac29;
    }
    .fonteTexto{
       font-family: 'Inconsolata', monospace;
       font-size: 16px;
    }
    .btn-info {
      background-color: #162e87;
      border-color: #162e87;
      color: #FFFFFF;
      opacity: 1;
      filter: alpha(opacity=100);
     }

   .btn-info:hover, .btn-info:focus, .btn-info:active, .btn-info.active, .show > .btn-info.dropdown-toggle {
      background-color: #11277a;
      color: #FFFFFF;
      border-color: #11277a;
    }
</style>

<html>
<head>
	<title></title>
</head>
<body>
<?php

	header('content-type: text/html; charset=ISO-8859-1');
    //ini_set('default_charset','UTF-8');
	//constantes utilizadas na conexão com o banco de dados
	define ( "SERVIDOR", "localhost" );
	define ( "USUARIO", "root" );
	define ( "SENHA", "" );
	define ( "BD", "educatio" );
	

	$CPF = 50595766714;
	
	//conexao com o BD
	$conn = mysqli_connect ( SERVIDOR, USUARIO, SENHA );

	//Seleciona o BD
	$bd_select = mysqli_select_db ( $conn, BD );

	//seleciona a linha em que o idCPF for igual ao CPF recebido
	$sql = "SELECT * FROM alunos WHERE idCPF = '$CPF'";
	$result = mysqli_query( $conn,$sql );
	$linha = mysqli_fetch_array( $result );
	
	$sql = "SELECT ano FROM matriculas WHERE idAluno = '$CPF' AND ativo ='S' ORDER BY ano desc";
	$resultMatriculas = mysqli_query( $conn,$sql );
	$ano = 0;
	$anterior = 0;
	$anos = 0;
	while ( $linhaMatriculas = mysqli_fetch_array( $resultMatriculas ) ){
		if ( $anos == 0 ){
			$ano = $linhaMatriculas[0];
			$anterior = $linhaMatriculas[0];
		}

		if ( $anterior != $linhaMatriculas[0] ){
			$anos++;
		}
		$anterior = $linhaMatriculas[0];
	}
	$anoatual = 0;
	if ( isset( $_POST['Selecionar'] ) ){
		$anoatual = $_POST["ano"];
	}
	if ( $anoatual == 0 ){
		$idTurma = $linha[1];
		$anoatual = $ano;
	}
	else{
		$sql = "SELECT idDisciplina FROM matriculas WHERE idAluno = '$CPF' AND ano = '$anoatual' AND ativo ='S'";
		$resultMatricula = mysqli_query( $conn,$sql );
		$linhaMatricula = mysqli_fetch_array( $resultMatricula );

		$sql = "SELECT idTurma FROM disciplinas WHERE id = '$linhaMatricula[0]' AND ativo ='S'";
		$resultMatricula = mysqli_query( $conn,$sql );
		$linhaMatricula = mysqli_fetch_array( $resultMatricula );

		$idTurma = $linhaMatricula[0];
	}
	$sql = "SELECT * FROM turmas WHERE id = '$idTurma' AND ativo ='S'";
	$resultTurma = mysqli_query( $conn,$sql );
	$linhaTurma = mysqli_fetch_array( $resultTurma );

	$sql = "SELECT * FROM cursos WHERE id = '$linhaTurma[2]' AND ativo ='S'";
	$resultCurso = mysqli_query( $conn,$sql );
	$linhaCurso = mysqli_fetch_array( $resultCurso );
?>
	<div class = "section landing-section">
	    <div class = "container">
	       	<div class="row">
				<div class="col-md-8 ml-auto mr-auto">
				    <h2 class="text-center"> Di&aacuterio </h2>	
			       		<form class  = "contact-form" method = "POST" action = "Diario-Aluno.php">
		                	<div class = "row">
		              			<label class = "fonteTexto" for = "DiarioAno"> Ano </label>
		               			<div class = "input-group">
		                  			<span class = "input-group-addon">
		                    		<i class = "nc-icon nc-calendar-60"></i>
		                  			</span>
		                  			<select class = "form-control" name = "ano" id = "DiarioAno">
		                  			<?php
		                  				$ano -= $anos;
		                  				if ( $anos > 0 ){
		                  					$anos--;
		                  				}
		                  				for ( $i = -1; $i<$anos ; $i++ ){
		                  			?>
		                  					<option value = "<?php echo $ano ?>"> 
		                                        <?php echo $ano ?>
		                                    </option>
		                  		  <?php } ?>
		                  			</select>
		                  		</div>
		                  	</div>
		                  	<div class = "row">
		                  		<div class = "col-md-2 ml-auto mr-auto">
		                			<button type = "submit" class = "btn btn-info btn-round"> Selecionar </button>
		              			</div>
		                  	</div>		
		                	<div class = "row">
		                		<label class = "fonteTexto"> Aluno: <?php echo $linha[2];?> Curso: <?php echo $linhaCurso[2];?> Modalidade: <?php echo $linhaCurso[4];?> </label>
		                		<label class = "fonteTexto"> Carga Hor&aacuteria: <?php echo $linhaCurso[3];?> Turma: <?php echo $linhaTurma[3];?> Per&iacuteodo: <?php echo $linhaTurma[2];?> Ano: <?php echo $anoatual ?> </label>
			          		</div>
			    		</form>
			    	</div>
			    </div>
	    </div>
	</div>
   
<?php
	$sql = "SELECT * FROM disciplinas WHERE idTurma = '$linhaTurma[1]' AND ativo = 'S'";
	$resultDisciplina = mysqli_query($conn,$sql);
	$valorRetornado = "<table border = '1' align='center' width='40%'><thead><tr><th align='center'> Disciplina </th><th align='center' colspan = '2'> Frequ&ecircncia </th></thead><tbody>";

	while ( $linhaDisciplina = mysqli_fetch_array($resultDisciplina) ){							    
        $sql = "SELECT * FROM profdisciplinas WHERE idDisciplina = $linhaDisciplina[0] AND ativo = 'S'";
        $resultProfessor = mysqli_query( $conn,$sql );
		$linhaProfessor = mysqli_fetch_array( $resultProfessor );

		$sql = "SELECT * FROM funcionario WHERE idSIAPE = $linhaProfessor[1] AND ativo = 'S'";
		$resultFuncionarios = mysqli_query( $conn,$sql );
		$linhaFuncionarios = mysqli_fetch_array( $resultFuncionarios );

		$sql = "SELECT * FROM conteudos WHERE idDisciplina = $linhaDisciplina[0] AND ativo = 'S' ";
		$resultConteudo = mysqli_query( $conn,$sql );
        $aulas = 0;
        $faltas = 0;
        while ( $linhaConteudo = mysqli_fetch_array($resultConteudo) ) {
			$sql = "SELECT * FROM matriculas WHERE idAluno = $linha[0] AND idDisciplina = $linhaDisciplina[0] AND ativo = 'S'";
			$resultMatriculas = mysqli_query( $conn,$sql );
			while ($linhaMatricula = mysqli_fetch_array( $resultMatriculas )) {
				$sql = "SELECT * FROM diarios WHERE idConteudo = $linhaConteudo[0] AND idMatricula = $linhaMatricula[0] AND ativo = 'S'";
				$resultdiarios = mysqli_query( $conn,$sql );
			    while ( $linhadiarios = mysqli_fetch_array($resultdiarios) ){ 
					$sql = "SELECT * FROM atividades WHERE id = $linhadiarios[3] AND ativo = 'S'";
					$resultAtividade = mysqli_query( $conn,$sql );
					while ( $linhaAtividade = mysqli_fetch_array($resultAtividade) ) {
				        	$aulas++;
				        	$faltas += $linhadiarios[4];
					}
				}
			}
		}
		$frequencia = 100 - ( ($faltas*100) / ($aulas) );
		$frequencia = number_format($frequencia, 0);

        $valorRetornado .= "<tr align='center'><td  rowspan = '4'> Disciplina de ".$linhaDisciplina[2]." - ".$linhaFuncionarios[2]."</td><td> Carga Hor&aacuteria </td><td>".$linhaDisciplina[3]."</td></tr>"; 
        $valorRetornado .= "<tr align='center'><td> Aulas Ministradas </td><td>".$aulas."</td></tr>";
        $valorRetornado .= "<tr align='center'><td> Faltas </td><td>".$faltas."</td></tr>";
        $valorRetornado .= "<tr align='center'><td> Frequ&ecircncia </td><td>".$frequencia."</td></tr>";
								    	
		$sql = "SELECT * FROM conteudos WHERE idDisciplina =".$linhaDisciplina[0];
		$resultConteudo = mysqli_query($conn,$sql);
        while ( $linhaConteudo = mysqli_fetch_array($resultConteudo) ) {
        	$valorRetornado .= "<tr align='center'><td colspan = '3'> Nota da ".$linhaConteudo[1]." etapa";
			$sql = "SELECT * FROM matriculas WHERE idAluno = $linha[0]  AND idDisciplina = $linhaDisciplina[0] AND ativo = 'S'";
			$resultMatriculas = mysqli_query( $conn,$sql );
			while ( $linhaMatricula = mysqli_fetch_array($resultMatriculas) ) {
				$sql = "SELECT * FROM diarios WHERE idConteudo = $linhaConteudo[0] AND idMatricula = $linhaMatricula[0] AND ativo = 'S'";
				$resultdiarios = mysqli_query( $conn,$sql );
			    while ( $linhadiarios = mysqli_fetch_array($resultdiarios) ){ 
					$sql = "SELECT * FROM atividades WHERE id = $linhadiarios[3] AND ativo = 'S'";
					$resultAtividade = mysqli_query( $conn,$sql );
					while ($linhaAtividade = mysqli_fetch_array( $resultAtividade )) {
						if ( $linhaAtividade[4] >= 0.1 ){
				        	$valorRetornado .= "<br>".$linhaAtividade[2] ." Data: ".$linhaAtividade[3]." Valor: ".$linhaAtividade[4]." Nota: ".$linhadiarios[5];
				        }
					}
					//  echo "<br>";
				}
                echo "<br>"; 
			}
			$valorRetornado .= "</td></tr>";
		}
		//echo "<br>";
	}
	$valorRetornado .= "</tbody></table>";
	echo $valorRetornado;

?>
</body>
</html>