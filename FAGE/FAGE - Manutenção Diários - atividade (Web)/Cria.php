<?php
$nome = $_POST['nome'];
$data = $_POST['data'];
$valor = $_POST['valor'];
$idprofdisciplina = $_POST['materia'];
//inclued("Conexao.php")
$servername = "localhost";
$username = "root";
$password = null;
$dbname = "educatio";

//cria conexão
$conn = new mysqli( $servername, $username, $password, $dbname );
//verifica conexão
if ( $conn->connect_error ) {
    die( "Falha na conexão: " .$conn->connect_error. "<br>" );
}
//Insere os dados de uma nova atividade
$sql = "INSERT INTO atividades ( idProfDisciplina, nome, data, valor, ativo ) VALUES ( '$idprofdisciplina' , '$nome' , '$data' , '$valor' , 'S' )";

mysqli_query( $conn,$sql ) or die( "Erro ao criar atividade" );
mysqli_close( $conn );
echo "<script>alert('Email enviado com Sucesso!);</script>";
include("Atividades.php");
?>
