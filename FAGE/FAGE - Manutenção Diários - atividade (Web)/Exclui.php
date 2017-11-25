<?php
$idatividade = $_POST['num'];

$conn = mysqli_connect( "localhost" , "root" , "" , "educatio" );
// Check connection
if ( mysqli_connect_errno() )
  {
  echo "Failed to connect to MySQL: " .mysqli_connect_error();
  }

$sql = " UPDATE atividades SET ativo = 'N' WHERE id = $idatividade ";

// Free result set
mysqli_query( $conn, $sql ) or die( "Erro ao excluir atividade" );
mysqli_close( $conn );
?>