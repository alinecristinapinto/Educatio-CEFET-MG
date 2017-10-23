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
		//a vai verificar se exste doi nomes iguais
			$a=0;

	}

	//se tiver roda o resto do programa
	if($acess==1){
		//pega valores que o usuario mandou
		$nomelivro=$_GET['num'];
		$data=$_GET['data'];
		$mot=$_GET['mot'];
		$op=$_GET['op'];
		//tipo verifica se e um livro,midia,academico ou periodico
			$tipo=$_GET['tipo'];		
//seleciona tabela livros
			if($tipo=="l"){
			$sql="SELECT id FROM livros";
//ativa função sql
			$result = $con->query($sql);

//percorre tabela livro e verifica se existe o livro digitado
			while($row = $result->fetch_assoc()){
				if ($nomelivro == $row["id"]) {
					$a++;
				
				}
			}
		}
//seleciona tabela midias
			else if($tipo=="m"){
			$sql="SELECT id FROM midias";
//ativa função sql
			$result = $con->query($sql);
//percorre tabela livro e verifica se existe o livro digitado			

			while($row = $result->fetch_assoc()){
				if ($nomelivro == $row["id"]) {
					$a++;
					
				}
			}
		}
//seleciona tabela periodicos
			else if($tipo=="p"){
			$sql="SELECT id FROM periodicos";
//ativa função sql
			$result = $con->query($sql);
			
//percorre tabela livro e verifica se existe o livro digitado		
			while($row = $result->fetch_assoc()){
				if ($nomelivro == $row["id"]) {
					$a++;
				}
			}
		}

//seleciona tabela academicos
		else if($tipo=="a"){
			$sql="SELECT id FROM academicos";
//ativa função sql
			$result = $con->query($sql);
			
//percorre tabela livro e verifica se existe o livro digitado	
			while($row = $result->fetch_assoc()){
				if ($nomelivro == $row["id"]) {
					$a++;
				}
			}
		}
			if($a=1){


//selecona tabela descarte
		$tab=mysqli_query($con,"SELECT * from descartes");
//mostera quanta linha tem a tabela
		$lin=mysqli_num_rows($tab);
//mostra para o usuario quantos descates existem
		echo "<pre>NUMERO DE DESCARTES : $lin <br></pre>";

//incere valores no descarte
		
			$sql="INSERT INTO descartes values(DEFAULT,'$nomelivro','$idprof','$data','$mot','S')";
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
			if($tipo=="l"){
			//deleta livros
			$sql2     = "UPDATE livros SET ativo='n' where id = $nomelivro";
			$qry2     = mysqli_query($con,$sql2);
		}

		if($tipo=="a"){
			//deleta livros
			$sql2     = "UPDATE acervo SET ativo='n' where id = $nomelivro";
			$qry2     = mysqli_query($con,$sql2);
		}
		if($tipo=="m"){
			//deleta livros
			$sql2     = "UPDATE midia SET ativo='N' where id = $nomelivro";
			$qry2     = mysqli_query($con,$sql2);
		}
		if($tipo=="p"){
			 //pega o id do periodico que vai ser deletado
			$sql = "SELECT id FROM periodicos ";
			$result = $con->query($sql);
//deleta partes
			while($row = $result->fetch_assoc()) {
				if($nomelivro == $row["id"]){
					$idperiodico=$row["id"];
					$sql2     = "UPDATE partes SET ativo ='N' where idPeriodico = $idperiodico ";
					$qry2     = mysqli_query($con,$sql2);
				}
			}
 
 //deleta periodicos
			$sql2     = "UPDATE periodicos SET ativo='n' where id = $nomelivro";
			$qry2     = mysqli_query($con,$sql2);
		}
//mosta valores colocados pelo usuario

			echo "$nomelivro<br>$data<br>$mot<br>$op<br>";
			//butao voltar
			echo "<input class='btn btn-primary btn-lg btn-block' type='button' value='Voltar' onClick='history.go(-2)'> ";
			ECHO"<div class='progress'>
			  		<div class='progress-bar' role='progressbar' style='width: 100%;' aria-valuenow='25' aria-valuemin='0' aria-valuemax='100'>25%</div>
					</div>";

		
}
else{
	echo "livro não existe<br><br>";
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