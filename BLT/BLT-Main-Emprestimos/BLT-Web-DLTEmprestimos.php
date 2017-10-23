<!DOCTYPE html>
<html>
<head>
  <title>Educatio - CEFET-MG </title>
  <meta charset="utf-8">
  <link href="css/bootstrap.css" rel="stylesheet">
  <link href="gerencia-web-estilos-rodape.css" rel="stylesheet">
  <link href="BLT-Web-Emprestimos.css" rel="stylesheet">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script> 
 </head>
<body>
<div class="corpo">
  <div class="titulo">
  <h1><b>Gerenciamento de Empréstimos</b></h1>
  </div>
</div>
</body>
</html>


<?php
$servername = "localhost";
$username = "root";
$password = "";
$bdNome = "educatio";

// Create connection
$conn = new mysqli($servername, $username, $password, $bdNome);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT idAluno, idAcervo, dataEmprestimo, dataPrevisaoDevolucao, dataDevolucao, multa FROM emprestimos WHERE ativo = 'S'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	echo "<div class=\"container-fluid\">";
    echo "<div class=\"TabelaExclusao\">";
    echo "<ul class=\"list-group\">";
    while($row = $result->fetch_assoc()) {
    	echo "<li class=\"list-group-item align-items-center\">ID Aluno: ".$row["idAluno"]." | ID Acervo: ".$row["idAcervo"]." | Data empréstimo: ".$row["dataEmprestimo"]."</li>";
    }
    echo "</ul>";
    echo "</div>";
    echo "</div>";
} else {
    echo "0 results";
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Educatio - CEFET-MG </title>
  <meta charset="utf-8">
  <link href="css/bootstrap.css" rel="stylesheet">
  <link href="gerencia-web-estilos-rodape.css" rel="stylesheet">
  <link href="BLT-Web-Emprestimos.css" rel="stylesheet">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script> 
 </head>
<body>
<div class="margem-DLTEmp">
<div class="container-fluid">
<form>
  	<div class="row" style="margin: 70px;">
    	<div class="col-md-6 mb-3">
      		<label for="validationServer02">ID do aluno que deseja remover o empréstimo</label>
      		<input type="text" class="form-control is-valid" id="validationServer02" name="IDaluno" placeholder="ID do aluno" value="" required>
      	</div>
      	<div class="col-md-6 mb-3">
      		<label for="validationServer02"></label>
      		<button type="submit" class="btn btn-outline-info btn-block btn-lg">Remover</button>
    	</div>
  	</div>
 </form>
</div>
</div>
</body>
</html>