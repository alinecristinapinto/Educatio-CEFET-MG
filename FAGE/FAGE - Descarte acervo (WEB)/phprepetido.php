<link ​ href = "Bootstrap/bootstrap-4.0.0-alpha.6-dist/css/bootstrap.css"​ ​ rel = "stylesheet">
<div class="container">
  <!-- Content here -->

<?php 
//concção com localhost
	$con=mysqli_connect("localhost","root","");
//concta com banco de dados
	mysqli_select_db($con,"educatio");

		$idacervo=$_GET['num'];
		$idprof=$_GET['prof'];
		$data=$_GET['data'];
		$mot=$_GET['mot'];
		$op=$_GET['op']; 
//seleciona a tabela descarte
		$sql = "SELECT idAcervo FROM descartes  ";
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
			echo "<input class='btn btn-primary btn-lg btn-block' type='button' value='Voltar' onClick='history.go(-3)'> ";
			ECHO"<div class='progress'>
			  		<div class='progress-bar' role='progressbar' style='width: 100%;' aria-valuenow='25' aria-valuemin='0' aria-valuemax='100'>25%</div>
					</div>"
		}
		else{
			echo"o acervo ja foi deletado";
		}
 ?>
 </div>