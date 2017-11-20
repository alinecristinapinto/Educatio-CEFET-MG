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
  <script src="BLT-Web-Emprestimos.js"></script> 
 </head>
 <body>
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
$dataDevolucao = $_POST['datadevolucao'];
$IDacervo = $_POST['IDAcervo'];
$novaDataRes = new DateTime($dataDevolucao);
$novaDataRes->add(new DateInterval('P1D'));
$novaDataRes = $novaDataRes->format('Y-m-d');
$sql = "SELECT dataReserva, id FROM reservas WHERE idAcervo = '$IDacervo' AND ativo='S' AND emprestou = 'N' ORDER BY id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $sqlo = "UPDATE reservas SET dataReserva = '$novaDataRes' WHERE idAcervo='$IDacervo' AND id= '{$row['id']}'";
      if ($conn->query($sqlo) === TRUE) {
      }
      $novaDataRes = new DateTime($novaDataRes);
      $novaDataRes->add(new DateInterval('P7D'));
      $novaDataRes = $novaDataRes->format('Y-m-d');
        $sqlk = "SELECT id, dataReserva, idAluno, idAcervo, tempoEspera FROM reservas WHERE idAcervo = '$IDacervo' AND ativo='S' AND emprestou = 'N' ORDER BY id LIMIT 1";
        $result = $conn->query($sqlk);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
            $sqlo = "UPDATE reservas SET emprestou = 'S' WHERE id = '{$row['id']}'";
            if ($conn->query($sqlo) === TRUE) {
              $dataDevoluc = new DateTime($row["dataReserva"]);
              $dataDevoluc->add(new DateInterval('P7D'));
              $dataDevoluc = $dataDevoluc->format('Y-m-d');
              $sqlb = "INSERT INTO emprestimos (idAluno, idAcervo, dataEmprestimo, dataPrevisaoDevolucao, dataDevolucao, multa, ativo) VALUES ('{$row['idAluno']}', '{$row['idAcervo']}', '{$row['dataReserva']}', '$dataDevoluc', '$dataDevoluc', '0', 'S')";
              if ($conn->query($sqlb) === TRUE) {
              }
            }
            }
        }else{
        }
    }
}else{
}
$sql = "SELECT dataPrevisaoDevolucao, multa FROM emprestimos WHERE idAcervo = '$IDacervo' AND ativo='S' LIMIT 1";
$result = $conn->query($sql);
$multa= 0;
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $dataPrazo= date_create($row["dataPrevisaoDevolucao"]);
      $dataEntrega= date_create($dataDevolucao);
      $diff=date_diff($dataEntrega,$dataPrazo);
      if($diff->format("%R%a")>=0){
      }else{
        $multa = $diff->format("%a");
      }
        echo $multa;
        $sql = "UPDATE emprestimos SET ativo='N' WHERE idAcervo='$IDacervo' AND ativo='S' ORDER BY id ASC LIMIT 1";
        if ($conn->query($sql) === TRUE) {
          if($multa > 1){
          echo "<div class=\"corpo\">";
          echo "<div class=\"titulo\">";
          echo "<h1>";
          echo "<b>Livro Removido com sucesso!</b>";
          echo "<br><br><h3>Multa a ser paga: ".$multa." Dias</h3>";
          echo "</h1>";
          echo "<div class=\"container-fluid\">
                <div class=\"row\">
                <div class=\"col-md-12 mb-3\">
                <button style=\"margin-top: 70px;\"type=\"button\" class=\"btn btn-outline-info btn-block \" onclick=\"window.location.href='BLT-Web-Emprestimos.html'\">Pronto</button>
                <div class=\"container-fluid\">
                </div>
                </div>
                </div>";
          echo "</div>";
          echo "</div>";
          }else{
            echo "<div class=\"corpo\">";
            echo "<div class=\"titulo\">";
            echo "<h1>";
            echo "<b>Livro Removido com sucesso!</b>";
            echo "<br><br><h3>Acervo entregue no prazo correto!\"</h3>";
            echo "</h1>";
            echo "<div class=\"row\">
                  <div class=\"col-md-12 mb-3\">
                  <div class=\"container-fluid\">
                  <button type=\"button\" style=\"margin-top: 70px;\"class=\"btn btn-outline-info btn-block \" onclick=\"window.location.href='BLT-Web-Emprestimos.html'\">Pronto</button>
                  </div>
                  </div>
                  </div>";
            echo "</div>";
            echo "</div>";
          }
        } else {
          echo "Error updating record: " . $conn->error;
        }
    }
} else {
    echo "<div class=\"corpo\">";
            echo "<div class=\"titulo\">";
            echo "<h1>";
            echo "<b>Nem um registro ativo para esse acervo!</b>";
            echo "</h1>";
            echo "<div class=\"row\">
                  <div class=\"col-md-12 mb-3\">
                  <div class=\"container-fluid\">
                  <button type=\"button\" style=\"margin-top: 70px;\"class=\"btn btn-outline-info btn-block \" onclick=\"window.location.href='BLT-Web-Emprestimos.html'\">Pronto</button>
                  </div>
                  </div>
                  </div>";
            echo "</div>";
            echo "</div>";
}
$conn->close();
?>
