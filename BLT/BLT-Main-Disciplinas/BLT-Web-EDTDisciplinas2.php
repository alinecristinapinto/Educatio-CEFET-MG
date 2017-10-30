<!DOCTYPE html>
<html>
<head>
  <title>Educatio - CEFET-MG </title>
  <meta charset="utf-8">
  <link href="css/bootstrap.css" rel="stylesheet">
  <link href="gerencia-web-estilos-rodape.css" rel="stylesheet">
  <link href="BLT-Web-Disciplinas.css" rel="stylesheet">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script> 
 </head>
</html>
<body>
</body>



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


$nomeedt = $_POST['nomeedt'];
$IDTurmaedt = $_POST['idTurmaedt'];
$cargaedt = $_POST['carga'];
$nome = $_POST['nome'];
$IDTurma = $_POST['idTurma'];



        $sql = "UPDATE disciplinas SET nome='$nomeedt', idTurma='$IDTurmaedt', cargaHorariaMin='$cargaedt' WHERE nome='$nome' AND idTurma='$IDTurma'";
        if ($conn->query($sql) === TRUE) {
          echo "<div class=\"corpo\">";
          echo "<div class=\"titulo\">";
          echo "<h1>";
          echo "<b>Disciplina editada com sucesso!</b>";
          echo "</h1>";
          echo "<div class=\"container-fluid\">
                <div class=\"row\">
                <div class=\"col-md-12 mb-3\">
                <button style=\"margin-top: 70px;\"type=\"button\" class=\"btn btn-outline-info btn-block \" onclick=\"window.location.href='BLT-Web-Disciplinas.html'\">Pronto</button>
                </div>
                </div>
                </div>";
          echo "</div>";
          echo "</div>";
        } else {
          echo "Error updating record: " . $conn->error;
        }

$conn->close();
?>