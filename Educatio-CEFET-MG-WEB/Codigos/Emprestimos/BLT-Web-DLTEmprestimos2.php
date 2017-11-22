<!DOCTYPE html>
<html>
<head>
  <title>Educatio - CEFET-MG </title>
  <meta charset="utf-8">
  <!-- CSS do Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/bootstrap.css" rel="stylesheet"/>

  <!-- CSS do grupo -->
    <link href="BLT-Web-Emprestimos.css" rel="stylesheet">

  <!-- Arquivos js -->
    <script src="js/jquery-3.2.1.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
    <script src="js/popper.js" type="text/javascript"></script>

  <!-- Fontes e icones -->
    <link href="https://fonts.googleapis.com/css?family=Abel|Inconsolata" rel="stylesheet">
    <link href="css/nucleo-icons.css" rel="stylesheet">

    <style type="text/css">
      .btn-info {
        background-color: #162e87;
        border-color: #162e87;
        color: #FFFFFF;
        opacity: 1;
        filter: alpha(opacity=100);
      }
      .btn-info:hover, .btn-info:focus, .btn-info:active, .btn-info.active, .show > .btn-info.dropdown-toggle {
        background-color: #11277a;
        color: #FFFFFF;
        border-color: #11277a;
      }
      .fonteTexto{
         font-family: 'Inconsolata', monospace;
         font-size: 16px;
      }
    </style>

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
          echo "<div class=\"row\">
                <div class=\"col-md-4 ml-auto mr-auto\">
                  <button type=\"button\" class=\"btn btn-info\" onclick=\"window.location.href='BLT-Web-Emprestimos.html'\">Pronto</button>
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
                <div class=\"col-md-4 ml-auto mr-auto\">
                  <button type=\"button\" class=\"btn btn-info\" onclick=\"window.location.href='BLT-Web-Emprestimos.html'\">Pronto</button>
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
                <div class=\"col-md-4 ml-auto mr-auto\">
                  <button type=\"button\" class=\"btn btn-info\" onclick=\"window.location.href='BLT-Web-Emprestimos.html'\">Pronto</button>
                </div>
                </div>";
            echo "</div>";
            echo "</div>";
}
$conn->close();
?>
