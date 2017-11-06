<?php
$nome = $_POST['nome'];
$idprofdisciplina = $_POST['materia'];

$conn = mysqli_connect( "localhost" , "root" , "" , "educatio" );
// Check connection
if ( mysqli_connect_errno() )
  {
  echo "Failed to connect to MySQL: " .mysqli_connect_error();
  }

$sql = "SELECT id FROM atividades WHERE nome = '$nome' AND idProfDisciplina = $idprofdisciplina AND ativo = 'S' ";
$result = mysqli_query( $conn, $sql );

// Associative array
$row = mysqli_fetch_assoc( $result );
$id = $row['id'];
$sql = " UPDATE atividades SET ativo = 'N' WHERE id = $id ";

// Free result set
mysqli_free_result( $result );
mysqli_query( $conn, $sql ) or die( "Erro ao excluir atividade" );
mysqli_close( $conn );
include("Atividades.php");
?>