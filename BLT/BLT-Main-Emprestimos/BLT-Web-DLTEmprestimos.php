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
    echo "<div class=\"corpo\">";
    echo "<div class=\"titulo\">";
    echo "<h1><h3><b>Sem valores no banco de dados</b></h3></h1>";
    echo "</div>";
    echo "</div>";
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
<form action="BLT-Web-DLTEmprestimos2.php" method="post">
  	<div class="row" style="margin: 70px;">
    	<div class="col-md-6 mb-3">
      		<label for="validationServer02">ID do acervo que deseja devolver</label>
      		<input type="text" class="form-control is-valid" id="validationServer02" name="IDAcervo" placeholder="ID do acervo" value="" required>
      	</div>

      	<div class="col-md-6 mb-3">
      		<label for="validationServer02"></label>
      		<button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-outline-info btn-block btn-lg">Remover</button>

            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                      <div class="col-md-6 mb-3">
                        <label for="validationServer02">Data de devolução</label>
                        <input type="date" name="datadevolucao" class="form-control is-valid" id="validationServer02" placeholder="ID" value="" required>
                      </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Pronto</button>
                  </div>
                </div>
              </div>
            </div>
    	</div>

  	</div>
 </form>  
</div>
</div>
</body>
</html>