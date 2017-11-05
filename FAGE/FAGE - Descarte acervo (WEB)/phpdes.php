
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
	<div class="container">

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

	<?php
//concção com localhost
	$con=mysqli_connect("localhost","root","");
//concta com banco de dados
	mysqli_select_db($con,"educatio");
//pega o id do professor
	$idprof=$_GET['prof'];
//seleciona a tabela prof
	$sql = "SELECT idSIAPE,hierarquia FROM funcionario";
//executa função sql
	$result = $con->query($sql);
//cria variavel para controlar acesso
	$acess=0;
//confere se id digitado existe na tabela
	while($row = $result->fetch_assoc()) {
		$id=$row["idSIAPE"];
		$hierarquia=$row["hierarquia"];
		if($idprof == $id && $hierarquia == 'B'){
			$acess = 1;
		}

	}
	//se tiver roda o resto do programa
	if($acess==1){

//selecona tabela descarte
		$tab=mysqli_query($con,"SELECT * from descartes");
//mostera quantas linhas tem a tabela
		$lin=mysqli_num_rows($tab);
//mostra para o usuario quantos descates existem
		//echo "<pre>NUMERO DE DESCARTES : $lin <br></pre>";
//pega valores que o usuario mandou
		$nomeacervo=$_GET['num'];
		$data=$_GET['data'];
		$mot=$_GET['mot'];
	

//cria variavel para controla se existe o acevo
		$flag=0;
//seleciona a tabela acervo
		$sql = "SELECT nome FROM acervo  ";
//cria variavel para ativar fução sql
		$result = $con->query($sql);
//roda a tabela acervo e compara se existe acevo digitado
		while($row = $result->fetch_assoc()) {
			$nome=$row["nome"];
			if($nomeacervo == $nome){
				$flag++;
			}
		}

//se tiver acervo continiaua programa
		if($flag == 1){
//seleciona a tabela acervo
		$sql = "SELECT id,nome FROM acervo  ";
//cria variavel para ativar fução sql
		$result = $con->query($sql);
//roda a tabela acervo e pega o id do acervo digitado
		while($row = $result->fetch_assoc()) {
		if($nomeacervo == $row["nome"]){
				$idacervo=$row["id"];
			}
		}
//seleciona a tabela descarte
		$sql = "SELECT idAcervo FROM descartes";
//cria variavel para ativar fução sql
		$result = $con->query($sql);
		$repetido=0;
//roda a tabela acervo e compara se o acervo ja foi excluido
		while($row = $result->fetch_assoc()) {
		if($idacervo == $row["idAcervo"]){
				$repetido=1;
			}
		}
		if($repetido==0){
			//seleciona a tabela EMPRESTIMO
		$sql = "SELECT idAcervo,ativo FROM emprestimos";
//cria variavel para ativar fução sql
		$result = $con->query($sql);
		$emprestado=0;
//roda a tabela acervo e compara se o acervo ja foi excluido
		while($row = $result->fetch_assoc()) {
		if($idacervo == $row["idAcervo"] && $row["ativo"]='S'){
				$emprestado=1;
			}
		}
		if($emprestado==0){
	//incere valores no descarte
			$sql="INSERT INTO descartes values(DEFAULT,'$idacervo','$idprof','$data','$mot','S')";
//ativa função sql
			$t=mysqli_query($con,$sql);
//mostra quantas linha forão afetadas
			$lin=mysqli_affected_rows($con);
//mostra o usuario quantas linha foram afetadas
			echo " <pre> numero de linha auteradas é $lin <br></pre> ";
//mastra se o descatew foi concluido ou não e qual o erro
			if ($lin >= 1) {
				echo "<pre>criado com sucesso</pre>";
			} else {
				echo "<pre>Error: " . $sql . "<br>" . $con->error."</pre>";
			}
//mosta valores colocados pelo usuario

			echo "$idacervo<br>$data<br>$mot<br>$op<br>";

//deleta acervo
			$sql2     = "UPDATE acervo SET ativo='N' where id = $idacervo";
			$qry2     = mysqli_query($con,$sql2);
 //deleta livros

			$sql2     = "UPDATE livros SET ativo='N' where idAcervo = $idacervo";
			$qry2     = mysqli_query($con,$sql2);
 //deleta acadamicos
			$sql2     = "UPDATE academicos SET ativo='N' where idAcervo = $idacervo";
			$qry2     = mysqli_query($con,$sql2);
 //deleta midias
			$sql2     = "UPDATE midias SET ativo='N' where idAcervo = $idacervo";
			$qry2     = mysqli_query($con,$sql2);
 //pega o id do periodico que vai ser deletado
			$sql = "SELECT id,idAcervo FROM periodicos  ";
			$result = $con->query($sql);
//CONTROLADOR DO PERIODICO PARA DELETAR PARTES
			$contdeperiodico = 0;

//
			while($row = $result->fetch_assoc()) {
				if($idacervo == $row["idAcervo"]){
					$idperiodico=$row["id"];
					$contdeperiodico++;
				}
			}
 //deleta parte
			while($contdeperiodico != 0){
				$sql2     = "UPDATE partes SET ativo ='N' where idPeriodico = $idperiodico";
				$qry2     = mysqli_query($con,$sql2);
				$contdeperiodico--;

			}
 //deleta periodicos
			$sql2     = "UPDATE periodicos SET ativo ='N' where idAcervo = $idacervo";
			$qry2     = mysqli_query($con,$sql2);
//selecina tabela descarte 
			$sql = "SELECT id,idAcervo,idFuncionario,dataDescarte,motivos FROM descartes ";
//ativa função sql
			$result = $con->query($sql);
//cria um contador para cada array
			$a=0;
//percorre tabela decarte e coloca os valores em array
			while($row = $result->fetch_assoc()){
				$idDescarte[$a]=$row["id"];
				$ace[$a]=$row["idAcervo"];
				$datades[$a]=$row["dataDescarte"];
				$motv[$a]=$row["motivos"];
				$ope[$a]=$row["idFuncionario"];
				
				echo $tudo[$a]=$idDescarte[$a]." ".$ace[$a]." ".$datades[$a]." ".$motv[$a]." ".$ope[$a];
				echo"<br>";
				$a++;
			}
//butao voltar
			echo "<input type='button' value='Voltar' onClick='history.go(-2)'> ";
			ECHO"<div class='progress'>
			  		<div class='progress-bar' role='progressbar' style='width: 100%;' aria-valuenow='25' aria-valuemin='0' aria-valuemax='100'>25%</div>
					</div>";
//mostra os valores da tabela descarte
		}
		else{
			echo"livro emprestado";
		}
	}
		else{
			echo "id digitado ja foi descartado";
		}	
		}
		else if($flag >= 2){
//seleciona a tabela acervo
		
			echo"
			<!DOCTYPE html>
          
            <html>
            <head>
          	<link href='css/bootstrap.min.css' rel='stylesheet' />
	<link href='css/bootstrap.css' rel='stylesheet'/>

	<!-- CSS do grupo -->
	 <link href='' rel='stylesheet' />
	
	

	<!-- Arquivos js -->
	<script src='js/popper.js'></script>
	<script src='js/jquery-3.2.1.js' type='text/javascript'></script>
	<script src='js/bootstrap.min.js' type='text/javascript'></script>

	<!-- Fontes e icones -->
	<link href='css/nucleo-icons.css' rel='stylesheet'>
	<div class='container'>

	<style type='text/css'>
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
	        <title></title>
            </head>
            <body>
             

			<div class='wrapper'>     

        		<div class='section landing-section'>
            		<div class='container'>
                		<div class='row'>
                    		<div class='col-md-8 ml-auto mr-auto'>

                        		<h2 class='text-center'>DESCARTE</h2>
						 		<h3>existem 2 ou mais acervos com o mesmo nome digite o id do acervo para descartalo</h3>
							    <h3>digite o id do acervo para descartalo</h3>
	        
	        					<form method='get' action='phprepetido.php' class='contact-form'>

			        				<div class='row'>
		                                <label class='fonteTexto'>ID DO LIVRO </label>
		                                <div class='input-group'>
		                                    <span class='input-group-addon'>
		                                        <i class='nc-icon nc-book-bookmark'></i>
		                                    </span>
		                                    <input type='text' name='num' class='form-control' placeholder='ID DO LIVRO' required='required'>
		                                </div>
		                            </div>
	        
		  							<div class='row'>
		                                <label class='fonteTexto'> DATA DO DESCARTE </label>
		                                <div class='input-group'>
		                                    <span class='input-group-addon'>
		                                        <i class='nc-icon nc-book-bookmark'></i>
		                                    </span>
		                                    <input type='text' class='form-control' placeholder='Data Do Descarte' required='required' name='data' value=$data>
		                                </div>
		                              </div>
		                             <div class='row'>
		                                <label class='fonteTexto'> MOTIVOS </label>
		                                <div class='input-group'>
		                                    <span class='input-group-addon'>
		                                        <i class='nc-icon nc-book-bookmark'></i>
		                                    </span>
		                                    <input type='text' class='form-control' placeholder='Motivos' required='required' name='mot' value=$mot>
		                                </div>
		                            </div>
		                             <div class='row'>
		                                <label class='fonteTexto'> ID-PROFESSOR  </label>
		                                <div class='input-group'>
		                                    <span class='input-group-addon'>
		                                        <i class='nc-icon nc-book-bookmark'></i>
		                                    </span>
		                                    <input type='text' class='form-control' placeholder='Id-Professor' required='required' name='prof' value=$idprof>
		                                </div>
		                            </div> <br>
			
			<div class='row'>
				<div class='col-md-4 ml-auto mr-auto'>
  					<input class='btn btn-info btn-round' type='submit' name='d'> 
 			  	</div>
    		
    		
				<div class='col-md-4 ml-auto mr-auto'>
  					<input class='btn btn-info btn-round' type='reset' name='d'> 
 			  	</div>
    		
    		
				<div class='col-md-4 ml-auto mr-auto'>
  					<input class='btn btn-info btn-round' type='button' value='Voltar' onClick='history.go(-1)'> 
 			  	</div>
    		</div>
			

	</form>
	
	</body>
	</html>";
	$sql = "SELECT id,nome,tipo,ano,editora FROM acervo";
//cria variavel para ativar fução sql
		$result = $con->query($sql);

		
//cria tabela
		$tabela = "<div class='col-md-6'><table class='table table-hover'><thead><tr><th>id</th><th>Nome</th><th>tipo</th><th>ano</th><th>editora</th></tr></thead><tbody>";
//roda a tabela acervo e pega os ids dos nomes repetidos
		while($row = $result->fetch_assoc()) {
			
			if($nomeacervo == $row["nome"]){
				$id = $row["id"];
				echo "<script>alert($id);</script>";
				$nome = $row["nome"];
				$tipo = $row["tipo"];
				$ano=$row["ano"];
				$editora = $row["editora"];
				$tabela .= "<tr><td>".$id."</td><td>".$nome."</td><td>".$tipo."</td><td>".$ano."</td><td>".$editora."</td></tr>";
			}
	//passa as informaçães digitadas pelo usuario para o outro p
		}

		$tabela .="</tbody></table></div>";
		echo"<h5>Acervos repetidos são:<h4>";
		echo $tabela;
//casso não exista id acervo
		}else{
			echo "Não existe acervo<br><br>";
			echo "<input class='btn btn-primary btn-lg btn-block' type='button' value='Voltar' onClick='history.go(-1)'> ";
		}

	}
//caso não exista id prof
	else{
		echo "Nao existe esse Id-SIAPE<br><br>";
		echo "<input class='btn btn-primary btn-lg btn-block' type='button' value='Voltar' onClick='history.go(-1)'> ";
	}

	?>
</div>
