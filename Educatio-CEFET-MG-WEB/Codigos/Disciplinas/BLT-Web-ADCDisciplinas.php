<html>
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
$idProfessor = $_POST['idProfessor'];
$cargaHoraria = $_POST['cargaHoraria'];
$ativo = "S";

$sql = "INSERT INTO disciplinas (idTurma, nome, cargaHorariaMin, ativo) VALUES ('$idTurma', '$nomeDisciplina', '$cargaHoraria', '$ativo')";

$result = mysqli_query($conn,$sql);
$ultimoId = mysqli_insert_id($conn);

//$query = ($conn, "SELECT id, nome FROM disciplinas WHERE ativo = 'S'");
//$disciplinas = mysqli_fetch_array($query);


$sql = "INSERT INTO profDisciplinas (idProfessor, idDisciplina, idTurma, ativo) VALUES ('$idProfessor', '$ultimoId', '$idTurma', '$ativo')";

if ($conn->query($sql) === TRUE) {
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

//header('http://localhost/Educatio-CEFET-MG-master/BLT/BLT-Main-Disciplinas/BLT-Web-Disciplinas.html');

?>
<script type="text/javascript">
	window.location.href = '../Entrada/gerencia-web-interface-coordenador.php?acao=adicionarDisciplina';
</script>
</html>
