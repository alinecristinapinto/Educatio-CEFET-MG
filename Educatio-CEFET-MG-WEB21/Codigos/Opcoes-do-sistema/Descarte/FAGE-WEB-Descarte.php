
<link href="../../../Estaticos/Bootstrap/css/bootstrap.min.css" rel="stylesheet" />
<link href="../../../Estaticos/Bootstrap/css/bootstrap.css" rel="stylesheet"/>

<!-- Arquivos js -->
<script src="../../../Estaticos/Bootstrap/js/popper.js"></script>
<script src="../../../Estaticos/Bootstrap/js/jquery-3.2.1.js" type="text/javascript"></script>
<script src="../../../Estaticos/Bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

<!-- Fontes e icones -->
<link href="../../../Estaticos/Bootstrap/css/nucleo-icons.css" rel="stylesheet">

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
$con=mysqli_connect("localhost","root","usbw");
//concta com banco de dados
mysqli_select_db($con,"educatio");

$idacervo=$_POST['num'];


$data =date("d/m/Y");

$mot=$_POST['mot'];
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
//seleciona a tabela acervo
	$sql = "SELECT id,ativo FROM acervo  ";
//cria variavel para ativar fução sql
	$result = $con->query($sql);
	$repetido=0;
//roda a tabela acervo e compara se o acervo ja foi excluido
	while($row = $result->fetch_assoc()) {
		if('N' == $row["ativo"] && $idacervo==$row['id']){
			$repetido=1;
		}
	}
	if($repetido==0){
//incere valores no descarte
		$sql="INSERT INTO descartes values(DEFAULT,'$idacervo','1','$data','$mot','S')";
//ativa função sql
		$t=mysqli_query($con,$sql);
//mostra quantas linha forão afetadas
		$lin=mysqli_affected_rows($con);
//mostra o usuario quantas linha foram afetadas

//mastra se o descatew foi concluido ou não e qual o erro
		if ($lin >= 1) {
			echo "<script>alert('Concluido')</script>";
		} else {
			echo "<pre>Error: " . $sql . "<br>" . $con->error."</pre>";
		}
//mosta valores colocados pelo usuario



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
		$sql = "SELECT id,idAcervo,dataDescarte,motivos FROM descartes ";
//ativa função sql
		$result = $con->query($sql);
//cria um contador para cada array
		$a=0;
		$tabela = "<div class='col-md-6'><table class='table table-hover'><thead><tr><th>id</th><th>idAcervo</th><th>data</th><th>motivos</th></tr></thead><tbody>";
//percorre tabela decarte e coloca os valores em array
		while($row = $result->fetch_assoc()){
			$idDescarte=$row["id"];
			$ace=$row["idAcervo"];
			$datades=$row["dataDescarte"];
			$motv=$row["motivos"];


		}
		$tabela .= "<tr><td>".$idDescarte."</td><td>".$ace."</td><td>".$datades."</td><td>".$motv."</td></tr>";
		$tabela .="</tbody></table></div>";
		echo $tabela;
//butao voltar
		header("location:FAGE-WEB-alert.php?result=inserirSUCESSO");
	}

	else{
		header("location:FAGE-WEB-alert.php?result=alterarSUCESSO");
	}

}

else{
	header("location:FAGE-WEB-alert.php?result=inserirERRO");
}
?>
