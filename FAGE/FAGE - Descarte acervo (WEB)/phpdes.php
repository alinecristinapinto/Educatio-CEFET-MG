<pre>
	<link ​ href = "Bootstrap/bootstrap-4.0.0-alpha.6-dist/css/bootstrap.css"​ ​ rel = "stylesheet">
	<div class="container">
  <!-- Content here -->

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
		echo "<pre>NUMERO DE DESCARTES : $lin <br></pre>";
//pega valores que o usuario mandou
		$nomeacervo=$_GET['num'];
		$data=$_GET['data'];
		$mot=$_GET['mot'];
		$op=$_GET['op'];

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
			echo "id digitado ja foi descartado";
		}	
		}
		else if($flag >= 2){
//seleciona a tabela acervo
		$sql = "SELECT id,nome FROM acervo  ";
//cria variavel para ativar fução sql
		$result = $con->query($sql);
	//ddd
		$i=0;
//roda a tabela acervo e pega os ids dos nomes repetidos
		while($row = $result->fetch_assoc()) {
			
			if($nomeacervo == $row["nome"]){
				$idsrepetido[$i]=$row["id"];
				$i++;
			}
			 	
			}
			echo "os ids dos acervos repetidos são:";
			print_r($idsrepetido);
			echo"
			<!DOCTYPE html>
            <link ​ href = 'Bootstrap/bootstrap-4.0.0-alpha.6-dist/css/bootstrap.css'​ ​ rel = 'stylesheet'>
            <html>
            <head>
	        <title></title>
            </head>
            <body>
	        <pre>
		    <h1>DESCARTE</h1>
		    <h3>existem 2 ou mais acervos com o mesmo nome digite o id do acervo para descartalo</h3>
		    <h3>digite o id do acervo para descartalo</h3>
	        <form method='get' action='phprepetido.php'>
	        <div class='form-group'>
		      ID DO ACERVO     
		    <input  class='form-control' type='text' name='num'><br>
			DATA DO DESCARTE:<input type='date' name='data'value=$data><br>
		    MOTIVOS
		    <input  class='form-control' type='text' name='mot'value=$mot><br>
		    OPERADOR        
		    <input  class='form-control' type='text' name='op'value=$op><br>
		    ID-PROFESSOR    
		    <input class='form-control' type='number' name='prof'value=$idprof>
		    </div>
		
			<input class='btn btn-primary btn-lg btn-block' type='submit' name='fim' onClick>
			<input class='btn btn-primary btn-lg btn-block' type='reset' name='d'>
			<input class='btn btn-primary btn-lg btn-block' type='button' value='Voltar' onClick='history.go(-1)'> 
<div class='progress'>
  		<div class='progress-bar' role='progressbar' style='width: 75%;' aria-valuenow='25' aria-valuemin='0' aria-valuemax='100'>25%</div>
		</div>
	</form>
	</pre>
	</body>
	</html>";
	//passa as informaçães digitadas pelo usuario para o outro php

		}
//casso não exista id acervo
		else{
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
</pre>