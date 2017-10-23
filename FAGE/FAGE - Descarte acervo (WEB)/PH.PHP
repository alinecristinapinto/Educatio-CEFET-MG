<?php
Header("Content-type: text/html; charset=ISO-8859-1")
$con=mysqli_connect("localhost","root","");
mysqli_select_db($con,"biblioteca");
$tab=mysqli_query($con,"select*from Descartes");
$lin=mysqli_num_rows($tab);
echo "<pre>NUMERO DE DESCARTES : $lin <br></pre>";
$idacervo=$_GET['num'];
$data=$_GET['data'];
$mot=$_GET['mot'];
$op=$_GET['op'];
 $flag=0;
$sqli = "SELECT Id FROM Acevo  ";
$result = $con->query($sqli);
while($row = $result->fetch_assoc()||$flag = 1) {
	$id=$row['Id'];
	  if($idacervo == $id){
	  	$flag = 1;
	  }
	}
	if($flag == 1){
$sql="INSERT INTO Descartes values('$idacervo','$data','$mot','$op')";
$t=mysqli_query($con,$sql);
$lin=mysqli_affected_rows($con);
echo " <pre> numero de linha auteradas é $lin <br></pre> ";
if ($lin >= 1) {
    echo "<pre>criado com sucesso</pre>";
} else {
    echo "<pre>Error: " . $sql . "<br>" . $con->error."</pre>";
}
echo "<pre>$idacervo<br>$data<br>$mot<br>$op<br></pre>";
 $sql2     = "delete from Acervo where id = $idacervo;"
 $qry2     = mysqli_query($con,$sql2);
 $tab=mysqli_query($con,"select*from Acervo");
$lin=mysqli_num_rows($tab);
echo "<pre>NUMERO DE ACERVOS : $lin <br></pre>";
}
else{
	echo "Não existe id do acervo";
}

?>