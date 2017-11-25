<?php
$idatividade = $_POST["num"] ;
$nome = $_POST['nome'];
$data = $_POST['data'];
$data = implode( '/', array_reverse( explode( '-', $data ) ) );
$valor = $_POST['valor'];
$idprofdisplina = $_POST['materia'];
//inclued("Conexao.php")
$conn = mysqli_connect( "localhost" , "root" , "" , "educatio" );
// Check connection
if ( mysqli_connect_errno() ){
  echo "Failed to connect to MySQL: " .mysqli_connect_error();
 }


$sql = " UPDATE atividades SET idProfDisciplina = '$idprofdisplina' , nome = '$nome' , data = '$data' , valor = '$valor'  WHERE id = $idatividade ";

mysqli_query( $conn, $sql ) or die( "Erro ao alterar atividade" );
mysqli_close( $conn );
?>
