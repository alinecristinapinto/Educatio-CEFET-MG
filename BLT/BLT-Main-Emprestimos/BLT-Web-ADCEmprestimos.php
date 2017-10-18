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

$IDaluno = $_POST['IDaluno'];
$IDacervo = $_POST['IDacervo'];
$datacriacao = $_POST['datacriacao'];
$datadevolucao = $_POST['datadevolucao'];
$multa = $_POST['multa'];
$ativo = "s";

echo $datacriacao;


$sql = "INSERT INTO emprestimos (idAluno, idAcervo, dataEmprestimo, dataPrevisaoDevolucao, dataDevolucao, multa, ativo) VALUES ('$IDaluno', '$IDacervo', '$datacriacao', '$datadevolucao', '$datadevolucao', '$multa', '$ativo')";


/*if ($conn->query($sql) === TRUE) {
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

header('Location: http://localhost/Educatio-CEFET-MG/BLT/BLT-Main-Emprestimos/BLT-Web-Emprestimos.html')
*/
?>