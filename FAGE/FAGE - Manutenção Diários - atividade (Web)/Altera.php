<?php
$nomeedit = $_POST['nomeedit'];
$idprofdisciplinaform = $_POST["materiaedit"] ;
$nome = $_POST['nome'];
$data = $_POST['data'];
$valor = $_POST['valor'];
$idprofdisplina = $_POST['materia'];
//inclued("Conexao.php")
$conn = mysqli_connect( "localhost" , "root" , "" , "educatio" );
// Check connection
if ( mysqli_connect_errno() ){
  echo "Failed to connect to MySQL: " .mysqli_connect_error();
 }

$sql = "SELECT id FROM atividades WHERE nome = '$nomeedit' AND idProfDisciplina = $idprofdisciplinaform AND ativo = 'S' ";
$result = mysqli_query( $conn, $sql );

// Associative array
$row = mysqli_fetch_assoc( $result );
$id = $row['id'];

$sql = " UPDATE atividades SET idProfDisciplina = '$idprofdisplina' , nome = '$nome' , data = '$data' , valor = '$valor'  WHERE id = $id ";

mysqli_free_result( $result );
mysqli_query( $conn, $sql ) or die( "Erro ao alterar atividade" );
mysqli_close( $conn );
include("Atividades.php");
?>
