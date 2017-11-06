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

$nomeDisciplina = $_POST['nomeDisciplina'];
$idTurma = $_POST['idTurma'];
$cargaHoraria = $_POST['cargaHoraria'];
$ativo = "S";

$sql = "INSERT INTO disciplinas (idTurma, nome, cargaHorariaMin, ativo) VALUES ('$idTurma', '$nomeDisciplina', '$cargaHoraria', '$ativo')";


if ($conn->query($sql) === TRUE) {
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

header('Location: http://localhost/Educatio-CEFET-MG/BLT/BLT-Main-Disciplinas/BLT-Web-Disciplinas.html')
?>